@section('title', 'Lesson 11 演習 - Blade コンポーネントと UI 基礎')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson11') }}">Lesson 11</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 11 演習: Blade コンポーネントと UI 基礎</h1>
  <p class="exercise-hero__lead">
    Atomic Design の考え方を取り入れた Blade コンポーネント設計と、アクセシブルな UI を組み立てる実践課題です。
    実プロダクトで使える UI キットを整備し、再利用性と保守性を高めましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Blade Components</li>
    <li class="exercise-hero__tag">Atomic Design</li>
    <li class="exercise-hero__tag">Accessibility</li>
    <li class="exercise-hero__tag">Design Tokens</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="layers"></i> 課題 1: コンポーネントライブラリの整備</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Atom/Molecule レベルの Blade コンポーネントをカタログ化し、Props と Slot で柔軟に組み合わせられるようにします。
    </p>
    <ol class="exercise-card__steps">
      <li><code>resources/views/components/ui</code> 配下に Button / Badge / Tag / Card などのコンポーネントを作成</li>
      <li>Props のデフォルト値や <code>@@aware</code> を活用し、アイコン付き・サイズ違いなどの状態を切り替えられるようにする</li>
      <li>Storybook 的なプレビュー用ページ (<code>/components</code>) を作り、バリエーションのスクリーンショットを README に添付</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="layout"></i> 課題 2: Template / Layout コンポーネントの再構成</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Organism / Template レベルの UI を Blade コンポーネントとして分解し、Slots と <code>&#64;&#64;push</code> で構造と装飾を切り離します。
    </p>
    <ol class="exercise-card__steps">
      <li>サイドバー + コンテンツの 2 カラムレイアウトを <code>x-layout.two-column</code> として切り出す</li>
      <li>タブ付きカードやステップガイドなど複合 UI を Template コンポーネント化し、子コンポーネントでセクションを注入</li>
      <li>既存ページ（Lesson 06 演習など）へ反映し、コード重複が削減されたことを PR に記載</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="universal-access"></i> 課題 3: アクセシビリティとデザインシステム</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      WCAG を意識したアクセシビリティ対応と、Design Token を使ったテーマ管理を導入します。
    </p>
    <ol class="exercise-card__steps">
      <li>ARIA 属性・キーボード操作・フォーカス可視化をコンポーネントに実装し、axe DevTools で検証</li>
      <li>CSS 変数でカラー・スペーシング・タイポグラフィの Design Token を定義し、Blade コンポーネントで利用</li>
      <li>ライト / ダークテーマの切り替えデモを作成し、切替時のコントラスト比を README に記録</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="hammer"></i> 課題 4: UI テストとガバナンス</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      ビジュアルリグレッションと Lint を導入し、デザインの破壊的変更を防ぐパイプラインを構築します。
    </p>
    <ol class="exercise-card__steps">
      <li>Playwright / Cypress で UI スナップショットテストを追加し、差分が出た場合に CI で検知</li>
      <li>Tailwind / Stylelint のルールを追加し、命名規則やアクセシビリティの lint を通過するよう調整</li>
      <li>デザイン変更時のレビューガイドラインを Notion / Wiki にまとめ、PR テンプレートへリンク</li>
    </ol>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ UI コンポーネントがカタログ化され、Props / Slot で柔軟に利用できる</li>
    <li>✅ Template コンポーネントを導入し、既存ページのレイアウト重複が削減されている</li>
    <li>✅ アクセシビリティ検証と Design Token が導入され、テーマ切替が確認できる</li>
    <li>✅ UI テストおよびレビューガイドラインが整備され、CI で検証できる</li>
  </ul>
</section>

@php
  $lesson11Hints = [
      new \Illuminate\Support\HtmlString('<p>Atom コンポーネントは props を増やしすぎないように、状態は 3〜4 程度に絞ると利用側が迷いません。</p>'),
      new \Illuminate\Support\HtmlString('<p>Template コンポーネントでは slot 名を明示的に定義し、コメントで利用例を示しておくとチーム共有がスムーズです。</p>'),
      new \Illuminate\Support\HtmlString('<p>アクセシビリティ検証は axe DevTools だけでなく、スクリーンリーダー（macOS の VoiceOver 等）で実際に操作してみましょう。</p>'),
  ];

  $lesson11Answer = new \Illuminate\Support\HtmlString('<p><strong>解答例:</strong> <code>resources/views/components/ui</code> に <code>x-ui.button</code> や <code>x-ui.badge</code> を配置し、<code>variant</code> や <code>icon</code> props で状態を切り替え。Template は <code>x-layout.two-column</code> と <code>x-ui.steps</code> を作成し、Lesson 06 演習へ適用してコード量を 30% 削減。アクセシビリティは axe + VoiceOver で検証し、Design Token を <code>:root { --color-primary: ... }</code> で管理。Playwright のスナップショットテストと Stylelint を CI に組み込み、PR テンプレートへレビュー観点を追記しました。</p>');
@endphp

<x-exercise.reveal id="lesson11-overview" :hints="$lesson11Hints" :answer="$lesson11Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson10') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 10 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson12') }}">
    Lesson 12 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
