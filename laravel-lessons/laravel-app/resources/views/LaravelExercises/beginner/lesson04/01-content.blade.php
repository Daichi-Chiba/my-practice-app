@section('title', 'Lesson 04 演習 - N+1問題とパフォーマンス最適化')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson04') }}">Lesson 04</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 04 演習: N+1 を退治して高速化する</h1>
  <p class="exercise-hero__lead">
    Debugbar や Telescope を使って潜んでいる N+1 問題を洗い出し、Eager Loading とキャッシュでレスポンスを高速化します。
    改善前後の数値を記録し、チームで共有できる改善レポートを仕上げましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Debugbar</li>
    <li class="exercise-hero__tag">Eager Loading</li>
    <li class="exercise-hero__tag">キャッシュ</li>
    <li class="exercise-hero__tag">Telescope</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="search"></i> 課題 1: N+1 の検知</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Fortune 一覧 API や管理画面に潜む N+1 問題を可視化し、発生箇所と原因を特定します。
    </p>
    <ol class="exercise-card__steps">
      <li>Debugbar のクエリタブを開き、同じ SQL が繰り返し発行されている画面を列挙</li>
      <li>Telescope の <code>Queries</code> ビューでも状況を再現し、ボトルネックを特定</li>
      <li>問題箇所にコメントを残し、改善前のスクリーンショットを保存</li>
    </ol>
    <div class="exercise-note">
      <strong>ヒント:</strong> API の場合は <code>?debugbar=1</code> を付与するか、Debugbar の HTTP タブからクエリを確認しましょう。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="zap"></i> 課題 2: Eager Loading で解消</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      見つけた N+1 に対して、Eloquent の Eager Loading / Lazy Eager Loading を適用してクエリ数を削減します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>Fortune::with(['author', 'zodiac'])</code> のように関連を指定し、追加クエリがゼロになるか確認</li>
      <li>コレクション操作で発生する N+1 には <code>load()</code> を用いて事後ロードを行う</li>
      <li>再度 Debugbar を確認し、クエリ数の変化をスクリーンショットで記録</li>
    </ol>
    <div class="exercise-warning">
      <strong>注意:</strong> 不要な関連を読み込みすぎると逆に遅くなることがあります。必要最小限の関連に絞りましょう。
    </div>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="timer"></i> 課題 3: キャッシュと計測</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      パフォーマンス改善の効果を数値で確認するため、キャッシュとレスポンスタイム計測を導入します。
    </p>
    <ol class="exercise-card__steps">
      <li><code>Cache::remember</code> で占いランキング等の重い処理をキャッシュし、TTL を設計</li>
      <li><code>Laravel\Facades\Benchmark</code> や <code>microtime(true)</code> を使って改善前後のレスポンス時間を比較</li>
      <li>計測結果を README / PR に記載し、再発防止のための TODO を追加</li>
    </ol>
    <div class="exercise-note">
      <strong>ヒント:</strong> キャッシュキーにバージョン番号を含めておくと、破壊的変更時に簡単に無効化できます。
    </div>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ 改善前後のクエリ数・レスポンス時間をスクリーンショットや表で記録している</li>
    <li>✅ Eager Loading 導入箇所にテストがあり、回帰しないようにカバーしている</li>
    <li>✅ キャッシュ戦略と TTL、無効化手順がドキュメント化されている</li>
  </ul>
</section>

@php
  $lesson04Hints = [
      new \Illuminate\Support\HtmlString('<p>改善前の状況を残すために Debugbar のスクリーンショットを撮っておくと、レビュー時に説得力が増します。</p>'),
      new \Illuminate\Support\HtmlString('<p>キャッシュ導入時は <code>Cache::remember</code> のキーにバージョン文字列を含めると破壊的変更時の無効化が楽です。</p>'),
      new \Illuminate\Support\HtmlString('<p>パフォーマンス計測は同じ端末／ネットワーク条件で複数回計測し、平均値を取るとブレが減ります。</p>'),
  ];

  $lesson04Answer = new \Illuminate\Support\HtmlString(view('exercises.partials.lesson04.answer')->render());
@endphp

<x-exercise.reveal id="lesson04-overview" :hints="$lesson04Hints" :answer="$lesson04Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson04') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 04 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson05') }}">
    Lesson 05 へ進む
    <i data-lucide="arrow-right"></i>
  </a>
</footer>
