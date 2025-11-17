@section('title', 'Lesson 10 演習 - デプロイと運用保守')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson10') }}">Lesson 10</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 10 演習: 運用を支えるデプロイと監視</h1>
  <p class="exercise-hero__lead">
    Fortune API を本番運用に耐えるサービスへ仕上げます。ゼロダウンタイムデプロイ、監視・アラート、バックアップ、インシデント対応まで
    一連の運用基盤を整備しましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">CI/CD</li>
    <li class="exercise-hero__tag">Observability</li>
    <li class="exercise-hero__tag">Incident</li>
    <li class="exercise-hero__tag">Backup</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="rocket"></i> 課題 1: デプロイパイプラインの構築</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      GitHub Actions とサーバースクリプトを組み合わせ、main ブランチへのマージで自動デプロイされる仕組みを整備します。
    </p>
    <ol class="exercise-card__steps">
      <li>テスト・ビルド・デプロイを含むワークフローを作成し、秘密情報は GitHub Secrets で管理</li>
      <li>Envoy / Deployer などのツールでリリースディレクトリを切り替える Zero Downtime フローを整備</li>
      <li>デプロイ結果を Slack 通知し、失敗時は自動ロールバックできるようにする</li>
    </ol>
  </div>
  @php
    $lesson10Task1Hints = [
      new \Illuminate\Support\HtmlString('まずは main ブランチ push / PR merge をトリガーに、<code>checkout</code> → <code>setup-php</code> → <code>composer install</code> → <code>phpunit</code> といった基本ステップを YAML で書き出しましょう。'),
      new \Illuminate\Support\HtmlString('ゼロダウンタイムは <code>artisan down</code> を使わず、Envoy や Deployer の <code>deploy:publish</code> タスクでリリースディレクトリを切り替えるのが安全です。ロールバック用の <code>deploy:rollback</code> も用意すると迅速です。'),
      new \Illuminate\Support\HtmlString('Slack 通知には公式の Incoming Webhooks か <code>8398a7/action-slack</code> のようなアクションが便利です。失敗時通知は <code>if: failure()</code> を指定するのを忘れずに。'),
    ];

    $lesson10Task1Answer = new \Illuminate\Support\HtmlString(<<<'HTML'
<p>以下は GitHub Actions + Deployer を使った最小構成の例です。Secrets には <code>DEPLOY_HOST</code>, <code>DEPLOY_USER</code>, <code>DEPLOY_PRIVATE_KEY</code>, <code>SLACK_WEBHOOK</code> などを登録しておきます。</p>
<pre><code class="language-yaml">name: deploy

on:
  push:
    branches: [ main ]

jobs:
  build-test-deploy:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, intl
          coverage: none
      - run: composer install --no-dev --optimize-autoloader
      - run: php artisan config:cache && php artisan route:cache
      - run: php artisan test --testsuite=Feature

      - name: Deploy via Deployer
        run: |
          echo "[DEPLOY] publishing new release"
          vendor/bin/dep deploy production
        env:
          DOTENV_PRIVATE_KEY: "${DEPLOY_PRIVATE_KEY}"

      - name: Notify success
        if: success()
        uses: slackapi/slack-github-action@v1.24.0
        with:
          payload: |
            {"text": "✅ Deploy succeeded for ${GITHUB_SHA}"}
        env:
          SLACK_WEBHOOK_URL: "${SLACK_WEBHOOK_URL}"

      - name: Notify failure
        if: failure()
        uses: slackapi/slack-github-action@v1.24.0
        with:
          payload: |
            {"text": "🚨 Deploy failed! Rolling back..."}
        env:
          SLACK_WEBHOOK_URL: "${SLACK_WEBHOOK_URL}"
</code></pre>
<p>Secrets は GitHub Actions 内で <code>$&#123;&#123; secrets.DEPLOY_PRIVATE_KEY &#125;&#125;</code> や <code>$&#123;&#123; secrets.SLACK_WEBHOOK &#125;&#125;</code> の形式で参照します。上記では分かりやすさのために環境変数名に置き換えています。Deployer 側では <code>deploy.php</code> に Blue/Green 用の <code>prod_current</code> シンボリックリンクを切り替えるレシピと、<code>rollback</code> タスクを用意しておきます。Slack 通知は <code>if: failure()</code> で失敗時もキャッチし、ロールバックを実行する Runner か、オペレーションガイドに従って即座に戻せる体制にします。</p>
HTML);
  @endphp

  <x-exercise.reveal id="lesson10-task1" :hints="$lesson10Task1Hints" :answer="$lesson10Task1Answer" />
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="radar"></i> 課題 2: 可観測性ダッシュボード</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      ログ・メトリクス・トレースを統合したダッシュボードを準備し、SLO を定義します。
    </p>
    <ol class="exercise-card__steps">
      <li>Grafana / Datadog に API レスポンス時間・エラーレート・ジョブ失敗数を可視化するダッシュボードを作成</li>
      <li>Alerting ルールを設定し、SLO 逸脱時にオンコールへ通知</li>
      <li>README に監視 URL・SLO 指標・アラート閾値を明記</li>
    </ol>
  </div>
  @php
    $lesson10Task2Hints = [
      new \Illuminate\Support\HtmlString('可観測性は「ログ」「メトリクス」「トレース」の3本柱。まずアクセスログや Laravel Telescope の情報を構造化ログとして集約し、必要に応じて OpenTelemetry Exporter を追加しましょう。'),
      new \Illuminate\Support\HtmlString('SLO を定義する場合は、サービスレベル指標 (SLI) を数式で表現します。例: <code>1 - (5xx_requests / total_requests)</code> を月間 99.5% など。SLA ではなく SLO で運用チームと合意するのがポイントです。'),
      new \Illuminate\Support\HtmlString('通知設計ではオンコールスケジュールと連携する PagerDuty / Opsgenie を利用するか、Slack チャンネルへの Webhook を設定します。通知のしきい値は「Warning」と「Critical」の二段構成にすると運用負荷を下げられます。'),
    ];

    $lesson10Task2Answer = new \Illuminate\Support\HtmlString(<<<'HTML'
<p>Datadog を例にした可観測性セットアップの概要です。</p>
<ol>
  <li>
    <strong>ログ:</strong> Laravel の <code>monolog</code> を Datadog 連携に切り替え、JSON 形式で <code>service: fortune-api</code> タグを付与。ジョブ失敗時には <code>level=error</code> で送信します。
  </li>
  <li>
    <strong>メトリクス:</strong> StatsD クライアントを組み込み、<code>response_time</code>（ms）、<code>queue.failed_jobs</code>、<code>cache.hit_ratio</code> などを収集。<br>
    Datadog ダッシュボードでは以下のウィジェットを配置します。
    <ul>
      <li>Timeseries: P95 レスポンス時間 (API)</li>
      <li>Query Value: 1分間の 5xx Rate</li>
      <li>Heatmap: Queue latency</li>
    </ul>
  </li>
  <li>
    <strong>トレース:</strong> Laravel Octane + OpenTelemetry Collector で <code>ddtrace</code> を導入し、主要エンドポイントのトレーシングを可視化。ボトルネックや N+1 を特定します。
  </li>
</ol>
<p>SLO 定義は README に次のように記載します。</p>
<pre><code class="language-md">## Service Level Objective
- Availability (API): 99.5% (月間)
- Error budget: 0.5% (約 3.6 時間/月)
- Latency: P95 < 450ms (API v1)

Alert Policy
- Warning: エラーレート 2 分間連続 1%
- Critical: エラーレート 1 分間連続 5%
- Queue Delay > 5 分で Warning
</code></pre>
<p>通知は Datadog の Integrations から Slack と PagerDuty を設定し、SLO 逸脱時にオンコールへ自動で飛ぶようにします。README にはダッシュボード URL、主なクエリ例、SLO 計測方法を明記してチーム全員が参照できるようにしましょう。</p>
HTML);
  @endphp

  <x-exercise.reveal id="lesson10-task2" :hints="$lesson10Task2Hints" :answer="$lesson10Task2Answer" />
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="life-buoy"></i> 課題 3: インシデントレスポンスの整備</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      障害発生時の初動・ロールバック・コミュニケーションをまとめた Runbook を作成します。
    </p>
    <ol class="exercise-card__steps">
      <li>重大度ごとに初動対応フローを定義し、担当者・連絡手段・エスカレーションパスを文書化</li>
      <li>ロールバック手順とポストモーテムのテンプレートを用意</li>
      <li>ステータスページの更新手順や顧客通知テンプレートを整備</li>
    </ol>
  </div>
  @php
    $lesson10Task3Hints = [
      new \Illuminate\Support\HtmlString('重大度 (Severity) は「SEV-1: 全障害」「SEV-2: 部分的」「SEV-3: 影響軽微」など 3〜4 段階に分けると運用しやすいです。それぞれの初動担当（Incident Commander など）を決めましょう。'),
      new \Illuminate\Support\HtmlString('ポストモーテムは「事実→影響→根本原因→対策」のテンプレートを用意。非難 culture を避け、学びにフォーカスするためのガイドを記載します。'),
      new \Illuminate\Support\HtmlString('顧客通知文は事前に素案を用意しておくと混乱時でも迅速です。Statuspage などの SaaS を使う場合は、投稿時のレビュー手順も含めておきます。'),
    ];

    $lesson10Task3Answer = new \Illuminate\Support\HtmlString(<<<'HTML'
<p>Runbook のサンプル構成です。</p>
<pre><code class="language-md"># Incident Runbook

## Severity Levels
- SEV-1 (Critical): 全ユーザー影響。IC: SRE リーダー、Comms: PM
- SEV-2 (High): 一部機能停止。IC: オンコール SRE、Comms: サポート
- SEV-3 (Medium): パフォーマンス低下。IC: オンコール SRE、Comms: サポート

## 初動フロー (SEV-1)
1. オンコールが PagerDuty 通知を受信し 5 分以内に応答
2. Incident Commander (IC) が Slack #incident チャンネルを開設し、状況を共有
3. ロールバック要否の判断を 10 分以内に行い、必要なら Deployer で `dep rollback production`
4. 30 分以内に顧客向け一次報告 (Statuspage) を発信

## ロールバック手順
- `dep deploy:list` で直近のリリース一覧を確認
- `dep rollback production` を実行し、結果を Slack へ投稿
- DB マイグレーションが絡む場合は `php artisan migrate:rollback --step=1`

## ポストモーテム テンプレート
- タイムライン
- 影響範囲 (ユーザー数 / 売上 / KPI)
- 根本原因
- 対策 (即時 / 短期 / 長期)
- 学びとアクションアイテム（担当者と期限付き）

## ステータスページ更新フロー
1. Draft を作成し IC がレビュー
2. PM / CS が顧客へのメールテンプレを確認
3. 公開後、Slack #notice へ URL を共有
</code></pre>
<p>連絡手段には Slack / Zoom / 電話など複数経路を用意し、「誰が」「どのタイミングで」判断するかを明示します。定期的な模擬訓練（GameDay）を実施し、Runbook が陳腐化していないかチェックしましょう。</p>
HTML);
  @endphp

  <x-exercise.reveal id="lesson10-task3" :hints="$lesson10Task3Hints" :answer="$lesson10Task3Answer" />
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="database"></i> 課題 4: バックアップと DR テスト</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      データを安全に保管し、定期的に復旧できることを証明します。
    </p>
    <ol class="exercise-card__steps">
      <li>DB / ファイルのバックアップポリシーを決め、スクリプトやマネージドサービスで自動取得</li>
      <li>ステージング環境で定期的にリストアテストを実施し、手順を Runbook に追記</li>
      <li>災害時の復旧目標 (RPO/RTO) を定義し、経営層・関係者と合意</li>
    </ol>
    <div class="exercise-note">
      <strong>ヒント:</strong> バックアップは取得しただけでは意味がありません。復旧訓練を通じて信頼性を確認しましょう。
    </div>
  </div>
  @php
    $lesson10Task4Hints = [
      new \Illuminate\Support\HtmlString('バックアップ方式は「フル」「差分」「増分」のどれを採用するか、保存期間 (Retention) をどうするかを最初に決めます。S3 Glacier などコスト最適化も考慮しましょう。'),
      new \Illuminate\Support\HtmlString('リストア訓練は、ステージング環境へ <code>pg_restore</code> や <code>mysqldump</code> からの復元を自動化し、結果を Slack へ報告する CI ジョブを作ると定期的に回せます。'),
      new \Illuminate\Support\HtmlString('RPO (復旧可能なデータ損失時間) と RTO (復旧にかけられる最大時間) はビジネス側と握る指標です。例: RPO 15 分、RTO 60 分など。'),
    ];

    $lesson10Task4Answer = new \Illuminate\Support\HtmlString(<<<'HTML'
<p>バックアップ &amp; DR ポリシーの例です。</p>
<ul>
  <li>DB: Amazon RDS の自動バックアップ (7 日保持) + 1日1回のスナップショットを別リージョンへコピー</li>
  <li>アプリ資産: S3 バケットへ <code>aws s3 sync</code> でアップロードし、Ver.管理を有効化</li>
  <li>Secrets: AWS Secrets Manager / Vault で暗号化保管</li>
</ul>
<p>週次で GitHub Actions からリストアテストを実行します。</p>
<pre><code class="language-yaml">name: restore-drill

on:
  schedule:
    - cron: '0 22 * * 0' # 毎週月曜 JST

jobs:
  restore-test:
    runs-on: ubuntu-latest
    steps:
      - name: Restore DB to staging
        run: |
          aws rds restore-db-instance-from-db-snapshot \
            --db-instance-identifier fortune-stg-restore \
            --db-snapshot-identifier latest-fortune-snapshot
          aws rds wait db-instance-available --db-instance-identifier fortune-stg-restore
      - name: Run smoke tests
        run: php artisan test --testsuite=Smoke
      - name: Notify result
        uses: slackapi/slack-github-action@v1.24.0
        env:
          SLACK_WEBHOOK_URL: $&#123;&#123; secrets.SLACK_WEBHOOK &#125;&#125;
        with:
          payload: |
            {"text": "🔁 DR Drill finished: ${GITHUB_WORKFLOW} ${GITHUB_RUN_NUMBER}"}
</code></pre>
<p>RPO/RTO の例: RPO 15 分（WAL アーカイブ + スナップショット）、RTO 60 分（自動復旧 + スモークテスト）。この指標をプロダクト責任者と合意し、Runbook や社内 Wiki に明文化して関係者へ周知します。</p>
HTML);
  @endphp

  <x-exercise.reveal id="lesson10-task4" :hints="$lesson10Task4Hints" :answer="$lesson10Task4Answer" />
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ main ブランチから自動デプロイされ、失敗時にロールバックできる</li>
    <li>✅ 監視ダッシュボードとアラートルールが整備され、SLO が定義されている</li>
    <li>✅ インシデント対応 Runbook とコミュニケーション手順が用意されている</li>
    <li>✅ バックアップ / DR テストの記録があり、RPO/RTO の合意が取れている</li>
  </ul>
</section>

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson10') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 10 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('home') }}">
    レッスン一覧へ
    <i data-lucide="arrow-up-right"></i>
  </a>
</footer>
