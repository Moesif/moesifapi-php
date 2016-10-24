<?php
/*
 * MoesifApi
 *
 */

/**
 * Load the composer's autoload file so that we don't have to require files
 * manually in our code. Also load helper classes for tests.
 */
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/HttpCallBackCatcher.php';
require __DIR__.'/TestHelper.php';

/**
 * Configure Test Constants
 */
define("REQUEST_TIMEOUT", 30);
define("ASSERT_PRECISION", 0.01);
