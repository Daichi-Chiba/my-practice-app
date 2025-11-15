<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="git-branch"></i> リリース管理とロールバック</h2>
  <p class="lesson-section__lead">
    デプロイ後に問題が発生した場合、速やかにロールバックできる準備が不可欠です。リリースタグや DB マイグレーションの管理を通じて、
    安定したリリースサイクルを実現しましょう。
  </p>

  <h3 class="lesson-section__heading">1. リリースタグとチェンジログ</h3>
  <ul class="lesson-list">
    <li>GitHub Release を作成し、リリースノートに変更内容・移行手順・影響範囲を記載</li>
    <li>タグ名は <code>vYYYY.MM.DD</code> のように日付ベースで管理し、ステージングで検証済みのコミットに付与</li>
    <li>リリースごとに「検証完了」「本番反映済み」「ロールバック済み」などの状態管理を行う</li>
  </ul>

  <h3 class="lesson-section__heading">2. マイグレーションの後戻り戦略</h3>
  <pre><code class="language-bash">php artisan migrate --force
php artisan db:seed --class=ProductionSeeder

# ロールバック手順を runbook に明記
php artisan migrate:rollback --step=1 --force
</code></pre>

  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> スキーマ変更が破壊的な場合は、Blue/Green や Expand-Contract パターンを適用し、複数リリースに跨って安全に移行します。
  </div>
</section>
