@section('title', 'Lesson 00 演習 - コーディング準備')
@section('body-class', 'exercise--environment')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson00') }}">Lesson 00</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 00 演習: コーディング環境の準備</h1>
  <p class="exercise-hero__lead">
    GitHub / エディタ / ターミナルなど、開発を始めるための必須ツールを実際にセットアップします。
    ここで整えた環境が以降のレッスン・演習の土台になります。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Environment</li>
    <li class="exercise-hero__tag">GitHub</li>
    <li class="exercise-hero__tag">Terminal</li>
    <li class="exercise-hero__tag">Docker</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="globe"></i> 演習 1: アカウントとツールの準備</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      まずは開発者としての基本セットを整えます。GitHub や VS Code を導入し、ターミナル操作に慣れておきましょう。
    </p>
    <ol class="exercise-card__steps">
      <li>GitHub アカウントを作成し、プロフィール情報を更新する</li>
      <li>Visual Studio Code をインストールし、日本語化拡張や推奨プラグインをセットアップ</li>
      <li>ターミナル（macOS）または Windows Terminal / WSL を起動し、ホームディレクトリを確認</li>
    </ol>
    <pre><code class="language-bash"># ホームディレクトリへ移動
cd ~

# 現在のディレクトリを表示
pwd</code></pre>
    <div class="exercise-note">
      <strong>補足:</strong> Windows の PowerShell では <code>pwd</code> が <code>Get-Location</code> に置き換わる点に注意してください。
      WSL (Ubuntu) では Bash コマンドがそのまま利用できます。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="laptop"></i> 演習 2: macOS 環境の整備</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      macOS での開発を想定したツールチェーンを構築します。Homebrew 経由で Git などを導入し、ログを残しましょう。
    </p>
    <ol class="exercise-card__steps">
      <li>Command Line Tools をインストールし、"The software was installed." のメッセージを確認</li>
      <li>Homebrew インストール後に <code>brew --version</code> を実行し、バージョンを控えておく</li>
      <li><code>brew install git</code> で Git を導入し、インストールログやバージョンを記録する</li>
    </ol>
    <pre><code class="language-bash">xcode-select --install
brew --version
git --version</code></pre>
    <div class="exercise-warning">
      <strong>注意:</strong> Homebrew インストール直後に表示される PATH 追記コマンドを必ず実行し、
      <code>.zprofile</code> へ追記しておきましょう。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="monitor"></i> 演習 3: Windows + WSL 環境の整備</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      WSL2 と Docker Desktop を組み合わせ、Linux ベースの開発環境を整えます。Windows でも同様の操作感を実現しましょう。
    </p>
    <ol class="exercise-card__steps">
      <li>WSL2 を有効にし、Ubuntu をインストールして初期設定を完了する</li>
      <li>Docker Desktop を起動し、WSL 統合設定で Ubuntu を有効化</li>
      <li>Ubuntu ターミナルで Git をインストールし、バージョン確認と更新を行う</li>
    </ol>
    <pre><code class="language-powershell">wsl --install -d Ubuntu</code></pre>
    <pre><code class="language-bash">sudo apt update && sudo apt upgrade -y
sudo apt install git -y
git --version</code></pre>
    <div class="exercise-note">
      <strong>Docker 確認:</strong> PowerShell で <code>docker version</code> を実行し、Server 情報が返るか確認してください。
      未起動の場合は Docker Desktop を立ち上げてから再度実行します。
    </div>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ GitHub / VS Code / ターミナルが起動でき、必要なプラグインが導入されている</li>
    <li>✅ Homebrew もしくは winget / WSL が利用可能で、バージョン確認ができる</li>
    <li>✅ Git のバージョンが表示でき、パス設定が適切に行われている</li>
    <li>✅ Docker Desktop が起動し、`docker version` が Server 情報を返す</li>
    <li>✅ スクリーンショットやメモを Notion/Docs 等に保存し、再現できるようにしている</li>
  </ul>
</section>

@php
  $lesson00Hints = [
      new \Illuminate\Support\HtmlString('まずは <code>git --version</code> や <code>brew --version</code> など基本コマンドで環境が整っているか確認し、足りないものを洗い出しましょう。'),
      new \Illuminate\Support\HtmlString('スクリーンショットはフォルダを分けて保存しておくと、後日の振り返りやチーム共有にとても役立ちます。')
  ];

  $lesson00Answer = new \Illuminate\Support\HtmlString(view('LaravelExercises.beginner.lesson00.answer')->render());
@endphp

<x-exercise.reveal id="lesson00-overview" :hints="$lesson00Hints" :answer="$lesson00Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link" href="{{ route('lesson00') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 00 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson01') }}">
    Lesson 01 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
