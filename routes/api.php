<?php

use App\Http\Controllers\Anamnesis\AnamnesisAnswersController;
use App\Http\Controllers\Anamnesis\AnamnesisController;
use App\Http\Controllers\Anamnesis\AnamnesisMetaController;
use App\Http\Controllers\Anamnesis\AnamnesisQuestionsController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Attendance\AttendanceDetailsController;
use App\Http\Controllers\Attendance\AttendanceFileController;
use App\Http\Controllers\Diary\DiaryController;
use App\Http\Controllers\Diary\DiaryMetaController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\Google\CalendarController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\MenuFoodController;
use App\Http\Controllers\Prescription\MedicineController;
use App\Http\Controllers\Prescription\PrescriptionController;
use App\Http\Controllers\Speciality\SpecialityController;
use App\Http\Controllers\User\RemunerationController;
use App\Http\Controllers\User\UserAvailabilityController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserMetaController;
use App\Http\Controllers\User\UserSpecialtyController;
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
    "prefix" => "anamnesis"
], function () {
    Route::get('/', [AnamnesisController::class, 'index'])->name('anamnesis.index');
    Route::post('/', [AnamnesisController::class, 'store'])->name('anamnesis.store');
    Route::get('{id}', [AnamnesisController::class, 'show'])->name('anamnesis.show');
    Route::put('{id}', [AnamnesisController::class, 'update'])->name('anamnesis.update');
    Route::delete('{id}', [AnamnesisController::class, 'destroy'])->name('anamnesis.destroy');
});


Route::group([
    "prefix" => "anamnesisanswers"
], function () {
    Route::get('/', [AnamnesisAnswersController::class, 'index'])->name('anamnesisanswers.index');
    Route::post('/', [AnamnesisAnswersController::class, 'store'])->name('anamnesisanswers.store');
    Route::get('{id}', [AnamnesisAnswersController::class, 'show'])->name('anamnesisanswers.show');
    Route::put('{id}', [AnamnesisAnswersController::class, 'update'])->name('anamnesisanswers.update');
    Route::delete('{id}', [AnamnesisAnswersController::class, 'destroy'])->name('anamnesisanswers.destroy');
});


Route::group([
    "prefix" => "anamnesismeta"
], function () {
    Route::get('/', [AnamnesisMetaController::class, 'index'])->name('anamnesismeta.index');
    Route::post('/', [AnamnesisMetaController::class, 'store'])->name('anamnesismeta.store');
    Route::get('{id}', [AnamnesisMetaController::class, 'show'])->name('anamnesismeta.show');
    Route::put('{id}', [AnamnesisMetaController::class, 'update'])->name('anamnesismeta.update');
    Route::delete('{id}', [AnamnesisMetaController::class, 'destroy'])->name('anamnesismeta.destroy');
});


Route::group([
    "prefix" => "anamnesisquestions"
], function () {
    Route::get('/', [AnamnesisQuestionsController::class, 'index'])->name('anamnesisquestions.index');
    Route::post('/', [AnamnesisQuestionsController::class, 'store'])->name('anamnesisquestions.store');
    Route::get('{id}', [AnamnesisQuestionsController::class, 'show'])->name('anamnesisquestions.show');
    Route::put('{id}', [AnamnesisQuestionsController::class, 'update'])->name('anamnesisquestions.update');
    Route::delete('{id}', [AnamnesisQuestionsController::class, 'destroy'])->name('anamnesisquestions.destroy');
});


Route::group([
    "prefix" => "attendance"
], function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('{id}', [AttendanceController::class, 'show'])->name('attendance.show');
    Route::put('{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
});


Route::group([
    "prefix" => "attendancedetails"
], function () {
    Route::get('/', [AttendanceDetailsController::class, 'index'])->name('attendancedetails.index');
    Route::post('/', [AttendanceDetailsController::class, 'store'])->name('attendancedetails.store');
    Route::get('{id}', [AttendanceDetailsController::class, 'show'])->name('attendancedetails.show');
    Route::put('{id}', [AttendanceDetailsController::class, 'update'])->name('attendancedetails.update');
    Route::delete('{id}', [AttendanceDetailsController::class, 'destroy'])->name('attendancedetails.destroy');
});


Route::group([
    "prefix" => "attendancefiles"
], function () {
    Route::get('/', [AttendanceFileController::class, 'index'])->name('attendancefiles.index');
    Route::post('/', [AttendanceFileController::class, 'store'])->name('attendancefiles.store');
    Route::get('{id}', [AttendanceFileController::class, 'show'])->name('attendancefiles.show');
    Route::delete('{id}', [AttendanceFileController::class, 'destroy'])->name('attendancefiles.destroy');
});


Route::group([
    "prefix" => "diary"
], function () {
    Route::get('/feelings', [DiaryController::class, 'feelings'])->name('diaries.feelings');
    Route::get('/', [DiaryController::class, 'index'])->name('diary.index');
    Route::post('/', [DiaryController::class, 'store'])->name('diary.store');
    Route::get('{id}', [DiaryController::class, 'show'])->name('diary.show');
    Route::put('{id}', [DiaryController::class, 'update'])->name('diary.update');
    Route::delete('{id}', [DiaryController::class, 'destroy'])->name('diary.destroy');
});


