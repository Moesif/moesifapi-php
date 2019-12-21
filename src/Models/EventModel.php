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
     * company_id string
     * @maps company_id
     * @var string $companyId public property
     */
    public $companyId;

    /**
     * metadata for an event
     * @optional
     * @var object $metadata public property
     */
    public $metadata;

    /**
     * direction string
     * @maps direction
     * @var string $direction public property
     */
    public $direction;

    /**
     * Weight of an API call
     * @maps weight
     * @var integer $weight public property
     */
    public $weight;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EventRequestModel   $request         Initialization value for the property $this->request
     * @param   EventResponseModel   $response        Initialization value for the property $this->response
     * @param   string            $sessionToken    Initialization value for the property $this->sessionToken
     * @param   string            $tags            Initialization value for the property $this->tags
     * @param   string            $userId          Initialization value for the property $this->userId
     * @param   string            $companyId       Initialization value for the property $this->companyId
     * @param   object            $metadata        Initialization value for the property $this->metadata
     * @param   string            $direction       Initialization value for the property $this->direction
     * @param   integer           $weight          Initialization value for the property $this->weight
     */
    public function __construct()
    {
        if(9 == func_num_args())
        {
            $this->request       = func_get_arg(0);
            $this->response      = func_get_arg(1);
            $this->sessionToken  = func_get_arg(2);
            $this->tags          = func_get_arg(3);
            $this->userId        = func_get_arg(4);
            $this->companyId     = func_get_arg(5);
            $this->metadata      = func_get_arg(6);
            $this->direction     = func_get_arg(7);
            $this->weight        = func_get_arg(8);
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
        $json['company_id']    = $this->companyId;
        $json['metadata']      = $this->metadata;
        $json['direction']     = $this->direction;
        $json['weight']        = $this->weight;

        return $json;
    }
}
