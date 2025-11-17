<section class="lesson-section">
  <h2 class="lesson-section__title">
    <i data-lucide="layout-template"></i>
    Blade コンポーネント設計パターン
  </h2>
  <div class="lesson-columns">
    <article class="lesson-card">
      <h3 class="lesson-card__title">Atom &amp; Molecule</h3>
      <p class="lesson-card__body">
        ボタン・タグ・アイコンなどの最小単位を Blade コンポーネント化し、Props で状態を切り替えられるようにします。
        スロットと defaults を組み合わせ、使い勝手を高めましょう。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">Organism / Template</h3>
      <p class="lesson-card__body">
        サイドバー付きレイアウトやタブ付きカードのような複合 UI は、`@@aware` や nested slot を活用すると
        親子関係を保ちながら柔軟に再構成できます。
      </p>
    </article>
    <article class="lesson-card">
      <h3 class="lesson-card__title">アクセシビリティ対応</h3>
      <p class="lesson-card__body">
        コンポーネント側で `aria-*` 属性や keyboard ナビゲーションを持たせることで、アプリ全体の UX を底上げできます。
        Lucide アイコンや Livewire/Alpine との連携時も意識しましょう。
      </p>
    </article>
  </div>
</section>