Route::group([
    "prefix" => "diarymeta"
], function () {
    Route::get('/', [DiaryMetaController::class, 'index'])->name('diarymeta.index');
    Route::post('/', [DiaryMetaController::class, 'store'])->name('diarymeta.store');
    Route::get('{id}', [DiaryMetaController::class, 'show'])->name('diarymeta.show');
    Route::put('{id}', [DiaryMetaController::class, 'update'])->name('diarymeta.update');
    Route::delete('{id}', [DiaryMetaController::class, 'destroy'])->name('diarymeta.destroy');
});


Route::group([
    "prefix" => "file"
], function () {
    Route::get('/', [FileController::class, 'index'])->name('file.index');
    Route::post('/', [FileController::class, 'store'])->name('file.store');
    Route::get('{id}', [FileController::class, 'show'])->name('file.show');
    Route::put('{id}', [FileController::class, 'update'])->name('file.update');
    Route::delete('{id}', [FileController::class, 'destroy'])->name('file.destroy');
});


Route::group([
    "prefix" => "medicine"
], function () {
    Route::get('/', [MedicineController::class, 'index'])->name('medicine.index');
    Route::post('/', [MedicineController::class, 'store'])->name('medicine.store');
    Route::get('{id}', [MedicineController::class, 'show'])->name('medicine.show');
    Route::put('{id}', [MedicineController::class, 'update'])->name('medicine.update');
    Route::delete('{id}', [MedicineController::class, 'destroy'])->name('medicine.destroy');
});


Route::group([
    "prefix" => "menu"
], function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/', [MenuController::class, 'store'])->name('menu.store');
    Route::get('{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::put('{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
});


Route::group([
    "prefix" => "menufood"
], function () {
    Route::get('/', [MenuFoodController::class, 'index'])->name('menufood.index');
    Route::post('/', [MenuFoodController::class, 'store'])->name('menufood.store');
    Route::get('{id}', [MenuFoodController::class, 'show'])->name('menufood.show');
    Route::put('{id}', [MenuFoodController::class, 'update'])->name('menufood.update');
    Route::delete('{id}', [MenuFoodController::class, 'destroy'])->name('menufood.destroy');
});


Route::group([
    "prefix" => "prescription"
], function () {
    Route::get('/', [PrescriptionController::class, 'index'])->name('prescription.index');
    Route::post('/', [PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('{id}', [PrescriptionController::class, 'show'])->name('prescription.show');
    Route::put('{id}', [PrescriptionController::class, 'update'])->name('prescription.update');
    Route::delete('{id}', [PrescriptionController::class, 'destroy'])->name('prescription.destroy');
});


Route::group([
    "prefix" => "remuneration"
], function () {
    Route::get('/', [RemunerationController::class, 'index'])->name('remuneration.index');
    Route::post('/', [RemunerationController::class, 'store'])->name('remuneration.store');
    Route::get('{id}', [RemunerationController::class, 'show'])->name('remuneration.show');
    Route::put('{id}', [RemunerationController::class, 'update'])->name('remuneration.update');
    Route::delete('{id}', [RemunerationController::class, 'destroy'])->name('remuneration.destroy');
});


Route::group([
    "prefix" => "speciality"
], function () {
    Route::get('/', [SpecialityController::class, 'index'])->name('speciality.index');
    Route::post('/', [SpecialityController::class, 'store'])->name('speciality.store');
    Route::get('{id}', [SpecialityController::class, 'show'])->name('speciality.show');
    Route::put('{id}', [SpecialityController::class, 'update'])->name('speciality.update');
    Route::delete('{id}', [SpecialityController::class, 'destroy'])->name('speciality.destroy');
});


Route::group([
    "prefix" => "user"
], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('{id}', [UserController::class, 'destroy'])->name('user.destroy');
});


Route::group([
    "prefix" => "useravailability"
], function () {
    Route::get('/', [UserAvailabilityController::class, 'index'])->name('useravailability.index');
    Route::post('/', [UserAvailabilityController::class, 'store'])->name('useravailability.store');
    Route::get('{id}', [UserAvailabilityController::class, 'show'])->name('useravailability.show');
    Route::put('{id}', [UserAvailabilityController::class, 'update'])->name('useravailability.update');
    Route::delete('{id}', [UserAvailabilityController::class, 'destroy'])->name('useravailability.destroy');
});


Route::group([
    "prefix" => "usermeta"
], function () {
    Route::get('/', [UserMetaController::class, 'index'])->name('usermeta.index');
    Route::post('/', [UserMetaController::class, 'store'])->name('usermeta.store');
    Route::get('{id}', [UserMetaController::class, 'show'])->name('usermeta.show');
    Route::put('{id}', [UserMetaController::class, 'update'])->name('usermeta.update');
    Route::delete('{id}', [UserMetaController::class, 'destroy'])->name('usermeta.destroy');
});


Route::group([
    "prefix" => "userspecialty"
], function () {
    Route::get('/', [UserSpecialtyController::class, 'index'])->name('userspecialty.index');
    Route::post('/', [UserSpecialtyController::class, 'store'])->name('userspecialty.store');
    Route::get('{id}', [UserSpecialtyController::class, 'show'])->name('userspecialty.show');
    Route::put('{id}', [UserSpecialtyController::class, 'update'])->name('userspecialty.update');
    Route::delete('{id}', [UserSpecialtyController::class, 'destroy'])->name('userspecialty.destroy');
});


Route::group([
    "prefix" => "calendar"
], function () {
    Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get('{id}', [CalendarController::class, 'show'])->name('calendar.show');
    Route::put('{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
});
