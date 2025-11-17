<section class="lesson-section lesson-section--route-groups">
  <h2 class="lesson-section__title"><i data-lucide="folder-tree"></i> Step 3: ルートグループとミドルウェア</h2>
  <p>管理画面や API バージョンなど、まとまったルートには <code>Route::prefix()</code> と <code>Route::middleware()</code> を適用します。<code>routes/web.php</code> では次のように整理されています。</p>
  <ul class="lesson-list">
    <li><strong>prefix:</strong> URL に共通の接頭辞を付与（例: <code>/admin</code>）</li>
    <li><strong>name:</strong> ルート名に接頭辞を付与（例: <code>admin.dashboard</code>）</li>
    <li><strong>middleware:</strong> 認証・権限チェックを一括適用</li>
  </ul>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>Middleware</em> はリクエストの途中に挟まるフィルタ。認証（<code>auth</code>）や権限（<code>can:manage-users</code>）などをここで制御します。
  </div>
</section>
