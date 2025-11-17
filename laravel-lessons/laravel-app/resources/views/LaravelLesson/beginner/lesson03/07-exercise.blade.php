<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">リレーション実装</h3>
    </div>
    <ol class="lesson-list">
      <li><code>users</code> テーブルに外部キー <code>zodiac_id</code> を追加するマイグレーションを作成</li>
      <li>User / Zodiac モデルにリレーションを記述し、テストデータで動作確認</li>
      <li>ユーザー一覧で <code>$user->zodiac->name</code> を表示（Eager Loading 必須）</li>
    </ol>
  </div>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">CRUD 実装</h3>
    </div>
    <ol class="lesson-list">
      <li>Fortune の CRUD をコントローラ / ビューで実装し、一覧をページネーション</li>
      <li>FormRequest を導入し、<code>fortune_type</code> や <code>result</code> のバリデーションを追加</li>
      <li>演習結果を README に記録し、Pull Request を作成</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson03') }}">
      <i data-lucide="clipboard-list"></i>
      演習ページへ
    </a>
  </div>
</section>
