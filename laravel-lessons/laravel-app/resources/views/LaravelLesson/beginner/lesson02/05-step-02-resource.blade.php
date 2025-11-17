<section class="lesson-section lesson-section--resource">
  <h2 class="lesson-section__title"><i data-lucide="layers"></i> Step 2: Resource コントローラとルート</h2>
  <pre><code class="language-bash">php artisan make:controller FortuneController --resource</code></pre>
  <p class="lesson-text--small">コマンドはリポジトリルート（例: <code>my-practice-app/laravel-lessons/laravel-app</code>）で実行します。Mac はターミナル、Windows は WSL の Ubuntu から OK。</p>
  <p>作成されたコントローラは <code>index</code> / <code>store</code> / <code>show</code> / <code>update</code> / <code>destroy</code> など 7 つのメソッドを持っています。不要なアクションは <code>Route::resource()</code> の <code>only</code> / <code>except</code> で制御しましょう。</p>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>Resource Controller</em> は RESTful CRUD をまとめて扱うための Laravel の仕組み。ルートとコントローラが一貫した命名で紐づくため、レビューしやすくなります。
  </div>
</section>
