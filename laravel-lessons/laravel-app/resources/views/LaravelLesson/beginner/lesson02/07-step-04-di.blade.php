<section class="lesson-section lesson-section--di">
  <h2 class="lesson-section__title"><i data-lucide="refresh-cw"></i> Step 4: 依存注入と FormRequest</h2>
  <pre><code class="language-php">// app/Http/Requests/StoreFortuneRequest.php
public function rules()
{
    return [
        'user_id' => 'required|exists:users,id',
        'fortune_type' => 'required|in:daily,weekly,monthly',
        'date' => 'required|date',
    ];
}</code></pre>
  <pre><code class="language-php">// app/Http/Controllers/FortuneController.php
public function store(StoreFortuneRequest $request)
{
    $validated = $request->validated();
    Fortune::create($validated);
    return redirect()->route('fortunes.index');
}</code></pre>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>依存注入（Dependency Injection）</em> は必要なオブジェクト（ここでは <code>StoreFortuneRequest</code>）を Laravel が自動で渡してくれる仕組み。テスト容易性と責務分離に役立ちます。
  </div>
</section>
