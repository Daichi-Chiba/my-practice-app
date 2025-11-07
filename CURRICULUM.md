# 📚 学習プラットフォーム - 全体カリキュラム

## 🎯 学習目標
基礎から応用まで、実務で使える技術を体系的に習得し、エンタープライズレベルの開発ができるようになる

## 📊 全コース概要
- **バックエンド**: Laravel, Rails, Java
- **フロントエンド**: React, Vue.js, Next.js
- **言語**: JavaScript/TypeScript
- **インフラ・ツール**: Docker, Git
- **総レッスン数**: 90レッスン（各コース10レッスン）

---

## 🔴 Laravel カリキュラム（全10レッスン）

### Lesson 01: Laravel 基礎とMVC
**レベル**: 初級  
**学習内容**:
- Laravelのディレクトリ構造
- MVCアーキテクチャの理解
- ルーティングの基礎
- Bladeテンプレートエンジン
- Artisanコマンド

**実務スキル**:
- プロジェクト構造の理解
- 基本的なページ作成

---

### Lesson 02: ルーティングとミドルウェア
**レベル**: 初級  
**学習内容**:
- パラメータ付きルート
- ルートグループとプレフィックス
- 名前付きルート
- ミドルウェアの作成と適用
- CORS設定

**実務スキル**:
- API エンドポイント設計
- セキュリティ設定

---

### Lesson 03: コントローラーとリクエスト処理
**レベル**: 初級〜中級  
**学習内容**:
- コントローラーの作成
- リソースコントローラー
- フォームリクエスト
- バリデーション
- レスポンスタイプ（JSON, View, Redirect）

**実務スキル**:
- RESTful API設計
- 入力検証

---

### Lesson 04: Eloquent ORM とデータベース基礎
**レベル**: 中級  
**学習内容**:
- マイグレーション
- Eloquentモデル
- クエリビルダー
- リレーション（1:1, 1:多, 多:多）
- アクセサ・ミューテタ

**実務スキル**:
- データベース設計
- 効率的なクエリ作成

---

### Lesson 05: 高度なEloquent技術
**レベル**: 中級〜上級  
**学習内容**:
- Eagerロード（N+1問題解決）
- スコープ（ローカル・グローバル）
- ポリモーフィックリレーション
- クエリ最適化
- トランザクション処理

**実務スキル**:
- パフォーマンス最適化
- 複雑なデータ関係の実装

---

### Lesson 06: 認証・認可システム
**レベル**: 中級  
**学習内容**:
- Laravel Sanctum
- JWT認証
- ロールベースアクセス制御（RBAC）
- ポリシーとゲート
- APIトークン管理

**実務スキル**:
- セキュアな認証実装
- 権限管理システム構築

---

### Lesson 07: API開発とRESTful設計
**レベル**: 中級〜上級  
**学習内容**:
- APIリソース
- ページネーション
- レート制限
- APIバージョニング
- HATEOAS
- OpenAPI/Swagger統合

**実務スキル**:
- 本格的なAPI設計
- API ドキュメント作成

---

### Lesson 08: テスト駆動開発（TDD）
**レベル**: 上級  
**学習内容**:
- PHPUnit基礎
- Feature Tests
- Unit Tests
- データベーステスト
- モックとスタブ
- テストカバレッジ

**実務スキル**:
- 品質保証
- リファクタリング技術

---

### Lesson 09: キューとジョブ、イベント
**レベル**: 上級  
**学習内容**:
- キューシステム（Redis, Database）
- ジョブの作成と実行
- イベントとリスナー
- 通知システム
- スケジューリング（Cron）
- バッチ処理

**実務スキル**:
- 非同期処理実装
- バックグラウンドタスク管理

---

### Lesson 10: デプロイとパフォーマンス最適化
**レベル**: 上級  
**学習内容**:
- Laravel Forge / Vapor
- Docker化
- キャッシュ戦略（Redis, Memcached）
- クエリ最適化
- CDN設定
- 監視とロギング
- セキュリティベストプラクティス

**実務スキル**:
- 本番環境構築
- スケーラブルなシステム設計

