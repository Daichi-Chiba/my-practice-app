<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="layers"></i> 認証アーキテクチャの整理</h2>
  <p class="lesson-section__lead">
    SPA / モバイル クライアントと Laravel バックエンドの間では「セッション」「API トークン」「管理画面用の同期アクセス」
    が混在します。ここでは要件とリスクを切り分け、Sanctum を中心としたハイブリッド構成を採用します。
  </p>

  <div class="lesson-comparison">
    <article class="lesson-comparison__item lesson-comparison__item--bad">
      <h4>悪い例: すべてを セッション 認証に依存</h4>
      <ul class="lesson-list">
        <li>SPA からは SameSite=Lax の制約で CORS を突破できない</li>
        <li>モバイルアプリでクッキーを扱うのは困難</li>
        <li>CSRF 対策を誤ると全 API が脆弱になる</li>
      </ul>
    </article>
    <article class="lesson-comparison__item lesson-comparison__item--good">
      <h4>解決策: Sanctum + Policy + Guard レイヤ</h4>
      <ul class="lesson-list">
        <li>SPA / モバイルは <code>Bearer &lt;token&gt;</code> によるパーソナルアクセストークン</li>
        <li>管理画面は従来のセッション + CSRF トークンで UX を確保</li>
        <li>Gate / Policy がロールごとの許可を制御し、Controller から認可ロジックを排除</li>
      </ul>
    </article>
  </div>

  <div class="lesson-details">
    <summary>主要コンポーネント</summary>
    <ul class="lesson-list">
      <li><strong>Sanctum</strong>: SPA / モバイル向けの軽量トークン管理</li>
      <li><strong>Guards</strong>: Web / API で別々のドライバーを利用 (session / sanctum)</li>
      <li><strong>Policies</strong>: リソース単位で CRUD 権限を宣言し、RBAC をコード化</li>
      <li><strong>Middleware</strong>: <code>EnsureFrontendRequestsAreStateful</code>, <code>auth:sanctum</code> などをルートに適用</li>
    </ul>
  </div>
</section>
