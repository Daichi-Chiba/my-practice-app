<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lesson 00 演習 - コーディング準備</title>
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
    .note{background:linear-gradient(135deg,rgba(97,218,251,.08),rgba(32,116,132,.08));border-left:4px solid #61dafb;border-radius:8px;padding:1rem;margin:1rem 0;color:#cfe9ff}
    .warning{background:linear-gradient(135deg,rgba(255,45,32,.08),rgba(139,20,14,.08));border-left:4px solid #ff2d20;border-radius:8px;padding:1rem;margin:1rem 0;color:#ffcbc2}
    .checklist{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;margin-top:1rem}
    .check-item{background:#050505;border:1px solid #1a1a1a;border-radius:12px;padding:1.2rem;color:#bbb;font-size:.95rem}
    .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.4rem;background:#111;border:1px solid #2a2a2a;border-radius:10px;color:#fff;margin-right:.8rem;margin-top:1.2rem}
    .btn:hover{background:#1c1c1c}
  </style>
</head>
<body>
  <div class="container">
    <h1>Lesson 00 演習: コーディング環境の準備</h1>
    <p>ここでは Lesson 00 の内容を実際に手を動かしながら確認します。完了した項目はメモにチェックし、スクリーンショットを残しておくことを推奨します。</p>

    <section>
      <h2><i data-lucide="globe"></i> 演習 1: アカウントとツールの準備</h2>
      <h3>タスク</h3>
      <ol>
        <li>GitHub アカウントを作成し、プロフィール情報を設定する</li>
        <li>Visual Studio Code をインストールし、日本語化拡張機能を追加する（任意）</li>
        <li>ターミナル（macOS）または Windows Terminal を起動し、ホームディレクトリを確認する</li>
      </ol>
      <pre><code class="language-bash"># ホームディレクトリへ移動
cd ~

# 現在のディレクトリを表示
pwd
</code></pre>
      <div class="note">
        <strong>補足:</strong> Windows の場合は <code>pwd</code> コマンドが PowerShell では <code>Get-Location</code> になりますが、WSL (Ubuntu) 上では Bash コマンドが利用できます。
      </div>
    </section>

    <section>
      <h2><i data-lucide="laptop"></i> 演習 2: macOS 環境の整備</h2>
      <h3>タスク</h3>
      <ol>
        <li>Command Line Tools をインストールし、成功メッセージを確認する</li>
        <li>Homebrew のインストール後、<code>brew --version</code> でバージョンを表示する</li>
        <li><code>brew install git</code> を実行し、インストールログを保存しておく</li>
      </ol>
      <pre><code class="language-bash">xcode-select --install
brew --version
git --version
</code></pre>
      <div class="warning">
        <strong>注意:</strong> Homebrew インストール後にパス設定の案内が表示されたら、指示通り <code>eval "$(/opt/homebrew/bin/brew shellenv)"</code> を実行し、<code>.zprofile</code> へ追記するのを忘れないでください。
      </div>
    </section>

    <section>
      <h2><i data-lucide="monitor"></i> 演習 3: Windows + WSL 環境の整備</h2>
      <h3>タスク</h3>
      <ol>
        <li>WSL2 を有効にし、Ubuntu をインストールして初期設定を完了する</li>
        <li>Docker Desktop を起動し、WSL 統合設定で Ubuntu を有効化する</li>
        <li>Ubuntu ターミナルで Git をインストールし、バージョンを確認する</li>
      </ol>
      <pre><code class="language-powershell">wsl --install -d Ubuntu
</code></pre>
      <pre><code class="language-bash">sudo apt update && sudo apt upgrade -y
sudo apt install git -y
git --version
</code></pre>
      <div class="note">
        <strong>Docker確認:</strong> PowerShell で <code>docker version</code> を実行し、Server 情報が返るか確認します。未起動の場合は Docker Desktop を立ち上げてください。
      </div>
    </section>

    <section>
      <h2><i data-lucide="check-circle"></i> 提出チェックリスト</h2>
      <div class="checklist">
        <div class="check-item">✅ GitHub / VS Code / ターミナルが起動できる</div>
        <div class="check-item">✅ Homebrew もしくは winget / WSL が利用できる</div>
        <div class="check-item">✅ Git のバージョンが確認できる</div>
        <div class="check-item">✅ Docker Desktop のアイコンが緑色になっている</div>
        <div class="check-item">✅ 工程ごとのスクリーンショットを Notion/Docs などに保存済み</div>
      </div>
      <p style="color:#777;margin-top:1rem">Lesson 01 のブランチ作業に入る前に、このページの項目をすべて埋めておきましょう。</p>
    </section>

    <div>
      <a class="btn" href="{{ route('lesson00') }}">
        <i data-lucide="arrow-left"></i>
        Lesson 00 に戻る
      </a>
      <a class="btn" href="{{ route('lesson01') }}">
        Lesson 01 へ進む
        <i data-lucide="arrow-right"></i>
      </a>
    </div>
  </div>
  <script>hljs.highlightAll(); lucide.createIcons();</script>
</body>
</html>
