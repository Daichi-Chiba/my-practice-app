<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="git-branch"></i> Mock / Fake で外部依存を切り離す</h2>
  <p class="lesson-section__lead">
    TDD ではテスト対象をシンプルに保つため、外部 API や通知機能をモック化します。Laravel には Mail, Queue, Event などの Fake が揃い、
    期待どおりに呼び出されたかを簡潔にアサートできます。
  </p>

  <h3 class="lesson-section__heading">1. 通知の Fake</h3>
  <pre><code class="language-php">Notification::fake();

$this->actingAs($user)->post(route('fortunes.favorite', $fortune));

Notification::assertSentTo($user, NewFortuneFavorited::class, function ($notification) use ($fortune) {
    return $notification->fortune->is($fortune);
});</code></pre>

  <h3 class="lesson-section__heading">2. 外部 API クライアントのモック</h3>
  <pre><code class="language-php">$client = Mockery::mock(HoroscopeApi::class);
$client->shouldReceive('fetchToday')
    ->once()
    ->with('aries')
    ->andReturn(['result' => 'great', 'score' => 92]);

$this->app->instance(HoroscopeApi::class, $client);</code></pre>

  <div class="lesson-callout lesson-callout--success">
    <strong>Tip:</strong> Mockery を使う場合は <code>tearDown()</code> で <code>Mockery::close()</code> を呼び、
    PHPUnit の <code>--strict</code> モードでも警告が出ないようにしましょう。
  </div>
</section>
