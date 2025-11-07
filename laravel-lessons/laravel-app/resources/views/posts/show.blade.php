@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <h1 style="margin-bottom: 1rem; color: #333;">{{ $post['title'] }}</h1>

    <div style="margin-bottom: 1rem; color: #666;">
        <span>著者: {{ $post['author'] }}</span>
        <span style="margin-left: 1rem;">ID: {{ $post['id'] }}</span>
    </div>

    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
        <p>{{ $post['content'] }}</p>
    </div>

    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('posts.index') }}" 
           style="padding: 0.75rem 1.5rem; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
            一覧に戻る
        </a>
        <a href="{{ route('posts.edit', $post['id']) }}" 
           style="padding: 0.75rem 1.5rem; background-color: #ffc107; color: #333; text-decoration: none; border-radius: 4px;">
            編集
        </a>
        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    style="padding: 0.75rem 1.5rem; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;"
                    onclick="return confirm('本当に削除しますか？')">
                削除
            </button>
        </form>
    </div>
@endsection
