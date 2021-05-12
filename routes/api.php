<?php

use App\Http\Controllers\Dash\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('settings', [SettingController::class, 'index'])->name('apiProducts');
Route::put('settings/update/{id}', [SettingController::class, 'update']);
Route::delete('settings/delete/{id}', [SettingController::class, 'destroy']);
Route::post('settings/store', [SettingController::class, 'store']);
