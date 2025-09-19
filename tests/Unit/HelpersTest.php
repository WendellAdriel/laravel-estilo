<?php

declare(strict_types=1);

test('estilo helper outputs raw style', function () {
    expect(estilo('body'))->toBe('padding: 10px;');
});

test('estilowind helper outputs tailwind classes', function () {
    expect(estilowind('feat-text'))->toBe('text-xl text-amber-500 font-bold');
});
