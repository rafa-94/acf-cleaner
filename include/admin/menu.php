<?php

namespace admin;

use acfc\assets;

class menu
{

	public static function acf_cleaner_page()
	{

		$menu = add_submenu_page('tools.php', 'ACF Cleaner', 'ACF Cleaner', 'administrator', 'acf-cleaner', ['\\admin\\menu', 'acf_cleaner_page_html']);

		add_action('admin_enqueue_scripts', function ($hook_sufix) {
			if ($hook_sufix == 'tools_page_acf-cleaner') {
				wp_enqueue_script('acf-cleaner-plugin', assets::manifest()::asset('src/main.js', 'file' ,true), null, null, true);

				wp_enqueue_style('acf-cleaner-style', assets::manifest()::asset('src/main.js', 'css', true));

				wp_localize_script('acf-cleaner-plugin', 'site_urls', array(
					'webpack_pub' => plugin_dir_url(dirname(__FILE__, 2)) . 'admin-ui/dist/',
					'ajax' => esc_url_raw(admin_url('admin-ajax.php')),
				));
			}
		});
	}

	public static function acf_cleaner_page_html()
	{
		echo file_get_contents(plugin_dir_url(dirname(__FILE__, 2)) . 'admin-ui/dist/index.html');
	}
}
