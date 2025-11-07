<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Lessons Exercises')</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
    @stack('head')
</head>
<body class="exercise @yield('body-class')">
    @include('layouts.partials.site-nav')

    <main class="exercise-main" id="top">
        <div class="exercise-main__inner">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
