<section class="lesson-section lesson-section--usecase">
  <h2 class="lesson-section__title"><i data-lucide="workflow"></i> Step 2: ユースケース層をユビキタス言語に合わせる</h2>
  <p class="lesson-section__lead">
    コンテキストごとに UseCase クラスと DTO を定義し、アプリケーションサービスの API を明確化します。
    コントローラや CLI から呼ばれる「手続きの単位」をユースケースとして扱い、関心事を分離していきます。
  </p>
  <div class="lesson-three-columns">
    <article class="lesson-card">
      <h3 class="lesson-card__title">ユースケース命名のルール</h3>
      <ul class="lesson-list lesson-list--compact">
        <li><code>Context\Application\UseCase\ActionUseCase</code> の形式に統一</li>
        <li>アクション名はユビキタス言語の動詞＋目的語で表現（例: <code>IssueInvoiceUseCase</code>）</li>
        <li>入力 DTO は <code>Input</code>、出力 DTO は <code>Result</code> など末尾を揃える</li>
      </ul>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">依存関係のガイドライン</h3>
      <ul class="lesson-checklist lesson-checklist--compact">
        <li class="lesson-checklist__item">✅ UseCase はドメインサービス／リポジトリのインターフェースに依存する</li>
        <li class="lesson-checklist__item">✅ トランザクション制御は UseCase 側で行い、インフラ層に漏らさない</li>
        <li class="lesson-checklist__item">✅ ロガーやメトリクスなど副作用はインタフェース越しに注入</li>
      </ul>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">サンプル構成</h3>
      <pre><code class="language-php">namespace Billing\Application\UseCase;

class IssueInvoiceUseCase
{
    public function __construct(
        private readonly InvoiceRepository $invoices,
        private readonly IssueInvoiceService $service,
    ) {}

    public function handle(IssueInvoiceInput $input): IssueInvoiceResult
    {
        return DB::transaction(fn () => $this->service->issue($input));
    }
}</code></pre>
    </article>
  </div>
</section>
