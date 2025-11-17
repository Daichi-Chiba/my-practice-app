<section class="lesson-section lesson-section--implementation">
  <h2 class="lesson-section__title"><i data-lucide="zap"></i> Eager Loading の実装</h2>

  <h3 class="lesson-section__heading">1. with（事前読み込み）</h3>
  <pre><code class="language-php">// 単一リレーション
$users = User::with('fortune')->get();

// 複数リレーション
$users = User::with(['fortune', 'zodiac'])->get();

// ネストしたリレーション
$users = User::with('fortune.fortuneType')->get();

// 条件付き読み込み
$users = User::with(['fortune' => function ($query) {
    $query->where('date', today());
}])->get();
</code></pre>

  <h3 class="lesson-section__heading">2. load（遅延読み込み）</h3>
  <pre><code class="language-php">$user = User::find(1);
$user->load('fortune'); // ここで追加クエリが発行される</code></pre>

  <h3 class="lesson-section__heading">3. 占いアプリでの実装例</h3>
  <pre><code class="language-php">// app/Http/Controllers/UserController.php
class UserController extends Controller
{
    public function index()
    {
        $users = User::with([
            'zodiac',
            'fortunes' => fn ($query) => $query->latest()->limit(1),
        ])->paginate(20);

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with([
            'zodiac',
            'fortunes' => fn ($query) => $query->orderByDesc('date'),
        ])->findOrFail($id);

        return view('users.show', compact('user'));
    }
}
</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>ベストプラクティス:</strong> 一覧表示では必ず <code>with()</code> で関連を読み込み、不要なリレーションは指定しない。ページネーションで 1 ページの件数も調整しましょう。
  </div>
</section>
