@extends('layouts.lesson')

@section('title', 'Lesson 02: ルーティングとコントローラ設計 - Laravel')
@section('body-class', 'lesson lesson--routing')

@section('content')
  @include('lessons.partials.lesson02.01-hero')
  @include('lessons.partials.lesson02.02-precheck')
  @include('lessons.partials.lesson02.03-outcomes')
  @include('lessons.partials.lesson02.04-step-01-restful')
  @include('lessons.partials.lesson02.05-step-02-resource')
  @include('lessons.partials.lesson02.06-step-03-groups')
  @include('lessons.partials.lesson02.07-step-04-di')
  @include('lessons.partials.lesson02.08-step-05-binding')
  @include('lessons.partials.lesson02.09-review-checklist')
  @include('lessons.partials.lesson02.10-exercise')
  @include('lessons.partials.lesson02.11-navigation')
@endsection
