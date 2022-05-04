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
use App\Http\Controllers\User\UserSpecialityController;
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

Route::get('routes', function (){
    foreach (Route::getRoutes()->getIterator() as $route){
        if (strpos($route->uri, 'api') !== false){
            $routes[] = [
                'url' => $route->uri,
                'method' => $route->methods[0]
            ];
        }
    }
    return response()->json($routes);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    "prefix" => "anamnesis"
], function () {
    Route::get('/', [AnamnesisController::class, 'index'])->middleware('auth:sanctum')->name('anamnesis.index');
    Route::post('/', [AnamnesisController::class, 'store'])->middleware('auth:sanctum')->name('anamnesis.store');
    Route::get('{anamnesisId}', [AnamnesisController::class, 'show'])->middleware('auth:sanctum')->name('anamnesis.show');
    Route::put('{anamnesisId}', [AnamnesisController::class, 'update'])->middleware('auth:sanctum')->name('anamnesis.update');
    Route::delete('{anamnesisId}', [AnamnesisController::class, 'destroy'])->middleware('auth:sanctum')->name('anamnesis.destroy');

    Route::get('/{anamnesisId}/metas', [AnamnesisMetaController::class, 'index'])->middleware('auth:sanctum')->name('anamnesismetas.index');
    Route::post('/{anamnesisId}/metas', [AnamnesisMetaController::class, 'store'])->middleware('auth:sanctum')->name('anamnesismetas.store');
    Route::get('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'show'])->middleware('auth:sanctum')->name('anamnesismetas.show');
    Route::put('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'update'])->middleware('auth:sanctum')->name('anamnesismetas.update');
    Route::delete('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'destroy'])->middleware('auth:sanctum')->name('anamnesismetas.destroy');
});


Route::group([
    "prefix" => "anamnesis-questions"
], function () {
    Route::get('/', [AnamnesisQuestionsController::class, 'index'])->middleware('auth:sanctum')->name('anamnesisquestions.index');
    Route::post('/', [AnamnesisQuestionsController::class, 'store'])->middleware('auth:sanctum')->name('anamnesisquestions.store');
    Route::get('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'show'])->middleware('auth:sanctum')->name('anamnesisquestions.show');
    Route::put('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'update'])->middleware('auth:sanctum')->name('anamnesisquestions.update');
    Route::delete('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'destroy'])->middleware('auth:sanctum')->name('anamnesisquestions.destroy');

    Route::get('/{anamnesisQuestionId}/answers', [AnamnesisAnswersController::class, 'index'])->middleware('auth:sanctum')->name('anamnesisanswers.index');
    Route::post('/{anamnesisQuestionId}/answers', [AnamnesisAnswersController::class, 'store'])->middleware('auth:sanctum')->name('anamnesisanswers.store');
    Route::get('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'show'])->middleware('auth:sanctum')->name('anamnesisanswers.show');
    Route::put('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'update'])->middleware('auth:sanctum')->name('anamnesisanswers.update');
    Route::delete('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'destroy'])->middleware('auth:sanctum')->name('anamnesisanswers.destroy');
});

Route::group([
    "prefix" => "attendances"
], function () {
    Route::get('/', [AttendanceController::class, 'index'])->middleware('auth:sanctum')->name('attendances.index');
    Route::post('/', [AttendanceController::class, 'store'])->middleware('auth:sanctum')->name('attendances.store');
    Route::get('{attendanceId}', [AttendanceController::class, 'show'])->middleware('auth:sanctum')->name('attendances.show');
    Route::put('{attendanceId}', [AttendanceController::class, 'update'])->middleware('auth:sanctum')->name('attendances.update');
    Route::delete('{attendanceId}', [AttendanceController::class, 'destroy'])->middleware('auth:sanctum')->name('attendances.destroy');

    Route::get('/{attendanceId}/details/', [AttendanceDetailsController::class, 'index'])->middleware('auth:sanctum')->name('attendancedetails.index');
    Route::post('/{attendanceId}/details/', [AttendanceDetailsController::class, 'store'])->middleware('auth:sanctum')->name('attendancedetails.store');
    Route::get('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'show'])->middleware('auth:sanctum')->name('attendancedetails.show');
    Route::put('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'update'])->middleware('auth:sanctum')->name('attendancedetails.update');
    Route::delete('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'destroy'])->middleware('auth:sanctum')->name('attendancedetails.destroy');

    Route::get('/{attendanceId}/files/', [AttendanceFileController::class, 'index'])->middleware('auth:sanctum')->name('attendancefiles.index');
    Route::post('/{attendanceId}/files/', [AttendanceFileController::class, 'store'])->middleware('auth:sanctum')->name('attendancefiles.store');
    Route::get('/{attendanceId}/files/{attendanceFileId}', [AttendanceFileController::class, 'show'])->middleware('auth:sanctum')->name('attendancefiles.show');
    Route::delete('/{attendanceId}/files/{attendanceFileId}', [AttendanceFileController::class, 'destroy'])->middleware('auth:sanctum')->name('attendancefiles.destroy');
});


Route::group([
    "prefix" => "diaries"
], function () {
    Route::get('/feelings', [DiaryController::class, 'feelings'])->middleware('auth:sanctum')->name('diaries.feelings');
    Route::get('/', [DiaryController::class, 'index'])->middleware('auth:sanctum')->name('diaries.index');
    Route::post('/', [DiaryController::class, 'store'])->middleware('auth:sanctum')->name('diaries.store');
    Route::get('{diaryId}', [DiaryController::class, 'show'])->middleware('auth:sanctum')->name('diaries.show');
    Route::put('{diaryId}', [DiaryController::class, 'update'])->middleware('auth:sanctum')->name('diaries.update');
    Route::delete('{diaryId}', [DiaryController::class, 'destroy'])->middleware('auth:sanctum')->name('diaries.destroy');

    Route::get('/{diaryId}/metas/', [DiaryMetaController::class, 'index'])->middleware('auth:sanctum')->name('diarymetas.index');
    Route::post('/{diaryId}/metas/', [DiaryMetaController::class, 'store'])->middleware('auth:sanctum')->name('diarymetas.store');
    Route::get('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'show'])->middleware('auth:sanctum')->name('diarymetas.show');
    Route::put('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'update'])->middleware('auth:sanctum')->name('diarymetas.update');
    Route::delete('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'destroy'])->middleware('auth:sanctum')->name('diarymetas.destroy');
});


//Route::group([
//    "prefix" => "files"
//], function () {
//    Route::get('/', [FileController::class, 'index'])->middleware('auth:sanctum')->name('files.index');
//    Route::post('/', [FileController::class, 'store'])->middleware('auth:sanctum')->name('files.store');
//    Route::get('{FileId}', [FileController::class, 'show'])->middleware('auth:sanctum')->name('files.show');
//    Route::put('{FileId}', [FileController::class, 'update'])->middleware('auth:sanctum')->name('files.update');
//    Route::delete('{FileId}', [FileController::class, 'destroy'])->middleware('auth:sanctum')->name('files.destroy');
//});


Route::group([
    "prefix" => "menus"
], function () {
    Route::get('/', [MenuController::class, 'index'])->middleware('auth:sanctum')->name('menus.index');
    Route::post('/', [MenuController::class, 'store'])->middleware('auth:sanctum')->name('menus.store');
    Route::get('{menuId}', [MenuController::class, 'show'])->middleware('auth:sanctum')->name('menus.show');
    Route::put('{menuId}', [MenuController::class, 'update'])->middleware('auth:sanctum')->name('menus.update');
    Route::delete('{menuId}', [MenuController::class, 'destroy'])->middleware('auth:sanctum')->name('menus.destroy');

    Route::get('/{menuId}/foods/', [MenuFoodController::class, 'index'])->middleware('auth:sanctum')->name('menufoods.index');
    Route::post('/{menuId}/foods/', [MenuFoodController::class, 'store'])->middleware('auth:sanctum')->name('menufoods.store');
    Route::get('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'show'])->middleware('auth:sanctum')->name('menufoods.show');
    Route::put('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'update'])->middleware('auth:sanctum')->name('menufoods.update');
    Route::delete('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'destroy'])->middleware('auth:sanctum')->name('menufoods.destroy');
});


Route::group([
    "prefix" => "prescriptions"
], function () {
    Route::get('/', [PrescriptionController::class, 'index'])->middleware('auth:sanctum')->name('prescriptions.index');
    Route::post('/', [PrescriptionController::class, 'store'])->middleware('auth:sanctum')->name('prescriptions.store');
    Route::get('{prescriptionId}', [PrescriptionController::class, 'show'])->middleware('auth:sanctum')->name('prescriptions.show');
    Route::put('{prescriptionId}', [PrescriptionController::class, 'update'])->middleware('auth:sanctum')->name('prescriptions.update');
    Route::delete('{prescriptionId}', [PrescriptionController::class, 'destroy'])->middleware('auth:sanctum')->name('prescriptions.destroy');

    Route::get('/{prescriptionId}/medicines/', [MedicineController::class, 'index'])->middleware('auth:sanctum')->name('medicines.index');
    Route::post('/{prescriptionId}/medicines/', [MedicineController::class, 'store'])->middleware('auth:sanctum')->name('medicines.store');
    Route::get('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'show'])->middleware('auth:sanctum')->name('medicines.show');
    Route::put('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'update'])->middleware('auth:sanctum')->name('medicines.update');
    Route::delete('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'destroy'])->middleware('auth:sanctum')->name('medicines.destroy');
});


Route::group([
    "prefix" => "specialities"
], function () {
    Route::get('/', [SpecialityController::class, 'index'])->middleware('auth:sanctum')->name('specialities.index');
    Route::post('/', [SpecialityController::class, 'store'])->middleware('auth:sanctum')->name('specialities.store');
    Route::get('{specialityId}', [SpecialityController::class, 'show'])->middleware('auth:sanctum')->name('specialities.show');
    Route::put('{specialityId}', [SpecialityController::class, 'update'])->middleware('auth:sanctum')->name('specialities.update');
    Route::delete('{specialityId}', [SpecialityController::class, 'destroy'])->middleware('auth:sanctum')->name('specialities.destroy');
});


Route::group([
    "prefix" => "users"
], function () {
    Route::get('/', [UserController::class, 'index'])->middleware('auth:sanctum')->name('users.index');
    Route::post('/', [UserController::class, 'store'])->middleware('auth:sanctum')->name('users.store');
    Route::get('{usersId}', [UserController::class, 'show'])->middleware('auth:sanctum')->name('users.show');
    Route::put('{usersId}', [UserController::class, 'update'])->middleware('auth:sanctum')->name('users.update');
    Route::delete('{usersId}', [UserController::class, 'destroy'])->middleware('auth:sanctum')->name('users.destroy');

    Route::get('/{usersId}/remunerations/', [RemunerationController::class, 'index'])->middleware('auth:sanctum')->name('remunerations.index');
    Route::post('/{usersId}/remunerations/', [RemunerationController::class, 'store'])->middleware('auth:sanctum')->name('remunerations.store');
    Route::get('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'show'])->middleware('auth:sanctum')->name('remunerations.show');
    Route::put('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'update'])->middleware('auth:sanctum')->name('remunerations.update');
    Route::delete('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'destroy'])->middleware('auth:sanctum')->name('remunerations.destroy');

    Route::get('/{usersId}/availabilities/', [UserAvailabilityController::class, 'index'])->middleware('auth:sanctum')->name('useravailabilities.index');
    Route::post('/{usersId}/availabilities/', [UserAvailabilityController::class, 'store'])->middleware('auth:sanctum')->name('useravailabilities.store');
    Route::get('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'show'])->middleware('auth:sanctum')->name('useravailabilities.show');
    Route::put('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'update'])->middleware('auth:sanctum')->name('useravailabilities.update');
    Route::delete('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'destroy'])->middleware('auth:sanctum')->name('useravailabilities.destroy');

    Route::get('/{usersId}/metas/', [UserMetaController::class, 'index'])->middleware('auth:sanctum')->name('usermetas.index');
    Route::post('/{usersId}/metas/', [UserMetaController::class, 'store'])->middleware('auth:sanctum')->name('usermetas.store');
    Route::get('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'show'])->middleware('auth:sanctum')->name('usermetas.show');
    Route::put('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'update'])->middleware('auth:sanctum')->name('usermetas.update');
    Route::delete('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'destroy'])->middleware('auth:sanctum')->name('usermetas.destroy');

    Route::get('/{usersId}/specialties/', [UserSpecialityController::class, 'index'])->middleware('auth:sanctum')->name('userspecialties.index');
    Route::post('/{usersId}/specialties/', [UserSpecialityController::class, 'store'])->middleware('auth:sanctum')->name('userspecialties.store');
    Route::get('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'show'])->middleware('auth:sanctum')->name('userspecialties.show');
    Route::put('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'update'])->middleware('auth:sanctum')->name('userspecialties.update');
    Route::delete('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'destroy'])->middleware('auth:sanctum')->name('userspecialties.destroy');
});


Route::group([
    "prefix" => "calendars"
], function () {
    Route::get('/', [CalendarController::class, 'index'])->middleware('auth:sanctum')->name('calendars.index');
    Route::post('/', [CalendarController::class, 'store'])->middleware('auth:sanctum')->name('calendars.store');
    Route::get('{calendarId}', [CalendarController::class, 'show'])->middleware('auth:sanctum')->name('calendars.show');
    Route::put('{calendarId}', [CalendarController::class, 'update'])->middleware('auth:sanctum')->name('calendars.update');
    Route::delete('{calendarId}', [CalendarController::class, 'destroy'])->middleware('auth:sanctum')->name('calendars.destroy');
});
