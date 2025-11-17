<header class="lesson__hero">
  <nav class="lesson__breadcrumb">
    <a class="lesson__breadcrumb-link" href="/">トップ</a>
    <span class="lesson__breadcrumb-separator">></span>
    <a class="lesson__breadcrumb-link" href="{{ route('home') }}">Laravel</a>
    <span class="lesson__breadcrumb-separator">></span>
    <span>Lesson 09</span>
  </nav>
  <span class="lesson__number">Lesson 09</span>
  <h1 class="lesson__title">ジョブと非同期処理の設計戦略</h1>
  <p class="lesson__subtitle">
    重たい処理や外部連携をキューへ切り離すことで、アプリの応答性を高めます。今後のマイクロサービス連携も想定しながら、
    ジョブ設計・キュー設定・監視までを一気通貫で学びましょう。
  </p>
  <div class="lesson__meta">
    <div class="lesson__meta-item"><i data-lucide="clock"></i><span>所要時間: 3 時間</span></div>
    <div class="lesson__meta-item"><i data-lucide="server"></i><span>Queue / Redis</span></div>
    <div class="lesson__meta-item"><i data-lucide="workflow"></i><span>Job Pipeline</span></div>
  </div>
  <ul class="lesson-tags">
    <li class="lesson-tags__item lesson-tags__item--primary">Queues</li>
    <li class="lesson-tags__item">Horizon</li>
    <li class="lesson-tags__item">Retry</li>
    <li class="lesson-tags__item">Batch</li>
  </ul>
</header>
