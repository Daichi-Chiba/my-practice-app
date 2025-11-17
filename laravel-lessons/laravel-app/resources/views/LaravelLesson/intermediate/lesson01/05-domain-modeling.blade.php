<section class="lesson-section lesson-section--domain">
  <h2 class="lesson-section__title"><i data-lucide="shapes"></i> Step 3: ドメインモデルとイベントを再構成する</h2>
  <p class="lesson-section__lead">
    境界づけられたコンテキスト内で完結するアグリゲートを定義し、状態変化を表現するドメインイベントを設計します。
    Laravel の Eloquent に寄り過ぎないよう、エンティティ／値オブジェクト／ドメインサービスの責務を切り分けましょう。
  </p>
  <div class="lesson-grid lesson-grid--two">
    <article class="lesson-card">
      <h3 class="lesson-card__title">アグリゲート設計のポイント</h3>
      <ul class="lesson-list">
        <li>不変条件（Invariant）とトランザクション境界を明文化する</li>
        <li>アグリゲート外とやり取りする際はドメインイベントで通知</li>
        <li>永続化はリポジトリに委譲し、モデルはロジックに集中</li>
      </ul>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">コード例</h3>
      <pre><code class="language-php">final class InvoiceIssued
{
    public function __construct(
        public readonly InvoiceId $invoiceId,
        public readonly DateTimeImmutable $issuedAt,
    ) {}
}

final class Invoice extends AggregateRoot
{
    public function issue(): void
    {
        $this->status = InvoiceStatus::ISSUED;
        $this->record(new InvoiceIssued($this->id, nowImmutable()));
    }
}</code></pre>
    </article>
  </div>
  <div class="lesson-callout lesson-callout--tip">
    <strong>イベント駆動性を高めるには?</strong> Laravel のリスナーを直接書くのではなく、アプリケーションサービスでイベントバスを仲介するとテストが容易になります。
  </div>
</section>
