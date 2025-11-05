# Lesson 02: ルーティング

## 🎯 学習目標

- Laravelのルーティング機能を理解する
- 様々なHTTPメソッドの使い方を学ぶ
- ルートパラメータの扱い方をマスターする
- 名前付きルートとルートグループを活用する

## 📖 概要

ルーティングは、URLとアプリケーションのロジックを結びつける重要な機能です。Laravelは強力で柔軟なルーティングシステムを提供しています。

## 💻 基本のルート定義

### GET リクエスト

```php
<?php
// routes/web.php

use Illuminate\Support\Facades\Route;

// シンプルなGETルート
Route::get('/', function () {
    return view('home');
});

// テキストを返す
Route::get('/hello', function () {
    return 'Hello, World!';
});

// JSONを返す
Route::get('/api/data', function () {
    return response()->json([
        'status' => 'success',
        'data' => ['id' => 1, 'name' => 'Laravel']
    ]);
});
```

### 複数のHTTPメソッド

```php
// POSTリクエスト
Route::post('/submit', function () {
    return 'データを受信しました';
});

// PUTリクエスト
Route::put('/update/{id}', function ($id) {
    return "ID {$id} を更新しました";
});

// DELETEリクエスト
Route::delete('/delete/{id}', function ($id) {
    return "ID {$id} を削除しました";
});

// 複数のメソッドに対応
Route::match(['get', 'post'], '/form', function () {
    return 'GET または POST リクエスト';
});

// 全てのメソッドに対応
Route::any('/any', function () {
    return '全てのHTTPメソッドに対応';
});
```

## 🔗 ルートパラメータ

### 必須パラメータ

```php
// 単一パラメータ
Route::get('/user/{id}', function ($id) {
    return "ユーザーID: {$id}";
});

// 複数パラメータ
Route::get('/post/{category}/{id}', function ($category, $id) {
    return "カテゴリ: {$category}, ID: {$id}";
});
```

### オプショナルパラメータ

```php
Route::get('/greeting/{name?}', function ($name = 'ゲスト') {
    return "こんにちは、{$name}さん";
});
```

### 正規表現による制約

```php
// 数字のみ
Route::get('/user/{id}', function ($id) {
    return "ユーザーID: {$id}";
})->where('id', '[0-9]+');

// アルファベットのみ
Route::get('/user/{name}', function ($name) {
    return "ユーザー名: {$name}";
})->where('name', '[A-Za-z]+');

// 複数の制約
Route::get('/post/{category}/{id}', function ($category, $id) {
    return "カテゴリ: {$category}, ID: {$id}";
})->where(['category' => '[a-z]+', 'id' => '[0-9]+']);
```

## 🏷️ 名前付きルート

```php
// ルートに名前を付ける
Route::get('/user/profile', function () {
    return view('profile');
})->name('profile');

// ビューから名前付きルートを使用
// <a href="{{ route('profile') }}">プロフィール</a>

// パラメータ付き名前付きルート
Route::get('/user/{id}/edit', function ($id) {
    return "ユーザー {$id} の編集";
})->name('user.edit');

// ビューから: <a href="{{ route('user.edit', ['id' => 1]) }}">編集</a>
```

## 📦 ルートグループ

### プレフィックス

```php
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
    
    Route::get('/users', function () {
        return 'Admin Users';
    });
});

// /admin/dashboard
// /admin/users
```

### 名前空間の共有

```php
Route::name('admin.')->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Dashboard';
    })->name('dashboard'); // admin.dashboard
    
    Route::get('/admin/settings', function () {
        return 'Settings';
    })->name('settings'); // admin.settings
});
```

## 💻 実践演習

### 演習ファイルの作成

`routes/web.php` に以下を追加：

```php
<?php

use Illuminate\Support\Facades\Route;

// ホームページ
Route::get('/', function () {
    return view('lesson02.home');
})->name('home');

// 商品一覧
Route::get('/products', function () {
    $products = [
        ['id' => 1, 'name' => 'ノートPC', 'price' => 100000],
        ['id' => 2, 'name' => 'マウス', 'price' => 3000],
        ['id' => 3, 'name' => 'キーボード', 'price' => 8000],
    ];
    return view('lesson02.products', ['products' => $products]);
})->name('products');

// 商品詳細
Route::get('/products/{id}', function ($id) {
    return view('lesson02.product-detail', ['id' => $id]);
})->where('id', '[0-9]+')->name('product.show');

// カテゴリ別商品
Route::get('/category/{category}/products', function ($category) {
    return "カテゴリ: {$category} の商品一覧";
})->where('category', '[a-z-]+');
```

## 📝 演習問題

### 問題1: ブログルート
以下の要件を満たすルートを作成してください：

1. `/blog` - ブログ記事一覧
2. `/blog/{id}` - 記事詳細（IDは数字のみ）
3. `/blog/create` - 記事作成ページ
4. `/blog/{id}/edit` - 記事編集ページ

### 問題2: APIルート
`/api/v1` プレフィックスを持つルートグループを作成し、以下のエンドポイントを定義してください：

1. `/api/v1/users` - ユーザー一覧
2. `/api/v1/users/{id}` - ユーザー詳細
3. `/api/v1/posts` - 投稿一覧

### 問題3: 名前付きルート
問題1で作成したルートに適切な名前を付けてください。

## ✅ 解答例

### 問題1の解答

```php
Route::get('/blog', function () {
    return 'ブログ記事一覧';
});

Route::get('/blog/create', function () {
    return 'ブログ記事作成';
});

Route::get('/blog/{id}', function ($id) {
    return "ブログ記事 {$id} の詳細";
})->where('id', '[0-9]+');

Route::get('/blog/{id}/edit', function ($id) {
    return "ブログ記事 {$id} の編集";
})->where('id', '[0-9]+');
```

### 問題2の解答

```php
Route::prefix('api/v1')->group(function () {
    Route::get('/users', function () {
        return response()->json(['users' => []]);
    });
    
    Route::get('/users/{id}', function ($id) {
        return response()->json(['user' => ['id' => $id]]);
    });
    
    Route::get('/posts', function () {
        return response()->json(['posts' => []]);
    });
});
```

### 問題3の解答

```php
Route::get('/blog', function () {
    return 'ブログ記事一覧';
})->name('blog.index');

Route::get('/blog/create', function () {
    return 'ブログ記事作成';
})->name('blog.create');

Route::get('/blog/{id}', function ($id) {
    return "ブログ記事 {$id} の詳細";
})->where('id', '[0-9]+')->name('blog.show');

Route::get('/blog/{id}/edit', function ($id) {
    return "ブログ記事 {$id} の編集";
})->where('id', '[0-9]+')->name('blog.edit');
```

## 🎓 まとめ

- 様々なHTTPメソッドのルート定義方法を学びました
- ルートパラメータと制約の使い方を理解しました
- 名前付きルートで保守性を向上させる方法を学びました
- ルートグループで整理されたルート定義を実現しました

次のレッスンでは、コントローラーを使ってロジックを分離する方法を学びます。

## 📚 参考リンク

- [Laravel Routing](https://laravel.com/docs/routing)
