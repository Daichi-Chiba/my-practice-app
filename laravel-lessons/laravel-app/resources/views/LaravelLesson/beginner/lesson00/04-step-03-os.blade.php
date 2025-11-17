<section class="lesson-section lesson-section--os">
  <h2 class="lesson-section__title"><i data-lucide="laptop"></i> Step 2: OS を選んでセットアップ</h2>
  <div class="lesson-tabs" data-lesson-tabs>
    <div class="lesson-tabs__controls">
      <button class="lesson-tabs__button lesson-tabs__button--active" data-target="lesson00-tab-mac">macOS</button>
      <button class="lesson-tabs__button" data-target="lesson00-tab-windows">Windows</button>
    </div>

    <div class="lesson-tabs__content lesson-tabs__content--active" id="lesson00-tab-mac">
      <h3 class="lesson-section__subtitle">1. Command Line Tools をインストール</h3>
      <pre><code class="language-bash">xcode-select --install</code></pre>
      <p class="lesson-text--small">インストール後、再度実行すると「already installed」が表示されれば完了です。ターミナルは Finder → アプリケーション → ユーティリティ → Terminal.app から起動します。</p>

      <h3 class="lesson-section__subtitle">2. Homebrew の導入</h3>
      <pre><code class="language-bash">/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"</code></pre>
      <div class="lesson-callout">
        <strong>Homebrew とは?</strong> macOS の代表的なパッケージマネージャー。CLI ツールを簡単にインストールできます。
      </div>

      <h3 class="lesson-section__subtitle">3. 必要ツールをまとめてインストール</h3>
      <pre><code class="language-bash">brew install git node pnpm
brew install --cask visual-studio-code docker
git --version
node -v</code></pre>
      <p class="lesson-text--small">コマンドはホームディレクトリ（<code>cd ~</code>）で実行すれば問題ありません。</p>
      <div class="lesson-callout">
        <strong>リポジトリとは?</strong> Git で管理するプロジェクトの保管場所。GitHub 上では URL がそのまま住所になります。
      </div>

      <h3 class="lesson-section__subtitle">4. Docker Desktop の初期設定</h3>
      <ul class="lesson-list">
        <li>アプリケーションから Docker Desktop を起動</li>
        <li>Sign in（アカウント未作成なら作成）</li>
        <li>クジラアイコンがメニューバーで点灯すれば準備完了</li>
      </ul>
      <div class="lesson-callout">
        <strong>コンテナとは?</strong> アプリの実行に必要な OS やミドルウェアをまとめた箱。Docker はコンテナを扱うためのツールです。
      </div>

      <h3 class="lesson-section__subtitle">5. VS Code の便利設定</h3>
      <ul class="lesson-list">
        <li>Command Palette (<code>⌘</code> + <code>Shift</code> + <code>P</code>) → “Shell Command: Install 'code' command in PATH”</li>
        <li>推奨拡張: Japanese Language Pack / PHP Intelephense / Docker</li>
      </ul>
      <div class="lesson-callout">
        <strong>Pull Request (PR) とは?</strong> GitHub の変更レビュー機能。main ブランチへ直接 push せず、安全に変更を共有できます。
      </div>

      <div class="lesson-callout lesson-callout--warning">
        <strong>トラブルシュート:</strong> Homebrew 実行時に "permission denied" が出た場合は、案内されたコマンドで PATH を設定し直してください。
      </div>

      <h3 class="lesson-section__subtitle">提出チェック（macOS）</h3>
      <ul class="lesson-checklist">
        <li class="lesson-checklist__item">✅ <code>brew --version</code> が表示される</li>
        <li class="lesson-checklist__item">✅ <code>docker version</code> で Client / Server が表示される</li>
        <li class="lesson-checklist__item">✅ <code>code .</code> で VS Code が開ける</li>
        <li class="lesson-checklist__item">✅ GitHub への SSH 接続（任意）を設定済み</li>
      </ul>
    </div>

    <div class="lesson-tabs__content" id="lesson00-tab-windows">
      <h3 class="lesson-section__subtitle">1. Windows Update と再起動</h3>
      <p class="lesson-section__lead">設定 → Windows Update から最新の更新を適用し、再起動しておきます。</p>

      <h3 class="lesson-section__subtitle">2. WSL2 + Ubuntu をセットアップ</h3>
      <pre><code class="language-powershell">wsl --install -d Ubuntu</code></pre>
      <p class="lesson-text--small">インストール後、ユーザー名とパスワードを設定します。PowerShell はスタートメニューで検索し、管理者として実行するとエラーが減ります。</p>

      <h3 class="lesson-section__subtitle">3. winget で主要ツールを導入</h3>
      <pre><code class="language-powershell">winget install --id Git.Git -e
winget install --id Microsoft.VisualStudioCode -e
winget install --id Docker.DockerDesktop -e</code></pre>
      <div class="lesson-callout">
        <strong>winget とは?</strong> Windows 用のパッケージマネージャー。PowerShell から簡単にソフトを導入できます。
      </div>

      <h3 class="lesson-section__subtitle">4. Ubuntu (WSL) 内での準備</h3>
      <pre><code class="language-bash">sudo apt update && sudo apt upgrade -y
sudo apt install git build-essential -y
git --version</code></pre>
      <p class="lesson-text--small">これらは WSL 上の Ubuntu ターミナル内で実行します。最初の <code>cd</code> は不要です。</p>

      <h3 class="lesson-section__subtitle">5. Docker Desktop を WSL と連携</h3>
      <ul class="lesson-list">
        <li>Docker Desktop → Settings → “General” で “Use the WSL 2 based engine” をオン</li>
        <li>“Resources” → “WSL Integration” で Ubuntu を有効化</li>
        <li>PowerShell で <code>docker version</code> を実行し、Server 情報を確認</li>
      </ul>

      <h3 class="lesson-section__subtitle">6. VS Code で WSL を活用</h3>
      <ul class="lesson-list">
        <li>VS Code 拡張「Remote - WSL」をインストール</li>
        <li>VS Code → コマンドパレット → “Remote-WSL: New Window” で Ubuntu 上のフォルダを開く</li>
      </ul>

      <div class="lesson-callout lesson-callout--warning">
        <strong>トラブルシュート:</strong> Docker Desktop 起動時に仮想化エラーが出た場合、BIOS 設定で Virtualization を有効にする必要があります。
      </div>

      <h3 class="lesson-section__subtitle">提出チェック（Windows）</h3>
      <ul class="lesson-checklist">
        <li class="lesson-checklist__item">✅ PowerShell で <code>winget --version</code> が表示される</li>
        <li class="lesson-checklist__item">✅ WSL Ubuntu で <code>lsb_release -a</code> が実行できる</li>
        <li class="lesson-checklist__item">✅ VS Code から WSL 上のフォルダを開ける</li>
        <li class="lesson-checklist__item">✅ Docker Desktop のクジラアイコンが緑色</li>
      </ul>
    </div>
  </div>
</section>
