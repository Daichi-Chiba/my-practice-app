<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="shield-check"></i> ガバナンスと非機能要求</h2>
  <p class="lesson-section__lead">
    API を公開したあとも安定して運用するためには、監視・ロギング・バージョン管理ポリシーなどのガバナンス体制が必要です。
    Fortune API の長期運用を想定し、非機能要求を整理しましょう。
  </p>
  <ul class="lesson-list">
    <li><strong>監視:</strong> リクエスト成功率 / レイテンシ / Rate Limit 超過数をメトリクス化し、アラート閾値を決める</li>
    <li><strong>ロギング:</strong> トレース ID をヘッダーに付与し、複数サービス間の関連を追跡できるようにする</li>
    <li><strong>契約管理:</strong> OpenAPI の変更にはレビューとリリースノートを必須化し、クライアントと合意した非互換期日を明記</li>
    <li><strong>セキュリティ:</strong> API キー / OAuth クライアント管理、Scope 設計、定期的なトークンローテーション方針を文書化</li>
  </ul>
</section>
