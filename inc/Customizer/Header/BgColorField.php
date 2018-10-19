<?php

namespace Prior\Customizer\Header;

class BgColorField {
	public function __construct( \WP_Customize_Manager $wp_customize, $setting, $section ) {

		$wp_customize->add_setting( $setting, array(
			'default' => 'red',
		) );

		$wp_customize->add_control( 'header_color_control', array(
			'label'    => __( 'Color', 'prior' ),
			'section'  => $section,
			'settings' => $setting,
			'type'     => 'text',
		) );
	}
}