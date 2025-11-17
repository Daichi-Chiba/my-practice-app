<section class="lesson-section lesson-section--rest">
  <h2 class="lesson-section__title"><i data-lucide="book-open"></i> Step 1: RESTful ルーティングの整理</h2>
  <p>Fortune API の一覧・作成・詳細を想定し、HTTP メソッドと命名をセットで整理します。実際のコードは <code>routes/web.php</code> の <em>// Lessons</em> セクションにまとめてあります。</p>
  <table class="lesson-table">
    <thead>
      <tr>
        <th>操作</th>
        <th>HTTP メソッド</th>
        <th>URL</th>
        <th>コントローラ</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>一覧表示</td>
        <td>GET</td>
        <td>/fortunes</td>
        <td>FortuneController@index</td>
      </tr>
      <tr>
        <td>作成</td>
        <td>POST</td>
        <td>/fortunes</td>
        <td>FortuneController@store</td>
      </tr>
      <tr>
        <td>詳細表示</td>
        <td>GET</td>
        <td>/fortunes/{fortune}</td>
        <td>FortuneController@show</td>
      </tr>
    </tbody>
  </table>
  <div class="lesson-callout">
    <strong>命名規約:</strong> ルート名は複数形 + 動詞（<code>fortunes.index</code> 等）に統一。パラメータは単数形（<code>{fortune}</code>）。
  </div>
</section>
