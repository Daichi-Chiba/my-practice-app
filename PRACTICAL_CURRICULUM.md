# 🎯 実務・SES出向対応カリキュラム

## 📋 研修目標
新人エンジニアがSES出向先で即戦力として活躍できるスキルを習得する

### 対象者
- プログラミング初学者〜中級者
- SESで出向予定の新人エンジニア
- 占いWebアプリの保守運用担当者

### 到達目標
✅ 実務レベルのコードが書ける  
✅ チーム開発に対応できる  
✅ 保守性の高いコードを意識できる  
✅ データベース設計ができる  
✅ 問題解決能力を身につける  
✅ 一人前のエンジニアとして独り立ちできる

---

## 🔴 Laravel実務カリキュラム（全10レッスン）

### **Lesson 01: 開発環境構築と実務の基礎**
**目的**: プロジェクトのセットアップから実務フローまで

**学習内容**:
- Docker環境でのLaravel開発
- Git/GitHubフロー（ブランチ戦略）
- プルリクエストとコードレビュー
- .envファイルと環境変数管理
- デバッグツール（Laravel Debugbar, Telescope）

**実務スキル**:
- チーム開発の基本フロー
- 環境構築の自動化
- セキュリティ意識（秘密情報の管理）

---

### **Lesson 02: ルーティングとコントローラ設計**
**目的**: RESTfulな設計とクリーンなコード

**学習内容**:
- RESTful API設計の原則
- リソースコントローラーの活用
- ルートグループとミドルウェア
- 命名規則とディレクトリ構成
- Single Responsibility Principle（単一責任の原則）

**占いアプリ例**:
```php
// 占い結果の取得
Route::get('/fortunes/{userId}', [FortuneController::class, 'show']);
Route::post('/fortunes', [FortuneController::class, 'generate']);
```

**実務スキル**:
- 保守しやすいコード構造
- チームでの命名規則統一

---

### **Lesson 03: データベース設計とEloquent ORM**
**目的**: 正規化と効率的なDB操作

**学習内容**:
- データベース正規化（第1〜第3正規形）
- ER図の作成
- マイグレーションとシーダー
- Eloquentリレーション（1:多、多:多）
- クエリビルダーの最適化

**占いアプリDB設計例**:
```sql
-- ユーザーテーブル
users (id, name, birthday, email, created_at)

-- 占い結果テーブル
fortunes (id, user_id, fortune_type, result, date, created_at)

-- 星座マスタ
zodiacs (id, name, start_date, end_date)
```

**実務スキル**:
- スケーラブルなDB設計
- データの整合性保証

---

### **Lesson 04: N+1問題とパフォーマンス最適化**
**目的**: 実務で頻出する性能問題の解決

**学習内容**:
- N+1問題の原因と対策
- Eager Loading（with, load）
- クエリの最適化テクニック
- インデックスの適切な設定
- キャッシング戦略（Redis）

**悪い例 vs 良い例**:
```php
// ❌ N+1問題発生
$fortunes = Fortune::all();
foreach ($fortunes as $fortune) {
    echo $fortune->user->name; // 毎回クエリ発行
}

// ✅ Eager Loading
$fortunes = Fortune::with('user')->get();
foreach ($fortunes as $fortune) {
    echo $fortune->user->name; // 1回のクエリ
}
```

**実務スキル**:
- パフォーマンスチューニング
- 大規模データの扱い方

---

### **Lesson 05: バリデーションとエラーハンドリング**
**目的**: 堅牢なアプリケーション開発

**学習内容**:
- FormRequest バリデーション
- カスタムバリデーションルール
- エラーメッセージの多言語対応
- 例外処理のベストプラクティス
- ログ管理（Monolog）

**占いアプリ例**:
```php
class FortuneRequest extends FormRequest
{
    public function rules()
    {
        return [
            'birthday' => 'required|date|before:today',
            'fortune_type' => 'required|in:daily,weekly,monthly',
        ];
    }
    
    public function messages()
    {
        return [
            'birthday.before' => '未来の日付は指定できません',
        ];
    }
}
```

**実務スキル**:
- ユーザー入力の安全な処理
- 予期しないエラーへの対応

---

### **Lesson 06: 認証・認可とセキュリティ**
**目的**: セキュアなアプリケーション構築

**学習内容**:
- Laravel Sanctum（API認証）
- ロールベースアクセス制御（RBAC）
- CSRF対策
- SQLインジェクション対策
- XSS対策
- セキュリティヘッダー

**実務スキル**:
- セキュリティ意識の向上
- 脆弱性への対応

---

