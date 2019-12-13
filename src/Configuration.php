<?php
/*
 * MoesifApi
 *
 */

namespace MoesifApi;

/**
 * All configuration including auth info and base URI for the API access
 * are configured in this class.
 */
class Configuration {
    /**
     * The base Uri for API calls
     * @var string
     */
    public static $BASEURI = 'https://api.moesif.net';
    public static $VERSION = 'v1.1.8';

    /**
     * Your Application Id for authentication/authorization
     * @var string
     */
    /**
     * @todo Replace the $applicationId with your Application Id from Moesif Settings
     */
    public static $applicationId = 'set me';
}
