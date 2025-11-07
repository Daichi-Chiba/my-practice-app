<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Laravelの基礎', 'content' => 'Laravelは素晴らしいフレームワークです。'],
            ['id' => 2, 'title' => 'ルーティング入門', 'content' => 'ルーティングについて学びましょう。'],
            ['id' => 3, 'title' => 'コントローラーの使い方', 'content' => 'コントローラーでロジックを整理します。'],
        ];
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 実際はDBに保存
        return redirect()->route('posts.index')
            ->with('success', '投稿が作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = [
            'id' => $id,
            'title' => '投稿タイトル ' . $id,
            'content' => 'これは投稿' . $id . 'の内容です。',
            'author' => 'サンプル著者'
        ];
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = [
            'id' => $id,
            'title' => '投稿タイトル ' . $id,
            'content' => 'これは投稿' . $id . 'の内容です。'
        ];
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 実際はDBで更新
        return redirect()->route('posts.show', $id)
            ->with('success', '投稿が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 実際はDBから削除
        return redirect()->route('posts.index')
            ->with('success', '投稿が削除されました');
    }
}
