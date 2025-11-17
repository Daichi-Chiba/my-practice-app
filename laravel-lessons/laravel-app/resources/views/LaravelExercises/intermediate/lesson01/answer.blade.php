<div class="exercise-answer">
  <h3 class="exercise-answer__title"><i data-lucide="check-circle"></i> 模範回答サマリ</h3>
  <section class="exercise-answer__section">
    <h4>コンテキストマップ</h4>
    <ul>
      <li>Billing / Ordering / Notification の 3 コンテキストを定義し、依存方向を Ordering → Billing → Notification に制限。</li>
      <li>Ordering コンテキストで <code>ApproveOrder</code> ユースケースを公開 API として提供。</li>
      <li>Notification との連携は Domain Event (<code>InvoiceIssued</code>) を経由して Pub/Sub で連携。</li>
    </ul>
  </section>
  <section class="exercise-answer__section">
    <h4>ユースケース実装</h4>
    <pre><code class="language-php">final class ApproveOrderUseCase
{
    public function __construct(
        private readonly OrderRepository $orders,
        private readonly DomainEventBus $bus,
    ) {}

    public function handle(ApproveOrderInput $input): ApproveOrderResult
    {
        return DB::transaction(function () use ($input) {
            $order = $this->orders->findOrFail($input->orderId);
            $order->approve($input->approverId);

            $this->orders->save($order);
            $this->bus->publish(...$order->releaseEvents());

            return ApproveOrderResult::success($order->id);
        });
    }
}</code></pre>
  </section>
  <section class="exercise-answer__section">
    <h4>リリース計画</h4>
    <ol>
      <li>Feature flag <code>order_module.ddd_enabled</code> で新処理を制御し、Canary リリースを実施。</li>
      <li>Azure DevOps のステージング環境で Replay テストを実施し、Grafana ダッシュボードで Latency と Error Ratio を監視。</li>
      <li>Rollback 時は flag を無効化し、旧サービス <code>LegacyOrderService</code> を再度ルーティング。</li>
    </ol>
  </section>
</div>