### **Lesson 07: テスト駆動開発（TDD）**
**目的**: 品質の高いコードを書く習慣

**学習内容**:
- PHPUnit基礎
- Feature Test（機能テスト）
- Unit Test（単体テスト）
- テストカバレッジ
- モックとスタブ
- CI/CDパイプライン

**テスト例**:
```php
public function test_占い結果が正しく生成される()
{
    $user = User::factory()->create([
        'birthday' => '1990-01-01'
    ]);
    
    $response = $this->post('/api/fortunes', [
        'user_id' => $user->id,
        'fortune_type' => 'daily'
    ]);
    
    $response->assertStatus(200);
    $this->assertDatabaseHas('fortunes', [
        'user_id' => $user->id,
        'fortune_type' => 'daily'
    ]);
}
```

**実務スキル**:
- バグを未然に防ぐ
- リファクタリングの安全性確保

---

### **Lesson 08: API開発とバージョニング**
**目的**: 拡張性のあるAPI設計

**学習内容**:
- RESTful API設計原則
- APIリソース（Resource）
- ペジネーション
- レート制限
- APIバージョニング戦略
- OpenAPI（Swagger）ドキュメント

**実務スキル**:
- フロントエンドとの連携
- API仕様書の作成

---

### **Lesson 09: 非同期処理とジョブキュー**
**目的**: 大量データ処理と重い処理の最適化

**学習内容**:
- Laravel Queue（ジョブキュー）
- バックグラウンドジョブ
- メール送信の非同期化
- スケジューリング（Cron）
- 失敗ジョブの処理

**占いアプリ例**:
```php
// 毎日の占い結果を自動生成
class GenerateDailyFortunesJob implements ShouldQueue
{
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            Fortune::create([
                'user_id' => $user->id,
                'fortune_type' => 'daily',
                'result' => $this->generateFortune($user)
            ]);
        }
    }
}
```

**実務スキル**:
- 重い処理の最適化
- システムの安定性向上

---

### **Lesson 10: デプロイと運用保守**
**目的**: 本番環境での運用スキル

**学習内容**:
- 本番環境への安全なデプロイ
- ゼロダウンタイムデプロイ
- 環境変数の管理
- ログ監視とエラートラッキング（Sentry）
- データベースバックアップ
- パフォーマンス監視

**実務スキル**:
- 障害対応
- 保守運用の実践

---

## ⚛️ React実務カリキュラム（全10レッスン）

### **Lesson 01: React開発環境とモダンJS**
**目的**: 最新のフロントエンド開発環境

**学習内容**:
- ES6+の必須構文（アロー関数、分割代入、スプレッド演算子）
- npm/yarnパッケージ管理
- Vite/Create React App
- ESLint/Prettierでコード品質管理
- Chrome DevToolsデバッグ

**実務スキル**:
- モダンなツールチェーン
- コード品質の維持

---

### **Lesson 02: コンポーネント設計とProps**
**目的**: 再利用可能なコンポーネント設計

**学習内容**:
- 関数コンポーネント vs クラスコンポーネント
- Propsの受け渡し
- コンポーネント分割の原則
- Atomic Design基礎
- スタイリング（CSS Modules, styled-components）

**占いアプリ例**:
```jsx
// 占い結果カードコンポーネント
function FortuneCard({ fortune, zodiac }) {
    return (
        <div className="fortune-card">
            <h3>{zodiac.name}座の運勢</h3>
            <p className="result">{fortune.result}</p>
            <span className="date">{fortune.date}</span>
        </div>
    );
}
```

**実務スキル**:
- DRY原則（Don't Repeat Yourself）
- 保守しやすいコンポーネント

---

### **Lesson 03: State管理とuseState**
**目的**: 動的なUIの実装

**学習内容**:
- useState フック
- イベントハンドリング
- フォーム制御
- 条件付きレンダリング
- リスト表示とkey属性

**実務スキル**:
- インタラクティブなUI
- ユーザー体験の向上

---

### **Lesson 04: 副作用とuseEffect**
**目的**: API連携とライフサイクル管理

**学習内容**:
- useEffect フック
- API呼び出し（fetch, axios）
- クリーンアップ処理
- 依存配列の理解
- カスタムフックの作成

**占いアプリ例**:
```jsx
function DailyFortune() {
    const [fortune, setFortune] = useState(null);
    const [loading, setLoading] = useState(true);
    
    useEffect(() => {
        fetch('/api/fortunes/daily')
            .then(res => res.json())
            .then(data => {
                setFortune(data);
                setLoading(false);
            });
    }, []);
    
    if (loading) return <Spinner />;
    return <FortuneCard fortune={fortune} />;
}
```

