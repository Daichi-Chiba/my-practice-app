<section class="lesson-section lesson-section--code">
  <h2 class="lesson-section__title"><i data-lucide="file-text"></i> Feature テストで API を守る</h2>
  <p class="lesson-section__lead">
    Feature テストでは HTTP レイヤを通して実装を検証します。リクエストとレスポンスの期待値を網羅し、
    スキーマ変更や認可まわりのリグレッションを予防します。
  </p>

  <h3 class="lesson-section__heading">1. 成功ケースのテスト</h3>
  <pre><code class="language-php">// tests/Feature/Api/FortuneIndexTest.php
public function it_returns_fortune_list(): void
{
    Fortune::factory()->count(3)->create();

    $response = $this->getJson('/api/fortunes');

    $response
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                ['id', 'title', 'result', 'created_at']
            ],
        ]);
}</code></pre>

  <h3 class="lesson-section__heading">2. 認可・バリデーションのテスト</h3>
  <pre><code class="language-php">public function guest_cannot_create_fortune(): void
{
    $response = $this->postJson('/api/fortunes', []);

    $response->assertUnauthorized();
}

public function it_validates_required_fields(): void
{
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson('/api/fortunes', []);

    $response
        ->assertUnprocessable()
        ->assertInvalid(['title', 'result']);
}</code></pre>

  <div class="lesson-callout">
    <strong>Tip:</strong> <code>assertJsonPath</code> や <code>assertJsonFragment</code> を併用するとレスポンス差分をピンポイントで検証できます。
  </div>
</section>
