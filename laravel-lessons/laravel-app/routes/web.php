<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------
// ベースページ
// -------------------------------------------------
Route::view('/', 'home')->name('home');

// -------------------------------------------------
// レッスンページ
// -------------------------------------------------
Route::view('/lesson00', 'lessons.lesson00')->name('lesson00');
Route::view('/lesson01', 'lessons.lesson01_modern')->name('lesson01');
Route::view('/lesson02', 'lessons.lesson02_modern')->name('lesson02');
Route::view('/lesson03', 'lessons.lesson03_modern')->name('lesson03');
Route::view('/lesson04', 'lessons.lesson04')->name('lesson04');
Route::view('/lesson05', 'lessons.lesson05_modern')->name('lesson05');
Route::view('/lesson06', 'lessons.lesson06')->name('lesson06');
Route::view('/lesson07', 'lessons.lesson07')->name('lesson07');
Route::view('/lesson08', 'lessons.lesson08')->name('lesson08');
Route::view('/lesson09', 'lessons.lesson09')->name('lesson09');
Route::view('/lesson10', 'lessons.lesson10')->name('lesson10');

// -------------------------------------------------
// 演習ページ
// -------------------------------------------------
Route::prefix('exercises')->name('exercises.')->group(function () {
    Route::view('/lesson00', 'exercises.lesson00')->name('lesson00');
    Route::view('/lesson01', 'exercises.lesson01')->name('lesson01');
    Route::view('/lesson02', 'exercises.lesson02')->name('lesson02');
    Route::view('/lesson03', 'exercises.lesson03')->name('lesson03');
    Route::view('/lesson04', 'exercises.lesson04')->name('lesson04');
    Route::view('/lesson05', 'exercises.lesson05')->name('lesson05');
});

// -------------------------------------------------
// デモ / サンプルルート
// -------------------------------------------------
Route::get('/hello', fn () => 'Hello, Laravel!')->name('hello');

Route::get('/user/{id}', fn ($id) => "ユーザーID: {$id}")
    ->where('id', '[0-9]+')
    ->name('user.show');

Route::get('/user/{name}', fn ($name) => "ユーザー名: {$name}")
    ->where('name', '[A-Za-z]+')
    ->name('user.name');

Route::get('/greeting/{name?}', fn ($name = 'ゲスト') => "こんにちは、{$name}さん")
    ->name('greeting');

Route::get('/post/{category}/{id}', fn ($category, $id) => "カテゴリ: {$category}, 記事ID: {$id}")
    ->where(['category' => '[a-z]+', 'id' => '[0-9]+'])
    ->name('post.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => 'Admin Dashboard')->name('dashboard');
    Route::get('/users', fn () => 'Admin Users')->name('users');
    Route::get('/settings', fn () => 'Admin Settings')->name('settings');
});

// -------------------------------------------------
// コントローラーサンプル
// -------------------------------------------------
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::resource('posts', PostController::class);
