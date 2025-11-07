@extends('layouts.app')

@section('title', 'Lesson 03 - コントローラーとリクエスト処理')

@section('content')
    <div style="max-width: 1000px; margin: 0 auto;">
        <h1 style="color: #667eea; margin-bottom: 1rem;">Lesson 03: コントローラーとリクエスト処理</h1>
        
        <div style="background: #e7f3ff; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #667eea;">
            <h3 style="margin: 0 0 0.5rem 0; color: #667eea;">📚 このレッスンで学ぶこと</h3>
            <ul style="margin: 0.5rem 0 0 1.5rem; color: #333;">
                <li>コントローラーの作成と基本</li>
                <li>リソースコントローラー</li>
                <li>フォームリクエストとバリデーション</li>
                <li>レスポンスタイプ（JSON, View, Redirect）</li>
                <li>RESTful API設計</li>
            </ul>
        </div>

        <!-- セクション1: コントローラーの作成 -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                1. コントローラーの作成
            </h2>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">📝 Artisanコマンドで作成</h4>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto;"><code># 通常のコントローラー
php artisan make:controller UserController

# リソースコントローラー
php artisan make:controller PostController --resource

# APIリソースコントローラー
php artisan make:controller ApiController --api</code></pre>
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">📝 app/Http/Controllers/UserController.php</h4>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto;"><code>namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => '田中太郎'],
            ['id' => 2, 'name' => '佐藤花子'],
        ];
        
        return view('users.index', compact('users'));
    }
    
    public function show($id)
    {
        // DBから取得する場合
        // $user = User::findOrFail($id);
        
        $user = ['id' => $id, 'name' => 'ユーザー' . $id];
        return view('users.show', compact('user'));
    }
}</code></pre>
            </div>

            <div style="background: #d1ecf1; padding: 1rem; border-radius: 8px;">
                <strong>🔍 実際に確認:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    <li><a href="{{ route('users.index') }}" style="color: #667eea;">ユーザー一覧ページ</a></li>
                    <li><a href="{{ route('users.show', 1) }}" style="color: #667eea;">ユーザー詳細ページ</a></li>
                </ul>
            </div>
        </section>

        <!-- セクション2: リソースコントローラー -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                2. リソースコントローラー
            </h2>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">リソースコントローラーのメソッド一覧</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #667eea; color: white;">
                            <th style="padding: 0.75rem; text-align: left;">メソッド</th>
                            <th style="padding: 0.75rem; text-align: left;">URI</th>
                            <th style="padding: 0.75rem; text-align: left;">アクション</th>
                            <th style="padding: 0.75rem; text-align: left;">用途</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: white;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">GET</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">index()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">一覧表示</td>
                        </tr>
                        <tr style="background: #f8f9fa;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">GET</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts/create</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">create()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">作成フォーム</td>
                        </tr>
                        <tr style="background: white;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">POST</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">store()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">データ保存</td>
                        </tr>
                        <tr style="background: #f8f9fa;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">GET</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts/{id}</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">show()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">詳細表示</td>
                        </tr>
                        <tr style="background: white;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">GET</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts/{id}/edit</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">edit()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">編集フォーム</td>
                        </tr>
                        <tr style="background: #f8f9fa;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">PUT/PATCH</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts/{id}</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">update()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">データ更新</td>
                        </tr>
                        <tr style="background: white;">
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">DELETE</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">/posts/{id}</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">destroy()</td>
                            <td style="padding: 0.75rem; border: 1px solid #dee2e6;">データ削除</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">📝 ルート定義</h4>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto;"><code>// routes/web.php
Route::resource('posts', PostController::class);

// 一部のメソッドのみ使用
Route::resource('posts', PostController::class)->only(['index', 'show']);

