# 🎓 プログラミング学習プラットフォーム

実務で使える技術を基礎から応用まで体系的に学習できる、総合プログラミング学習プラットフォームです。
Docker環境で4つの主要技術（Laravel, React, Next.js, Java）を学習できます。

## 🌟 特徴

- **4つの主要技術**: Laravel, React, Next.js, Java
- **各10レッスン**: 基礎から応用まで段階的に学習
- **実務レベルの内容**: 業務で即使えるスキルを習得
- **Docker環境**: 環境構築不要で即座に学習開始
- **豊富なコード例**: 各トピックに詳細な解説とコード
- **練習問題**: 理解度を確認できる演習問題付き

## 📁 プロジェクト構成

```
my-practice-app/
├── index.html           # 全体TOPページ
├── CURRICULUM.md        # 詳細カリキュラム
├── laravel-lessons/     # Laravel学習（全10レッスン）
│   └── laravel-app/     # Laravelプロジェクト
├── react-lessons/       # React学習（全10レッスン）
│   └── react-app/       # Reactプロジェクト
├── nextjs-lessons/      # Next.js学習（全10レッスン）
│   └── nextjs-app/      # Next.jsプロジェクト
├── java-lessons/        # Java学習（全10レッスン）
│   └── java-app/        # Spring Bootプロジェクト
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

### 3. 各レッスンサイトにアクセス
```
🎯 全体TOPページ:    file:///Users/apple/Projects/my-practice-app/index.html
📊 進捗ダッシュボード: file:///Users/apple/Projects/my-practice-app/dashboard.html

学習サイト:
Laravel:  http://localhost:8001
React:    http://localhost:3001
Next.js:  http://localhost:3002
Java:     http://localhost:8082
Rails:    http://localhost:3003
Vue.js:   http://localhost:3004

管理ツール:
phpMyAdmin: http://localhost:8080
PostgreSQL: localhost:5432
```

### 4. 進捗管理機能
- **ログイン**: dashboard.htmlでユーザー名を入力してログイン
- **進捗保存**: LocalStorageに自動保存
- **円グラフ**: 各コースの進捗を視覚的に表示
- **統計情報**: 全体の学習状況を確認

## 📖 学習コース（各10レッスン）

### 🔴 Laravel - PHPの最強フレームワーク
1. **Laravel基礎とMVC** - ディレクトリ構造、基本概念
2. **ルーティングとミドルウェア** - 高度なルーティング、セキュリティ
3. **コントローラーとリクエスト** - バリデーション、レスポンス
4. **Eloquent ORM基礎** - モデル、リレーション、クエリ
5. **高度なEloquent** - N+1問題、スコープ、最適化
6. **認証・認可** - Sanctum、JWT、RBAC
7. **API開発** - RESTful API、リソース、バージョニング
8. **テスト駆動開発** - PHPUnit、Feature/Unit Tests
9. **キューとジョブ** - 非同期処理、イベント、スケジューリング
10. **デプロイと最適化** - 本番環境、キャッシュ、パフォーマンス

### ⚛️ React - モダンUIライブラリ
1. **React基礎とJSX** - コンポーネント、Props、イベント
2. **StateとライフサイクL** - useState、useEffect、副作用
3. **フォームとバリデーション** - React Hook Form、Yup
4. **Context APIと状態管理** - useContext、useReducer
5. **Reduxと高度な状態管理** - Redux Toolkit、Thunk、Saga
6. **ルーティング** - React Router v6、認証ルート
7. **API連携** - React Query、SWR、キャッシング
8. **パフォーマンス最適化** - useMemo、React.memo、コード分割
9. **TypeScript統合** - 型安全な設計、Generics
10. **テストとCI/CD** - Jest、React Testing Library、Playwright

### ▲ Next.js - Reactフルスタックフレームワーク
1. **基礎とルーティング** - Pages Router、App Router
2. **データフェッチング** - SSG、SSR、ISR
3. **Server Components** - RSC、Streaming、Suspense
4. **API Routes** - RESTful API、Prisma ORM
5. **認証とセキュリティ** - NextAuth.js、JWT、OAuth
6. **SEO最適化** - メタタグ、構造化データ、OGP
7. **画像・フォント最適化** - next/image、next/font
8. **国際化（i18n）** - 多言語対応、ロケールルーティング
9. **パフォーマンス** - Core Web Vitals、バンドル分析
10. **デプロイ** - Vercel、環境変数、CI/CD

### ☕ Java - エンタープライズ開発の基盤
1. **Java基礎とOOP** - クラス、継承、ポリモーフィズム
2. **コレクションとジェネリクス** - List、Set、Map、Stream API
3. **例外処理とI/O** - try-catch、ファイル操作、NIO
4. **マルチスレッド** - Thread、ExecutorService、並行処理
5. **Spring Boot基礎** - DIコンテナ、MVC、REST Controller
6. **Spring Data JPA** - Entity、Repository、JPQL
7. **Spring Security** - 認証、認可、JWT、OAuth2
8. **デザインパターン** - Singleton、Factory、Strategy など
9. **テストとTDD** - JUnit 5、Mockito、統合テスト
10. **マイクロサービス** - Spring Cloud、Docker、Kubernetes

詳細は `CURRICULUM.md` を参照してください。

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
