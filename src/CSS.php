<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

use Illuminate\Support\Str;

final class CSS
{
    /** @var array<string,string> */
    private array $properties;

    public function __call(string $name, array $arguments): CSS
    {
        $propertyName = Str::kebab($name);
        $propertyValue = implode(' ', $arguments);

        $this->properties[$propertyName] = $propertyValue;

        return $this;
    }

    public static function make(): CSS
    {
        $class = new self();
        $class->properties = [];

        return $class;
    }

    public function style(): string
    {
        return Str::trim(collect($this->properties)->reduce(
            callback: fn (string $style, string $propertyValue, string $propertyName) => "{$style}{$propertyName}: {$propertyValue}; ",
            initial: '',
        ));
    }
}
