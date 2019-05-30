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
class UserModel implements JsonSerializable {

    /**
     * userId
     * @required
     * @var string $userId public property
     */
    public $userId;

    /**
     * Time when the modification is made. Optional. Default to now.
     * @optional
     * @var string $modifiedTime public property
     */
    public $modifiedTime;

    /**
     * IP Address of the client if known.
     * @optional
     * @var string $ipAddress public property
     */
    public $ipAddress;


    /**
     * User Agent in String format
     * @optional
     * @var string user agent string.
     */
    public $userAgentString;

    /**
     * Optionally add the session togen for the user.
     * @optional
     * @var string $ap
     */
    public $sessionToken;


    /**
     * metadata
     * @var object $metadata the custom metadata, email and name is typical.
     */
    public $metadata;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string     $userId            Initialization value for the property $this->userId
     * @param   string     $moeifiedTime      Initialization value for the property $this->modifiedTime
     * @param   string     $ipAddress         Initialization value for the property $this->ipAddress
     * @param   string     $userAgentString   Initialization value for the property $this->userAgentString
     * @param   string     $sessionToken      Initialization value for the property $this->sessionToken
     * @param   object     $metadata          Initialization value for the property $this->metadata
     */
    public function __construct()
    {
        if(6 == func_num_args())
        {
            $this->userId       = func_get_arg(0);
            $this->modifiedTime = func_get_arg(1);
            $this->ipAddress    = func_get_arg(2);
            $this->userAgentString = func_get_arg(3);
            $this->sessionToken = func_get_arg(4);
            $this->metadata     = func_get_arg(5);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['user_id']     = $this->userId;
        $json['modified_time']  = $this->modifiedTime;
        $json['ip_address']        = $this->ipAddress;
        $json['user_agent_string']     = $this->userAgentString;
        $json['session_token'] = $this->sessionToken;
        $json['metadata']  = $this->metadata;

        return $json;
    }
}
