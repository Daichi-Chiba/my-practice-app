<?php

namespace App\Http\Controllers;

use App\Support\CurriculumCatalog;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LessonPageController extends Controller
{
    public function __construct(private readonly ViewFactory $viewFactory)
    {
    }

    public function showLesson(string $number, string $tier = 'beginner'): View|RedirectResponse
    {
        if (! ctype_digit($number)) {
            return $this->redirectToTop();
        }

        $normalized = $this->normalizeNumber($number);

        $tierSlug = $this->normalizeTier($tier);

        $partials = $this->lessonPartials($tierSlug, $normalized);

        if (empty($partials)) {
            $view = "lessons.lesson{$normalized}";

            if ($this->viewFactory->exists($view)) {
                return view($view);
            }

            return $this->redirectToTop();
        }

        $curriculum = $this->curriculumFor($tierSlug, $normalized, 'lesson');
        if ($curriculum === null) {
            return $this->redirectToTop();
        }

        return view('LaravelLesson.show', array_merge($curriculum, [
            'lessonNumber' => $normalized,
            'tierSlug' => $tierSlug,
            'partialViews' => $partials,
        ]));
    }

    public function showExercise(string $number, string $tier = 'beginner'): View|RedirectResponse
    {
        if (! ctype_digit($number)) {
            return $this->redirectToTop();
        }

        $normalized = $this->normalizeNumber($number);

        $tierSlug = $this->normalizeTier($tier);

        $partials = $this->exercisePartials($tierSlug, $normalized);

        if (empty($partials)) {
            $view = "exercises.lesson{$normalized}";

            if ($this->viewFactory->exists($view)) {
                return view($view);
            }

            return $this->redirectToTop();
        }

        $curriculum = $this->curriculumFor($tierSlug, $normalized, 'exercise');

        if ($curriculum === null) {
            return $this->redirectToTop();
        }

        return view('LaravelExercises.show', array_merge($curriculum, [
            'lessonNumber' => $normalized,
            'tierSlug' => $tierSlug,
            'partialViews' => $partials,
        ]));
    }

    private function normalizeNumber(string $number): string
    {
        if (! ctype_digit($number)) {
            return $number;
        }

        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    private function curriculumFor(string $tier, string $number, string $type): ?array
    {
        $slug = $this->normalizeTier($tier);

        $curriculum = CurriculumCatalog::all();

        $tierData = $curriculum->firstWhere('slug', $slug);

        if (! $tierData) {
            $tierData = $curriculum->firstWhere('slug', 'beginner');
        }

        if (! $tierData) {
            return null;
        }

        $lesson = collect($tierData['lessons'] ?? [])->firstWhere('number', $number);
        if (! $lesson) {
            return null;
        }

        return [
            'tier' => $tierData,
            'lesson' => $lesson,
            'type' => $type,
        ];
    }

    private function redirectToTop(): RedirectResponse
    {
        return redirect()->route('laravel-top')->with('status', '指定されたレッスンページは存在しません。');
    }

    private function lessonPartials(string $tier, string $number): array
    {
        $candidates = [
            [
                'directory' => resource_path("views/LaravelLesson/{$tier}/lesson{$number}"),
                'prefix' => 'LaravelLesson.' . $tier . '.lesson' . $number . '.',
            ],
            [
                'directory' => resource_path("views/lessons/partials/lesson{$number}"),
                'prefix' => 'lessons.partials.lesson' . $number . '.',
            ],
        ];

        foreach ($candidates as $candidate) {
            $partials = $this->collectPartials($candidate['directory'], $candidate['prefix']);

            if (! empty($partials)) {
                return $partials;
            }
        }

        return [];
    }

    private function exercisePartials(string $tier, string $number): array
    {
        $candidates = [
            [
                'directory' => resource_path("views/LaravelExercises/{$tier}/lesson{$number}"),
                'prefix' => 'LaravelExercises.' . $tier . '.lesson' . $number . '.',
            ],
            [
                'directory' => resource_path("views/exercises/partials/lesson{$number}"),
                'prefix' => 'exercises.partials.lesson' . $number . '.',
            ],
        ];

        foreach ($candidates as $candidate) {
            $partials = $this->collectPartials($candidate['directory'], $candidate['prefix']);

            if (! empty($partials)) {
                return $partials;
            }
        }

        return [];
    }

    private function collectPartials(string $directory, string $viewPrefix): array
    {
        if (! File::isDirectory($directory)) {
            return [];
        }

        return collect(File::files($directory))
            ->filter(fn ($file) => Str::endsWith($file->getFilename(), '.blade.php'))
            ->sortBy(fn ($file) => $file->getFilename())
            ->map(fn ($file) => $viewPrefix . Str::replaceLast('.blade.php', '', $file->getFilename()))
            ->values()
            ->all();
    }

    private function normalizeTier(?string $tier): string
    {
        $normalized = Str::slug((string) $tier, '-');

        return $normalized !== '' ? $normalized : 'beginner';
    }
}
