# Laravel レッスン

Laravelフレームワークを段階的に学ぶためのレッスン集です。

## 📚 レッスン一覧

### [Lesson 01: 基礎](./lesson-01-basics/)
- Laravelの基本構造
- インストールとセットアップ
- アプリケーションの起動
- ディレクトリ構造の理解

### [Lesson 02: ルーティング](./lesson-02-routing/)
- ルート定義の基本
- パラメータ付きルート
- 名前付きルート
- ルートグループ

### [Lesson 03: コントローラー](./lesson-03-controllers/)
- コントローラーの作成
- リソースコントローラー
- ミドルウェア
- リクエストとレスポンス

### [Lesson 04: モデルとデータベース](./lesson-04-models/)
- Eloquent ORM の基礎
- マイグレーション
- モデルの作成と操作
- リレーションシップ

### [Lesson 05: ビューとBlade](./lesson-05-views/)
- Bladeテンプレートエンジン
- レイアウト継承
- コンポーネント
- データの表示

## 🎯 学習の進め方

1. 各レッスンフォルダの `README.md` を読む
2. サンプルコードを実行して動作を確認
3. 演習問題に取り組む
4. 理解できたら次のレッスンへ

## 🛠 レッスン追加・並び替え手順

### 1. ルーティングの登録
- `laravel-app/routes/web.php` に `Route::view('/lessonXX', 'lessons.lessonXX_modern')` 形式で追記し、`name('lessonXX')` を必ず定義します。
- 演習ページがある場合は `Route::prefix('exercises')` ブロック内にも `lessonXX` を追加してください。

### 2. Blade レイアウト構成
1. `resources/views/lessons/lessonXX_modern.blade.php` を作成し、`@extends('layouts.lesson')` で共通レイアウトを継承します。
2. コンテンツは `resources/views/lessons/partials/lessonXX/` 以下に BEM クラスで分割し、`@include` や `@each` で読み込みます。
3. ナビゲーションに表示するタイトルや前後リンクは `partials/.../navigation.blade.php` 内で管理します。

### 3. スタイルとカラーテーマ
- レッスン固有のテーマカラーは `resources/css/lessons.css` に `.lesson--identifier` のブロックとして追加します。例: `.lesson--routing`。
- `lessonXX_modern.blade.php` の `@section('body-class', 'lesson lesson--identifier')` と合わせて指定してください。

### 4. トップページとグローバルナビの更新
- グローバルヘッダー：`resources/views/layouts/partials/site-nav.blade.php` の `$lessons` 配列にコード・タイトルを追加します。
- レッスンカード：`resources/views/home/partials/lessons.blade.php` の `$lessonCards` 配列にカード情報を追加し、希望の表示順に並べ替えます。

### 5. JavaScript エントリ (必要な場合)
- レッスン固有の JS が必要な場合は `resources/js/lessons/lessonXX.ts` を作成し、`resources/js/lessons/index.ts` の `lessonInitializers` に登録します。

### 6. 並び替え時の注意
- ルーティング (`web.php`)・ナビ (`site-nav.blade.php`)・トップページカード (`home/partials/lessons.blade.php`) の順番を揃えてください。
- 既存のレッスン番号や `Lesson 0X` の表記は命名規則に合わせて更新します。

### 7. ビルドとウォッチ
- 開発中はプロジェクト直下の `docker/` ディレクトリで `npm run watch` を実行すると Vite のビルドが常時監視されます。
- 単発ビルドは `npm run dev`、本番ビルドは `npm --prefix ../laravel-lessons/laravel-app run build` を利用してください。

## 💡 Tips

- 公式ドキュメント: https://laravel.com/docs
- エラーが出たらログを確認: `storage/logs/laravel.log`
- Artisanコマンドを活用: `php artisan list`
