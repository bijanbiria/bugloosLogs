<?php

use App\Http\Controllers\Controller;
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

Route::get('/is-working', [Controller::class, 'isWorking']);

Route::group(['namespace' => '\App\Http\Controllers\Api'], function () {
    Route::group(['prefix' => 'logs'], function () {
        Route::get('/count', 'LogsController@getCount');
    });
});
