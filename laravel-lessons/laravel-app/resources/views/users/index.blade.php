@extends('layouts.app')

@section('title', 'ユーザー一覧')

@section('content')
    <h1 style="margin-bottom: 1.5rem; color: #333;">ユーザー一覧</h1>
    
    <p style="margin-bottom: 1rem; color: #666;">
        <strong>Lesson 03:</strong> コントローラーから渡されたデータを表示しています
    </p>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">ID</th>
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">名前</th>
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">メール</th>
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="padding: 1rem; border-bottom: 1px solid #dee2e6;">{{ $user['id'] }}</td>
                    <td style="padding: 1rem; border-bottom: 1px solid #dee2e6;">{{ $user['name'] }}</td>
                    <td style="padding: 1rem; border-bottom: 1px solid #dee2e6;">{{ $user['email'] }}</td>
                    <td style="padding: 1rem; border-bottom: 1px solid #dee2e6;">
                        <a href="{{ route('users.show', $user['id']) }}" 
                           style="color: #667eea; text-decoration: none;">詳細</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
