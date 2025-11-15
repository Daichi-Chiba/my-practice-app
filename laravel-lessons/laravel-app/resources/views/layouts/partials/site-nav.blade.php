@if (request()->routeIs('global-top'))
<header class="site-header platform-top-nav" data-platform-nav>
  <div class="platform-top-nav__inner">
    <div class="platform-top-nav__branding">
      <span class="platform-top-nav__badge" aria-hidden="true">
        <i data-lucide="sparkle"></i>
      </span>
      <div class="platform-top-nav__meta">
        <span class="platform-top-nav__eyebrow">Learning Platform</span>
        <span class="platform-top-nav__title">Bootcamp Platform TOP</span>
      </div>
    </div>
    <button class="platform-top-nav__toggle" type="button" data-platform-nav-toggle aria-expanded="false" aria-controls="platform-top-nav-drawer" aria-label="メニューを開閉">
      <span class="platform-top-nav__toggle-icon" aria-hidden="true" data-platform-nav-toggle-icon>
        <i data-lucide="menu"></i>
      </span>
    </button>
  </div>

  <div class="platform-top-nav__overlay" data-platform-nav-overlay></div>

  <nav class="platform-top-nav__drawer" id="platform-top-nav-drawer" aria-hidden="true" data-platform-nav-drawer aria-label="Bootcamp Platform メニュー">
    @php
      $platformLinks = [
        ['href' => '#platform-hero', 'icon' => 'sparkles', 'label' => 'プラットフォーム概要'],
        ['href' => '#platform-overview', 'icon' => 'target', 'label' => '進捗サマリー'],
        ['href' => '#platform-catalog', 'icon' => 'layers', 'label' => '学習トラック一覧'],
        // ['href' => '#platform-auth-card', 'icon' => 'log-in', 'label' => 'ログイン / 登録'],
      ];

      $platformLinkIcons = [
        'sparkles' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v4"/><path d="M3 5h4"/><path d="M19 17v4"/><path d="M17 19h4"/><path d="M12 5l1.9 3.7L18 10l-3.7 1.9L12 15l-1.9-3.1L7 10l3.1-1.3L12 5z"/></svg>',
        'target' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="7"/><path d="M12 5v2"/><path d="M5 12h2"/><path d="M12 17v2"/><path d="M17 12h2"/><circle cx="12" cy="12" r="2.5"/></svg>',
        'layers' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M3 12l9 5 9-5"/><path d="M3 17l9 5 9-5"/></svg>',
        'log-in' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>',
      ];

      $accountIcons = [
        'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>',
        'logout' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>',
        'login' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>',
        'register' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="3.5"/><path d="M6 21v-1.5A4.5 4.5 0 0 1 10.5 15h3A4.5 4.5 0 0 1 18 19.5V21"/></svg>',
      ];
    @endphp
    <div class="platform-top-nav__drawer-inner">
      <div class="platform-top-nav__drawer-header">
        <div class="platform-top-nav__drawer-heading">
          <h3 class="platform-top-nav__drawer-title">メニュー</h3>
          <p class="platform-top-nav__drawer-subtitle">Learning Platform</p>
        </div>
        <button class="platform-top-nav__drawer-close" type="button" data-platform-nav-close>
          <i data-lucide="x"></i>
        </button>
      </div>
      <div class="platform-top-nav__section">
        <ul class="platform-top-nav__links" role="list">
          @foreach($platformLinks as $link)
            <li>
              <a class="platform-top-nav__link" href="{{ $link['href'] }}">
                <span class="platform-top-nav__link-icon" aria-hidden="true">{!! $platformLinkIcons[$link['icon']] ?? $platformLinkIcons['sparkles'] !!}</span>
                <span class="platform-top-nav__link-label">{{ $link['label'] }}</span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="platform-top-nav__section platform-top-nav__section--account">
        <div class="platform-top-nav__account">
          @auth
            <a class="platform-top-nav__account-link" href="{{ route('dashboard') }}">
              <span class="platform-top-nav__account-icon" aria-hidden="true">{!! $accountIcons['dashboard'] !!}</span>
              <span>ダッシュボードへ</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="platform-top-nav__account-link" type="submit">
                <span class="platform-top-nav__account-icon" aria-hidden="true">{!! $accountIcons['logout'] !!}</span>
                <span>ログアウト</span>
              </button>
            </form>
          @else
            @if(Route::has('login'))
              <a class="platform-top-nav__account-link" href="{{ route('login') }}">
                <span class="platform-top-nav__account-icon" aria-hidden="true">{!! $accountIcons['login'] !!}</span>
                <span>ログイン</span>
              </a>
            @endif
            @if(Route::has('register'))
              <a class="platform-top-nav__account-link" href="{{ route('register') }}">
                <span class="platform-top-nav__account-icon" aria-hidden="true">{!! $accountIcons['register'] !!}</span>
                <span>新規登録</span>
              </a>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
