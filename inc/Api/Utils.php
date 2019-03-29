<?php

namespace Prior\Api;

class Utils {
	public static function getConfig( $config ) {

		$parent_file = sprintf( '%s/config/%s.php', get_template_directory(), $config );
		$child_file  = sprintf( '%s/config/%s.php', get_stylesheet_directory(), $config );

		$data = array();

		if ( is_readable( $child_file ) ) {
			$data = require $child_file;
		}

		if ( empty( $data ) && is_readable( $parent_file ) ) {
			$data = require $parent_file;
		}

		return (array) $data;

	}
}