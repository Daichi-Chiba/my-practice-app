@extends('layouts.lesson')

@section('title', 'Lesson 10: デプロイと運用保守 - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson10.01-hero')
  @include('lessons.partials.lesson10.02-goals')
  @include('lessons.partials.lesson10.03-deploy-strategy')
  @include('lessons.partials.lesson10.04-observability')
  @include('lessons.partials.lesson10.05-release-management')
  @include('lessons.partials.lesson10.06-incident-response')
  @include('lessons.partials.lesson10.07-backup-dr')
  @include('lessons.partials.lesson10.08-exercises')
  @include('lessons.partials.lesson10.09-navigation')
@endsection
