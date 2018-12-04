<?php

namespace Prior\Customizer\Fields;

use Kirki;

class Cols {

	public static function register( $setting, $section ) {

		Kirki::add_field( $setting, [
			'type'         => 'repeater',
			'label'        => esc_attr__( 'Cols', 'prior' ),
			'description'  => esc_attr__( 'Add widgets inside', 'prior' ),
			'section'      => $section,
			'priority'     => 90,
			'row_label'    => [
				'type'  => 'text',
				'value' => esc_attr__( 'Col', 'prior' ),
			],
			'button_label' => esc_attr__( 'Add new col', 'prior' ),
			'settings'     => $setting,
			'fields'       => [
				$setting . '_gap'                => [
					'type'        => 'text',
					'label'       => esc_attr__( 'Columns gap', 'prior' ),
					'description' => esc_attr__( 'Horizontal and slash vertical gap between columns. 20px/30px', 'prior' ),
					'default'     => 'none',
				],
				$setting . '_children_direction' => [
					'type'        => 'radio',
					'label'       => esc_attr__( 'Widgets direction', 'prior' ),
					'description' => esc_attr__( 'Chose in which way should order children items is this column', 'prior' ),
					'default'     => 'horizontal',
					'choices'     => [
						'horizontal' => esc_attr__( 'Horizontal', 'prior' ),
						'vertical'   => esc_attr__( 'Vertical', 'prior' )
					]
				],
			]
		] );
	}
}