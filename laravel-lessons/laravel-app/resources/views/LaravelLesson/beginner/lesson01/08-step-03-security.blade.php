<section class="lesson-section lesson-section--security">
  <h2 class="lesson-section__title"><i data-lucide="shield"></i> ステップ3: .env とセキュリティ</h2>
  <pre><code class="language-gitignore">/vendor/
/node_modules/
/.env
/.env.*</code></pre>
  <pre><code class="language-bash"># .env.example（抜粋）
APP_ENV=local
APP_DEBUG=true
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=secret</code></pre>
  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> <code>.env</code> や認証情報は Git に含めないでください。共有が必要な場合は 1password / Bitwarden など安全な手段で渡しましょう。
  </div>
</section>
