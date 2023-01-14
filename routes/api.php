<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CurrenciesAPIController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\ConversionAPIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('currencies', CurrenciesAPIController::class);

// Route::resource('currency', TestController::class);

Route::get('convert', [CurrenciesAPIController::class, 'index'])->name('convert.index');

Route::get('convert/{value}/{name}', [ConversionAPIController::class, 'convertCurruncy'])->name('convert.convertCurruncy');

Route::get('convert/{value}', [ConversionAPIController::class, 'convert'])->name('convert.convert');
