# 1. Installation

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)

## Version Compatibility

| Notify                                                        | Laravel                                                                                                             |
|:--------------------------------------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| ![Notify v1.x][notify_1_x]                                    | ![Laravel v4.2][laravel_4_2]                                                                                        |
| ![Notify v3.2.x][notify_3_2_x]                                | ![Laravel v5.0][laravel_5_0] ![Laravel v5.1][laravel_5_1] ![Laravel v5.2][laravel_5_2] ![Laravel v5.3][laravel_5_3] |
| ![Notify v3.3.x][notify_3_3_x]                                | ![Laravel v5.4][laravel_5_4]                                                                                        |
| ![Notify v3.4.x][notify_3_4_x]                                | ![Laravel v5.5][laravel_5_5]                                                                                        |
| ![Notify v3.5.x][notify_3_5_x]                                | ![Laravel v5.6][laravel_5_6]                                                                                        |
| ![Notify v3.6.x][notify_3_6_x]                                | ![Laravel v5.7][laravel_5_7]                                                                                        |
| ![Notify v3.7.x][notify_3_7_x] ![Notify v4.0.x][notify_4_0_x] | ![Laravel v5.8][laravel_5_8]                                                                                        |
| ![Notify v5.x][notify_5_x]                                    | ![Laravel v6.x][laravel_6_x]                                                                                        |

[laravel_4_2]:  https://img.shields.io/badge/v4.2-supported-brightgreen.svg?style=flat-square "Laravel v4.2"
[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"
[laravel_5_5]:  https://img.shields.io/badge/v5.5-supported-brightgreen.svg?style=flat-square "Laravel v5.5"
[laravel_5_6]:  https://img.shields.io/badge/v5.6-supported-brightgreen.svg?style=flat-square "Laravel v5.6"
[laravel_5_7]:  https://img.shields.io/badge/v5.7-supported-brightgreen.svg?style=flat-square "Laravel v5.7"
[laravel_5_8]:  https://img.shields.io/badge/v5.8-supported-brightgreen.svg?style=flat-square "Laravel v5.8"
[laravel_6_x]:  https://img.shields.io/badge/v6.x-supported-brightgreen.svg?style=flat-square "Laravel v6.x"

[notify_1_x]:   https://img.shields.io/badge/version-1.x-blue.svg?style=flat-square "Notify v1.x"
[notify_3_2_x]: https://img.shields.io/badge/version-3.2.x-blue.svg?style=flat-square "Notify v3.2.x"
[notify_3_3_x]: https://img.shields.io/badge/version-3.3.x-blue.svg?style=flat-square "Notify v3.3.x"
[notify_3_4_x]: https://img.shields.io/badge/version-3.4.x-blue.svg?style=flat-square "Notify v3.4.x"
[notify_3_5_x]: https://img.shields.io/badge/version-3.5.x-blue.svg?style=flat-square "Notify v3.5.x"
[notify_3_6_x]: https://img.shields.io/badge/version-3.6.x-blue.svg?style=flat-square "Notify v3.6.x"
[notify_3_7_x]: https://img.shields.io/badge/version-3.7.x-blue.svg?style=flat-square "Notify v3.7.x"
[notify_4_0_x]: https://img.shields.io/badge/version-4.0.x-blue.svg?style=flat-square "Notify v4.0.x"
[notify_5_x]:   https://img.shields.io/badge/version-5.x-blue.svg?style=flat-square "Notify v5.x"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/notify`.

## Laravel

### Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\Notify\NotifyServiceProvider::class,
],
```

### Artisan commands

To publish the config file, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\Notify\NotifyServiceProvider"
```