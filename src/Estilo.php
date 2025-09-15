<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

final class Estilo
{
    /** @var array<string,CSS> */
    private static array $styles = [];

    /** @var array<string,array<string>> */
    private static array $tagged = [];

    /**
     * @param  array<string>  $tags
     */
    public static function define(string $name, CSS $css, array $tags = []): void
    {
        self::$styles[$name] = $css;

        foreach ($tags as $tag) {
            self::$tagged[$tag][$name] = true;
        }
    }

    public static function forget(string $name): void
    {
        if (! isset(self::$styles[$name])) {
            return;
        }

        unset(self::$styles[$name]);

        foreach (self::$tagged as &$tagList) {
            unset($tagList[$name]);
        }
    }

    /**
     * @param  array<string>  $tags
     * @return array<string,CSS>
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

        return $result;
    }

    /**
     * @return array<string,CSS>
     */
    public static function styles(): array
    {
        return self::$styles;
    }

    public static function style(string $name): ?CSS
    {
        return self::$styles[$name] ?? null;
    }

    public static function styleText(string $name): ?string
    {
        return self::style($name)?->style();
    }
}
