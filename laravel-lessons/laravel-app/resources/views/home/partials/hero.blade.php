<section class="catalog-hero" aria-labelledby="catalog-hero-title">
  <div class="catalog-hero__content">
    <p class="catalog-hero__eyebrow">Laravel Bootcamp</p>
    <h1 class="catalog-hero__title" id="catalog-hero-title">Laravel 実務レッスンカタログ</h1>
    <p class="catalog-hero__subtitle">
      SES 出向でも即戦力として活躍できるよう、環境構築から運用保守までを段階的に学べる 10 本構成。
      占い Web アプリの保守運用を題材に、実務フローを通してスキルを底上げします。
    </p>
    <div class="catalog-hero__actions">
      @if(Route::has('lesson00'))
        <a class="button button--primary" href="{{ route('lesson00') }}">
          <i data-lucide="target"></i>
          <span>Lesson 00 からはじめる</span>
        </a>
      @endif
      @if(Route::has('exercises.lesson00'))
        <a class="button" href="{{ route('exercises.lesson00') }}">
          <i data-lucide="clipboard-list"></i>
          <span>演習一覧を見る</span>
        </a>
      @endif
    </div>
  </div>
</section>
