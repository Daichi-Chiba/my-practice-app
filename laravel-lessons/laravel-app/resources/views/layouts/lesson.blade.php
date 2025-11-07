<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Lesson')</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
    @stack('head')
</head>
<body class="@yield('body-class', 'lesson')">
    @include('layouts.partials.site-nav')

    <main class="lesson-main" id="top">
        <div class="lesson__container">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
