<section class="lesson-section lesson-section--docker">
  <h2 class="lesson-section__title"><i data-lucide="book-open"></i> ステップ1: Docker を使った環境構築</h2>

  <h3 class="lesson-section__subtitle">1-1. コンテナ起動</h3>
  <pre><code class="language-bash">cd docker
docker compose up -d --build</code></pre>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>コンテナ</em>とは、アプリの実行に必要な OS やミドルウェアを箱詰めしたもの。Docker はその箱を迅速に構築・起動するためのツールです。
  </div>
  <p class="lesson-text--small">リポジトリのルート（<code>my-practice-app/laravel-lessons/laravel-app</code>）でターミナルを開き、<code>cd docker</code> で <code>docker/</code> ディレクトリに移動してからコマンドを実行します。</p>

  <h3 class="lesson-section__subtitle">1-2. Laravel 初期化</h3>
  <pre><code class="language-bash">docker compose exec laravel-lessons bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed</code></pre>
  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong>
    <ul class="lesson-list">
      <li>コマンド実行時のエラーはコンテナログ（<code>docker compose logs</code>）で確認</li>
      <li>PR テンプレートは <code>.github/pull_request_template.md</code> に保存しておくと便利</li>
    </ul>
  </div>
  <div class="lesson-callout">
    <strong>ルーティングの確認:</strong> 動作確認でアクセスする URL はすべて <code>routes/web.php</code> に定義されています。詳細は「デモ / サンプルルート」セクションを参照しましょう。
  </div>
  <p class="lesson-text--small">上記は Docker コンテナ内で実行するため、まず <code>docker compose exec laravel-lessons bash</code> でコンテナに入ってから残りのコマンドを入力します。</p>
</section>
