@php
  $quickLinks = [
    [
      'route' => 'hello',
      'icon' => 'sparkle',
      'label' => 'Hello Route'
    ],
    [
      'route' => 'admin.dashboard',
      'icon' => 'layout-dashboard',
      'label' => 'Admin Dashboard'
    ],
    [
      'route' => 'posts.create',
      'icon' => 'square-pen',
      'label' => 'New Post'
    ],
    [
      'route' => 'users.index',
      'icon' => 'users',
      'label' => 'User List'
    ],
  ];
@endphp

<section class="catalog-quick" aria-labelledby="catalog-quick-title">
  <div class="catalog-section-header">
    <h2 class="catalog-section-title" id="catalog-quick-title">Quick Access</h2>
    <p class="catalog-section-subtitle">よく使うルートや管理画面へすぐアクセスできます。</p>
  </div>
  <div class="catalog-quick__grid">
    @foreach($quickLinks as $link)
      @if(Route::has($link['route']))
        <a class="catalog-quick__item" href="{{ route($link['route']) }}">
          <span class="catalog-quick__icon" aria-hidden="true">
            <i data-lucide="{{ $link['icon'] }}"></i>
          </span>
          <span class="catalog-quick__label">{{ $link['label'] }}</span>
        </a>
      @endif
    @endforeach
  </div>
</section>
