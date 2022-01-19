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


add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {
	// if not your script, do nothing and return original $tag
	if ( 'acf-cleaner-plugin' !== $handle ) {
			return $tag;
	}
	// change the script tag by adding type="module" and return it.
	$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	return $tag;
}
