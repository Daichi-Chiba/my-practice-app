@extends('layouts.auth-portal', ['authMode' => 'login'])

@section('title', 'ログイン | Bootcamp Platform')

@section('visual')
  <div class="auth-portal__visual-content">
    <span class="auth-portal__visual-badge">
      <span class="auth-portal__badge-icon" aria-hidden="true">⚡</span>
      CROSS-SKILL ACCESS
    </span>
    <h1 class="auth-portal__visual-title">すべてのトラックと演習をひとつのアカウントで。</h1>
    <p class="auth-portal__visual-copy">
      ログインすると、学習進捗やブックマーク、演習履歴が全トラックで同期されます。マルチデバイス対応でいつでも再開可能です。
    </p>
    <ul class="auth-portal__visual-points">
      <li class="auth-portal__visual-point">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        全トラックの進捗を横断表示
      </li>
      <li class="auth-portal__visual-point">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20v-8"/><path d="M18 20v-5"/><path d="M6 20v-3"/><path d="M2 11l10-9 10 9"/></svg>
        レッスンと演習をワンストップで管理
      </li>
      <li class="auth-portal__visual-point">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><path d="M21 12a9 9 0 1 1-9-9"/></svg>
        進捗メトリクスとチェックイン
      </li>
    </ul>
  </div>
@endsection

@section('form')
  <header class="auth-portal__form-header">
    <span class="auth-portal__form-eyebrow">Sign in</span>
    <h2 class="auth-portal__form-title">Bootcamp Platform にログイン</h2>
    @if (session('status'))
      <p class="auth-portal__session">{{ session('status') }}</p>
    @endif
  </header>

  <form class="auth-portal__form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="auth-portal__field">
      <label class="auth-portal__label" for="email">メールアドレス</label>
      <input class="auth-portal__input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
      @error('email')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-portal__field">
      <label class="auth-portal__label" for="password">パスワード</label>
      <input class="auth-portal__input" id="password" type="password" name="password" required autocomplete="current-password">
      @error('password')
        <p class="auth-portal__error">{{ $message }}</p>
      @enderror
    </div>

    <label class="auth-portal__remember" for="remember">
      <input class="auth-portal__checkbox" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
      ログイン状態を保持する
    </label>

    <div class="auth-portal__form-footer">
      <div class="auth-portal__actions">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
        @endif
        <button class="auth-portal__primary" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/></svg>
          ログイン
        </button>
      </div>

      <div class="auth-portal__switch">
        <span>アカウントをお持ちでない方</span>
        <a href="{{ route('register') }}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          新規登録ページへ
        </a>
      </div>
    </div>
  </form>
@endsection
