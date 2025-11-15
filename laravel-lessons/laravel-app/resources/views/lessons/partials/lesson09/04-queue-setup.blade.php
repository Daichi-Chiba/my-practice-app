<section class="lesson-section lesson-section--code">
  <h2 class="lesson-section__title"><i data-lucide="settings"></i> キュー接続とワーカー構成</h2>
  <p class="lesson-section__lead">
    Laravel ではドライバを差し替えるだけで同期キューから Redis / SQS などに移行できます。ここでは Redis を利用した構成と、
    Horizon を前提としたワーカー設定を確認します。
  </p>

  <h3 class="lesson-section__heading">1. キュー接続の設定</h3>
  <pre><code class="language-php">// config/queue.php
'redis' => [
    'driver' => 'redis',
    'connection' => 'default',
    'queue' => env('REDIS_QUEUE', 'default'),
    'retry_after' => 90,
    'block_for' => null,
],</code></pre>

  <h3 class="lesson-section__heading">2. Supervisor / Horizon の起動</h3>
  <pre><code class="language-bash"># Horizon を常駐起動 (docker-compose.yml)
artisan horizon</code></pre>

  <ul class="lesson-list">
    <li>ワーカー台数・優先度は <code>config/horizon.php</code> で調整、<code>balance</code> オプションで負荷分散方法を選択</li>
    <li>障害時に備えて Supervisor や systemd で Horizon を常駐化し、再起動時のリカバリを自動化</li>
    <li>キュー名ごとにワーカーを分離して、重要度の高いジョブが他のキューに邪魔されないようにする</li>
  </ul>
</section>
