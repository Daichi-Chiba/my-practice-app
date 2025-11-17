@php
  $lesson04Tasks = [
      [
          'title' => 'N+1 の検知と改善',
          'code' => <<<'CODE'
// app/Http/Controllers/FortuneReportController.php
class FortuneReportController extends Controller
{
    public function __invoke(): View
    {
        $fortunes = Fortune::query()
            ->with(['zodiac', 'author'])
            ->latest('published_on')
            ->paginate(20);

        return view('fortunes.index', compact('fortunes'));
    }
}

// Debugbar を使って改善前後のクエリ数を比較
debugbar()->info('before', [
    'queries' => DB::getQueryLog(),
]);
CODE
      ],
      [
          'title' => 'キャッシュとベンチマーク',
          'code' => <<<'CODE'
// app/Services/FortuneRankingService.php
class FortuneRankingService
{
    public function get(): Collection
    {
        return Cache::remember('fortune:ranking:v1', now()->addMinutes(10), function () {
            return Fortune::query()
                ->with(['zodiac'])
                ->latest('published_on')
                ->take(10)
                ->get()
                ->map(fn ($fortune) => [
                    'title' => $fortune->title,
                    'zodiac' => $fortune->zodiac->name,
                    'rarity' => $fortune->rarity,
                ]);
        });
    }
}

// ベンチマーク（laravel-pretend）
Benchmark::measure('fortune-ranking', function () {
    app(FortuneRankingService::class)->get();
});
CODE
      ],
      [
          'title' => 'テストでパフォーマンスを担保',
          'code' => <<<'CODE'
// tests/Feature/FortuneRankingTest.php
public function test_ranking_is_cached(): void
{
    Cache::shouldReceive('remember')
        ->once()
        ->andReturn(collect());

    app(FortuneRankingService::class)->get();
}

public function test_eager_loading_prevents_n_plus_one(): void
{
    Fortune::factory()->count(5)->create();

    DB::enableQueryLog();

    $this->get('/fortunes')->assertOk();

    $queries = collect(DB::getQueryLog());
    $this->assertLessThanOrEqual(3, $queries->count());
}
CODE
      ],
  ];

  $lesson04Summary = <<<'CODE'
$fortunes = Fortune::with(['zodiac', 'author'])
    ->latest('published_on')
    ->paginate(20);

Cache::remember('fortune:ranking:v1', 600, fn () => Fortune::topTen());

$this->assertLessThanOrEqual(3, collect(DB::getQueryLog())->count());
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson04Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-php">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-php">{{ $lesson04Summary }}</code></pre>
  </article>
</div>
