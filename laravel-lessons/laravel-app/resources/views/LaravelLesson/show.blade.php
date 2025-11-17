@extends('layouts.lesson')

@section('title', sprintf('Lesson %s: %s - Laravel', $lessonNumber, $lesson['title'] ?? 'Laravel Lesson'))
@section('body-class', 'lesson lesson--dynamic')

@section('content')
  @foreach ($partialViews as $partial)
    @include($partial)
  @endforeach

  @if (empty($partialViews))
    <section class="lesson-section">
      <h2 class="lesson-section__title">コンテンツ準備中</h2>
      <p class="lesson-section__lead">
        Lesson {{ $lessonNumber }} のセクションは現在準備中です。しばらくお待ちください。
      </p>
    </section>
  @endif
@endsection
