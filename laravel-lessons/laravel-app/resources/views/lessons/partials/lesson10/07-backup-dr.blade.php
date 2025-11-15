<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="database"></i> バックアップと災害復旧 (DR)</h2>
  <p class="lesson-section__lead">
    データ損失やリージョン障害に備え、バックアップと DR (Disaster Recovery) の方針を明確にします。Fortune API が長期的に運用される前提で、
    自動化されたバックアップとリストア手順を整備しましょう。
  </p>

  <h3 class="lesson-section__heading">1. バックアップ設計</h3>
  <ul class="lesson-list">
    <li>DB スナップショット（例: RDS / Cloud SQL）を 1 日 1 回以上取得し、保持期間を環境ごとに定義</li>
    <li>アプリケーション設定や .env は Secrets Manager / Parameter Store で管理し、暗号化状態でバックアップ</li>
    <li>オブジェクトストレージに保存するファイルはバージョニング + ライフサイクルポリシーで世代管理</li>
  </ul>

  <h3 class="lesson-section__heading">2. DR テスト</h3>
  <pre><code class="language-bash"># ステージングでの定期リストア手順
aws rds restore-db-instance-from-s3 \
  --db-instance-identifier fortune-restore-$(date +%Y%m%d) \
  --s3-bucket backups-fortune \
  --s3-prefix daily/

# リストア後にマイグレーション適用
php artisan migrate --force
</code></pre>

  <div class="lesson-callout">
    <strong>Tip:</strong> リストア手順は Runbook として残し、四半期に一度は実際に復旧テストを行って手順の陳腐化を防ぎましょう。
  </div>
</section>
