<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataAdminController;

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
    return view('pages.home');
});


// GetData
Route::get('faculty', [DataAdminController::class, 'fetchData'])->name('faculty');
Route::get('program', [DataAdminController::class, 'fetchProgram'])->name('program');
Route::get('student', [DataAdminController::class, 'fetchStudent'])->name('student');
Route::get('vaccine', [DataAdminController::class, 'fetchVaccine'])->name('vaccine');
Route::get('vaccinerecord', [DataAdminController::class, 'fetchVaccineRecord'])->name('vaccinerecord');
Route::get('chartvaccine', [DataAdminController::class, 'chartvaccine'])->name('chartvaccine');

// FormData
Route::get('/facultyform', function() {return view('forms.facultyForm');});
Route::post('/facultyAddData', [DataAdminController::class, 'addFaculty'])->name('facultyAddData');
Route::get('/programform', function() {return view('forms.programForm');});
Route::get('/programform', [DataAdminController::class, 'fetchProgramId'])->name('programform');
Route::post('/programAddData', [DataAdminController::class, 'addProgram'])->name('programAddData');
Route::get('/studentform', function() {return view('forms.studentForm');});
Route::get('/studentform', [DataAdminController::class, 'fetchStudentId']);
Route::post('/studentAddData', [DataAdminController::class, 'addStudent'])->name('studentAddData');
Route::get('/vaccineform', function() {return view('forms.vaccineForm');});
Route::post('/vaccineAddData', [DataAdminController::class, 'addVaccine'])->name('vaccineAddData');
Route::get('/vaccinerecordform', function() {return view('forms.vaccinerecordForm');});
Route::get('/vaccinerecordform', [DataAdminController::class, 'fetchVaccineRecordId'])->name('vaccinerecordform');
Route::post('/vaccinerecordAddData', [DataAdminController::class, 'vaccinerecordAddData'])->name('vaccinerecordAddData');

// Edit and Update for data
Route::get('/editFaculty/{id}', [DataAdminController::class, 'editFaculty'])->name('editFaculty');
Route::get('/facultyEdit', function() {return view('edits.facultyEdit');});
Route::post('/facultyUpdateData/{id}', [DataAdminController::class, 'facultyUpdateData'])->name('facultyUpdateData');
Route::get('editProgram/{id}', [DataAdminController::class, 'editProgram'])->name('editProgram');
Route::post('/programUpdateDate/{id}', [DataAdminController::class, 'programUpdateDate'])->name('programUpdateDate');
Route::get('/editStudent/{id}', [DataAdminController::class, 'editStudent'])->name('editStudent');
Route::post('/studentUpdateData/{id}', [DataAdminController::class, 'studentUpdateData'])->name('studentUpdateData');
Route::get('/editVaccine/{id}', [DataAdminController::class, 'editVaccine'])->name('editVaccine');
Route::post('/vaccineUpdateData/{id}', [DataAdminController::class, 'vaccineUpdateData'])->name('vaccineUpdateData');
Route::get('/editVaccineRecord/{id}', [DataAdminController::class, 'editVaccineRecord'])->name('editVaccineRecord');
Route::post('/vaccinerecordUpdateData/{id}', [DataAdminController::class, 'vaccinerecordUpdateData'])->name('vaccinerecordUpdateData');

// Delete Data
Route::get('deleteFaculty/{id}', [DataAdminController::class, 'deleteFaculty'])->name('deleteFaculty');
Route::get('deleteProgram/{id}', [DataAdminController::class, 'deleteProgram'])->name('deleteProgram');
Route::get('deleteStudent/{id}', [DataAdminController::class, 'deleteStudent'])->name('deleteStudent');
Route::get('deleteVaccine/{id}', [DataAdminController::class, 'deleteVaccine'])->name('deleteVaccine');
Route::get('deleteVaccineRecord/{id}', [DataAdminController::class, 'deleteVaccineRecord'])->name('deleteVaccineRecord');
