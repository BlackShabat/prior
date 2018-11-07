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
			'the_custom_logo'      => 10,
			'renderMainNavigation' => 20
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

	public static function renderMainNavigation() {
		if ( has_nav_menu( 'main_menu' ) ) {
			wp_nav_menu( [
				'theme_location' => 'main_menu' ,
				'container' => 'nav',
				'container_class' => 'pc-nav pc-nav--light pc-nav--horizontal pc-nav--dropdown',
				//'items_wrap' => '<nav class="pc-nav"><ul class="%2$s">%3$s</ul></nav>'
			] );
		}
	}
}