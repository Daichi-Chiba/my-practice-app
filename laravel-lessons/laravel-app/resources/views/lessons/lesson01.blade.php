@extends('layouts.lesson')

@section('title', 'Lesson 01: 開発環境構築と実務フロー - Laravel')
@section('body-class', 'lesson lesson--foundation')

@section('content')
  @include('lessons.partials.lesson01.01-hero')
  @include('lessons.partials.lesson01.02-precheck')
  @include('lessons.partials.lesson01.03-outcomes')
  @include('lessons.partials.lesson01.04-flow')
  @include('lessons.partials.lesson01.05-learning-goals')
  @include('lessons.partials.lesson01.06-step-01-docker')
  @include('lessons.partials.lesson01.07-step-02-git')
  @include('lessons.partials.lesson01.08-step-03-security')
  @include('lessons.partials.lesson01.09-step-04-debug')
  @include('lessons.partials.lesson01.10-exercise')
  @include('lessons.partials.lesson01.11-navigation')
@endsection
