<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------
// ベースページ
// -------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/global-top', [HomeController::class, 'platform'])->name('global-top');
Route::get('/laravel/top', [HomeController::class, 'laravel'])->name('laravel-top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// -------------------------------------------------
// レッスンページ（初級）
// -------------------------------------------------
Route::prefix('beginner')->group(function () {
    Route::view('/lesson00', 'lessons.lesson00')->name('lesson00');
    Route::view('/lesson01', 'lessons.lesson01')->name('lesson01');
    Route::view('/lesson02', 'lessons.lesson02')->name('lesson02');
    Route::view('/lesson03', 'lessons.lesson03')->name('lesson03');
    Route::view('/lesson04', 'lessons.lesson04')->name('lesson04');
    Route::view('/lesson05', 'lessons.lesson05')->name('lesson05');
    Route::view('/lesson06', 'lessons.lesson06')->name('lesson06');
    Route::view('/lesson07', 'lessons.lesson07')->name('lesson07');
    Route::view('/lesson08', 'lessons.lesson08')->name('lesson08');
    Route::view('/lesson09', 'lessons.lesson09')->name('lesson09');
    Route::view('/lesson10', 'lessons.lesson10')->name('lesson10');
});

// -------------------------------------------------
// 演習ページ（初級）
// -------------------------------------------------
Route::prefix('beginner/exercises')->name('exercises.')->group(function () {
    Route::view('/lesson00', 'exercises.lesson00')->name('lesson00');
    Route::view('/lesson01', 'exercises.lesson01')->name('lesson01');
    Route::view('/lesson02', 'exercises.lesson02')->name('lesson02');
    Route::view('/lesson03', 'exercises.lesson03')->name('lesson03');
    Route::view('/lesson04', 'exercises.lesson04')->name('lesson04');
    Route::view('/lesson05', 'exercises.lesson05')->name('lesson05');
    Route::view('/lesson06', 'exercises.lesson06')->name('lesson06');
    Route::view('/lesson07', 'exercises.lesson07')->name('lesson07');
    Route::view('/lesson08', 'exercises.lesson08')->name('lesson08');
    Route::view('/lesson09', 'exercises.lesson09')->name('lesson09');
    Route::view('/lesson10', 'exercises.lesson10')->name('lesson10');
});

// 既存 URL 互換リダイレクト
Route::redirect('/lesson00', '/beginner/lesson00', 301);
Route::redirect('/lesson01', '/beginner/lesson01', 301);
Route::redirect('/lesson02', '/beginner/lesson02', 301);
Route::redirect('/lesson03', '/beginner/lesson03', 301);
Route::redirect('/lesson04', '/beginner/lesson04', 301);
Route::redirect('/lesson05', '/beginner/lesson05', 301);
Route::redirect('/lesson06', '/beginner/lesson06', 301);
Route::redirect('/lesson07', '/beginner/lesson07', 301);
Route::redirect('/lesson08', '/beginner/lesson08', 301);
Route::redirect('/lesson09', '/beginner/lesson09', 301);
Route::redirect('/lesson10', '/beginner/lesson10', 301);

Route::redirect('/exercises/lesson00', '/beginner/exercises/lesson00', 301);
Route::redirect('/exercises/lesson01', '/beginner/exercises/lesson01', 301);
Route::redirect('/exercises/lesson02', '/beginner/exercises/lesson02', 301);
Route::redirect('/exercises/lesson03', '/beginner/exercises/lesson03', 301);
Route::redirect('/exercises/lesson04', '/beginner/exercises/lesson04', 301);
Route::redirect('/exercises/lesson05', '/beginner/exercises/lesson05', 301);
Route::redirect('/exercises/lesson06', '/beginner/exercises/lesson06', 301);
Route::redirect('/exercises/lesson07', '/beginner/exercises/lesson07', 301);
Route::redirect('/exercises/lesson08', '/beginner/exercises/lesson08', 301);
Route::redirect('/exercises/lesson09', '/beginner/exercises/lesson09', 301);
Route::redirect('/exercises/lesson10', '/beginner/exercises/lesson10', 301);

// -------------------------------------------------
// 認証後ページ
// -------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
