<section class="lesson-section lesson-section--controller">
  <h2 class="lesson-section__title"><i data-lucide="git-commit"></i> コントローラでの利用</h2>
  <pre><code class="language-php">@verbatim
// app/Http/Controllers/FortuneController.php
public function store(StoreFortuneRequest $request)
{
    $validated = $request->validated();

    Fortune::create($validated);

    return response()->json([
        'message' => 'created',
    ], 201);
}
@endverbatim</code></pre>
  <div class="lesson-callout lesson-callout--success">
    <strong>ポイント:</strong> バリデーション済みデータのみを使えば、mass assignment のリスクを抑えつつ安全に保存できます。
  </div>
</section>
