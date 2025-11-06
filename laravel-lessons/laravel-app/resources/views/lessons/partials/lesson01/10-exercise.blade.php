<section class="lesson-section lesson-section--exercise">
  <h2 class="lesson-section__title"><i data-lucide="pen-tool"></i> 演習</h2>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">1</div>
      <h3 class="lesson-exercise__title">環境立ち上げ</h3>
    </div>
    <ol class="lesson-list">
      <li><code>docker compose up -d</code> を実行してコンテナを起動</li>
      <li><code>php artisan migrate --seed</code> を実行して初期データを投入</li>
      <li>Debugbar がブラウザ右下に表示されることを確認</li>
    </ol>
  </div>
  <div class="lesson-exercise">
    <div class="lesson-exercise__header">
      <div class="lesson-exercise__number">2</div>
      <h3 class="lesson-exercise__title">Git フロー</h3>
    </div>
    <ol class="lesson-list">
      <li><code>feature/setup-readme</code> ブランチを作成し README を更新</li>
      <li>PR を作成し、セルフレビューとチェックリスト記入を実施</li>
    </ol>
    <p class="lesson-text--small">詳細な課題と提出チェックリストは演習ページを参照してください。</p>
    <a class="lesson-button" href="{{ route('exercises.lesson01') }}">
      <i data-lucide="external-link"></i>
      演習ページへ
    </a>
  </div>
</section>
