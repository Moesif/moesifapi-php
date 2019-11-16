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
class CampaignModel implements JsonSerializable {

    /**
     * the utm source
     * @optional
     * @var string $utmSource public property
     */
    public $utmSource;

    /**
     * the utm medium
     * @optional
     * @var string $utmMedium public property
     */
    public $utmMedium;

    /**
     * the utm campaign
     * @optional
     * @var string $utmCampaign public property
     */
    public $utmCampaign;

    /**
     * the utm term
     * @optional
     * @var string $utmTerm public property
     */
    public $utmTerm;


    /**
     * the utm content
     * @optional
     * @var string $utmContent public property
     */
    public $utmContent;

    /**
     * the referrer
     * @optional
     * @var string $referrer public property
     */
    public $referrer;


    /**
     * the referring domain
     * @optional
     * @var string $referringDomain public property
     */
    public $referringDomain;


    /**
     * the gclid
     * @optional
     * @var string $gclid public property
     */
    public $gclid;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string     $utmSource           Initialization value for the property $this->utmSource
     * @param   string     $utmMedium           Initialization value for the property $this->utmMedium
     * @param   string     $utmCampaign         Initialization value for the property $this->utmCampaign
     * @param   string     $utmTerm             Initialization value for the property $this->utmTerm
     * @param   string     $utmContent          Initialization value for the property $this->utmContent
     * @param   string     $referrer            Initialization value for the property $this->referrer
     * @param   object     $referringDomain     Initialization value for the property $this->referringDomain
     * @param   object     $gclid               Initialization value for the property $this->gclid
     */
    public function __construct()
    {
        if(8 == func_num_args())
        {
            $this->utmSource        = func_get_arg(0);
            $this->utmMedium        = func_get_arg(1);
            $this->utmCampaign      = func_get_arg(2);
            $this->utmTerm          = func_get_arg(3);
            $this->utmContent       = func_get_arg(4);
            $this->referrer         = func_get_arg(5);
            $this->referringDomain  = func_get_arg(6);
            $this->gclid            = func_get_arg(7);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['utm_source']        = $this->utmSource;
        $json['utm_medium']        = $this->utmMedium;
        $json['utm_campaign']      = $this->utmCampaign;
        $json['utm_term']          = $this->utmTerm;
        $json['utm_content']       = $this->utmContent;
        $json['referrer']          = $this->referrer;
        $json['referring_domain']  = $this->referringDomain;
        $json['gclid']             = $this->gclid;

        return $json;
    }
}
