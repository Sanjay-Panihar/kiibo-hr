<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/profile', [UserDetailsController::class, 'index'])->name('profile');

        Route::get('/event', [EventController::class, 'index'])->name('event');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::delete('/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

    });
});