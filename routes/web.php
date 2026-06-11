<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;

Route::get('/', [ExamController::class, 'index'])->name('exam.index');
Route::post('/submit', [ExamController::class, 'submit'])->name('exam.submit');
