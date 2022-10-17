<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::prefix('v1/')->group(function () {

    Route::prefix('/auth')->group(function () {

        Route::post('/register', 'API\V01\Auth\AuthController@register');
        Route::post('/login', 'API\V01\Auth\AuthController@login');
        Route::post('/logout', 'API\V01\Auth\AuthController@logout');
    });


    // chnnele Route

    Route::prefix('/channel')->group(function ()
    {
        Route::get('/all','API\V01\Channel\ChannelController@getAllChannelsList')->name('channel.list');
        Route::post('/channel-create','API\V01\Channel\ChannelController@createNewChannel')->name('channel.create');
        Route::put('/update','API\V01\Channel\ChannelController@updateChannel')->name('channel.update');


    });
});

