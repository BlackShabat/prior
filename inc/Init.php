<?php

namespace Prior;

class Init {
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	private static $services = [
		Setup\Colors::class,
		Setup\Setup::class,
		Setup\Enqueue::class,
		Setup\Sidebar::class,
		Plugins\Woocommerce::class,
		Hooks\Actions::class,
		Customizer\Customizer::class
	];

	/**
	 * Loop through the classes, initialize them, and call the register() method if it exists
	 */
	public static function register_services() {
		foreach ( self::$services as $class ) {
			if ( class_exists( $class ) ) {
				new $class();
			}
		}
	}

}