<section class="lesson-section lesson-section--code">
  <h2 class="lesson-section__title"><i data-lucide="shield"></i> Rate Limiter とセキュリティ対策</h2>
  <p class="lesson-section__lead">
    公開 API では悪意あるアクセスやスパイクに備えてレート制限が不可欠です。Laravel の RateLimiter と Sanctum トークンを組み合わせて
    Fortune API を守りましょう。
  </p>

  <h3 class="lesson-section__heading">1. Rate Limiter の定義</h3>
  <pre><code class="language-php">// app/Providers/RouteServiceProvider.php
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
});</code></pre>

  <h3 class="lesson-section__heading">2. トークンごとに制限値を変更</h3>
  <pre><code class="language-php">RateLimiter::for('fortunes', function (Request $request) {
    if ($request->user()?->tokenCan('api:premium')) {
        return Limit::perMinute(300)->by($request->user()->id);
    }
    return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
});</code></pre>

  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> レート制限に引っかかった場合のレスポンス (429) にも、クライアントへ移行ガイドを返すなど UX を考慮しましょう。
    <code>Retry-After</code> ヘッダーを含めるとリトライまでの秒数を伝えられます。
  </div>
</section>
