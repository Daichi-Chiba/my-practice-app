<section class="lesson-section lesson-section--detection">
  <h2 class="lesson-section__title"><i data-lucide="search"></i> N+1問題の検出方法</h2>

  <h3 class="lesson-section__heading">1. Laravel Debugbar</h3>
  <pre><code class="language-bash">composer require barryvdh/laravel-debugbar --dev</code></pre>
  <p class="lesson-text--muted">画面下部にクエリ数が表示されるので、一覧ページで 100 件を超える場合は要調査。</p>

  <h3 class="lesson-section__heading">2. クエリログを仕込んで追跡</h3>
  <pre><code class="language-php">use Illuminate\Support\Facades\DB;

DB::enableQueryLog();

$users = User::all();
foreach ($users as $user) {
    echo $user->fortune->result;
}

dd(DB::getQueryLog());</code></pre>
  <p class="lesson-text--muted">ループ内で同じ SQL が繰り返されていれば N+1 問題が発生しています。</p>

  <h3 class="lesson-section__heading">3. Telescope で本番に近い監視</h3>
  <pre><code class="language-bash">composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate</code></pre>
  <p class="lesson-text--muted">http://localhost/telescope でクエリ履歴を可視化し、ページ単位でのクエリ数を確認できます。</p>
</section>
