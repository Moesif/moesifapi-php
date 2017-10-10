<?php
/*
 * MoesifApi
 *
 */

use MoesifApi\APIException;
use MoesifApi\Exceptions;
use MoesifApi\APIHelper;
use MoesifApi\Models;

class ApiControllerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \MoesifApi\Controllers\ApiController Controller instance
     */
    protected static $controller;

    /**
     * @var HttpCallBackCatcher Callback
     */
    protected $httpResponse;

    /**
     * Setup test class
     */
    public static function setUpBeforeClass()
    {
        $client = new MoesifApi\MoesifApiClient("eyJhcHAiOiI5NDo2IiwidmVyIjoiMi4wIiwib3JnIjoiODg6NSIsImlhdCI6MTUwNzU5MzYwMH0.fGZydPfBh-FjMN_Op8Uab7kphbqb0PsytYPtJLqzd20");
        self::$controller = $client->getApi();
    }

    /**
     * Setup test
     */
    protected function setUp()
    {
        $this->httpResponse = new HttpCallBackCatcher();
    }

    /**
     * Add Single Event via Injestion API
     */
    public function testAddEvent() {
        // Parameters for the API call
        $body = APIHelper::deserialize('{ 					"request": { 						"time": "2016-09-09T04:45:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:45:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f", "metadata": { "foo": "bar" } 					 }', new Models\EventModel());

        $reqdate = new DateTime();
        $body->request->time = $reqdate->format(DateTime::ISO8601);
        $rspdate = (new DateTime())->add(new DateInterval('PT2S'));
        $body->response->time = $rspdate->format(DateTime::ISO8601);

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
        self::$controller->createEvent($body);
        } catch(APIException $e) {};

        // Test response code
        $this->assertEquals(201, $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201");

    }

    /**
     * Add Batched Events via Ingestion API
     */
    public function testAddBatchedEvents() {
        // Parameters for the API call
        $body = APIHelper::deserialize('[{ 					"request": { 						"time": "2016-09-09T04:45:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:45:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f" 					 }, { 					"request": { 						"time": "2016-09-09T04:46:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:46:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f" 					 }, { 					"request": { 						"time": "2016-09-09T04:47:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:47:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f" 					 }, { 					"request": { 						"time": "2016-09-09T04:48:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:48:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "exfzweachxjgznvKUYrxFcxv]s98y18cx98q3yhwmnhcfx43f" 					 }, { 					"request": { 						"time": "2016-09-09T04:49:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:49:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f" 					 }, { 					"request": { 						"time": "2016-09-09T04:50:42.914", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:50:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "recvreedfef", 					"session_token": "xcvkrjmcfghwuignrmcmhxdhaaezse4w]s98y18cx98q3yhwmnhcfx43f" 					 } ]', new Models\EventModel(), true);


        foreach($body as &$value) {
          $reqdate = new DateTime();
          $value->request->time = $reqdate->format(DateTime::ISO8601);
          $rspdate = (new DateTime())->add(new DateInterval('PT1S'));
          $value->response->time = $rspdate->format(DateTime::ISO8601);
          $value->metadata = APIHelper::deserialize('{ "foo" : "abc", "bar": "123" }');
        }
        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
        self::$controller->createEventsBatch($body);
        } catch(APIException $e) {};

        // Test response code
        $this->assertEquals(201, $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201");

    }

    /**
     * Update Single User via Injestion API
     */
    public function testUpdateUser() {
        // Parameters for the API call
        $body = APIHelper::deserialize('{ 					"request": { 						"user_id": "moesifphpuser", 						"uri": "https://api.acmeinc.com/items/reviews/", 						"verb": "PATCH", 						"api_version": "1.1.0", 						"ip_address": "61.48.220.123", 						"headers": { 							"Host": "api.acmeinc.com", 							"Accept": "*/*", 							"Connection": "Keep-Alive", 							"User-Agent": "Dalvik/2.1.0 (Linux; U; Android 5.0.2; C6906 Build/14.5.A.0.242)", 							"Content-Type": "application/json", 							"Content-Length": "126", 							"Accept-Encoding": "gzip" 						}, 						"body": { 							"items": [ 								{ 									"direction_type": 1, 									"discovery_id": "fwfrf", 									"liked": false 								}, 								{ 									"direction_type": 2, 									"discovery_id": "d43d3f", 									"liked": true 								} 							] 						} 					}, 					"response": { 						"time": "2016-09-09T04:45:42.914", 						"status": 500, 						"headers": { 							"Date": "Tue, 23 Aug 2016 23:46:49 GMT", 							"Vary": "Accept-Encoding", 							"Pragma": "no-cache", 							"Expires": "-1", 							"Content-Type": "application/json; charset=utf-8", 							"X-Powered-By": "ARR/3.0", 							"Cache-Control": "no-cache", 							"Arr-Disable-Session-Affinity": "true" 						}, 						"body": { 							"Error": "InvalidArgumentException", 							"Message": "Missing field field_a" 						} 					}, 					"user_id": "mndug437f43", 					"session_token": "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ng]s98y18cx98q3yhwmnhcfx43f" 					 }', new Models\UserModel());

        $user = new Models\UserModel();

        $user->userId = "moesifphpuser2";
        $user->metadata = [
          "email" => "moesifphp2@email.com",
          "name" => "moesif php2",
          "custom" => "randomdata2"
        ];

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
        self::$controller->updateUser($user);
        } catch(APIException $e) {};

        // Test response code
        $this->assertEquals(201, $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201");
    }

}
