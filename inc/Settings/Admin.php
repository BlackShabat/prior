<?php

namespace Prior\Settings;

use Prior\Setup\Settings;

class Admin extends Settings {
	public function __construct() {
		$this->adminPages();
		parent::register();
	}

	public function register() {
	}

	private function adminPages() {

		/* Multiple admin pages */
		$args = [
			[
				'pageTitle'  => 'Theme Options',
				'menuTitle'  => 'Theme Options',
				'capability' => 'manage_options',
				'menuSlug'   => 'store',
				'callback'   => function () {
					echo '<div><h1>Store Admin Page</h1></div>';
				},
				'iconUrl'    => 'dashicons-store',
				'position'   => 110
			]
		];

		parent::addPages( $args );
	}
}