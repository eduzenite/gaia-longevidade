<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceDetailsController;
use App\Http\Controllers\AttendanceFileController;
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
