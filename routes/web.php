<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;


  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin', function () {
    return view('home');
});
Route::get('/lte', function () {
    return view('lte.index');
});

Route::get('/app', function () {
    return view('layouts.app');
});





  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
 
});

Route::get('/category', [CategoryController::class, 'index']);

Route::get('/login',[AdminAuthController::class,'login']);
Route::post('login-user',[AdminAuthController::class,'authenticate'])->name('login-user');
Route::get('logout-user',[AdminAuthController::class,'logout'])->name('logout-user');

/*Route::post('/update/coupon/{id}', 'CouponsController@store');
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');*/

//Route::post('coupon-discount',[CouponController::class,'store'])->name('coupon-discount');

Route::get('/addcoupon',[CouponController::class,'AddCoupon']);

     //Route to post coupon
     Route::post('/postcoupon',[CouponController::class,'PostCoupon']);

     //Route to show Coupon
     Route::get('/showcoupon',[CouponController::class,'ShowCoupon']);

     //Routr to delete coupon
     Route::get('deletecoupon/{id}',[CouponController::class,'DeleteCoupon']);

     //Route to edit coupon
     Route::get('/editcoupon/{id}',[CouponController::class,'EditCoupon']);

     //Route to update coupon
     Route::post('/updatecoupon/{id}',[CouponController::class,'UpdateCoupon']);
     

     Route::get('/showcoupon', function () {
        return view('coupons.showcoupon');
    });
    