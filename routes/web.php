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
        Route::post('/user-details/store', [UserDetailsController::class, 'store'])->name('user-details.store');

        Route::get('attendence', [AttendenceController::class, 'index'])->name('attendence');
        Route::get('attendence/edit/{id}', [AttendenceController::class, 'edit'])->name('attendence.edit');
        Route::put('/attendence/update', [AttendenceController::class, 'update'])->name('attendence.update');

        Route::get('leave', [LeaveController::class, 'index'])->name('leave');
        Route::post('/leave/store', [LeaveController::class, 'store'])->name('leave.store');
        Route::put('/leave/update', [LeaveController::class, 'update'])->name('leave.update');
        Route::get('/leave/edit/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
        Route::delete('/leave/delete/{id}', [LeaveController::class, 'delete'])->name('leave.delete');

        Route::get('/event', [EventController::class, 'index'])->name('event');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::delete('/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

        Route::resource('employee-report', EmployeeReportController::class);
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('change-password', [SettingController::class, 'changePassword'])->name('change-password');
        Route::get('delete-account', [SettingController::class, 'deleteAccount'])->name('delete-account');

        Route::get('help-and-support', [HelpAndSupportController::class, 'index'])->name('help-and-support');
        Route::get('policy', [PolicyController::class, 'index'])->name('policy');

    });
});