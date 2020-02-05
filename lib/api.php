<?php
/**
 * API functions that connects and retrieve
 * data from REMP CRM API
 *
 * @package    WP REMP Connector
 * @author     Peter PayteR Gašparík
 * @license    MIT
 * @copyright  Copyright (c) 2020
 * @version    0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Get parsed data from api or null
 *
 * @param $url
 * @param array $options
 * @param string $method
 * @return array|mixed|object|null
 */
function remp_api_data($url, $options = [], $method = 'GET') {
    $client = remp_api_client($url, $options = [], $method = 'GET');
    if(!$client) {
        return null;
    }
    return json_decode((string) $client->getBody());
}

/**
 * Will connect to the REMP API and return back Guzzle client object
 *
 * @param $url
 * @param array $options
 * @param string $method
 * @return null|\Psr\Http\Message\ResponseInterface
 */
function remp_api_client($url, $options = [], $method = 'GET')
{
    static $client;

    try {
        if(!$client) {
            $client = new GuzzleHttp\Client(['base_uri' => remp_get_url()]);
        }

        if (!isset($options['headers']['Authorization'])) {
            $options['headers']['Authorization'] = remp_api_get_bearer();
        }

        if(!$options['headers']['Authorization']) {
            return null;
        }

        if (!isset($options['headers']['Content-Type'])) {
            $options['headers']['Content-Type'] = "application/x-www-form-urlencoded";
        }

        return $client->request($method, $url, $options);
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        return null;
    }
}

/**
 * Retrieve formatted bearer string with token
 *
 * @return string|null
 */
function remp_api_get_bearer()
{
    $token = remp_api_get_token();
    if(!$token) {
        return null;
    }
    return "Bearer " . $token;
}

/**
 * Retrieve token from cookies
 *
 * @return string|null
 */
function remp_api_get_token()
{
    return $_COOKIE[REMP_N_TOKEN] ?? null;
}
