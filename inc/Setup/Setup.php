<?php

namespace Prior\Setup;

use \Prior\Customizer\Fields\Colors;

class Setup {
	public function __construct() {
		$this->config();
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
	}

	public function setup() {
		// Multilingual support
		load_theme_textdomain( 'prior', get_template_directory() . '/languages' );

		// Default Theme Support options better have
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		// Activate Post formats if you need
		add_theme_support( 'post-formats', [
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		] );

		// Add support for full and wide align images
		add_theme_support( 'align-wide' );

		// Register navigation menus
		register_nav_menus( [
			'top_menu'    => esc_html__( 'Top Bar', 'prior' ),
			'main_menu'   => esc_html__( 'Main', 'prior' ),
			'footer_menu' => esc_html__( 'Footer', 'prior' ),
			'mobile_menu' => esc_html__( 'Mobile', 'prior' )
		] );
	}

	public function config() {
		// Add support for custom color palettes
		Colors::addPalette( [
			[
				'name'  => 'White',
				'slug'  => 'white',
				'color' => '#fff',
			],
			[
				'name'  => 'Black',
				'slug'  => 'black',
				'color' => '#000',
			],
			[
				'name'  => 'Primary',
				'slug'  => 'primary',
				'color' => '000',
			]
		] );
	}
}