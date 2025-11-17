@section('title', 'Lesson 02 演習 - ルーティングとコントローラ設計')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson02') }}">Lesson 02</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 02 演習: ルーティングとコントローラ設計</h1>
  <p class="exercise-hero__lead">
    Fortune アプリの RESTful ルーティングを整え、リソースコントローラと権限付きルートを設計します。
    ルート定義の意図をドキュメント化し、チームで共有できる状態を目指しましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Routing</li>
    <li class="exercise-hero__tag">Resource Controller</li>
    <li class="exercise-hero__tag">Middleware</li>
    <li class="exercise-hero__tag">REST</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="git-branch"></i> 演習 1: Fortune API の CRUD</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Fortune モデルを題材に、RESTful なコントローラとルートを実装して API を公開します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>php artisan make:controller FortuneController --resource</code> を実行してリソースコントローラを生成</li>
      <li><code>Route::resource('fortunes', FortuneController::class)</code> を <code>routes/web.php</code> に追記</li>
      <li><code>index</code>, <code>show</code>, <code>store</code> を実装し、シーディングしたデータを返却できることを確認</li>
      <li><code>index</code> では <code>Fortune::latest()->paginate(20)</code> を利用し、ページネーションが機能するようにする</li>
    </ol>
    <div class="exercise-note">
      <strong>確認ポイント:</strong> <code>/fortunes</code> へアクセスすると最新 20 件が表示され、<code>?page=2</code> でページ切り替えできること。
    </div>
    <pre><code class="language-php">// routes/web.php
Route::resource('fortunes', FortuneController::class)->only(['index', 'show', 'store']);

// app/Http/Controllers/FortuneController.php
public function index()
{
    $fortunes = Fortune::latest()->paginate(20);
    return view('fortunes.index', compact('fortunes'));
}</code></pre>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="shield"></i> 演習 2: 管理画面ルートの設計</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      管理画面向けルートを名前付きでまとめ、認証・権限ミドルウェアを適用します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>Route::prefix('admin')->name('admin.')->middleware('auth')</code> グループを作成</li>
      <li>ダッシュボード (<code>admin.dashboard</code>)・ユーザー管理 (<code>admin.users.index</code>)・設定 (<code>admin.settings</code>) を仮実装</li>
      <li>ユーザー管理ルートには <code>can:manage-users</code> ミドルウェアを追加し、権限がない場合に 403 を返すことを確認</li>
    </ol>
    <div class="exercise-warning">
      <strong>動作確認:</strong> 認証済みユーザーと未認証ユーザーでアクセスし、リダイレクトや 403 が期待通りかチェックしてください。
    </div>
    <pre><code class="language-php">Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::middleware('can:manage-users')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    });
    Route::get('/settings', AdminSettingsController::class)->name('settings');
});</code></pre>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="life-buoy"></i> 参考コマンドとツール</h2>
  <div class="exercise-card__content">
    <pre><code class="language-bash"># ルート一覧表示
php artisan route:list

# コントローラ生成
php artisan make:controller FortuneController --resource

# ポリシーを作成する場合
php artisan make:policy FortunePolicy --model=Fortune</code></pre>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ RESTful ルートとコントローラが命名規約どおりに定義されている</li>
    <li>✅ <code>/fortunes</code> でページネーションが機能し、ビュー崩れがない</li>
    <li>✅ <code>/admin</code> 配下のルートに認証・権限が適切に設定されている</li>
    <li>✅ README にルート一覧とアクセス要件が追記されている</li>
    <li>✅ PR に挙動確認のスクリーンショットとテスト結果が添付されている</li>
  </ul>
</section>

@php
  $lesson02Hints = [
      new \Illuminate\Support\HtmlString('<p><code>Route::resource</code> は <code>only</code>/<code>except</code> を併用することで意図しないルートを生やさずに済みます。リストアップしてから書くと抜け漏れが減ります。</p>'),
      new \Illuminate\Support\HtmlString('<p>管理画面ルートは <code>name()</code> で接頭辞をそろえておくと、Blade からリンクを張るときに迷いません。まずは小さく <code>admin.dashboard</code> だけ作ってみましょう。</p>'),
      new \Illuminate\Support\HtmlString('<p>ポリシー／権限ミドルウェアはテストで 403 を必ず確認してください。Feature テストで <code>$this->actingAs($editor)</code> → 200 / <code>$this->actingAs($viewer)</code> → 403 をセットにすると安心です。</p>'),
  ];

  $lesson02Answer = new \Illuminate\Support\HtmlString(view('LaravelExercises.beginner.lesson02.answer')->render());
@endphp

<x-exercise.reveal id="lesson02-overview" :hints="$lesson02Hints" :answer="$lesson02Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link" href="{{ route('lesson02') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 02 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson03') }}">
    Lesson 03 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
