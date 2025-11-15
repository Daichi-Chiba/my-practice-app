@extends('layouts.lesson')

@section('title', 'Lesson 08: API設計とバージョニング - Laravel')
@section('body-class', 'lesson lesson--validation')

@section('content')
  @include('lessons.partials.lesson08.01-hero')
  @include('lessons.partials.lesson08.02-goals')
  @include('lessons.partials.lesson08.03-api-design')
  @include('lessons.partials.lesson08.04-versioning')
  @include('lessons.partials.lesson08.05-rate-limit')
  @include('lessons.partials.lesson08.06-openapi')
  @include('lessons.partials.lesson08.07-governance')
  @include('lessons.partials.lesson08.08-exercises')
  @include('lessons.partials.lesson08.09-navigation')
@endsection
