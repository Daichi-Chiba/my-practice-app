<section class="lesson-section lesson-section--seeder">
  <h2 class="lesson-section__title"><i data-lucide="git-branch"></i> シーダとテストデータ</h2>
  <pre><code class="language-bash">php artisan make:seeder ZodiacSeeder
php artisan db:seed --class=ZodiacSeeder
</code></pre>
  <pre><code class="language-php">// database/seeders/ZodiacSeeder.php
public function run()
{
  $names = ['牡羊座','牡牛座','双子座','蟹座','獅子座','乙女座','天秤座','蠍座','射手座','山羊座','水瓶座','魚座'];
  foreach ($names as $name) {
    \App\Models\Zodiac::firstOrCreate(['name' => $name]);
  }
}
</code></pre>
  <div class="lesson-callout">
    <strong>再現性の確保:</strong> 本番・ステージング・ローカルで同じマスタを用意できるよう、シーダは必ずリポジトリにコミットして共有します。
  </div>
</section>
