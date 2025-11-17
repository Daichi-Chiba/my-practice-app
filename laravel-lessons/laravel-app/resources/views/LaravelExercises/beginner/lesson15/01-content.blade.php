@section('title', 'Lesson 15 演習 - 総合演習と振り返り')

<header class="exercise-hero">
  <nav class="exercise-hero__breadcrumb">
    <a class="exercise-hero__breadcrumb-link" href="/">トップ</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <a class="exercise-hero__breadcrumb-link" href="{{ route('lesson15') }}">Lesson 15</a>
    <span class="exercise-hero__breadcrumb-separator">></span>
    <span>演習</span>
  </nav>
  <h1 class="exercise-hero__title">Lesson 15 演習: プロジェクト総仕上げと振り返り</h1>
  <p class="exercise-hero__lead">
    これまで実装してきた機能・運用・ドキュメントを統合し、本番リリースを想定した最終チェックと振り返りを行います。
    個人・チーム双方での学びを言語化し、次のステップに繋げましょう。
  </p>
  <ul class="exercise-hero__tags">
    <li class="exercise-hero__tag">Retrospective</li>
    <li class="exercise-hero__tag">Testing</li>
    <li class="exercise-hero__tag">Checklist</li>
    <li class="exercise-hero__tag">Career</li>
  </ul>
</header>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="clipboard-check"></i> 課題 1: リリース前最終チェック</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      本番リリースを想定し、アプリケーション・インフラ・運用面の最終確認を行います。
    </p>
    <ol class="exercise-card__steps">
      <li>最終的な機能テスト（E2E）とロードテストを実施し、結果をレポートにまとめる</li>
      <li>ログ・監視・アラート設定を再確認し、想定外アラートの抑制／通知先の最終調整を行う</li>
      <li>リリース手順書とロールバック手順を読み合わせ、責任分担を明確にする</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="message-square"></i> 課題 2: チームレトロスペクティブ</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      Sprint / 開発期間を振り返り、成功要因と改善点を言語化します。
    </p>
    <ol class="exercise-card__steps">
      <li>KPT や Start/Stop/Continue などのフォーマットでチーム振り返りを実施</li>
      <li>Notion / Confluence に議事録とアクションアイテムをまとめ、担当と期限を決定</li>
      <li>プロジェクトのベストプラクティス／アンチパターンをライブラリ化し、次のプロジェクトに活かす</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="user"></i> 課題 3: 個人振り返りとポートフォリオ更新</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      個人としての成長ポイントを整理し、キャリアやポートフォリオに反映します。
    </p>
    <ol class="exercise-card__steps">
      <li>習得した技術・アウトプット・定量的成果をまとめ、ブログやポートフォリオサイトに掲載</li>
      <li>改善したいスキルセットと次学習計画（中級・上級カリキュラムなど）を TODO 化</li>
      <li>Mentor/仲間からのフィードバックを収集し、今後のアクションへ落とし込む</li>
    </ol>
  </div>
</section>

<section class="exercise-card">
  <h2 class="exercise-card__title"><i data-lucide="gift"></i> 課題 4: 成果発表とナレッジ共有</h2>
  <div class="exercise-card__content">
    <p class="exercise-card__description">
      プロダクトのデモや成果発表を行い、学びをコミュニティへ還元します。
    </p>
    <ol class="exercise-card__steps">
      <li>3〜5 分程度のライトニングトーク資料を作成し、プロダクトのポイントと学びを共有</li>
      <li>GitHub リポジトリの README にデモ動画やプレゼン資料をリンクして公開</li>
      <li>社内外のコミュニティで発表し、フィードバックを Issue として受け付ける仕組みを整備</li>
    </ol>
  </div>
</section>

<section class="exercise-checklist">
  <h2 class="exercise-checklist__title"><i data-lucide="list-check"></i> 提出チェックリスト</h2>
  <ul class="exercise-checklist__list">
    <li>✅ リリース前チェックリストが完了し、手順書とロールバック手順が共有されている</li>
    <li>✅ チームレトロスペクティブの議事録とアクションアイテムが整理されている</li>
    <li>✅ 個人の学びと今後の計画がポートフォリオやブログに反映されている</li>
    <li>✅ 成果発表資料が公開され、ナレッジ共有に貢献できている</li>
  </ul>
</section>

@php
  $lesson15Hints = [
      new \Illuminate\Support\HtmlString('<p>リリースチェックリストは Markdown のチェックボックスを使うと、チームで進捗管理しやすく視覚的にもわかりやすいです。</p>'),
      new \Illuminate\Support\HtmlString('<p>レトロスペクティブでは「事実」「感情」「学び」を分けて書き出すと建設的な議論になりやすくなります。</p>'),
      new \Illuminate\Support\HtmlString('<p>成果発表資料は動画と資料の両方を用意し、共有リンクの権限を All Private Link などに設定しておくと閲覧トラブルを防げます。</p>'),
  ];

  $lesson15Answer = new \Illuminate\Support\HtmlString('<p><strong>解答例:</strong> デプロイ前に本番/ステージングチェックリストを Notion で管理し、CI の最終結果とともに共有。チームレトロスペクティブでは KPT を実施し、Action Item を GitHub Projects に登録。個人振り返りをブログ記事として公開し、ポートフォリオへリンク。最終デモのライトニングトーク資料と動画を README に添付し、社内 Slack のナレッジチャンネルで共有しました。</p>');
@endphp

<x-exercise.reveal id="lesson15-overview" :hints="$lesson15Hints" :answer="$lesson15Answer" />

<footer class="exercise-footer">
  <a class="exercise-footer__link exercise-footer__link--ghost" href="{{ route('lesson14') }}">
    <i data-lucide="arrow-left"></i>
    Lesson 14 に戻る
  </a>
  <a class="exercise-footer__link exercise-footer__link--primary" href="{{ route('laravel-top') }}">
    Laravel TOP に戻る
    <i data-lucide="arrow-up-right"></i>
  </a>
</footer>
