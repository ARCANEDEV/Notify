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
@if (notify()->ready())
    <div class="alert-box {{ notify()->type() }}">
        {{ notify()->message() }}
    </div>
@endif
```

> Notify is front-end framework agnostic, so you're free to easily implement the output however you choose (Like Twitter bootstrap, Zurb Foundation, Semantic UI ...).

#### Options

You can pass additional `options` to the `flash` method, which are then easily accessible within your view.

```php
notify()->flash("Great to see you again, Bruh!", 'success', [
    'title' => 'Welcome back!',
    'timer' => 5000,
]);
```

Then, in your view.

```blade
@if (notify()->ready())
    <script>
        swal({
            text:  "{{ notify()->message() }}",
            type:  "{{ notify()->type() }}",
            title: "{{ notify()->option('title') }}",
            timer: {{ notify()->option('timer') }}   
        });
    </script>
@endif
```

You can also check if an `option` exists or not like this:

```blade
@if (notify()->ready())
    <script>
        swal({
            text:  "{{ notify()->message() }}",
            type:  "{{ notify()->type() }}",
            @if (notify()->hasOption('title'))
                title: "{{ notify()->option('title') }}",
            @endif
            @if (notify()->hasOption('timer'))
                timer: {{ notify()->option('timer') }}
            @endif
        });
    </script>
@endif
```

> The above example uses [SweetAlert](http://t4t5.github.io/sweetalert/), but the flexibily of Notify means you can easily use it with any JavaScript alert solution (For example [toastr](https://github.com/CodeSeven/toastr)).
