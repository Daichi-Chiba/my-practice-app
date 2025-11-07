@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 style="margin: 0; color: #333;">投稿一覧</h1>
        <a href="{{ route('posts.create') }}" 
           style="padding: 0.75rem 1.5rem; background-color: #667eea; color: white; text-decoration: none; border-radius: 4px;">
            新規投稿
        </a>
    </div>

    <p style="margin-bottom: 1.5rem; color: #666;">
        <strong>Lesson 03:</strong> リソースコントローラーのindex()メソッドからデータを表示
    </p>

    <div style="display: grid; gap: 1rem;">
        @forelse($posts as $post)
            <div style="border: 1px solid #dee2e6; padding: 1.5rem; border-radius: 8px; background-color: #f8f9fa;">
                <h3 style="margin: 0 0 0.5rem 0; color: #333;">
                    <a href="{{ route('posts.show', $post['id']) }}" 
                       style="color: #667eea; text-decoration: none;">
                        {{ $post['title'] }}
                    </a>
                </h3>
                <p style="margin: 0; color: #666;">{{ $post['content'] }}</p>
            </div>
        @empty
            <p style="color: #666;">投稿がありません</p>
        @endforelse
    </div>
@endsection
