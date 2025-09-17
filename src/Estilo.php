<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

use WendellAdriel\Estilo\Contracts\Style;

final class Estilo
{
    /** @var array<string,Style> */
    private static array $styles = [];

    /** @var array<string,array<string>> */
    private static array $tagged = [];

    /**
     * @param  array<string>  $tags
     */
    public static function define(string $selector, Style $style, array $tags = []): void
    {
        self::$styles[$selector] = $style;

        foreach ($tags as $tag) {
            self::$tagged[$tag][$selector] = true;
        }
    }

    public static function forget(string $selector): void
    {
        if (! isset(self::$styles[$selector])) {
            return;
        }

        unset(self::$styles[$selector]);

        foreach (self::$tagged as &$tagList) {
            unset($tagList[$selector]);
        }
    }

    /**
     * @param  array<string>  $tags
     * @return array<string>
     */
    public static function tagged(array $tags): array
    {
        $result = [];

        foreach ($tags as $tag) {
            if (! isset(self::$tagged[$tag])) {
                continue;
            }
            $result = [
                ...$result,
                ...self::$tagged[$tag],
            ];
        }

        return array_keys($result);
    }

    /**
     * @return array<string,Style>
     */
    public static function styles(): array
    {
        return self::$styles;
    }

    public static function style(string $selector): ?Style
    {
        return self::$styles[$selector] ?? null;
    }

    public static function styleText(string $selector): ?string
    {
        return self::style($selector)?->style();
    }

    public static function styleSheet(array $tags = []): string
    {
        $selectedStyles = collect(self::$styles);
        if ($tags !== []) {
            $selectedStyles = $selectedStyles->only(self::tagged($tags));
        }

        $result = "<style>\n";

        $result = $selectedStyles->reduce(
            callback: fn (string $result, Style $style, string $selector) => "{$result}\t{$selector} { {$style->style()} }\n",
            initial: $result,
        );

        return "{$result}</style>";
    }
}
