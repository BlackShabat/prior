<?php

namespace Prior\Setup;

use Kirki;
use Prior\Api\Utils;

class ColorPalette {

	private static $colorPalette = [];
	private static $customizerFieldPrefix = 'prior_colors';

	public function __construct() {
		self::addPalette( Utils::getConfig( 'color-palette' ) );
	}

	public static function addPalette( $colors ) {

		self::$colorPalette = self::getCustomizedColorPalette( $colors );

		add_action( 'after_setup_theme', function () {
			add_theme_support( 'editor-color-palette', self::$colorPalette );
		} );
	}

	public static function addCustomizerFields( $section ) {
		foreach ( self::$colorPalette as $color ) {
			Kirki::add_field( self::$customizerFieldPrefix . '_' . $color['slug'], [
				'type'     => 'color',
				'settings' => self::$customizerFieldPrefix . '_' . $color['slug'],
				'label'    => esc_attr__( $color['name'], 'prior' ),
				'section'  => $section,
				'default'  => $color['color'],
			] );
		}
	}

	private static function getCustomizedColorPalette( $colors ) {
		$customizePalette = [];
		foreach ( $colors as $color ) {
			$color['color']     = get_theme_mod( self::$customizerFieldPrefix . '_' . $color['slug'], $color['color'] );
			$customizePalette[] = $color;
		}

		return $customizePalette;
	}
}