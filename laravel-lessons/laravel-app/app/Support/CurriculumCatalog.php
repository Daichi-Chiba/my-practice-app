<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CurriculumCatalog
{
    private const ROUTE_PREFIXES = [
        'beginner' => '',
        'intermediate' => 'intermediate.',
        'advanced' => 'advanced.',
    ];

    private const EXERCISE_PREFIXES = [
        'beginner' => 'exercises.',
        'intermediate' => 'intermediate.exercises.',
        'advanced' => 'advanced.exercises.',
    ];

    /**
     * Retrieve the curriculum tiers defined in configuration with normalized structure.
     */
    public static function all(): Collection
    {
        return collect(config('lesson_tracks', []))
            ->map(function (array $tier, string $key) {
                $slug = $tier['key'] ?? $tier['id'] ?? $key;
                $slug = Str::slug($slug, '-');

                $lessons = collect($tier['lessons'] ?? [])
                    ->map(function (array $lesson) use ($slug) {
                        $number = static::normalizeLessonNumber($lesson['number'] ?? $lesson['code'] ?? null);
                        $anchor = $lesson['anchor'] ?? ('lesson-' . $number);

                        $route = $lesson['route'] ?? null;
                        $exerciseRoute = $lesson['exercise_route'] ?? ($lesson['exercise'] ?? null);

                        if (blank($route)) {
                            $route = static::guessLessonRouteName($slug, $number);
                        }

                        if (blank($exerciseRoute)) {
                            $exerciseRoute = static::guessExerciseRouteName($slug, $number);
                        }

                        return [
                            'number' => $number,
                            'code' => $lesson['code'] ?? ('Lesson ' . $number),
                            'title' => $lesson['title'] ?? ('Lesson ' . $number),
                            'summary' => $lesson['summary'] ?? null,
                            'description' => $lesson['description'] ?? $lesson['summary'] ?? null,
                            'topics' => $lesson['topics'] ?? [],
                            'type' => $lesson['type'] ?? null,
                            'anchor' => $anchor,
                            'exercise_anchor' => str_replace('lesson', 'exercise', $anchor),
                            'route' => $route,
                            'exercise_route' => $exerciseRoute,
                        ];
                    })
                    ->values();

                return [
                    'id' => $slug,
                    'slug' => $slug,
                    'label' => $tier['label'] ?? Str::headline($slug),
                    'short_label' => $tier['short_label'] ?? ($tier['label'] ?? Str::upper($slug)),
                    'description' => $tier['description'] ?? null,
                    'overview' => $tier['overview'] ?? ($tier['description'] ?? null),
                    'color' => $tier['color'] ?? 'beginner',
                    'lessons' => $lessons,
                ];
            })
            ->values();
    }

    private static function normalizeLessonNumber(?string $raw): string
    {
        if (blank($raw)) {
            return '00';
        }

        $number = preg_replace('/\D+/', '', (string) $raw) ?: $raw;

        return str_pad((string) $number, 2, '0', STR_PAD_LEFT);
    }

    public static function guessLessonRouteName(string $slug, string $number): string
    {
        $prefix = static::ROUTE_PREFIXES[$slug] ?? ($slug !== '' ? $slug . '.' : '');

        return $prefix === ''
            ? 'lesson' . $number
            : $prefix . 'lesson' . $number;
    }

    public static function guessExerciseRouteName(string $slug, string $number): string
    {
        $prefix = static::EXERCISE_PREFIXES[$slug] ?? ($slug !== '' ? $slug . '.exercises.' : 'exercises.');

        return $prefix . 'lesson' . $number;
    }

    /**
     * Build roadmap-ready track data by combining curriculum tiers and course progress.
     */
    public static function roadmapTracks(Collection $courses, array $options = []): Collection
    {
        $curriculum = collect($options['curriculum'] ?? static::all());
        $homeRouteName = $options['home_route_name'] ?? 'home';
        $homeUrl = Route::has($homeRouteName) ? route($homeRouteName) : url('/');

        $courseMap = $courses
            ->keyBy(function (array $course) {
                return $course['slug'] ?? Str::slug($course['label'] ?? $course['name'] ?? 'track');
            });

        $courseLessonsByNumber = $courses->mapWithKeys(function (array $course) {
            $slug = $course['slug'] ?? Str::slug($course['label'] ?? $course['name'] ?? 'track');

            return [
                $slug => collect($course['lessons'] ?? [])->keyBy('number'),
            ];
        });

        $courseLessonsByRoute = $courses->flatMap(function (array $course) {
            return collect($course['lessons'] ?? [])
                ->filter(fn ($lesson) => !empty($lesson['route']))
                ->mapWithKeys(fn ($lesson) => [$lesson['route'] => $lesson]);
        });

        return $curriculum->map(function (array $tier) use ($homeUrl, $courseMap, $courseLessonsByNumber, $courseLessonsByRoute) {
            $tierId = $tier['id'] ?? $tier['slug'] ?? Str::slug($tier['label'] ?? 'track');
            $tierSlug = $tier['slug'] ?? $tierId;

            $course = $courseMap->get($tierSlug);
            $courseLessonByNumber = $courseLessonsByNumber->get($tierSlug, collect());

            $lessons = collect($tier['lessons'] ?? [])->map(function (array $lesson) use ($tierId, $homeUrl, $courseLessonByNumber, $courseLessonsByRoute) {
                $routeName = $lesson['route'] ?? null;
                $exerciseRouteName = $lesson['exercise_route'] ?? null;

                $lessonStats = null;
                if ($routeName && $courseLessonsByRoute->has($routeName)) {
                    $lessonStats = $courseLessonsByRoute->get($routeName);
                } elseif ($courseLessonByNumber instanceof Collection && $courseLessonByNumber->has($lesson['number'])) {
                    $lessonStats = $courseLessonByNumber->get($lesson['number']);
                }

                $routeExists = $routeName ? Route::has($routeName) : false;
                $exerciseExists = $exerciseRouteName ? Route::has($exerciseRouteName) : false;

                $anchor = $lesson['anchor'];
                $exerciseAnchor = $lesson['exercise_anchor'] ?? str_replace('lesson', 'exercise', $anchor);

                $hero = LessonHeroExtractor::extract($lesson['number'] ?? null);

                return array_merge($lesson, [
                    'route_exists' => $lessonStats['route_exists'] ?? $routeExists,
                    'exercise_exists' => $lessonStats['exercise_exists'] ?? $exerciseExists,
                    'home_anchor' => $homeUrl . '#' . $tierId . '-' . $anchor,
                    'exercise_anchor' => $homeUrl . '#' . $tierId . '-' . $exerciseAnchor,
                    'global_completion_rate' => $lessonStats['global_completion_rate'] ?? null,
                    'global_learner_count' => $lessonStats['global_learner_count'] ?? null,
                    'hero_title' => $hero['title'] ?? null,
                    'hero_subtitle' => $hero['subtitle'] ?? null,
                    'hero_meta' => $hero['meta'] ?? [],
                    'hero_tags' => $hero['tags'] ?? [],
                ]);
            })->all();

            return [
                'slug' => $tierSlug,
                'label' => $tier['label'] ?? ($course['label'] ?? $course['name'] ?? Str::title($tierSlug)),
                'short_label' => $tier['short_label'] ?? ($course['short_label'] ?? Str::upper($tierSlug)),
                'description' => $tier['description'] ?? $tier['overview'] ?? ($course['description'] ?? null),
                'overview' => $tier['overview'] ?? $tier['description'] ?? null,
                'lessons' => $lessons,
            ];
        })->filter(fn ($track) => !empty($track['lessons']))->values();
    }
}
