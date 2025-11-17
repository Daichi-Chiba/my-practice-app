@php
  $lesson05Tasks = [
      [
          'title' => 'FormRequest で入力検証',
          'code' => <<<'CODE'
// app/Http/Requests/StoreFortuneRequest.php
class StoreFortuneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'body' => ['required', 'string'],
            'rarity' => ['required', Rule::in(['common', 'rare', 'legendary'])],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'body.required' => '本文を入力してください。',
        ];
    }
}

// app/Http/Controllers/FortuneController.php
public function store(StoreFortuneRequest $request): RedirectResponse
{
    Fortune::create($request->validated());

    return redirect()->route('fortunes.index');
}
CODE
      ],
      [
          'title' => 'Handler で例外レスポンスを統一',
          'code' => <<<'CODE'
// app/Exceptions/Handler.php
public function register(): void
{
    $this->renderable(function (ValidationException $e, Request $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }
    });

    $this->renderable(function (Throwable $e, Request $request) {
        if ($request->expectsJson()) {
            Log::error('server_error', [
                'exception' => $e,
                'user_id' => $request->user()?->id,
            ]);

            return response()->json([
                'message' => 'Unexpected server error. Please try again later.',
            ], 500);
        }
    });
}
CODE
      ],
      [
          'title' => 'ログチャネルと通知設定',
          'code' => <<<'CODE'
// config/logging.php
'slack' => [
    'driver' => 'slack',
    'url' => env('LOG_SLACK_WEBHOOK_URL'),
    'username' => 'Fortune Logger',
    'emoji' => ':boom:',
    'level' => 'error',
],

// app/Providers/AppServiceProvider.php
public function boot(): void
{
    if ($this->app->environment('production')) {
        Log::channel('slack')->info('production booted');
    }
}
CODE
      ],
      [
          'title' => 'Feature テスト',
          'code' => <<<'CODE'
// tests/Feature/FortuneStoreTest.php
public function test_store_validation_errors(): void
{
    $response = $this->actingAs(User::factory()->create())
        ->postJson('/fortunes', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['title', 'body']);
}

public function test_store_success_returns_redirect(): void
{
    $payload = Fortune::factory()->raw();

    $response = $this->actingAs(User::factory()->create())
        ->post('/fortunes', $payload);

    $response->assertRedirect('/fortunes');
    $this->assertDatabaseHas('fortunes', ['title' => $payload['title']]);
}
CODE
      ],
  ];

  $lesson05Summary = <<<'CODE'
// FormRequest + Handler + Slack チャネルを組み合わせた構成
Fortune::create($request->validated());

return response()->json([
    'message' => 'Unexpected server error. Please try again later.',
], 500);

Log::channel('slack')->error('server_error', [...] );
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson05Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-php">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-php">{{ $lesson05Summary }}</code></pre>
  </article>
</div>
