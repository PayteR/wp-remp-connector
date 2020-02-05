<?php
/**
 * Cache functions for storing of results.
 * It's important to store results in cache
 * because API connection is expensive operation.
 *
 * You can substitute this function by your own in
 * mu-plugins folder https://wordpress.org/support/article/must-use-plugins/
 *
 * @package    WP REMP Connector
 * @author     Peter PayteR Gašparík
 * @license    MIT
 * @copyright  Copyright (c) 2020
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(!function_exists('remp_cache_key')) {
    /**
     * Get formatted cache key
     *
     * @param string $key
     * @return string
     */
    function remp_cache_key($key) {
        return REMP_CACHE_KEY_PREFIX . '_' . $key . '_' . remp_api_get_token();
    }
}

if(!function_exists('remp_cache_get')) {
    /**
     * Retrieve stored variables from cache by key
     *
     * @param string $key
     * @param string $group
     * @param bool $force
     * @return bool|mixed
     */
    function remp_cache_get($key, $group = REMP_CACHE_KEY_GROUP, $force = false) {
        return wp_cache_get(remp_cache_key($key), $group, $force);
    }
}

if(!function_exists('remp_cache_set')) {
    /**
     * Stored variables to the cache
     *
     * @param string $key
     * @param string|array|object $data
     * @param string $group
     * @param float|int $expire
     * @return bool|null
     */
    function remp_cache_set($key, $data, $group = REMP_CACHE_KEY_GROUP, $expire = REMP_CACHE_EXPIRATION) {
        if(!$expire) {
            return null;
        }
        return wp_cache_set(remp_cache_key($key), $data, $group, $expire);
    }
}

