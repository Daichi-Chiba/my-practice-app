<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    /**
     * 全コースの進捗を取得
     */
    public function index(Request $request)
    {
        $userId = $request->input('user_id', 1); // デモ用にデフォルトユーザー

        $courses = Course::with('lessons')->get()->map(function($course) use ($userId) {
            $totalLessons = $course->lessons->count();
            $completedLessons = UserProgress::where('user_id', $userId)
                ->whereIn('lesson_id', $course->lessons->pluck('id'))
                ->where('is_completed', true)
                ->count();

            return [
                'id' => $course->id,
                'name' => $course->name,
                'slug' => $course->slug,
                'icon' => $course->icon,
                'color' => $course->color,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
                'progress_percentage' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100, 2) : 0,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }

    /**
     * 特定コースの詳細進捗を取得
     */
    public function show($courseId, Request $request)
    {
        $userId = $request->input('user_id', 1);

        $course = Course::with('lessons')->findOrFail($courseId);

        $lessons = $course->lessons->map(function($lesson) use ($userId) {
            $progress = UserProgress::where('user_id', $userId)
                ->where('lesson_id', $lesson->id)
                ->first();

            return [
                'id' => $lesson->id,
                'lesson_number' => $lesson->lesson_number,
                'title' => $lesson->title,
                'is_completed' => $progress ? $progress->is_completed : false,
                'completed_at' => $progress ? $progress->completed_at : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'course' => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'slug' => $course->slug,
                ],
                'lessons' => $lessons,
            ]
        ]);
    }

    /**
     * レッスンの完了状態を更新
     */
    public function updateLessonProgress(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'lesson_id' => 'required|integer',
            'is_completed' => 'required|boolean',
        ]);

        $progress = UserProgress::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'is_completed' => $request->is_completed,
                'completed_at' => $request->is_completed ? now() : null,
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $progress
        ]);
    }

    /**
     * 統計情報を取得
     */
    public function statistics(Request $request)
    {
        $userId = $request->input('user_id', 1);

        $totalLessons = Lesson::count();
        $completedLessons = UserProgress::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();
        
        $totalCourses = Course::count();
        $completedCourses = Course::whereHas('lessons', function($query) use ($userId) {
            $query->whereHas('userProgress', function($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->where('is_completed', true);
            });
        })->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_courses' => $totalCourses,
                'completed_courses' => $completedCourses,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
                'overall_progress' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100, 2) : 0,
            ]
        ]);
    }
}
