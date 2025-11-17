@php
  $curriculumHome = $curriculumHome ?? route('home');
  $curriculumTiers = collect($curriculumTiers ?? \App\Support\CurriculumCatalog::all())
    ->map(function ($tier) {
      return $tier instanceof \Illuminate\Support\Collection ? $tier->toArray() : (array) $tier;
    })
    ->all();
@endphp

<section class="catalog-roadmap" id="program-overview" aria-labelledby="catalog-roadmap-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-roadmap-title">トラック別ロードマップ</h2>
    <p class="catalog-section-subtitle">
      Bootcamp Platform の 45 レッスンは 3 つのトラックに分かれており、トラックごとに学ぶ目的と成果が整理されています。
      下記のカードから各レッスン詳細や演習アンカーへジャンプできます。
    </p>
  </div>

  <div class="catalog-roadmap__tracks">
    @foreach($curriculumTiers as $tier)
      <section class="catalog-track" id="{{ $tier['id'] }}-track" aria-labelledby="catalog-track-{{ $tier['id'] }}-title">
        <header class="catalog-track__header">
          <span class="catalog-track__badge">{{ $tier['short_label'] }}</span>
          <h3 class="catalog-track__title" id="catalog-track-{{ $tier['id'] }}-title">{{ $tier['label'] }}</h3>
          <p class="catalog-track__description">{{ $tier['overview'] }}</p>
        </header>

        <div class="catalog-track__lessons">
          @foreach($tier['lessons'] as $lesson)
            @php
              $lessonAnchor = $tier['id'] . '-' . $lesson['anchor'];
              $exerciseAnchor = $tier['id'] . '-' . str_replace('lesson', 'exercise', $lesson['anchor']);
              $routeExists = $lesson['route'] && Route::has($lesson['route']);
              $href = $routeExists ? route($lesson['route']) : $curriculumHome . '#' . $lessonAnchor;
            @endphp
            <article class="catalog-track__card" id="{{ $lessonAnchor }}" aria-labelledby="catalog-track-{{ $tier['id'] }}-{{ $lesson['number'] }}">
              <div class="catalog-track__meta">
                <span class="catalog-track__number">{{ $lesson['number'] }}</span>
                <div class="catalog-track__labels">
                  <span class="catalog-track__code">{{ $lesson['code'] }}</span>
                  <h4 class="catalog-track__lesson" id="catalog-track-{{ $tier['id'] }}-{{ $lesson['number'] }}">{{ $lesson['title'] }}</h4>
                  <span class="catalog-track__topics">{{ implode(' / ', $lesson['topics']) }}</span>
                </div>
              </div>

              <p class="catalog-track__summary">{{ $lesson['summary'] }}</p>

              <div class="catalog-track__actions">
                <a class="catalog-track__action" href="{{ $href }}">
                  <span>レッスンを見る</span>
                  <i data-lucide="arrow-up-right"></i>
                </a>
                <a class="catalog-track__action catalog-track__action--ghost" href="{{ $curriculumHome }}#{{ $exerciseAnchor }}">
                  <span>演習アンカー</span>
                  <i data-lucide="radio"></i>
                </a>
              </div>

              <span id="{{ $exerciseAnchor }}" class="catalog-track__anchor" aria-hidden="true"></span>
            </article>
          @endforeach
        </div>
      </section>
    @endforeach
  </div>
</section>
