<section class="lesson-section lesson-section--context">
  <h2 class="lesson-section__title"><i data-lucide="map"></i> Step 1: 境界づけられたコンテキストを再設計する</h2>
  <p class="lesson-section__lead">
    既存システムの実装を読み解き、コンテキストが混在している領域を洗い出します。ビジネス上の言葉に合わせて、ドメイン境界を線引きし直しましょう。
  </p>
  <ol class="lesson-steps">
    <li class="lesson-steps__item">
      <strong>1. ユビキタス言語を整理</strong>
      <span>ヒアリング結果・ドキュメント・ DB スキーマから頻出する語彙を収集し、意味の被りを排除します。</span>
    </li>
    <li class="lesson-steps__item">
      <strong>2. コンテキスト境界をスケッチ</strong>
      <span>C4 図やコンテキストマップを使い、外部システムや部署ごとの責務を可視化します。</span>
    </li>
    <li class="lesson-steps__item">
      <strong>3. 境界内の契約を定義</strong>
      <span>各コンテキストが提供する公開 API を宣言し、依存方向を一方向に保ちます。</span>
    </li>
  </ol>
  <div class="lesson-callout">
    <strong>ヒント:</strong> 図示するときは「誰がどのデータを更新するか」を軸に整理すると、曖昧な責務が浮き彫りになります。
  </div>
</section>
