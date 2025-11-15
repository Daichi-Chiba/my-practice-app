<?php

namespace App\Support;

use Illuminate\Support\Str;

class LessonHeroExtractor
{
    /** @var array<string, array|null> */
    private static array $cache = [];

    public static function extract(?string $lessonNumber): ?array
    {
        if (is_null($lessonNumber) || $lessonNumber === '') {
            return null;
        }

        $normalized = static::normalizeNumber($lessonNumber);

        if (array_key_exists($normalized, self::$cache)) {
            return self::$cache[$normalized];
        }

        $path = resource_path('views/lessons/partials/lesson' . $normalized . '/01-hero.blade.php');
        if (!is_file($path)) {
            return self::$cache[$normalized] = null;
        }

        $contents = file_get_contents($path);
        if ($contents === false) {
            return self::$cache[$normalized] = null;
        }

        $title = static::matchSingle($contents, '/<h1[^>]*class="[^"]*lesson__title[^"]*"[^>]*>(.*?)<\/h1>/si');
        $subtitle = static::matchSingle($contents, '/<p[^>]*class="[^"]*lesson__subtitle[^"]*"[^>]*>(.*?)<\/p>/si');

        $metaItems = static::matchAll($contents, '/<div[^>]*class="[^"]*lesson__meta-item[^"]*"[^>]*>.*?<span[^>]*>(.*?)<\/span>.*?<\/div>/si');
        $tags = static::matchAll($contents, '/<li[^>]*class="[^"]*lesson-tags__item[^"]*"[^>]*>(.*?)<\/li>/si');

        $metaItems = array_map([static::class, 'cleanText'], $metaItems);
        $tags = array_map([static::class, 'cleanText'], $tags);

        return self::$cache[$normalized] = [
            'number' => $normalized,
            'title' => static::cleanText($title),
            'subtitle' => static::cleanText($subtitle),
            'meta' => array_values(array_filter($metaItems, fn ($item) => $item !== '')),
            'tags' => array_values(array_filter($tags, fn ($item) => $item !== '')),
        ];
    }

    private static function normalizeNumber(string $number): string
    {
        $number = trim($number);
        $digits = preg_replace('/\D+/', '', $number);

        if ($digits === '' && $number !== '') {
            $digits = $number;
        }

        return str_pad((string) $digits, 2, '0', STR_PAD_LEFT);
    }

    private static function matchSingle(string $contents, string $pattern): ?string
    {
        return preg_match($pattern, $contents, $matches) ? $matches[1] : null;
    }

    /**
     * @return array<int, string>
     */
    private static function matchAll(string $contents, string $pattern): array
    {
        preg_match_all($pattern, $contents, $matches);

        return $matches[1] ?? [];
    }

    private static function cleanText(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        $value = strip_tags($value);
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return trim($value);
    }
}
