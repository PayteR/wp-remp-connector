# WP REMP Connector plugin for Wordpress

This plugin will provide functions to connect and retrieve API data from [REMP CRM](https://github.com/remp2020/crm-skeleton).

## Installation

Download this package from this repository and copy it into `/wp-content/plugins` directory of your WP installation and run `composer install` in this folder to download vendors. Then go to the administration panel and activate plugin in plugins admin section. 

If you use [Bedrock](https://github.com/roots/bedrock) WP installation, just install it by composer command and that's all:

```
composer require payter/wp-remp-user-helper:dev-master
```

## Configuration

Plugin provide several PHP Constants and one that is mandatory to configure. Please add this into `wp-config.php` and set your current REMP CRM domain.

```
define('REMP_URL', 'http://remp.crm.domain');
```

Please check other constants to configure in [wp-remp-user-helper.php](./wp-remp-user-helper.php) 

## Functions to use

Plugin use functional programming - so all functionality is encapsuled in functions and ready to use. All
 functionality is PHP files that are located in [lib](./lib/) directory.

### [Api functions](./lib/api.php)

API functions that connects and retrieve data from REMP CRM API. Most useful function to use:
```
// Get parsed data from api or null
remp_api_data($url, $options = [], $method = 'GET'); 

// Will connect to the REMP API and return back Guzzle client object
remp_api_client($url, $options = [], $method = 'GET')
```

### [Cache functions](./lib/cache.php)

Cache functions for storing of results. It's important to store results in cache becauseAPI connection is expensive operation. You can substitute this function by your own in [mu-plugins](https://wordpress.org/support/article/must-use-plugins/) folder
```
remp_cache_key($key);
remp_cache_get($key, $group = REMP_CACHE_KEY_GROUP, $force = false);
remp_cache_set($key, $data, $group = REMP_CACHE_KEY_GROUP, $expire = REMP_CACHE_EXPIRATION);
```

### [Helpers functions](./lib/helpers.php)
Other functions, that are useful
```
// Will generate url to the REMP CRM by passing url path as argument
remp_get_url($url_path = '');
```

### [User API functions](./lib/user_api.php)
Use this functions to retrieve user info
```
// Check, if user is logged in REMP
remp_user_logged_in();

// Retrieve user info from API
remp_user_get_info();

// Retrieve all subscriptions from API for logged user
remp_user_get_subscriptions();

// Check by subscriptions, if user have currently active subscription
remp_user_is_premium();
```
