Notify - Notification Helper [![Packagist License](http://img.shields.io/packagist/l/arcanedev/notify.svg?style=flat-square)](https://github.com/ARCANEDEV/Stripe/blob/master/LICENSE)
==============
[![Travis Status](http://img.shields.io/travis/ARCANEDEV/Notify.svg?style=flat-square)](https://travis-ci.org/ARCANEDEV/Notify)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/ARCANEDEV/Notify.svg?style=flat-square)](https://scrutinizer-ci.com/g/ARCANEDEV/Notify/?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ARCANEDEV/Notify.svg?style=flat-square)](https://scrutinizer-ci.com/g/ARCANEDEV/Notify/?branch=master)
[![Github Release](http://img.shields.io/github/release/ARCANEDEV/Notify.svg?style=flat-square)](https://github.com/ARCANEDEV/Notify/releases)
[![Packagist Downloads](https://img.shields.io/packagist/dt/arcanedev/notify.svg?style=flat-square)](https://packagist.org/packages/arcanedev/notify)
[![Github Issues](http://img.shields.io/github/issues/ARCANEDEV/Notify.svg?style=flat-square)](https://github.com/ARCANEDEV/Notify/issues)

*By [ARCANEDEV&copy;](http://www.arcanedev.net/)*

### Requirements
    
    - PHP >= 5.4.0
    
## INSTALLATION

### Composer

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json` :

```json
{
    "require": {
        "arcanedev/notify": "~1.0"
    }
}
```

Then install it via `composer install` or `composer update`.

### Laravel

include the service provider within `app/config/app.php`.

```php
'providers' => [
    'Arcanedev\Notify\Laravel\ServiceProvider'
];
```

And add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Notify' => 'Arcanedev\Notify\Laravel\Facade'
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

  - `notifyer.message`: The message you're flashing
  - `notifyer.level`: A string that represents the type of notification (good for applying HTML class names)

Alternatively, again, if you're using Laravel, you may reference the `flash()` helper function, instead of the facade.

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

    flash()->success('You have been logged out.');

    return home();
}
```

Or, for a general information flash, just do: `flash('Some message');`.

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (Session::has('notifyer.message'))
    <div class="alert alert-{{ Session::get('notifyer.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('notifyer.message') }}
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

  - [ ] Documentation
  - [ ] Examples
  - [x] Bootstrap 3 support
  - [ ] Zurb Foundation 5 support
  - [x] Laravel 4 support 
  - [ ] Laravel 5 support 
  - [ ] Refactoring
