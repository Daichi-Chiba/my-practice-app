<section class="lesson-section lesson-section--goals">
  <h2 class="lesson-section__title"><i data-lucide="target"></i> 学習目標</h2>
  <ul class="lesson-list">
    <li>同期リクエストから切り離すべき処理を見極め、キュー投入の判断基準を言語化する</li>
    <li>Redis キューを前提に、Job / Event / Listener の役割を整理し再利用しやすいジョブ設計を身につける</li>
    <li>失敗ジョブの再試行ポリシーや冪等性設計を理解し、二重送信や重複処理を防ぐ戦略を学ぶ</li>
    <li>Horizon による監視・メトリクス活用で、運用時のボトルネックを可視化しアラートへ繋げる</li>
  </ul>
  <div class="lesson-callout">
    <strong>プロダクト連動:</strong> Lesson 08 で公開した Fortune API の通知処理をキュー化し、Lesson 09 でピークアクセスにも耐える構成に仕上げます。
  </div>
</section>
