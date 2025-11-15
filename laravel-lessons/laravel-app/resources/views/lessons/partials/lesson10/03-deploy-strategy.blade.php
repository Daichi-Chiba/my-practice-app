<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="rocket"></i> デプロイ戦略とリリースフロー</h2>
  <p class="lesson-section__lead">
    Fortune API を本番に届けるための CI/CD パイプラインを設計します。GitHub Actions を例に、テスト・ビルド・デプロイを自動化し、
    手作業によるヒューマンエラーを減らします。
  </p>

  <pre><code class="language-yaml">name: deploy-production

on:
  workflow_dispatch:
  push:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - run: composer install --prefer-dist --no-progress
      - run: cp .env.ci .env
      - run: php artisan key:generate
      - run: php artisan test --coverage

  deploy:
    needs: test
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: appleboy/scp-action@v0.1.7
        with:
          host: $&#123;&#123; secrets.PROD_HOST &#125;&#125;
          username: deploy
          key: $&#123;&#123; secrets.SSH_KEY &#125;&#125;
          source: '.'
          target: '/var/www/fortune-api'
      - uses: appleboy/ssh-action@v0.1.6
        with:
          host: $&#123;&#123; secrets.PROD_HOST &#125;&#125;
          username: deploy
          key: $&#123;&#123; secrets.SSH_KEY &#125;&#125;
          script: |
            cd /var/www/fortune-api
            php artisan migrate --force
            php artisan config:cache
            php artisan route:cache</code></pre>

  <div class="lesson-callout">
    <strong>ポイント:</strong> デプロイ時のダウンタイムを避けるためにリリースタグを導入し、アプリケーションのシンボリックリンクを切り替える
    「Capistrano / Envoy」スタイルも検討しましょう。
  </div>
</section>
