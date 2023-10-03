<?php


use App\Http\Controllers\Api\Advertisement\PriceController;
use App\Http\Controllers\Api\Advertisement\ProductAdvertisementController;
use App\Http\Controllers\Api\Advertisement\ProductListController;
use App\Http\Controllers\Api\Advertisement\StoreAdvertisementController;
use App\Http\Controllers\Api\Store\CategoryController;
use App\Http\Controllers\Api\Store\Options\AttributeController;
use App\Http\Controllers\Api\Store\Options\AttributeVariantController;
use App\Http\Controllers\Api\Store\Options\VariantsController;
use App\Http\Controllers\Api\Store\ProductController;
use App\Http\Controllers\Api\Store\StoreController;
use App\Http\Controllers\Api\Store\TagsController;
use App\Http\Controllers\Api\Users\ProfileController;
use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware(['api', 'check_password','auth:user'])->group(function () {
//
///*
//    Route::prefix('/favorites')->group(function () {
//        Route::get('/', [FavoriteController::class, 'index']);
//        Route::post('/', [FavoriteController::class, 'store']);
//        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
//    });*/

//    /*
//    Route::post('orders/{product}', [OrderController::class, 'store']);
//    Route::delete('orders/{order}', [OrderController::class, 'destroy']);
//    Route::get('orders/{order}', [OrderController::class, 'show']);
//    Route::get('orders', [OrderController::class, 'index']);
//*/
////    Route::post('/products/{product}/report', [ProductController::class, 'reportProduct']);
////    Route::post('/stores/{store}/report', [StoreController::class, 'reportStore']);
//
////    Route::apiResource('profiles', ProfileController::class);
//
//});



Route::middleware(['api'])->group(function () {
    Route::apiResource('stores', StoreController::class);
    Route::apiResource('/products', ProductController::class);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::prefix('/profile')->middleware('auth:seller,user,admin')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'show');
        Route::post('/create', 'store');
        Route::put('/update', 'update');
        Route::delete('/delete', 'destroy');
    });

    Route::prefix('/variants')->middleware('auth:seller')->controller(VariantsController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('/attributes')->middleware('auth:seller')->controller(AttributeController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::prefix('/attribute-variant')->middleware('auth:seller')->controller(AttributeVariantController::class)->group(function () {
        Route::post('/', 'store');
    });

    Route::apiResource('/tags', TagsController::class)->middleware('auth:seller');
    Route::prefix('/users')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::middleware('auth:admin')->group(function (){

        Route::apiResource('prices',PriceController::class);

        Route::apiResource('store-advertisements',StoreAdvertisementController::class);
        Route::get('store-advertisements-orders',[StoreAdvertisementController::class,'indexOrder'])->name('store-advertisements-orders');
        Route::post('store-advertisements-accepted/{id}',[StoreAdvertisementController::class,'orderAccepted'])->name('advertisement-store.accepted');
        Route::delete('store-advertisements-rejected/{id}',[StoreAdvertisementController::class,'orderRejected'])->name('advertisement-store.rejected');

        Route::apiResource('product-advertisements',ProductAdvertisementController::class);
        Route::get('product-advertisements-orders',[ProductAdvertisementController::class,'indexOrder'])->name('product-advertisements-orders');
        Route::post('product-advertisements-accepted/{id}',[ProductAdvertisementController::class,'orderAccepted'])->name('advertisement-product.accepted');
        Route::delete('product-advertisements-rejected/{id}',[ProductAdvertisementController::class,'orderRejected'])->name('advertisement-product.rejected');

        Route::apiResource('products-list-ads',ProductListController::class);
        Route::get('products-list-orders',[ProductListController::class,'indexOrder'])->name('products-list-orders');
        Route::post('products-list-accepted/{id}',[ProductListController::class,'orderAccepted'])->name('products-list.accepted');
        Route::delete('products-list-rejected/{id}',[ProductListController::class,'orderRejected'])->name('products-list.rejected');


    });
});


require __DIR__ . '/api/auth.php';
require __DIR__ . '/api/seller.php';
require __DIR__ . '/api/user.php';
require __DIR__ . '/api/chat.php';




