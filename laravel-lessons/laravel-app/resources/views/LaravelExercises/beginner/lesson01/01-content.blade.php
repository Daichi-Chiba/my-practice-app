@section('title', 'Lesson 01 演習 - 環境構築と Git フロー')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson01') }}">Lesson 01</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 01 演習: 環境構築と Git フロー</h1>
  <p class="exercise-hero__lead">
    Docker ベースの Laravel 環境を構築し、GitHub Flow に沿ったブランチ運用・PR 作成を体験します。
    チームで開発する前提を意識しながら、環境と手順を標準化しましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Docker</li>
    <li class="exercise-hero__tag">GitHub Flow</li>
    <li class="exercise-hero__tag">VS Code</li>
    <li class="exercise-hero__tag">CLI</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="radar"></i> 演習 1: Docker 環境の立ち上げ</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Fortune App を動かすための Docker コンテナ群（PHP / Nginx / MySQL）を起動し、ブラウザで確認します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>git clone</code> 後に <code>cp .env.example .env</code> を実行し、環境変数を調整</li>
      <li><code>./vendor/bin/sail up -d</code> でコンテナ起動、<code>php artisan key:generate</code> まで完了</li>
      <li><code>http://localhost</code> にアクセスし、Laravel の初期画面または TOP ページが表示されることを確認</li>
    </ol>
    <pre><code class="language-bash"># プロジェクトのクローン
$ git clone git@github.com:example/fortune-app.git
$ cd fortune-app

# 環境ファイルの作成と Sail 起動
$ cp .env.example .env
$ ./vendor/bin/sail up -d
$ ./vendor/bin/sail artisan key:generate</code></pre>
    <div class="exercise-note">
      <strong>ヒント:</strong> 立ち上げがうまくいかない場合は <code>./vendor/bin/sail ps</code> でコンテナの状態を確認し、ログ (<code>docker logs</code>) をチェックしましょう。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="git-branch"></i> 演習 2: Git ブランチとコミット運用</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      GitHub Flow を想定し、機能ブランチの作成から PR 作成・レビュー依頼までを一通り練習します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>main</code> から <code>feature/01-foundation</code> ブランチを切り、作業ログ (<code>README</code> 等) を更新</li>
      <li>適切にコミットを分割し、コミットメッセージを英語で統一 (<code>feat:</code> / <code>chore:</code> 等)</li>
      <li>GitHub にプッシュ後、Pull Request を作成しレビューアをアサイン</li>
    </ol>
    <pre><code class="language-bash"># ブランチ作成
$ git switch -c feature/01-foundation

# 変更差分の確認とコミット
$ git status
$ git add README.md
$ git commit -m "chore: add local setup checklist"

# リモートへプッシュ
$ git push origin feature/01-foundation</code></pre>
    <div class="exercise-warning">
      <strong>注意:</strong> PR の説明欄に「やったこと」「確認事項」「スクリーンショット」を必ず添付し、レビューしやすい状態に整えてください。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="workflow"></i> 演習 3: 自動チェックとレビューサイクル</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      CI で自動実行されるテストやコードスタイルチェックを確認し、レビューコメントへの対応を模擬します。
    </p>
    <ol class="exercise-card__steps">
      <li>GitHub Actions のワークフロー結果を確認し、失敗した場合はログから原因を切り分ける</li>
      <li>レビュアからの指摘を想定して差分を修正し、<code>git commit --amend</code> または追加コミットで対応</li>
      <li>レビュー承認後に <code>main</code> へマージし、<code>git pull</code> でローカルを同期</li>
    </ol>
    <div class="exercise-note">
      <strong>補足:</strong> CI が通らない状態ではマージを禁止する運用を想定しています。ローカルで <code>./vendor/bin/sail test</code> を実行してからプッシュしましょう。
    </div>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ Docker コンテナが立ち上がり、Laravel アプリが正常表示される</li>
    <li>✅ Git ブランチ運用に沿って PR を作成し、レビューフローを体験した</li>
    <li>✅ CI の結果を確認し、失敗時には原因をコメントに記載して共有した</li>
    <li>✅ README やドキュメントに環境構築手順が追記されている</li>
    <li>✅ PR にスクリーンショット・テスト結果・レビューポイントがまとめられている</li>
  </ul>
</section>

@php
  $lesson01Hints = [
      new \Illuminate\Support\HtmlString('<p>ブランチを切る前に <code>git status</code> で作業ツリーがクリーンか確認しておくと、初期コミットが整理されます。</p>'),
      new \Illuminate\Support\HtmlString('<p>PR には「やったこと」「確認したこと」「スクリーンショット」を書き出すテンプレを作っておくとレビューが円滑です。</p>'),
      new \Illuminate\Support\HtmlString('<p>CI 失敗時はログ終端だけでなく、先頭のセットアップ段階にヒントがあることが多いので通して読みましょう。</p>'),
  ];

  $lesson01Answer = new \Illuminate\Support\HtmlString(view('LaravelExercises.beginner.lesson01.answer')->render());
@endphp

<x-exercise.reveal id="lesson01-overview" :hints="$lesson01Hints" :answer="$lesson01Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link" href="{{ route('lesson01') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 01 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson02') }}">
    Lesson 02 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
