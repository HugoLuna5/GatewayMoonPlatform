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

Route::get('/', function () {
    return redirect('/login');
});



Route::prefix('/home')->group(function (){

    Route::get('', 'App\Http\Controllers\HomeController@index')->name('homeView');
    Route::get('send/message/test/{device_id}', 'App\Http\Controllers\HomeController@sendMessageTest')->name('sendMessageTest');
    Route::get('send/messages', 'App\Http\Controllers\HomeController@sendMessageView')->name('sendMessageView');
    Route::post('send/message', 'App\Http\Controllers\HomeController@sendMessage')->name('sendMessage');

});
