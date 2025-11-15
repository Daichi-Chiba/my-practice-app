<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="calendar"></i> スケジューラとバッチ処理</h2>
  <p class="lesson-section__lead">
    キューと併用して、Cron ベースのスケジュール処理を管理します。Fortune API では毎日 AM 5:00 に占い結果の集計バッチを実行し、
    集計結果を Slack へ通知する運用を想定します。
  </p>

  <pre><code class="language-php">// app/Console/Kernel.php
protected function schedule(Schedule $schedule): void
{
    $schedule->job(new AggregateFortuneResultJob())
        ->dailyAt('05:00')
        ->onOneServer()
        ->runInBackground()
        ->withoutOverlapping()
        ->emailOutputOnFailure('ops@example.com');
}</code></pre>

  <ul class="lesson-list">
    <li><strong>onOneServer:</strong> マルチインスタンス環境での二重起動を防ぐ</li>
    <li><strong>runInBackground:</strong> スケジュールからさらにキューへ渡すことで、Cron が詰まるのを防止</li>
    <li><strong>withoutOverlapping:</strong> 前回実行が終わらない場合に新しいジョブをスキップしてリソースを守る</li>
  </ul>

  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> Cron の定義を変更した際は <code>php artisan schedule:list</code> で現在の設定を確認し、
    本番環境では <code>schedule:run</code> の実行ログを監視して異常停止を検知しましょう。
  </div>
</section>
