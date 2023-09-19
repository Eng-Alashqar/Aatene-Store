<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Users\Admin;


enum TypeNoti : string {
    case UPDATE_PRODUCT = 'update-product';
    case CREATE_PRODUCT = 'create-product';
    case CREATE_STORE = 'create-store';
}

class AdminNotifyController extends Controller
{

    public function index(TypeNoti $type = null)
    {
        if ($type == null )
        {
            $current = 'جميع الاشعارات' ;
            $notifications = Admin::find(1)->unreadNotifications()->paginate(7);
        return view('admin.notifications.index' , compact('notifications' , 'current'));
        }elseif ($type->value == 'create-product')
        {
            $current = 'اشعارات اضافة المنتجات' ;
            $notifications = Admin::find(1)->unreadNotifications->where('type', 'App\Notifications\CreateProduct');
            return view('admin.notifications.index' , compact('notifications' , 'current'));
        }elseif ($type->value == 'create-store')
        {
            $current = 'اشعارات اضافة متجر' ;
            $notifications = Admin::find(1)->unreadNotifications->where('type', 'App\Notifications\CreateStore');
            return view('admin.notifications.index' , compact('notifications' , 'current'));
        }elseif ($type->value == 'update-product')
        {
            $current = 'اشعارات تعديل المنتج' ;
            $notifications = Admin::find(1)->unreadNotifications->where('type', 'App\Notifications\UpdateProduct');
            return view('admin.notifications.index' , compact('notifications' , 'current'));
        }
    }

    public function markAsRead($id)
    {
        $admin = Admin::find(1)->unreadNotifications->where('id', $id)->first()->update(['read_at'=> now()]);
        return redirect()->route('admin.notification');

    }

    public function markAllAsRead()
    {
        $admin = Admin::find(1);
        foreach ($admin->readNotifications as $notification) {
            $notification->update(['read_at' => now()]);
        }
        return redirect()->route('admin.notification');
    }
}
