# 🗄️ SQL カリキュラム（全10レッスン）

## Lesson 01: SQL基礎とデータベース概念
**レベル**: 初級  
**学習内容**:
- データベースとは
- リレーショナルデータベースの概念
- テーブル、行、列
- 主キーと外部キー
- SQLの種類（DDL, DML, DCL）
- 基本的なSELECT文

**実務スキル**: データベースの基本理解

**コード例**:
```sql
-- データベース作成
CREATE DATABASE learning_platform;

-- テーブル作成
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- データ取得
SELECT * FROM users;
SELECT name, email FROM users WHERE id = 1;
```

---

## Lesson 02: データ操作（CRUD）
**レベル**: 初級  
**学習内容**:
- INSERT（データ挿入）
- SELECT（データ取得）
- UPDATE（データ更新）
- DELETE（データ削除）
- WHERE句による条件指定
- ORDER BY, LIMIT

**実務スキル**: 基本的なデータ操作

**コード例**:
```sql
-- 挿入
INSERT INTO users (name, email) VALUES ('田中太郎', 'tanaka@example.com');

-- 複数行挿入
INSERT INTO users (name, email) VALUES 
    ('佐藤花子', 'sato@example.com'),
    ('鈴木一郎', 'suzuki@example.com');

-- 更新
UPDATE users SET email = 'new@example.com' WHERE id = 1;

-- 削除
DELETE FROM users WHERE id = 5;

-- ソートと制限
SELECT * FROM users ORDER BY created_at DESC LIMIT 10;
```

---

## Lesson 03: データ型と制約
**レベル**: 初級〜中級  
**学習内容**:
- 数値型（INT, DECIMAL, FLOAT）
- 文字列型（VARCHAR, TEXT, CHAR）
- 日付型（DATE, DATETIME, TIMESTAMP）
- NULL と NOT NULL
- UNIQUE, DEFAULT
- CHECK制約

**実務スキル**: 適切なデータ型選択とデータ整合性

**コード例**:
```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
    stock INT DEFAULT 0,
    description TEXT,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## Lesson 04: 結合（JOIN）
**レベル**: 中級  
**学習内容**:
- INNER JOIN
- LEFT JOIN / RIGHT JOIN
- FULL OUTER JOIN
- CROSS JOIN
- 自己結合
- 複数テーブル結合

**実務スキル**: 複数テーブルからのデータ取得

**コード例**:
```sql
-- INNER JOIN
SELECT u.name, o.order_number, o.total
FROM users u
INNER JOIN orders o ON u.id = o.user_id;

-- LEFT JOIN（ユーザー全員と注文履歴）
SELECT u.name, COUNT(o.id) as order_count
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
GROUP BY u.id, u.name;

-- 3テーブル結合
SELECT u.name, o.order_number, p.name as product_name
FROM users u
INNER JOIN orders o ON u.id = o.user_id
INNER JOIN order_items oi ON o.id = oi.order_id
INNER JOIN products p ON oi.product_id = p.id;
```

---

## Lesson 05: 集約関数とグループ化
**レベル**: 中級  
**学習内容**:
- COUNT, SUM, AVG, MIN, MAX
- GROUP BY
- HAVING句
- DISTINCT
- サブクエリ基礎

**実務スキル**: データ分析とレポート作成

**コード例**:
```sql
-- 集約関数
SELECT 
    COUNT(*) as total_users,
    COUNT(DISTINCT email) as unique_emails
FROM users;

-- グループ化
SELECT 
    category,
    COUNT(*) as product_count,
    AVG(price) as avg_price,
    MAX(price) as max_price
FROM products
GROUP BY category;

-- HAVING句
SELECT category, COUNT(*) as count
FROM products
GROUP BY category
HAVING count > 5;

-- サブクエリ
SELECT name, price
FROM products
WHERE price > (SELECT AVG(price) FROM products);
```

---

## Lesson 06: 高度なクエリ技術
**レベル**: 中級〜上級  
**学習内容**:
- サブクエリ（相関サブクエリ）
- WITH句（CTE: Common Table Expression）
- UNION, INTERSECT, EXCEPT
- CASE式
- ウィンドウ関数基礎

**実務スキル**: 複雑なデータ抽出

**コード例**:
```sql
-- CTE
WITH monthly_sales AS (
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as month,
        SUM(total) as sales
    FROM orders
    GROUP BY month
)
SELECT * FROM monthly_sales WHERE sales > 100000;

-- CASE式
SELECT 
    name,
    price,
    CASE 
        WHEN price < 1000 THEN '低価格'
        WHEN price < 5000 THEN '中価格'
        ELSE '高価格'
    END as price_category
FROM products;

-- ウィンドウ関数
SELECT 
    name,
    price,
    ROW_NUMBER() OVER (ORDER BY price DESC) as rank
FROM products;
```

---

## Lesson 07: インデックスとパフォーマンス
**レベル**: 中級〜上級  
**学習内容**:
- インデックスの仕組み
- B-Treeインデックス
- 複合インデックス
- EXPLAIN による実行計画
- クエリ最適化
- N+1問題

**実務スキル**: 高速なクエリ設計

**コード例**:
```sql
-- インデックス作成
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_orders_user_date ON orders(user_id, created_at);

