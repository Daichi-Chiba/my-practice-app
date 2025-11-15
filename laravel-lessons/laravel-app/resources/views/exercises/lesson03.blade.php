@extends('layouts.exercise')

@section('title', 'Lesson 03 演習 - モデルとデータ設計')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson03') }}">Lesson 03</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 03 演習: Fortune DB を設計しよう</h1>
    <p class="exercise-hero__lead">
      占いアプリのドメインを整理し、マイグレーション・シーディング・リレーションを揃えます。Eloquent で扱いやすい
      モデル構造を意識しながら、API と管理画面の両方で再利用できるデータ設計を作り込みましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">Migration</li>
      <li class="exercise-hero__tag">Seeder</li>
      <li class="exercise-hero__tag">Eloquent</li>
      <li class="exercise-hero__tag">ER 図</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="database"></i> 課題 1: ER 図とマイグレーション</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        Fortune / Horoscope / User / Zodiac などのテーブルを洗い出し、ER 図を描いてからマイグレーションを実装します。
      </p>
      <ol class="exercise-card__steps">
        <li>要件をもとにエンティティ・属性・リレーション (1:N / N:N) を整理し、ER 図ツールで図示する</li>
        <li><code>php artisan make:migration</code> でテーブルを作成し、外部キー・ユニーク制約を追加</li>
        <li>マイグレーションを実行し、<code>sqlitebrowser</code> や <code>php artisan schema:dump</code> で構造を確認</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> <code>fortune_favorites</code> のような中間テーブルには複合ユニーク制約 (<code>user_id</code>, <code>fortune_id</code>) を設定して重複登録を防ぎましょう。
      </div>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="layers"></i> 課題 2: シーディングとファクトリ</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        開発環境で使い回せるダミーデータを整えます。モデルファクトリを活用してテストデータを高速に生成できるようにしましょう。
      </p>
      <ol class="exercise-card__steps">
        <li><code>ZodiacSeeder</code> で 12 星座のマスタデータを投入し、ドメインの前提条件を整える</li>
        <li><code>FortuneFactory</code> にステート (<code>love</code>, <code>work</code>, <code>money</code>) を用意してカテゴリ別に生成</li>
        <li><code>DatabaseSeeder</code> から <code>User::factory()</code> と組み合わせ、本番に近いボリュームのダミーデータを作成</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="git-branch"></i> 課題 3: Eloquent リレーションの実装</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        モデル間の関連を定義し、読み書き双方で正しく機能するかを確認します。リレーションの命名と戻り値の型ヒントも整理しましょう。
      </p>
      <ol class="exercise-card__steps">
        <li><code>User</code> ↔ <code>Fortune</code> (hasMany / belongsTo)、<code>Fortune</code> ↔ <code>Zodiac</code> (belongsTo) を定義</li>
        <li><code>Fortune</code> ↔ <code>User</code> のお気に入り (belongsToMany) を中間テーブルとともに実装</li>
        <li><code>Fortune::with(['zodiac', 'author'])</code> で eager load が効き、N+1 が発生していないか <code>debugbar</code> で確認</li>
      </ol>
      <div class="exercise-warning">
        <strong>注意:</strong> リレーション名は複数形・単数形の規約に従い、テストで <code>$user->fortunes()->create()</code> が正常に動くかチェックしてください。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ ER 図が README または docs/ に添付され、主要テーブル・リレーションが説明されている</li>
      <li>✅ マイグレーションの外部キー・ユニーク制約が正しく設定され、<code>php artisan migrate:fresh</code> が成功する</li>
      <li>✅ Seeder / Factory が用意され、<code>php artisan db:seed</code> で開発用データが生成できる</li>
      <li>✅ リレーションを利用したクエリにおける N+1 が解消されている</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson03') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 03 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson04') }}">
      Lesson 04 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