// 一部を除外
Route::resource('posts', PostController::class)->except(['destroy']);</code></pre>
            </div>

            <div style="background: #d1ecf1; padding: 1rem; border-radius: 8px;">
                <strong>🔍 実際に確認:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    <li><a href="{{ route('posts.index') }}" style="color: #667eea;">投稿一覧</a></li>
                    <li><a href="{{ route('posts.create') }}" style="color: #667eea;">新規投稿</a></li>
                    <li><a href="{{ route('posts.show', 1) }}" style="color: #667eea;">投稿詳細</a></li>
                </ul>
            </div>
        </section>

        <!-- セクション3: バリデーション -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                3. バリデーション
            </h2>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">📝 コントローラーでのバリデーション</h4>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto;"><code>public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'email' => 'required|email|unique:users',
        'age' => 'nullable|integer|min:18|max:100',
        'published_at' => 'nullable|date',
    ]);
    
    // バリデーション通過後の処理
    Post::create($validated);
    
    return redirect()->route('posts.index')
        ->with('success', '投稿を作成しました');
}</code></pre>
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">よく使うバリデーションルール</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="background: white;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">required</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">必須</td>
                    </tr>
                    <tr style="background: #f8f9fa;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">email</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">メール形式</td>
                    </tr>
                    <tr style="background: white;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">unique:table,column</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">一意性チェック</td>
                    </tr>
                    <tr style="background: #f8f9fa;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">min:n / max:n</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">最小値/最大値</td>
                    </tr>
                    <tr style="background: white;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">confirmed</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">確認フィールドと一致</td>
                    </tr>
                    <tr style="background: #f8f9fa;">
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; font-weight: bold;">in:foo,bar</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">指定値のいずれか</td>
                    </tr>
                </table>
            </div>
        </section>

        <!-- セクション4: レスポンスタイプ -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                4. 様々なレスポンス
            </h2>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">📝 レスポンスの種類</h4>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto;"><code>// ビューを返す
return view('posts.index', compact('posts'));

// JSONを返す（API）
return response()->json([
    'success' => true,
    'data' => $posts
], 200);

// リダイレクト
return redirect()->route('posts.index');

// リダイレクト with フラッシュメッセージ
return redirect()->route('posts.show', $post->id)
    ->with('success', '投稿を更新しました');

// ダウンロード
return response()->download($pathToFile);

// ファイル表示
return response()->file($pathToFile);</code></pre>
            </div>

            <div style="background: #fff3cd; padding: 1rem; border-radius: 8px;">
                <strong>💡 ポイント:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    <li>用途に応じて適切なレスポンスを選択</li>
                    <li>APIはJSON、Web画面はViewまたはRedirect</li>
                    <li>HTTPステータスコードを適切に設定</li>
                </ul>
            </div>
        </section>

        <!-- 練習問題 -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                📝 練習問題
            </h2>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h4 style="margin: 0 0 1rem 0;">問題: 商品管理コントローラー作成</h4>
                <p style="margin-bottom: 1rem;">
                    ProductControllerをリソースコントローラーとして作成し、商品の一覧・作成・編集・削除機能を実装してください。
                    <br>バリデーションも追加してください（名前: 必須・最大100文字、価格: 必須・整数・0以上）。
                </p>
                
                <details style="cursor: pointer;">
                    <summary style="background: #667eea; color: white; padding: 0.75rem; border-radius: 4px;">
                        💡 解答例を見る
                    </summary>
                    <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1.5rem; border-radius: 8px; overflow-x: auto; margin-top: 1rem;"><code>// コマンド
php artisan make:controller ProductController --resource

// ProductController.php
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer|min:0',
        ]);
        
        Product::create($validated);
        return redirect()->route('products.index')
            ->with('success', '商品を作成しました');
    }
    
    // 他のメソッドも同様に実装
}

// routes/web.php
Route::resource('products', ProductController::class);</code></pre>
                </details>
            </div>
        </section>

        <!-- ナビゲーション -->
        <div style="display: flex; justify-content: space-between; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
            <a href="{{ route('lesson02') }}" style="padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
                ← 前のレッスン
            </a>
            <a href="{{ route('home') }}" style="padding: 0.75rem 1.5rem; background: #667eea; color: white; text-decoration: none; border-radius: 4px;">
                ホームに戻る
            </a>
        </div>
    </div>
@endsection
