<section class="lesson-section lesson-section--basics">
  <h2 class="lesson-section__title"><i data-lucide="book-open"></i> N+1問題とは？</h2>

  <h3 class="lesson-section__heading">1. N+1問題の概要</h3>
  <p>
    N+1問題とは「1回目にメインのレコードを取得し、その後に関連レコードを N 回（レコード数だけ）取得してしまう」構造です。
    10,000件のユーザーを表示するだけで 10,001 回のクエリが発行されることも珍しくありません。
  </p>

  <h3 class="lesson-section__heading">2. 占いアプリでの具体例</h3>
  <div class="lesson-comparison">
    <div class="lesson-comparison__item lesson-comparison__item--bad">
      <h4>❌ 悪い例（N+1問題を引き起こすコード）</h4>
      <pre><code class="language-php">$users = User::all(); // 1回目のクエリ

foreach ($users as $user) {
    echo $user->fortune->result; // N回のクエリ
}</code></pre>
      <p class="lesson-text--muted">ユーザー数だけループし、毎回 fortune を遅延ロード → クエリ回数が爆発。</p>
    </div>
    <div class="lesson-comparison__item lesson-comparison__item--good">
      <h4>✅ 良い例（Eager Loading で解決）</h4>
      <pre><code class="language-php">$users = User::with('fortune')->get(); // クエリは 2 回のみ

foreach ($users as $user) {
    echo $user->fortune->result; // 追加のクエリなし
}</code></pre>
      <p class="lesson-text--muted">関連データをあらかじめ読み込むことで、クエリ数を一定に保てます。</p>
    </div>
  </div>

  <h3 class="lesson-section__heading">3. 発行される SQL の比較</h3>
  <pre><code class="language-sql">-- 悪い例：10,001回のクエリ
SELECT * FROM users;
SELECT * FROM fortunes WHERE user_id = 1;
SELECT * FROM fortunes WHERE user_id = 2;
-- ... ユーザー数分繰り返し

-- 良い例：2回のクエリ
SELECT * FROM users;
SELECT * FROM fortunes WHERE user_id IN (1, 2, 3, ...);
</code></pre>
</section>
