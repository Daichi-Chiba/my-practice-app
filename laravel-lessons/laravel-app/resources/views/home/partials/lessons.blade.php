@php
  $lessonCards = [
    [
      'route' => 'lesson00',
      'number' => '00',
      'code' => 'Lesson 00',
      'title' => 'コーディング準備',
      'type' => '環境 / 用語',
      'description' => 'Mac / Windows で学習環境を整備し、CLI・GitHub・パッケージマネージャーなど基礎用語を理解します。',
      'topics' => ['Homebrew', 'winget', 'WSL'],
    ],
    [
      'route' => 'lesson01',
      'number' => '01',
      'code' => 'Lesson 01',
      'title' => '環境構築とGitフロー',
      'type' => '環境構築 / Git / Debug',
      'description' => 'Docker×Laravelの環境構築、GitHub Flow、デバッグツール導入まで。現場での立ち上げスピードを高めます。',
      'topics' => ['Docker', 'GitHub Flow', 'Debugbar'],
    ],
    [
      'route' => 'lesson02',
      'number' => '02',
      'code' => 'Lesson 02',
      'title' => 'ルーティング / コントローラ',
      'type' => 'REST / Middleware',
      'description' => 'REST設計、命名規約、リソースコントローラ、認可ミドルウェアを体系的に学習します。',
      'topics' => ['REST', 'Resource', 'Middleware'],
    ],
    [
      'route' => 'lesson03',
      'number' => '03',
      'code' => 'Lesson 03',
      'title' => 'モデルとデータ設計',
      'type' => 'Eloquent / Seed',
      'description' => '占いアプリのDB設計、マイグレーション、シーダ、Eloquentの基本操作を通して設計力を鍛えます。',
      'topics' => ['Migration', 'Seeder', 'Eloquent'],
    ],
    [
      'route' => 'lesson04',
      'number' => '04',
      'code' => 'Lesson 04',
      'title' => 'N+1問題と最適化',
      'type' => 'Performance',
      'description' => 'N+1問題の検知・解消、Eager Loading、Telescopeなどを活用しパフォーマンス最適化を実践します。',
      'topics' => ['Eager Loading', 'Debugbar', 'Telescope'],
    ],
    [
      'route' => 'lesson05',
      'number' => '05',
      'code' => 'Lesson 05',
      'title' => 'バリデーション / エラー処理',
      'type' => 'FormRequest / Logging',
      'description' => 'FormRequestと例外ハンドリングで入力検証とレスポンスを統一し、ログ運用の基礎を固めます。',
      'topics' => ['FormRequest', 'Exception', 'Logging'],
    ],
    [
      'route' => 'lesson06',
      'number' => '06',
      'code' => 'Lesson 06',
      'title' => '認証・認可・セキュリティ',
      'type' => 'Auth / Policy',
      'description' => 'Sanctumを使ったAPI認証、RBAC、ポリシー、CSRF/XSS対策を総合的に学びます。',
      'topics' => ['Sanctum', 'Policy', 'Security'],
    ],
    [
      'route' => 'lesson07',
      'number' => '07',
      'code' => 'Lesson 07',
      'title' => 'テストとTDD',
      'type' => 'PHPUnit / CI',
      'description' => 'Feature / Unit テスト、モック、CI連携で品質を担保し、リファクタリングを安全に進める力を養います。',
      'topics' => ['PHPUnit', 'Mock', 'CI/CD'],
    ],
    [
      'route' => 'lesson08',
      'number' => '08',
      'code' => 'Lesson 08',
      'title' => 'API設計とバージョニング',
      'type' => 'REST / Docs',
      'description' => 'APIリソース、レートリミット、バージョニング戦略、OpenAPIドキュメントで外部連携に強くなります。',
      'topics' => ['API Resource', 'Rate Limit', 'OpenAPI'],
    ],
    [
      'route' => 'lesson09',
      'number' => '09',
      'code' => 'Lesson 09',
      'title' => 'ジョブ / 非同期処理',
      'type' => 'Queue / Schedule',
      'description' => 'Queue / Job 設計、スケジューラ運用、リトライポリシー、失敗ジョブ監視で運用負荷を下げます。',
      'topics' => ['Queue', 'Schedule', 'Retry'],
    ],
    [
      'route' => 'lesson10',
      'number' => '10',
      'code' => 'Lesson 10',
      'title' => 'デプロイと運用保守',
      'type' => 'Ops / Monitoring',
      'description' => 'ゼロダウンタイムデプロイ、監視、ログ設計、バックアップまで保守運用ノウハウを整理します。',
      'topics' => ['Deploy', 'Monitoring', 'Backup'],
    ],
  ];
@endphp

<section class="catalog-lessons" aria-labelledby="catalog-lessons-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-lessons-title">レッスン一覧</h2>
    <p class="catalog-section-subtitle">
      一つの占い Web アプリを題材に、環境構築から運用保守までを段階的に学習します。興味のある領域からの選択受講も可能です。
    </p>
  </div>
  <div class="catalog-lessons__grid">
    @foreach($lessonCards as $lesson)
      @if(Route::has($lesson['route']))
        <a class="catalog-card" href="{{ route($lesson['route']) }}">
          <div class="catalog-card__header">
            <span class="catalog-card__number">{{ $lesson['number'] }}</span>
            <div class="catalog-card__titles">
              <span class="catalog-card__code">{{ $lesson['code'] }}</span>
              <span class="catalog-card__title">{{ $lesson['title'] }}</span>
              <span class="catalog-card__type">{{ $lesson['type'] }}</span>
            </div>
          </div>
          <p class="catalog-card__description">{{ $lesson['description'] }}</p>
          <ul class="catalog-card__topics">
            @foreach($lesson['topics'] as $topic)
              <li class="catalog-card__topic">{{ $topic }}</li>
            @endforeach
          </ul>
          <span class="catalog-card__icon" aria-hidden="true">
            <i data-lucide="arrow-up-right"></i>
          </span>
        </a>
      @endif
    @endforeach
  </div>
</section>
