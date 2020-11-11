<?php

namespace api;

class register
{

	public static function hooks()
	{
		add_action('wp_ajax_acf_get_all', ['\\api\\acf', 'get_all']);
		add_action('wp_ajax_acf_delete', ['\\api\\acf', 'delete']);

		add_action('wp_ajax_orphans_get_all', ['\\api\\orphans', 'get_all']);
		add_action('wp_ajax_orphans_delete', ['\\api\\orphans', 'delete']);
	}
}
