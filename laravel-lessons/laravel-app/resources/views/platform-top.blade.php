@extends('layouts.site')

@push('head')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@2.15.1/devicon.min.css">
@endpush

@section('title', 'Bootcamp Platform TOP')
@section('body-class', 'site site--platform-top')

@section('main')
  @php
      $catalog = collect($platformCatalog ?? []);
      $userPercent = $userSummary['percent'] ?? 0;
      $globalPercent = $globalSummary['percent'] ?? null;
      $heroTags = [
          ['icon' => 'server-cog', 'label' => 'Laravel'],
          ['icon' => 'layout-dashboard', 'label' => 'React'],
          ['icon' => 'building-2', 'label' => 'Java'],
          ['icon' => 'rocket', 'label' => 'Next.js'],
      ];
  @endphp

  <div class="platform-top">
    <section class="platform-hero" aria-labelledby="platform-hero-title" id="platform-hero">
      <div class="platform-hero__content">
        <p class="platform-hero__eyebrow">Bootcamp Platform</p>
        <h1 class="platform-hero__title" id="platform-hero-title">Bootcamp Platform TOP</h1>
        <p class="platform-hero__subtitle">
          バックエンドからフロントエンド、DevOps まで横断的に学べるトラックが勢揃い。ログインすると、すべてのトラックの進捗がここに集約されます。
        </p>
        <div class="platform-hero__tags" role="list">
          @foreach ($heroTags as $tag)
            <span class="platform-hero__tag" role="listitem">
              <i data-lucide="{{ $tag['icon'] }}"></i>
              {{ $tag['label'] }}
            </span>
          @endforeach
        </div>
        <div class="platform-hero__actions">
          <a class="platform-hero__button platform-hero__button--primary" href="#platform-catalog">
            <i data-lucide="compass"></i>
            トラックを見る
          </a>
          @guest
            <a class="platform-hero__button" href="#platform-auth-card">
              <i data-lucide="log-in"></i>
              ログイン
            </a>
          @else
            <a class="platform-hero__button" href="{{ route('dashboard') }}">
              <i data-lucide="layout-dashboard"></i>
              ダッシュボード
            </a>
          @endguest
        </div>
      </div>
    </section>

    <section class="platform-stats" aria-label="プラットフォーム規模のサマリー">
      <div class="platform-stats__grid">
        <div class="platform-stat">
          <span class="platform-stat__number">{{ number_format($platformStats['tracks'] ?? 0) }}</span>
          <span class="platform-stat__label">TRACKS</span>
        </div>
        <div class="platform-stat">
          <span class="platform-stat__number">{{ number_format($platformStats['lessons'] ?? 0) }}</span>
          <span class="platform-stat__label">LESSONS</span>
        </div>
        <div class="platform-stat">
          <span class="platform-stat__number">{{ number_format($platformStats['exercises'] ?? 0) }}</span>
          <span class="platform-stat__label">EXERCISES</span>
        </div>
      </div>
    </section>

    <section class="platform-overview" aria-label="進捗とログイン" id="platform-overview">
      <article class="platform-overview__card platform-overview__card--progress" id="platform-progress-card">
        <header class="platform-overview__header">
          <h2><i data-lucide="target"></i> 全体進捗サマリー</h2>
          <p>ログイン済みアカウントでの達成状況とコミュニティ平均を確認できます。</p>
        </header>

        <div class="platform-progress">
          <div class="platform-progress__metric">
            <span class="platform-progress__value">{{ number_format($userPercent, 1) }}</span>
            <span class="platform-progress__suffix">%</span>
            <span class="platform-progress__label">総合達成率</span>
          </div>
          <div class="platform-progress__meter" style="--progress-width: {{ min($userPercent, 100) }}%;"></div>
          <dl class="platform-progress__stats">
            <div>
              <dt>完了レッスン</dt>
              <dd>{{ number_format($userSummary['completed_lessons'] ?? 0) }}</dd>
            </div>
            <div>
              <dt>総レッスン</dt>
              <dd>{{ number_format($userSummary['total_lessons'] ?? 0) }}</dd>
            </div>
          </dl>
        </div>

        <div class="platform-community">
          <div class="platform-community__heading">
            <i data-lucide="users"></i>
            <span>コミュニティ平均</span>
          </div>
          <div class="platform-community__metrics">
            <span class="platform-community__primary">
              {{ $globalPercent !== null ? number_format($globalPercent, 1) . '%' : '---' }}
            </span>
            <div class="platform-community__meta">
              <span>学習者 {{ number_format($globalSummary['learner_count'] ?? 0) }} 人</span>
              <span>完了ログ {{ number_format($globalSummary['completed_records'] ?? 0) }}</span>
            </div>
          </div>
        </div>
      </article>

      <article class="platform-overview__card platform-overview__card--auth" id="platform-auth-card">
        <header class="platform-overview__header">
          <h2><i data-lucide="shield-check"></i> プラットフォームにログイン</h2>
          <p>スキップした場所から学習を再開し、トラック横断の進捗を保存します。</p>
        </header>

        @if (session('status'))
          <p class="platform-auth__status">{{ session('status') }}</p>
        @endif

        @auth
          <p class="platform-auth__welcome">{{ auth()->user()->name }} さん、今日も学習を続けましょう！</p>
          <div class="platform-auth__actions">
            @if (Route::has('dashboard'))
              <a class="platform-auth__button platform-auth__button--primary" href="{{ route('dashboard') }}">
                <i data-lucide="layout-dashboard"></i>
                ダッシュボードへ
              </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="platform-auth__button">
                <i data-lucide="log-out"></i>
                ログアウト
              </button>
            </form>
          </div>
        @endauth

        @guest
          <form method="POST" action="{{ route('login') }}" class="platform-auth__form">
            @csrf
            <div class="platform-auth__form-field">
              <label for="platform-email">メールアドレス</label>
              <input id="platform-email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
              @error('email')
                <p class="platform-auth__error">{{ $message }}</p>
              @enderror
            </div>

            <div class="platform-auth__form-field">
              <label for="platform-password">パスワード</label>
              <input id="platform-password" type="password" name="password" required autocomplete="current-password">
              @error('password')
                <p class="platform-auth__error">{{ $message }}</p>
              @enderror
            </div>

            <div class="platform-auth__form-meta">
              <label for="platform-remember">
                <input id="platform-remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                ログイン状態を保持
              </label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">パスワードをお忘れの場合</a>
              @endif
            </div>

            <div class="platform-auth__actions">
              <button type="submit" class="platform-auth__button platform-auth__button--primary">
                <i data-lucide="log-in"></i>
                ログイン
              </button>
              @if (Route::has('register'))
                <a class="platform-auth__button" href="{{ route('register') }}">
                  <i data-lucide="user-plus"></i>
                  新規登録
                </a>
              @endif
            </div>
          </form>
        @endguest
      </article>
    </section>

    <section class="platform-catalog" aria-labelledby="platform-catalog-title" id="platform-catalog">
      <header class="platform-catalog__header">
        <h2 class="platform-catalog__title" id="platform-catalog-title">
          <i data-lucide="layers"></i>
          学習トラック一覧
        </h2>
        <p class="platform-catalog__subtitle">
          レベルと技術領域に合わせて選べるトラック群です。ホバーすると詳細とトピックタグが表示されます。
        </p>
      </header>

      @if ($catalog->isEmpty())
        <p class="platform-catalog__empty">トラック情報が準備中です。公開までお待ちください。</p>
      @else
        <div class="platform-catalog__grid">
          @foreach ($catalog as $entry)
            @php
                $cta = $entry['cta'] ?? [];
                $ctaDisabled = $cta['disabled'] ?? false;
                $isExternal = $cta['is_external'] ?? false;
                $status = $entry['status'] ?? 'available';
                [$statusIcon, $statusLabel] = match ($status) {
                    'available' => ['check-circle', '受講可能'],
                    'preview' => ['sparkle', 'プレビュー公開'],
                    'coming_soon' => ['clock', '近日公開予定'],
                    default => ['info', '調整中'],
                };
                $statusClass = 'platform-course__status--' . str_replace('_', '-', $status);
                $topics = collect($entry['topics'] ?? [])->filter()->take(6);
            @endphp

            <article class="platform-course platform-course--{{ $entry['color'] ?? 'default' }} {{ $ctaDisabled ? 'platform-course--disabled' : '' }}">
              <header class="platform-course__header">
                <span class="platform-course__icon-wrap">
                  @if (!empty($entry['icon_svg']))
                    <img class="platform-course__icon" src="{{ $entry['icon_svg'] }}" alt="{{ $entry['short_label'] ?? $entry['label'] ?? 'Track icon' }} アイコン">
                  @endif
                  @if (empty($entry['icon_svg']) && !empty($entry['icon_class']))
                    <i class="platform-course__icon {{ $entry['icon_class'] }}"></i>
                  @endif
                  @if (empty($entry['icon_svg']) && empty($entry['icon_class']))
                    <i class="platform-course__icon" data-lucide="{{ $entry['icon'] ?? 'layers' }}"></i>
                  @endif
                </span>
                <div class="platform-course__titles">
                  @if (!empty($entry['type']))
                    <span class="platform-course__type">{{ $entry['type'] }}</span>
                  @elseif (!empty($entry['category']))
                    <span class="platform-course__type">{{ $entry['category'] }}</span>
                  @endif
                  <h3 class="platform-course__name">{{ $entry['label'] }}</h3>
                </div>
                @if (!empty($entry['badge']))
                  <span class="platform-course__badge">{{ $entry['badge'] }}</span>
                @endif
              </header>

              @if (!empty($entry['description']))
                <p class="platform-course__description">{{ $entry['description'] }}</p>
              @endif

              @if ($topics->isNotEmpty())
                <div class="platform-course__details">
                  <ul class="platform-course__topics" role="list">
                    @foreach ($topics as $topic)
                      <li class="platform-course__topic" role="listitem">{{ $topic }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="platform-course__hover">
                <div class="platform-course__meta">
                  @if (!empty($entry['tracks']))
                    <div>
                      <span class="platform-course__meta-label">TRACKS</span>
                      <span class="platform-course__meta-value">{{ number_format($entry['tracks']) }}</span>
                    </div>
                  @endif
                  @if (!empty($entry['lessons']))
                    <div>
                      <span class="platform-course__meta-label">LESSONS</span>
                      <span class="platform-course__meta-value">{{ number_format($entry['lessons']) }}</span>
                    </div>
                  @endif
                  @if (!empty($entry['exercises']))
                    <div>
                      <span class="platform-course__meta-label">EXERCISES</span>
                      <span class="platform-course__meta-value">{{ number_format($entry['exercises']) }}</span>
                    </div>
                  @endif
                </div>

                <footer class="platform-course__footer">
                  <span class="platform-course__status {{ $statusClass }}">
                    <i data-lucide="{{ $statusIcon }}"></i>
                    {{ $statusLabel }}
                  </span>

                  @if (!empty($cta['url']))
                    @if ($ctaDisabled)
                      <span class="platform-course__cta platform-course__cta--disabled">
                        {{ $cta['label'] }}
                      </span>
                    @else
                      <a
                        class="platform-course__cta"
                        href="{{ $cta['url'] }}"
                        @if ($isExternal) target="_blank" rel="noopener" @endif
                      >
                        {{ $cta['label'] }}
                        <i data-lucide="arrow-up-right"></i>
                      </a>
                    @endif
                  @endif
                </footer>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>
  </div>
@endsection

