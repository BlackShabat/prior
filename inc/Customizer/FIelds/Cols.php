<?php

namespace Prior\Customizer\Fields;

use Kirki;

class Cols {
	private static $counter;

	public static $default = [
		[
			'gap_1'                => 'none',
			'children_direction_1' => 'horizontal'
		]
	];

	public static function register( $setting, $section ) {

		/*add_filter( 'kirki_controls_repeater_value_' . $setting, function ( $value ) {
			dump( $value );

			return $value;
		} );*/

		Kirki::add_field( $setting, [
			'type'         => 'repeater',
			'label'        => esc_attr__( 'Cols', 'prior' ),
			'description'  => esc_attr__( 'Add widgets inside', 'prior' ),
			'section'      => $section,
			'priority'     => 90,
			'row_label'    => [
				'type'  => 'text',
				'value' => esc_attr__( 'Col' .  self::$counter, 'prior' ),
			],
			'button_label' => esc_attr__( 'Add new col', 'prior' ),
			'settings'     => $setting,
			'default'      => self::$default,
			'fields'       => [
				'gap_1'                => [
					'type'        => 'text',
					'label'       => esc_attr__( 'Columns gap', 'prior' ),
					'description' => esc_attr__( 'Horizontal and slash vertical gap between columns. 20px/30px', 'prior' ),
					'default'     => self::$default[0]['gap_1'],
				],
				'children_direction_1' => [
					'type'        => 'radio',
					'label'       => esc_attr__( 'Widgets direction', 'prior' ),
					'description' => esc_attr__( 'Chose in which way should order children items is this column', 'prior' ),
					'default'     => self::$default[0]['children_direction_1'],
					'choices'     => [
						'horizontal' => esc_attr__( 'Horizontal', 'prior' ),
						'vertical'   => esc_attr__( 'Vertical', 'prior' )
					]
				],
			]
		] );

		self::$counter++;
	}
}