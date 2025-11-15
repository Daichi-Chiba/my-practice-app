@extends('layouts.lesson')

@section('title', 'Lesson 05: バリデーションとエラーハンドリング - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson05.01-hero')
  @include('lessons.partials.lesson05.02-goals')
  @include('lessons.partials.lesson05.03-form-request')
  @include('lessons.partials.lesson05.04-controller')
  @include('lessons.partials.lesson05.05-exception')
  @include('lessons.partials.lesson05.06-logging')
  @include('lessons.partials.lesson05.07-exercises')
  @include('lessons.partials.lesson05.08-navigation')
@endsection
