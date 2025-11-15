@extends('layouts.lesson')

@section('title', 'Lesson 06: 認証・認可・セキュリティ基盤 - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson06.01-hero')
  @include('lessons.partials.lesson06.02-goals')
  @include('lessons.partials.lesson06.03-architecture')
  @include('lessons.partials.lesson06.04-sanctum')
  @include('lessons.partials.lesson06.05-policy')
  @include('lessons.partials.lesson06.06-security')
  @include('lessons.partials.lesson06.07-monitoring')
  @include('lessons.partials.lesson06.08-exercises')
  @include('lessons.partials.lesson06.09-navigation')
@endsection
