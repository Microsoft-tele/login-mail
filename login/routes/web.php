<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\LoginController::class, 'index']); // 获取用户输入的邮箱和密码

Route::post('receive', [\App\Http\Controllers\LoginController::class, 'receive']);  // 接收邮箱和密码并验证

Route::post('checkVerifyNum', [\App\Http\Controllers\LoginController::class, 'checkVerifyNum']);

Route::any('updatePassword', function (){
    return view('updatePassword');
});

Route::any('checkPassword', [\App\Http\Controllers\UpdatePasswodrController::class, 'receive']);

Route::any('checkVerifyNum_updatePassword',
    [\App\Http\Controllers\UpdatePasswodrController::class, 'checkVerifyNum_updatePassword']);

Route::get('mysql', [\App\Http\Controllers\LoginController::class, 'mysql']);

