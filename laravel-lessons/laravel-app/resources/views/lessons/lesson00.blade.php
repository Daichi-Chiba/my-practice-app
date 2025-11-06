@extends('layouts.lesson')

@section('title', 'Lesson 00: コーディングを始める準備')
@section('body-class', 'lesson lesson--environment')

@section('content')
  @include('lessons.partials.lesson00.01-hero')
  @include('lessons.partials.lesson00.02-step-01-goals')
  @include('lessons.partials.lesson00.03-step-02-basics')
  @include('lessons.partials.lesson00.04-step-03-os')
  @include('lessons.partials.lesson00.05-glossary')
  @include('lessons.partials.lesson00.06-checklist')
  @include('lessons.partials.lesson00.07-exercise')
  @include('lessons.partials.lesson00.08-navigation')
@endsection

