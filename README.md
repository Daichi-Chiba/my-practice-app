# Laravel & React レッスンプロジェクト

このプロジェクトは、LaravelとReactを段階的に学習するための教材です。
各レッスンは独立しており、順番に進めることで基礎から応用まで学べます。

## 📚 プロジェクト構成

```
my-practice-app/
├── laravel-lessons/     # Laravel学習用ディレクトリ
│   ├── lesson-01-basics/
│   ├── lesson-02-routing/
│   ├── lesson-03-controllers/
│   ├── lesson-04-models/
│   └── lesson-05-views/
├── react-lessons/       # React学習用ディレクトリ
│   ├── lesson-01-basics/
│   ├── lesson-02-components/
│   ├── lesson-03-hooks/
│   ├── lesson-04-state-management/
│   └── lesson-05-api-integration/
├── docker/              # Docker設定ファイル
│   ├── docker-compose.yml
│   ├── laravel/
│   └── react/
└── README.md
```

## 🚀 セットアップ

### 必要な環境
- Docker Desktop
- Git

### 起動方法

1. プロジェクトをクローン（または既にダウンロード済み）

2. Docker環境を起動
```bash
cd docker
docker-compose up -d
```

3. Laravelレッスンにアクセス
```
http://localhost:8000
```

4. Reactレッスンにアクセス
```
http://localhost:3000
```

## 📖 学習の進め方

### Laravelレッスン
1. **Lesson 01: 基礎** - Laravel の基本構造とセットアップ
2. **Lesson 02: ルーティング** - ルート定義とパラメータ処理
3. **Lesson 03: コントローラー** - コントローラーの作成と使用
4. **Lesson 04: モデル** - Eloquent ORM とデータベース操作
5. **Lesson 05: ビュー** - Blade テンプレートエンジン

各レッスンフォルダ内の `README.md` を参照してください。

### Reactレッスン
1. **Lesson 01: 基礎** - React の基本とJSX
2. **Lesson 02: コンポーネント** - 関数コンポーネントとProps
3. **Lesson 03: フック** - useState, useEffect などの基本フック
4. **Lesson 04: 状態管理** - Context API と状態管理パターン
5. **Lesson 05: API連携** - fetch と axios を使ったAPI通信

各レッスンフォルダ内の `README.md` を参照してください。

## 🎯 各レッスンの構成

各レッスンには以下が含まれます：
- **README.md**: レッスンの説明と学習目標
- **コード例**: 実装済みのサンプルコード
- **演習問題**: 理解度を確認するための課題
- **解答例**: 演習問題の解答

## 💡 Tips

- 各レッスンは独立しているので、気になるトピックから始めても OK
- わからないことがあれば、公式ドキュメントも参照してください
  - [Laravel公式ドキュメント](https://laravel.com/docs)
  - [React公式ドキュメント](https://react.dev)

## 📝 進捗管理

学習の進捗は各自で管理してください。レッスンごとにチェックリストを作成するのもおすすめです。

---

Happy Learning! 🎉
