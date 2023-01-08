<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CurrenciesAPIController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\ConversionAPIController;
use App\Http\Controllers\API\AuthAPIController;

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



//public.
// Route::resource('currency', TestController::class);

Route::post('login', [AuthAPIController::class, 'login']);
Route::post('register', [AuthAPIController::class, 'register']);



//proteced.
Route::group(['middleware' => 'jwt.verify'], function () {
    
    Route::get('logout', [AuthAPIController::class, 'logout']);
    Route::get('get_user', [AuthAPIController::class, 'get_user']);
    Route::get('refresh', [AuthAPIController::class, 'refresh']);

    Route::resource('currencies', CurrenciesAPIController::class);

    Route::get('convert', [CurrenciesAPIController::class, 'index']);
    Route::get('convert/{value}/{name}', [ConversionAPIController::class, 'convertCurruncy']);
    Route::get('convert/{value}', [ConversionAPIController::class, 'convert']);
});

