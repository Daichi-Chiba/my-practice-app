@extends('layouts.lesson')

@section('title', 'Lesson 03: モデル・DB設計・Eloquent基礎 - Laravel')
@section('body-class', 'lesson lesson--models')

@section('content')
  @include('lessons.partials.lesson03.01-hero')
  @include('lessons.partials.lesson03.02-goals')
  @include('lessons.partials.lesson03.03-db-design')
  @include('lessons.partials.lesson03.04-migrations')
  @include('lessons.partials.lesson03.05-eloquent')
  @include('lessons.partials.lesson03.06-seeder')
  @include('lessons.partials.lesson03.07-exercise')
  @include('lessons.partials.lesson03.08-navigation')
@endsection
