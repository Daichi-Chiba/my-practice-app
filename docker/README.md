# Docker 環境

このディレクトリには、LaravelとReactの学習環境を構築するためのDocker設定が含まれています。

## 🐳 サービス構成

### Laravel環境
- **laravel**: PHP 8.2 + Apache
  - ポート: 8000
  - ドキュメントルート: `/laravel-lessons/public`

- **mysql**: MySQL 8.0
  - ポート: 3306
  - データベース名: `laravel_lessons`
  - ユーザー: `laravel` / パスワード: `laravel`
  - rootパスワード: `root`

- **phpmyadmin**: phpMyAdmin
  - ポート: 8080
  - URL: http://localhost:8080

### React環境
- **react**: Node.js 18
  - ポート: 3000
  - ホットリロード対応

## 🚀 使い方

### 起動
```bash
cd docker
docker-compose up -d
```

### 停止
```bash
docker-compose down
```

### ログ確認
```bash
# すべてのサービス
docker-compose logs -f

# 特定のサービス
docker-compose logs -f laravel
docker-compose logs -f react
```

### コンテナに入る
```bash
# Laravelコンテナ
docker-compose exec laravel bash

# Reactコンテナ
docker-compose exec react sh
```

## 📝 データベース接続情報

Laravel アプリケーションから MySQL に接続する際の設定：

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_lessons
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

## 🔧 トラブルシューティング

### ポートが既に使用されている
他のアプリケーションがポート8000、3000、3306、8080を使用している場合、`docker-compose.yml`でポート番号を変更してください。

### ファイルの変更が反映されない
```bash
docker-compose restart
```

### データベースをリセットしたい
```bash
docker-compose down -v
docker-compose up -d
```
