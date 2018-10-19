<?php

namespace Prior\Setup;

class Sidebar {
	public function __construct() {
		$this->registerHooks();
	}

	/**
	 * Register hooks and actions
	 */
	public function registerHooks() {
		add_action( 'widgets_init', [ $this, 'registerSidebar' ] );
	}

	public function registerSidebar() {
		register_sidebar( [
			'name'          => esc_html__( 'Header', 'prior' ),
			'id'            => 'header-main',
			'description'   => esc_html__( 'Widgets for main header area', 'prior' ),
			'before_widget' => '<section id="%1$s" class="pl-header-main %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="pl-header-main__title">',
			'after_title'   => '</h2>',
		] );
	}
}