<?php

namespace Prior\Hooks;

class Actions {

	private static $actions = [
		'prior_before_page' => [
			'renderMobileNavigation' => 10
		],
		'prior_header'      => [
			'renderGutenbergHeader' => 10
		]

	];

	public function __construct() {
		foreach ( self::$actions as $action => $functions ) {
			foreach ( $functions as $function => $priority ) {
				//Hook class method or global function
				if ( method_exists( __CLASS__, $function ) ) {
					add_action( $action, [ __CLASS__, $function ], $priority );
				} elseif ( function_exists( $function ) ) {
					add_action( $action, $function, $priority );
				}
			}
		}
	}

	public static function renderGutenbergHeader() {
		$header = new \WP_Query( [
			'post_type' => 'prior-layouts',
            'p' => 1907
		] );
		while ( $header->have_posts() ) {
			$header->the_post();
			the_content();
		}
		wp_reset_postdata();
	}

	public static function renderMobileNavigation() {
		if ( wp_is_mobile() ) {
			get_template_part( 'views/components/mobile-navigation' );
		}
	}

	public static function renderHeaderLayout() {
		get_template_part( 'views/layouts/header' );
	}

	public static function renderMainNavigation() {
		if ( has_nav_menu( 'main_menu' ) ) {
			wp_nav_menu( [
				'theme_location'  => 'main_menu',
				'container'       => 'nav',
				'container_class' => 'pc-nav pc-nav--light pc-nav--horizontal pc-nav--dropdown',
				//'items_wrap' => '<nav class="pc-nav"><ul class="%2$s">%3$s</ul></nav>'
			] );
		}
	}

	public static function renderSidebar() {
		$main_header_cols   = get_theme_mod( 'prior_main_header_cols' );
		$before_header_cols = get_theme_mod( 'prior_before_header_cols' );
		?>

        <header class="pl-header">

			<?php if ( is_array( $before_header_cols ) ): ?>
                <div class="pl-header__before">
                    <div class="pl-header__container">
                        <div class="pl-header__row">
							<?php for ( $i = 1; $i <= count( $before_header_cols ); $i ++ ): ?>
                                <div class="pl-main-header__col">
									<?php dynamic_sidebar( 'prior_before_header_cols_col_' . $i ); ?>
                                </div>
							<?php endfor; ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>

			<?php if ( is_array( $main_header_cols ) ): ?>
                <div class="pl-header__main">
                    <div class="pl-header__container">
                        <div class="pl-header__row">
							<?php for ( $i = 1; $i <= count( $main_header_cols ); $i ++ ): ?>
                                <div class="pl-main-header__col">
									<?php dynamic_sidebar( 'prior_main_header_cols_col_' . $i ); ?>
                                </div>
							<?php endfor; ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>

        </header>

		<?php
	}
}