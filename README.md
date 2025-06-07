# twig

A very thin module for integrate Twig templates into other modules.

## Installation

You can require it directly with Composer:

```bash
composer require jdwx/web-twig
```

Or download the source from GitHub: https://github.com/jdwx/web-twig.git

## Requirements

This module requires PHP 8.3 and Twig 3.0 or later.

## Usage

This module provides a simple interface for integrating Twig templates into panels and pages interfaces provided by the jdwx/panels and jdwx/web-php modules. The AbstractPage class can be subclassed to provide values when the template is rendered. The StaticPage class allows values to be provided when the page is instantiated. The MapPage class binds a Map that can be updated at any time.

You can also use subclasses to avoid repetitive code. For example, if you have all of your error page templates in one directory, you can create a subclass like this:

```php
class ErrorPage extends StaticPage {


    /** @param array<string, mixed> $i_rValues */
    public function __construct( string $name, array $i_rValues = [] ) {
        # Give it the path to your error templates.
        $env = TwigHelper::forDirectory( __DIR__ . '/templates/' );
        parent::__construct( $env, $name, $i_rValues );
    }


    /** @param array<string, mixed> $i_rValues */
    public static function get( string $name, array $i_rValues = [] ) : string {
        return ( new self( $name, $i_rValues ) )->render();
    }


}
```

Then displaying errors is very straightforward:

```php
echo ErrorPage::get( 'error404', [ 'return_url' => '/' ] ), "\n\n";
```

## Stability

This module is relatively new and has not been extensively deployed in production yet, but the interface should be relatively stable. There's really not a lot to it; this module exists mainly to keep from introducing Twig as a dependency where it's not needed.

## History

This module was loosely adapted from an existing codebase in early 2025.
