@extends('layouts.site')

@section('title', 'Laravel Bootcamp Global TOP')
@section('body-class', 'site site--global-top')

@section('main')
  @include('home.partials._curriculum-data', ['curriculumHome' => route('home')])

  @php
      $trackCollection = collect($tracks ?? []);
      $userPercent = $userSummary['percent'] ?? 0;
      $globalPercent = $globalSummary['percent'] ?? null;

      $curriculumCollection = collect($curriculumTiers ?? \App\Support\CurriculumCatalog::all());
      $roadmapTracks = \App\Support\CurriculumCatalog::roadmapTracks($trackCollection, [
          'curriculum' => $curriculumCollection,
          'home_route_name' => 'home',
      ]);
  @endphp

  <div class="global-top">
    <section class="global-top__hero" aria-labelledby="global-top-hero-title">
      <div class="global-top__intro">
        <p class="global-top__eyebrow">Laravel Bootcamp</p>
        <h1 class="global-top__title" id="global-top-hero-title">Laravel 全体 TOP</h1>
        <p class="global-top__subtitle">
          初心者・中級・上級の 3 トラックで、実務に直結する 45 レッスン＋演習を体系的に学べます。ログインすると、ここにあなたの進捗が集約されます。
        </p>

        @if ($trackCollection->isNotEmpty())
          <div class="global-top__pill-group" role="list">
            @foreach ($trackCollection as $track)
              <span class="global-top__pill" role="listitem">
                <i data-lucide="layers"></i>
                {{ $track['label'] }}
              </span>
            @endforeach
          </div>
        @endif
      </div>

      <div class="global-top__summary">
        <article class="global-top__summary-card" aria-labelledby="global-top-user-progress">
          <h2 class="global-top__summary-title" id="global-top-user-progress">
            <i data-lucide="user-check"></i>
            あなたの進捗
          </h2>
          <p class="global-top__summary-meta">ログイン中のアカウントで完了したレッスンと演習の達成状況です。</p>
          <div class="global-top__summary-metrics">
            <div>
              <div class="global-top__metric-value">
                {{ number_format($userSummary['percent'] ?? 0, 1) }}
                <span class="global-top__metric-suffix">%</span>
              </div>
              <p class="global-top__metric-label">達成率</p>
            </div>
            <div>
              <div class="global-top__metric-value">{{ number_format($userSummary['completed_lessons'] ?? 0) }}</div>
              <p class="global-top__metric-label">完了レッスン</p>
            </div>
            <div>
              <div class="global-top__metric-value">{{ number_format($userSummary['total_lessons'] ?? 0) }}</div>
              <p class="global-top__metric-label">総レッスン</p>
            </div>
          </div>
          <div class="global-top__progress-meter" style="--progress-width: {{ min($userPercent ?? 0, 100) }}%;"></div>
          <p class="global-top__summary-footnote">
            {{ number_format($userSummary['completed_lessons'] ?? 0) }} / {{ number_format($userSummary['total_lessons'] ?? 0) }} レッスン完了
          </p>
        </article>

        <article class="global-top__summary-card" aria-labelledby="global-top-community-progress">
          <h2 class="global-top__summary-title" id="global-top-community-progress">
            <i data-lucide="users"></i>
            コミュニティ進捗
          </h2>
          <p class="global-top__summary-meta">受講生全体の完了ログ集計です。人気レッスンの目安として参考にできます。</p>
          <div class="global-top__summary-metrics">
            <div>
              <div class="global-top__metric-value">
                {{ $globalPercent !== null ? number_format($globalPercent, 1) : '---' }}
                @if ($globalPercent !== null)
                  <span class="global-top__metric-suffix">%</span>
                @endif
              </div>
              <p class="global-top__metric-label">平均達成率</p>
            </div>
            <div>
              <div class="global-top__metric-value">
                {{ number_format($globalSummary['learner_count'] ?? 0) }}
                <span class="global-top__metric-suffix">人</span>
              </div>
              <p class="global-top__metric-label">参加者</p>
            </div>
            <div>
              <div class="global-top__metric-value">{{ number_format($globalSummary['completed_records'] ?? 0) }}</div>
              <p class="global-top__metric-label">完了ログ</p>
            </div>
          </div>
          <div class="global-top__progress-meter" style="--progress-width: {{ $globalPercent !== null ? min($globalPercent, 100) : 0 }}%;"></div>
          <p class="global-top__summary-footnote">ログは「受講者数 × レッスン完了数」で算出されています。</p>
        </article>
      </div>
    </section>

    <section class="global-top__stats" aria-labelledby="global-top-stats-title">
      <div class="global-top__section-header">
        <h2 class="global-top__section-title" id="global-top-stats-title">
          <i data-lucide="bar-chart-3"></i>
          学習スナップショット
        </h2>
        <p class="global-top__section-subtitle">トラック全体を横断した学習データです。レッスンや演習が追加されると自動で集計が更新されます。</p>
      </div>

      <div class="global-top__stats-grid" role="list">
        <div class="global-top__stat-card" role="listitem">
          <div class="global-top__stat-value">{{ number_format($stats['tracks'] ?? 0) }}</div>
          <p class="global-top__stat-label">TRACKS</p>
        </div>
        <div class="global-top__stat-card" role="listitem">
          <div class="global-top__stat-value">{{ number_format($stats['lessons'] ?? 0) }}</div>
          <p class="global-top__stat-label">LESSONS</p>
        </div>
        <div class="global-top__stat-card" role="listitem">
          <div class="global-top__stat-value">{{ number_format($stats['exercises'] ?? 0) }}</div>
          <p class="global-top__stat-label">EXERCISES</p>
        </div>
      </div>
    </section>

    @php
      $authIcon = auth()->check() ? 'shield-check' : 'log-in';
    @endphp
    {{-- <section class="global-top__auth" aria-labelledby="global-top-auth-title">
      <h2 class="global-top__auth-title" id="global-top-auth-title">
        <i data-lucide="{{ $authIcon }}"></i>
        {{ auth()->check() ? 'ログイン中' : 'Laravel アカウントにログイン' }}
      </h2>

      @if (session('status'))
        <p class="global-top__auth-status">{{ session('status') }}</p>
      @endif

      @auth
        <p class="global-top__auth-description">{{ auth()->user()->name }} さん、学習お疲れさまです。最新の進捗はダッシュボードでも確認できます。</p>
        <div class="global-top__auth-actions">
          @if (Route::has('dashboard'))
            <a class="global-top__submit-button" href="{{ route('dashboard') }}">
              <i data-lucide="layout-dashboard"></i>
              ダッシュボードへ
            </a>
          @endif
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="global-top__secondary-button">
              <i data-lucide="log-out"></i>
              ログアウト
            </button>
          </form>
        </div>
        <p class="global-top__auth-footer">チーム利用中の方は、完了レッスンが共有ダッシュボードにも反映されます。</p>
      @endauth

      @guest
        <p class="global-top__auth-description">ログインまたは新規登録で、レッスン完了と演習の進捗を記録できます。メールアドレスだけで数分以内に開始できます。</p>
        <form method="POST" action="{{ route('login') }}" class="global-top__form">
          @csrf
          <div class="global-top__form-field">
            <label class="global-top__form-label" for="email">メールアドレス</label>
            <input class="global-top__form-input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
              <p class="global-top__form-error">{{ $message }}</p>
            @enderror
          </div>

          <div class="global-top__form-field">
            <label class="global-top__form-label" for="password">パスワード</label>
            <input class="global-top__form-input" id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
              <p class="global-top__form-error">{{ $message }}</p>
            @enderror
          </div>

          <div class="global-top__form-row">
            <label class="global-top__checkbox" for="remember">
              <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <span>ログイン状態を保持</span>
            </label>
            @if (Route::has('password.request'))
              <a class="global-top__link" href="{{ route('password.request') }}">パスワードをお忘れの場合</a>
            @endif
          </div>

          <div class="global-top__auth-actions">
            <button type="submit" class="global-top__submit-button">
              <i data-lucide="log-in"></i>
              ログイン
            </button>
            @if (Route::has('register'))
              <a class="global-top__secondary-button" href="{{ route('register') }}">
                <i data-lucide="user-plus"></i>
                新規登録
              </a>
            @endif
          </div>
        </form>
        <p class="global-top__auth-footer">初回ログイン後は、再開ポイントが自動的に表示されます。</p>
      @endguest
    </section> --}}

    @php
      $roadmapTracks = ($trackCollection->isNotEmpty() ? $trackCollection : $curriculumCollection)
        ->map(function ($track) {
            $slug = $track['slug'] ?? $track['id'] ?? \Illuminate\Support\Str::slug($track['label'] ?? 'track');

            $lessons = collect($track['lessons'] ?? [])->map(function ($lesson) use ($slug) {
              $number = str_pad($lesson['number'], 2, '0', STR_PAD_LEFT);
              $routeName = $lesson['route'] ?? null;
              $exerciseRouteName = $lesson['exercise_route'] ?? null;
              $routeExists = $routeName && Route::has($routeName);
              $exerciseExists = $exerciseRouteName && Route::has($exerciseRouteName);

              return [
                'number' => $number,
                'code' => $lesson['code'] ?? ('Lesson ' . $number),
                'title' => $lesson['title'] ?? 'Lesson ' . $number,
                'description' => $lesson['description'] ?? $lesson['summary'] ?? null,
                'route' => $routeName,
                'exercise_route' => $exerciseRouteName,
                'route_exists' => $routeExists,
                'exercise_exists' => $exerciseExists,
                'home_anchor' => route('home') . '#' . $slug . '-lesson-' . $number,
                'exercise_anchor' => route('home') . '#' . $slug . '-exercise-' . $number,
                'global_completion_rate' => $lesson['global_completion_rate'] ?? null,
                'global_learner_count' => $lesson['global_learner_count'] ?? null,
              ];
            })->all();

            return [
              'slug' => $slug,
              'label' => $track['label'] ?? $track['name'] ?? 'Track',
              'short_label' => $track['short_label'] ?? $track['label'] ?? strtoupper($slug),
              'description' => $track['description'] ?? $track['overview'] ?? null,
              'lessons' => $lessons,
            ];
          })
        ->filter(fn ($track) => !empty($track['lessons']))
        ->values();
    @endphp

    @if ($roadmapTracks->isNotEmpty())
      <x-roadmap.tabs :tracks="$roadmapTracks" />
    @endif

    <section class="global-top__tracks" aria-labelledby="global-top-tracks-title" data-track-tabs>
      <div class="global-top__section-header">
        <h2 class="global-top__section-title" id="global-top-tracks-title">
          <i data-lucide="route"></i>
          トラック別ロードマップ
        </h2>
        <p class="global-top__section-subtitle">ボタンを切り替えて、各トラックのレッスンと演習を確認してください。</p>
      </div>

      @if ($trackCollection->isEmpty())
        <p class="global-top__section-subtitle">トラック情報がまだ準備中です。しばらくお待ちください。</p>
      @else
        <div class="global-top__tabs" role="tablist">
          @foreach ($trackCollection as $track)
            @php($panelId = 'track-' . ($track['slug'] ?? $loop->index))
            <button
              type="button"
              class="global-top__tab {{ $loop->first ? 'is-active' : '' }}"
              id="{{ $panelId }}-tab"
              data-track-tab
              data-target="{{ $panelId }}"
              role="tab"
              aria-controls="{{ $panelId }}"
              aria-selected="{{ $loop->first ? 'true' : 'false' }}"
              tabindex="{{ $loop->first ? '0' : '-1' }}"
            >
              <span class="global-top__tab-label">{{ $track['label'] }}</span>
              <span class="global-top__tab-meta">{{ number_format($track['lesson_count']) }} レッスン</span>
            </button>
          @endforeach
        </div>

        <div class="global-top__panels">
          @foreach ($trackCollection as $track)
            @php($panelId = 'track-' . ($track['slug'] ?? $loop->index))
            @php($userTrackPercent = $track['user_progress']['percent'] ?? 0)
            @php($globalTrackPercent = $track['global_progress']['percent'] ?? null)
            <div
              class="global-top__panel {{ $loop->first ? 'is-active' : '' }}"
              id="{{ $panelId }}"
              data-track-panel
              role="tabpanel"
              aria-labelledby="{{ $panelId }}-tab"
              aria-hidden="{{ $loop->first ? 'false' : 'true' }}"
            >
              <div class="global-top__panel-header">
                <h3 class="global-top__panel-title">{{ $track['label'] }}</h3>
                @if (!empty($track['description']))
                  <p class="global-top__panel-description">{{ $track['description'] }}</p>
                @endif
                <div class="global-top__panel-progress-grid">
                  <div class="global-top__panel-progress">
                    <span class="global-top__panel-progress-label">あなたの進捗</span>
                    <span class="global-top__panel-progress-value">{{ number_format($userTrackPercent, 1) }}%</span>
                    <div class="global-top__panel-progress-meter" style="--progress-width: {{ min($userTrackPercent, 100) }}%;"></div>
                  </div>
                  <div class="global-top__panel-progress">
                    <span class="global-top__panel-progress-label">全体平均</span>
                    <span class="global-top__panel-progress-value">
                      {{ $globalTrackPercent !== null ? number_format($globalTrackPercent, 1) . '%' : '---' }}
                    </span>
                    <div class="global-top__panel-progress-meter" style="--progress-width: {{ $globalTrackPercent !== null ? min($globalTrackPercent, 100) : 0 }}%;"></div>
                  </div>
                </div>
              </div>

              <ul class="global-top__lesson-list">
                @foreach ($track['lessons'] as $lesson)
                  <li class="global-top__lesson-item">
                    <div class="global-top__lesson-header">
                      <span class="global-top__lesson-number">{{ $lesson['number'] }}</span>
                      <div class="global-top__lesson-titles">
                        <h4 class="global-top__lesson-title">{{ $lesson['title'] }}</h4>
                        <p class="global-top__lesson-type">レッスン</p>
                      </div>
                      <div class="global-top__lesson-meta">
                        @if (!is_null($lesson['global_completion_rate']))
                          <span class="global-top__badge global-top__badge--accent">
                            <i data-lucide="line-chart"></i>
                            完了率 {{ number_format($lesson['global_completion_rate'], 1) }}%
                          </span>
                        @endif
                        <span class="global-top__badge">
                          <i data-lucide="users"></i>
                          受講 {{ number_format($lesson['global_learner_count'] ?? 0) }} 人
                        </span>
                      </div>
                    </div>

                    @if (!empty($lesson['description']))
                      <p class="global-top__panel-description">{{ $lesson['description'] }}</p>
                    @endif

                    <div class="global-top__lesson-links">
                      @if ($lesson['route'] && $lesson['route_exists'])
                        <a class="global-top__lesson-link" href="{{ route($lesson['route']) }}">
                          <i data-lucide="book-open"></i>
                          レッスンを見る
                        </a>
                      @else
                        <span class="global-top__lesson-link global-top__lesson-link--disabled">
                          <i data-lucide="book-open"></i>
                          レッスン準備中
                        </span>
                      @endif

                      @if ($lesson['exercise_route'] && $lesson['exercise_exists'])
                        <a class="global-top__lesson-link global-top__lesson-link--ghost" href="{{ route($lesson['exercise_route']) }}">
                          <i data-lucide="clipboard-list"></i>
                          演習に進む
                        </a>
                      @elseif ($lesson['exercise_route'])
                        <span class="global-top__lesson-link global-top__lesson-link--disabled">
                          <i data-lucide="clipboard-list"></i>
                          演習準備中
                        </span>
                      @endif
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      @endif
    </section>
  </div>
@endsection
