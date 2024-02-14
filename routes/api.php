<?php

use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {

    //Book Routes
    Route::prefix('book')->group(function () {
        Route::controller(BookController::class)->group(function () {
            Route::post('/', 'store');
            Route::put('/{id}', 'update');
            Route::get('/{id}', 'show');
            Route::get('/', 'index');
        });
    });

    //Author Routes
    Route::prefix('author')->group(function () {
        Route::controller(AuthorController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/', 'index');
        });
    });
});
