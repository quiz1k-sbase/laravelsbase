<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SampleController;
use App\Http\Controllers\PostController;

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

    Route::get('dashboard', 'dashboard' )->name('dashboard');

    Route::get('author/{id}', 'getAuthor')->name('sample.author');

    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');

    Route::post('validate_login', 'validate_login')->name('sample.validate_login');
});

Route::resource('dashboard',PostController::class);


/*Route::controller(PostController::class)->group(function () {

    Route::post('dashboard', 'store')->name('post.store');
});*/

Route::post('dashboard', [PostController::class, 'store'])->name('post.store');
Route::post('update', [PostController::class, 'update'])->name('post.update');
Route::post('addComment', [CommentController::class, 'store'])->name('comment.addComment');
Route::post('editComment', [CommentController::class, 'update'])->name('comment.editComment');
Route::delete('dashboard/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::delete('dashboard/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('registration', [DropdownController::class, 'index'])->name('registration');
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);
