<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AdminController;

Route::get('/', [ExamController::class, 'welcome'])->name('exam.welcome');
Route::post('/start', [ExamController::class, 'start'])->name('exam.start');
Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');
Route::post('/submit', [ExamController::class, 'submit'])->name('exam.submit');
Route::post('/submit-tab', [ExamController::class, 'submitTab'])->name('exam.submit_tab');
Route::post('/finish', [ExamController::class, 'finishExam'])->name('exam.finish');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/settings/toggle-kunci', [AdminController::class, 'toggleKunciJawaban'])->name('admin.settings.toggle');
Route::post('/admin/settings/waktu-soal', [AdminController::class, 'updateWaktuSoal'])->name('admin.settings.waktu');
Route::post('/admin/gemini-prompt', [AdminController::class, 'getGeminiPrompt'])->name('admin.gemini.prompt');
Route::post('/admin/import-gemini', [AdminController::class, 'importGeminiJson'])->name('admin.import.gemini');
Route::put('/admin/question/{id}', [AdminController::class, 'updateQuestion'])->name('admin.question.update');
Route::delete('/admin/question/{id}', [AdminController::class, 'deleteQuestion'])->name('admin.question.delete');
Route::delete('/admin/questions/bulk', [AdminController::class, 'bulkDeleteQuestions'])->name('admin.questions.bulk_delete');
