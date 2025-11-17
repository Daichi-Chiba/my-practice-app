<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">API の検証</h3>
    </div>
    <p class="lesson-text--muted">FormRequest を導入した Fortune API を手元で検証し、422 エラー時のレスポンスを確認しましょう。</p>
    <pre><code class="language-bash">@verbatim
# 422 エラーの確認例
curl -X POST http://localhost:8001/api/fortunes \
  -H 'Content-Type: application/json' \
  -d '{"fortune_type":"invalid"}'
@endverbatim</code></pre>
    <ol class="lesson-list">
      <li>StoreFortuneRequest に必須項目・許可値を定義</li>
      <li>不正値を送信し、422 が返り日本語メッセージになっているか確認</li>
      <li>正しいパラメータで 201 が返ることを確認</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">例外ハンドリングとログ</h3>
    </div>
    <p class="lesson-text--muted">意図的に例外を投げ、ハンドラーとログ出力が期待通りに動作するか確認します。</p>
    <ol class="lesson-list">
      <li>FortuneController で <code>throw new RuntimeException()</code> を発生させる</li>
      <li>API レスポンスが共通フォーマット（500 / server_error）になっているか確認</li>
      <li><code>storage/logs/laravel.log</code> にスタックトレースが出力されているか確認</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson05') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 05 演習ページへ
    </a>
  </div>
</section>
