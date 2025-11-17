<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="workflow"></i> CI 連携とテスト自動化</h2>
  <p class="lesson-section__lead">
    テストを書くだけでは不十分です。CI に接続して常に最新のブランチでテストが走る仕組みを整え、品質のゲートを自動化します。
    GitHub Actions を例に、最小構成のワークフローを確認しましょう。
  </p>

  <h3 class="lesson-section__heading">1. GitHub Actions ワークフロー</h3>
  <pre><code class="language-yaml"># .github/workflows/run-tests.yml
name: run-tests
on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  tests:
    runs-on: ubuntu-latest
    services:
      mysql:
        image: mysql:8
        env:
          MYSQL_DATABASE: testing
          MYSQL_ALLOW_EMPTY_PASSWORD: yes
        ports: ['3306:3306']
        options: >-
          --health-cmd "mysqladmin ping --silent"
          --health-interval 5s
          --health-timeout 5s
          --health-retries 10
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, pdo_mysql
      - run: cp .env.ci .env
      - run: composer install --no-interaction --prefer-dist
      - run: php artisan key:generate
      - run: php artisan migrate --force
      - run: php artisan test --coverage-clover=coverage.xml
      - uses: codecov/codecov-action@v4
        with:
          files: coverage.xml</code></pre>

  <h3 class="lesson-section__heading">2. CI で検出したいポイント</h3>
  <ul class="lesson-list">
    <li>マイグレーションが最初から最後まで成功すること</li>
    <li>Feature / Unit テストがすべて通ること、想定どおり例外を投げる部分はテストで担保されていること</li>
    <li>コードカバレッジ・Lint・静的解析を組み合わせ、品質指標を定量的に把握できること</li>
  </ul>

  <div class="lesson-callout">
    <strong>運用 Tip:</strong> 失敗したテストを Slack / Teams へ通知し、チーム全員が即座に気付ける体制を整えておくと、
    本番障害につながるコードがマージされるリスクを削減できます。
  </div>
</section>
