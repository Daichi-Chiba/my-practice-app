@php
  $lesson06Tasks = [
      [
          'title' => 'Sanctum トークン発行 API を実装する',
          'code' => <<<'CODE'
// app/Http/Controllers/Auth/ApiTokenController.php
class ApiTokenController extends Controller
{
    public function store(StoreApiTokenRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('The provided credentials are incorrect.'),
            ]);
        }

        $token = $user->createToken($request->device_name, ['api:fortunes']);

        return response()->json([
            'token' => $token->plainTextToken,
        ], 201);
    }
}

// routes/api.php
Route::post('/tokens', [ApiTokenController::class, 'store']);
CODE
      ],
      [
          'title' => 'FortunePolicy で RBAC を構成する',
          'code' => <<<'CODE'
// app/Policies/FortunePolicy.php
class FortunePolicy
{
    public function update(User $user, Fortune $fortune): bool
    {
        return $user->hasRole('editor') || $user->hasRole('admin');
    }

    public function delete(User $user, Fortune $fortune): bool
    {
        return $user->hasRole('admin');
    }
}

// app/Models/User.php
public function hasRole(string $role): bool
{
    return $this->roles()->where('name', $role)->exists();
}
CODE
      ],
      [
          'title' => 'セキュリティヘッダーと Rate Limiter を設定する',
          'code' => <<<'CODE'
// app/Http/Middleware/SecureHeaders.php
class SecureHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        return tap($response, function (Response $response) {
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('Permissions-Policy', 'camera=(), microphone=()');
        });
    }
}

// app/Providers/RouteServiceProvider.php
RateLimiter::for('api', function (Request $request) {
    $limit = $request->user()?->tokenCan('api:fortunes') ? 120 : 60;

    return Limit::perMinute($limit)->by($request->ip());
});
CODE
      ],
      [
          'title' => 'Feature テストでトークン発行を検証する',
          'code' => <<<'CODE'
// tests/Feature/Auth/ApiTokenTest.php
public function test_user_can_issue_personal_access_token(): void
{
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/tokens', [
        'email' => $user->email,
        'password' => 'password',
        'device_name' => 'iPhone',
    ]);

    $response->assertCreated()->assertJsonStructure(['token']);
    $this->assertDatabaseCount('personal_access_tokens', 1);
}
CODE
      ],
  ];

  $lesson06Summary = <<<'CODE'
// Sanctum API トークン
Route::post('/tokens', [ApiTokenController::class, 'store']);

// Policy でロールごとに制御
$this->authorize('update', $fortune);

// RateLimiter
RateLimiter::for('api', fn () => Limit::perMinute(60));
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson06Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-php">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-php">{{ $lesson06Summary }}</code></pre>
  </article>
</div>
