<section class="global-top__roadmap" aria-labelledby="global-top-roadmap-title" data-catalog-tabs>
  <div class="global-top__section-header">
    <h2 class="global-top__section-title" id="global-top-roadmap-title">
      <i data-lucide="map"></i>
      ブートキャンプロードマップ
    </h2>
    <p class="global-top__section-subtitle">
      トラックタブを切り替えて、各レッスンの概要・演習リンク・完了状況をまとめて確認できます。
    </p>
  </div>

  <div class="global-roadmap__nav" role="tablist" aria-label="トラック選択">
    @foreach ($tracks as $index => $track)
      @php
        $trackSlug = $track['slug'] ?? \Illuminate\Support\Str::slug($track['label'] ?? 'track');
      @endphp
      <button
        type="button"
        class="global-roadmap__tab"
        id="global-roadmap-tab-{{ $trackSlug }}"
        role="tab"
        aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
        aria-controls="global-roadmap-panel-{{ $trackSlug }}"
        tabindex="{{ $index === 0 ? '0' : '-1' }}"
        data-catalog-tab-target="{{ $trackSlug }}"
      >
        <span class="global-roadmap__tab-label">{{ $track['short_label'] }}</span>
        <span class="global-roadmap__tab-meta">{{ $track['label'] }}</span>
      </button>
    @endforeach
  </div>

  @foreach ($tracks as $index => $track)
    @php
      $trackSlug = $track['slug'] ?? \Illuminate\Support\Str::slug($track['label'] ?? 'track');
    @endphp
    <section
      class="global-roadmap__panel"
      id="global-roadmap-panel-{{ $trackSlug }}"
      role="tabpanel"
      aria-labelledby="global-roadmap-tab-{{ $trackSlug }}"
      data-catalog-panel="{{ $trackSlug }}"
      @if($index !== 0) hidden @endif
    >
      <header class="global-roadmap__header">
        <span class="global-roadmap__badge">{{ $track['short_label'] }}</span>
        <h3 class="global-roadmap__title">{{ $track['label'] }}</h3>
        @if (!empty($track['description']))
          <p class="global-roadmap__description">{{ $track['description'] }}</p>
        @endif
      </header>

      <div class="global-roadmap__lessons">
        @foreach ($track['lessons'] as $lesson)
          @php
            $lessonUrl = $lesson['route_exists'] ? route($lesson['route']) : $lesson['home_anchor'];
            $exerciseUrl = $lesson['exercise_exists'] ? route($lesson['exercise_route']) : $lesson['exercise_anchor'];
          @endphp
          <article class="global-roadmap__card" data-roadmap-card>
            @php
              $overlayTitle = $lesson['hero_title'] ?? $lesson['title'];
              $overlaySubtitle = $lesson['hero_subtitle'] ?? $lesson['description'];
              $overlayMeta = $lesson['hero_meta'] ?? [];
              $overlayTags = $lesson['hero_tags'] ?? $lesson['topics'] ?? [];
              $hasOverlay = $overlayTitle || $overlaySubtitle || !empty($overlayMeta) || !empty($overlayTags);
            @endphp

            @if ($overlaySubtitle)
              <p class="global-roadmap__sr-summary">{{ $overlaySubtitle }}</p>
            @endif

            <div class="global-roadmap__card-content">
              <div class="global-roadmap__meta">
                <span class="global-roadmap__number">{{ $lesson['number'] }}</span>
                <div class="global-roadmap__titles">
                  <span class="global-roadmap__code">{{ $lesson['code'] }}</span>
                  <h4 class="global-roadmap__lesson">{{ $lesson['title'] }}</h4>
                </div>
              </div>

              <div class="global-roadmap__badges">
                @if (!is_null($lesson['global_completion_rate']))
                  <span class="global-roadmap__chip global-roadmap__chip--accent">
                    <i data-lucide="trending-up"></i>
                    完了率 {{ number_format($lesson['global_completion_rate'], 1) }}%
                  </span>
                @endif
                @if (!is_null($lesson['global_learner_count']))
                  <span class="global-roadmap__chip">
                    <i data-lucide="users"></i>
                    {!! number_format($lesson['global_learner_count']) !!} 人学習
                  </span>
                @endif
              </div>

              <div class="global-roadmap__actions">
                <a class="global-roadmap__link" href="{{ $lessonUrl }}">
                  <i data-lucide="book-open"></i>
                  <span>レッスンへ</span>
                </a>
                <a class="global-roadmap__link global-roadmap__link--ghost" href="{{ $exerciseUrl }}">
                  <i data-lucide="clipboard-list"></i>
                  <span>演習へ</span>
                </a>
                @if ($hasOverlay)
                  <button
                    type="button"
                    class="global-roadmap__link global-roadmap__link--secondary"
                    data-roadmap-toggle
                    aria-expanded="false"
                  >
                    <i data-lucide="chevron-down"></i>
                    <span>詳しく表示</span>
                  </button>
                @endif
              </div>
            </div>

            @if ($hasOverlay)
              <div class="global-roadmap__card-overlay" aria-hidden="true" data-roadmap-details>
                <div class="global-roadmap__overlay-header">
                  <span class="global-roadmap__overlay-code">{{ $lesson['code'] }}</span>
                  <h4 class="global-roadmap__overlay-title">{{ $overlayTitle }}</h4>
                </div>

                @if (!empty($overlaySubtitle))
                  <p class="global-roadmap__overlay-description">{{ $overlaySubtitle }}</p>
                @endif

                @if (!empty($overlayMeta))
                  <ul class="global-roadmap__overlay-meta">
                    @foreach ($overlayMeta as $item)
                      <li>{{ $item }}</li>
                    @endforeach
                  </ul>
                @endif

                @if (!empty($overlayTags))
                  <div class="global-roadmap__overlay-tags">
                    @foreach ($overlayTags as $tag)
                      <span class="global-roadmap__overlay-tag">{{ $tag }}</span>
                    @endforeach
                  </div>
                @endif
                <div class="global-roadmap__actions global-roadmap__actions--overlay">
                  <a class="global-roadmap__link" href="{{ $lessonUrl }}">
                    <i data-lucide="book-open"></i>
                    <span>レッスンへ</span>
                  </a>
                  <a class="global-roadmap__link global-roadmap__link--ghost" href="{{ $exerciseUrl }}">
                    <i data-lucide="clipboard-list"></i>
                    <span>演習へ</span>
                  </a>
                </div>
              </div>
            @endif
          </article>
        @endforeach
      </div>
    </section>
  @endforeach
</section>
