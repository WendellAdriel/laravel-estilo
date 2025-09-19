<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

use Illuminate\Support\Str;

final readonly class Tailwind
{
    public function __construct(
        /** @var array<string> */
        private array $classes
    ) {}

    public function apply(): string
    {
        return Str::trim(implode(' ', $this->classes));
    }
}
