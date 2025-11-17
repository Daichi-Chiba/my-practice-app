<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="radar"></i> 可観測性とモニタリング</h2>
  <p class="lesson-section__lead">
    Fortune API の稼働状況を常時把握するために、ログ・メトリクス・トレースを組み合わせた可観測性の設計を行います。
    Laravel Telescope や OpenTelemetry を活用した実践的な監視構成を確認しましょう。
  </p>

  <h3 class="lesson-section__heading">1. ログ収集のベストプラクティス</h3>
  <ul class="lesson-list">
    <li>JSON 形式で構造化ログを出力し、Fluent Bit / CloudWatch Logs など集約基盤へ転送</li>
    <li>ログレベルの基準を明確にし、INFO は操作ログ、WARNING は復旧可能な異常、ERROR は要対応と定義</li>
    <li>トレース ID をリクエストヘッダーから取得してログに付与し、分散トレーシングと紐付ける</li>
  </ul>

  <h3 class="lesson-section__heading">2. メトリクスとダッシュボード</h3>
  <pre><code class="language-php">// app/Providers/AppServiceProvider.php
public function boot(): void
{
    RateLimiter::for('fortune-api', function (Request $request) {
        Metrics::counter('fortune.requests')->increment();
        return Limit::perMinute(120)->by($request->ip());
    });
}</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>運用 Tip:</strong> ステータスコード別のメトリクスやジョブの処理時間を Grafana / Datadog に可視化し、SLO を定義するとサービス品質を継続的に改善できます。
  </div>
</section>
