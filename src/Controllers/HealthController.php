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
class HealthController extends BaseController {

    /**
     * @var HealthController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return HealthController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Health Probe
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getHealthProbe ()
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/health/probe';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'Accept'        => 'application/json',
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

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\StatusModel());
    }


}
