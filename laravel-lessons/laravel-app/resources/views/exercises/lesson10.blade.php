@extends('layouts.exercise')

@section('title', 'Lesson 10 演習 - デプロイと運用保守')

@section('content')
  <header class="exercise-hero">
    <nav class="exercise-hero__breadcrumb">
      <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson10') }}">Lesson 10</a>
      <span class="exercise-hero__breadcrumb-separator">></span>
      <span>演習</span>
    </nav>
    <h1 class="exercise-hero__title">Lesson 10 演習: 運用を支えるデプロイと監視</h1>
    <p class="exercise-hero__lead">
      Fortune API を本番運用に耐えるサービスへ仕上げます。ゼロダウンタイムデプロイ、監視・アラート、バックアップ、インシデント対応まで
      一連の運用基盤を整備しましょう。
    </p>
    <ul class="exercise-hero__tags">
      <li class="exercise-hero__tag">CI/CD</li>
      <li class="exercise-hero__tag">Observability</li>
      <li class="exercise-hero__tag">Incident</li>
      <li class="exercise-hero__tag">Backup</li>
    </ul>
  </header>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="rocket"></i> 課題 1: デプロイパイプラインの構築</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        GitHub Actions とサーバースクリプトを組み合わせ、main ブランチへのマージで自動デプロイされる仕組みを整備します。
      </p>
      <ol class="exercise-card__steps">
        <li>テスト・ビルド・デプロイを含むワークフローを作成し、秘密情報は GitHub Secrets で管理</li>
        <li>Envoy / Deployer などのツールでリリースディレクトリを切り替える Zero Downtime フローを整備</li>
        <li>デプロイ結果を Slack 通知し、失敗時は自動ロールバックできるようにする</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="radar"></i> 課題 2: 可観測性ダッシュボード</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        ログ・メトリクス・トレースを統合したダッシュボードを準備し、SLO を定義します。
      </p>
      <ol class="exercise-card__steps">
        <li>Grafana / Datadog に API レスポンス時間・エラーレート・ジョブ失敗数を可視化するダッシュボードを作成</li>
        <li>Alerting ルールを設定し、SLO 逸脱時にオンコールへ通知</li>
        <li>README に監視 URL・SLO 指標・アラート閾値を明記</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="life-buoy"></i> 課題 3: インシデントレスポンスの整備</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        障害発生時の初動・ロールバック・コミュニケーションをまとめた Runbook を作成します。
      </p>
      <ol class="exercise-card__steps">
        <li>重大度ごとに初動対応フローを定義し、担当者・連絡手段・エスカレーションパスを文書化</li>
        <li>ロールバック手順とポストモーテムのテンプレートを用意</li>
        <li>ステータスページの更新手順や顧客通知テンプレートを整備</li>
      </ol>
    </div>
  </section>

  <section class="exercise-card">
    <h2 class="exercise-card__title"><i data-lucide="database"></i> 課題 4: バックアップと DR テスト</h2>
    <div class="exercise-card__content">
      <p class="exercise-card__description">
        データを安全に保管し、定期的に復旧できることを証明します。
      </p>
      <ol class="exercise-card__steps">
        <li>DB / ファイルのバックアップポリシーを決め、スクリプトやマネージドサービスで自動取得</li>
        <li>ステージング環境で定期的にリストアテストを実施し、手順を Runbook に追記</li>
        <li>災害時の復旧目標 (RPO/RTO) を定義し、経営層・関係者と合意</li>
      </ol>
      <div class="exercise-note">
        <strong>ヒント:</strong> バックアップは取得しただけでは意味がありません。復旧訓練を通じて信頼性を確認しましょう。
      </div>
    </div>
  </section>

  <section class="exercise-checklist">
    <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
    <ul class="exercise-checklist__list">
      <li>✅ main ブランチから自動デプロイされ、失敗時にロールバックできる</li>
      <li>✅ 監視ダッシュボードとアラートルールが整備され、SLO が定義されている</li>
      <li>✅ インシデント対応 Runbook とコミュニケーション手順が用意されている</li>
      <li>✅ バックアップ / DR テストの記録があり、RPO/RTO の合意が取れている</li>
    </ul>
  </section>

  <footer class="exercise-footer">
    <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson10') }}">
      <i data-lucide="arrow-left"></i>
      Lesson 10 に戻る
    </a>
    <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('home') }}">
      レッスン一覧へ
      <i data-lucide="arrow-up-right"></i>
    </a>
  </footer>
@endsection
