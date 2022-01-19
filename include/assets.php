<?php

namespace acfc;

class assets
{

	private static $manifest_file = null;
	private static $assets_url = null;
	private static $assets_path = null;

	public static function manifest($manifest = "manifest.json", $path = "admin-ui/dist/")
	{
		self::$assets_url = plugin_dir_url(dirname(__FILE__)) . $path;
		self::$assets_path = plugin_dir_path(dirname(__FILE__)) . $path;
		self::$manifest_file = 	self::$assets_path . $manifest;

		return new self;
	}

	public static function asset($file, $asset, $url = false )
	{
		$manifest = json_decode(file_get_contents(self::$manifest_file));

		$asset = gettype($manifest->{$file}->{$asset}) === "array" ?  $manifest->{$file}->{$asset}[0] : $manifest->{$file}->{$asset};

		return substr($url ? self::$assets_url : self::$assets_path, 0, -1) . '/' . $asset;
	}

	public static function manifest_asset($file){
		$manifest = json_decode(file_get_contents(self::$manifest_file));

		return $manifest->{$file};
	}

}
