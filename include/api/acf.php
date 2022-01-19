<?php

namespace api;

class acf
{
	public static function get_all()
	{
		global $wpdb;

		$all_acfs = [];

		$unused_acf = $wpdb->get_results(self::get_unused_acf());
		foreach ($unused_acf as $acf) {
			$meta_data = self::get_meta_data($acf);
			$post_info = self::get_post_info($acf->post_id);

			if(!array_key_exists($acf->meta_key, $all_acfs)){
				$all_acfs[$acf->meta_key] = [];
			}

			array_push($all_acfs[$acf->meta_key], array_merge($meta_data, $post_info));
		}

		ksort($all_acfs);

		wp_send_json($all_acfs);
	}

	public static function delete()
	{
		$ids = $_REQUEST['ids'];

		if (empty($ids)) {
			wp_send_json_error("Invalid Ids");
		}

		global $wpdb;

		$res = $wpdb->get_results(self::delete_meta($ids));

		wp_send_json($res);
	}

	private static function get_post_info($post_id)
	{
		$post_info = [
			'post_id' => $post_id,
			'link' => get_edit_post_link($post_id)
		];

		return [
			'post_info' => $post_info
		];
	}

	private static function get_meta_data($acf)
	{
		global $wpdb;

		$meta_data = $wpdb->get_results(self::get_unused_meta_id($acf));

		//Meta_ID
		$meta_ids = array_map(function ($meta) {
			return $meta->meta_id;
		}, $meta_data);
		$meta_ids = implode(",", $meta_ids);

		//Meta_value
		$meta_value = array_filter($meta_data, function ($meta) {
			return strpos($meta->meta_value, 'field_') === false;
		});
		$meta_value = reset($meta_value)->meta_value;

		return [
			"meta_ids"   => $meta_ids,
			"meta_value" => $meta_value
		];
	}

	private static function get_unused_acf($table = 'wp_postmeta', $limit = 50)
	{
		return "SELECT post_id, SUBSTR(meta_key, 2) AS meta_key FROM $table
							LEFT JOIN wp_posts ON $table.meta_value = wp_posts.post_name
							WHERE LEFT(meta_value, 6) = 'field_'
							AND wp_posts.post_name IS null
							ORDER BY post_id ASC LIMIT $limit;";
	}

	private static function get_unused_meta_id($meta_data)
	{
		return "SELECT meta_id, meta_value FROM wp_postmeta
						WHERE post_id = $meta_data->post_id
						AND meta_key REGEXP '\\\b\\\w?$meta_data->meta_key\\\b';";
	}

	private static function delete_meta($ids, $table = 'wp_postmeta')
	{
		return "DELETE FROM $table
						WHERE meta_id in ($ids)";
	}
}
