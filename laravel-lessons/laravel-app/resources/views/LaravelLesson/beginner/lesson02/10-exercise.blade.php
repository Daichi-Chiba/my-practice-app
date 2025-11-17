<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">Fortune API の CRUD</h3>
    </div>
    <ol class="lesson-list">
      <li><code>Route::resource('fortunes', ...)</code> を定義し、<code>index/show/store</code> を実装</li>
      <li>一覧で最新 20 件をページネーション表示し、<code>?page=</code> の挙動を確認</li>
      <li>FormRequest で <code>fortune_type</code> のバリデーションを追加</li>
    </ol>
    <p class="lesson-text--small">ビューは <code>resources/views/fortunes/</code> 配下に配置します。存在しない場合は <code>mkdir resources/views/fortunes</code> でディレクトリを作成してください。</p>
  </div>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">管理画面ルートの設計</h3>
    </div>
    <ol class="lesson-list">
      <li><code>/admin</code> プレフィックスでダッシュボード・ユーザー管理・設定ページを作成</li>
      <li><code>auth</code> ミドルウェアと <code>can:manage-users</code> を適用し、未認証・権限不足での挙動を確認</li>
      <li>README に管理画面ルート一覧とアクセス要件を追記</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson02') }}">
      <i data-lucide="clipboard-list"></i>
      演習ページへ
    </a>
  </div>
</section>
