<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="component"></i> Unit テストでドメインを素早く検証</h2>
  <p class="lesson-section__lead">
    サービス層・値オブジェクトなどビジネスロジックは Unit テストで高速に守ります。依存を最小化し、
    入出力が明確なメソッドをピンポイントに検証することで回帰バグを早期発見できます。
  </p>

  <h3 class="lesson-section__heading">1. 例: 占いポイントの計算</h3>
  <pre><code class="language-php">// tests/Unit/FortunePointCalculatorTest.php
public function it_calculates_points_based_on_rarity(): void
{
    $calculator = new FortunePointCalculator();

    $points = $calculator->calculate('love', Rarity::SSR);

    $this->assertSame(120, $points);
}</code></pre>

  <h3 class="lesson-section__heading">2. 値オブジェクトの振る舞い</h3>
  <pre><code class="language-php">// app/Domain/Fortune/ValueObjects/Rarity.php
final class Rarity
{
    private function __construct(private string $value) {}

    public static function from(string $value): self
    {
        return new self(match ($value) {
            'ssr', 'SR', 'SSR' => 'SSR',
            'r', 'R' => 'R',
            default => 'N',
        });
    }

    public function bonusMultiplier(): float
    {
        return match ($this->value) {
            'SSR' => 1.2,
            'R' => 1.1,
            default => 1.0,
        };
    }
}</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> Unit テストでは DB を使わず、値オブジェクトやサービスを純粋な PHP として検証することで
    フィードバックループを最短化できます。
  </div>
</section>
