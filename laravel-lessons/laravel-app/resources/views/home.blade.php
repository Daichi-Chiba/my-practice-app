@extends('layouts.site')

@section('title', 'Laravel Lessons Catalog')
@section('body-class', 'site site--home')

@section('main')
  <div class="catalog">
    @include('home.partials.hero')
    @include('home.partials.stats')
    @include('home.partials.lessons')
    @include('home.partials.roadmap')
    @include('home.partials.lesson-detail')
    @include('home.partials.exercises')
    @include('home.partials.quick-links')
    @include('home.partials.notes')
  </div>
@endsection
