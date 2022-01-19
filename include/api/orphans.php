<?php

namespace api;

class orphans
{

	public static function get_all()
	{
		global $wpdb;

		$result = $wpdb->get_results(self::get_orphan_metadata());
		$meta_data = self::parse_meta_data($result);

		return wp_send_json($meta_data);
	}

	public static function delete()
	{
		$ids = $_REQUEST['ids'];

		var_dump($ids);

		if (empty($ids)) {
			wp_send_json_error("Invalid Ids");
		}

		global $wpdb;

		$result = $wpdb->get_results(self::delete_orphan_metadata($ids));

		return wp_send_json($result);
	}

	private static function parse_meta_data($result)
	{
		$parsed_data = [];

		foreach ($result as $meta) {
			if (!array_key_exists($meta->meta_key, $parsed_data)) {
				$parsed_data[$meta->meta_key] = [];
			}

			array_push(
				$parsed_data[$meta->meta_key],
				[
					'meta_ids' => $meta->meta_id,
					'post_id' => $meta->post_id
				]
			);
		}

		return $parsed_data;
	}

	private static function get_orphan_metadata($limit = 50)
	{
		global $wpdb;

		return "SELECT meta_id, meta_key, post_id FROM $wpdb->postmeta
						LEFT JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->postmeta.post_id
						WHERE $wpdb->posts.ID IS NULL LIMIT $limit;";
	}

	private static function delete_orphan_metadata($ids)
	{
		global $wpdb;

		return "DELETE FROM $wpdb->postmeta
						WHERE meta_id IN ($ids);";
	}
}
