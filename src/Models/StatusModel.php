<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi\Models;

use JsonSerializable;

/**
 * Generic status result
 */
class StatusModel implements JsonSerializable {
    /**
     * Status of Call
     * @required
     * @var bool $status public property
     */
    public $status;

    /**
     * Location
     * @required
     * @var string $region public property
     */
    public $region;

    /**
     * Constructor to set initial or default values of member properties
     * @param   bool              $status   Initialization value for the property $this->status
     * @param   string            $region   Initialization value for the property $this->region
     */
    public function __construct()
    {
        if(2 == func_num_args())
        {
            $this->status = func_get_arg(0);
            $this->region = func_get_arg(1);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['status'] = $this->status;
        $json['region'] = $this->region;

        return $json;
    }
}
