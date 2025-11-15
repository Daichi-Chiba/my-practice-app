@include('home.partials._curriculum-data')

<section class="catalog-exercises" aria-labelledby="catalog-exercises-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-exercises-title">演習トラック一覧</h2>
    <p class="catalog-section-subtitle">
      各レッスンの理解を深めるための演習タスクをトラック別に整理しました。必要に応じて演習アンカーにジャンプし、レッスンと往復しながら実装を進めてください。
    </p>
  </div>

  <div class="catalog-exercises__tracks">
    @foreach($exerciseTiers as $tier)
      <section class="catalog-exercises__track" aria-labelledby="catalog-exercises-{{ $tier['id'] }}-title">
        <header class="catalog-exercises__track-header">
          <span class="catalog-exercises__track-badge">{{ $tier['label'] }}</span>
          <h3 class="catalog-exercises__track-title" id="catalog-exercises-{{ $tier['id'] }}-title">{{ $tier['description'] }}</h3>
        </header>

        <ul class="catalog-exercises__list" role="list">
          @foreach($tier['exercises'] as $exercise)
            @php
              $exerciseAnchor = $tier['id'] . '-' . $exercise['anchor'];
              $number = (int) $exercise['number'];
              $routeName = sprintf('exercises.lesson%02d', $number);
              $exerciseHref = Route::has($routeName) ? route($routeName) : $curriculumHome . '#lesson-detail-title';
            @endphp
            <li class="catalog-exercises__item" id="{{ $exerciseAnchor }}">
              <div class="catalog-exercises__item-meta">
                <span class="catalog-exercises__item-number">{{ $exercise['code'] }}</span>
                <span class="catalog-exercises__item-title">{{ $exercise['title'] }}</span>
              </div>
              <div class="catalog-exercises__item-actions">
                <a class="catalog-exercises__link" href="{{ $exerciseHref }}">
                  <i data-lucide="check-circle"></i>
                  <span>演習ページへ</span>
                </a>
                <a class="catalog-exercises__link catalog-exercises__link--ghost" href="{{ $curriculumHome }}#{{ $tier['id'] . '-' . str_replace('exercise', 'lesson', $exercise['anchor']) }}">
                  <i data-lucide="arrow-left"></i>
                  <span>関連レッスンへ戻る</span>
                </a>
              </div>
            </li>
          @endforeach
        </ul>
      </section>
    @endforeach
  </div>
</section>
