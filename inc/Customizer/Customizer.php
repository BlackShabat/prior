<?php

namespace Prior\Customizer;

class Customizer {

	private $wp_customize;

	private static $fields = [
		'header_rows_setting' => [ Header\RowsField::class, 'header_section' ],
		'header_bg_setting'   => [ Header\BgColorField::class, 'header_section' ]
	];

	public function __construct() {
		add_action( 'customize_register', function ( \WP_Customize_Manager $wp_customize ) {
			$this->wp_customize = $wp_customize;
			$this->addPanels();
			$this->addSections();
			$this->addFields();

		} );
	}

	private function addPanels() {
		$this->wp_customize->add_panel( 'prior', array(
			'priority' => 1,
			'title'    => __( 'Prior', 'prior' ),
		) );
	}

	private function addSections() {
		$this->wp_customize->add_section( 'header_section', array(
			'title' => __( 'Header', 'prior' ),
			'panel' => 'prior'
		) );
	}

	private function addFields() {
		foreach ( self::$fields as $setting => $field ) {
			if ( class_exists( $field[0] ) ) {
				$field[0]::register( $this->wp_customize, $setting, $field[1] );
			}
		}
	}

	public static function getSetting( $setting ) {
		$settingClass = self::$fields[ $setting ][0];
		$default      = isset( $settingClass ) ? $settingClass::$default : '';

		return get_theme_mod( $setting, $default );
	}

}