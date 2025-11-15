@extends('layouts.lesson')

@section('title', 'Lesson 07: テスト駆動と品質保証 - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson07.01-hero')
  @include('lessons.partials.lesson07.02-goals')
  @include('lessons.partials.lesson07.03-tdd-cycle')
  @include('lessons.partials.lesson07.04-feature-tests')
  @include('lessons.partials.lesson07.05-unit-tests')
  @include('lessons.partials.lesson07.06-mocking')
  @include('lessons.partials.lesson07.07-ci')
  @include('lessons.partials.lesson07.08-exercises')
  @include('lessons.partials.lesson07.09-navigation')
@endsection
