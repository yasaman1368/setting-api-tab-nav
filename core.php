<?php
/*
Plugin Name:tabs setting api for reading
Plugin URI: wferwe
Description: structure of plugin
Version: 1.0.0
Author: moham madhossein aalipor
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later

*/
defined('ABSPATH') || exit;
define('yas_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('yas_PLUGIN_URL', plugin_dir_url(__FILE__));
define('yas_PLUGIN_inc', plugin_dir_path(__FILE__) . '_inc/');

if (is_admin()) {
    include yas_PLUGIN_inc . 'admin/menu.php';
    include yas_PLUGIN_inc . 'admin/custum.php';
} else {
    include yas_PLUGIN_inc . 'front/front.php';
}
