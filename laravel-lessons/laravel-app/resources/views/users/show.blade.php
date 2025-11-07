@extends('layouts.app')

@section('title', 'ユーザー詳細')

@section('content')
    <h1 style="margin-bottom: 1.5rem; color: #333;">ユーザー詳細</h1>

    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
        <p style="margin-bottom: 0.5rem;"><strong>ID:</strong> {{ $user['id'] }}</p>
        <p style="margin-bottom: 0.5rem;"><strong>名前:</strong> {{ $user['name'] }}</p>
        <p style="margin-bottom: 0;"><strong>メール:</strong> {{ $user['email'] }}</p>
    </div>

    <a href="{{ route('users.index') }}" 
       style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #667eea; color: white; text-decoration: none; border-radius: 4px;">
        一覧に戻る
    </a>
@endsection
