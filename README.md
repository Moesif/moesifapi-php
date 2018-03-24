# MoesifApi Lib for PHP

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
    $client = new MoesifApiClient("Your application Id");
    $api = $client->getApi();
    ```

### createEvent


Since this library is primarily a PHP wrapper for an API client, please
[see API docs](https://www.moesif.com/docs/api?int_source=docs#how-to-install)
for details on this API and the required fields.

```PHP

use MoesifApi\Models;

$event = APIHelper::deserialize('{ "request": { "time": "2016-09-09T04:45:42.914", "uri": "<https://api.acmeinc.com/items/reviews/>", "verb": "PATCH", "api_version": "1.1.0", "ip_address": "61.48.220.123", "headers": { "Host": "api.acmeinc.com", "Accept": "_/_", "Connection": "Keep-Alive", "User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", "Content-Type": "application/json", "Content-Length": "126", "Accept-Encoding": "gzip" }, "body": { "items": [ { "direction_type": 1, "discovery_id": "fwfrf", "liked": false }, { "direction_type": 2, "discovery_id": "d43d3f", "liked": true } ] } }, "response": { "time": "2016-09-09T04:45:42.914", "status": 500, "headers": { "Date": "Tue, 23 Aug 2016 23:46:49 GMT", "Vary": "Accept-Encoding", "Pragma": "no-cache", "Expires": "-1", "Content-Type": "application/json; charset=utf-8", "X-Powered-By": "ARR/3.0", "Cache-Control": "no-cache", "Arr-Disable-Session-Affinity": "true" }, "body": { "Error": "InvalidArgumentException", "Message": "Missing field field_a" } }, "user_id": "mndug437f43", "session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f", "metadata": { "foo": "bar" } }', new Models\EventModel());

// Note: If the request.time is in the past, it can only be backdated up to 7 days.

$reqdate = new DateTime();
$event->request->time = $reqdate->format(DateTime::ISO8601);
$rspdate = new DateTime();
$event->response->time = $rspdate->format(DateTime::ISO8601);

$api->createEvent($event);

```

Create Events in batch:

```PHP

  // constructing an example EventModel directly.
  $event1 = new Models\EventModel();
  $reqdate1 = new DateTime();
  $event1->request = new Models\EventRequestModel();
  $event1->request->time = $reqdate1->format(DateTime::ISO8601);
  $event1->request->uri = 'https://testbatch.com/batch/1';
  $event1->request->verb = 'GET';
  $event1->request->headers = array("reqheader1"=>"value1");
  $event1->response = new Models\EventResponseModel();
  $rspdate1 = (new DateTime())->add(new DateInterval('PT1S'));
  $event1->response->time = $rspdate1->format(DateTime::ISO8601);
  $event1->response->headers = array("header1"=>"value1");
  $event1->response->status = 200;
  $event1->response->body = array("bodyfield1"=>"bodyvalue1");

  $event2 = new Models\EventModel();
  $reqdate2 = new DateTime();
  $event2->request = new Models\EventRequestModel();
  $event2->request->time = $reqdate2->format(DateTime::ISO8601);
  $event2->request->headers = array("reqheader2"=>"value2");
  $event2->request->uri = 'https://testbatch.com/batch/2';
  $event2->request->verb = 'GET';
  $event2->response = new Models\EventResponseModel();
  $rspdate2 = (new DateTime())->add(new DateInterval('PT2S'));
  $event2->response->time = $rspdate2->format(DateTime::ISO8601);
  $event2->response->headers = array("header2"=>"value1");
  $event2->response->status = 200;
  $event2->response->body = array("bodyfield2"=>"bodyvalue1");


  // creating a batch of events.
  $api->createEventsBatch(array($event1, $event2));

```

### updateUser

Besides sending events, you can use update a user profile using this library.

```PHP
$user = new Models\UserModel();

$user->userId = "moesifphpuser";
$user->metadata = [
  "email" => "moesifphp@email.com",
  "name" => "moesif php",
  "custom" => "randomdata"
];

$api->updateUser($user);

```

## How To Test:

Unit tests in this SDK can be run using PHPUnit.

1. First install the dependencies using composer including the `require-dev` dependencies.
2. Add your applicationId to the `tests\Controllers\ApiControllerTest.php` file.
3. Run `vendor\bin\phpunit --verbose` from commandline to execute tests. If you have
   installed PHPUnit globally, run tests using `phpunit --verbose` instead.

You can change the PHPUnit test configuration in the `phpunit.xml` file.
