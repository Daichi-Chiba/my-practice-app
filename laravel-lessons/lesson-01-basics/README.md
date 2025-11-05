# Lesson 01: Laravel 基礎

## 🎯 学習目標

- Laravelの基本構造を理解する
- アプリケーションのセットアップ方法を学ぶ
- ディレクトリ構造の役割を理解する
- 初めてのページを表示する

## 📖 概要

Laravelは、PHPの最も人気のあるフレームワークの一つです。エレガントな文法と豊富な機能を持ち、Webアプリケーション開発を効率化します。

## 🏗️ ディレクトリ構造

```
laravel-app/
├── app/              # アプリケーションのコアコード
│   ├── Http/         # コントローラー、ミドルウェア
│   ├── Models/       # データモデル
│   └── Providers/    # サービスプロバイダ
├── routes/           # ルート定義
│   └── web.php       # Webルート
├── resources/        # ビュー、アセット
│   └── views/        # Bladeテンプレート
├── public/           # 公開ディレクトリ
│   └── index.php     # エントリーポイント
├── storage/          # ログ、キャッシュ
└── .env              # 環境変数
```

## 💻 実践

### 1. Laravelのインストール

Dockerコンテナ内で以下を実行：

```bash
# コンテナに入る
docker-compose exec laravel bash

# Composerのインストール
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Laravelプロジェクトの作成
composer create-project laravel/laravel .
```

### 2. 基本設定

`.env` ファイルでデータベース接続を設定：

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_lessons
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

### 3. 初めてのページ

`routes/web.php` を編集：

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello, Laravel!';
});

Route::get('/about', function () {
    return view('about');
});
```

`resources/views/about.blade.php` を作成：

```html
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Laravel Lesson</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        h1 { color: #FF2D20; }
    </style>
</head>
<body>
    <h1>Laravel レッスンについて</h1>
    <p>このプロジェクトは、Laravelを段階的に学ぶための教材です。</p>
    <a href="/">ホームに戻る</a>
</body>
</html>
```

## ✅ 確認項目

- [ ] Laravelがインストールされている
- [ ] http://localhost:8000 でウェルカムページが表示される
- [ ] http://localhost:8000/hello で「Hello, Laravel!」が表示される
- [ ] http://localhost:8000/about でアバウトページが表示される

## 📝 演習問題

1. `/contact` ルートを作成し、「お問い合わせページ」を表示してください
2. ビューファイル `contact.blade.php` を作成し、簡単な連絡先フォーム（HTMLのみ）を作成してください
3. `/profile/{name}` のようなパラメータ付きルートを作成し、名前を表示してください

### 演習1の解答例

```php
// routes/web.php
Route::get('/contact', function () {
    return view('contact');
});
```

### 演習2の解答例

```html
<!-- resources/views/contact.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
</head>
<body>
    <h1>お問い合わせ</h1>
    <form>
        <input type="text" placeholder="お名前" required>
        <input type="email" placeholder="メールアドレス" required>
        <textarea placeholder="メッセージ" required></textarea>
        <button type="submit">送信</button>
    </form>
</body>
</html>
```

### 演習3の解答例

```php
// routes/web.php
Route::get('/profile/{name}', function ($name) {
    return "プロフィール: {$name}";
});
```

## 🎓 まとめ

- Laravelの基本的なディレクトリ構造を理解しました
- ルート定義とビューの基本を学びました
- 初めてのLaravelページを作成できました

次のレッスンでは、ルーティングについてより詳しく学びます。

## 📚 参考リンク

- [Laravel公式ドキュメント](https://laravel.com/docs)
- [Laravel日本語ドキュメント](https://readouble.com/laravel/)
