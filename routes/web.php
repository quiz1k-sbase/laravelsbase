<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SampleController;

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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');*/

Route::controller(SampleController::class)->group(function () {
    Route::get('login', 'index')->name('login');

    Route::get('registration', 'registration')->name('registration');

    Route::get('logout', 'logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');

    Route::post('validate_login', 'validate_login')->name('sample.validate_login');

    Route::get('dashboard', 'dashboard')->name('dashboard');
});