@else
<header class="site-header" data-site-nav>
  <div class="site-header__inner">
    <a class="site-brand" href="{{ route('home') }}">
      <span class="site-brand__icon" aria-hidden="true">
        <i data-lucide="sparkle"></i>
      </span>
      <span class="site-brand__eyebrow">Bootcamp Platform</span>
      <span class="site-brand__label">Laravel Lessons</span>
    </a>

    <button class="site-nav__toggle" type="button" data-site-nav-toggle aria-expanded="false" aria-controls="site-global-menu">
      <span class="sr-only">メニューを開閉</span>
      <span class="site-nav__toggle-icon" aria-hidden="true">
        <i data-lucide="menu"></i>
      </span>
      <span class="site-nav__toggle-icon site-nav__toggle-icon--close" aria-hidden="true">
        <i data-lucide="x"></i>
      </span>
    </button>

    @php
      $curriculumHome = route('home');

      $curriculumTiers = [
        [
          'id' => 'beginner',
          'label' => 'Tier 1 · Beginner Foundation',
          'description' => '環境構築から基本CRUDまでの土台作り',
          'lessons' => [
            ['code' => 'Lesson 01', 'title' => '環境構築とLaravel概要', 'anchor' => 'lesson-01'],
            ['code' => 'Lesson 02', 'title' => 'ルーティング基礎', 'anchor' => 'lesson-02'],
            ['code' => 'Lesson 03', 'title' => 'リクエストとコントローラ', 'anchor' => 'lesson-03'],
            ['code' => 'Lesson 04', 'title' => 'BladeテンプレートとUI', 'anchor' => 'lesson-04'],
            ['code' => 'Lesson 05', 'title' => 'マイグレーションとモデル', 'anchor' => 'lesson-05'],
            ['code' => 'Lesson 06', 'title' => 'SeederとFactory', 'anchor' => 'lesson-06'],
            ['code' => 'Lesson 07', 'title' => 'Artisan CLIとTinker', 'anchor' => 'lesson-07'],
            ['code' => 'Lesson 08', 'title' => '設定と環境変数', 'anchor' => 'lesson-08'],
            ['code' => 'Lesson 09', 'title' => 'フォームとバリデーション', 'anchor' => 'lesson-09'],
            ['code' => 'Lesson 10', 'title' => 'セッションとフラッシュ', 'anchor' => 'lesson-10'],
            ['code' => 'Lesson 11', 'title' => 'アセットとVite', 'anchor' => 'lesson-11'],
            ['code' => 'Lesson 12', 'title' => 'リレーション入門', 'anchor' => 'lesson-12'],
            ['code' => 'Lesson 13', 'title' => 'クエリビルダと条件分岐', 'anchor' => 'lesson-13'],
            ['code' => 'Lesson 14', 'title' => 'コレクションとヘルパ', 'anchor' => 'lesson-14'],
            ['code' => 'Lesson 15', 'title' => 'Blade UI仕上げ', 'anchor' => 'lesson-15'],
          ],
        ],
        [
          'id' => 'intermediate',
          'label' => 'Tier 2 · Intermediate Build',
          'description' => '実践機能の実装とAPI・テストの導入',
          'lessons' => [
            ['code' => 'Lesson 16', 'title' => 'リソースコントローラとCRUD', 'anchor' => 'lesson-16'],
            ['code' => 'Lesson 17', 'title' => 'フォームリクエストとカスタムルール', 'anchor' => 'lesson-17'],
            ['code' => 'Lesson 18', 'title' => '多対多と中間テーブル', 'anchor' => 'lesson-18'],
            ['code' => 'Lesson 19', 'title' => 'イベントとリスナ', 'anchor' => 'lesson-19'],
            ['code' => 'Lesson 20', 'title' => '通知（Notifications）', 'anchor' => 'lesson-20'],
            ['code' => 'Lesson 21', 'title' => 'ジョブとキュー', 'anchor' => 'lesson-21'],
            ['code' => 'Lesson 22', 'title' => 'API ResourceとTransformer', 'anchor' => 'lesson-22'],
            ['code' => 'Lesson 23', 'title' => '認証強化（Sanctum/Fortify）', 'anchor' => 'lesson-23'],
            ['code' => 'Lesson 24', 'title' => 'Gate/Policyによる認可', 'anchor' => 'lesson-24'],
            ['code' => 'Lesson 25', 'title' => 'ファイルストレージ高度化', 'anchor' => 'lesson-25'],
            ['code' => 'Lesson 26', 'title' => 'メールとキャンペーン', 'anchor' => 'lesson-26'],
            ['code' => 'Lesson 27', 'title' => 'テスト自動化基礎', 'anchor' => 'lesson-27'],
            ['code' => 'Lesson 28', 'title' => 'ブラウザテスト(Dusk)', 'anchor' => 'lesson-28'],
            ['code' => 'Lesson 29', 'title' => '多言語化(Localization)', 'anchor' => 'lesson-29'],
            ['code' => 'Lesson 30', 'title' => 'InertiaとSPA連携', 'anchor' => 'lesson-30'],
          ],
        ],
        [
          'id' => 'advanced',
          'label' => 'Tier 3 · Advanced Operations',
          'description' => '設計・運用・スケールで実務レベルへ',
          'lessons' => [
            ['code' => 'Lesson 31', 'title' => 'クリーンアーキテクチャ設計', 'anchor' => 'lesson-31'],
            ['code' => 'Lesson 32', 'title' => 'ドメインイベントとCQRS概論', 'anchor' => 'lesson-32'],
            ['code' => 'Lesson 33', 'title' => '高度なキャッシュ戦略', 'anchor' => 'lesson-33'],
            ['code' => 'Lesson 34', 'title' => 'ジョブチェーンとバッチ', 'anchor' => 'lesson-34'],
            ['code' => 'Lesson 35', 'title' => 'スケジューラとタスク管理', 'anchor' => 'lesson-35'],
            ['code' => 'Lesson 36', 'title' => 'WebSocketとリアルタイム', 'anchor' => 'lesson-36'],
            ['code' => 'Lesson 37', 'title' => 'SPA認証とフロント統合', 'anchor' => 'lesson-37'],
            ['code' => 'Lesson 38', 'title' => 'パフォーマンス計測と最適化', 'anchor' => 'lesson-38'],
            ['code' => 'Lesson 39', 'title' => 'セキュリティ強化', 'anchor' => 'lesson-39'],
            ['code' => 'Lesson 40', 'title' => 'マイクロサービス/API連携', 'anchor' => 'lesson-40'],
            ['code' => 'Lesson 41', 'title' => 'DevOpsとデプロイ', 'anchor' => 'lesson-41'],
            ['code' => 'Lesson 42', 'title' => '監視とロギング', 'anchor' => 'lesson-42'],
            ['code' => 'Lesson 43', 'title' => 'ビジネスルール自動化', 'anchor' => 'lesson-43'],
            ['code' => 'Lesson 44', 'title' => 'AI/外部サービス統合', 'anchor' => 'lesson-44'],
            ['code' => 'Lesson 45', 'title' => '総合演習（Capstone）', 'anchor' => 'lesson-45'],
          ],
        ],
      ];

      $exerciseTiers = collect($curriculumTiers)->map(function ($tier) use ($curriculumHome) {
        return [
          'id' => $tier['id'],
          'label' => $tier['label'],
          'description' => $tier['description'],
          'exercises' => collect($tier['lessons'])->map(function ($lesson) {
            return [
              'code' => $lesson['code'],
              'title' => $lesson['title'] . ' 演習',
              'anchor' => str_replace('lesson', 'exercise', $lesson['anchor']),
            ];
          })->all(),
        ];
      })->all();
    @endphp

    <nav class="site-nav" id="site-global-menu" aria-label="グローバルナビゲーション">
      <ul class="site-nav__list">
        <li class="site-nav__item">
          <a class="site-nav__link site-nav__link--ghost" href="{{ route('global-top') }}">
            <i data-lucide="globe"></i>
            <span>プラットフォーム TOP</span>
          </a>
        </li>
        <li class="site-nav__item">
          <a class="site-nav__link" href="{{ $curriculumHome }}#program-overview">
            <i data-lucide="map"></i>
            <span>カリキュラム概要</span>
          </a>
        </li>
        @guest
          @if(Route::has('login'))
            <li class="site-nav__item">
              <a class="site-nav__link" href="{{ route('login') }}">
                <i data-lucide="log-in"></i>
                <span>ログイン</span>
              </a>
            </li>
          @endif
          @if(Route::has('register'))
            <li class="site-nav__item">
              <a class="site-nav__link" href="{{ route('register') }}">
                <i data-lucide="user-plus"></i>
                <span>新規登録</span>
              </a>
            </li>
          @endif
        @else
          <li class="site-nav__item">
            <a class="site-nav__link" href="{{ route('dashboard') }}">
              <i data-lucide="layout-dashboard"></i>
              <span>ダッシュボード</span>
            </a>
          </li>
          <li class="site-nav__item">
            <form class="site-nav__link site-nav__link--button" method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit">
                <i data-lucide="log-out"></i>
                <span>ログアウト</span>
              </button>
            </form>
          </li>
        @endguest
        <li class="site-nav__item site-nav__item--dropdown">
          <button class="site-nav__link" type="button" data-site-nav-dropdown aria-expanded="false">
            <i data-lucide="book-open"></i>
            <span>全45レッスン</span>
            <span class="site-nav__chevron" aria-hidden="true">
              <i data-lucide="chevron-down"></i>
            </span>
          </button>
          <div class="site-nav__dropdown site-nav__dropdown--mega" aria-label="レッスン一覧">
            @foreach($curriculumTiers as $tier)
              <section class="site-nav__mega-section">
                <header class="site-nav__mega-header">
                  <span class="site-nav__mega-label">{{ $tier['label'] }}</span>
                  <p class="site-nav__mega-description">{{ $tier['description'] }}</p>
                </header>
                <ul class="site-nav__mega-list" role="list">
                  @foreach($tier['lessons'] as $lesson)
                    @php
                      $href = $curriculumHome . '#' . $tier['id'] . '-' . $lesson['anchor'];
                    @endphp
                    <li class="site-nav__mega-item">
                      <a class="site-nav__mega-link" href="{{ $href }}">
                        <span class="site-nav__mega-code">{{ $lesson['code'] }}</span>
                        <span class="site-nav__mega-title">{{ $lesson['title'] }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </section>
            @endforeach
          </div>
        </li>
        <li class="site-nav__item site-nav__item--dropdown">
          <button class="site-nav__link" type="button" data-site-nav-dropdown aria-expanded="false">
            <i data-lucide="clipboard-list"></i>
            <span>全45演習</span>
            <span class="site-nav__chevron" aria-hidden="true">
              <i data-lucide="chevron-down"></i>
            </span>
          </button>
          <div class="site-nav__dropdown site-nav__dropdown--mega" aria-label="演習一覧">
            @foreach($exerciseTiers as $tier)
              <section class="site-nav__mega-section">
                <header class="site-nav__mega-header">
                  <span class="site-nav__mega-label">{{ $tier['label'] }}</span>
                  <p class="site-nav__mega-description">{{ $tier['description'] }}</p>
                </header>
                <ul class="site-nav__mega-list" role="list">
                  @foreach($tier['exercises'] as $exercise)
                    @php
                      $href = $curriculumHome . '#' . $tier['id'] . '-' . $exercise['anchor'];
                    @endphp
                    <li class="site-nav__mega-item">
                      <a class="site-nav__mega-link" href="{{ $href }}">
                        <span class="site-nav__mega-code">{{ $exercise['code'] }}</span>
                        <span class="site-nav__mega-title">{{ $exercise['title'] }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </section>
            @endforeach
          </div>
        </li>
        <li class="site-nav__item">
          <a class="site-nav__link" href="{{ $curriculumHome }}#capstone">
            <i data-lucide="sparkles"></i>
            <span>Capstone</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>
@endif
