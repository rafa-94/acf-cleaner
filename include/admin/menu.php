<?php

namespace admin;

use acfc\assets;

class menu
{

	public static function acf_cleaner_page()
	{
		$menu = add_submenu_page('tools.php', 'ACF Cleaner', 'ACF Cleaner', 'administrator', 'acf-cleaner', ['\\admin\\menu', 'acf_cleaner_page_html']);

		wp_enqueue_script('acf-cleaner-plugin', assets::manifest()::asset('app.js', true), null, null, true);
		wp_enqueue_script('acf-cleaner-plugin-vendor', assets::manifest()::asset('chunk-vendors.js', true), null, null, true);

		add_action('admin_enqueue_scripts', function () {
			wp_enqueue_style('acf-cleaner-style', assets::manifest()::asset('app.css', true));
		});

		wp_localize_script('acf-cleaner-plugin', 'site_urls', array(
			'webpack_pub' => plugin_dir_url(dirname(__FILE__, 2)) . 'admin-ui/dist/',
		));

	}

	public static function acf_cleaner_page_html()
	{
		echo file_get_contents(assets::manifest()::asset('index.html'));
	}
}
