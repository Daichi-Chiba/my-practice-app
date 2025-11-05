# Lesson 05: ビューとBlade

## 🎯 学習目標

- Bladeテンプレートエンジンの使い方を理解する
- レイアウト継承でコードを再利用する
- Bladeディレクティブを活用する
- コンポーネントの作成と使用方法を学ぶ

## 📖 概要

Bladeは、Laravelの強力なテンプレートエンジンです。PHPコードを簡潔に書け、レイアウトの継承やコンポーネントの再利用が容易です。

## 💻 Bladeの基本

### ビューの作成

```bash
# resources/views/ 配下にファイルを作成
# 例: resources/views/welcome.blade.php
```

### データの表示

```blade
{{-- resources/views/greeting.blade.php --}}
<h1>{{ $title }}</h1>
<p>{{ $message }}</p>

{{-- エスケープなし（XSS注意） --}}
{!! $htmlContent !!}

{{-- デフォルト値 --}}
{{ $name ?? 'ゲスト' }}
```

コントローラーからデータを渡す：

```php
<?php
return view('greeting', [
    'title' => 'ようこそ',
    'message' => 'Laravelへようこそ！'
]);
```

## 🎨 レイアウト継承

### 親レイアウト

```blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header>
        <h1>My Laravel App</h1>
        <nav>
            <a href="/">ホーム</a>
            <a href="/about">About</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Laravel App</p>
    </footer>

    @stack('scripts')
</body>
</html>
```

### 子ビュー

```blade
{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <h2>ホームページ</h2>
    <p>ようこそ、Laravelアプリケーションへ！</p>
@endsection

@push('scripts')
    <script src="/js/home.js"></script>
@endpush
```

## 🔧 Bladeディレクティブ

### 条件分岐

```blade
@if($score >= 80)
    <p>優秀です</p>
@elseif($score >= 60)
    <p>合格です</p>
@else
    <p>不合格です</p>
@endif

@isset($name)
    <p>名前: {{ $name }}</p>
@endisset

@empty($users)
    <p>ユーザーがいません</p>
@endempty

@auth
    <p>ログイン中</p>
@endauth

@guest
    <p>ログインしてください</p>
@endguest
```

### ループ

```blade
@foreach($posts as $post)
    <article>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
    </article>
@endforeach

@forelse($posts as $post)
    <div>{{ $post->title }}</div>
@empty
    <p>投稿がありません</p>
@endforelse

@for($i = 0; $i < 10; $i++)
    <p>{{ $i }}</p>
@endfor

@while($condition)
    {{-- 処理 --}}
@endwhile
```

### ループ変数

```blade
@foreach($posts as $post)
    <div>
        ループ回数: {{ $loop->iteration }}
        インデックス: {{ $loop->index }}
        残り: {{ $loop->remaining }}
        
        @if($loop->first)
            最初の要素
        @endif
        
        @if($loop->last)
            最後の要素
        @endif
    </div>
@endforeach
```

## 📦 コンポーネント

### Bladeコンポーネントの作成

```bash
php artisan make:component Alert
```

```blade
{{-- resources/views/components/alert.blade.php --}}
<div class="alert alert-{{ $type }}">
    <strong>{{ $title }}</strong>
    <p>{{ $slot }}</p>
</div>
```

```php
<?php
// app/View/Components/Alert.php
namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $title;

    public function __construct($type = 'info', $title = '通知')
    {
        $this->type = $type;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.alert');
    }
}
```

### コンポーネントの使用

```blade
<x-alert type="success" title="成功">
    データが保存されました！
</x-alert>

<x-alert type="danger" title="エラー">
    エラーが発生しました。
</x-alert>
```

## 📝 演習問題

### 問題1: ブログレイアウト

ブログ用のレイアウトを作成してください：
- ヘッダー（サイト名、ナビゲーション）
- メインコンテンツエリア
- サイドバー（最新記事一覧）
- フッター

### 問題2: 記事一覧ページ

問題1のレイアウトを継承して、記事一覧ページを作成してください。

### 問題3: アラートコンポーネント

成功、警告、エラーの3種類を表示できるアラートコンポーネントを作成してください。

## 🎓 まとめ

- Bladeテンプレートの基本的な使い方を学びました
- レイアウト継承でコードの再利用ができました
- 条件分岐とループで動的なページを作成できました
- コンポーネントで部品を再利用できました

これで Laravel の基礎レッスンは完了です！

## 📚 参考リンク

- [Laravel Blade Templates](https://laravel.com/docs/blade)
