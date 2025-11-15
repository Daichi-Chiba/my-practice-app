@extends('layouts.exercise')

@section('title', 'Lesson 04 演習 - N+1問題とパフォーマンス最適化')

@section('content')
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
      パフォーマンス改善の効果測定まで行い、数値で “速くなった” を証明しましょう。
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
        Fortune 一覧 API / 管理画面に潜む N+1 問題を Debugbar で可視化し、問題箇所を洗い出します。
      </p>
      <ol class="exercise-card__steps">
        <li>Debugbar のクエリタブを確認し、同じ SQL が繰り返し発行されているエンドポイントを特定</li>
        <li>Telescope の <code>Queries</code> ビューでも同様の状況が再現できるか確認</li>
        <li>問題となるコントローラ／ビューの箇所にコメントを残し、改善前のスクリーンショットを保存</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> API の場合は <code>?debugbar=1</code> を付与するか、Debugbar の HTTP タブからクエリを確認できます。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="zap"></i> 課題 2: Eager Loading で解消</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        見つけた N+1 に対し、Eloquent の Eager Loading / Lazy Eager Loading を適用してクエリ数を削減します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>Fortune::with(['author', 'zodiac'])</code> のように関連を指定し、追加クエリがゼロになるかを確認</li>
        <li>コレクション操作で N+1 が発生する箇所には <code>load()</code> を利用し、二度目以降のアクセスも高速化</li>
        <li>再度 Debugbar を確認し、クエリ数の変化をスクリーンショットで記録</li>
      </ol>
      <div class="exercise-warning">
        <strong>注意:</strong> Eager Loading を増やしすぎると逆に遅くなるケースがあります。必要な関連だけを読み込むようにしましょう。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="timer"></i> 課題 3: キャッシュと計測</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        パフォーマンス改善の効果を数値で確認するため、キャッシュやタイミング計測を導入します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>Cache::remember</code> で占いランキング等の重い処理をキャッシュし、TTL を適切に設定</li>
        <li><code>Laravel\Facades\Benchmark</code> や <code>microtime(true)</code> を用いて改善前後のレスポンス時間を計測</li>
        <li>計測結果を README / PR に記載し、再発防止のための TODO を追加</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> キャッシュキーにバージョン文字列を含めておくと、破壊的変更時にキャッシュを簡単に無効化できます。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ 改善前後のスクリーンショットを PR/README に添付し、クエリ数・レスポンス時間の差分が確認できる</li>
      <li>✅ Eager Loading の導入がテストでカバーされ、回帰防止ができている</li>
      <li>✅ キャッシュ戦略と TTL、無効化手順が README に記載されている</li>
    </ul>
  </section>

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
@endsection
