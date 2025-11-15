@include('home.partials._curriculum-data', ['curriculumHome' => route('home')])

@php
  $lessonTiers = $lessonTiers ?? $curriculumTiers ?? [];
@endphp

<section class="catalog-lessons" aria-labelledby="catalog-lessons-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-lessons-title">レッスン一覧</h2>
    <p class="catalog-section-subtitle">
      Bootcamp Platform のカリキュラムは 3 つの Tier（初級・中級・上級）に分かれ、全45レッスンで 1 つの SaaS を完成させます。
      以下のタブから、各ステージの概要とレッスンカードを切り替えてご確認ください。
    </p>
  </div>

  <div class="catalog-tabs" data-catalog-tabs>
    <div class="catalog-tabs__list" role="tablist" aria-label="学習ステージ">
      @foreach(($lessonTiers ?? []) as $index => $tier)
        <button
          class="catalog-tabs__trigger"
          type="button"
          id="catalog-tab-{{ $tier['id'] }}"
          role="tab"
          aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
          aria-controls="catalog-panel-{{ $tier['id'] }}"
          tabindex="{{ $index === 0 ? '0' : '-1' }}"
          data-catalog-tab-target="{{ $tier['id'] }}"
        >
          <span class="catalog-tabs__trigger-label">{{ $tier['label'] }}</span>
          <span class="catalog-tabs__trigger-meta">{{ $tier['description'] }}</span>
        </button>
      @endforeach
    </div>

    @foreach(($lessonTiers ?? []) as $index => $tier)
      <div
        class="catalog-tabs__panel"
        id="catalog-panel-{{ $tier['id'] }}"
        role="tabpanel"
        aria-labelledby="catalog-tab-{{ $tier['id'] }}"
        data-catalog-panel="{{ $tier['id'] }}"
        tabindex="0"
        @if($index !== 0) hidden @endif
      >
        <div class="catalog-lessons__grid">
          @foreach($tier['lessons'] as $lesson)
            @php
              $anchor = strtolower(str_replace('lesson ', 'lesson-', $lesson['code']));
              $href = $lesson['route'] && Route::has($lesson['route']) ? route($lesson['route']) : $curriculumHome . '#' . $tier['id'] . '-' . $anchor;
            @endphp
            <a class="catalog-card" href="{{ $href }}">
              <div class="catalog-card__header">
                <span class="catalog-card__number">{{ $lesson['code'] }}</span>
                <div class="catalog-card__titles">
                  <span class="catalog-card__code">{{ $tier['label'] }}</span>
                  <span class="catalog-card__title">{{ $lesson['title'] }}</span>
                  <span class="catalog-card__type">{{ implode(' / ', $lesson['topics']) }}</span>
                </div>
              </div>
              <p class="catalog-card__description">
                {{ $lesson['title'] }}で扱う主なトピックと演習は、カリキュラム本編で詳しく解説します。
              </p>
              <ul class="catalog-card__topics">
                @foreach($lesson['topics'] as $topic)
                  <li class="catalog-card__topic">{{ $topic }}</li>
                @endforeach
              </ul>
              <span class="catalog-card__icon" aria-hidden="true">
                <i data-lucide="arrow-up-right"></i>
              </span>
            </a>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</section>
