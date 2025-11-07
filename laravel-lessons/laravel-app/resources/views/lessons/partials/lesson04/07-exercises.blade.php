<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">N+1問題の発見と修正</h3>
    </div>
    <p class="lesson-text--muted">以下のコードには N+1 が潜んでいます。Eager Loading を用いて最適化してください。</p>
    <pre><code class="language-php">@verbatim
// 占い結果一覧ページ
public function index()
{
    $fortunes = Fortune::all();

    return view('fortunes.index', compact('fortunes'));
}

// Blade
@foreach($fortunes as $fortune)
    <div>
        <p>ユーザー: {{ $fortune->user->name }}</p>
        <p>星座: {{ $fortune->user->zodiac->name }}</p>
        <p>結果: {{ $fortune->result }}</p>
    </div>
@endforeach
@endverbatim</code></pre>
    <details class="lesson-details">
      <summary>解答例</summary>
      <pre><code class="language-php">@verbatim
public function index()
{
    $fortunes = Fortune::with('user.zodiac')->get();
    return view('fortunes.index', compact('fortunes'));
}
// クエリ回数: 3（fortunes / users / zodiacs）
@endverbatim</code></pre>
    </details>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">条件付き Eager Loading</h3>
    </div>
    <p class="lesson-text--muted">ユーザー一覧に「今週の占い結果のみ」を表示するためのコードを書いてください。</p>
    <ol class="lesson-list">
      <li>ユーザーと星座を読み込む</li>
      <li>占い結果は今週分のみ <code>with()</code> で絞り込み</li>
      <li>Blade 側で追加クエリが発生しないことを確認</li>
    </ol>
    <details class="lesson-details">
      <summary>解答例</summary>
      <pre><code class="language-php">@verbatim
$users = User::with([
    'zodiac',
    'fortunes' => function ($query) {
        $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
              ->orderByDesc('date');
    },
])->get();
@endverbatim</code></pre>
    </details>
    <a class="lesson-button" href="{{ route('exercises.lesson04') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 04 演習ページへ
    </a>
  </div>
</section>
