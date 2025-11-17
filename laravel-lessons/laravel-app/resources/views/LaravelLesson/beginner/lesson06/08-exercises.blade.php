<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">Sanctum トークン発行 API の実装</h3>
    </div>
    <p class="lesson-text--muted">
      パーソナルアクセストークン発行用エンドポイントを実装し、権限スコープを付与したレスポンスを返しましょう。
    </p>
    <ol class="lesson-list">
      <li><code>Auth\ApiTokenController@store</code> を作成し、メール・パスワード・デバイス名で検証する</li>
      <li><code>User::createToken()</code> で <code>api:fortunes</code> スコープ付きトークンを発行</li>
      <li>Sanctum のテーブルにレコードが保存され、レスポンスにトークン文字列が含まれることを確認</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">Policy &amp; RBAC の導入</h3>
    </div>
    <p class="lesson-text--muted">
      Fortune 管理画面を題材に、ロールベースで更新・削除が制限されるよう Policy を実装します。
    </p>
    <ol class="lesson-list">
      <li>Role モデル / ピボットを作成し、<code>admin</code>・<code>editor</code> ロールを割り当てる</li>
      <li><code>FortunePolicy</code> を定義し、<code>update</code>/<code>delete</code> をロール条件で制限</li>
      <li>テストまたは tinker で、ロールに応じて <code>$this-&gt;authorize()</code> が通る/拒否されることを確認</li>
    </ol>

    <a class="lesson-button" href="{{ route('exercises.lesson06') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 06 演習ページへ
    </a>
  </div>
</section>
