<?php

use App\Http\Controllers\Attendance\AnamnesisController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Attendance\AttendanceDetailsController;
use App\Http\Controllers\Attendance\AttendanceFileController;
use App\Http\Controllers\Attendance\GoogleCalendarController;
use App\Http\Controllers\Diary\DiaryController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    "prefix" => "attendances"
], function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('{id}', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::put('{id}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
});

Route::group([
    "prefix" => "attendances-details"
], function () {
    Route::post('/', [AttendanceDetailsController::class, 'store'])->name('attendances-details.store');
    Route::put('{id}', [AttendanceDetailsController::class, 'update'])->name('attendances-details.update');
    Route::delete('{id}', [AttendanceDetailsController::class, 'destroy'])->name('attendances-details.destroy');
});

Route::group([
    "prefix" => "attendances-files"
], function () {
    Route::post('/', [AttendanceFileController::class, 'store'])->name('attendances-files.store');
    Route::put('{id}', [AttendanceFileController::class, 'update'])->name('attendances-files.update');
    Route::delete('{id}', [AttendanceFileController::class, 'destroy'])->name('attendances-files.destroy');
});

Route::group([
    "prefix" => "diaries"
], function () {
    Route::get('/feelings', [DiaryController::class, 'feelings'])->name('diaries.feelings');
    Route::get('/', [DiaryController::class, 'index'])->name('diaries.index');
    Route::post('/', [DiaryController::class, 'store'])->name('diaries.store');
    Route::get('{id}', [DiaryController::class, 'show'])->name('diaries.show');
    Route::put('{id}', [DiaryController::class, 'update'])->name('diaries.update');
    Route::delete('{id}', [DiaryController::class, 'destroy'])->name('diaries.destroy');
});

Route::group([
    "prefix" => "anamnesis"
], function () {
    Route::get('/', [AnamnesisController::class, 'index'])->name('anamnesis.index');
    Route::post('/', [AnamnesisController::class, 'store'])->name('anamnesis.store');
    Route::get('{id}', [AnamnesisController::class, 'show'])->name('anamnesis.show');
    Route::put('{id}', [AnamnesisController::class, 'update'])->name('anamnesis.update');
    Route::delete('{id}', [AnamnesisController::class, 'destroy'])->name('anamnesis.destroy');
});



Route::group([
    "prefix" => "calendar"
], function () {
    Route::get('/', [GoogleCalendarController::class, 'index'])->name('calendar.index');
    Route::post('/', [GoogleCalendarController::class, 'store'])->name('calendar.store');
    Route::get('{id}', [GoogleCalendarController::class, 'show'])->name('calendar.show');
    Route::put('{id}', [GoogleCalendarController::class, 'update'])->name('calendar.update');
    Route::delete('{id}', [GoogleCalendarController::class, 'destroy'])->name('calendar.destroy');
});
