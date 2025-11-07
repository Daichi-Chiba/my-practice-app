<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザー一覧を表示（Lesson 03用）
     */
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => '田中太郎', 'email' => 'tanaka@example.com'],
            ['id' => 2, 'name' => '佐藤花子', 'email' => 'sato@example.com'],
            ['id' => 3, 'name' => '鈴木一郎', 'email' => 'suzuki@example.com'],
        ];
        
        return view('users.index', compact('users'));
    }
    
    /**
     * 特定のユーザーを表示
     */
    public function show($id)
    {
        $user = [
            'id' => $id,
            'name' => 'サンプルユーザー' . $id,
            'email' => 'user' . $id . '@example.com'
        ];
        
        return view('users.show', compact('user'));
    }
}
