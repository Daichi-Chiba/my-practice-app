@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
    <h1 style="margin-bottom: 1.5rem; color: #333;">投稿編集</h1>

    <form action="{{ route('posts.update', $post['id']) }}" method="POST" style="max-width: 600px;">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label for="title" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">タイトル</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ $post['title'] }}"
                   required
                   style="width: 100%; padding: 0.75rem; border: 1px solid #dee2e6; border-radius: 4px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="content" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">内容</label>
            <textarea id="content" 
                      name="content" 
                      rows="6" 
                      required
                      style="width: 100%; padding: 0.75rem; border: 1px solid #dee2e6; border-radius: 4px; font-size: 1rem; resize: vertical;">{{ $post['content'] }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" 
                    style="padding: 0.75rem 1.5rem; background-color: #667eea; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                更新する
            </button>
            <a href="{{ route('posts.show', $post['id']) }}" 
               style="padding: 0.75rem 1.5rem; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">
                キャンセル
            </a>
        </div>
    </form>
@endsection
