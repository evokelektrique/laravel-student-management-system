<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\StudentController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('upload-form', [ExcelController::class, 'uploadForm'])->name('uploadForm');
    Route::post('import', [ExcelController::class, 'import'])->name('import');
});

Route::group(['prefix' => 'students', 'as' => 'student.', 'middleware' => ['auth']], function () {
    Route::get('/', [StudentController::class, 'index'])->name('index')->middleware(['admin']);
    Route::get('/{student}', [StudentController::class, 'show'])->name('show')->middleware(['admin']);
    Route::get('/{user}/download_certificate', [StudentController::class, 'download_certificate'])->name('download_certificate');
});
Route::group(['prefix' => 'courses', 'as' => 'course.', 'middleware' => ['auth']], function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{student}/courses', [CourseController::class, 'studentCourses'])->name('studentCourses');
});
