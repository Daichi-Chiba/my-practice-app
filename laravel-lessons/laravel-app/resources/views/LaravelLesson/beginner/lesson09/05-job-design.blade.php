<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="layers"></i> Job 設計と冪等性</h2>
  <p class="lesson-section__lead">
    ジョブは再実行されることを前提に設計します。冪等性を担保する手段や、ジョブ間の依存関係をどのように整理するかを押さえましょう。
  </p>

  <h3 class="lesson-section__heading">1. 冪等性トークンの付与</h3>
  <pre><code class="language-php">class NotifyFortuneResultJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Fortune $fortune) {}

    public function handle(MailManager $mail): void
    {
        if ($this->fortune->notifications()->where('channel', 'mail')->exists()) {
            return; // 既に通知済みなら処理しない
        }

        $mail->to($this->fortune->user)
            ->send(new FortuneResultMail($this->fortune));

        $this->fortune->notifications()->create([
            'channel' => 'mail',
            'delivered_at' => now(),
        ]);
    }
}</code></pre>

  <h3 class="lesson-section__heading">2. 失敗時の再試行ポリシー</h3>
  <ul class="lesson-list">
    <li><code>public int $tries = 5;</code> で最大再試行回数、<code>public int $backoff = 60;</code> でリトライ間隔を指定</li>
    <li>恒久的エラーは <code>fail()</code> でマークし、Slack 通知などで即時検知</li>
    <li>外部 API 呼び出しは Circuit Breaker / Rate Limit を考慮し、短期間に大量リトライしない</li>
  </ul>

  <div class="lesson-callout">
    <strong>Tip:</strong> <code>uniqueId()</code> をオーバーライドしてジョブを一意識別することで、同一パラメータの重複投入を防げます。
  </div>
</section>
