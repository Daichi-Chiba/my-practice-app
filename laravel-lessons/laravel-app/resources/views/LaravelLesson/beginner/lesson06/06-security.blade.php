<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="shield"></i> セキュリティヘッダーと CSRF 対策</h2>
  <p class="lesson-section__lead">
    認証が通っても、ブラウザやプロキシでの防御が欠けると攻撃は成立します。Laravel ではミドルウェアと設定ファイルで
    セキュリティヘッダー、CSRF 対策、Rate Limiter を簡潔に導入できます。
  </p>

  <h3 class="lesson-section__heading">1. ヘッダーの強化</h3>
  <pre><code class="language-php">// app/Http/Middleware/SecureHeaders.php
public function handle($request, Closure $next)
{
    $response = $next($request);

    $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
    $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');

    return $response;
}</code></pre>
  <pre><code class="language-php">// app/Http/Kernel.php
protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\SecureHeaders::class,
    ],
    'api' => [
        // ...
        \Instrumental\RateLimiter::class,
    ],
];</code></pre>

  <h3 class="lesson-section__heading">2. CSRF と SameSite 設定</h3>
  <pre><code class="language-php">// config/session.php
'same_site' => env('SESSION_SAME_SITE', 'lax'),
'http_only' => true,
'secure' => env('SESSION_SECURE_COOKIE', true),</code></pre>
  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> API トークンを使うエンドポイントは <code>api.php</code> 側で定義し、<code>auth:sanctum</code> ミドルウェアを適用することで
    CSRF-Token を意識せずに安全なアクセスが可能になります。
  </div>
</section>
