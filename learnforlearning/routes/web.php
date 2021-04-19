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
Route::get('/fixable', [MainController::class, 'showFixables'])->name('fixable');
Route::post('/fixable/activity', [MainController::class, 'goAgainst'])->name('fixable.activity')->middleware('auth');
Route::post('/fixable/newTeacher', [MainController::class, 'recommendTeacher'])->name('fixable.newteacher')->middleware('auth');
Route::post('/fixable/newSubject', [MainController::class, 'recommendSubject'])->name('fixable.newsubject')->middleware('auth');
Route::get('/manage', [MainController::class, 'showRequests'])->name('manage')->middleware('can:manage');
Route::get('/manage/changeActivity', [MainController::class, 'changeTeacherActivity'])->name('manage.changeActivity')->middleware('auth')->middleware('can:manage');
Route::get('/manage/addTeacher', [MainController::class, 'addTeacher'])->name('manage.addTeacher')->middleware('auth')->middleware('can:manage');
Route::get('/manage/addSubject', [MainController::class, 'addSubject'])->name('manage.addSubject')->middleware('auth')->middleware('can:manage');
Route::get('/manage/resetAgainstActivity', [MainController::class, 'resetAgainstActivity'])->name('manage.resetAgainstActivity')->middleware('auth')->middleware('can:manage');
Route::get('/manage/deleteTeacher', [MainController::class, 'deleteTeacher'])->name('manage.deleteTeacher')->middleware('auth')->middleware('can:manage');
Route::get('/manage/deleteSubject', [MainController::class, 'deleteSubject'])->name('manage.deleteSubject')->middleware('auth')->middleware('can:manage');

Route::get('/subjects', [SubjectController::class, 'showAll'])->name('subjects');
Route::get('/subjects/{id}', [SubjectController::class,'showSubject'])->name('subjects.info');
Route::get('/newsubject', [SubjectController::class, 'givenSubjects'])->name('newsubject')->middleware('auth');
Route::get('/findsubject', [SubjectController::class, 'showFind'])->name('findsubject')->middleware('auth');
Route::get('/newsubject/{id}/edit', [SubjectController::class, 'editGivenGrade'])->name('newsubject.edit')->middleware('auth');
Route::post('/subjects/add', [SubjectController::class, 'addNewGrade'])->name('subject.add')->middleware('auth');
Route::post('/newsubject/{id}/update', [SubjectController::class, 'updateGivenGrade'])->name('newsubject.update')->middleware('auth');

Route::get('/personal', [UserController::class, 'show'])->name('personal')->middleware('auth');
Route::get('/personal/{id}/edit', [UserController::class, 'editSpecialization'])->name('spec.edit')->middleware('auth');
Route::get('/subject/comment/delete', [UserController::class, 'deleteComment'])->name('delete.comment')->middleware('auth');
Route::get('/personal/comment/delete', [UserController::class, 'personalDeleteComment'])->name('personal.delete.comment')->middleware('auth');
Route::get('/findsubject/delete', [UserController::class, 'deleteCalculations'])->name('findsubject.delete')->middleware('auth');
Route::get('/subject/vote/', [UserController::class, 'vote'])->name('user.vote')->middleware('auth');
Route::get('/personal/vote/', [UserController::class, 'personalVote'])->name('personal.vote')->middleware('auth');
Route::get('/subject/comment/', [UserController::class, 'comment'])->name('user.comment')->middleware('auth');
Route::post('/personal/{id}/update', [UserController::class, 'updateSpecialization'])->name('spec.update')->middleware('auth');
Route::post('/subject/comment/update', [UserController::class, 'commentUpdate'])->name('user.comment.update')->middleware('auth');

Route::post('/findsubject/calculate', [CalculateController::class,'calculateOptional'])->name('calculate')->middleware('auth');

Route::get('/subject/{id}/comments', [TeacherController::class, 'comments'])->name('teacher.comments');

Route::get('/offline', function () { return view('offline');});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
