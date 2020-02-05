<?php
/**
 * Other functions, that are useful
 *
 * @package    WP REMP Connector
 * @author     Peter PayteR Gašparík
 * @license    MIT
 * @copyright  Copyright (c) 2020
 */

/**
 * Will generate url to the REMP CRM by passing url path as argument
 *
 * @param string $url_path
 * @return string
 */
function remp_get_url($url_path = '') {
    if(!$url_path) {
        return REMP_URL;
    }
    return rtrim(REMP_URL, '\/') . $url_path;
}
