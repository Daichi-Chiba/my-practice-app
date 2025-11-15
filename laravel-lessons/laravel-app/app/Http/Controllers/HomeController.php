<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home', $this->buildDashboardData($request));
    }

    public function platform(Request $request)
    {
        $dashboardData = $this->buildDashboardData($request);

        $platformCatalog = collect(config('platform_catalog', []))
            ->map(function (array $track) {
                $status = $track['status'] ?? 'available';
                $ctaLabel = $track['cta_label'] ?? '詳細を見る';

                $ctaUrl = null;
                $isExternal = false;
                if (!empty($track['cta_route']) && Route::has($track['cta_route'])) {
                    $ctaUrl = route($track['cta_route']);
                } elseif (!empty($track['cta_url'])) {
                    $ctaUrl = $track['cta_url'];
                    $isExternal = true;
                }

                $isDisabled = in_array($status, ['coming_soon', 'planned'], true) || empty($ctaUrl);

                return [
                    'key' => $track['key'] ?? $track['label'] ?? uniqid('track_', true),
                    'label' => $track['label'] ?? 'プログラム',
                    'short_label' => $track['short_label'] ?? $track['label'] ?? 'Program',
                    'description' => $track['description'] ?? null,
                    'badge' => $track['badge'] ?? null,
                    'category' => $track['category'] ?? null,
                    'color' => $track['color'] ?? 'default',
                    'icon' => $track['icon'] ?? 'layers',
                    'icon_class' => $track['icon_class'] ?? null,
                    'icon_svg' => $track['icon_svg'] ?? null,
                    'tracks' => $track['tracks'] ?? null,
                    'lessons' => $track['lessons'] ?? null,
                    'exercises' => $track['exercises'] ?? null,
                    'topics' => $track['topics'] ?? [],
                    'status' => $status,
                    'cta' => [
                        'url' => $ctaUrl,
                        'label' => $ctaLabel,
                        'is_external' => $isExternal,
                        'disabled' => $isDisabled,
                    ],
                ];
            })
            ->values();

        $platformStats = [
            'tracks' => $platformCatalog->count(),
            'lessons' => $platformCatalog->sum(fn ($track) => $track['lessons'] ?? 0),
            'exercises' => $platformCatalog->sum(fn ($track) => $track['exercises'] ?? 0),
        ];

        return view('platform-top', array_merge($dashboardData, [
            'platformCatalog' => $platformCatalog,
            'platformStats' => $platformStats,
        ]));
    }

    public function laravel(Request $request)
    {
        return view('laravel-top', $this->buildDashboardData($request));
    }

    private function buildDashboardData(Request $request): array
    {
        $courses = Course::query()
            ->with(['lessons' => fn ($query) => $query->orderBy('lesson_number')])
            ->ordered()
            ->get();

        $stats = [
            'tracks' => $courses->count(),
            'lessons' => Lesson::count(),
            'exercises' => Lesson::whereNotNull('exercise_route_name')->count(),
        ];

        $user = $request->user();

        $userProgress = collect();
        if ($user) {
            $userProgress = UserProgress::query()
                ->select(
                    'lessons.course_id',
                    DB::raw('COUNT(*) as total_records'),
                    DB::raw('SUM(CASE WHEN is_completed THEN 1 ELSE 0 END) as completed_records')
                )
                ->join('lessons', 'lessons.id', '=', 'user_progress.lesson_id')
                ->where('user_progress.user_id', $user->id)
                ->groupBy('lessons.course_id')
                ->get()
                ->keyBy('course_id');
        }

        $globalProgress = UserProgress::query()
            ->select(
                'lessons.course_id',
                DB::raw('COUNT(*) as total_records'),
                DB::raw('SUM(CASE WHEN is_completed THEN 1 ELSE 0 END) as completed_records'),
                DB::raw('COUNT(DISTINCT user_id) as learner_count')
            )
            ->join('lessons', 'lessons.id', '=', 'user_progress.lesson_id')
            ->groupBy('lessons.course_id')
            ->get()
            ->keyBy('course_id');

        $lessonCompletion = UserProgress::query()
            ->select(
                'lesson_id',
                DB::raw('SUM(CASE WHEN is_completed THEN 1 ELSE 0 END) as completed_records'),
                DB::raw('COUNT(DISTINCT user_id) as learner_count')
            )
            ->groupBy('lesson_id')
            ->get()
            ->keyBy('lesson_id');

        $tracks = $courses->map(function (Course $course) use ($userProgress, $globalProgress, $lessonCompletion) {
            $lessons = $course->lessons->map(function (Lesson $lesson) use ($lessonCompletion) {
                $lessonStats = $lessonCompletion->get($lesson->id);
                $completedRecords = $lessonStats->completed_records ?? 0;
                $learnerCount = $lessonStats->learner_count ?? 0;
                $completionRate = $learnerCount > 0
                    ? round(min($completedRecords / max($learnerCount, 1) * 100, 100), 1)
                    : null;

                return [
                    'id' => $lesson->id,
                    'number' => str_pad((string) $lesson->lesson_number, 2, '0', STR_PAD_LEFT),
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'route' => $lesson->route_name,
                    'exercise_route' => $lesson->exercise_route_name,
                    'route_exists' => $lesson->route_name ? Route::has($lesson->route_name) : false,
                    'exercise_exists' => $lesson->exercise_route_name ? Route::has($lesson->exercise_route_name) : false,
                    'global_completion_rate' => $completionRate,
                    'global_completed_records' => $completedRecords,
                    'global_learner_count' => $learnerCount,
                ];
            });

            $lessonCount = $lessons->count();

            $userCourseProgress = $userProgress->get($course->id);
            $userCompleted = $userCourseProgress->completed_records ?? 0;
            $userPercent = $lessonCount > 0
                ? round(min($userCompleted, $lessonCount) / $lessonCount * 100, 1)
                : 0;

            $globalCourseProgress = $globalProgress->get($course->id);
            $globalCompletedRecords = $globalCourseProgress->completed_records ?? 0;
            $globalLearners = $globalCourseProgress->learner_count ?? 0;
            $globalPercent = ($globalLearners > 0 && $lessonCount > 0)
                ? round($globalCompletedRecords / ($globalLearners * $lessonCount) * 100, 1)
                : null;

            return [
                'id' => $course->id,
                'slug' => $course->slug,
                'label' => $course->name,
                'description' => $course->description,
                'color' => $course->color ?? 'beginner',
                'lessons' => $lessons,
                'lesson_count' => $lessonCount,
                'user_progress' => [
                    'completed_lessons' => min($userCompleted, $lessonCount),
                    'total_lessons' => $lessonCount,
                    'percent' => $userPercent,
                ],
                'global_progress' => [
                    'completed_records' => $globalCompletedRecords,
                    'learner_count' => $globalLearners,
                    'percent' => $globalPercent,
                ],
            ];
        })->values();

        $totalLessons = $tracks->sum('lesson_count');
        $userCompletedTotal = $tracks->sum(fn ($track) => $track['user_progress']['completed_lessons']);
        $userSummary = [
            'completed_lessons' => $userCompletedTotal,
            'total_lessons' => $totalLessons,
            'percent' => $totalLessons > 0 ? round($userCompletedTotal / $totalLessons * 100, 1) : 0,
        ];

        $globalCompletedTotal = $globalProgress->sum('completed_records');
        $globalLearnerTotal = $globalProgress->sum('learner_count');
        $globalSummary = [
            'completed_records' => $globalCompletedTotal,
            'learner_count' => $globalLearnerTotal,
            'percent' => ($globalLearnerTotal > 0 && $totalLessons > 0)
                ? round($globalCompletedTotal / ($globalLearnerTotal * $totalLessons) * 100, 1)
                : null,
        ];

        return [
            'tracks' => $tracks,
            'stats' => $stats,
            'authUser' => $user,
            'userSummary' => $userSummary,
            'globalSummary' => $globalSummary,
        ];
    }
}
