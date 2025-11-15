<section class="lesson-section">
  <h2 class="lesson-section__title"><i data-lucide="scales"></i> Policy による RBAC 設計</h2>
  <p class="lesson-section__lead">
    認証だけでは「誰が」「どこまで」操作して良いかは決まりません。Laravel の Policy を活用すると、
    ドメイン知識をコードで表現し、Controller から認可ロジックを排除できます。
  </p>

  <h3 class="lesson-section__heading">1. ロールと権限のモデリング</h3>
  <pre><code class="language-php">// database/seeders/RoleSeeder.php
Role::create(['name' => 'viewer']);
Role::create(['name' => 'editor']);
Role::create(['name' => 'admin']);

User::factory()->create([
    'email' => 'admin@example.com',
])->assignRole('admin');</code></pre>

  <h3 class="lesson-section__heading">2. Policy の定義</h3>
  <pre><code class="language-php">// app/Policies/FortunePolicy.php
public function update(User $user, Fortune $fortune): bool
{
    return $user->hasRole('editor') || $user->id === $fortune->author_id;
}

public function delete(User $user, Fortune $fortune): bool
{
    return $user->hasRole('admin');
}</code></pre>

  <h3 class="lesson-section__heading">3. Controller での適用</h3>
  <pre><code class="language-php">// app/Http/Controllers/FortuneController.php
public function update(UpdateFortuneRequest $request, Fortune $fortune)
{
    $this->authorize('update', $fortune);

    $fortune->update($request->validated());

    return redirect()->route('fortunes.show', $fortune)
        ->with('status', __('Fortune updated!'));
}</code></pre>

  <div class="lesson-callout lesson-callout--warning">
    <strong>注意:</strong> Policy 判定はリクエストごとに実行されます。複雑なロール条件は
    サービスクラスに切り出すなど、可読性とパフォーマンスのバランスを意識しましょう。
  </div>
</section>