**実務スキル**:
- 非同期処理の扱い
- ローディング状態の管理

---

### **Lesson 05: グローバル状態管理（Context API）**
**目的**: アプリ全体の状態管理

**学習内容**:
- Context API
- useContext フック
- useReducer フック
- 状態管理の設計パターン
- Props Drillingの回避

**実務スキル**:
- 複雑な状態管理
- スケーラブルなアーキテクチャ

---

### **Lesson 06: React Router とSPA**
**目的**: シングルページアプリケーション開発

**学習内容**:
- React Router v6
- 動的ルーティング
- ネストされたルート
- プログラマティックナビゲーション
- Protected Routes（認証ルート）

**実務スキル**:
- SPAの基本設計
- ユーザー権限制御

---

### **Lesson 07: パフォーマンス最適化**
**目的**: 高速で快適なUX

**学習内容**:
- React.memo
- useMemo, useCallback
- 仮想化（react-window）
- コード分割（lazy, Suspense）
- バンドルサイズ最適化

**実務スキル**:
- UX改善
- パフォーマンスチューニング

---

### **Lesson 08: TypeScript統合**
**目的**: 型安全なReact開発

**学習内容**:
- TypeScript基礎
- Props/State の型定義
- ジェネリクス活用
- カスタムフックの型
- 型推論の活用

**実務スキル**:
- バグの早期発見
- IDEの補完活用

---

### **Lesson 09: テストと品質保証**
**目的**: 信頼性の高いコード

**学習内容**:
- React Testing Library
- コンポーネントテスト
- インテグレーションテスト
- E2Eテスト（Playwright）
- テスト駆動開発

**実務スキル**:
- 品質保証
- リグレッション防止

---

### **Lesson 10: 本番デプロイと運用**
**目的**: プロダクション環境の構築

**学習内容**:
- ビルド最適化
- 環境変数管理
- Vercel/Netlifyデプロイ
- CI/CD構築
- エラー監視（Sentry）

**実務スキル**:
- 運用環境の構築
- 継続的デリバリー

---

## 🗄️ データベース・SQL実務カリキュラム（全10レッスン）

### **重点項目**:
1. **正規化とER図** - 設計の基礎
2. **インデックス設計** - パフォーマンス
3. **トランザクション** - データ整合性
4. **クエリ最適化** - 実行計画の読み方
5. **バックアップ・リカバリ** - 障害対応

---

## 💼 開発実務スキル（共通）

### **チーム開発**
- Git Flow / GitHub Flow
- プルリクエストレビュー
- ペアプログラミング
- モブプログラミング

### **コミュニケーション**
- 技術仕様書作成
- バグ報告の書き方
- 質問の仕方（5W1H）
- ドキュメント作成

### **問題解決**
- デバッグ手法
- ログの読み方
- エラーメッセージの解釈
- Stack Overflowの活用

### **継続的学習**
- 公式ドキュメントの読み方
- 技術記事の探し方
- OSS貢献の始め方

---

## 📈 学習ロードマップ

### **Phase 1: 基礎固め（1-2ヶ月）**
- Laravel基礎（Lesson 01-03）
- React基礎（Lesson 01-03）
- SQL基礎（Lesson 01-03）

### **Phase 2: 実践スキル（2-3ヶ月）**
- Laravel応用（Lesson 04-07）
- React応用（Lesson 04-07）
- SQL応用（Lesson 04-07）

### **Phase 3: プロジェクト開発（1-2ヶ月）**
- 占いWebアプリ構築
- 保守運用実践
- デプロイ

### **Phase 4: SES出向準備（1ヶ月）**
- コードレビュー実践
- ドキュメント作成
- 実務フロー習得

---

## 🎯 評価基準

### **技術スキル**
- ✅ 独力でCRUD機能が実装できる
- ✅ エラーを自己解決できる
- ✅ テストコードが書ける
- ✅ セキュリティ意識がある
- ✅ パフォーマンスを考慮できる

### **実務スキル**
- ✅ チーム開発に参加できる
- ✅ 仕様書が読める/書ける
- ✅ コードレビューができる
- ✅ 質問・報告が適切にできる
- ✅ スケジュール管理ができる

---

## 📝 推奨学習方法

1. **手を動かす**: コードを書く時間 > 読む時間
2. **アウトプット**: 学んだことをドキュメント化
3. **質問する**: 分からないことは早めに聞く
4. **コードレビュー**: 先輩のレビューを受ける
5. **継続する**: 毎日少しずつでも学習

---

このカリキュラムで、SES出向先で即戦力として活躍できるエンジニアを目指しましょう！
