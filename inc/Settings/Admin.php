<?php

namespace Prior\Settings;

class Admin {
	/**
	 * Store a new instance of the Settings API Class
	 */
	private $settings;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->settings = new SettingsApi();
		$this->adminPages();
		$this->settings->registerHooks();
	}

	/**
	 * Register admin pages and subpages at once
	 */
	private function adminPages() {
		/* Multiple admin pages */
		$pages = [
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

		$this->settings->addPages( $pages );
	}
}