<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Lessons')</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
    @stack('head')
</head>
<body class="@yield('body-class', 'site')">
    @include('layouts.partials.site-nav')

    <main class="site-main" id="top">
        <div class="site-main__inner">
            @hasSection('main')
                @yield('main')
            @else
                @yield('content')
            @endif
        </div>
    </main>

    @stack('scripts')
</body>
</html>
