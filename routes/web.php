<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect('/home'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('currenciesInfos', App\Http\Controllers\currencies_infoController::class);

Route::resource('currencies', App\Http\Controllers\CurrenciesController::class);

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

Route::post('users/removeRole', [App\Http\Controllers\UserController::class, 'removeRole'])->name('users.removeRole');


// Test Routes.
Route::get('/hi', [App\Http\Controllers\TestController::class, 'index']);


Route::get('other', function () {
    return view('other.index');
})->name('other.index');
