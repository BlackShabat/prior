<?php

namespace Prior\Hooks;

class Actions {

	private static $actions = [
		'prior_before_page' => [
			'renderMobileNavigation' => 10
		],
		'prior_header'      => [
			'renderHeaderLayout' => 10
		],
		'prior_header_main' => [
			'the_custom_logo' => 10
		]

	];

	public function __construct() {
		foreach ( self::$actions as $action => $functions ) {
			foreach ( $functions as $function => $priority ) {
				//Hook class method or global function
				if ( method_exists( __CLASS__, $function ) ) {
					add_action( $action, [ __CLASS__, $function ], $priority );
				} elseif ( function_exists( $function ) ) {
					add_action( $action, $function, $priority );
				}
			}
		}
	}

	public static function renderMobileNavigation() {
		if ( wp_is_mobile() ) {
			get_template_part( 'views/components/mobile-navigation' );
		}
	}

	public static function renderHeaderLayout() {
		get_template_part( 'views/layouts/header' );
	}
}