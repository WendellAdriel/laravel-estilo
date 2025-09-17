<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo;

use Illuminate\Support\Str;
use WendellAdriel\Estilo\Contracts\Style;

final readonly class Tailwind implements Style
{
    public function __construct(
        /** @var array<string> */
        private array $classes
    ) {}

    public function style(): string
    {
        return '@apply ' . Str::trim(implode(' ', $this->classes)) . ';';
    }
}
