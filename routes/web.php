<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubmissionController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes();
// //Language Translation
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/', [LoginController::class, 'showLoginForm'])->middleware('guest');
Route::get('/index', [LoginController::class, 'showLoginForm'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'registerForm'])->middleware('guest')->name('register');

Route::get('/dashboard/dosen', [DashboardController::class, 'lecturer'])->middleware(['auth', 'session.expired']);
Route::get('/dashboard/mahasiswa', [DashboardController::class, 'student'])->middleware(['auth', 'session.expired']);

Route::get('/course', [CourseController::class, 'index'])->middleware(['auth', 'session.expired']);
Route::get('/course-student', [CourseController::class, 'indexStudent'])->middleware(['auth', 'session.expired']);

Route::get('/assignment', [AssignmentController::class, 'index'])->middleware(['auth', 'session.expired']);
Route::post('/assignment/add', [AssignmentController::class, 'store'])->middleware(['auth', 'session.expired']);
Route::put('/assignment/delete/{id}', [AssignmentController::class, 'destroy'])->middleware(['auth', 'session.expired']);
Route::put('/assignment/update/{id}', [AssignmentController::class, 'update'])->middleware(['auth', 'session.expired']);
Route::get('/assignment/collected/{id}', [AssignmentController::class, 'show'])->middleware(['auth', 'session.expired']);

Route::get('/grade', [GradeController::class, 'index'])->middleware(['auth', 'session.expired']);

Route::get('/assignment/upload/{id}', [AssignmentController::class, 'formUpload'])->middleware(['auth', 'session.expired']);

Route::post('/submission/add', [SubmissionController::class, 'store'])->middleware(['auth', 'session.expired']);
