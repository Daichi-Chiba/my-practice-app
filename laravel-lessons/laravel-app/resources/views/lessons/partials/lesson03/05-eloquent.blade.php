<section class="lesson-section lesson-section--eloquent">
  <h2 class="lesson-section__title"><i data-lucide="list"></i> Eloquent 基本操作</h2>
  <pre><code class="language-php">// 一覧
$fortunes = Fortune::whereDate('date', today())->orderByDesc('created_at')->paginate(20);

// 作成
Fortune::create([
  'user_id' => 1,
  'fortune_type' => 'daily',
  'result' => '最高の一日',
  'date' => today(),
]);

// 更新
$fortune->update(['result' => '良い一日になります']);

// 削除
$fortune->delete();
</code></pre>
  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> CRUD（Create / Read / Update / Delete）とページネーションをまず押さえ、集計やフィルタ条件を徐々に拡張します。
  </div>
</section>
