<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package  Core
 *
 * Sets the default route to "homepage"
 */
$config['_default'] = 'homepage';

$config['occasions/(.+)$'] = 'occasions/show/$1';

//$config['products/([0-9]+)'] = 'products/show/$1';

$config['products/show/(.+)$'] = 'products/show/$1';
$config['products/build/(.+)$'] = 'products/build/$1';
$config['products/category/(.+)$'] = 'products/index/category/$1';
$config['articles/(.+)$'] = 'articles/show/$1';
