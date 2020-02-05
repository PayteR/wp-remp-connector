<?php
/**
 * Use this functions to retrieve user info.
 *
 * @package    WP REMP Connector
 * @author     Peter PayteR Gašparík
 * @license    MIT
 * @copyright  Copyright (c) 2020
 */

if (!defined('ABSPATH')) {
    exit;
}

if(!defined('REMP_USER_KEY_INFO')) define( 'REMP_USER_KEY_INFO', 'user_info' );
if(!defined('REMP_USER_KEY_SUBSCRIPTION')) define( 'REMP_USER_KEY_SUBSCRIPTION', 'user_subscription' );
if(!defined('REMP_USER_KEY_PREMIUM')) define( 'REMP_USER_KEY_PREMIUM', 'user_premium' );

/**
 * Check, if user is logged in REMP
 *
 * @return bool
 */
function remp_user_logged_in()
{
    return (bool)remp_user_get_info();
}

/**
 * Retrieve user info from API
 *
 * @return stdClass|null
 */
function remp_user_get_info()
{
    if($data = remp_cache_get(REMP_USER_KEY_INFO)) {
        return $data;
    }

    $data = remp_api_data(remp_get_url(REMP_URL_API_USERINFO));
    if (!$data || !isset($data->user)) {
        return null;
    }

    remp_cache_set(REMP_USER_KEY_INFO, $data->user);
    return $data->user;
}

/**
 * Retrieve all subscriptions from API for logged user
 *
 * @return stdClass|null
 */
function remp_user_get_subscriptions()
{
    if($data = remp_cache_get(REMP_USER_KEY_SUBSCRIPTION)) {
        return $data;
    }

    $data = remp_api_data(remp_get_url(REMP_URL_API_SUBSCRIPTION));
    if (!$data || !isset($data->subscriptions)) {
        return null;
    }

    remp_cache_set(REMP_USER_KEY_SUBSCRIPTION, $data->subscriptions);
    return $data->subscriptions;
}

/**
 * Check by subscriptions, if user have currently active subscription
 *
 * @return bool
 */
function remp_user_is_premium()
{
    if($data = remp_cache_get(REMP_USER_KEY_PREMIUM)) {
        return $data;
    }

    $subscriptions = remp_user_get_subscriptions();
    if (!$subscriptions || !count($subscriptions)) {
        return false;
    }

    try {
        $now = new \DateTime();
        $end = new \DateTime($subscriptions[0]->end_at);
    } catch (\Exception $e) {
        return false;
    }

    $is_premium = $now < $end;
    remp_cache_set(REMP_USER_KEY_PREMIUM, $is_premium);
    return $is_premium;
}
