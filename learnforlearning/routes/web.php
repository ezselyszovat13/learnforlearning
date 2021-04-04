<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\TeacherController;

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
Route::get('/personal', [UserController::class, 'show'])->name('personal')->middleware('auth');
Route::get('/subjects', [SubjectController::class, 'showAll'])->name('subjects');
Route::get('/subjects/{id}', [SubjectController::class,'showSubject'])->name('subjects.info');
Route::get('/newsubject', [SubjectController::class, 'givenSubjects'])->name('newsubject')->middleware('auth');
Route::get('/findsubject', [SubjectController::class, 'showFind'])->name('findsubject')->middleware('auth');
Route::post('/subjects/add', [SubjectController::class, 'addNewGrade'])->name('subject.add')->middleware('auth');
Route::get('/newsubject/{id}/edit', [SubjectController::class, 'editGivenGrade'])->name('newsubject.edit')->middleware('auth');
Route::post('/newsubject/{id}/update', [SubjectController::class, 'updateGivenGrade'])->name('newsubject.update')->middleware('auth');
Route::get('/personal/{id}/edit', [UserController::class, 'editSpecialization'])->name('spec.edit')->middleware('auth');
Route::post('/personal/{id}/update', [UserController::class, 'updateSpecialization'])->name('spec.update')->middleware('auth');
Route::post('/findsubject/calculate', [CalculateController::class,'calculateOptional'])->name('calculate')->middleware('auth');
Route::get('/findsubject/delete', [UserController::class, 'deleteCalculations'])->name('findsubject.delete')->middleware('auth');
Route::get('/subject/vote/', [UserController::class, 'vote'])->name('user.vote')->middleware('auth');
Route::get('/subject/comment/', [UserController::class, 'comment'])->name('user.comment')->middleware('auth');
Route::post('/subject/comment/update', [UserController::class, 'commentUpdate'])->name('user.comment.update')->middleware('auth');
Route::get('/subject/{id}/comments', [TeacherController::class, 'comments'])->name('teacher.comments');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