---

## ⚛️ React カリキュラム（全10レッスン）

### Lesson 01: React基礎とJSX
**レベル**: 初級  
**学習内容**:
- Create React App
- JSXの文法
- コンポーネントの基礎
- Props
- イベント処理

**実務スキル**:
- Reactアプリの基本構造理解

---

### Lesson 02: State とライフサイクル
**レベル**: 初級〜中級  
**学習内容**:
- useState
- useEffect
- コンポーネントライフサイクル
- 副作用の処理
- クリーンアップ

**実務スキル**:
- 動的なUI構築

---

### Lesson 03: フォームとバリデーション
**レベル**: 中級  
**学習内容**:
- 制御コンポーネント
- 非制御コンポーネント
- React Hook Form
- Yupバリデーション
- カスタムバリデーション

**実務スキル**:
- 複雑なフォーム実装

---

### Lesson 04: Context API と状態管理基礎
**レベル**: 中級  
**学習内容**:
- useContext
- useReducer
- Context + Reducer パターン
- カスタムフック
- 状態管理設計パターン

**実務スキル**:
- グローバル状態管理

---

### Lesson 05: Redux と高度な状態管理
**レベル**: 中級〜上級  
**学習内容**:
- Redux Toolkit
- Actions, Reducers, Store
- Redux Thunk
- Redux Saga
- Recoil / Zustand

**実務スキル**:
- エンタープライズレベルの状態管理

---

### Lesson 06: ルーティングとナビゲーション
**レベル**: 中級  
**学習内容**:
- React Router v6
- 動的ルーティング
- ネストルート
- プログラマティックナビゲーション
- 認証ルート

**実務スキル**:
- SPA開発

---

### Lesson 07: API連携とデータフェッチング
**レベル**: 中級〜上級  
**学習内容**:
- Axios
- React Query / SWR
- エラーハンドリング
- ローディング状態管理
- キャッシング戦略
- 楽観的更新

**実務スキル**:
- 効率的なデータ管理

---

### Lesson 08: パフォーマンス最適化
**レベル**: 上級  
**学習内容**:
- useMemo, useCallback
- React.memo
- コード分割（lazy, Suspense）
- 仮想化（React Window）
- Profiler
- メモリリーク対策

**実務スキル**:
- 高速なUIの実装

---

### Lesson 09: TypeScript統合
**レベル**: 上級  
**学習内容**:
- TypeScript基礎
- React + TypeScript
- 型定義
- Generics
- Utility Types
- 型安全な設計

**実務スキル**:
- 保守性の高いコード作成

---

### Lesson 10: テストとCI/CD
**レベル**: 上級  
**学習内容**:
- Jest
- React Testing Library
- E2Eテスト（Playwright）
- GitHub Actions
- デプロイ自動化

**実務スキル**:
- 品質保証とデプロイ

---

## ▲ Next.js カリキュラム（全10レッスン）

### Lesson 01: Next.js基礎とファイルベースルーティング
**レベル**: 中級  
**学習内容**:
- Next.jsセットアップ
- Pages Router vs App Router
- 静的ルーティング
- 動的ルーティング
- Link コンポーネント

---

### Lesson 02: データフェッチング戦略
**レベル**: 中級  
**学習内容**:
- getStaticProps (SSG)
- getServerSideProps (SSR)
- getStaticPaths
- ISR (Incremental Static Regeneration)
- Client-side Fetching

---

### Lesson 03: App Router と Server Components
**レベル**: 中級〜上級  
**学習内容**:
- Server Components
- Client Components
- Streaming
- Suspense
- Loading UI
- Error Handling

---

### Lesson 04: API Routes とバックエンド開発
**レベル**: 中級  
**学習内容**:
- API Routes作成
- RESTful API
- ミドルウェア
- データベース接続
- Prisma ORM

---

### Lesson 05: 認証とセキュリティ
**レベル**: 中級〜上級  
**学習内容**:
- NextAuth.js
- JWT
- セッション管理
- OAuth統合
- CSRF保護
- セキュリティヘッダー

