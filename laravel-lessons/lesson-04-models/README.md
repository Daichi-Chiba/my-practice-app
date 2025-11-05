# Lesson 04: モデルとデータベース

## 🎯 学習目標

- Eloquent ORM の基礎を理解する
- マイグレーションでデータベース構造を管理する
- モデルを使ったデータ操作をマスターする
- リレーションシップの実装方法を学ぶ

## 📖 概要

LaravelのEloquent ORMは、データベースとの対話を直感的なオブジェクト指向の方法で行えるようにします。SQLを直接書くことなく、PHPのメソッドでデータベース操作が可能です。

## 🗄️ マイグレーション

### マイグレーションの作成

```bash
# テーブル作成用のマイグレーション
php artisan make:migration create_posts_table

# カラム追加用のマイグレーション
php artisan make:migration add_category_to_posts_table
```

### マイグレーションファイルの例

```php
<?php
// database/migrations/2024_01_01_000000_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('author')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### マイグレーションの実行

```bash
# マイグレーション実行
php artisan migrate

# ロールバック（最後のマイグレーションを取り消し）
php artisan migrate:rollback

# 全てリセットして再実行
php artisan migrate:fresh

# シーダーも一緒に実行
php artisan migrate:fresh --seed
```

### よく使うカラムタイプ

```php
$table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
$table->string('name', 100); // VARCHAR(100)
$table->text('description'); // TEXT
$table->integer('count'); // INTEGER
$table->decimal('price', 8, 2); // DECIMAL(8,2)
$table->boolean('active'); // BOOLEAN
$table->date('birthday'); // DATE
$table->datetime('published_at'); // DATETIME
$table->timestamps(); // created_at, updated_at
$table->softDeletes(); // deleted_at（論理削除用）
```

## 🎨 モデルの作成と使用

### モデルの作成

```bash
# モデルのみ作成
php artisan make:model Post

# モデル + マイグレーション
php artisan make:model Post -m

# モデル + マイグレーション + コントローラー + リソースコントローラー
php artisan make:model Post -mcr
```

### モデルの基本

```php
<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // テーブル名（デフォルトは複数形のスネークケース: posts）
    protected $table = 'posts';
    
    // 主キー（デフォルトは id）
    protected $primaryKey = 'id';
    
    // タイムスタンプを使用するか（デフォルトは true）
    public $timestamps = true;
    
    // 一括代入可能な属性
    protected $fillable = [
        'title',
        'content',
        'author',
        'published'
    ];
    
    // 一括代入から保護する属性
    protected $guarded = ['id'];
    
    // キャスト（型変換）
    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
```

## 💻 基本的なCRUD操作

### データの作成

```php
<?php

use App\Models\Post;

// 方法1: newとsave
$post = new Post();
$post->title = 'Laravelの学習';
$post->content = 'Eloquent ORMは便利です';
$post->save();

// 方法2: create（fillableが必要）
$post = Post::create([
    'title' => 'Laravelの学習',
    'content' => 'Eloquent ORMは便利です',
    'author' => '田中太郎'
]);

// 方法3: firstOrCreate（既存データがあれば取得、なければ作成）
$post = Post::firstOrCreate(
    ['title' => 'Laravelの学習'],
    ['content' => 'Eloquent ORMは便利です']
);
```

### データの取得

```php
<?php

use App\Models\Post;

// 全件取得
$posts = Post::all();

// 最初の1件
$post = Post::first();

// IDで検索
$post = Post::find(1);
$post = Post::findOrFail(1); // 見つからなければ404エラー

// 条件付き検索
$posts = Post::where('published', true)->get();
$posts = Post::where('author', 'like', '%田中%')->get();

// 複数条件
$posts = Post::where('published', true)
            ->where('author', '田中太郎')
            ->get();

// OR条件
$posts = Post::where('author', '田中太郎')
            ->orWhere('author', '佐藤花子')
            ->get();

// 並び替え
$posts = Post::orderBy('created_at', 'desc')->get();

// 件数制限
$posts = Post::limit(10)->get();
$posts = Post::take(10)->get();

// ページネーション
$posts = Post::paginate(15); // 1ページ15件
```

### データの更新

```php
<?php

use App\Models\Post;

// 方法1: findとsave
$post = Post::find(1);
$post->title = '更新されたタイトル';
$post->save();

// 方法2: update
$post = Post::find(1);
$post->update([
    'title' => '更新されたタイトル',
    'content' => '更新された内容'
]);

// 方法3: 条件に一致する全てを更新
Post::where('published', false)
    ->update(['published' => true]);
```

### データの削除

```php
<?php

use App\Models\Post;

// 方法1: findとdelete
$post = Post::find(1);
$post->delete();

// 方法2: destroy（IDで削除）
Post::destroy(1);
Post::destroy([1, 2, 3]); // 複数削除

// 方法3: 条件に一致する全てを削除
Post::where('published', false)->delete();
```

## 🔗 リレーションシップ

### 1対多（One to Many）

```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

// app/Models/Post.php
class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// 使用例
$user = User::find(1);
$posts = $user->posts; // ユーザーの全投稿

$post = Post::find(1);
$author = $post->user; // 投稿の著者
```

### 多対多（Many to Many）

```php
<?php
// app/Models/Post.php

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

// app/Models/Tag.php
class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}

// 使用例
$post = Post::find(1);
$tags = $post->tags; // 投稿の全タグ

$tag = Tag::find(1);
$posts = $tag->posts; // タグの全投稿
```

## 📝 演習問題

### 問題1: ブログシステムのマイグレーション

以下のテーブルを作成するマイグレーションを作成してください：

**usersテーブル**
- id
- name (string)
- email (string, unique)
- password (string)
- timestamps

**postsテーブル**
- id
- user_id (foreign key)
- title (string)
- content (text)
- published_at (datetime, nullable)
- timestamps

### 問題2: モデルとリレーション

問題1で作成したテーブルのモデルを作成し、適切なリレーションを定義してください。

### 問題3: データ操作

以下の操作を行うコードを書いてください：

1. 新しい投稿を作成
2. 公開済みの投稿を全て取得
3. 特定のユーザーの投稿を全て取得
4. 投稿のタイトルを更新

## ✅ 解答例

### 問題1の解答

```bash
php artisan make:migration create_users_table
php artisan make:migration create_posts_table
```

```php
<?php
// database/migrations/xxxx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

```php
<?php
// database/migrations/xxxx_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->datetime('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### 問題2の解答

```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

```php
<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### 問題3の解答

```php
<?php

use App\Models\Post;
use App\Models\User;

// 1. 新しい投稿を作成
$post = Post::create([
    'user_id' => 1,
    'title' => 'Laravelの学習',
    'content' => 'Eloquent ORMについて学んでいます',
    'published_at' => now(),
]);

// 2. 公開済みの投稿を全て取得
$publishedPosts = Post::whereNotNull('published_at')->get();

// 3. 特定のユーザーの投稿を全て取得
$userPosts = Post::where('user_id', 1)->get();
// または
$user = User::find(1);
$userPosts = $user->posts;

// 4. 投稿のタイトルを更新
$post = Post::find(1);
$post->update(['title' => '更新されたタイトル']);
```

## 🎓 まとめ

- マイグレーションでデータベース構造を管理する方法を学びました
- Eloquent ORM を使った基本的なCRUD操作をマスターしました
- リレーションシップでテーブル間の関連を定義できました

次のレッスンでは、ビューとBladeテンプレートについて学びます。

## 📚 参考リンク

- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Relationships](https://laravel.com/docs/eloquent-relationships)
