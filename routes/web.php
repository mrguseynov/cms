<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\DashHomeController;
use App\Http\Controllers\Dash\DashUserController;
use App\Http\Controllers\SettingController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['role:admin|editor'])->prefix('root')->group( function () {
    Route::get('/', [DashHomeController::class, 'index'])->name('homeAdmin');
    Route::resource('user', DashUserController::class);
    Route::resource('settings', SettingController::class);
    //Route::resource('category', CategoryController::class);
    //Route::resource('post', PostController::class);
});
