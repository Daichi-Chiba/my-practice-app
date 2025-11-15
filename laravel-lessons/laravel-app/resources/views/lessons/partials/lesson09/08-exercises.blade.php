<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">同期処理からジョブへ切り出す</h3>
    </div>
    <p class="lesson-text--muted">メール送信やレポート生成など時間のかかる処理をジョブへ移し、コントローラ応答時間を短縮します。</p>
    <ol class="lesson-list">
      <li>Fortune API の通知処理を Job クラス化し、<code>dispatch()</code> でキュー投入</li>
      <li>冪等性を考慮し、重複通知を防ぐテーブル or キャッシュ制御を実装</li>
      <li>Feature テストで 202 応答と通知履歴が作成されることを確認</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">Horizon 監視とアラート設定</h3>
    </div>
    <p class="lesson-text--muted">Horizon でジョブを可視化し、失敗時に Slack へ即時通知できる運用体制を整えます。</p>
    <ol class="lesson-list">
      <li>Horizon ダッシュボードを起動し、タグでジョブ種別を識別可能にする</li>
      <li>失敗ジョブ発生時に Slack 通知を送る設定を追加</li>
      <li>統計画面から Throughput / Runtime の目標値を決め、README に運用ルールとして記載</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson09') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 09 演習ページへ
    </a>
  </div>
</section>
