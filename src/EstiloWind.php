<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

final class EstiloWind
{
    /** @var array<string,Tailwind> */
    private static array $classes = [];

    /**
     * @param  array<string>  $classes
     */
    public static function define(string $name, array $classes): void
    {
        self::$classes[$name] = new Tailwind($classes);
    }

    public static function forget(string $name): void
    {
        if (! isset(self::$classes[$name])) {
            return;
        }

        unset(self::$classes[$name]);
    }

    public static function has(string $name): bool
    {
        return self::get($name) !== null;
    }

    public static function use(string $name): string
    {
        return self::get($name)?->apply() ?? '';
    }

    private static function get(string $name): ?Tailwind
    {
        return self::$classes[$name] ?? null;
    }
}
