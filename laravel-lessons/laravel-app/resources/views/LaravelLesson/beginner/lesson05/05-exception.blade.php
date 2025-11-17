<section class="lesson-section lesson-section--exception">
  <h2 class="lesson-section__title"><i data-lucide="alert-octagon"></i> グローバル例外ハンドリング</h2>
  <pre><code class="language-php">@verbatim
// app/Exceptions/Handler.php
public function register(): void
{
    $this->renderable(function (ValidationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'validation_error',
                'messages' => $e->errors(),
            ], 422);
        }
    });

    $this->renderable(function (Throwable $e, $request) {
        if ($request->expectsJson()) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'error' => 'server_error',
                'message' => 'サーバーで問題が発生しました',
            ], 500);
        }
    });
}
@endverbatim</code></pre>
  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> 詳細な例外情報はログに残し、クライアントには一般化したメッセージを返して漏洩を防ぎます。
  </div>
</section>
