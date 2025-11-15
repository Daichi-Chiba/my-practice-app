@extends('layouts.lesson')

@section('title', 'Lesson 09: ジョブと非同期処理 - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson09.01-hero')
  @include('lessons.partials.lesson09.02-goals')
  @include('lessons.partials.lesson09.03-architecture')
  @include('lessons.partials.lesson09.04-queue-setup')
  @include('lessons.partials.lesson09.05-job-design')
  @include('lessons.partials.lesson09.06-horizon')
  @include('lessons.partials.lesson09.07-scheduling')
  @include('lessons.partials.lesson09.08-exercises')
  @include('lessons.partials.lesson09.09-navigation')
@endsection
