# Notify [![Packagist License][badge_license]](LICENSE.md) [![For Laravel 5][badge_laravel]](https://github.com/ARCANEDEV/Notify)

[![Travis Status][badge_build]](https://travis-ci.org/ARCANEDEV/Notify)
[![HHVM Status][badge_hhvm]](http://hhvm.h4cc.de/package/arcanedev/notify)
[![Coverage Status][badge_coverage]](https://scrutinizer-ci.com/g/ARCANEDEV/Notify/?branch=master)
[![Scrutinizer Code Quality][badge_quality]](https://scrutinizer-ci.com/g/ARCANEDEV/Notify/?branch=master)
[![SensioLabs Insight][badge_insight]](https://insight.sensiolabs.com/projects/fd28f55f-20e1-48d2-aa63-18a0857d4fae)
[![Github Issues][badge_issues]](https://github.com/ARCANEDEV/Notify/issues)

[![Packagist][badge_package]](https://packagist.org/packages/arcanedev/notify)
[![Packagist Release][badge_release]](https://packagist.org/packages/arcanedev/notify)
[![Packagist Downloads][badge_downloads]](https://packagist.org/packages/arcanedev/notify)

[badge_license]:   http://img.shields.io/packagist/l/arcanedev/notify.svg?style=flat-square
[badge_laravel]:   https://img.shields.io/badge/For%20Laravel-5.x-orange.svg?style=flat-square

[badge_build]:     http://img.shields.io/travis/ARCANEDEV/Notify.svg?style=flat-square
[badge_hhvm]:      https://img.shields.io/hhvm/arcanedev/notify.svg?style=flat-square
[badge_coverage]:  https://img.shields.io/scrutinizer/coverage/g/ARCANEDEV/Notify.svg?style=flat-square
[badge_quality]:   https://img.shields.io/scrutinizer/g/ARCANEDEV/Notify.svg?style=flat-square
[badge_insight]:   https://img.shields.io/sensiolabs/i/fd28f55f-20e1-48d2-aa63-18a0857d4fae.svg?style=flat-square
[badge_issues]:    http://img.shields.io/github/issues/ARCANEDEV/Notify.svg?style=flat-square

[badge_package]:   https://img.shields.io/badge/package-arcanedev/notify-blue.svg?style=flat-square
[badge_release]:   https://img.shields.io/packagist/v/arcanedev/notify.svg?style=flat-square
[badge_downloads]: https://img.shields.io/packagist/dt/arcanedev/notify.svg?style=flat-square

*By [ARCANEDEV&copy;](http://www.arcanedev.net/)*

Flexible flash notifications helper for Laravel 5. 

Feel free to check out the [releases](https://github.com/ARCANEDEV/Notify/releases), [license](LICENSE.md), and [contribution guidelines](CONTRIBUTING.md).

### Requirements
    
    - PHP >= 5.5.9
    
## INSTALLATION

### Composer

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json` :

```json
{
    "require": {
        "arcanedev/notify": "~2.0"
    }
}
```

Then install it via `composer install` or `composer update`.

### Laravel

include the service provider within `config/app.php`.

```php
'providers' => [
    Arcanedev\Notify\NotifyServiceProvider::class
];
```

And add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Notify' => Arcanedev\Notify\Facades\Notify::class
];
```

## USAGE

Within your controllers, before you perform a redirect...

```php
public function store()
{
    Notify::message('Welcome !');

    return Redirect::home();
}
```

You may also do:

```php
// Info alert notification
Notify::info('Message')

// Success alert notification
Notify::success('Message')

// Danger alert notification
Notify::error('Message')

// Warning alert notification
Notify::warning('Message')

// Modal notification
Notify::overlay('Modal Message', 'Modal Title')
```

Again, if using Laravel, this will set a few keys in the session :

  - `notifier.message`: The message you're flashing
  - `notifier.level`: A string that represents the type of notification (good for applying HTML class names)

Alternatively, again, if you're using Laravel, you may reference the `notify()` helper function, instead of the facade.

Here's an example:

```php
/**
 * Destroy the user's session (logout).
 *
 * @return Response
 */
public function destroy()
{
    Auth::logout();

    notify()->success('You have been logged out.');

    return home();
}
```

Or, for a general information flash, just do: `notify('Some message');`.

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (Session::has('notifier.message'))
    <div class="alert alert-{{ Session::get('notifier.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('notifier.message') }}
    </div>
@endif
```

> Note that this package is optimized for use with Twitter Bootstrap.

Because flash messages and overlays are so common, if you want, you may use (or modify) the views that are included with this package.

Simply append to your layout view:

```html
@include('notify::message')
```

### TODOS:

  - [ ] Complete Documentation
  - [ ] Examples
  - [ ] Zurb Foundation 5 support 
  - [ ] Laravel 5.0 support
  - [ ] Refactoring

### DONE:
  - [x] Laravel 4.2 support
  - [x] Laravel 5.1 support
  - [x] Bootstrap 3 supported
  
## Contribution

Any ideas are welcome. Feel free to submit any issues or pull requests, please check the [contribution guidelines](CONTRIBUTING.md).
