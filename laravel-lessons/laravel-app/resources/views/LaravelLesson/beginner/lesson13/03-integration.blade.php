<section class="lesson-section lesson-section--accent">
  <h2 class="lesson-section__title">
    <i data-lucide="share"></i>
    フロント連携の実装ポイント
  </h2>
  <div class="lesson-columns">
    <article class="lesson-card">
      <h3 class="lesson-card__title">ページ遷移とデータフェッチ</h3>
      <p class="lesson-card__body">
        Inertia の `usePage` / `useForm` を活用し、遷移時のリクエスト数を減らしつつ
        ローディング UI とエラーハンドリングを統一します。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">API レイヤの境界設計</h3>
      <p class="lesson-card__body">
        フロントに最適化された Resource / Transformer を定義し、認可・バリデーション・
        レスポンス構造の責務を整理します。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">UX 向上テクニック</h3>
      <p class="lesson-card__body">
        前向き遷移やプリフェッチ、部分的な SSR などを組み合わせて
        ページレスポンスを高速化しつつ、ユーザー体験を損ねない方法を検討します。
      </p>
    </article>
  </div>
</section>
