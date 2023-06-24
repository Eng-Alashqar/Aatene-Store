<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/administrator')->name('admin.')->middleware(['auth','user-type:store_manager,customer'])->group(function(){
    Route::get('/',function(){
        return view('admin.index');
        });
});
