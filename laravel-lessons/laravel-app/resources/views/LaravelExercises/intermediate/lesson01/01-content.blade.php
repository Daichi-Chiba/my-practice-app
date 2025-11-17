@section('title', 'Intermediate Lesson 01 演習 - ドメイン駆動のモジュール設計')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('intermediate.lesson01') }}">Intermediate Lesson 01</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">ドメイン駆動のモジュール設計 - 実践演習</h1>
  <p class="exercise-hero__lead">
    既存システムからモジュール境界を切り出し、ユースケース／ドメインイベントを再設計します。
    チーム合意を得るための設計メモとレビュー資料を作成しながら、段階的な移行計画を組み立てましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">DDD</li>
    <li class="exercise-hero__tag">モジュール分割</li>
    <li class="exercise-hero__tag">Architecture</li>
    <li class="exercise-hero__tag">Domain Event</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="map"></i> 演習 1: コンテキストマップの現状把握</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Fortune App (模擬プロジェクト) のコードとドキュメントを調査し、責務が混ざっている領域を洗い出します。
      DDD Context Mapper 記法または C4 図レベル 3 を用いて、境界づけられたコンテキストを可視化してください。
    </p>
    <ol class="exercise-card__steps">
      <li>レポジトリの Module 構成を確認し、依存関係図を描く</li>
      <li>ビジネス用語集 (provided) と差分を確認し、ユビキタス言語を更新</li>
      <li>境界が曖昧な箇所をコメントでマークし、課題メモを PR にまとめる</li>
    </ol>
    <div class="exercise-note">
      <strong>ヒント:</strong> 依存分析には <code>composer depends</code> や静的解析ツール (phpstan-dependency) を活用すると効率的です。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="workflow"></i> 演習 2: ユースケース層の再構築</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      注文管理コンテキストを題材に、ユースケースクラスと DTO をベースディレクトリに追加します。
      コードレビューを想定し、命名規約と責務分担を README にまとめてください。
    </p>
    <ol class="exercise-card__steps">
      <li><code>Order\Application\UseCase\ApproveOrderUseCase</code> を新規作成し、依存注入を実装</li>
      <li>入力/出力 DTO を作成し、ユニットテストで contract を担保</li>
      <li>旧サービスからの呼び出しを feature flag 経由で切り替える</li>
    </ol>
    <pre><code class="language-php">$useCase = app(ApproveOrderUseCase::class);
$result = $useCase->handle(new ApproveOrderInput($orderId, $approverId));
$this->assertTrue($result->success());</code></pre>
    <div class="exercise-warning">
      <strong>注意:</strong> コントローラから直接ドメインモデルを操作しないよう警告ログを仕込み、CI で検出できるようにしてください。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="git-merge"></i> 演習 3: ドメインイベントと段階的リリース</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      発行済み注文 (InvoiceIssued) を例に、ドメインイベントを Pub/Sub で転送する仕組みを導入します。
      新旧処理の比較を行い、段階的に切り替えるためのチェックリストを作成しましょう。
    </p>
    <ol class="exercise-card__steps">
      <li>イベント発火ロジックとリスナー (Queue driver) を追加し、テストで検証</li>
      <li>Feature flag / 環境変数で新フローを有効化し、 Rollout 手順をドキュメント化</li>
      <li>Observability 設定 (log channel / metrics) を更新し、異常系を Grafana で監視できるようにする</li>
    </ol>
    <div class="exercise-note">
      <strong>ポイント:</strong> 本番切り替え前に Blue/Green デプロイや Replay テストを実施し、Rollback 手順も必ず記載しましょう。
    </div>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ コンテキストマップと依存方向図が更新され、 Pull Request に添付されている</li>
    <li>✅ 新ユースケースと DTO がテスト付きで実装され、命名規約が README に追記された</li>
    <li>✅ ドメインイベントによる副作用がメトリクス／ログで監視できる</li>
    <li>✅ Feature flag の切り替え手順と Rollback 手順がドキュメント化されている</li>
    <li>✅ レビューペアと実施した観点 (気づき) が PR コメントに整理されている</li>
  </ul>
</section>

@php
  $lesson01Hints = [
      new \Illuminate\Support\HtmlString('<p>Context Mapper で境界を仮置きしたら、コードベースの namespace と一致しているかダブルチェックしましょう。</p>'),
      new \Illuminate\Support\HtmlString('<p>ユースケースは 1 メソッドに集約し、副作用やトランザクション制御は private メソッドで隠蔽するとテストが容易になります。</p>'),
      new \Illuminate\Support\HtmlString('<p>Events の payload にローレベルなモデルを渡さないよう注意し、値オブジェクトや ID で表現しましょう。</p>'),
  ];

  $lesson01Answer = new \Illuminate\Support\HtmlString(view('LaravelExercises.intermediate.lesson01.answer')->render());
@endphp

<x-exercise.reveal id="intermediate-lesson01-overview" :hints="$lesson01Hints" :answer="$lesson01Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link" href="{{ route('intermediate.lesson01') }}">
    <i data-lucide="arrow-left"></i>
    レッスンへ戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('intermediate.lesson02') }}">
    Intermediate Lesson 02 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
