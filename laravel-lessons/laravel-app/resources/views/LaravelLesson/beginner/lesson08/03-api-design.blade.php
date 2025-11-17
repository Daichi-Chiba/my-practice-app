<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="layout"></i> リソース設計とレスポンス標準化</h2>
  <p class="lesson-section__lead">
    Fortune API をクライアントから利用しやすくするために、リソースの粒度・命名・レスポンス構造を整理します。
    まずは REST の基本を押さえつつ、JSON:API と Laravel API Resource を活用した標準化手法を確認します。
  </p>

  <h3 class="lesson-section__heading">1. REST リソースの命名規則</h3>
  <ul class="lesson-list">
    <li><code>/api/fortunes</code> のように複数形で表現し、HTTP メソッドで操作（GET / POST / PATCH / DELETE）を区別</li>
    <li>親子関係は <code>/api/users/{user}/fortunes</code> のようにネストし、クエリパラメータで絞り込み</li>
    <li>アクション系エンドポイントは <code>/api/fortunes/{fortune}/favorite</code> のようにリソース指向に言い換える</li>
  </ul>

  <h3 class="lesson-section__heading">2. API Resource でのレスポンス統一</h3>
  <pre><code class="language-php">// app/Http/Resources/FortuneResource.php
class FortuneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'fortune',
            'attributes' => [
                'title' => $this->title,
                'result' => $this->result,
                'published_at' => $this->created_at,
            ],
            'relationships' => [
                'author' => new UserResource($this->whenLoaded('author')),
                'zodiac' => new ZodiacResource($this->whenLoaded('zodiac')),
            ],
        ];
    }
}</code></pre>

  <div class="lesson-callout">
    <strong>Tip:</strong> API Resource を使うことで、バージョンアップ時にレスポンス構造を一括で変更しやすくなります。コントローラでは
    <code>FortuneResource::collection()</code> を返すだけで、フロントとの契約をコードで保証できます。
  </div>
</section>
