@section('title', 'Lesson 13 演習 - フロントとの連携: Inertia & API')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson13') }}">Lesson 13</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 13 演習: Inertia.js でフロントと API を接続する</h1>
  <p class="exercise-hero__lead">
    Laravel + Inertia.js + React/Vue の組み合わせでダッシュボード機能を構築し、API とフロントエンドを密に連携させます。
    ルーティング・状態管理・バリデーション・エラーハンドリングを統合し、シームレスな SPA 体験を実現しましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Inertia.js</li>
    <li class="exercise-hero__tag">SPA</li>
    <li class="exercise-hero__tag">Axios</li>
    <li class="exercise-hero__tag">Validation</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="monitor"></i> 課題 1: Inertia ページと共有状態</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      ダッシュボード画面を Inertia ページとして作成し、共通レイアウトや Breadcrumb を共有します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>php artisan inertia:page Dashboard/FortuneIndex</code> を生成し、Laravel 側のルートを Inertia に接続</li>
      <li><code>Inertia::share()</code> を利用してユーザー情報・フラッシュメッセージ・ナビゲーションをグローバルに共有</li>
      <li>レイアウトコンポーネントでヘッダーやパンくずを統一し、ページ毎の差分はスロットで注入</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="send"></i> 課題 2: フォーム送信とサーバーバリデーション</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Axios / Inertia の <code>useForm</code> を活用して Fortune 投稿フォームを作成し、サーバーサイドのバリデーション結果を UI に反映します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>useForm()</code> でフォーム状態を管理し、送信中状態・成功／失敗トーストを表示</li>
      <li>Laravel 側で FormRequest を使ったバリデーションを実装し、エラーを Inertia が自動的に渡す仕組みを確認</li>
      <li>アクセシブルなエラーメッセージ（<code>aria-describedby</code> 等）を整備し、UI 上で即時フィードバック</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="refresh-ccw"></i> 課題 3: リアルタイム更新と状態同期</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      ブラウザの複数タブや他ユーザーの操作で変更されたデータを反映するため、Inertia の partial reload とイベント連携を実装します。
    </p>
    <ol class="exercise-card__steps">
      <li>Fortune 作成・更新後に <code>router.reload({ only: ['fortunes'] })</code> を行い、必要部分のみ再取得</li>
      <li>Laravel Echo/Broadcast を使ってリアルタイム通知を送信し、クライアント側でトースト表示</li>
      <li>状態管理ライブラリ（Pinia / Zustand など）を導入し、複数コンポーネント間で共有するデータを整理</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="box"></i> 課題 4: API クライアント層とテスト</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Axios ラッパーで共通的なリクエスト処理を抽象化し、フロントとバック双方のテストを拡充します。
    </p>
    <ol class="exercise-card__steps">
      <li>CSRF/認証ヘッダー・エラーハンドリング・再試行ロジックをまとめた API クライアントを実装</li>
      <li>Jest / Vitest などで API クライアントと Vue/React コンポーネントの単体テストを追加</li>
      <li>Laravel Feature テストで API レスポンスと Inertia ページの JSON を検証し、E2E テストで体験を再現</li>
    </ol>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ Inertia ページと共通レイアウトが整備され、グローバル共有データが活用されている</li>
    <li>✅ Axios / useForm を用いたフォーム送信が実装され、バリデーションエラー時の UI が整備されている</li>
    <li>✅ Partial Reload や Broadcast でリアルタイム更新が反映される</li>
    <li>✅ API クライアント層とフロント・バック双方のテストが揃っている</li>
  </ul>
</section>

@php
  $lesson13Hints = [
      new \Illuminate\Support\HtmlString('<p><code>Inertia::share()</code> で共有するデータは極力キャッシュし、Closure で遅延ロードするとオーバーヘッドを抑えられます。</p>'),
      new \Illuminate\Support\HtmlString('<p><code>useForm()</code> の <code>reset()</code> や <code>clearErrors()</code> を活用し、送信後の状態遷移を丁寧に制御すると UX が向上します。</p>'),
      new \Illuminate\Support\HtmlString('<p>Partial Reload は <code>only</code> だけでなく <code>preserveScroll</code> も併用すると SPA らしい挙動になります。</p>'),
  ];

  $lesson13Answer = new \Illuminate\Support\HtmlString('<p><strong>解答例:</strong> Dashboard ページを Inertia で構築し、ナビゲーション・フラッシュメッセージを <code>Inertia::share</code> で共有。フォームは <code>useForm</code> で送信中フラグやエラーメッセージを管理し、バリデーション失敗時に aria 属性でアクセシブルに表示。更新後は <code>router.reload({ only: [\'fortunes\'], preserveScroll: true })</code> で必要な部分のみ再取得。Axios ラッパーに共通エラーハンドリングを実装し、Jest と Laravel Feature テストでフロント／バック双方の動作を検証しました。</p>');
@endphp

<x-exercise.reveal id="lesson13-overview" :hints="$lesson13Hints" :answer="$lesson13Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson12') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 12 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson14') }}">
    Lesson 14 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
