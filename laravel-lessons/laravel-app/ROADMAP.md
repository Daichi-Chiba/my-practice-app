# Laravel Bootcamp Roadmap

本ブートキャンプでは、占いWebアプリの保守運用を題材に、Lesson 01 〜 10 を通してひとつのプロダクトを仕上げます。各レッスンで構築する機能は Git ブランチで管理し、最終的に本番運用を想定した環境まで作り込みます。

## 🎯 目標プロダクト
- **アプリ名**: Fortune Flow
- **概要**: ユーザー登録 / 星座マスタ / 占い結果生成 / 管理画面 / API 提供
- **提供機能**:
  1. ユーザー登録・ログイン
  2. 星座ごとのマスタ管理
  3. 毎日の占い結果をバッチ生成
  4. REST API 公開（モバイル向け）
  5. 管理者向けダッシュボード

## 🧭 レッスン構成と到達点
| Lesson | ブランチ名 | 主な成果物 | 演習ページ |
|--------|------------|------------|------------|
| 01 | `feature/01-foundation` | Docker + Laravel セットアップ、GitHub Flow 運用 | `/exercises/lesson01` |
| 02 | `feature/02-routing` | RESTful ルーティング／Controller 設計 | `/exercises/lesson02` |
| 03 | `feature/03-models` | DB 設計・マイグレーション・シーディング | `/exercises/lesson03` |
| 04 | `feature/04-performance` | N+1 可視化と最適化、Telescope 導入 | `/exercises/lesson04` |
| 05 | `feature/05-validation` | FormRequest／例外ハンドリング／ログ整備 | `/exercises/lesson05` |
| 06 | `feature/06-auth-security` | Sanctum 認証／RBAC／セキュリティヘッダー | `/exercises/lesson06` |
| 07 | `feature/07-testing` | PHPUnit／Feature Test／CI 連携 | `/exercises/lesson07` |
| 08 | `feature/08-api` | API リソース／バージョニング／OpenAPI | `/exercises/lesson08` |
| 09 | `feature/09-jobs` | Queue／スケジューラ／リトライ戦略 | `/exercises/lesson09` |
| 10 | `feature/10-deploy` | ゼロダウンタイムデプロイ／監視／バックアップ | `/exercises/lesson10` |

> 各レッスン完了後は演習ページで詳細な実装解説・サンプルコード・提出課題を確認し、ブランチを切り替えながら進めます。

## 🛤️ 開発フロー
1. Lesson 指定のブランチをチェックアウト
2. Lesson ページの手順に沿って実装
3. 演習ページで課題を完了
4. プルリクエストを作成しレビュー
5. main へマージ後、次の Lesson ブランチへ

## 📁 ルーティングポリシー
- Laravel レッスンに関する画面は `/routes/web.php` の `// Lessons` セクションへまとめる
- 演習ページは `Route::prefix('exercises')` グループ配下に定義
- API や管理画面など用途ごとにコメントブロックで整理
- 将来的に演習ルートが増える場合は `routes/exercises.php` 切り出しを検討

## 📝 提出物チェックリスト
- `README.md`: 変更点・セットアップ手順
- `docs/` : API定義・テスト手順・インフラ構成
- GitHub PR: スクリーンショットやテスト結果を添付
- Lesson 10 完了時に最終レビュー会を想定

---
このロードマップに沿って学習を進めることで、Laravel 実務に必要な設計・実装・運用スキルを段階的かつ体系的に習得できます。
