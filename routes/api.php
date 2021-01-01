<?php

use Illuminate\Http\Request;

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

Route::prefix('messages')->name('messages.')->group(function(){
    //광고주와 채팅
    Route::get('/{advertiser}', 'MessageController@index')->name('index');
   Route::post('/store', 'MessageController@store')->name('store');
});