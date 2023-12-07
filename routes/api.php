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
Route::group(['namespace' => 'Api'], function () {
    Route::post('/login', 'AuthController@loginUser');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::resource('books', 'BookController');

        Route::resource('authors', 'AuthorController');

        Route::resource('customers', 'CustomerController');

        Route::post('book/borrow', 'BorrowController@borrowBook');
        Route::post('book/return/{book_id}', 'BorrowController@returnBook');
    });
});
