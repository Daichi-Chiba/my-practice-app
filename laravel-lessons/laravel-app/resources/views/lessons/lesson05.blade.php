@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1 style="margin-bottom: 1.5rem; color: #333;">{{ $title }}</h1>

    <div style="background-color: #e7f3ff; padding: 1rem; border-left: 4px solid #667eea; margin-bottom: 1.5rem;">
        <h3 style="margin: 0 0 0.5rem 0;">Lesson 05: Bladeテンプレート</h3>
        <p style="margin: 0;">レイアウト継承、ディレクティブ、変数表示などを学習します</p>
    </div>

    <h2 style="margin: 1.5rem 0 1rem 0; color: #333;">変数の表示</h2>
    <p style="color: #666;">コントローラーから渡された変数: <strong>{{ $title }}</strong></p>

    <h2 style="margin: 1.5rem 0 1rem 0; color: #333;">条件分岐 (@if, @else)</h2>
    @if(count($users) > 0)
        <p style="color: #28a745;">✓ ユーザーが存在します（{{ count($users) }}人）</p>
    @else
        <p style="color: #dc3545;">✗ ユーザーがいません</p>
    @endif

    <h2 style="margin: 1.5rem 0 1rem 0; color: #333;">ループ (@foreach)</h2>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="padding: 0.75rem; text-align: left; border-bottom: 2px solid #dee2e6;">ID</th>
                <th style="padding: 0.75rem; text-align: left; border-bottom: 2px solid #dee2e6;">名前</th>
                <th style="padding: 0.75rem; text-align: left; border-bottom: 2px solid #dee2e6;">メール</th>
                <th style="padding: 0.75rem; text-align: left; border-bottom: 2px solid #dee2e6;">ループ情報</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #dee2e6;">{{ $user['id'] }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #dee2e6;">{{ $user['name'] }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #dee2e6;">{{ $user['email'] }}</td>
                    <td style="padding: 0.75rem; border-bottom: 1px solid #dee2e6;">
                        @if($loop->first)
                            <span style="color: #28a745;">最初</span>
                        @elseif($loop->last)
                            <span style="color: #dc3545;">最後</span>
                        @else
                            {{ $loop->iteration }} / {{ $loop->count }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="margin: 1.5rem 0 1rem 0; color: #333;">@forelse (空チェック付きループ)</h2>
    @forelse($users as $user)
        <div style="background-color: #f8f9fa; padding: 1rem; margin-bottom: 0.5rem; border-radius: 4px;">
            <strong>{{ $user['name'] }}</strong> - {{ $user['email'] }}
        </div>
    @empty
        <p style="color: #6c757d;">データがありません</p>
    @endforelse

    <div style="margin-top: 2rem; padding: 1rem; background-color: #fff3cd; border-radius: 4px;">
        <h3 style="margin: 0 0 0.5rem 0;">💡 Bladeの便利な機能</h3>
        <ul style="margin: 0; padding-left: 1.5rem;">
            <li>レイアウト継承: @extends, @section, @yield</li>
            <li>条件分岐: @if, @elseif, @else, @endif</li>
            <li>ループ: @foreach, @for, @while, @forelse</li>
            <li>変数表示: {{ $variable }} (自動エスケープ)</li>
            <li>HTML表示: {!! $html !!} (エスケープなし)</li>
        </ul>
    </div>
@endsection
