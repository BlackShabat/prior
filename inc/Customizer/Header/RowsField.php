<?php

namespace Prior\Customizer\Header;

class RowsField {
	public static $default = '1';

	public static function register( \WP_Customize_Manager $wp_customize, $setting, $section ) {

		$wp_customize->add_setting( $setting, array(
			'default' => self::$default,
		) );

		$wp_customize->add_control( 'header_rows_control', array(
			'label'    => __( 'Rows', 'prior' ),
			'section'  => $section,
			'settings' => $setting,
			'type'     => 'number',
		) );
	}
}