<?php

declare(strict_types=1);

use WendellAdriel\Estilo\Tailwind;

test('it generates single Tailwind definition', function () {
    $class = new Tailwind(['text-xl']);

    $this->assertSame('text-xl', $class->apply());
});

test('it generates multiple CSS properties correctly', function () {
    $class = new Tailwind(['text-xl', 'text-orange-500']);

    $this->assertSame('text-xl text-orange-500', $class->apply());
});
