<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="workflow"></i> 非同期化のアーキテクチャ設計</h2>
  <p class="lesson-section__lead">
    Fortune API の「結果通知メール送信」を例に、同期処理からジョブへ切り離すまでのアーキテクチャ検討を進めます。
    キューを前提にしたレイヤ設計と責務分割を明確にしておきましょう。
  </p>

  <div class="lesson-comparison">
    <article class="lesson-comparison__item lesson-comparison__item--bad">
      <h4>同期処理に詰め込みすぎると…</h4>
      <ul class="lesson-list">
        <li>リクエストレスポンスに外部 API やメール送信がぶら下がり、タイムアウトの原因に</li>
        <li>同時アクセス時にワーカーが枯渇し、アプリ全体の応答速度が低下</li>
        <li>再送制御がないため失敗時にログだけ残り、ユーザーに再通知できない</li>
      </ul>
    </article>
    <article class="lesson-comparison__item lesson-comparison__item--good">
      <h4>ジョブへ切り出した構成</h4>
      <ul class="lesson-list">
        <li>Controller ではキュー投入までに責務を限定し、即時レスポンスを返す</li>
        <li>Job クラスで実際の処理（メール送信 / 外部 API 呼び出し）を実行</li>
        <li>Event+Listener で複数の追従処理（ログ記録 / Slack 通知）を疎結合で連携</li>
      </ul>
    </article>
  </div>

  <pre><code class="language-php">// app/Http/Controllers/FortuneResultController.php
public function store(StoreFortuneResultRequest $request)
{
    $fortune = $this->service->record($request->validated());

    NotifyFortuneResultJob::dispatch($fortune);

    return response()->json(['status' => 'accepted'], 202);
}</code></pre>

  <div class="lesson-callout">
    <strong>ポイント:</strong> キュー投入は必ず <code>dispatch()</code> 直前で責務が完結するようにし、トランザクション内で投入する場合は
    <code>afterCommit()</code> を活用してロールバック時にジョブが孤立しないようにします。
  </div>
</section>