---

### Lesson 06: SEO最適化
**レベル**: 中級  
**学習内容**:
- メタタグ設定
- next/head
- Metadata API
- sitemap.xml
- robots.txt
- 構造化データ（JSON-LD）
- OGP設定

---

### Lesson 07: 画像・フォント最適化
**レベル**: 中級  
**学習内容**:
- next/image
- 画像最適化
- レスポンシブ画像
- next/font
- Web Fonts最適化

---

### Lesson 08: 国際化（i18n）
**レベル**: 中級〜上級  
**学習内容**:
- next-i18next
- ロケールルーティング
- 翻訳管理
- 言語切り替え
- SEO対応

---

### Lesson 09: パフォーマンスとモニタリング
**レベル**: 上級  
**学習内容**:
- Core Web Vitals
- バンドル分析
- キャッシング戦略
- Vercel Analytics
- Sentry統合

---

### Lesson 10: デプロイと本番環境
**レベル**: 上級  
**学習内容**:
- Vercel デプロイ
- 環境変数管理
- CI/CD
- カスタムサーバー
- Docker化
- スケーリング戦略

---

## ☕ Java カリキュラム（全10レッスン）

### Lesson 01: Java基礎とOOP
**レベル**: 初級  
**学習内容**:
- Java環境構築
- 基本文法
- クラスとオブジェクト
- 継承とポリモーフィズム
- カプセル化
- インターフェース

---

### Lesson 02: コレクションとジェネリクス
**レベル**: 初級〜中級  
**学習内容**:
- List, Set, Map
- Iterator
- Comparable, Comparator
- ジェネリクス
- Stream API
- Optional

---

### Lesson 03: 例外処理とI/O
**レベル**: 中級  
**学習内容**:
- 例外の種類
- try-catch-finally
- カスタム例外
- ファイルI/O
- NIO.2
- リソース管理

---

### Lesson 04: マルチスレッドと並行処理
**レベル**: 中級〜上級  
**学習内容**:
- Thread基礎
- Runnable, Callable
- ExecutorService
- 同期化
- Concurrent Collections
- CompletableFuture

---

### Lesson 05: Spring Boot基礎
**レベル**: 中級  
**学習内容**:
- Spring Boot セットアップ
- DIコンテナ
- アノテーション
- Spring MVC
- Thymeleaf
- REST Controller

---

### Lesson 06: Spring Data JPA
**レベル**: 中級  
**学習内容**:
- JPA基礎
- Entity設計
- Repository
- JPQL
- Criteria API
- トランザクション管理

---

### Lesson 07: Spring Security
**レベル**: 中級〜上級  
**学習内容**:
- 認証と認可
- JWT
- OAuth2
- メソッドセキュリティ
- CORS設定
- セキュリティベストプラクティス

---

### Lesson 08: デザインパターン
**レベル**: 上級  
**学習内容**:
- Singleton
- Factory
- Builder
- Strategy
- Observer
- Decorator
- 実務での適用

---

### Lesson 09: テストとTDD
**レベル**: 上級  
**学習内容**:
- JUnit 5
- Mockito
- Spring Boot Test
- テストカバレッジ
- TDD実践
- 統合テスト

---

### Lesson 10: マイクロサービスとデプロイ
**レベル**: 上級  
**学習内容**:
- Spring Cloud
- サービス間通信
- API Gateway
- Docker化
- Kubernetes基礎
- CI/CD
- モニタリング

---

## 🎯 学習の進め方

1. **各レッスンの構成**
   - 理論説明（20%）
   - コード例とデモ（40%）
   - ハンズオン演習（30%）
   - 課題とクイズ（10%）

2. **推奨学習順序**
   - Laravel → React → Next.js → Java
   - または興味のあるコースから開始

3. **学習時間の目安**
   - 1レッスン: 3〜5時間
   - 1コース完了: 30〜50時間
   - 全コース完了: 120〜200時間

4. **スキルチェック**
   - 各レッスン後にクイズ
   - 中間課題（Lesson 5後）
   - 最終プロジェクト（Lesson 10）
