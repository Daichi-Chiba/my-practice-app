@extends('layouts.auth-portal', ['authMode' => $authMode ?? 'login'])

@section('title', ($authMode ?? 'login') === 'register' ? '新規登録 | Bootcamp Platform' : 'ログイン | Bootcamp Platform')

@php($initialMode = $authMode ?? 'register')

@section('visual')
  <div class="auth-modern__copy">
    <section class="auth-modern__copy-panel auth-modern__copy-panel--register" aria-hidden="{{ $initialMode === 'register' ? 'false' : 'true' }}">
      <h2>はじめまして！</h2>
      <p>アカウントを作成すると、トラック横断のダッシュボードや演習ログ、進捗メトリクスがすべて解放されます。</p>
      <label class="auth-modern__copy-action" for="auth-toggle-login">
        <span>ログインフォームへ</span>
      </label>
    </section>
    <section class="auth-modern__copy-panel auth-modern__copy-panel--login" aria-hidden="{{ $initialMode === 'register' ? 'true' : 'false' }}">
      <h2>お帰りなさい！</h2>
      <p>保存しておいた進捗や演習記録にアクセスして、次のチャレンジをすぐに再開しましょう。</p>
      <label class="auth-modern__copy-action" for="auth-toggle-register">
        <span>新規登録フォームへ</span>
      </label>
    </section>
  </div>
@endsection

@section('form')
  <div class="auth-modern__form-stack" data-initial-mode="{{ $initialMode }}">
    <article class="auth-modern__form-pane auth-modern__form-pane--register" aria-hidden="{{ $initialMode === 'register' ? 'false' : 'true' }}">
      <header class="auth-modern__form-header">
        <h1>Bootcamp Platform アカウント作成</h1>
        <p>登録して進捗の可視化や演習ログ、トラック横断のリソースをすべて手に入れましょう。</p>
      </header>
      <form method="POST" action="{{ route('register') }}" class="auth-modern__form-fields">
        @csrf
        <input type="hidden" name="_auth_mode" value="register">
        <label class="auth-modern__field" for="auth-name">
          <span>お名前</span>
          <input class="auth-modern__input" id="auth-name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
          @error('name')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <label class="auth-modern__field" for="auth-register-email">
          <span>メールアドレス</span>
          <input class="auth-modern__input" id="auth-register-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
          @error('email')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <label class="auth-modern__field" for="auth-register-password">
          <span>パスワード</span>
          <input class="auth-modern__input" id="auth-register-password" type="password" name="password" required autocomplete="new-password">
          @error('password')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <label class="auth-modern__field" for="auth-register-password-confirmation">
          <span>パスワード（確認）</span>
          <input class="auth-modern__input" id="auth-register-password-confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
          @error('password_confirmation')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <button class="auth-modern__submit" type="submit">登録して始める</button>
        <p class="auth-modern__switch">
          すでにアカウントをお持ちですか？
          <label for="auth-toggle-login">ログインする</label>
        </p>
      </form>
    </article>

    <article class="auth-modern__form-pane auth-modern__form-pane--login" aria-hidden="{{ $initialMode === 'register' ? 'true' : 'false' }}">
      <header class="auth-modern__form-header">
        <h1>Bootcamp Platform にログイン</h1>
        <p>全トラック共通のダッシュボードで、あなたの学習を再開しましょう。</p>
      </header>
      <form method="POST" action="{{ route('login') }}" class="auth-modern__form-fields">
        @csrf
        <input type="hidden" name="_auth_mode" value="login">
        <label class="auth-modern__field" for="auth-email">
          <span>メールアドレス</span>
          <input class="auth-modern__input" id="auth-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
          @error('email')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <label class="auth-modern__field" for="auth-password">
          <span>パスワード</span>
          <input class="auth-modern__input" id="auth-password" type="password" name="password" required autocomplete="current-password">
          @error('password')
            <span class="auth-modern__error">{{ $message }}</span>
          @enderror
        </label>
        <div class="auth-modern__options">
          <label class="auth-modern__remember" for="remember">
            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            ログイン状態を保持
          </label>
          @if (Route::has('password.request'))
            <a class="auth-modern__link" href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
          @endif
        </div>
        <button class="auth-modern__submit" type="submit">ログイン</button>
        <p class="auth-modern__switch">
          アカウントをお持ちでない方は
          <label for="auth-toggle-register">新規登録する</label>
        </p>
      </form>
    </article>
  </div>
@endsection
