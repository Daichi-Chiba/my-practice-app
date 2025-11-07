<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel レッスン')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
        }
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav h1 {
            font-size: 1.5rem;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.3s;
        }
        nav a:hover {
            background: rgba(255,255,255,0.2);
        }
        main {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }
        .content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <h1>🚀 Laravel レッスン</h1>
                <ul>
                    <li><a href="{{ route('home') }}">ホーム</a></li>
                    <li><a href="{{ route('users.index') }}">ユーザー</a></li>
                    <li><a href="{{ route('posts.index') }}">投稿</a></li>
                    <li><a href="{{ route(name: 'lesson05') }}">Blade</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="content">
                @yield('content')
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Laravel レッスンプロジェクト</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
