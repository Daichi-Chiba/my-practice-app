<header class="site-header" data-site-nav>
  <div class="site-header__inner">
    <a class="site-brand" href="{{ route('home') }}">
      <span class="site-brand__icon" aria-hidden="true">
        <i data-lucide="sparkle"></i>
      </span>
      <span class="site-brand__label">Laravel Lessons</span>
    </a>

    <button class="site-nav__toggle" type="button" data-site-nav-toggle aria-expanded="false" aria-controls="site-global-menu">
      <span class="sr-only">メニューを開閉</span>
      <span class="site-nav__toggle-icon" aria-hidden="true">
        <i data-lucide="menu"></i>
      </span>
      <span class="site-nav__toggle-icon site-nav__toggle-icon--close" aria-hidden="true">
        <i data-lucide="x"></i>
      </span>
    </button>

    <nav class="site-nav" id="site-global-menu" aria-label="グローバルナビゲーション">
      @php
        $lessons = [
          [
            'route' => 'lesson00',
            'code' => 'Lesson 00',
            'title' => '開発環境の準備',
            'icon' => 'target'
          ],
          [
            'route' => 'lesson01',
            'code' => 'Lesson 01',
            'title' => 'Docker と Git の基礎',
            'icon' => 'layers'
          ],
          [
            'route' => 'lesson02',
            'code' => 'Lesson 02',
            'title' => 'ルーティングと設計',
            'icon' => 'git-branch'
          ],
        ];
      @endphp

      <ul class="site-nav__list">
        <li class="site-nav__item">
          <a class="site-nav__link" href="{{ route('home') }}">
            <i data-lucide="home"></i>
            <span>全体 TOP</span>
          </a>
        </li>
        <li class="site-nav__item site-nav__item--dropdown">
          <button class="site-nav__link" type="button" data-site-nav-dropdown aria-expanded="false">
            <i data-lucide="book-open"></i>
            <span>レッスン一覧</span>
            <span class="site-nav__chevron" aria-hidden="true">
              <i data-lucide="chevron-down"></i>
            </span>
          </button>
          <ul class="site-nav__dropdown" aria-label="レッスン一覧">
            @foreach($lessons as $lesson)
              @if(Route::has($lesson['route']))
                <li class="site-nav__dropdown-item">
                  <a class="site-nav__dropdown-link" href="{{ route($lesson['route']) }}">
                    <div class="site-nav__dropdown-leading">
                      <span class="site-nav__dropdown-code">{{ $lesson['code'] }}</span>
                      <span class="site-nav__dropdown-title">{{ $lesson['title'] }}</span>
                    </div>
                    <span class="site-nav__dropdown-icon" aria-hidden="true">
                      <i data-lucide="arrow-up-right"></i>
                    </span>
                  </a>
                </li>
              @endif
            @endforeach
          </ul>
        </li>
        <li class="site-nav__item">
          <a class="site-nav__link" href="{{ route('exercises.lesson00') }}">
            <i data-lucide="clipboard-list"></i>
            <span>演習一覧</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>
