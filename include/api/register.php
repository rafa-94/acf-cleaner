<?php

namespace api;

class register
{

	public static function hooks()
	{
		add_action('wp_ajax_acf_get_all', ['\\api\\acf', 'get_all']);
		add_action('wp_ajax_acf_delete', ['\\api\\acf', 'delete']);
	}
}
