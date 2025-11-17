<section class="lesson-section lesson-section--debug">
  <h2 class="lesson-section__title"><i data-lucide="bug"></i> ステップ4: デバッグツール</h2>

  <h3 class="lesson-section__subtitle">Debugbar</h3>
  <pre><code class="language-bash">composer require barryvdh/laravel-debugbar --dev</code></pre>

  <h3 class="lesson-section__subtitle">Telescope</h3>
  <pre><code class="language-bash">composer require laravel/telescope --dev
php artisan telescope:install && php artisan migrate</code></pre>

  <div class="lesson-callout">
    <strong>Tip:</strong> Debugbar はローカル開発の軽量計測、Telescope はチームでの詳細監視に最適です。不要になったら <code>config/app.php</code> や <code>config/telescope.php</code> で本番無効化を忘れずに。
  </div>
</section>
