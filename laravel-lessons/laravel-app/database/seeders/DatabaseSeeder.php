<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tracks = config('lesson_tracks');

        foreach ($tracks as $trackKey => $track) {
            $course = Course::updateOrCreate(
                ['slug' => $trackKey],
                [
                    'name' => $track['label'],
                    'description' => $track['description'],
                    'difficulty_level' => $this->resolveDifficultyLevel($trackKey),
                    'total_lessons' => count($track['lessons']),
                    'icon' => $track['icon'] ?? null,
                    'color' => $track['color'] ?? null,
                ]
            );

            foreach ($track['lessons'] as $lesson) {
                $lessonNumber = str_pad((string) $lesson['number'], 2, '0', STR_PAD_LEFT);
                $routeName = $lesson['route']
                    ?? ($trackKey === 'beginner' ? 'lesson' . $lessonNumber : $trackKey . '.lesson' . $lessonNumber);
                $exerciseRouteName = $lesson['exercise_route']
                    ?? $lesson['exercise']
                    ?? ($trackKey === 'beginner'
                        ? 'exercises.lesson' . $lessonNumber
                        : $trackKey . '.exercises.lesson' . $lessonNumber);

                Lesson::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'lesson_number' => (int) $lessonNumber,
                    ],
                    [
                        'title' => $lesson['title'],
                        'description' => $lesson['description'] ?? $lesson['summary'] ?? $lesson['type'] ?? null,
                        'route_name' => $routeName,
                        'exercise_route_name' => $exerciseRouteName,
                    ]
                );
            }
        }
    }

    private function resolveDifficultyLevel(string $key): int
    {
        return match ($key) {
            'beginner' => 1,
            'intermediate' => 2,
            'advanced' => 3,
            default => 0,
        };
    }
}
