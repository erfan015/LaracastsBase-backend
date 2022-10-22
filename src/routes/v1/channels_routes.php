<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Channel\ChannelController;


Route::prefix('/channel')->group(function () {

    Route::get('/all', [ChannelController::class, 'getAllChannelsList'])->name('channel.list');


    Route::middleware(['can:channel management', 'auth:sanctum'])->group(function () {

        Route::post('/channel-create', [ChannelController::class, 'createNewChannel'])->name('channel.create');
        Route::put('/update', [ChannelController::class, 'updateChannel'])->name('channel.update');
        Route::delete('/delete', [ChannelController::class, 'deleteChannel'])->name('channel.delete');

    });


});
