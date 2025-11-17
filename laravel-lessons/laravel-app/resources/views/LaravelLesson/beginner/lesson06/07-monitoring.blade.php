<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="activity"></i> ログ監査とアラート設計</h2>
  <p class="lesson-section__lead">
    認証・認可の仕組みを導入したら、次は「異常を検知できる状態」の確立です。成功ログだけでなく、
    失敗イベントやポリシー拒否の履歴を残し、アラートとダッシュボードへとつなげます。
  </p>

  <h3 class="lesson-section__heading">1. 監査ログの整備</h3>
  <pre><code class="language-php">// app/Listeners/LogAuthenticatedEvent.php
public function handle(Login $event): void
{
    Log::info('user.login', [
        'user_id' => $event->user->id,
        'ip' => request()->ip(),
        'user_agent' => request()->userAgent(),
    ]);
}</code></pre>

  <h3 class="lesson-section__heading">2. アクセス拒否のモニタリング</h3>
  <pre><code class="language-php">Gate::after(function ($user, $ability, $result, $arguments) {
    if ($result === false) {
        Log::notice('policy.denied', [
            'user_id' => $user?->id,
            'ability' => $ability,
            'target' => optional($arguments[0] ?? null)->id,
        ]);
    }
});</code></pre>

  <div class="lesson-callout">
    <strong>運用 Tip:</strong> 監査ログは JSON 形式で構造化し、Sentry や Loki に転送することで、
    不審なアクセストレンドをダッシュボードで可視化しやすくなります。
  </div>
</section>
