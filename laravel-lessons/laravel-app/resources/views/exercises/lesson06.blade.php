@extends('layouts.exercise')

@section('title', 'Lesson 06 演習 - 認証・認可・セキュリティ基盤')
@section('body-class', 'exercise--auth')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson06') }}">Lesson 06</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 06 演習: Sanctum &amp; RBAC で守る API</h1>
    <p class="exercise-hero__lead">
      フロントエンドから安全に呼び出せるトークン認証と、管理者/編集者ロールを用いた RBAC を実装します。
      ここで得た成果は Lesson 07 以降の API 開発・テストにも直結します。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">Sanctum</li>
      <li class="exercise-hero__tag">Policy</li>
      <li class="exercise-hero__tag">CSRF</li>
      <li class="exercise-hero__tag">Security Headers</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="key"></i> 課題 1: トークン発行 API</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        SPA / モバイル クライアントが利用する <code>/api/tokens</code> エンドポイントを実装します。メール・パスワードを検証し、
        指定されたデバイス名に応じてパーソナルアクセストークンを払い出します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>Auth\ApiTokenController</code> を作成し、<code>store()</code> にバリデーションとユーザー認証を実装</li>
        <li><code>User::createToken($device, ['api:fortunes'])</code> を用いてトークンを発行し JSON で返却</li>
        <li>Postman / curl で呼び出し、成功時にトークンが、失敗時に 422/401 が返ることを確認</li>
      </ol>
      <pre><code class="language-bash">curl -X POST http://localhost:8001/api/tokens \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password",
    "device_name": "iPhone"
  }'</code></pre>
      <div class="exercise-note">
        <strong>確認:</strong> <code>personal_access_tokens</code> テーブルにハッシュ化されたトークンが保存され、
        1 ユーザーにつき複数デバイスの登録が可能になっているかを確認しましょう。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="scales"></i> 課題 2: Policy と RBAC</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        Fortunes の更新・削除をロールベースで制御します。<code>editor</code> は更新のみ許可、<code>admin</code> はすべて許可する設計です。
      </p>
      <ol class="exercise-card__steps">
        <li>Role モデルと <code>role_user</code> ピボットを作成し、Seeder で <code>viewer</code>/<code>editor</code>/<code>admin</code> を登録</li>
        <li><code>FortunePolicy</code> を作成し、<code>update</code> と <code>delete</code> メソッドでロール判定を実装</li>
        <li><code>FortuneController</code> で <code>$this-&gt;authorize()</code> を呼び出し、権限がない場合に 403 を返すことを確認</li>
      </ol>
      <pre><code class="language-php">Gate::after(function ($user, $ability, $result) {
    if ($result === false) {
        Log::notice('policy.denied', [
            'user_id' => $user?->id,
            'ability' => $ability,
        ]);
    }
});</code></pre>
      <div class="exercise-warning">
        <strong>チェック:</strong> ロール切り替え後に <code>php artisan test --filter=FortunePolicyTest</code> を実行し、
        意図しない操作が許可されていないかを確認してください。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="shield"></i> 課題 3: セキュリティヘッダー &amp; Rate Limiter</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        攻撃耐性を向上させるため、共通ミドルウェアでセキュリティヘッダーを設定し、
        API には Rate Limiter を適用します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>SecureHeaders</code> ミドルウェアを実装し、X-Frame-Options や Permissions-Policy を付与</li>
        <li><code>app/Http/Kernel.php</code> の <code>web</code> グループに追加し、ブラウザでレスポンスヘッダーを確認</li>
        <li><code>RateLimiter::for('api', ...)</code> を調整し、トークン発行 API に適切な制限をかける</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> Rate Limiter は <code>config/sanctum.php</code> の <code>guard</code> 設定と合わせてチューニングしましょう。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ Sanctum トークン API が 201 / 401 / 422 を適切に返し、テーブルに履歴が残っている</li>
      <li>✅ ポリシーがロールに応じて正しく許可/拒否を判断し、ログに拒否イベントが記録される</li>
      <li>✅ セキュリティヘッダー・Rate Limiter の設定がコメント付きで明示されている</li>
      <li>✅ README / PR に動作確認のスクリーンショットとテスト結果を添付済み</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link" href="{{ route('lesson06') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 06 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson07') }}">
      Lesson 07 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
