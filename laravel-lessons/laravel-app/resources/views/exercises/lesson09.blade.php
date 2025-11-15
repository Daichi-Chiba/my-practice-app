@extends('layouts.exercise')

@section('title', 'Lesson 09 演習 - ジョブと非同期処理')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson09') }}">Lesson 09</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 09 演習: Fortune API の非同期化</h1>
    <p class="exercise-hero__lead">
      Fortune API の重い処理をキューへ移行し、Horizon で監視する体制を構築します。冪等性と失敗時の復旧まで含めて、
      本番運用を想定した非同期アーキテクチャを仕上げましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">Queue</li>
      <li class="exercise-hero__tag">Redis</li>
      <li class="exercise-hero__tag">Horizon</li>
      <li class="exercise-hero__tag">Schedule</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="workflow"></i> 課題 1: 同期処理のキュー化</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        結果通知メールをジョブへ切り出し、Controller は 202 応答に切り替えます。冪等性を確保しつつ、
        成功時の通知履歴を保存してください。
      </p>
      <ol class="exercise-card__steps">
        <li>NotifyFortuneResultJob を作成し、メール送信と履歴登録処理を実装</li>
        <li>FortuneResultController から <code>dispatch()</code> し、テストでキュー投入を検証</li>
        <li>処理済みフラグや notification テーブルを用意して二重送信を防ぐ</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="settings"></i> 課題 2: Horizon とワーカー設計</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        Redis キューと Horizon を利用し、ピークアクセスにも耐えるワーカー構成を定義します。
      </p>
      <ol class="exercise-card__steps">
        <li>config/horizon.php を編集し、default / critical キューを使い分ける構成を作成</li>
        <li>Supervisor か systemd で Horizon を常駐化し、再起動手順を README に追記</li>
        <li>Throughput と Runtime の目標値を決め、Slack 通知先を設定</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="alert-triangle"></i> 課題 3: 失敗ジョブの再試行戦略</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        外部 API エラーやメール送信失敗に備え、ジョブの再試行ポリシーとアラートを整備します。
      </p>
      <ol class="exercise-card__steps">
        <li><code>$tries</code> / <code>$backoff</code> / <code>retryUntil()</code> を設定し、恒久的エラー時に fail() を呼び出す</li>
        <li>失敗ジョブを自動で Slack 通知する Listener を追加</li>
        <li>Horizon の Failed Jobs 画面からスタックトレースを調査し、恒久対応手順をまとめる</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="calendar"></i> 課題 4: スケジュールバッチの実装</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        Cron を利用した集計ジョブを作成し、ダッシュボードへ結果を送信する処理を整備します。
      </p>
      <ol class="exercise-card__steps">
        <li>AggregateFortuneResultJob を作成し、Redis キューで実行されるよう <code>schedule()</code> に登録</li>
        <li><code>withoutOverlapping()</code> などを使って安全に実行されるよう保護</li>
        <li>バッチ成功時に Slack / メールでレポートを送信し、失敗時はアラートを出す</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> <code>php artisan schedule:work</code> を使うとローカル環境でも Cron を模擬できます。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ 同期処理がキューに移行し、Feature テストで 202 応答と履歴保存を確認</li>
      <li>✅ Horizon のワーカー構成・Slack 通知・監視ルールが README に記載されている</li>
      <li>✅ 失敗ジョブの再試行やアラート設計が実装済みで、二重送信が発生しない</li>
      <li>✅ Cron バッチが安全に実行され、レポート通知が運用フローに組み込まれている</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson09') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 09 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('lesson10') }}">
      Lesson 10 へ進む
      <i data-lucide="arrow-right"></i>
    </a>
  </footer>
@endsection
