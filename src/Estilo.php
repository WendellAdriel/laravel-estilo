<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

final class Estilo
{
    /** @var array<string,CSS> */
    private static array $classes = [];

    public static function define(string $name, CSS $class): void
    {
        self::$classes[$name] = $class;
    }

    public static function style(string $name): ?string
    {
        $class = self::$classes[$name] ?? null;

        return $class?->style();
    }
}
