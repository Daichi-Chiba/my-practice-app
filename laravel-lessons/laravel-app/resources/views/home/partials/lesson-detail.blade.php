@php
  $curriculumHome = $curriculumHome ?? route('home');
  $curriculumTiers = collect($curriculumTiers ?? \App\Support\CurriculumCatalog::all())
    ->map(function ($tier) {
      return $tier instanceof \Illuminate\Support\Collection ? $tier->toArray() : (array) $tier;
    })
    ->all();
@endphp

<section class="catalog-detail" aria-labelledby="catalog-detail-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-detail-title">Tier 別レッスン詳細</h2>
    <p class="catalog-section-subtitle">
      各レッスンで扱うテーマ、完成イメージ、関連演習をまとめています。必要に応じて気になるレッスンへジャンプし、演習アンカーから実践セクションへ接続してください。
    </p>
  </div>

  <div class="catalog-detail__tracks">
    @foreach($curriculumTiers as $tier)
      <section class="catalog-detail__track" aria-labelledby="catalog-detail-{{ $tier['id'] }}-title">
        <header class="catalog-detail__track-header">
          <div class="catalog-detail__track-eyebrow">{{ $tier['short_label'] }}</div>
          <h3 class="catalog-detail__track-title" id="catalog-detail-{{ $tier['id'] }}-title">{{ $tier['label'] }}</h3>
          <p class="catalog-detail__track-copy">{{ $tier['overview'] }}</p>
        </header>

        <div class="catalog-detail__grid">
          @foreach($tier['lessons'] as $lesson)
            @php
              $lessonAnchor = $tier['id'] . '-' . $lesson['anchor'];
              $exerciseAnchor = $tier['id'] . '-' . str_replace('lesson', 'exercise', $lesson['anchor']);
              $routeExists = $lesson['route'] && Route::has($lesson['route']);
              $href = $routeExists ? route($lesson['route']) : $curriculumHome . '#' . $lessonAnchor;
            @endphp
            <article class="catalog-detail__card" id="{{ $lessonAnchor }}">
              <div class="catalog-detail__card-header">
                <div class="catalog-detail__count">{{ $lesson['number'] }}</div>
                <div class="catalog-detail__titles">
                  <span class="catalog-detail__code">{{ $lesson['code'] }}</span>
                  <h4 class="catalog-detail__lesson">{{ $lesson['title'] }}</h4>
                  <span class="catalog-detail__topics">{{ implode(' / ', $lesson['topics']) }}</span>
                </div>
              </div>

              <p class="catalog-detail__summary">{{ $lesson['summary'] }}</p>

              <div class="catalog-detail__links">
                <a class="catalog-detail__link" href="{{ $href }}">
                  <i data-lucide="book-open"></i>
                  <span>レッスンページへ</span>
                </a>
                <a class="catalog-detail__link catalog-detail__link--ghost" href="{{ $curriculumHome }}#{{ $exerciseAnchor }}">
                  <i data-lucide="clipboard-list"></i>
                  <span>対応する演習</span>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </section>
    @endforeach
  </div>
</section>
