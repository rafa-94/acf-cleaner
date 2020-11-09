<?php

/**
 * Plugin Name: ACF Cleaner
 * Plugin URI: #
 * Description: Plugin to clean leftovers meta data from ACF fields
 * Version: 1.0
 * Author: Rafael Almeida
 * Author URI: #
 */

require_once('vendor/autoload.php');

add_action('admin_menu', ['\\admin\\menu', 'acf_cleaner_page']);

api\register::hooks();
