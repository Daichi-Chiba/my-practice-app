<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="git-branch"></i> API バージョニングの戦略</h2>
  <p class="lesson-section__lead">
    バージョンアップ時の破壊的変更をどう扱うかは API 運用の肝です。URI / Header / MediaType 方式の違いを理解した上で、
    Fortune API に最適な戦略を選択します。
  </p>

  <div class="lesson-comparison">
    <article class="lesson-comparison__item lesson-comparison__item--bad">
      <h4>避けたい: 何も考えずに v1 を放置</h4>
      <ul class="lesson-list">
        <li>破壊的変更が直接本番へ反映され、クライアントが即時に壊れる</li>
        <li>テスト環境では問題なしでも、リリース後に旧バージョン利用者からクレーム</li>
        <li>クエリパラメータで v=2 などを付けて混在させると、キャッシュが無効化されパフォーマンス低下</li>
      </ul>
    </article>
    <article class="lesson-comparison__item lesson-comparison__item--good">
      <h4>推奨: URI バージョン + リソース分岐</h4>
      <ul class="lesson-list">
        <li><code>/api/v1/fortunes</code> と <code>/api/v2/fortunes</code> を並行稼働させ、クライアントに移行期間を提供</li>
        <li>Route グループでコントローラを切り替え、<code>Route::prefix('v2')->name('api.v2.')</code> のように定義</li>
        <li>バージョン間共有部分は Service / Resource レイヤで再利用し、DRY に保つ</li>
      </ul>
    </article>
  </div>

  <pre><code class="language-php">// routes/api.php
Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('fortunes', V1\FortuneController::class);
});

Route::prefix('v2')->name('api.v2.')->group(function () {
    Route::apiResource('fortunes', V2\FortuneController::class);
    Route::post('fortunes/{fortune}/favorite', [V2\FortuneFavoriteController::class, 'store']);
});</code></pre>

  <div class="lesson-callout">
    <strong>移行計画:</strong> バージョンの寿命を README / ドキュメントに明記し、v1 はリリース後 3 ヶ月で廃止といったルールを決めておくと、
    開発者・クライアント双方が安心して移行できます。
  </div>
</section>
