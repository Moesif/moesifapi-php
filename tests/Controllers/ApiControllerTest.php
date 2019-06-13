<?php
/*
 * MoesifApi
 *
 */

use MoesifApi\APIException;
use MoesifApi\Exceptions;
use MoesifApi\APIHelper;
use MoesifApi\Models;

class ApiControllerTest extends PHPUnit_Framework_TestCase
{

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
        $client = new MoesifApi\MoesifApiClient("your application id (obtained from your moesif account)");
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
    public function testAddEvent()
    {
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
                    ), 
                    "user_id" => "mndug437f43", 
                    "session_token" => "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f"
                );
        $event->metadata = array(
                "foo" => "bar" 
                );

        $event->user_id = "12345";
        $event->company_id = "5678";
        $event->session_token = "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f";

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createEvent($event);
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            201,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201"
        );
    }

    /**
     * Add Batched Events via Ingestion API
     */
    public function testAddBatchedEvents()
    {
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
                    ), 
                    "user_id" => "mndug437f43", 
                    "session_token" => "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f"
                );
        $event->metadata = array(
                "foo" => "bar" 
                );

        $event->user_id = "12345";
        $event->company_id = "5678";
        $event->session_token = "23jdf0owekfmcn4u3qypxg09w4d8ayrcdx8nu2ngs98y18cx98q3yhwmnhcfx43f";

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createEventsBatch(array($event, $event));
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            201,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201"
        );
    }

    public function testAddOneEventWithEventModel()
    {
        $event1 = new Models\EventModel();
        $reqdate1 = new DateTime();
        $event1->request = new Models\EventRequestModel();
        $event1->request->time = $reqdate1->format(DateTime::ISO8601);
        $event1->request->uri = 'https://testbatch.com/singleevent';
        $event1->request->verb = 'GET';
        $event1->request->headers = array("reqheader1"=>"value1");
        $event1->response = new Models\EventResponseModel();
        $rspdate1 = (new DateTime())->add(new DateInterval('PT1S'));
        $event1->response->time = $rspdate1->format(DateTime::ISO8601);
        $event1->response->headers = array("header1"=>"value1");
        $event1->response->status = 200;
        $event1->response->body = array("bodyfield1"=>"bodyvalue1");

        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createEvent($event1);
        } catch (APIException $e) {
            echo $e;
        };

        // Test response code
        $this->assertEquals(
          201,
          $this->httpResponse->getResponse()->getStatusCode(),
          "Status is not 201"
      );
    }

    public function testAddBatchedEventsWithEventModel()
    {
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

        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createEventsBatch(array($event1, $event2));
        } catch (APIException $e) {
            echo $e;
        };

        // Test response code
        $this->assertEquals(
          201,
          $this->httpResponse->getResponse()->getStatusCode(),
          "Status is not 201"
      );
    }

    /**
     * Update Single User via Injestion API
     */
    public function testUpdateUser()
    {
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
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            201,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201"
        );
    }

    /**
     * Get Application config via Injestion API
     */
    public function testGetAppConfig()
    {
        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->getAppConfig();
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            200,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 200"
        );
    }

    /**
     * Update Single Company via Injestion API
     */
    public function testUpdateCompany()
    {
        // Parameters for the API call
        $company = new Models\CompanyModel();

        $company->companyId = "1";
        $company->metadata = [
          "email" => "moesifphp2@email.com",
          "name" => "moesif php2",
          "custom" => "randomdata2"
        ];

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->updateCompany($company);
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            201,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201"
        );
    }

    /**
     * Update Multiple Companies via Injestion API
     */
    public function testUpdateCompaniesBatch()
    {
        // Parameters for the API call
        $companyA = new Models\CompanyModel();
        $companyB = new Models\CompanyModel();

        $companyA->companyId = "1";
        $companyA->metadata = [
          "email" => "moesifphp2@email.com",
          "name" => "moesif php2",
          "custom" => "randomdata2"
        ];

        $companyB->companyId = "2";
        $companyB->sessionToken = "sdfnkewntib3wn5489hkdsnvkjb329o4rhik";
        $companyB->metadata = [
          "email" => "moesifphp2@email.com",
          "name" => "moesif php2",
          "custom" => "randomdata2"
        ];

        $companies = array();
        array_push($companies, $companyA);
        array_push($companies, $companyB);

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->updateCompaniesBatch($companies);
        } catch (APIException $e) {
        };

        // Test response code
        $this->assertEquals(
            201,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 201"
        );
    }
}
