<section class="lesson-section lesson-section--integration">
  <h2 class="lesson-section__title"><i data-lucide="git-merge"></i> Step 4: 既存コードとの統合戦略</h2>
  <p class="lesson-section__lead">
    新しいコンテキストを段階的に導入するための戦略を立てます。リファクタリング中にプロダクションへ影響を出さないための切り分けを検討しましょう。
  </p>
  <div class="lesson-columns">
    <article class="lesson-card">
      <h3 class="lesson-card__title">フェーズ移行のステップ</h3>
      <ol class="lesson-steps lesson-steps--compact">
        <li><strong>反復 1:</strong> ドメインイベントを発火させ、モニタリング用のリスナーで挙動を記録</li>
        <li><strong>反復 2:</strong> 新ユースケースを並走させ、 Feature Flag で旧処理と切り替える</li>
        <li><strong>反復 3:</strong> 旧サービスを撤去し、リポジトリ／サービスの依存を整理</li>
      </ol>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">技術的なチェックリスト</h3>
      <ul class="lesson-checklist lesson-checklist--compact">
        <li class="lesson-checklist__item">✅ Deployment 前にイベントの Replay シナリオを用意</li>
        <li class="lesson-checklist__item">✅ Rollback 時のフォールバックルート（旧ユースケース）を確保</li>
        <li class="lesson-checklist__item">✅ Observability（ログ／メトリクス）で異常検知を自動化</li>
      </ul>
    </article>
  </div>
</section>
