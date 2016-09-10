# 3. Configuration

## Table of contents

0. [Home](0-Home.md)
1. [Requirements](1-Requirements.md)
2. [Installation and Setup](2-Installation-and-Setup.md)
3. [Configuration](3-Configuration.md)
4. [Usage](4-Usage.md)

After you've published the config file `config/notify.php`, you can customize the settings :

```php
return [
    /* ------------------------------------------------------------------------------------------------
     |  Session
     | ------------------------------------------------------------------------------------------------
     */
    'session' => [
        'prefix' => 'notifier'
    ],
];
```

The `prefix` value is the session prefix name for all your flash notifications.
