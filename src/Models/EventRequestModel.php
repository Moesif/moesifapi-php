<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi\Models;

use JsonSerializable;

/**
 * API Request
 */
class EventRequestModel implements JsonSerializable {
    /**
     * Time when request was made
     * @required
     * @var string $time public property
     */
    public $time;

    /**
     * full uri of request such as https://www.example.com/my_path?param=1
     * @required
     * @var string $uri public property
     */
    public $uri;

    /**
     * verb of the API request such as GET or POST
     * @required
     * @var string $verb public property
     */
    public $verb;

    /**
     * Key/Value map of request headers
     * @required
     * @var object $headers public property
     */
    public $headers;

    /**
     * Optionally tag the call with your API or App version
     * @maps api_version
     * @var string $apiVersion public property
     */
    public $apiVersion;

    /**
     * IP Address of the client if known.
     * @maps ip_address
     * @var string $ipAddress public property
     */
    public $ipAddress;

    /**
     * Request body
     * @var object $body public property
     */
    public $body;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $time          Initialization value for the property $this->time
     * @param   string            $uri           Initialization value for the property $this->uri
     * @param   string            $verb          Initialization value for the property $this->verb
     * @param   object            $headers       Initialization value for the property $this->headers
     * @param   string            $apiVersion    Initialization value for the property $this->apiVersion
     * @param   string            $ipAddress     Initialization value for the property $this->ipAddress
     * @param   object            $body          Initialization value for the property $this->body
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->time        = func_get_arg(0);
            $this->uri         = func_get_arg(1);
            $this->verb        = func_get_arg(2);
            $this->headers     = func_get_arg(3);
            $this->apiVersion  = func_get_arg(4);
            $this->ipAddress   = func_get_arg(5);
            $this->body        = func_get_arg(6);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['time']        = $this->time;
        $json['uri']         = $this->uri;
        $json['verb']        = $this->verb;
        $json['headers']     = $this->headers;
        $json['api_version'] = $this->apiVersion;
        $json['ip_address']  = $this->ipAddress;
        $json['body']        = $this->body;

        return $json;
    }
}
