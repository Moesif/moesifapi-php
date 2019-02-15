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
class CompanyModel implements JsonSerializable {

    /**
     * companyId
     * @required
     * @var string $companyId public property
     */
    public $companyId;

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
     * Company Domain in String format
     * @optional
     * @var string $companyDomain public property.
     */
    public $companyDomain;

    /**
     * Optionally add the session token for the user.
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
     * @param   string     $companyId            Initialization value for the property $this->companyId
     * @param   string     $moeifiedTime      Initialization value for the property $this->modifiedTime
     * @param   string     $ipAddress         Initialization value for the property $this->ipAddress
     * @param   string     $companyDomain   Initialization value for the property $this->companyDomain
     * @param   string     $sessionToken      Initialization value for the property $this->sessionToken
     * @param   object     $metadata          Initialization value for the property $this->metadata
     */
    public function __construct()
    {
        if(6 == func_num_args())
        {
            $this->companyId     = func_get_arg(0);
            $this->modifiedTime  = func_get_arg(1);
            $this->ipAddress     = func_get_arg(2);
            $this->companyDomain = func_get_arg(3);
            $this->sessionToken  = func_get_arg(4);
            $this->metadata      = func_get_arg(5);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['company_id']      = $this->companyId;
        $json['moesified_time']  = $this->modifiedTime;
        $json['ip_address']      = $this->ipAddress;
        $json['company_domain']  = $this->companyDomain;
        $json['session_token']   = $this->sessionToken;
        $json['metadata']        = $this->metadata;

        return $json;
    }
}
