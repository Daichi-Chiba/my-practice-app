<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">API Resource でレスポンスを統一</h3>
    </div>
    <p class="lesson-text--muted">Fortune API v2 のレスポンスを API Resource 経由に切り替え、JSON:API 風の構造に整えます。</p>
    <ol class="lesson-list">
      <li><code>FortuneResource</code> を作成し、attributes / relationships を定義</li>
      <li>一覧・詳細エンドポイントを Resource 経由で返すよう変更</li>
      <li>Feature テストで JSON 構造が期待どおりかを検証し、旧レスポンスとの互換性を確認</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">バージョニングと Rate Limit の実装</h3>
    </div>
    <p class="lesson-text--muted">v1 と v2 を共存させつつ、トークン種別ごとにレート制限を切り替える実装を行います。</p>
    <ol class="lesson-list">
      <li><code>/api/v1</code> と <code>/api/v2</code> のルートグループを作成し、コントローラを分離</li>
      <li>RateLimiter を拡張し、premium トークンは 1 分 300 回、通常は 60 回に制限</li>
      <li>429 応答時の UX を整え、フロントがリトライタイミングを判断できるよう調整</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson08') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 08 演習ページへ
    </a>
  </div>
</section>
