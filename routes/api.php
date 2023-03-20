<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserStoreController;

Route::prefix('/v1')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/first', function (Request $request) {
            return User::query()->first();
        });

        Route::get('/', UserListController::class);
        Route::post('/', UserStoreController::class);
    });
});
