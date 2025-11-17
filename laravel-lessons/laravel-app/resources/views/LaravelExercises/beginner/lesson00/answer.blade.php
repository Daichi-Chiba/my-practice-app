@php
  $lesson00Tasks = [
      [
          'title' => 'SSH キー生成と GitHub 登録',
          'description' => 'GitHub アカウントを準備し、SSH で安全に接続できるようにします。',
          'code' => <<<'CODE'
# GitHub と安全にやり取りするための SSH キーを生成（ed25519 は高速で推奨）
ssh-keygen -t ed25519 -C "you@example.com"

# 生成した公開鍵をクリップボードへコピーし、GitHub の SSH Keys 設定に貼り付け
pbcopy < ~/.ssh/id_ed25519.pub

# SSH 接続が成功するかを GitHub へテスト（"Hi username" が出れば成功）
ssh -T git@github.com
CODE
      ],
      [
          'title' => 'Laravel Sail プロジェクトを新規作成',
          'description' => 'Git クローンではなく、Laravel Build スクリプトを使って Sail 対応アプリを作成します。',
          'code' => <<<'CODE'
# 学習用プロジェクトをまとめるディレクトリを作成して移動
mkdir -p ~/Projects && cd ~/Projects

# Laravel Build スクリプトを実行し、Sail 対応の新規プロジェクトを作成
curl -s https://laravel.build/fortune-app | bash

# プロジェクトへ移動し、Sail（Docker コンテナ）をバックグラウンドで起動
cd fortune-app
./vendor/bin/sail up -d

# アプリ固有の暗号化キーと初期データを設定
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed

# Laravel と PHP のバージョンを確認しておくとチームで共有しやすい
./vendor/bin/sail artisan --version
./vendor/bin/sail php --version
CODE
      ],
      [
          'title' => '開発ツールの起動と確認',
          'description' => 'Docker / VS Code / 基本コマンドが利用可能かを最終確認します。',
          'code' => <<<'CODE'
# Docker Desktop アプリを起動（コンテナを動かす前提条件）
open -a Docker

# Homebrew / Git / Docker のバージョン確認（チームで揃える指標）
brew --version
git --version
docker --version
docker compose version

# VS Code でプロジェクトを開いて設定を整える
code .

# オプション: Sail 上でテストを実行し、環境が正しく動作するか確認
./vendor/bin/sail test
CODE
      ],
  ];

  $lesson00Summary = <<<'CODE'
# Lesson 00 まとめ（macOS / WSL2 の例）
ssh-keygen -t ed25519 -C "you@example.com"
pbcopy < ~/.ssh/id_ed25519.pub
ssh -T git@github.com

mkdir -p ~/Projects && cd ~/Projects
curl -s https://laravel.build/fortune-app | bash
cd fortune-app

./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail test

brew --version
git --version
docker --version
docker compose version
code .
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson00Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <p class="exercise-answer__lead">{!! $task['description'] !!}</p>
      <pre><code class="language-bash">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <p class="exercise-answer__lead">上記手順をまとめると、以下のコマンド列で環境構築をすべて再現できます。</p>
    <pre><code class="language-bash">{{ $lesson00Summary }}</code></pre>
  </article>
</div>
