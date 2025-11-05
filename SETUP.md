# セットアップガイド

このドキュメントでは、Laravel と React レッスン環境のセットアップ方法を説明します。

## 📋 前提条件

以下がインストールされていることを確認してください：

- **Docker Desktop** - [ダウンロード](https://www.docker.com/products/docker-desktop)
- **Git** - バージョン管理用

## 🚀 初回セットアップ

### 1. Docker環境の起動

```bash
cd docker
docker-compose up -d
```

起動するサービス：
- Laravel (http://localhost:8000)
- React (http://localhost:3000)
- MySQL (localhost:3306)
- phpMyAdmin (http://localhost:8080)

### 2. Laravel のセットアップ

```bash
# Laravelコンテナに入る
docker-compose exec laravel bash

# Composerのインストール
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Laravelプロジェクトを作成（Lesson 01用）
cd lesson-01-basics
composer create-project laravel/laravel .

# .envファイルの設定
# 以下の内容に変更：
# DB_CONNECTION=mysql
# DB_HOST=mysql
# DB_PORT=3306
# DB_DATABASE=laravel_lessons
# DB_USERNAME=laravel
# DB_PASSWORD=laravel

# アプリケーションキーの生成
php artisan key:generate

# マイグレーション実行
php artisan migrate

# コンテナから退出
exit
```

### 3. React のセットアップ

```bash
# Reactコンテナに入る
docker-compose exec react sh

# Lesson 01のセットアップ
cd lesson-01-basics
npx create-react-app .

# 依存関係のインストール（Lesson 05でaxiosを使用）
# cd ../lesson-05-api-integration
# npm install axios

# コンテナから退出
exit
```

## 🎯 各レッスンの開始方法

### Laravel レッスン

```bash
# 1. Dockerコンテナが起動していることを確認
cd docker
docker-compose ps

# 2. ブラウザでアクセス
open http://localhost:8000
```

### React レッスン

```bash
# 1. Reactコンテナに入る
docker-compose exec react sh

# 2. 学習したいレッスンに移動
cd lesson-01-basics

# 3. 開発サーバー起動
npm start

# 4. ブラウザでアクセス
# http://localhost:3000 が自動的に開きます
```

## 🔧 トラブルシューティング

### ポートが使用中

他のアプリケーションがポートを使用している場合：

```bash
# 使用中のポートを確認
lsof -i :8000
lsof -i :3000

# プロセスを停止するか、docker-compose.ymlでポート番号を変更
```

### Dockerコンテナが起動しない

```bash
# ログを確認
docker-compose logs

# コンテナを再起動
docker-compose restart

# 完全に再構築
docker-compose down
docker-compose up -d --build
```

### Laravel: Permission denied エラー

```bash
# Laravelコンテナ内で実行
chmod -R 777 storage bootstrap/cache
```

### React: Module not found エラー

```bash
# node_modulesを削除して再インストール
rm -rf node_modules package-lock.json
npm install
```

## 📊 データベース管理

### phpMyAdminでの確認

1. http://localhost:8080 にアクセス
2. ログイン情報：
   - サーバー: `mysql`
   - ユーザー名: `root`
   - パスワード: `root`

### MySQLに直接接続

```bash
# MySQLコンテナに入る
docker-compose exec mysql mysql -u laravel -p
# パスワード: laravel

# データベース確認
SHOW DATABASES;
USE laravel_lessons;
SHOW TABLES;
```

## 🛑 環境の停止・削除

### 停止

```bash
cd docker
docker-compose stop
```

### 停止して削除

```bash
docker-compose down
```

### データベースも含めて完全削除

```bash
docker-compose down -v
```

## 💡 便利なコマンド

### Laravel

```bash
# Artisanコマンドの実行
docker-compose exec laravel php artisan <command>

# 例: マイグレーション
docker-compose exec laravel php artisan migrate

# 例: キャッシュクリア
docker-compose exec laravel php artisan cache:clear
```

### React

```bash
# npmコマンドの実行
docker-compose exec react npm <command>

# 例: パッケージインストール
docker-compose exec react npm install <package-name>

# 例: ビルド
docker-compose exec react npm run build
```

## 📚 次のステップ

1. `laravel-lessons/README.md` でLaravelレッスンを開始
2. `react-lessons/README.md` でReactレッスンを開始
3. 各レッスンフォルダの `README.md` で詳細を確認

---

何か問題が発生した場合は、`docker/README.md` も参照してください。
