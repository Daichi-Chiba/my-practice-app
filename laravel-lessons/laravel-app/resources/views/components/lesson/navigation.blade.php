@props([
    'back' => null,
    'exercise' => null,
    'next' => null,
])

@if ($back || $exercise || $next)
<nav class="lesson-nav">
  @if ($back)
    <a class="lesson-button lesson-button--ghost" href="{{ route($back['route']) }}">
      <i data-lucide="{{ $back['icon'] ?? 'arrow-left' }}"></i>
      {{ $back['label'] ?? '戻る' }}
    </a>
  @endif

  <div class="lesson-nav__actions">
    @if ($exercise)
      <a class="lesson-button" href="{{ route($exercise['route']) }}">
        <i data-lucide="{{ $exercise['icon'] ?? 'clipboard-list' }}"></i>
        {{ $exercise['label'] ?? '演習へ' }}
      </a>
    @endif

    @if ($next)
      <a class="lesson-button lesson-button--primary" href="{{ route($next['route']) }}">
        {{ $next['label'] ?? '次へ' }}
        <i data-lucide="{{ $next['icon'] ?? 'arrow-right' }}"></i>
      </a>
    @endif
  </div>
</nav>
@endif
