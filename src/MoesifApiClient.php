<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi;

use MoesifApi\Controllers;

/**
 * MoesifApi client class
 */
class MoesifApiClient
{
    /**
     * Constructor with authentication and configuration parameters
     */
    public function __construct($applicationId = NULL)
    {
        Configuration::$applicationId = $applicationId ? $applicationId : Configuration::$applicationId;
    }

    /**
     * Singleton access to Api controller
     * @return Controllers\ApiController The *Singleton* instance
     */
    public function getApi()
    {
        return Controllers\ApiController::getInstance();
    }

    /**
     * Singleton access to Health controller
     * @return Controllers\HealthController The *Singleton* instance
     */
    public function getHealth()
    {
        return Controllers\HealthController::getInstance();
    }
}
