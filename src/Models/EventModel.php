<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi\Models;

use JsonSerializable;

/**
 * API Call Event
 */
class EventModel implements JsonSerializable {
    /**
     * API request object
     * @required
     * @var EventRequestModel $request public property
     */
    public $request;

    /**
     * API response Object
     * @var EventResponseModel $response public property
     */
    public $response;

    /**
     * End user's auth/session token
     * @maps session_token
     * @var string $sessionToken public property
     */
    public $sessionToken;

    /**
     * comma separated list of tags, see documentation
     * @var string $tags public property
     */
    public $tags;

    /**
     * End user's user_id string from your app
     * @maps user_id
     * @var string $userId public property
     */
    public $userId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EventRequestModel   $request         Initialization value for the property $this->request
     * @param   EventResponseModel   $response        Initialization value for the property $this->response
     * @param   string            $sessionToken    Initialization value for the property $this->sessionToken
     * @param   string            $tags            Initialization value for the property $this->tags
     * @param   string            $userId          Initialization value for the property $this->userId
     */
    public function __construct()
    {
        if(5 == func_num_args())
        {
            $this->request       = func_get_arg(0);
            $this->response      = func_get_arg(1);
            $this->sessionToken  = func_get_arg(2);
            $this->tags          = func_get_arg(3);
            $this->userId        = func_get_arg(4);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['request']       = $this->request;
        $json['response']      = $this->response;
        $json['session_token'] = $this->sessionToken;
        $json['tags']          = $this->tags;
        $json['user_id']       = $this->userId;

        return $json;
    }
}
