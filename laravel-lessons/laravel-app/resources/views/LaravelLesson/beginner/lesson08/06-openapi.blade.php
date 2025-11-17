<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="file-text"></i> OpenAPI と契約の共有</h2>
  <p class="lesson-section__lead">
    API の仕様をチーム・クライアントと共有するためには、機械可読なドキュメントが欠かせません。Laravel では OpenAPI (Swagger) を採用し、
    ドキュメント生成・Mock サーバー・テストの契約として活用します。
  </p>

  <h3 class="lesson-section__heading">1. OpenAPI スキーマの構造</h3>
  <pre><code class="language-yaml"># docs/openapi.yml
openapi: 3.1.0
info:
  title: Fortune API
  version: 2.0.0
paths:
  /api/v2/fortunes:
    get:
      summary: Fortune 一覧を取得
      parameters:
        - in: query
          name: zodiac
          schema:
            type: string
      responses:
        '200':
          description: 一覧取得成功
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/FortuneCollection'</code></pre>

  <h3 class="lesson-section__heading">2. スキーマ駆動のテスト</h3>
  <ul class="lesson-list">
    <li><code>justinrainbow/json-schema</code> などを利用し、レスポンスが OpenAPI に準拠しているかテストで検証</li>
    <li>Stoplight / Swagger UI を用いてドキュメントを自動生成し、クライアントと仕様を共有</li>
    <li>Mock サーバーを生成してフロントエンドと並行開発を進める</li>
  </ul>

  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> OpenAPI を CI に組み込み、スキーマに変更があった際は必ずレビューを挟むことで、
    仕様変更がいつ発生したのかを追跡しやすくなります。
  </div>
</section>
