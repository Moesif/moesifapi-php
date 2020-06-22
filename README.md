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


## Create a Single API Event

```php
use Moesif\Sender\MoesifApi;

$reqdate = new DateTime();
$rspdate = new DateTime();

$event= array(
    "request" => array(
        "time" => $reqdate->format(DateTime::ISO8601), 
        "uri" => "https://api.acmeinc.com/items/reviews/", 
        "verb" => "PATCH", 
        "api_version" => "1.1.0", 
        "ip_address" => "61.48.220.123", 
        "headers" => array(
          "Host" => "api.acmeinc.com", 
          "Accept" => "_/_", 
          "Connection" => "Keep-Alive", 
          "User-Agent" => "moesifapi-php/1.1.0",
          "Content-Type" => "application/json", 
          "Content-Length" => "126", 
          "Accept-Encoding" => "gzip"), 
         "body" => array(
          "review_id" => 132232, 
          "item_id" => "ewdcpoijc0", 
          "liked" => false
        )
    ),
    "response" => array(
        "time" => $rspdate->format(DateTime::ISO8601), 
        "status" => 500, 
        "headers" => array(
          "Date" => "Tue, 12 June 2020 23:46:49 GMT", 
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
    ),
    "metadata" => array(
        "foo" => "bar" 
    ),
    "user_id" => "12345",
    "company_id" => "67890",
    "session_token" => "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f"     
);

$apiClient = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
$apiClient->createEvent($event);
```

## Update a Single User

Create or update a user profile in Moesif.
The metadata field can be any customer demographic or other info you want to store.
Only the `user_id` field is required.

```php
use Moesif\Sender\MoesifApi;

// Only userId is required.
// Campaign object is optional, but useful if you want to track ROI of acquisition channels
// See https://www.moesif.com/docs/api#users for campaign schema
// metadata can be any custom object
$user = array(
    "user_id" => "12345",
    "company_id" => "67890", // If set, associate user with a company object
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "email" => "john@acmeinc.com",
        "first_name" => "John",
        "last_name" => "Doe",
        "title" => "Software Engineer",
        "sales_info" => array(
            "stage" => "Customer",
            "lifetime_value" => 24000,
            "account_owner" => "mary@contoso.com"
        )
    )
);

$apiClient = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
$apiClient->updateUser($user);
```


## Update Users in Batch

Similar to update user, but used to update a list of users in one batch. 
Only the `user_id` field is required.

```php
use Moesif\Sender\MoesifApi;

$userA = array(
    "user_id" => "12345",
    "company_id" => "67890", // If set, associate user with a company object
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "email" => "john@acmeinc.com",
        "first_name" => "John",
        "last_name" => "Doe",
        "title" => "Software Engineer",
        "sales_info" => array(
            "stage" => "Customer",
            "lifetime_value" => 24000,
            "account_owner" => "mary@contoso.com"
        )
    )
);

$userB = array(
    "user_id" => "1234",
    "company_id" => "6789", // If set, associate user with a company object
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "email" => "john@acmeinc.com",
        "first_name" => "John",
        "last_name" => "Doe",
        "title" => "Software Engineer",
        "sales_info" => array(
            "stage" => "Customer",
            "lifetime_value" => 24000,
            "account_owner" => "mary@contoso.com"
        )
    )
);

$users = array($userA, $userB);

$apiClient = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
$apiClient->updateUsersBatch($users);
```

## Update a Single Company

Create or update a company profile in Moesif.
The metadata field can be any company demographic or other info you want to store.
Only the `company_id` field is required.

```php
use Moesif\Sender\MoesifApi;

// Only companyId is required.
// Campaign object is optional, but useful if you want to track ROI of acquisition channels
// See https://www.moesif.com/docs/api#update-a-company for campaign schema
// metadata can be any custom object
$company = array(
    "company_id" => "67890",
    "company_domain" => "acmeinc.com", // If domain is set, Moesif will enrich your profiles with publicly available info 
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "org_name" => "Acme, Inc",
        "plan_name" => "Free",
        "deal_stage" => "Lead",
        "mrr" => 24000,
        "demographics" => array(
            "alexa_ranking" => 500000,
            "employee_count" => 47
        )
    )
);

$apiClient = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
$apiClient->updateCompany($company);
```

## Update Companies in Batch

Similar to update company, but used to update a list of companies in one batch. 
Only the `company_id` field is required.

```php
use Moesif\Sender\MoesifApi;

$companyA = array(
    "company_id" => "67890",
    "company_domain" => "acmeinc.com", // If domain is set, Moesif will enrich your profiles with publicly available info 
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "org_name" => "Acme, Inc",
        "plan_name" => "Free",
        "deal_stage" => "Lead",
        "mrr" => 24000,
        "demographics" => array(
            "alexa_ranking" => 500000,
            "employee_count" => 47
        )
    )
);

$companyB = array(
    "company_id" => "6789",
    "company_domain" => "acmeinc.com", // If domain is set, Moesif will enrich your profiles with publicly available info 
    "campaign" => array(
        "utm_source" => "google",
        "utm_medium" => "cpc",
        "utm_campaign" => "adwords",
        "utm_term" => "api+tooling",
        "utm_content" => "landing"
    ),
    "metadata" => array(
        "org_name" => "Acme, Inc",
        "plan_name" => "Free",
        "deal_stage" => "Lead",
        "mrr" => 24000,
        "demographics" => array(
            "alexa_ranking" => 500000,
            "employee_count" => 47
        )
    )
);

$companies = array($companyA, $companyB);

$apiClient = MoesifApi::getInstance("Your Moesif Application Id", ['fork'=>true, 'debug'=>false]);
$apiClient->updateCompaniesBatch($companies);
```

[ico-built-for]: https://img.shields.io/badge/built%20for-php-blue.svg
[ico-version]: https://img.shields.io/packagist/v/moesif/moesifapi-php.svg
[ico-license]: https://img.shields.io/badge/License-Apache%202.0-green.svg
[ico-source]: https://img.shields.io/github/last-commit/moesif/moesifapi-php.svg?style=social

[link-built-for]: http://www.php.net/
[link-package]: https://packagist.org/packages/moesif/moesifapi-php
[link-license]: https://raw.githubusercontent.com/Moesif/moesifapi-php/master/LICENSE
[link-source]: https://github.com/moesif/moesifapi-php
