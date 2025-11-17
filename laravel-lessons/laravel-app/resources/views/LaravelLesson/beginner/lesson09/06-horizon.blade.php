<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="activity"></i> 監視と Horizon ダッシュボード</h2>
  <p class="lesson-section__lead">
    ジョブは投入して終わりではなく、処理状況をリアルタイムに観測できることが重要です。Laravel Horizon を使って、
    Throughput・Runtime・失敗ジョブの可視化と通知連携を行います。
  </p>

  <h3 class="lesson-section__heading">1. Horizon のメトリクスを読む</h3>
  <ul class="lesson-list">
    <li><strong>Throughput:</strong> 1 分あたりの処理件数。ピーク時の処理能力を把握し、ワーカー台数増加の判断材料にする</li>
    <li><strong>Runtime:</strong> ジョブの実行時間。閾値を超えたら重い処理が紛れ込んでいないか調査</li>
    <li><strong>Failed Jobs:</strong> 再試行後も失敗したジョブの一覧。スタックトレースから恒久的なバグを洗い出す</li>
  </ul>

  <h3 class="lesson-section__heading">2. Slack 通知と連携</h3>
  <pre><code class="language-php">// app/Providers/HorizonServiceProvider.php
Horizon::routeSlackNotificationsTo('slack-webhook-url', '#laravel-alert');

Horizon::night(); // 夜間テーマに切替</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>運用 Tip:</strong> Horizon のタグ機能を使うと、ジョブの種類やテナントごとに失敗傾向を分析できます。タグ付けは Job クラスの
    <code>tags()</code> メソッドで定義できます。
  </div>
</section>
