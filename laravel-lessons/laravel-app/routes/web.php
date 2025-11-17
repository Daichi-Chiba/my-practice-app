<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonPageController;
use App\Http\Controllers\ProfileController;
use App\Support\CurriculumCatalog;
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
/**
 * 初級レッスン／演習ルートを CurriculumCatalog から自動生成
 * - lessonXX / exercises.lessonXX など既存のルート名を維持
 * - /lessonXX など旧 URL からのアクセスは 301 で新ルートへリダイレクト
 */
$curriculumTiers = CurriculumCatalog::all()->keyBy('slug');

$lessonZeroRoute = Route::get('/beginner/lesson00', [LessonPageController::class, 'showLesson'])
    ->defaults('number', '00')
    ->defaults('tier', 'beginner')
    ->name('lesson00');

Route::get('/beginner/exercises/lesson00', [LessonPageController::class, 'showExercise'])
    ->defaults('number', '00')
    ->defaults('tier', 'beginner')
    ->name('exercises.lesson00');

Route::get('/lesson00', function () {
    return redirect()->route('lesson00', ['number' => '00'], 301);
});

Route::get('/exercises/lesson00', function () {
    return redirect()->route('exercises.lesson00', ['number' => '00'], 301);
});

$beginnerLessons = optional($curriculumTiers->get('beginner'))['lessons'] ?? [];

foreach ($beginnerLessons as $lesson) {
    $number = str_pad((string) ($lesson['number'] ?? ''), 2, '0', STR_PAD_LEFT);

    if ($number === '') {
        continue;
    }

    $lessonRouteName = $lesson['route'] ?? ('lesson' . $number);
    $exerciseRouteName = $lesson['exercise_route'] ?? ('exercises.lesson' . $number);

    // レッスンページ本体
    Route::get('/beginner/lesson' . $number, [LessonPageController::class, 'showLesson'])
        ->defaults('number', $number)
        ->defaults('tier', 'beginner')
        ->name($lessonRouteName);

    // 演習ページ本体
    Route::get('/beginner/exercises/lesson' . $number, [LessonPageController::class, 'showExercise'])
        ->defaults('number', $number)
        ->defaults('tier', 'beginner')
        ->name($exerciseRouteName);

    // 旧 URL (/lessonXX) からのリダイレクト
    Route::get('/lesson' . $number, function () use ($lessonRouteName, $number) {
        return redirect()->route($lessonRouteName, ['number' => $number], 301);
    });

    // 旧 URL (/exercises/lessonXX) からのリダイレクト
    Route::get('/exercises/lesson' . $number, function () use ($exerciseRouteName, $number) {
        return redirect()->route($exerciseRouteName, ['number' => $number], 301);
    });
}

// -------------------------------------------------
// レッスンページ（中級・上級など）
// -------------------------------------------------
foreach ($curriculumTiers as $tier) {
    $tierSlug = $tier['slug'] ?? null;

    if (blank($tierSlug) || $tierSlug === 'beginner') {
        continue;
    }

    $lessons = $tier['lessons'] ?? [];

    foreach ($lessons as $lesson) {
        $number = str_pad((string) ($lesson['number'] ?? ''), 2, '0', STR_PAD_LEFT);

        if ($number === '') {
            continue;
        }

        $lessonRouteName = $lesson['route'] ?? ($tierSlug . '.lesson' . $number);
        $exerciseRouteName = $lesson['exercise_route'] ?? ($tierSlug . '.exercises.lesson' . $number);

        Route::get('/' . $tierSlug . '/lesson' . $number, [LessonPageController::class, 'showLesson'])
            ->defaults('number', $number)
            ->defaults('tier', $tierSlug)
            ->name($lessonRouteName);

        Route::get('/' . $tierSlug . '/exercises/lesson' . $number, [LessonPageController::class, 'showExercise'])
            ->defaults('number', $number)
            ->defaults('tier', $tierSlug)
            ->name($exerciseRouteName);
    }
}

// -------------------------------------------------
// 認証後ページ
// -------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
