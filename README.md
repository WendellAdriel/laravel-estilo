<div align="center">
    <img src="https://github.com/WendellAdriel/laravel-estilo/raw/main/art/logo.png" alt="Estilo for Laravel" height="300"/>
    <p>
        <h1>Estilo for Laravel</h1>
        Manage your CSS in PHP and easily use it on Blade
    </p>
</div>

<p align="center">
    <a href="https://packagist.org/packages/WendellAdriel/laravel-estilo"><img src="https://img.shields.io/packagist/v/WendellAdriel/laravel-estilo.svg?style=flat-square" alt="Packagist"></a>
    <a href="https://packagist.org/packages/WendellAdriel/laravel-estilo"><img src="https://img.shields.io/packagist/php-v/WendellAdriel/laravel-estilo.svg?style=flat-square" alt="PHP from Packagist"></a>
    <a href="https://packagist.org/packages/WendellAdriel/laravel-estilo"><img src="https://img.shields.io/badge/Laravel-12.x-brightgreen.svg?style=flat-square" alt="Laravel Version"></a>
    <a href="https://github.com/WendellAdriel/laravel-estilo/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/WendellAdriel/laravel-estilo/tests.yml?branch=main&label=Tests"> </a>
</p>

> [!WARNING]  
> This package is not stable yet, and breaking changes can be added even in minor versions before it reaches v1.0.0.
> 
>Check the **[Changelog](CHANGELOG.md)** for breaking changes, features and bug fixes.

## Features

* Create CSS styles in PHP in a fluent way.
* Easily add the CSS styles you want in Blade files with the `@estilo` directive.
* Group styles together with tags and include only the needed ones with `@estilo(['tag_1', 'tag_2'])`.
* The package provides hints for hundreds of CSS properties via the `@method` annotation to help you write your styles.

## Installation

```bash
composer require wendelladriel/laravel-estilo
```

## Defining Styles

Publish the config file:

```bash
php artisan vendor:publish --provider="WendellAdriel\Estilo\Providers\EstiloServiceProvider" --tag=config
```

The config file will be added to `config/estilo.php`.
It might feel quite unusual from the common config files you see.
Instead of returning an array with the values, we have this:

```php
<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

Estilo::define(
    selector: '.main-title',
    css: CSS::make()
        ->color('red')
        ->fontSize('20px'),
    tags: ['common', 'headers'],
);

Estilo::define(
    selector: '#hero-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('30px'),
    tags: ['headers'],
);

Estilo::define(
    selector: 'a',
    css: CSS::make()
        ->color('green')
        ->borderBottom('1px', 'dashed', 'green'),
);

return [];
```

Each time you call `Estilo::define()` you create a style definition. You can use any CSS selector that you would:
classes, tags, ids, etc.

If you need the value to be wrapped in quotes, add double quotes when defining:

```php
Estilo::define(
    selector: 'p',
    css: CSS::make()
        ->fontFamily('"Monaspace Neon", sans-serif'),
    tags: ['typograph'],
```

### Tagging Styles

You can pass a 3rd parameter to the `Estilo::define()` that's an array of tags. This is especially powerful to create
different stylesheets for your application.

## Adding Styles to Blade

When you need to use any CSS generated with **Estilo** in your Blade files, you can use the `@estilo` directive,
by adding it to the `<head>` tag of your page:

This will load ALL the styles created with **Estilo** to your Blade file:

```bladehtml
<head>
    <!-- Other content here -->
    @estilo
</head>
```

This will load the styles tagged with the tags `common` and `typograph`:

```bladehtml
<head>
    <!-- Other content here -->
    @estilo(['common', 'typograph'])
</head>
```

When you add the `@estilo` directive, it will create a `<style>` tag with all the styles that are needed.

For example, this:

```php
Estilo::define(
    selector: '.main-title',
    css: CSS::make()
        ->color('red')
        ->fontSize('20px'),
    tags: ['common', 'headers'],
);

Estilo::define(
    selector: '#hero-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('30px'),
    tags: ['headers'],
);

Estilo::define(
    selector: 'a',
    css: CSS::make()
        ->color('green')
        ->borderBottom('1px', 'dashed', 'green'),
);
```

Will generate this:

```html
<style>
    .main-title { color: red; font-size: 20px; }
    #hero-title { color: blue; font-size: 30px; }
    a { color: green; border-bottom: 1px dashed green; }
</style>
```

## Credits

- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

Check the **[Contributing Guide](CONTRIBUTING.md)**.
