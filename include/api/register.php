<?php

namespace api;

class balelas
{

	public static function hooks()
	{
		add_action('wp_ajax_acf_get_all', 'acf::get_all');
	}
}
