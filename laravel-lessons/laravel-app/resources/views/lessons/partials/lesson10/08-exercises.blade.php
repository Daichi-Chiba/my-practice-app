<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">ゼロダウンタイムデプロイの整備</h3>
    </div>
    <p class="lesson-text--muted">GitHub Actions とサーバー側のデプロイスクリプトを連携させ、停止時間なく本番リリースできる仕組みを構築します。</p>
    <ol class="lesson-list">
      <li>リリースタグを作成し、Envoy / Deployer などでシンボリックリンク切り替えフローを実装</li>
      <li>本番用 secrets を GitHub Actions に登録し、CI から自動デプロイ</li>
      <li>ローリングリスタートや Horizon の再起動手順を runbook に追記</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">監視・アラート体制の構築</h3>
    </div>
    <p class="lesson-text--muted">ログ・メトリクス・トレースを連携し、SLO 達成状況を継続的に確認できるダッシュボードを整備します。</p>
    <ol class="lesson-list">
      <li>Grafana / Datadog にダッシュボードを作成し、レスポンス時間・エラーレート・ジョブ失敗数を可視化</li>
      <li>Alerting ルールを設定し、SLO 逸脱時に Slack / PagerDuty 通知</li>
      <li>README にモニタリング URL とアラート閾値、担当者を追記</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson10') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 10 演習ページへ
    </a>
  </div>
</section>
