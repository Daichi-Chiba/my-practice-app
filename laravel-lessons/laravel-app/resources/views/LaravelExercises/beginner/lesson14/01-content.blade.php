@section('title', 'Lesson 14 演習 - 小規模プロジェクト統合')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson14') }}">Lesson 14</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 14 演習: 小規模プロジェクトを統合する</h1>
  <p class="exercise-hero__lead">
    これまでに構築したバックエンド・フロント・インフラの各要素を統合し、小規模ながら本番運用を想定した完成度の高いプロジェクトに仕上げます。
    設計の一貫性・運用フロー・ドキュメントを整備し、チーム開発に耐える状態を整えましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Project Setup</li>
    <li class="exercise-hero__tag">Documentation</li>
    <li class="exercise-hero__tag">Release</li>
    <li class="exercise-hero__tag">Code Review</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="folder-tree"></i> 課題 1: モジュール統合とアーキテクチャ整理</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      認証・API・UI コンポーネントなどを統合し、クリーンなレイヤ構成へリファクタリングします。
    </p>
    <ol class="exercise-card__steps">
      <li>サービス層・リポジトリ層を見直し、責務ごとにディレクトリを整理</li>
      <li>ユースケース単位でテストを揃え、Feature/E2E テストの抜け漏れを補完</li>
      <li>アーキテクチャ図（C4 など）を作成し、README/Docs に反映</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="git-pull-request"></i> 課題 2: レビューと QA プロセス</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      チーム開発を想定したコードレビューと QA フローを整え、品質を保証します。
    </p>
    <ol class="exercise-card__steps">
      <li>PR テンプレートを更新し、チェックリスト（テスト結果・スクリーンショット・影響範囲）を追加</li>
      <li>QA 手順書を作成し、受け入れテストの観点を整理。ステージング環境での確認内容を記録</li>
      <li>コメントでの指摘例やレビューポリシーをドキュメント化し、新メンバー向けのガイドを整備</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="file-text"></i> 課題 3: ドキュメントとナレッジ共有</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      プロジェクト概要・セットアップ手順・運用ルールを整理し、誰でも参画できるようナレッジを体系化します。
    </p>
    <ol class="exercise-card__steps">
      <li>README をプロジェクトホームとして整備し、環境変数・起動手順・テスト方法を網羅</li>
      <li>Notion / Confluence 等に進捗管理・設計メモ・振り返りをまとめ、リンクを README から参照</li>
      <li>オンボーディング用の Quick Start Guide を作成し、新規参加者が 1 日で環境構築できるようにする</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="sparkles"></i> 課題 4: リリース準備とデモ</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      ベータリリースを想定し、デモ環境・ユーザーテスト・フィードバックループを整備します。
    </p>
    <ol class="exercise-card__steps">
      <li>ステージング環境でデモアカウントを用意し、テストデータを投入</li>
      <li>ユーザーテストシナリオを作成し、フィードバックを Issue 化して優先度付け</li>
      <li>振り返りミーティングを実施し、次ステップへ向けた改善項目を Backlog にまとめる</li>
    </ol>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ モジュール構成・テスト・ドキュメントが整い、オンボーディング資料が揃っている</li>
    <li>✅ PR / QA プロセスが運用可能な状態になっている</li>
    <li>✅ デモ環境とユーザーテストのフィードバックが整理され、改善 Backlog が作成されている</li>
  </ul>
</section>

@php
  $lesson14Hints = [
      new \Illuminate\Support\HtmlString('<p>アーキテクチャ図は C4 レベル 2 程度で充分です。コンポーネント間の依存を書きすぎると読みづらくなるのでレイヤー感を意識しましょう。</p>'),
      new \Illuminate\Support\HtmlString('<p>レビュー体制は「誰がどの種類の PR をレビューするか」を RACI で整理すると新メンバーが迷いません。</p>'),
      new \Illuminate\Support\HtmlString('<p>デモ環境のシードデータは <code>php artisan db:seed --class=DemoSeeder</code> のようにコマンド化すると再現が簡単です。</p>'),
  ];

  $lesson14Answer = new \Illuminate\Support\HtmlString('<p><strong>解答例:</strong> Domain / Application / Infrastructure の 3 レイヤーへコードを整理し、ER 図・アーキテクチャ図を README に添付。PR テンプレートへテスト結果・スクリーンショット・影響範囲チェックリストを追加し、QA 手順書は Notion へまとめてリンク化。ステージング環境に Demo アカウントとシードデータを用意し、ユーザーテストで得たフィードバックを GitHub Issues にタグ付きで登録しました。</p>');
@endphp

<x-exercise.reveal id="lesson14-overview" :hints="$lesson14Hints" :answer="$lesson14Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson13') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 13 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson15') }}">
    Lesson 15 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
