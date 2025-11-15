@extends('layouts.exercise')

@section('title', 'Lesson 08 演習 - API設計とバージョニング')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson08') }}">Lesson 08</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 08 演習: Fortune API を安定運用する</h1>
    <p class="exercise-hero__lead">
      Fortune API を公開サービスとして提供する前提で、レスポンス標準化・バージョニング・レート制限・ドキュメント整備を一通り実装します。
      長期運用に耐えられる API 契約を完成させましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">API Resource</li>
      <li class="exercise-hero__tag">Versioning</li>
      <li class="exercise-hero__tag">Rate Limit</li>
      <li class="exercise-hero__tag">OpenAPI</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="layout"></i> 課題 1: レスポンス標準化</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        API Resource を導入してレスポンスを JSON:API 風に整形し、クライアントと契約を結びます。
      </p>
      <ol class="exercise-card__steps">
        <li><code>FortuneResource</code> / <code>FortuneCollection</code> を定義し、attributes・relationships を整理</li>
        <li>v2 コントローラで Resource を返却するよう変更し、Feature テストで JSON 構造を検証</li>
        <li>変更点を README に追記し、フロントが参照できるサンプルレスポンスを提示</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="git-branch"></i> 課題 2: バージョニングと互換性</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        v1 と v2 を並行稼働させながら、互換性を壊さずに機能追加できる仕組みを構築します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>/api/v1</code> と <code>/api/v2</code> のルートグループを作成し、コントローラ・Resource を分離</li>
        <li>破壊的変更になる箇所は v2 にのみ追加し、v1 には互換レイヤを設ける</li>
        <li>移行計画を README に明記し、クライアントへ告知する文章を用意</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="shield"></i> 課題 3: Rate Limit とセキュリティ</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        レート制限とヘッダーを整え、公開 API としての安全性を確保します。
      </p>
      <ol class="exercise-card__steps">
        <li>RateLimiter を拡張し、トークン種別ごとにリクエスト数を切り替え</li>
        <li>429 応答の JSON を整え、<code>Retry-After</code> ヘッダーを返す</li>
        <li>セキュリティヘッダー (CORS, Permissions-Policy 等) を再確認して README にまとめる</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="file-text"></i> 課題 4: OpenAPI ドキュメントの整備</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        OpenAPI スキーマを作成し、CI でスキーマ更新をチェックできる体制を整えます。
      </p>
      <ol class="exercise-card__steps">
        <li><code>docs/openapi.yml</code> を作成し、主要エンドポイントのリクエスト・レスポンスを定義</li>
        <li>Swagger UI / Stoplight でドキュメントを生成し、共有 URL を README に添付</li>
        <li>CI でスキーマチェックを行い、更新時にプレビューを生成する</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> OpenAPI の更新を Pull Request テンプレートで必須項目にすると、仕様変更漏れを減らせます。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ v1 / v2 の API が並行稼働し、Feature テストが双方で通る</li>
      <li>✅ Rate Limit・セキュリティヘッダーが整備され、429 応答が UX に配慮されている</li>
      <li>✅ OpenAPI ドキュメントが最新化され、CI で検証されている</li>
      <li>✅ README / PR に移行計画とサンプルレスポンスが記載されている</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson08') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 08 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson09') }}">
      Lesson 09 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
