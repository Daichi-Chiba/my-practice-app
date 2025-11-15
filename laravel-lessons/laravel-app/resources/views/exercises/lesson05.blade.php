@extends('layouts.exercise')

@section('title', 'Lesson 05 演習 - バリデーションとエラーハンドリング')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson05') }}">Lesson 05</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 05 演習: FormRequest と例外ハンドリングを徹底</h1>
    <p class="exercise-hero__lead">
      Fortune API で入力バリデーション・エラー応答・ログ出力を整備し、安定した API を提供できる状態を目指します。
      例外発生時にユーザーへ返すメッセージと、開発者向けのログ・監視を同時に設計しましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">FormRequest</li>
      <li class="exercise-hero__tag">Validation</li>
      <li class="exercise-hero__tag">Exception Handler</li>
      <li class="exercise-hero__tag">Logging</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="check-circle"></i> 課題 1: FormRequest の導入</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        Fortune 作成 API に FormRequest を適用し、入力チェックをすべて専用クラスへ移譲します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>php artisan make:request StoreFortuneRequest</code> を作成し、必須項目・許容値・日付制約を定義</li>
        <li>カスタムメッセージを日本語で整備し、422 応答時に返却されることを確認</li>
        <li>Feature テストで不正値送信時に 422 / バリデーションメッセージが返ることを検証</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="alert-octagon"></i> 課題 2: 例外ハンドラーの整備</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        API と Web で共通化されたエラーレスポンスを返せるよう、<code>app/Exceptions/Handler.php</code> を拡張します。
      </p>
      <ol class="exercise-card__steps">
        <li>バリデーション例外を JSON で返す <code>renderable()</code> を追加し、レスポンスフォーマットを統一</li>
        <li>予期せぬ例外の際にステータス 500 / 一般メッセージを返しつつ、ログへ詳細を記録</li>
        <li>Feature テストで 500 発生時に JSON レスポンスが適切なキー (<code>error</code>, <code>message</code>) を含むことを確認</li>
      </ol>
      <div class="exercise-warning">
        <strong>注意:</strong> ログへはスタックトレースを含めますが、レスポンスには機密情報を含めないようにしましょう。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="file-output"></i> 課題 3: ログレベルと通知の設計</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        エラーログをもとにアラートを飛ばせるよう、ログチャネルと通知を設計します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>logging.php</code> に Slack 通知チャネルを追加し、重大な例外時のみ通知されるようレベルを設定</li>
        <li><code>Log::info / warning / error</code> の使い分けガイドラインを README に記載</li>
        <li>演習用に疑似例外を発生させ、ログに記録される内容と通知結果をスクリーンショットで残す</li>
      </ol>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ FormRequest が適用され、422 応答が JSON で返りテストが通る</li>
      <li>✅ Handler による例外レスポンスが統一され、500 時のログが残っている</li>
      <li>✅ ログチャネル・通知ルールが README / PR に説明されている</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson05') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 05 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson06') }}">
      Lesson 06 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
