<?php

use App\Http\Controllers\Api\GuestController;
use Illuminate\Support\Facades\Route;

Route::prefix('guest')
    ->controller(GuestController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'create');

        Route::prefix('{guest}')
            ->group(function () {
                Route::patch('/', 'update');
                Route::delete('/', 'destroy');
            });
    });
