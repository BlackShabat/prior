<?php

namespace Prior\Customizer\Fields;

use Kirki;

class BgColor {

	public static function register( $setting, $section ) {
		Kirki::add_field( $setting, [
			'type'     => 'color',
			'settings' => $setting . '_setting',
			'label'    => esc_attr__( 'Background Color', 'prior' ),
			'section'  => $section,
			'default'  => '',
			'priority' => 10
		] );
	}
}