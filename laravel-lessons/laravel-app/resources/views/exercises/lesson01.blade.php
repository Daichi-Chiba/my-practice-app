<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lesson 01 演習 - 環境構築とGitフロー</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:#000;color:#fff;line-height:1.8}
    .container{max-width:900px;margin:0 auto;padding:2.5rem}
    a{color:#61dafb;text-decoration:none}
    a:hover{text-decoration:underline}
    h1{font-size:2.2rem;margin-bottom:1rem;background:linear-gradient(135deg,#fff,#777);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    p{color:#aaa;margin-bottom:1rem}
    section{background:#0a0a0a;border:1px solid #1a1a1a;border-radius:16px;padding:2rem;margin-bottom:2rem}
    h2{font-size:1.5rem;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem}
    h2 svg{width:20px;height:20px}
    h3{font-size:1.1rem;margin:1.2rem 0 .7rem;color:#ddd}
    ul,ol{margin:1rem 0 1rem 1.5rem;color:#aaa}
    pre{background:#050505!important;border:1px solid #1a1a1a;border-radius:12px;padding:1.1rem!important;margin:1rem 0;overflow-x:auto}
    code{font-family:'Consolas','Monaco',monospace;font-size:.9rem}
    :not(pre)>code{background:#1a1a1a;padding:.15rem .45rem;border-radius:4px;color:#ff2d20}
    .checklist{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem}
    .check-item{background:#050505;border:1px solid #1a1a1a;border-radius:12px;padding:1.2rem;color:#bbb;font-size:.95rem}
    .note{background:linear-gradient(135deg,rgba(97,218,251,.08),rgba(32,116,132,.08));border-left:4px solid #61dafb;border-radius:8px;padding:1rem;margin:1rem 0;color:#cfe9ff}
    .warning{background:linear-gradient(135deg,rgba(255,45,32,.08),rgba(139,20,14,.08));border-left:4px solid #ff2d20;border-radius:8px;padding:1rem;margin:1rem 0;color:#ffcbc2}
    .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.4rem;background:#111;border:1px solid #2a2a2a;border-radius:10px;color:#fff;margin-right:.8rem;margin-top:1.2rem}
    .btn:hover{background:#1c1c1c}
  </style>
</head>
<body>
  <div class="container">
    <h1>Lesson 01 演習: 環境構築とGitフロー</h1>
    <p>このページでは Lesson 01 の演習内容を詳細に解説します。チェックリストを埋めながら、最終的に <code>feature/01-foundation</code> ブランチで PR を作成してください。</p>

    <section>
      <h2><i data-lucide="radar"></i> 演習 1: Docker 環境の立ち上げ</h2>
      <h3>手順</h3>
      <ol>
        <li>プロジェクトをクローンし <code>docker/</code> ディレクトリへ移動</li>
        <li><code>docker compose up -d --build</code> でコンテナ起動</li>
        <li><code>docker compose exec laravel-lessons bash</code> でアプリコンテナに入る</li>
        <li><code>composer install</code>、<code>cp .env.example .env</code>、<code>php artisan key:generate</code></li>
        <li><code>php artisan migrate --seed</code> で初期データ投入</li>
        <li>ブラウザで <code>http://localhost:8001</code> にアクセスし表示を確認</li>
      </ol>
      <div class="note">
        <strong>確認ポイント:</strong> エラーが出た場合はコンテナログ (<code>docker compose logs</code>) を参照し、依存パッケージやポート競合を解消してください。
      </div>
    </section>

    <section>
      <h2><i data-lucide="git-branch"></i> 演習 2: Git フロー実践</h2>
      <h3>課題</h3>
      <ol>
        <li><code>feature/setup-debug-tools</code> ブランチを作成</li>
        <li>README にセットアップ手順を追記し、Debugbar/Telescope を導入</li>
        <li><code>git add .</code> → <code>git commit</code> （Conventional Commits 推奨）</li>
        <li>GitHub にプッシュし PR を作成。セルフレビューで確認事項を記入</li>
        <li>レビュワーからのフィードバックに備え、実行ログやスクリーンショットを添付</li>
      </ol>
      <div class="warning">
        <strong>注意:</strong> <code>.env</code> や <code>storage/logs/*</code> など機密性・変動性の高いファイルをコミットしないように <code>.gitignore</code> を確認してください。
      </div>
    </section>

    <section>
      <h2><i data-lucide="check-square"></i> 提出チェックリスト</h2>
      <div class="checklist">
        <div class="check-item">✅ Docker でアプリが起動し、ホーム画面が表示できる</div>
        <div class="check-item">✅ Debugbar と Telescope が動作し、クエリやログが確認できる</div>
        <div class="check-item">✅ README にセットアップ手順と開発フローが追記されている</div>
        <div class="check-item">✅ PR にスクリーンショット・テスト結果が添付されている</div>
        <div class="check-item">✅ main ブランチへマージ後、次の Lesson ブランチを作成済み</div>
      </div>
    </section>

    <section>
      <h2><i data-lucide="refresh-cw"></i> 参考コマンド集</h2>
      <pre><code class="language-bash"># コンテナログの確認
docker compose logs -f laravel-lessons

# コンテナ再起動
docker compose restart laravel-lessons

# Composer キャッシュクリア
composer clear-cache

# Telescope の一時停止
php artisan telescope:pause
</code></pre>
    </section>

    <div>
      <a class="btn" href="{{ route('lesson01') }}">
        <i data-lucide="arrow-left"></i>
        Lesson 01 に戻る
      </a>
      <a class="btn" href="{{ route('lesson02') }}">
        Lesson 02 へ進む
        <i data-lucide="arrow-right"></i>
      </a>
    </div>
  </div>
  <script>hljs.highlightAll(); lucide.createIcons();</script>
</body>
</html>
