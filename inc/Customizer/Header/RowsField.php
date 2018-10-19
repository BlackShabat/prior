<?php

namespace Prior\Customizer\Header;

class RowsField {
	public function __construct( \WP_Customize_Manager $wp_customize, $setting, $section ) {

		$wp_customize->add_setting( $setting, array(
			'default' => '1',
		) );

		$wp_customize->add_control( 'header_rows_control', array(
			'label'    => __( 'Rows', 'prior' ),
			'section'  => $section,
			'settings' => $setting,
			'type'     => 'number',
		) );
	}
}