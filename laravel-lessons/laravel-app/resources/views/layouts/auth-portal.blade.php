@php($authMode = $authMode ?? 'login')
@php($isRegister = $authMode === 'register')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth Portal - Bootcamp Platform')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/js/app.js')
</head>
<body class="auth-modern-body{{ $isRegister ? ' auth-mode-register' : '' }}">
    <input class="auth-modern__toggle-input" type="radio" name="auth_portal_mode" id="auth-toggle-login" {{ $isRegister ? '' : 'checked' }}>
    <input class="auth-modern__toggle-input" type="radio" name="auth_portal_mode" id="auth-toggle-register" {{ $isRegister ? 'checked' : '' }}>

    <div class="auth-modern{{ $isRegister ? ' is-register' : '' }}">
        <div class="auth-modern__header">
            <a class="auth-modern__brand" href="{{ route('global-top') }}">
                <span class="auth-modern__brand-badge" aria-hidden="true">LP</span>
                <span class="auth-modern__brand-meta">
                    <span class="auth-modern__brand-eyebrow">Learning Platform</span>
                    <span class="auth-modern__brand-title">Bootcamp Platform</span>
                </span>
            </a>

            <a class="auth-modern__backlink" href="{{ route('global-top') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/><path d="M9 12h12"/></svg>
                トップへ戻る
            </a>
        </div>

        <div class="auth-modern__frame" data-initial-mode="{{ $authMode }}">
            <div class="auth-modern__forms">
                @yield('form')
            </div>
            <div class="auth-modern__overlay">
                @yield('visual')
            </div>
        </div>
    </div>
</body>
</html>
