@php
  $lesson03Tasks = [
      [
          'title' => 'マイグレーションとリレーション定義',
          'code' => <<<'CODE'
// database/migrations/2024_01_01_000000_create_fortunes_table.php
Schema::create('fortunes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('zodiac_id')->constrained()->cascadeOnDelete();
    $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
    $table->string('title');
    $table->text('body');
    $table->enum('rarity', ['common', 'rare', 'legendary']);
    $table->date('published_on');
    $table->timestamps();

    $table->unique(['zodiac_id', 'published_on']);
});

// app/Models/Fortune.php
class Fortune extends Model
{
    protected $fillable = [
        'zodiac_id',
        'author_id',
        'title',
        'body',
        'rarity',
        'published_on',
    ];

    public function zodiac(): BelongsTo
    {
        return $this->belongsTo(Zodiac::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'fortune_favorites')->withTimestamps();
    }
}
CODE
      ],
      [
          'title' => 'Seeder / Factory でダミーデータ作成',
          'code' => <<<'CODE'
// database/seeders/ZodiacSeeder.php
class ZodiacSeeder extends Seeder
{
    public function run(): void
    {
        $zodiacs = [
            ['name' => 'Aries', 'order' => 1],
            ['name' => 'Taurus', 'order' => 2],
            // ... 省略 ...
        ];

        foreach ($zodiacs as $zodiac) {
            Zodiac::updateOrCreate(['name' => $zodiac['name']], $zodiac);
        }
    }
}

// database/factories/FortuneFactory.php
class FortuneFactory extends Factory
{
    protected $model = Fortune::class;

    public function definition(): array
    {
        return [
            'zodiac_id' => Zodiac::factory(),
            'author_id' => User::factory(),
            'title' => $this->faker->sentence(6),
            'body' => $this->faker->paragraphs(3, true),
            'rarity' => $this->faker->randomElement(['common', 'rare', 'legendary']),
            'published_on' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}

// database/seeders/DatabaseSeeder.php
public function run(): void
{
    $this->call(ZodiacSeeder::class);

    User::factory(5)->create();
    Fortune::factory()
        ->count(40)
        ->state(new Sequence(
            ['rarity' => 'common'],
            ['rarity' => 'rare'],
            ['rarity' => 'legendary'],
        ))
        ->create();
}
CODE
      ],
      [
          'title' => 'N+1 を回避したクエリとテスト',
          'code' => <<<'CODE'
// app/Http/Controllers/FortuneIndexController.php
class FortuneIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        $fortunes = Fortune::query()
            ->with(['zodiac', 'author'])
            ->latest('published_on')
            ->paginate(20);

        return view('fortunes.index', compact('fortunes'));
    }
}

// tests/Feature/FortuneIndexTest.php
public function test_index_loads_relations_without_n_plus_one(): void
{
    Fortune::factory()->count(10)->create();

    $this->get('/fortunes')
        ->assertOk()
        ->assertViewHas('fortunes', function ($fortunes) {
            $fortunes->each(fn ($fortune) => $this->assertTrue($fortune->relationLoaded('zodiac')));
            $fortunes->each(fn ($fortune) => $this->assertTrue($fortune->relationLoaded('author')));

            return true;
        });
}
CODE
      ],
  ];

  $lesson03Summary = <<<'CODE'
// 主要マイグレーション・モデル設定
Fortune::with(['zodiac', 'author'])->paginate(20);

// Seeder で星座マスタとダミーデータを登録
php artisan db:seed

// N+1 を防ぐために with() を常に指定
$this->get('/fortunes')->assertOk();
CODE;
@endphp

<div class="exercise-answer">
  <h3 class="exercise-answer__title">課題ごとの模範解答</h3>

  @foreach ($lesson03Tasks as $task)
    <article class="exercise-answer__section">
      <h4 class="exercise-answer__heading">{{ $task['title'] }}</h4>
      <pre><code class="language-php">{{ $task['code'] }}</code></pre>
    </article>
  @endforeach

  <article class="exercise-answer__section exercise-answer__section--summary">
    <h4 class="exercise-answer__heading">総合まとめコード</h4>
    <pre><code class="language-php">{{ $lesson03Summary }}</code></pre>
  </article>
</div>
