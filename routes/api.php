<?php

use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\BookController;
use App\Http\Controllers\API\V1\TagController;
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
            Route::post('/', 'store')->name('book.store');
            Route::get('/', 'index')->name('book.index');
            Route::put('/{id}', 'update')->name('book.update');
            Route::get('/{id}', 'show')->name('book.show');
        });
    });

    //Author Routes
    Route::prefix('author')->group(function () {
        Route::controller(AuthorController::class)->group(function () {
            Route::post('/', 'store')->name('author.store');
            Route::get('/{id}', 'show')->name('author.show');
            Route::get('/', 'index')->name('author.index');
        });
    });

    //Tag Routes
    Route::prefix('tag')->group(function () {
        Route::controller(TagController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/', 'index');
        });
    });
});
