<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="life-buoy"></i> インシデント対応と運用手順</h2>
  <p class="lesson-section__lead">
    障害発生時に慌てず対処できるよう、インシデントレスポンス体制を整えます。検知から初動、コミュニケーション、振り返りまでの
    一連の流れを Fortune API の運用に合わせて文書化しましょう。
  </p>

  <h3 class="lesson-section__heading">1. 検知と初動</h3>
  <ul class="lesson-list">
    <li>PagerDuty / Opsgenie でオンコールスケジュールを管理し、重大アラートは 5 分以内に一次対応</li>
    <li>初動担当はステータスページ・社内チャットで状況を共有し、暫定的な影響範囲を整理</li>
    <li>Runbook に従ってトリアージを行い、サービス停止・部分障害・情報漏洩など優先度を判定</li>
  </ul>

  <h3 class="lesson-section__heading">2. ポストモーテム</h3>
  <ul class="lesson-list">
    <li>障害終了後 48 時間以内にポストモーテムを開催し、原因・再発防止策・追加タスクを記録</li>
    <li>学びをナレッジベースに蓄積し、SLO / SLA の見直しやアラート閾値の再設定につなげる</li>
    <li>顧客向け報告テンプレートを作成し、インシデントの透明性を担保</li>
  </ul>

  <div class="lesson-callout">
    <strong>Tip:</strong> 障害ログを時系列で記録することで、後から振り返りやすくなり、オンボーディングにも役立ちます。
  </div>
</section>
