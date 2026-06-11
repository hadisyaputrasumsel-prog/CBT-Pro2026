<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AdminController;

Route::get('/', [ExamController::class, 'welcome'])->name('exam.welcome');
Route::post('/start', [ExamController::class, 'start'])->name('exam.start');
Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');
Route::post('/submit', [ExamController::class, 'submit'])->name('exam.submit');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
