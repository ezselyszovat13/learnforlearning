<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;

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

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/personal', [UserController::class, 'show'])->name('personal');
Route::get('/subjects', [SubjectController::class, 'showAll'])->name('subjects');
Route::get('/newsubject', [SubjectController::class, 'givenSubjects'])->name('newsubject');
Route::get('/findsubject', [SubjectController::class, 'showFind'])->name('findsubject');
Route::post('/subjects/add', [SubjectController::class, 'addNewGrade'])->name('subject.add')->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
