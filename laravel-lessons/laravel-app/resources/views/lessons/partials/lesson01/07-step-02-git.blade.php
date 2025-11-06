<section class="lesson-section lesson-section--git">
  <h2 class="lesson-section__title"><i data-lucide="git-branch"></i> ステップ2: Git / GitHub Flow</h2>

  <h3 class="lesson-section__subtitle">2-1. ブランチ作成〜PR</h3>
  <pre><code class="language-bash">git checkout -b feature/setup-debug-tools
# 変更を加える
git add .
git commit -m "feat: Debugbar/Telescope を導入"
git push origin feature/setup-debug-tools</code></pre>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>リポジトリ</em>は Git で管理するプロジェクトの保管場所。GitHub 上ではリポジトリの URL がそのままプロジェクトの住所になります。
  </div>
  <p class="lesson-text--small">Git コマンドはホスト側のリポジトリルート（VS Code のターミナルなど）で実行します。Docker コンテナ内ではなくローカル側で OK です。</p>

  <h3 class="lesson-section__subtitle">2-2. PR テンプレート例</h3>
  <pre><code class="language-markdown">## 概要
- Debugbar/Telescope を導入し、開発時の可観測性を向上

## 動作確認
- [ ] docker compose up -d
- [ ] http://localhost:8001 が表示される
- [ ] Debugbar のクエリ/ログが見える

## 備考
- 本番では --dev 依存は除外</code></pre>
  <div class="lesson-callout">
    <strong>用語メモ:</strong> <em>Pull Request (PR)</em> は main ブランチに直接 push せずに変更を共有し、レビューを受ける GitHub の機能です。
  </div>
</section>
