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
Route::get("test",[\App\Http\Controllers\test\TestController::class,'test']);
Route::get('/', function () {
    return view('index');
});
Route::post("send",[\App\Http\Controllers\amqp\AmqpController::class,"send"]);
