<section class="lesson-section lesson-section--code">
  <h2 class="lesson-section__title"><i data-lucide="terminal"></i> Sanctum の導入とトークン運用</h2>
  <p class="lesson-section__lead">
    API 認証を最小コストで実装するなら Sanctum が第一候補です。ここではパーソナルアクセストークン (PAT) を採用し、
    SPA / モバイル クライアントからのアクセスを想定した設定と発行フローを確認します。
  </p>

  <h3 class="lesson-section__heading">1. インストールと設定</h3>
  <pre><code class="language-bash">composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate</code></pre>
  <pre><code class="language-php">// config/auth.php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'api' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
],</code></pre>

  <h3 class="lesson-section__heading">2. トークン発行フロー</h3>
  <pre><code class="language-php">// app/Http/Controllers/Auth/ApiTokenController.php
public function store(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'device_name' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    $token = $user->createToken($request->device_name, ['api:fortunes']);

    return response()->json([
        'token' => $token->plainTextToken,
    ], 201);
}</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> 権限スコープは配列で指定できます。`['api:fortunes', 'admin:dashboard']` のように粒度を揃えておくと
    後段の Policy やミドルウェアで判定しやすくなります。
  </div>
</section>
