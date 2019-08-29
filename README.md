# MoesifApi Lib for PHP

[![Built For][ico-built-for]][link-built-for]
[![Latest Version][ico-version]][link-package]
[![Software License][ico-license]][link-license]
[![Source Code][ico-source]][link-source]

[Source Code on GitHub](https://github.com/moesif/moesifapi-nodejs)

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
    use MoesifApi\MoesifApiClient;
    ```
5. Instantiate the client. After this, you can now access the Moesif API and call the
    respective methods:

    ```PHP
    $client = new MoesifApiClient("Your Moesif Application Id");
    $api = $client->getApi();
    ```

Your Moesif Application Id can be found in the [_Moesif Portal_](https://www.moesif.com/).
After signing up for a Moesif account, your Moesif Application Id will be displayed during the onboarding steps. 

You can always find your Moesif Application Id at any time by logging 
into the [_Moesif Portal_](https://www.moesif.com/), click on the top right menu,
 and then clicking _Installation_.

### Create Event

Since this library is primarily a PHP wrapper for an API client, please
[see API docs](https://www.moesif.com/docs/api?int_source=docs#how-to-install)
for details on this API and the required fields.

```PHP

use MoesifApi\MoesifApiClient;

// Instantiate the client. After this, you can now access the Moesif API
// and call the respective methods:

$client = new MoesifApiClient("Your Moesif Application Id");
$api = $client->getApi();

$event = new Models\EventModel();
$reqdate = new DateTime();
$rspdate = new DateTime();

$event->request = array(
       "time" => $reqdate->format(DateTime::ISO8601), 
       "uri" => "https://api.acmeinc.com/items/reviews/", 
       "verb" => "PATCH", 
       "api_version" => "1.1.0", 
       "ip_address" => "61.48.220.123", 
       "headers" => array(
         "Host" => "api.acmeinc.com", 
         "Accept" => "_/_", 
         "Connection" => "Keep-Alive", 
         "User-Agent" => "moesifapi-php/1.1.5",
         "Content-Type" => "application/json", 
         "Content-Length" => "126", 
         "Accept-Encoding" => "gzip"), 
        "body" => array(
          "review_id" => 132232, 
          "item_id" => "ewdcpoijc0", 
          "liked" => false)
        );

 $event->response = array(
           "time" => $rspdate->format(DateTime::ISO8601), 
           "status" => 500, 
           "headers" => array(
             "Date" => "Tue, 12 June 2019 23:46:49 GMT", 
             "Vary" => "Accept-Encoding", 
             "Pragma" => "no-cache", 
             "Expires" => "-1", 
             "Content-Type" => "application/json; charset=utf-8", 
             "X-Powered-By" => "ARR/3.0", 
             "Cache-Control" => "no-cache", 
             "Arr-Disable-Session-Affinity" => "true"), 
             "body" => array(
               "item_id" => "13221", 
               "title" => "Red Brown Chair",
               "description" => "Red brown chair for sale",
               "price" => 22.23
             )
        );
$event->metadata = array(
          "foo" => "bar" 
        );

$event->user_id = "12345";
$event->company_id = "67890";
$event->session_token = "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f";

$api->createEvent($event);

```

Create Events in batch:

```PHP

$event = new Models\EventModel()
$reqdate = new DateTime();
$rspdate = new DateTime();

$event->request = array(
       "time" => $reqdate->format(DateTime::ISO8601), 
       "uri" => "https://api.acmeinc.com/items/reviews/", 
       "verb" => "PATCH", 
       "api_version" => "1.1.0", 
       "ip_address" => "61.48.220.123", 
       "headers" => array(
         "Host" => "api.acmeinc.com", 
         "Accept" => "_/_", 
         "Connection" => "Keep-Alive", 
         "User-Agent" => "moesifapi-php/1.1.5",
         "Content-Type" => "application/json", 
         "Content-Length" => "126", 
         "Accept-Encoding" => "gzip"), 
        "body" => array(
          "review_id" => 132232, 
          "item_id" => "ewdcpoijc0", 
          "liked" => false)
        );

 $event->response = array(
           "time" => $rspdate->format(DateTime::ISO8601), 
           "status" => 500, 
           "headers" => array(
             "Date" => "Tue, 12 June 2019 23:46:49 GMT", 
             "Vary" => "Accept-Encoding", 
             "Pragma" => "no-cache", 
             "Expires" => "-1", 
             "Content-Type" => "application/json; charset=utf-8", 
             "X-Powered-By" => "ARR/3.0", 
             "Cache-Control" => "no-cache", 
             "Arr-Disable-Session-Affinity" => "true"), 
             "body" => array(
               "item_id" => "13221", 
               "title" => "Red Brown Chair",
               "description" => "Red brown chair for sale",
               "price" => 22.23
             )
        );
$event->metadata = array(
          "foo" => "bar" 
        );

$event->user_id = "12345";
$event->company_id = "67890";
$event->session_token = "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f";

// creating a batch of events.
$api->createEventsBatch(array($event, $event));

```

### Update User

Besides sending events, you can use update a user profile using this library.

```PHP
use MoesifApi\MoesifApiClient;
$client = new MoesifApiClient("Your Moesif Application Id");
$api = $client->getApi();

$user = new Models\UserModel();

$user->userId = "12345";
$user->companyId = "67890";
$user->metadata = [
  "email" => "johndoe@acmeinc.com",
  "name" => "John Doe",
  "first_name" => "John"
  "phone" => "1234567890"
];

$api->updateUser($user);
```

### Update Company

Besides saving user profile, you can also create company or account profiles using this library.

```PHP
use MoesifApi\MoesifApiClient;
$client = new MoesifApiClient("Your Moesif Application Id");
$api = $client->getApi();

$company = new Models\CompanyModel();

$company->companyId = "12345";
$company->metadata = [
  "company_name" => "Acme, Inc"
  "company_domain" => "www.acmeinc.com"
  "akexa_ranking" => 500000,
  "plan_mrr" => 1000
];

$api->updateCompany($company);
```

## How To Test:

Unit tests in this SDK can be run using PHPUnit.

1. First install the dependencies using composer including the `require-dev` dependencies.
2. Add your applicationId to the `tests\Controllers\ApiControllerTest.php` file.
3. Run `vendor/bin/phpunit --verbose` from commandline to execute tests. If you have
   installed PHPUnit globally, run tests using `phpunit --verbose` instead.

You can change the PHPUnit test configuration in the `phpunit.xml` file.

[ico-built-for]: https://img.shields.io/badge/built%20for-php-blue.svg
[ico-version]: https://img.shields.io/packagist/v/moesif/moesifapi-php.svg
[ico-license]: https://img.shields.io/badge/License-Apache%202.0-green.svg
[ico-source]: https://img.shields.io/github/last-commit/moesif/moesifapi-php.svg?style=social

[link-built-for]: http://www.php.net/
[link-package]: https://packagist.org/packages/moesif/moesifapi-php
[link-license]: https://raw.githubusercontent.com/Moesif/moesifapi-php/master/LICENSE
[link-source]: https://github.com/moesif/moesifapi-php
