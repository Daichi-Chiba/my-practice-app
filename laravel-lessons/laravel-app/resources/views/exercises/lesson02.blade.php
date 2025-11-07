<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lesson 02 演習 - ルーティングとコントローラ設計</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:#000;color:#fff;line-height:1.8}
    .container{max-width:900px;margin:0 auto;padding:2.5rem}
    a{color:#61dafb;text-decoration:none}
    a:hover{text-decoration:underline}
    h1{font-size:2.2rem;margin-bottom:1rem;background:linear-gradient(135deg,#fff,#777);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    p{color:#aaa;margin-bottom:1rem}
    section{background:#0a0a0a;border:1px solid #1a1a1a;border-radius:16px;padding:2rem;margin-bottom:2rem}
    h2{font-size:1.5rem;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem}
    h2 svg{width:20px;height:20px}
    h3{font-size:1.1rem;margin:1.2rem 0 .7rem;color:#ddd}
    ul,ol{margin:1rem 0 1rem 1.5rem;color:#aaa}
    pre{background:#050505!important;border:1px solid #1a1a1a;border-radius:12px;padding:1.1rem!important;margin:1rem 0;overflow-x:auto}
    code{font-family:'Consolas','Monaco',monospace;font-size:.9rem}
    :not(pre)>code{background:#1a1a1a;padding:.15rem .45rem;border-radius:4px;color:#ff2d20}
    .note{background:linear-gradient(135deg,rgba(97,218,251,.08),rgba(32,116,132,.08));border-left:4px solid #61dafb;border-radius:8px;padding:1rem;margin:1rem 0;color:#cfe9ff}
    .warning{background:linear-gradient(135deg,rgba(255,45,32,.08),rgba(139,20,14,.08));border-left:4px solid #ff2d20;border-radius:8px;padding:1rem;margin:1rem 0;color:#ffcbc2}
    .checklist{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;margin-top:1rem}
    .check-item{background:#050505;border:1px solid #1a1a1a;border-radius:12px;padding:1.2rem;color:#bbb;font-size:.95rem}
    .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.4rem;background:#111;border:1px solid #2a2a2a;border-radius:10px;color:#fff;margin-right:.8rem;margin-top:1.2rem}
    .btn:hover{background:#1c1c1c}
  </style>
</head>
<body>
  <div class="container">
    <h1>Lesson 02 演習: ルーティングとコントローラ設計</h1>
    <p>このページでは Lesson 02 の演習課題を詳細に解説します。GitHub Flow に沿って、それぞれのタスクを <code>feature/02-routing</code> ブランチで進め、PR にスクリーンショットと確認事項を添えて提出してください。</p>

    <section>
      <h2><i data-lucide="git-branch"></i> 演習 1: Fortune API の CRUD</h2>
      <h3>タスク</h3>
      <ol>
        <li><code>php artisan make:controller FortuneController --resource</code> を実行し、<code>Fortune</code> モデル用のコントローラを生成</li>
        <li><code>Route::resource('fortunes', FortuneController::class)</code> を <code>routes/web.php</code> に追記</li>
        <li><code>index</code>, <code>show</code>, <code>store</code> を実装し、ダミーデータで動作確認</li>
        <li><code>index</code> には <code>Fortune::latest()->paginate(20)</code> を用いてページネーションを追加</li>
      </ol>
      <div class="note">
        <strong>確認ポイント:</strong> <code>/fortunes</code> へアクセスすると最新 20 件が表示され、<code>?page=2</code> でページが切り替わること。
      </div>
      <pre><code class="language-php">// routes/web.php
Route::resource('fortunes', FortuneController::class)->only(['index', 'show', 'store']);

// app/Http/Controllers/FortuneController.php
public function index()
{
    $fortunes = Fortune::latest()->paginate(20);
    return view('fortunes.index', compact('fortunes'));
}
</code></pre>
    </section>

    <section>
      <h2><i data-lucide="shield"></i> 演習 2: 管理画面ルートの設計</h2>
      <h3>タスク</h3>
      <ol>
        <li><code>Route::prefix('admin')->name('admin.')->middleware('auth')</code> グループを作成</li>
        <li>ダッシュボード (<code>admin.dashboard</code>)・ユーザー管理 (<code>admin.users.index</code>)・設定 (<code>admin.settings</code>) の 3 画面を仮実装</li>
        <li>ユーザー管理ルートには <code>can:manage-users</code> ミドルウェアを追加し、権限がない場合は 403 を返すようにする</li>
      </ol>
      <div class="warning">
        <strong>動作確認:</strong> 認証済みユーザーと未認証ユーザーでアクセスし、リダイレクトや 403 が期待通りかを確認してください。
      </div>
      <pre><code class="language-php">Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::middleware('can:manage-users')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    });
    Route::get('/settings', AdminSettingsController::class)->name('settings');
});
</code></pre>
    </section>

    <section>
      <h2><i data-lucide="list-check"></i> 提出チェックリスト</h2>
      <div class="checklist">
        <div class="check-item">✅ RESTful ルートとコントローラが命名規約どおりに定義されている</div>
        <div class="check-item">✅ <code>/fortunes</code> でページネーションが機能し、ビューが崩れていない</div>
        <div class="check-item">✅ <code>/admin</code> 配下のルートに認証・権限が適切に設定されている</div>
        <div class="check-item">✅ README にルート一覧とアクセス要件が追記されている</div>
        <div class="check-item">✅ PR に挙動確認のスクリーンショット・テスト結果が添付されている</div>
      </div>
    </section>

    <section>
      <h2><i data-lucide="life-buoy"></i> 参考コマンド</h2>
      <pre><code class="language-bash"># ルート一覧表示
php artisan route:list

# コントローラ生成
php artisan make:controller FortuneController --resource

# ポリシーを作成する場合
php artisan make:policy FortunePolicy --model=Fortune
</code></pre>
    </section>

    <div>
      <a class="btn" href="{{ route('lesson02') }}">
        <i data-lucide="arrow-left"></i>
        Lesson 02 に戻る
      </a>
      <a class="btn" href="{{ route('lesson03') }}">
        Lesson 03 へ進む
        <i data-lucide="arrow-right"></i>
      </a>
    </div>
  </div>
  <script>hljs.highlightAll(); lucide.createIcons();</script>
</body>
</html>
