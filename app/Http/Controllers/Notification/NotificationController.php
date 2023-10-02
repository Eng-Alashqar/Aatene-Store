<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificatoinRequest;
use App\Models\PushingNotification;
use App\Models\Store\Store;
use App\Models\Users\Seller;
use App\Models\Users\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {

        $noti = PushingNotification::withTrashed()->get();
//        dd($noti);
        return view('admin.notifications.index-push' , compact('noti'));

    }

    public function create()
    {
        $current = 'انشاء اشعار';
        $users = User::select('id' , 'name')->get();
        $sellers = Seller::select('id' , 'name')->get();
        $stores = Store::select('id' , 'name')->get();
        return view('admin.notifications.create-noti', compact('current' , 'stores' , 'sellers' , 'users'));
    }

    public function store(NotificatoinRequest $request)
    {
           $data =  $request->getData();
           $users = [];
        if ($data['type']== 'sms'){
            if (!is_null($data['followers'])){
                foreach ($data['followers'] as $follower){
                    $users =array_merge($users , Store::find($follower)->first()->followers()->pluck('phone_number')->toArray());
                }
            }
            if(!is_null($data['users'])){
                $users =array_merge($users , User::find($data['users'])->pluck('phone_number')->toArray());
            }

            if(!is_null($data['sellers'])){
                $users =array_merge($users , Seller::find($data['sellers'])->pluck('phone_number')->toArray());
            }
        }elseif($data['type']== 'app'){

            if (!is_null($data['followers'])){
                foreach ($data['followers'] as $follower){
                    $users =array_merge($users , Store::find($follower)->first()->followers()->pluck('token_notify')->toArray());
                }
            }
            if(!is_null($data['users'])){
                $users =array_merge($users , User::find($data['users'])->pluck('token_notify')->toArray());
            }

        }elseif($data['type']== 'email'){

            if (!is_null($data['followers'])){
                foreach ($data['followers'] as $follower){
                    $users =array_merge($users , Store::find($follower)->first()->followers()->pluck('email')->toArray());
                }
            }
            if(!is_null($data['users'])){
                $users =array_merge($users , User::find($data['users'])->pluck('email')->toArray());
            }

            if(!is_null($data['sellers'])){
                $users =array_merge($users , Seller::find($data['sellers'])->pluck('email')->toArray());
            }
        }

//        dd(var_dump(implode("," ,array_unique($users)));

        $pushingNotification = PushingNotification::create([
            'title'=> $data['title'],
            'content'=> $data['content'],
            'type'=> $data['type'],
            'launch_at'=> $data['launch_at'],
            'connection'=> strval(implode("," ,array_unique($users) )),
        ]);

        return redirect()->back()->with('notification' , $pushingNotification?'تم الادراج بنجاح':'لم يتم الادراح');

    }

    public function forceDelete($id){
        $not = PushingNotification::where('id', $id)->forceDelete();
        return redirect()->back()->with('notification' , 'تم الحذف بنجاح');
    }

    public function restore($id)
    {
        $not = PushingNotification::where('id', $id)->restore();
        return redirect()->back()->with('notification', 'تم اعادة الانطلاق');

    }

}
