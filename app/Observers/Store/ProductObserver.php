<?php

namespace App\Observers\Store;

use App\Jobs\UserProductNotify;
use App\Models\Store\Product;
use App\Models\Users\Admin;
use App\Models\Users\User;
use App\Notifications\CreateProduct;
use App\Notifications\UpdateProduct;
use App\Services\NotificationsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductObserver
{

    public function __construct(public NotificationsService $notificationsService)
    {
    }

    /**
     * Handle the Product "created" event.
     */
    public function creating(Product $product): void
    {
        $user  = auth()->guard('seller')->user();
        $product->store_id =  $user->store_id;
        $product->slug = Str::slug($product->name).'-'.$user->store_id.'-'.time();

    }

    /**
     * Handle the Product "updated" event.
     */
    public function updating(Product $product): void
    {
        $user  = auth()->guard('seller')->user();
        $product->slug = Str::slug($product->name).'-'.$user->store_id.'-'.$product->id;
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function created(Product $product): void
    {

        $admin = Admin::find(1);
        $admin->notify(new CreateProduct($product));


        $product = Product::find($product->id);
//        $users = User::whereHas('following', function ($query) use ($product) {
//            $query->where('store_id', $product->store->id); })->get();



        $this->notificationsService->pushNotify($product->id , 'تم اضافة منتح جديد ' , "تم اضافة منتج جديد للمتجر الذي تتابعه ($product->name)");
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
    public function Updated(Product $product): void
    {
        $admin = Admin::find(1);
        $admin->notify(new UpdateProduct($product));
    }


}
