# MoesifApi Lib for PHP

[![Built For][ico-built-for]][link-built-for]
[![Latest Version][ico-version]][link-package]
[![Software License][ico-license]][link-license]
[![Source Code][ico-source]][link-source]

[Source Code on GitHub](https://github.com/moesif/moesifapi-php)

__Check out Moesif's [Developer Documentation](https://www.moesif.com/docs) and [PHP API Reference](https://www.moesif.com/docs/api?php) to learn more__


## How To Install

Install via Composer

```shell
composer require moesif/moesifapi-php
```

## How To Use:

For using this SDK do the following:

1. Use Composer to install the dependencies. See the section "How To Build".
2. See that you have configured your SDK correctly. See the section "How To Configure".
3. Depending on your project setup, you might need to include composer's autoloader
   in your PHP code to enable autoloading of classes.

   ```PHP
   require_once "vendor/autoload.php";
   ```
4. Import the SDK client in your project:

    ```PHP
    use Moesif\Sender\MoesifApi;
    ```
5. Instantiate the client. After this, you can now access the Moesif API and call the
    respective methods:

    ```PHP
    $client = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
    ```

Your Moesif Application Id can be found in the [_Moesif Portal_](https://www.moesif.com/).
After signing up for a Moesif account, your Moesif Application Id will be displayed during the onboarding steps. 

You can always find your Moesif Application Id at any time by logging 
into the [_Moesif Portal_](https://www.moesif.com/), click on the top right menu,
 and then clicking _Installation_.


[ico-built-for]: https://img.shields.io/badge/built%20for-php-blue.svg
[ico-version]: https://img.shields.io/packagist/v/moesif/moesifapi-php.svg
[ico-license]: https://img.shields.io/badge/License-Apache%202.0-green.svg
[ico-source]: https://img.shields.io/github/last-commit/moesif/moesifapi-php.svg?style=social

[link-built-for]: http://www.php.net/
[link-package]: https://packagist.org/packages/moesif/moesifapi-php
[link-license]: https://raw.githubusercontent.com/Moesif/moesifapi-php/master/LICENSE
[link-source]: https://github.com/moesif/moesifapi-php
