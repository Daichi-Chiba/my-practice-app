@extends('layouts.auth-portal', ['authMode' => 'register'])

@section('title', '新規登録 | Bootcamp Platform')

@section('visual')
  <div class="auth-portal__visual-figure">
    <span class="auth-portal__visual-badge">
      <span class="auth-portal__badge-icon" aria-hidden="true">🌐</span>
      FULL ACCESS SIGN-UP
    </span>
    <h1 class="auth-portal__visual-title">ブートキャンプ全体をアンロックして、学びを加速。</h1>
    <p class="auth-portal__visual-copy">
      登録すると、トラック横断のダッシュボード、演習記録、進捗分析など学習体験を最大化する機能がすべて利用できます。
    </p>
    <div class="auth-portal__visual-quote">
      「1つのアカウントで最新のスキルを高速にキャッチアップできるのが最高！」 — 受講生の声
    </div>
  </div>
@endsection

@section('form')
  <header class="auth-portal__form-header">
    <span class="auth-portal__form-eyebrow">Join us</span>
    <h2 class="auth-portal__form-title">Bootcamp Platform アカウントを作成</h2>
  </header>

  <form class="auth-portal__form" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="auth-portal__field">
      <label class="auth-portal__label" for="name">お名前</label>
      <input class="auth-portal__input" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
      @error('name')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-portal__field">
      <label class="auth-portal__label" for="email">メールアドレス</label>
      <input class="auth-portal__input" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
      @error('email')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-portal__field">
      <label class="auth-portal__label" for="password">パスワード</label>
      <input class="auth-portal__input" id="password" type="password" name="password" required autocomplete="new-password">
      @error('password')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-portal__field">
      <label class="auth-portal__label" for="password_confirmation">パスワード（確認）</label>
      <input class="auth-portal__input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
      @error('password_confirmation')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-portal__form-footer">
      <button class="auth-portal__primary" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
        登録して始める
      </button>

      <div class="auth-portal__switch">
        <span>すでにアカウントをお持ちですか？</span>
        <a href="{{ route('login') }}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 5-7 7 7 7"/></svg>
          ログインページへ
        </a>
      </div>
    </div>
  </form>
@endsection
