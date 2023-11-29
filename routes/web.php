<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests as Precognition;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
    Route::get('criar-escola', [SchoolController::class, 'create'])->name('school.create');
    Route::post('criar-escola', [SchoolController::class,'store'])->name('store.create')->middleware([Precognition::class]);
    Route::get('escolas', [SchoolController::class, 'schools'])->name('schools');
;
    Route::get('criar-turmas', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('criar-turmas', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::get('turmas', [ClassroomController::class, 'classrooms'])->name('classrooms');
    Route::get('editar-turma/{id}', [ClassroomController::class, 'edit'])->name('classroom.edit');

    Route::get('criar-alunos', [StudentController::class, 'create'])->name('student.create');
    Route::post('criar-alunos', [StudentController::class,'store'])->name('student.store')->middleware([Precognition::class]);
    Route::get('alunos', [StudentController::class,'students'])->name('students');
});
