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
    Route::get('/', [AnamnesisController::class, 'index'])->name('anamnesis.index');
    Route::post('/', [AnamnesisController::class, 'store'])->name('anamnesis.store');
    Route::get('{anamnesisId}', [AnamnesisController::class, 'show'])->name('anamnesis.show');
    Route::put('{anamnesisId}', [AnamnesisController::class, 'update'])->name('anamnesis.update');
    Route::delete('{anamnesisId}', [AnamnesisController::class, 'destroy'])->name('anamnesis.destroy');

    Route::get('/{anamnesisId}/metas', [AnamnesisMetaController::class, 'index'])->name('anamnesismetas.index');
    Route::post('/{anamnesisId}/metas', [AnamnesisMetaController::class, 'store'])->name('anamnesismetas.store');
    Route::get('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'show'])->name('anamnesismetas.show');
    Route::put('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'update'])->name('anamnesismetas.update');
    Route::delete('/{anamnesisId}/metas/{anamnesisMetaId}', [AnamnesisMetaController::class, 'destroy'])->name('anamnesismetas.destroy');
});


Route::group([
    "prefix" => "anamnesis-questions"
], function () {
    Route::get('/', [AnamnesisQuestionsController::class, 'index'])->name('anamnesisquestions.index');
    Route::post('/', [AnamnesisQuestionsController::class, 'store'])->name('anamnesisquestions.store');
    Route::get('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'show'])->name('anamnesisquestions.show');
    Route::put('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'update'])->name('anamnesisquestions.update');
    Route::delete('/{anamnesisQuestionId}', [AnamnesisQuestionsController::class, 'destroy'])->name('anamnesisquestions.destroy');

    Route::get('/{anamnesisQuestionId}/answers', [AnamnesisAnswersController::class, 'index'])->name('anamnesisanswers.index');
    Route::post('/{anamnesisQuestionId}/answers', [AnamnesisAnswersController::class, 'store'])->name('anamnesisanswers.store');
    Route::get('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'show'])->name('anamnesisanswers.show');
    Route::put('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'update'])->name('anamnesisanswers.update');
    Route::delete('/{anamnesisQuestionId}/answers/{anamnesisQuestionAnswerId}', [AnamnesisAnswersController::class, 'destroy'])->name('anamnesisanswers.destroy');
});

Route::group([
    "prefix" => "attendances"
], function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('{attendanceId}', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::put('{attendanceId}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('{attendanceId}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');

    Route::get('/{attendanceId}/details/', [AttendanceDetailsController::class, 'index'])->name('attendancedetails.index');
    Route::post('/{attendanceId}/details/', [AttendanceDetailsController::class, 'store'])->name('attendancedetails.store');
    Route::get('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'show'])->name('attendancedetails.show');
    Route::put('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'update'])->name('attendancedetails.update');
    Route::delete('/{attendanceId}/details/{attendanceDetailId}', [AttendanceDetailsController::class, 'destroy'])->name('attendancedetails.destroy');

    Route::get('/{attendanceId}/files/', [AttendanceFileController::class, 'index'])->name('attendancefiles.index');
    Route::post('/{attendanceId}/files/', [AttendanceFileController::class, 'store'])->name('attendancefiles.store');
    Route::get('/{attendanceId}/files/{attendanceFileId}', [AttendanceFileController::class, 'show'])->name('attendancefiles.show');
    Route::delete('/{attendanceId}/files/{attendanceFileId}', [AttendanceFileController::class, 'destroy'])->name('attendancefiles.destroy');
});


Route::group([
    "prefix" => "diaries"
], function () {
    Route::get('/feelings', [DiaryController::class, 'feelings'])->name('diaries.feelings');
    Route::get('/', [DiaryController::class, 'index'])->name('diaries.index');
    Route::post('/', [DiaryController::class, 'store'])->name('diaries.store');
    Route::get('{diaryId}', [DiaryController::class, 'show'])->name('diaries.show');
    Route::put('{diaryId}', [DiaryController::class, 'update'])->name('diaries.update');
    Route::delete('{diaryId}', [DiaryController::class, 'destroy'])->name('diaries.destroy');

    Route::get('/{diaryId}/metas/', [DiaryMetaController::class, 'index'])->name('diarymetas.index');
    Route::post('/{diaryId}/metas/', [DiaryMetaController::class, 'store'])->name('diarymetas.store');
    Route::get('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'show'])->name('diarymetas.show');
    Route::put('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'update'])->name('diarymetas.update');
    Route::delete('/{diaryId}/metas/{diaryMetaId}', [DiaryMetaController::class, 'destroy'])->name('diarymetas.destroy');
});


//Route::group([
//    "prefix" => "files"
//], function () {
//    Route::get('/', [FileController::class, 'index'])->name('files.index');
//    Route::post('/', [FileController::class, 'store'])->name('files.store');
//    Route::get('{FileId}', [FileController::class, 'show'])->name('files.show');
//    Route::put('{FileId}', [FileController::class, 'update'])->name('files.update');
//    Route::delete('{FileId}', [FileController::class, 'destroy'])->name('files.destroy');
//});


Route::group([
    "prefix" => "menus"
], function () {
    Route::get('/', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('{menuId}', [MenuController::class, 'show'])->name('menus.show');
    Route::put('{menuId}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('{menuId}', [MenuController::class, 'destroy'])->name('menus.destroy');

    Route::get('/{menuId}/foods/', [MenuFoodController::class, 'index'])->name('menufoods.index');
    Route::post('/{menuId}/foods/', [MenuFoodController::class, 'store'])->name('menufoods.store');
    Route::get('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'show'])->name('menufoods.show');
    Route::put('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'update'])->name('menufoods.update');
    Route::delete('/{menuId}/foods/{menuFoodId}', [MenuFoodController::class, 'destroy'])->name('menufoods.destroy');
});


Route::group([
    "prefix" => "prescriptions"
], function () {
    Route::get('/', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::post('/', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('{prescriptionId}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
    Route::put('{prescriptionId}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
    Route::delete('{prescriptionId}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');

    Route::get('/{prescriptionId}/medicines/', [MedicineController::class, 'index'])->name('medicines.index');
    Route::post('/{prescriptionId}/medicines/', [MedicineController::class, 'store'])->name('medicines.store');
    Route::get('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'show'])->name('medicines.show');
    Route::put('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/{prescriptionId}/medicines/{prescriptionMedicineId}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
});


Route::group([
    "prefix" => "specialities"
], function () {
    Route::get('/', [SpecialityController::class, 'index'])->name('specialities.index');
    Route::post('/', [SpecialityController::class, 'store'])->name('specialities.store');
    Route::get('{specialityId}', [SpecialityController::class, 'show'])->name('specialities.show');
    Route::put('{specialityId}', [SpecialityController::class, 'update'])->name('specialities.update');
    Route::delete('{specialityId}', [SpecialityController::class, 'destroy'])->name('specialities.destroy');
});


Route::group([
    "prefix" => "users"
], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('{usersId}', [UserController::class, 'show'])->name('users.show');
    Route::put('{usersId}', [UserController::class, 'update'])->name('users.update');
    Route::delete('{usersId}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/{usersId}/remunerations/', [RemunerationController::class, 'index'])->name('remunerations.index');
    Route::post('/{usersId}/remunerations/', [RemunerationController::class, 'store'])->name('remunerations.store');
    Route::get('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'show'])->name('remunerations.show');
    Route::put('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'update'])->name('remunerations.update');
    Route::delete('/{usersId}/remunerations/{userRemunerationId}', [RemunerationController::class, 'destroy'])->name('remunerations.destroy');

    Route::get('/{usersId}/availabilities/', [UserAvailabilityController::class, 'index'])->name('useravailabilities.index');
    Route::post('/{usersId}/availabilities/', [UserAvailabilityController::class, 'store'])->name('useravailabilities.store');
    Route::get('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'show'])->name('useravailabilities.show');
    Route::put('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'update'])->name('useravailabilities.update');
    Route::delete('/{usersId}/availabilities/{userAvailabilityId}', [UserAvailabilityController::class, 'destroy'])->name('useravailabilities.destroy');

    Route::get('/{usersId}/metas/', [UserMetaController::class, 'index'])->name('usermetas.index');
    Route::post('/{usersId}/metas/', [UserMetaController::class, 'store'])->name('usermetas.store');
    Route::get('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'show'])->name('usermetas.show');
    Route::put('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'update'])->name('usermetas.update');
    Route::delete('/{usersId}/metas/{userMetaId}', [UserMetaController::class, 'destroy'])->name('usermetas.destroy');

    Route::get('/{usersId}/specialties/', [UserSpecialityController::class, 'index'])->name('userspecialties.index');
    Route::post('/{usersId}/specialties/', [UserSpecialityController::class, 'store'])->name('userspecialties.store');
    Route::get('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'show'])->name('userspecialties.show');
    Route::put('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'update'])->name('userspecialties.update');
    Route::delete('/{usersId}/specialties/{userSpecialtyId}', [UserSpecialityController::class, 'destroy'])->name('userspecialties.destroy');
});


Route::group([
    "prefix" => "calendars"
], function () {
    Route::get('/', [CalendarController::class, 'index'])->name('calendars.index');
    Route::post('/', [CalendarController::class, 'store'])->name('calendars.store');
    Route::get('{calendarId}', [CalendarController::class, 'show'])->name('calendars.show');
    Route::put('{calendarId}', [CalendarController::class, 'update'])->name('calendars.update');
    Route::delete('{calendarId}', [CalendarController::class, 'destroy'])->name('calendars.destroy');
});
