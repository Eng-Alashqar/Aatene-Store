<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerNotificatoinRequest;
use App\Models\PushingNotification;
use App\Models\SellerPushingNotification;
use App\Models\Store\Store;
use App\Models\Users\User;
use Illuminate\Http\Request;

class SellerNotificationController extends Controller
{
    public function index()
    {

        $noti = auth()->guard('seller')->user()->pushingNotifications()->get();
//        dd($noti);
        return view('seller.notifications.index-push' , compact('noti'));

    }

    public function create()
    {
        $current = 'انشاء اشعار';
        $id = (auth()->guard('seller')->user()->store()->first()->id);
        $store = Store::find($id);
        $users = $store->followers->pluck('name' , 'id')->toArray();
        return view('seller.notifications.create-noti', compact('current'  , 'users'));
    }

    public function store(SellerNotificatoinRequest $request)
    {
        $data = $request->getData();
        $users = [];

        $data['users'] = isset($request->getData()['users']['all']) ? explode(',', $request->getData()['users']['all']) : $request->getData()['users'];
//           dd($data , auth()->guard('seller')->user()->id);

        if ($data['type'] == 'sms') {


            if (!is_null($data['users'])) {
                $users = array_merge($users, User::find($data['users'])->pluck('phone_number')->toArray());
            }
        } elseif ($data['type'] == 'app') {

            if (!is_null($data['users'])) {
                $users = array_merge($users, User::find($data['users'])->pluck('token_notify')->toArray());
            }

        } elseif ($data['type'] == 'email') {


            if (!is_null($data['users'])) {
                $users = array_merge($users, User::find($data['users'])->pluck('email')->toArray());
            }

        }


//        dd(implode("," ,array_unique($users)));

        $pushingNotification = auth()->guard('seller')->user()->pushingNotifications()->create([
            'title'=> $data['title'],
            'content'=> $data['content'],
            'type'=> $data['type'],
            'launch_at'=> $data['launch_at'],
            'connection'=> strval(implode("," ,array_unique($users) )),
        ]);

        return redirect()->back()->with('notification' , $pushingNotification?'تم الادراج بنجاح':'لم يتم الادراح');

        }


    public function forceDelete($id){
        $not = SellerPushingNotification::where('id', $id)->delete();
        return redirect()->back()->with('notification' , ' تم الحذف بنجاح');
    }

    public function restore($id)
    {
        $not = SellerPushingNotification::where('id', $id)->update([
            'deleted_at' => null
        ]);
        return redirect()->back()->with('notification', 'تم اعادة الانطلاق');

    }

}
