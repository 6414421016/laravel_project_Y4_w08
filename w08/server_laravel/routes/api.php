<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacultyAPIController;
use App\Http\Controllers\ProgramAPIController;
use App\Http\Controllers\StudentAPIController;
use App\Http\Controllers\VaccineAPIController;
use App\Http\Controllers\VaccineRecordAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//get data public
Route::get('/faculty', [FacultyAPIController::class, 'index']);
Route::get('/program', [ProgramAPIController::class, 'index']);
Route::get('/student', [StudentAPIController::class, 'index']);
Route::get('/vaccine', [VaccineApiController::class, 'index']);
Route::get('/vaccinerecord', [VaccineRecordAPIController::class, 'index']);

//get data id public 
Route::get('/faculty/{id}', [FacultyAPIController::class, 'show']);
Route::get('/program/{id}', [ProgramAPIController::class, 'show']);
Route::get('/student/{id}', [StudentAPIController::class, 'show']);
Route::get('/vaccine/{id}', [VaccineApiController::class, 'show']);
Route::get('/vaccinerecord/{id}', [VaccineRecordAPIController::class, 'show']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/vaccine', [VaccineApiController::class, 'store']);
    Route::put('/vaccine/{id}', [VaccineApiController::class, 'update']);
    Route::delete('/vaccine/{id}', [VaccineApiController::class, 'destroy']);

    Route::post('/student', [StudentApiController::class, 'store']);
    Route::put('/student/{id}', [StudentApiController::class, 'update']);
    Route::delete('/student/{id}', [StudentApiController::class, 'destroy']);

    Route::post('/faculty', [FacultyApiController::class, 'store']);
    Route::put('/faculty/{id}', [FacultyApiController::class, 'update']);
    Route::delete('/faculty/{id}', [FacultyApiController::class, 'destroy']);

    Route::post('/program', [ProgramApiController::class, 'store']);
    Route::put('/program/{id}', [ProgramApiController::class, 'update']);
    Route::delete('/program/{id}', [ProgramApiController::class, 'destroy']);

    Route::post('/vaccinerecord', [VaccineRecordApiController::class, 'store']);
    Route::put('/vaccinerecord/{id}', [VaccineRecordApiController::class, 'update']);
    Route::delete('/vaccinerecord/{id}', [VaccineRecordApiController::class, 'destroy']);
});


// Route::resource('/students', StudentAPIController::class);
// Route::resource('/faculty', FacultyAPIController::class);
// Route::resource('/programs', ProgramAPIController::class);
// Route::resource('/vaccines', VaccineAPIController::class);
// Route::resource('/vaccinerecord', VaccineAPIController::class);