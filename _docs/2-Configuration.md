# 2. Configuration

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)

After you've published the config file `config/notify.php`, you can customize the settings :

```php
<?php

return [

    /* -----------------------------------------------------------------
     |  Default Store
     | -----------------------------------------------------------------
     */

    'default' => 'session',

    /* -----------------------------------------------------------------
     |  Supported Stores
     | -----------------------------------------------------------------
     */

    'stores'  => [

        'session' => [
            'driver'  => Arcanedev\Notify\Stores\SessionStore::class,
            'options' => [
                'key' => 'notifications'
            ],
        ],

    ],

];
```

You can create you own store like `database` or `redis` store for your notifications.
