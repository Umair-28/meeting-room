<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('home');
})->name('home');

Route::get('/schedule-meeting', [MeetingController::class, 'showForm'])->name('schedule');
Route::post('/schedule-meeting', [MeetingController::class, 'submitForm'])->name('scheduleMeeting');

Route::get('/calender', [CalenderController::class, 'showCalender'])->name('showCalender');

// ADMIN ROUTES

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('loginForm');
Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/add-employee', [UserController::class, 'create'])->name('addEmployee');
    Route::put('/dashboard/update-employee', [UserController::class, 'update'])->name('updateEmployee');
    Route::delete('/dashboard/delete-employee/{id}', [UserController::class, 'delete'])->name('deleteEmployee');
    Route::get('/dashboard/schedule-meeting/{id}', [MeetingController::class, 'updateSchedule']);
    Route::post('/dashboard/update-meeting/{id}', [MeetingController::class, 'update'])->name('updateMeeting');
    Route::delete('/dashboard/delete-meeting/{id}', [MeetingController::class, 'delete'])->name('deleteMeeting');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
