<section class="lesson-section lesson-section--accent">
  <h2 class="lesson-section__title">
    <i data-lucide="brain"></i>
    データ処理テクニック
  </h2>
  <div class="lesson-columns">
    <article class="lesson-card">
      <h3 class="lesson-card__title">Collection マクロと高階関数</h3>
      <p class="lesson-card__body">
        `map`, `flatMap`, `groupBy` を組み合わせたパイプラインをマクロ化し、
        同じ計算ロジックを複数箇所で再利用できるようにします。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">部分最適なクエリの排除</h3>
      <p class="lesson-card__body">
        `selectSub` や `withAggregate` を活用して、重複クエリを減らしながら
        階層データの集計やレーティング計算を最小限の SQL で実現します。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">アルゴリズム的リファクタリング</h3>
      <p class="lesson-card__body">
        二分探索やスライディングウィンドウなど、抽象化したアルゴリズムを
        コレクション操作に落とし込み、テストで検証します。
      </p>
    </article>
  </div>
</section>
