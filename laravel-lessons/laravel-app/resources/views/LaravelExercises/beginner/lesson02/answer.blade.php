@php
  $lesson02Tasks = [
      [
          'title' => 'Fortune リソースルートとコントローラ',
          'code' => <<<'CODE'
// routes/web.php
Route::resource('fortunes', FortuneController::class)
    ->only(['index', 'show', 'store']);

// app/Http/Controllers/FortuneController.php
class FortuneController extends Controller
{
    public function index(): View
    {
        $fortunes = Fortune::latest()->paginate(20);

        return view('fortunes.index', compact('fortunes'));
    }

    public function show(Fortune $fortune): View
    {
        return view('fortunes.show', compact('fortune'));
    }

    public function store(StoreFortuneRequest $request): RedirectResponse
    {
        Fortune::create($request->validated());

        return redirect()->route('fortunes.index');
    }
}
CODE
      ],
      [
          'title' => '管理画面ルートと権限制御',
          'code' => <<<'CODE'
// routes/web.php
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)
            ->name('dashboard');

        Route::middleware('can:manage-users')->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])
                ->name('users.index');
        });

        Route::get('/settings', AdminSettingsController::class)
            ->name('settings');
    });
CODE
      ],
      [
          'title' => 'Feature テストで REST/権限を検証',
          'code' => <<<'CODE'
// tests/Feature/FortuneRoutesTest.php
public function test_guest_cannot_access_admin_routes(): void
{
    $this->get('/admin/dashboard')->assertRedirect('/login');
}

public function test_editor_can_view_fortunes_index(): void
{
    $editor = User::factory()->create(['role' => 'editor']);

    $this->actingAs($editor)
        ->get('/fortunes')
        ->assertOk();
}

public function test_viewer_cannot_access_admin_users(): void
{
    $viewer = User::factory()->create(['role' => 'viewer']);

    $this->actingAs($viewer)
        ->get('/admin/users')
        ->assertForbidden();
}
CODE
      ],
  ];

  $lesson02Summary = <<<'CODE'
// routes/web.php
Route::resource('fortunes', FortuneController::class)
    ->only(['index', 'show', 'store']);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::middleware('can:manage-users')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    });
    Route::get('/settings', AdminSettingsController::class)->name('settings');
});

// tests/Feature/FortuneRoutesTest.php
public function test_admin_routes_require_auth(): void { /* ... */ }
public function test_editor_can_view_index(): void { /* ... */ }
public function test_viewer_cannot_manage_users(): void { /* ... */ }
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson02Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-php">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-php">{{ $lesson02Summary }}</code></pre>
  </article>
</div>