-- 実行計画確認
EXPLAIN SELECT * FROM users WHERE email = 'test@example.com';

-- フルテキストインデックス
CREATE FULLTEXT INDEX idx_products_name ON products(name, description);
SELECT * FROM products WHERE MATCH(name, description) AGAINST('検索語');

-- インデックスヒント
SELECT * FROM users USE INDEX (idx_users_email) WHERE email = 'test@example.com';
```

---

## Lesson 08: トランザクションと並行制御
**レベル**: 上級  
**学習内容**:
- ACID特性
- BEGIN, COMMIT, ROLLBACK
- トランザクション分離レベル
- デッドロック
- ロック機構
- 楽観的ロック vs 悲観的ロック

**実務スキル**: データ整合性の保証

**コード例**:
```sql
-- トランザクション
START TRANSACTION;

UPDATE accounts SET balance = balance - 100 WHERE id = 1;
UPDATE accounts SET balance = balance + 100 WHERE id = 2;

-- 問題なければコミット
COMMIT;

-- 問題があればロールバック
-- ROLLBACK;

-- 分離レベル設定
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;

-- 悲観的ロック
SELECT * FROM products WHERE id = 1 FOR UPDATE;
```

---

## Lesson 09: ストアドプロシージャとトリガー
**レベル**: 上級  
**学習内容**:
- ストアドプロシージャ
- ストアドファンクション
- トリガー（BEFORE, AFTER）
- イベント
- カーソル
- エラーハンドリング

**実務スキル**: ビジネスロジックのDB実装

**コード例**:
```sql
-- ストアドプロシージャ
DELIMITER //
CREATE PROCEDURE GetUserOrders(IN user_id INT)
BEGIN
    SELECT * FROM orders WHERE orders.user_id = user_id;
END //
DELIMITER ;

CALL GetUserOrders(1);

-- トリガー
DELIMITER //
CREATE TRIGGER update_product_stock
AFTER INSERT ON order_items
FOR EACH ROW
BEGIN
    UPDATE products 
    SET stock = stock - NEW.quantity 
    WHERE id = NEW.product_id;
END //
DELIMITER ;

-- ファンクション
DELIMITER //
CREATE FUNCTION calculate_tax(amount DECIMAL(10,2))
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    RETURN amount * 0.1;
END //
DELIMITER ;

SELECT price, calculate_tax(price) as tax FROM products;
```

---

## Lesson 10: データベース設計とベストプラクティス
**レベル**: 上級  
**学習内容**:
- 正規化（第1〜第3正規形）
- ER図
- データベース設計パターン
- パフォーマンスチューニング
- バックアップとリカバリ
- セキュリティベストプラクティス
- NoSQL vs RDBMS

**実務スキル**: エンタープライズレベルのDB設計

**設計例**:
```sql
-- ユーザーと進捗管理のDB設計例

-- ユーザーテーブル
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
) ENGINE=InnoDB;

-- コーステーブル
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    total_lessons INT NOT NULL DEFAULT 10,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- レッスンテーブル
CREATE TABLE lessons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    lesson_number INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_course_lesson (course_id, lesson_number)
) ENGINE=InnoDB;

-- 進捗テーブル
CREATE TABLE user_progress (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    lesson_id INT NOT NULL,
    is_completed BOOLEAN DEFAULT false,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_lesson (user_id, lesson_id),
    INDEX idx_user_completed (user_id, is_completed)
) ENGINE=InnoDB;

-- 進捗率を計算するビュー
CREATE VIEW course_progress AS
SELECT 
    u.id as user_id,
    c.id as course_id,
    c.name as course_name,
    COUNT(DISTINCT l.id) as total_lessons,
    COUNT(DISTINCT CASE WHEN up.is_completed = true THEN up.lesson_id END) as completed_lessons,
    ROUND(
        COUNT(DISTINCT CASE WHEN up.is_completed = true THEN up.lesson_id END) * 100.0 / COUNT(DISTINCT l.id),
        2
    ) as progress_percentage
FROM users u
CROSS JOIN courses c
LEFT JOIN lessons l ON c.id = l.course_id
LEFT JOIN user_progress up ON u.id = up.user_id AND l.id = up.lesson_id
GROUP BY u.id, c.id, c.name;
```

**ベストプラクティス**:
1. 適切な正規化（パフォーマンスとのバランス）
2. 外部キー制約でデータ整合性を保証
3. インデックスを適切に設定
4. トランザクションで原子性を保証
5. 定期的なバックアップ
6. SQLインジェクション対策（プリペアドステートメント）
7. 最小権限の原則

---

## 📊 学習時間
- **1レッスン**: 3〜5時間
- **全10レッスン完了**: 30〜50時間

## 🎯 学習後のスキル
- データベース設計能力
- 高速なクエリ作成
- データ分析とレポート作成
- パフォーマンスチューニング
- トランザクション管理
- セキュアなDB運用
