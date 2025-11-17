<section class="lesson-section lesson-section--form-request">
  <h2 class="lesson-section__title"><i data-lucide="file-check"></i> FormRequest による検証</h2>

  <h3 class="lesson-section__heading">1. FormRequest を作成</h3>
  <pre><code class="language-bash">@verbatim
php artisan make:request StoreFortuneRequest
@endverbatim</code></pre>

  <h3 class="lesson-section__heading">2. ルールとメッセージを定義</h3>
  <pre><code class="language-php">@verbatim
// app/Http/Requests/StoreFortuneRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFortuneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'fortune_type' => 'required|in:daily,weekly,monthly',
            'date' => 'required|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'ユーザーが指定されていません',
            'fortune_type.in' => 'fortune_type は daily / weekly / monthly のみ有効です',
            'date.before_or_equal' => '未来日は指定できません',
        ];
    }
}
@endverbatim</code></pre>

  <div class="lesson-callout">
    <strong>Tip:</strong> 実務ではバリデーションメッセージも i18n 化し、ユーザーに伝わる日本語で表現します。
  </div>
</section>
