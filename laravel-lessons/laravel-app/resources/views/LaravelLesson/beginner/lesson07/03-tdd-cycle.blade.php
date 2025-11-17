<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="refresh-ccw"></i> TDD サイクルをプロダクトで回す</h2>
  <p class="lesson-section__lead">
    Fortune API に「お気に入り機能」を追加するシナリオで TDD を実践します。まず失敗するテストを用意し、最小実装で通し、
    その後リファクタリングで品質を上げる王道フローを確認します。
  </p>

  <h3 class="lesson-section__heading">1. 赤 (Red)</h3>
  <pre><code class="language-php">// tests/Feature/FortuneFavoriteTest.php
public function user_can_favorite_a_fortune(): void
{
    $user = User::factory()->create();
    $fortune = Fortune::factory()->create();

    $response = $this->actingAs($user)->post(route('fortunes.favorite', $fortune));

    $response->assertStatus(201);
    $this->assertDatabaseHas('fortune_favorites', [
        'user_id' => $user->id,
        'fortune_id' => $fortune->id,
    ]);
}</code></pre>

  <h3 class="lesson-section__heading">2. 緑 (Green)</h3>
  <pre><code class="language-php">// app/Http/Controllers/FortuneFavoriteController.php
public function store(Fortune $fortune)
{
    $favorite = $fortune->favorites()->firstOrCreate([
        'user_id' => auth()->id(),
    ]);

    return response()->json($favorite, 201);
}</code></pre>

  <h3 class="lesson-section__heading">3. リファクタリング</h3>
  <pre><code class="language-php">// app/Services/FortuneFavoriteService.php
class FortuneFavoriteService
{
    public function toggle(User $user, Fortune $fortune): Favorite
    {
        return $fortune->favorites()->firstOrCreate(['user_id' => $user->id]);
    }
}</code></pre>

  <div class="lesson-callout">
    <strong>ポイント:</strong> サービス層へ切り出すことでテストの再利用性が向上し、リファクタリングの負担を軽減できます。
  </div>
</section>
