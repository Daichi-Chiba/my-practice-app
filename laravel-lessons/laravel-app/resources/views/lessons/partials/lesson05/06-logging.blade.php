<section class="lesson-section lesson-section--logging">
  <h2 class="lesson-section__title"><i data-lucide="activity"></i> ログと監視</h2>
  <pre><code class="language-php">@verbatim
Log::info('batch start', ['job' => 'GenerateDailyFortunesJob']);
Log::warning('retrying external api', ['service' => 'horoscope']);
Log::error('unhandled exception', ['id' => $id]);
@endverbatim</code></pre>
  <div class="lesson-callout">
    <strong>実務ポイント:</strong> 重大度ごとに INFO / WARNING / ERROR を使い分け、検索しやすいキーを併記しておくと障害解析がスムーズになります。
  </div>
</section>
