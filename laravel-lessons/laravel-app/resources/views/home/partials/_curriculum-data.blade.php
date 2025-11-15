@php
  $curriculumHome = $curriculumHome ?? route('home');

  $curriculumTiers = collect($curriculumTiers ?? \App\Support\CurriculumCatalog::all())
    ->map(function (array $tier) use ($curriculumHome) {
      $tierId = $tier['id'] ?? $tier['slug'] ?? 'tier';
      $tierSlug = $tier['slug'] ?? $tierId;

      $tier['id'] = $tierId;

      $tier['lessons'] = collect($tier['lessons'] ?? [])->map(function (array $lesson) use ($tierId, $tierSlug, $curriculumHome) {
        $number = $lesson['number'];

        $anchor = $lesson['anchor'] ?? ('lesson-' . $number);
        $exerciseAnchor = str_replace('lesson', 'exercise', $anchor);

        $route = $lesson['route'] ?? \App\Support\CurriculumCatalog::guessLessonRouteName($tierSlug, $number);
        $exerciseRoute = $lesson['exercise_route'] ?? \App\Support\CurriculumCatalog::guessExerciseRouteName($tierSlug, $number);

        $title = $lesson['title'] ?? ('Lesson ' . $number);

        return array_merge($lesson, [
          'number' => $number,
          'title' => $title,
          'code' => $lesson['code'] ?? ('Lesson ' . $number),
          'topics' => $lesson['topics'] ?? [],
          'summary' => $lesson['summary'] ?? $lesson['description'] ?? null,
          'description' => $lesson['description'] ?? $lesson['summary'] ?? null,
          'anchor' => $anchor,
          'exercise_anchor' => $exerciseAnchor,
          'route' => $route,
          'exercise_route' => $exerciseRoute,
          'home_anchor' => $curriculumHome . '#' . $tierId . '-' . $anchor,
          'exercise_home_anchor' => $curriculumHome . '#' . $tierId . '-' . $exerciseAnchor,
        ]);
      })->all();

      return $tier;
    })->values()->all();

  $lessonTiers = $lessonTiers ?? $curriculumTiers;

  $exerciseTiers = $exerciseTiers ?? collect($curriculumTiers)->map(function (array $tier) {
    return [
      'id' => $tier['id'],
      'label' => $tier['label'],
      'description' => $tier['description'],
      'exercises' => collect($tier['lessons'])->map(function (array $lesson) {
        return [
          'code' => $lesson['code'],
          'title' => $lesson['title'] . ' 演習',
          'anchor' => $lesson['exercise_anchor'],
          'route' => $lesson['exercise_route'] ?? null,
          'number' => $lesson['number'],
        ];
      })->all(),
    ];
  })->all();
@endphp
