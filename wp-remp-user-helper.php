<?php
/**
 * WP REMP Connector
 *
 * Plugin initialization file
 *
 * @package    WP REMP Connector
 * @author     Peter PayteR Gašparík
 * @license    MIT
 * @copyright  Copyright (c) 2020
 * @version    0.1.0
 */
/*
Plugin Name: WP REMP Connector
Description: Plugin that connects wordpress to the REMP CRM API and provide PHP functions to use in templates.
Author: Peter PayteR Gašparík
Version: 0.1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


define( 'REMP_VERSION', '0.1.0' );

// REMP_URL is IMPORTANT! constant, that must be configured in wp-config.php
if(!defined('REMP_URL') && is_admin()) {
    throw new \Exception('Set \'REMP_URL\' constant first, please!', 500);
};

// cookie name constants
if(!defined('REMP_N_TOKEN')) define( 'REMP_N_TOKEN', 'n_token' );
if(!defined('REMP_N_VERSION')) define( 'REMP_N_VERSION', 'n_version' );

// url paths constants
if(!defined('REMP_URL_SUBSCRIPTION')) define( 'REMP_URL_SUBSCRIPTION', '/subscriptions/subscriptions/new' );
if(!defined('REMP_URL_PROFILE')) define( 'REMP_URL_PROFILE', '/invoices/invoices/invoice-details' );
if(!defined('REMP_URL_LOGIN')) define( 'REMP_URL_LOGIN', '/sign/in/' );

// cache prefix constants
if(!defined('REMP_CACHE_KEY_PREFIX')) define( 'REMP_CACHE_KEY_PREFIX', 'remp' );
if(!defined('REMP_CACHE_KEY_GROUP')) define( 'REMP_CACHE_KEY_GROUP', 'remp' );

// cache expiration in seconds, set 0 to disable cache
if(!defined('REMP_CACHE_EXPIRATION')) define( 'REMP_CACHE_EXPIRATION', HOUR_IN_SECONDS );

// api url paths
if(!defined('REMP_URL_API_USERINFO')) define( 'REMP_URL_API_USERINFO', '/api/v1/user/info' );
if(!defined('REMP_URL_API_SUBSCRIPTION')) define( 'REMP_URL_API_SUBSCRIPTION', '/api/v1/users/subscriptions' );

// will load autoload from vendor if it's present
if(file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// include libs
require_once __DIR__ . '/lib/cache.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/api.php';
require_once __DIR__ . '/lib/user_api.php';
