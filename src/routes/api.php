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


Route::prefix('v1/auth')->group(function()
{
    Route::post('/register','API\V01\Auth\AuthController@register');
    Route::post('/login','API\V01\Auth\AuthController@login');
    Route::post('/logout','API\V01\Auth\AuthController@logout');


});

