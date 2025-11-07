@extends('layouts.lesson')

@section('title', 'Lesson 04: N+1問題とパフォーマンス最適化 - Laravel')
@section('body-class', 'lesson lesson--performance')

@section('content')
  @include('lessons.partials.lesson04.01-hero')
  @include('lessons.partials.lesson04.02-goals')
  @include('lessons.partials.lesson04.03-importance')
  @include('lessons.partials.lesson04.04-basics')
  @include('lessons.partials.lesson04.05-eager-loading')
  @include('lessons.partials.lesson04.06-detection')
  @include('lessons.partials.lesson04.07-exercises')
  @include('lessons.partials.lesson04.08-check')
  @include('lessons.partials.lesson04.09-resources')
  @include('lessons.partials.lesson04.10-navigation')
@endsection
