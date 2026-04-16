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
    <a href="https://packagist.org/packages/wendelladriel/laravel-estilo"><img src="https://badge.laravel.cloud/badge/wendelladriel/laravel-estilo" alt="Laravel versions"></a>
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
* TailwindCSS support for creating your own "classes" by grouping TailwindCSS classes.

## Installation

```bash
composer require wendelladriel/laravel-estilo
```

## Config

Publish the config file:

```bash
php artisan vendor:publish --provider="WendellAdriel\Estilo\Providers\EstiloServiceProvider" --tag=config
```

The config file will be added to `config/estilo.php`.
It might feel quite unusual from the common config files you see.

## Styles

**Estilo** lets you define your CSS in PHP, using a fluent builder with autocompletion for hundreds of CSS properties.

### Defining a Style

To define a new style you should use the `Estilo::define()` method inside the `config/estilo.php` file.

```php
Estilo::define(
    selector: '#hero-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('30px'),
    tags: ['headers'],
);
```

Each time you call `Estilo::define()` you create a style definition. You can use any CSS selector that you would:
classes, tags, ids, etc.

If you need the value to be wrapped in quotes, add double quotes when defining.

```php
Estilo::define(
    selector: 'p',
    css: CSS::make()
        ->fontFamily('"Monaspace Neon", sans-serif'),
    tags: ['typograph'],
```

### Checking if a Style exists

To check if a style is already defined you can use the `Estilo::has()` method.

```php
Estilo::has('#hero-title');
```

### Deleting a Style

To delete a style, you can use the `Estilo::forget()` method.

```php
Estilo::forget('#hero-title');
```

### Tagging Styles

You can pass a 3rd parameter to the `Estilo::define()` method that's an array of tags. This is especially powerful to
create different stylesheets for your application.

## Using the Styles in Blade

When you need to use any of the styles generated with **Estilo** in your Blade files, you can use the `@estilo`
directive, by adding it to the `<head>` tag of your page. This will load ALL the styles created with **Estilo** to your
Blade file.

```bladehtml
<head>
    <!-- Other content here -->
    @estilo
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

### Adding only specific Styles

You can use the tags feature to load only specific styles that you want. The example below will load only the styles
tagged with the tags `common` and `typograph`.

```bladehtml
<head>
    <!-- Other content here -->
    @estilo(['common', 'typograph'])
</head>
```

### Using Styles as inline style

You may need or want to use some of the defined styles as inline styles. For that you can use the `estilo()` helper
function. With this you can use any of defined classes, even the ones not loaded with the `@estilo` directive.

```bladehtml
<p style="{{ estilo('a') }}">INLINE STYLE</p>
<!--
This will generate:
<p style="color: green; border-bottom: 1px dashed green;">INLINE STYLE</p>
-->
```

## TailwindCSS support

**Estilo** lets you create "classes" that are groups of other TailwindCSS classes, similar to what you achieve with the
`@apply`. This won't create a CSS class, but will allow you to use it in your Blade files as if it were.

### Defining a Style

To define a new style you should use the `EstiloWind::define()` method inside the `config/estilo.php` file. Each time
you call `EstiloWind::define()` you create a style definition.

```php
EstiloWind::define(
    name: 'feat-text',
    classes: ['text-xl', 'text-amber-500', 'font-bold'],
);
```

### Checking if a Style exists

To check if a style is already defined you can use the `EstiloWind::has()` method.

```php
EstiloWind::has('feat-text');
```

### Deleting a Style

To delete a style, you can use the `EstiloWind::forget()` method.

```php
EstiloWind::forget('feat-text');
```

## Using the Styles in Blade

To use your defined "classes" you can use the `estilowind()` helper function in your HTML class attribute.

```bladehtml
<p class="{{ estilowind('feat-text') }}">Estilo for Laravel</p>
<!--
This will generate:
<p class="text-xl text-amber-500 font-bold">Estilo for Laravel</p>
-->
```

## Credits

- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

Check the **[Contributing Guide](CONTRIBUTING.md)**.
