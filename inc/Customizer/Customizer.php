<?php

namespace Prior\Customizer;

use Kirki;
use Prior\Customizer\Fields\Colors;

class Customizer {

	private static $fields = [
		'prior_before_header_cols' => [ Fields\Cols::class, 'prior_before_header_section' ],
		'prior_before_header_bg'   => [ Fields\BgColor::class, 'prior_before_header_section' ],
		'prior_main_header_cols'   => [ Fields\Cols::class, 'prior_main_header_section' ],
		'prior_main_header_bg'     => [ Fields\BgColor::class, 'prior_main_header_section' ]
	];

	public function __construct() {

		//Init Customizer only in customizer bar inside admin panel
		if ( is_customize_preview() ) {
			$this->addPanels();
			$this->addSections();
			$this->addFields();
			Colors::addCustomizerFields('priors_colors_section');
		}

		$this->registerSidebars();
	}

	private function addPanels() {
		Kirki::add_panel( 'prior', array(
			'priority' => 10,
			'title'    => __( 'Prior', 'prior' ),
		) );
	}

	private function addSections() {
		Kirki::add_section( 'priors_colors_section', array(
			'title'    => __( 'Colors', 'prior' ),
			'panel'    => 'prior',
			'priority' => 10
		) );
		Kirki::add_section( 'prior_before_header_section', array(
			'title'    => __( 'Before Header Layout', 'prior' ),
			'panel'    => 'prior',
			'priority' => 20
		) );
		Kirki::add_section( 'prior_main_header_section', array(
			'title'    => __( 'Main Header Layout', 'prior' ),
			'panel'    => 'prior',
			'priority' => 30
		) );
		Kirki::add_section( 'prior_after_header_section', array(
			'title'    => __( 'After Header', 'prior' ),
			'panel'    => 'prior',
			'priority' => 40
		) );
	}

	private function addFields() {
		foreach ( self::$fields as $setting => $field ) {
			list( $controlClass, $section ) = $field;
			if ( method_exists( $controlClass, 'register' ) ) {
				$controlClass::register( $setting, $section );
			}
		}
	}

	private function registerSidebars() {
		foreach ( self::$fields as $setting => $field ) {
			list( $controlClass, $section ) = $field;
			if ( method_exists( $controlClass, 'registerSidebar' ) ) {
				$controlClass::registerSidebar( $setting, $section );
			}
		}
	}

	public static function getSetting( $setting ) {
		if ( ! isset( self::$fields[ $setting ] ) ) {
			return false;
		}
		$settingClass = self::$fields[ $setting ][0];
		$default      = isset( $settingClass ) ? $settingClass::$default : '';

		return get_theme_mod( $setting, $default );
	}

}