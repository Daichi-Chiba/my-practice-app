<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">TDD でお気に入り機能を完成させる</h3>
    </div>
    <p class="lesson-text--muted">Red → Green → Refactor のサイクルを守りながら Fortune のお気に入り機能を仕上げます。</p>
    <ol class="lesson-list">
      <li>Feature テストを先に書き、失敗させた状態からスタートする</li>
      <li>最小限の実装でテストを通し、サービスクラスへリファクタリング</li>
      <li>ポリシー・イベントの連携を追加し、追加テストが通ることを確認</li>
    </ol>
  </div>

  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">CI ワークフローを整備する</h3>
    </div>
    <p class="lesson-text--muted">GitHub Actions で PHPUnit を実行し、main ブランチに対する品質ゲートを設けます。</p>
    <ol class="lesson-list">
      <li>ワークフローファイルを追加し、依存関係のインストールと DB 準備を自動化</li>
      <li><code>php artisan test --coverage</code> を実行し、レポートをアーティファクトまたは Codecov に送信</li>
      <li>CI が失敗した場合に Slack Webhook へ通知されるよう設定</li>
    </ol>
    <a class="lesson-button" href="{{ route('exercises.lesson07') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 07 演習ページへ
    </a>
  </div>
</section>
