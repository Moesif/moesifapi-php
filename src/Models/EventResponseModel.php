<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi\Models;

use JsonSerializable;

/**
 * API Response
 */
class EventResponseModel implements JsonSerializable {
    /**
     * Time when response received
     * @required
     * @var string $time public property
     */
    public $time;

    /**
     * HTTP Status code such as 200
     * @required
     * @var integer $status public property
     */
    public $status;

    /**
     * Key/Value map of response headers
     * @required
     * @var object $headers public property
     */
    public $headers;

    /**
     * Response body
     * @required
     * @var object $body public property
     */
    public $body;

    /**
     * IP Address from the response, such as the server IP Address
     * @maps ip_address
     * @var string $ipAddress public property
     */
    public $ipAddress;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $time         Initialization value for the property $this->time
     * @param   integer           $status       Initialization value for the property $this->status
     * @param   object            $headers      Initialization value for the property $this->headers
     * @param   object            $body         Initialization value for the property $this->body
     * @param   string            $ipAddress    Initialization value for the property $this->ipAddress
     */
    public function __construct()
    {
        if(5 == func_num_args())
        {
            $this->time       = func_get_arg(0);
            $this->status     = func_get_arg(1);
            $this->headers    = func_get_arg(2);
            $this->body       = func_get_arg(3);
            $this->ipAddress  = func_get_arg(4);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['time']       = $this->time;
        $json['status']     = $this->status;
        $json['headers']    = $this->headers;
        $json['body']       = $this->body;
        $json['ip_address'] = $this->ipAddress;

        return $json;
    }
}
