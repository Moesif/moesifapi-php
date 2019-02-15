<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi\Controllers;

use MoesifApi\APIException;
use MoesifApi\APIHelper;
use MoesifApi\Configuration;
use MoesifApi\Models;
use MoesifApi\Exceptions;
use MoesifApi\Http\HttpRequest;
use MoesifApi\Http\HttpResponse;
use MoesifApi\Http\HttpMethod;
use MoesifApi\Http\HttpContext;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class ApiController extends BaseController {

    /**
     * @var ApiController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return ApiController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Add Single API Event Call
     * @param  Models\EventModel $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createEvent (
                $body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/events';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        # Return response headers
        return $response->headers;
    }

    /**
     * Add multiple API Events in a single batch (batch size must be less than 250kb)
     * @param  array     $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createEventsBatch (
                $body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/events/batch';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        # Return response headers
        return $response;
    }

    /**
     * Update a Single User Call
     * @param  Models\UserModel $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function updateUser ($body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/users';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }
    }

    /**
     * Update multiple users in a single batch (batch size must be less than 250kb)
     * @param  array     $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function updateUsersBatch (
                $body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/users/batch';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }
    }

    /**
     * Get App config
     * @param  void Required parameter: Example:
     * @return response response from the API call
     * @throws APIException Thrown if API call fails
     */

     public function getAppConfig()
     {
       //the base uri for api requests
       $_queryBuilder = Configuration::$BASEURI;

       //prepare query string for API call
       $_queryBuilder = $_queryBuilder.'/v1/config';

       //validate and preprocess url
       $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

       //prepare headers
       $_headers = array (
           'content-type'  => 'application/json; charset=utf-8',
           'X-Moesif-Application-Id' => Configuration::$applicationId
       );

       //call on-before Http callback
       $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
       if($this->getHttpCallBack() != null) {
           $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
       }

       //and invoke the API call request to fetch the response
       $response = Request::get($_queryUrl, $_headers);

       //call on-after Http callback
       if($this->getHttpCallBack() != null) {
           $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
           $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

           $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
       }

       //Error handling using HTTP status codes
       if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
           throw new APIException("HTTP Response Not OK", $_httpContext);
       }

       // return response
       return $response;
     }

     /**
     * Add a Single Company Call
     * @param  Models\CompanyModel $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function addCompany ($body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/companies';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }
    }

    /**
     * Add multiple companies in a single batch (batch size must be less than 250kb)
     * @param  array     $body     Required parameter: Example:
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function addCompaniesBatch ($body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v1/companies/batch';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'content-type'  => 'application/json; charset=utf-8',
            'X-Moesif-Application-Id' => Configuration::$applicationId,
            'User-Agent' => 'moesifapi-php ' . Configuration::$VERSION
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }
    }
}
