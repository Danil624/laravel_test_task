<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Веб-маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать веб-маршруты для своего
|приложения. RouteServiceProvider загружает эти маршруты     |внутри группы, которая содержит группу промежуточного       |программного обеспечения «web». А теперь создайте 
|что-нибудь замечательное!
|
*/
  
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Route::get('notify/index',[ NotificationController::class,'index']);