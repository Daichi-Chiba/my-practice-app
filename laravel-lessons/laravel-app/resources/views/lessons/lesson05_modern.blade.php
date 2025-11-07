 class="section">
      <h2><i data-lucide="activity"></i> ログと監視</h2>
      <pre><code class="language-php">// storage/logs/laravel.log に出力される
\Log::info('batch start', ['job' => 'GenerateDailyFortunesJob']);
\Log::warning('retrying external api', ['service' => 'horoscope']);
\Log::error('unhandled exception', ['id' => $id]);
</code></pre>
      <div class="point-box">
        <strong>実務ポイント:</strong> 重大度に応じて INFO/WARNING/ERROR を使い分け、検索しやすい構造化ログにする。
      </div>
    </div>

    <div class="section">
      <h2><i data-lucide="pen-tool"></i> 演習</h2>
      <div class="exercise">
        <div class="exercise-header"><div class="exercise-number">1</div><h3 style="margin:0">APIの検証</h3></div>
        <ol>
          <li>StoreFortuneRequest を作成</li>
          <li>fortune_type に不正値を送って 422 が返ることを確認</li>
          <li>メッセージが日本語で返ることを確認</li>
        </ol>
      </div>
      <div class="exercise">
        <div class="exercise-header"><div class="exercise-number">2</div><h3 style="margin:0">例外ハンドリング</h3></div>
        <ol>
          <li>Controller 内で故意に例外を投げ、500エラーJSONを確認</li>
          <li>ログにスタックトレースが記録されていることを確認</li>
        </ol>
      </div>
    </div>

    <div class="lesson-nav">
      <a class="btn" href="{{ route('lesson04') }}"><i data-lucide="arrow-left"></i>Lesson 04</a>
      <a class="btn btn-primary" href="{{ route('lesson06') }}">Lesson 06 <i data-lucide="arrow-right"></i></a>
    </div>
  </div>
  <script>hljs.highlightAll(); lucide.createIcons();</script>
</body>
</html>
