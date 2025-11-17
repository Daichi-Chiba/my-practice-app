@section('title', 'Lesson 12 演習 - アルゴリズム的思考と Eloquent 応用')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson12') }}">Lesson 12</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 12 演習: データハンドリングの最適化</h1>
  <p class="exercise-hero__lead">
    複雑な検索・集計要件を想定し、クエリ最適化・ページネーション UX・コレクション処理を組み合わせて高速かつ扱いやすい API を実装します。
    アルゴリズム的思考を Eloquent に落とし込み、可読性とパフォーマンスの両立を目指しましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Query Builder</li>
    <li class="exercise-hero__tag">Pagination</li>
    <li class="exercise-hero__tag">Collections</li>
    <li class="exercise-hero__tag">Caching</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="filter"></i> 課題 1: 絞り込みクエリと複合インデックス</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Fortune レコードをカテゴリー・レアリティ・公開期間で絞り込み、ユーザーが使いやすい検索 API を提供します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>FortuneSearchRequest</code> でフィルタ条件をバリデーションし、DTO にまとめてコントローラへ渡す</li>
      <li>Query Builder で条件付き <code>when()</code> や <code>whereBetween()</code> を活用し、複合インデックスを追加</li>
      <li>explain / telescope を使ってクエリプランを確認し、セカンダリインデックスの有効性を README に記載</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="list"></i> 課題 2: ページネーション UX の改善</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      無限スクロールとページングの両方をサポートし、API とフロントが扱いやすいレスポンス形式を整えます。
    </p>
    <ol class="exercise-card__steps">
      <li><code>paginate()</code> と <code>cursorPaginate()</code> を併用し、クライアントがモードを選択できるようクエリパラメータを追加</li>
      <li>レスポンスに <code>meta</code> / <code>links</code> を含め、無限スクロール時も必要情報が欠けないよう整形</li>
      <li>Blade コンポーネントでページネーション UI を共通化し、アクセシブルなナビゲーションを実装</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="sparkles"></i> 課題 3: コレクションパイプラインで集計処理</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Laravel Collection の高階関数を使い、ランキングやレコメンドのロジックを可読性高く表現します。
    </p>
    <ol class="exercise-card__steps">
      <li>人気指標 (ビュー数・いいね数) からスコアを算出し、<code>map()</code> や <code>sortByDesc()</code> でランキングを作成</li>
      <li>ユーザーの嗜好データをもとに <code>groupBy()</code> → <code>map()</code> → <code>flatten()</code> でおすすめリストを生成</li>
      <li>処理結果をキャッシュし、再計算時の無駄をなくす仕組みを <code>Cache::remember</code> で実装</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="clipboard-list"></i> 課題 4: データ品質監視とメトリクス</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      データ不整合を検知するレポートを作成し、Slack へ定期通知するバッチを構築します。
    </p>
    <ol class="exercise-card__steps">
      <li>未入力・重複・論理不整合などのチェックルールを <code>DataQualityService</code> に実装</li>
      <li>日次バッチでレポートを作成し、結果を Markdown 形式で Slack に投稿</li>
      <li>Laravel Health / Horizon メトリクスに品質スコアを登録し、ダッシュボードで推移を確認</li>
    </ol>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ 高度な検索 API が実装され、EXPLAIN で効率的なクエリが確認できる</li>
    <li>✅ ページネーションの UX 改善が反映され、レスポンス整形と UI コンポーネントが整備されている</li>
    <li>✅ コレクションパイプラインで作成したランキング／おすすめがキャッシュされ、高速に提供できる</li>
    <li>✅ データ品質レポートが自動生成され、Slack 通知およびダッシュボードで監視できる</li>
  </ul>
</section>

@php
  $lesson12Hints = [
      new \Illuminate\Support\HtmlString('<p>複雑な検索条件はクエリビルダをサービス層に切り出し、テストで <code>toSql()</code> とバインド値を確認すると安全です。</p>'),
      new \Illuminate\Support\HtmlString('<p>ページネーションのレスポンスは API リソースを利用して整形すると、フロントと契約しやすくなります。</p>'),
      new \Illuminate\Support\HtmlString('<p>コレクションの集計結果をキャッシュする際には、依存データが更新されたタイミングで <code>Cache::forget</code> を呼ぶ仕組みも忘れずに。</p>'),
  ];

  $lesson12Answer = new \Illuminate\Support\HtmlString('<p><strong>解答例:</strong> <code>FortuneSearchService</code> で DTO を受け取り、動的に <code>whereBetween</code> や <code>when</code> を組み合わせたクエリを構築。ページネーションは <code>paginate</code> / <code>cursorPaginate</code> モードをクエリパラメータで切り替え、API Resource で <code>meta</code> と <code>links</code> を整形。人気ランキングは Collection の <code>map</code> / <code>sortByDesc</code> で生成し、<code>Cache::remember(&#39;fortune:ranking:v1&#39;, 300, ...)</code> でキャッシュ。日次のデータ品質レポートを Slack に送信し、Laravel Health のカスタムチェックで品質スコアを可視化しました。</p>');
@endphp

<x-exercise.reveal id="lesson12-overview" :hints="$lesson12Hints" :answer="$lesson12Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson11') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 11 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson13') }}">
    Lesson 13 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
