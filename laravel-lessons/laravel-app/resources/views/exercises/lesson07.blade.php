@extends('layouts.exercise')

@section('title', 'Lesson 07 演習 - テスト駆動と品質保証')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson07') }}">Lesson 07</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 07 演習: テスト駆動で品質ゲートを築く</h1>
    <p class="exercise-hero__lead">
      Fortune API の新機能を TDD で実装し、Feature / Unit テストと CI を組み合わせて安全な開発サイクルを体験します。
      バグを未然に防ぐテスト資産と、自動化された品質ゲートを完成させましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">TDD</li>
      <li class="exercise-hero__tag">PHPUnit</li>
      <li class="exercise-hero__tag">Mock</li>
      <li class="exercise-hero__tag">GitHub Actions</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="refresh-ccw"></i> 課題 1: お気に入り機能を TDD で導入</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        ユーザーがお気に入り登録できるエンドポイントを TDD で実装します。Red → Green → Refactor のサイクルを厳守してください。
      </p>
      <ol class="exercise-card__steps">
        <li>Feature テストで API の振る舞い (201 応答・DB 反映) を定義し、テストを実行して失敗を確認</li>
        <li>最小限の実装でテストを通し、サービスクラスやリレーションをリファクタリングして読みやすさを確保</li>
        <li>お気に入りを解除する API も追加し、E2E でトグルが機能することを確認</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> <code>actingAs()</code> や <code>assertDatabaseHas()</code> を活用し、失敗時のエラーメッセージを読みやすくしておくとデバッグが容易になります。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="component"></i> 課題 2: ドメインロジックを Unit テストで守る</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        占いポイント計算や通知フローなどビジネスロジックを別サービスとして切り出し、Unit テストで高速に検証します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>FortunePointCalculator</code> の振る舞いをテストで定義し、入力パターンごとの期待値を確認</li>
        <li>Mock や Fake を利用して通知機構を差し替え、副作用なしでテストが通るようにする</li>
        <li>Failure ケース (例: 無効なレアリティ) を追加し、例外が投げられることを断言</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="workflow"></i> 課題 3: CI ワークフローの整備</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        GitHub Actions で PHPUnit を自動実行し、失敗時に通知されるパイプラインを構築します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>.github/workflows/tests.yml</code> を作成し、依存インストール・マイグレーション・テストのステップを定義</li>
        <li>カバレッジレポートを生成して Codecov などへ送信し、品質指標を可視化</li>
        <li>Slack や Teams へ通知する Webhook を追加し、CI 失敗時にチーム全員が気付けるようにする</li>
      </ol>
      <div class="exercise-warning">
        <strong>注意:</strong> CI 上では <code>php artisan config:clear</code> や <code>php artisan key:generate</code> を忘れずに実行し、本番相当の状態でテストを走らせましょう。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ Feature / Unit テストがすべて通り、失敗時はメッセージから原因が判断できる</li>
      <li>✅ Mock / Fake を活用し、外部依存に引きずられないテスト設計になっている</li>
      <li>✅ GitHub Actions (または同等の CI) が main / PR で実行され、カバレッジ結果が確認できる</li>
      <li>✅ README / PR にテストコマンド、CI URL、カバレッジのスクリーンショットを添付済み</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson07') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 07 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson08') }}">
      Lesson 08 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
