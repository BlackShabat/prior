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

	public static function registerSidebar( $setting, $section ) {
		$main_header_cols = get_theme_mod( $setting );

		if ( ! is_array( $main_header_cols ) ) {
			return;
		}

		for ( $i = 1; $i <= count( $main_header_cols ); $i ++ ) {
			register_sidebar( [
				'name'          => esc_html__( self::sectionToName( $section, $i ), 'prior' ),
				'id'            => $setting . '_col_' . $i,
				'description'   => esc_html__( 'Widgets for main header area', 'prior' ),
				'before_widget' => '<div class="pc-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="pc-widget__title">',
				'after_title'   => '</h2>',
			] );
		}
	}

	private static function sectionToName( $str, $count ) {
		$str = str_replace( '_', ' ', $str );
		$str = str_replace( [ 'prior', 'section' ], '', $str );
		$str = $str . ' (col ' . $count . ')';

		return $str;
	}

	private static function sectionToId( $str ) {
		$str = str_replace( [ 'prior_', '_section' ], '', $str );
		$str = str_replace( '_', '-', $str );

		return $str;
	}


}