@extends('layouts.exercise')

@section('title', $pageTitle ?? sprintf('Lesson %s 演習', $lessonNumber))
@section('body-class', $bodyClass ?? 'exercise--dynamic')

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      if (typeof hljs !== 'undefined') {
        hljs.highlightAll();
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
    });
  </script>
@endpush

@section('content')
  @foreach ($partialViews as $partial)
    @include($partial)
  @endforeach

  @if (empty($partialViews))
    <section class="exercise-card">
      <h2 class="exercise-card__title"><i data-lucide="wrench"></i> コンテンツ準備中</h2>
      <div class="exercise-card__content">
        <p class="exercise-card__description">
          Lesson {{ $lessonNumber }} の演習は現在準備中です。しばらくお待ちください。
        </p>
      </div>
    </section>
  @endif
@endsection
