<section class="lesson-section lesson-section--db-design">
  <h2 class="lesson-section__title"><i data-lucide="table"></i> DB設計（占いアプリ）</h2>
  <p class="lesson-section__lead">
    Lesson 全体で扱う「占い結果」ドメインを題材に、テーブル分割とリレーションの全体像を整理します。
  </p>
  <pre><code class="language-sql">-- users: ユーザー基本情報
-- zodiacs: 星座マスタ
-- fortunes: 占い結果

-- 主なリレーション
-- users 1 - N fortunes
-- zodiacs 1 - N users
</code></pre>
  <div class="lesson-callout">
    <strong>ポイント:</strong> マスタデータは専用テーブルに分離し、冗長な文字列を繰り返し保存しないよう正規化を徹底します。
  </div>
</section>
