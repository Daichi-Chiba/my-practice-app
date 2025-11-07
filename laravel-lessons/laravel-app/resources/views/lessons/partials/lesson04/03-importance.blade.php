<section class="lesson-section lesson-section--importance">
  <h2 class="lesson-section__title"><i data-lucide="briefcase"></i> 実務での重要性</h2>
  <p class="lesson-section__lead">
    N+1問題は「開発中は気づきにくいが、本番で顕在化する」典型的な性能問題です。<br>
    クエリ数の爆発はレスポンス低下やタイムアウトにつながり、ユーザー離脱に直結します。
  </p>
  <div class="lesson-callout lesson-callout--warning">
    <strong>実案件でのトラブル例:</strong>
    10,000ユーザーの一覧ページで N+1 が発生し、ページ表示に 10 秒以上。<br>
    Eager Loading に置き換えた結果、クエリ数を 10,001 → 2、レスポンスを 0.3 秒まで改善。
  </div>
  <div class="lesson-callout">
    <strong>SES/受託現場で評価されるポイント:</strong>
    レビューで N+1 リスクに気づき、改善案（with/load/ページネーション）を提示できること。
  </div>
</section>
