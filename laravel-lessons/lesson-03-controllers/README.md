# Lesson 03: コントローラー

## 🎯 学習目標

- コントローラーの役割を理解する
- コントローラーの作成と使用方法を学ぶ
- リソースコントローラーを活用する
- リクエストとレスポンスの扱い方をマスターする

## 📖 概要

コントローラーは、ルートとビジネスロジックの仲介役です。ルートファイルに直接ロジックを書く代わりに、コントローラーにまとめることで、コードの整理と再利用が容易になります。

## 💻 コントローラーの基本

### コントローラーの作成

Artisanコマンドを使用してコントローラーを作成：

```bash
# 基本的なコントローラー
php artisan make:controller UserController

# リソースコントローラー（CRUD操作のメソッドが自動生成）
php artisan make:controller PostController --resource
```

### 基本的なコントローラー

```php
<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 一覧表示
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => '田中太郎'],
            ['id' => 2, 'name' => '佐藤花子'],
            ['id' => 3, 'name' => '鈴木一郎'],
        ];
        
        return view('users.index', ['users' => $users]);
    }
    
    // 詳細表示
    public function show($id)
    {
        return view('users.show', ['id' => $id]);
    }
    
    // 作成フォーム
    public function create()
    {
        return view('users.create');
    }
    
    // データ保存
    public function store(Request $request)
    {
        // バリデーションとデータ保存の処理
        return redirect()->route('users.index')
            ->with('success', 'ユーザーを作成しました');
    }
}
```

### ルートとコントローラーの紐付け

```php
<?php
// routes/web.php

use App\Http\Controllers\UserController;

// 個別のメソッド指定
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
```

## 🎨 リソースコントローラー

### リソースコントローラーとは

CRUD操作に必要な7つのメソッドを持つコントローラー：

| メソッド | URI | アクション | ルート名 |
|---------|-----|----------|---------|
| GET | /posts | index | posts.index |
| GET | /posts/create | create | posts.create |
| POST | /posts | store | posts.store |
| GET | /posts/{id} | show | posts.show |
| GET | /posts/{id}/edit | edit | posts.edit |
| PUT/PATCH | /posts/{id} | update | posts.update |
| DELETE | /posts/{id} | destroy | posts.destroy |

### リソースコントローラーの作成

```bash
php artisan make:controller PostController --resource
```

```php
<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // 全投稿の表示
        return view('posts.index');
    }

    public function create()
    {
        // 作成フォームの表示
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // 新規投稿の保存
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        // 特定の投稿の表示
        return view('posts.show', ['id' => $id]);
    }

    public function edit($id)
    {
        // 編集フォームの表示
        return view('posts.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // 投稿の更新
        return redirect()->route('posts.show', $id);
    }

    public function destroy($id)
    {
        // 投稿の削除
        return redirect()->route('posts.index');
    }
}
```

### リソースルートの定義

```php
<?php
// routes/web.php

use App\Http\Controllers\PostController;

// 1行で全てのCRUDルートを定義
Route::resource('posts', PostController::class);

// 一部のアクションのみ使用
Route::resource('posts', PostController::class)->only([
    'index', 'show'
]);

// 特定のアクションを除外
Route::resource('posts', PostController::class)->except([
    'destroy'
]);
```

## 📥 リクエストの扱い

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // 全リクエストデータを取得
        $all = $request->all();
        
        // 特定の値を取得
        $name = $request->input('name');
        $email = $request->input('email', 'default@example.com'); // デフォルト値付き
        
        // クエリパラメータ
        $search = $request->query('search');
        
        // リクエストメソッドの確認
        if ($request->isMethod('post')) {
            // POSTリクエストの処理
        }
        
        // ファイルの取得
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photos');
        }
        
        return response()->json(['message' => 'Success']);
    }
}
```

## 📤 レスポンスの種類

```php
<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{
    // ビューを返す
    public function viewResponse()
    {
        return view('welcome');
    }
    
    // 文字列を返す
    public function stringResponse()
    {
        return 'Hello, World!';
    }
    
    // JSONを返す
    public function jsonResponse()
    {
        return response()->json([
            'status' => 'success',
            'data' => ['id' => 1, 'name' => 'Laravel']
        ]);
    }
    
    // リダイレクト
    public function redirectResponse()
    {
        return redirect('/home');
        // または
        return redirect()->route('home');
    }
    
    // ダウンロード
    public function downloadResponse()
    {
        return response()->download('/path/to/file.pdf');
    }
    
    // カスタムレスポンス
    public function customResponse()
    {
        return response('Custom Response', 200)
            ->header('Content-Type', 'text/plain');
    }
}
```

## 📝 演習問題

### 問題1: 商品コントローラーの作成

`ProductController` を作成し、以下のメソッドを実装してください：

1. `index()` - 商品一覧を表示
2. `show($id)` - 商品詳細を表示
3. `search(Request $request)` - 商品検索（クエリパラメータ `q` を使用）

### 問題2: リソースコントローラー

`ArticleController` をリソースコントローラーとして作成し、routes/web.php で定義してください。

### 問題3: フォーム処理

お問い合わせフォームのコントローラー `ContactController` を作成し、以下を実装してください：

1. `show()` - フォーム表示
2. `submit(Request $request)` - フォーム送信処理（名前、メール、メッセージを受け取る）

## ✅ 解答例

### 問題1の解答

```bash
php artisan make:controller ProductController
```

```php
<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'ノートPC', 'price' => 100000],
            ['id' => 2, 'name' => 'マウス', 'price' => 3000],
            ['id' => 3, 'name' => 'キーボード', 'price' => 8000],
        ];
        
        return view('products.index', compact('products'));
    }
    
    public function show($id)
    {
        return view('products.show', ['id' => $id]);
    }
    
    public function search(Request $request)
    {
        $query = $request->query('q');
        return view('products.search', ['query' => $query]);
    }
}
```

```php
// routes/web.php
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
```

### 問題2の解答

```bash
php artisan make:controller ArticleController --resource
```

```php
// routes/web.php
use App\Http\Controllers\ArticleController;

Route::resource('articles', ArticleController::class);
```

### 問題3の解答

```bash
php artisan make:controller ContactController
```

```php
<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.form');
    }
    
    public function submit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        
        // 実際はここでメール送信などの処理を行う
        
        return redirect()->route('contact.show')
            ->with('success', 'お問い合わせを受け付けました');
    }
}
```

```php
// routes/web.php
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
```

## 🎓 まとめ

- コントローラーでロジックを整理する方法を学びました
- リソースコントローラーでCRUD操作を簡単に実装できます
- リクエストとレスポンスの様々な扱い方を理解しました

次のレッスンでは、モデルとデータベース操作について学びます。

## 📚 参考リンク

- [Laravel Controllers](https://laravel.com/docs/controllers)
- [Laravel Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
