<nav class="lesson-nav">
  <a class="lesson-button lesson-button--ghost" href="{{ route('lesson01') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 01
  </a>
  <div class="lesson-nav__actions">
    <a class="lesson-button" href="{{ route('exercises.lesson02') }}">
      <i data-lucide="clipboard-list"></i>
      Lesson 02 演習へ
    </a>
    <a class="lesson-button lesson-button--primary" href="{{ route('lesson03') }}">
      Lesson 03
      <i data-lucide="arrow-right"></i>
    </a>
  </div>
</nav>
