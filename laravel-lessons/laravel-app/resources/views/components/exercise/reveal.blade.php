@props([
  'id',
  'hints' => [],
  'answer' => null,
  'hintLabel' => 'ヒント',
  'answerLabel' => '模範作業',
])

@php
  $componentId = $id ?? uniqid('exercise-reveal-');
@endphp

<div class="exercise-reveal" data-exercise-reveal id="{{ $componentId }}">
  @if (!empty($hints))
    <div class="exercise-reveal__section">
      <h3 class="exercise-reveal__heading">
        <i data-lucide="lightbulb"></i>
        {{ $hintLabel }}
      </h3>
      <div class="exercise-reveal__list">
        @foreach ($hints as $index => $hint)
          @php
            $hintId = $componentId.'-hint-'.$index;
          @endphp
          <div class="exercise-reveal__item">
            <button
              class="exercise-reveal__toggle"
              type="button"
              data-exercise-reveal-toggle
              aria-expanded="false"
              aria-controls="{{ $hintId }}"
            >
              <span class="exercise-reveal__toggle-label">ヒント {{ $loop->iteration }}</span>
              <i data-lucide="chevron-down"></i>
            </button>
            <div
              class="exercise-reveal__content"
              id="{{ $hintId }}"
              role="region"
              aria-hidden="true"
            >
              {!! is_string($hint) ? nl2br(e($hint)) : $hint !!}
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  @if (!empty($answer))
    @php
      $answerId = $componentId.'-answer';
    @endphp
    <div class="exercise-reveal__section">
      <h3 class="exercise-reveal__heading">
        <i data-lucide="check-square"></i>
        {{ $answerLabel }}
      </h3>
      <div class="exercise-reveal__item">
        <button
          class="exercise-reveal__toggle exercise-reveal__toggle--answer"
          type="button"
          data-exercise-reveal-toggle
          aria-expanded="false"
          aria-controls="{{ $answerId }}"
        >
          <span class="exercise-reveal__toggle-label">模範作業を見る</span>
          <i data-lucide="chevron-down"></i>
        </button>
        <div
          class="exercise-reveal__content"
          id="{{ $answerId }}"
          role="region"
          aria-hidden="true"
        >
          {!! is_string($answer) ? nl2br(e($answer)) : $answer !!}
        </div>
      </div>
    </div>
  @endif
</div>
