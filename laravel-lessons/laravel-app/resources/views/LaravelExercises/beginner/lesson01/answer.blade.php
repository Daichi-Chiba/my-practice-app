@php
  $lesson01Tasks = [
      [
          'title' => 'Docker Sail の起動',
          'code' => <<<'CODE'
# プロジェクトのクローン
mkdir -p ~/Projects && cd ~/Projects
git clone git@github.com:example/fortune-app.git
cd fortune-app

# Sail を起動
cp .env.example .env
./vendor/bin/sail up -d

# アプリ初期化
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
CODE
      ],
      [
          'title' => 'Git ブランチ運用と CI',
          'code' => <<<'CODE'
# ブランチ作成とコミット
./vendor/bin/sail artisan --version
./vendor/bin/sail php --version

# Git Flow
git switch -c feature/01-foundation
git status
git add README.md
git commit -m "chore: add setup checklist"

# PR 作成後は CI を確認
./vendor/bin/sail test
CODE
      ],
      [
          'title' => 'Pull Request テンプレート例',
          'code' => <<<'CODE'
## やったこと
- Docker Sail を起動し開発環境を構築
- README にセットアップ手順を追記

## 確認したこと
- [x] `./vendor/bin/sail test` が成功
- [x] Docker Desktop が起動し `localhost` にアクセスできる

## スクリーンショット
- Docker Desktop 起動
- Laravel 初期ページ表示
CODE
      ],
  ];

  $lesson01Summary = <<<'CODE'
mkdir -p ~/Projects && cd ~/Projects
git clone git@github.com:example/fortune-app.git
cd fortune-app
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed

git switch -c feature/01-foundation
./vendor/bin/sail test
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson01Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-bash">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-bash">{{ $lesson01Summary }}</code></pre>
  </article>
</div>
