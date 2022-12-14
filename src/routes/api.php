<?php

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

    //Authentication Routes
    include __DIR__. '/v1/auth_routes.php';

    // channel Route
    include __DIR__. '/v1/channels_routes.php';

    // thread Routes
    include __DIR__.'/v1/thread_routes.php';




});

