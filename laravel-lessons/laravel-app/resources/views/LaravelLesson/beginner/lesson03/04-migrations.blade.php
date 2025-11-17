<section class="lesson-section lesson-section--migrations">
  <h2 class="lesson-section__title"><i data-lucide="hammer"></i> マイグレーションとモデル</h2>
  <h3 class="lesson-section__heading">1. マイグレーション作成</h3>
  <pre><code class="language-bash">php artisan make:migration create_zodiacs_table --create=zodiacs
php artisan make:migration create_fortunes_table --create=fortunes
</code></pre>
  <h3 class="lesson-section__heading">2. モデル作成</h3>
  <pre><code class="language-bash">php artisan make:model Zodiac
php artisan make:model Fortune
</code></pre>
  <h3 class="lesson-section__heading">3. リレーション定義</h3>
  <pre><code class="language-php">// app/Models/User.php
public function fortunes() { return $this-&gt;hasMany(Fortune::class); }
public function zodiac() { return $this-&gt;belongsTo(Zodiac::class); }

// app/Models/Fortune.php
public function user() { return $this-&gt;belongsTo(User::class); }

// app/Models/Zodiac.php
public function users() { return $this-&gt;hasMany(User::class); }
</code></pre>
  <div class="lesson-callout lesson-callout--warning">
    <strong>マイグレーション命名:</strong> <code>create_{table}_table</code> 形式に統一すると、履歴や差分の追跡が容易になります。
  </div>
</section>
