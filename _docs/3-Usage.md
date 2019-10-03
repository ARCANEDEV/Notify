# 3. Usage

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)

#### Basic Usage

From your application, call the flash method with a message and type.

```php
notify('Welcome back!'); // The default type is 'info'
```

###### OR 

```php
notify('Welcome back!', 'success');
```

###### OR
 
```php
notify()->flash('Welcome back!', 'success');
```

Within a view, you can now check if a flash message exists and output it.

```blade
@if (notify()->isNotEmpty())
    @foreach(notify()->notifications() as $notification)
    <div class="alert-box {{ $notification['type'] }}">
        {{ $notification['message'] }}
    </div>
    @endforeach
@endif
```

> Notify is front-end framework agnostic, so you're free to easily implement the output however you choose (Like Twitter bootstrap, Zurb Foundation, Semantic UI ...).

#### Extra Options

You can pass additional `extra` options to the `flash` method, which are then easily accessible within your view.

```php
notify()->flash("Great to see you again, Bruh!", 'success', [
    'title' => 'Welcome back!',
    'icon'  => 'success-icon',
]);
```

Then, in your view.

```blade
@if (notify()->isNotEmpty())
    @foreach(notify()->notifications() as $notification)
    <div class="alert-box {{ $notification['type'] }}">
        <h5><i class="{{ $notification['extra']['icon'] ?? 'default-icon' }}"></i> {{ $notification['extra']['title'] ?? 'Default Title' }}</h5>  
        <p>{{ $notification['message'] }}</p>
    </div>
    @endforeach
@endif
```
