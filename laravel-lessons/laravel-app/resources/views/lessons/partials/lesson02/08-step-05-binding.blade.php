<section class="lesson-section lesson-section--binding">
  <h2 class="lesson-section__title"><i data-lucide="link"></i> Step 5: ルートモデルバインディング</h2>
  <p><code>Route::get('/fortunes/{fortune}', ...)</code> のように型宣言された引数をコントローラで受け取ると、Laravel が自動で該当モデルを解決します。存在しなければ 404 を返すため、ID の存在チェックを毎回書く必要がなくなります。</p>
  <div class="lesson-callout lesson-callout--success">
    <strong>確認ポイント:</strong> リレーションを読み込む場合は <code>RouteServiceProvider</code> での設定や <code>->load()</code> を活用し、N+1 問題を避けましょう。
  </div>
</section>
