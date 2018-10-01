<?php
/**
 * Settings API
 *
 * @package awps
 */

namespace Prior\Setup;

/**
 * Settings API Class
 */
class Settings {
	/**
	 * Settings array
	 */
	public $settings = array();

	/**
	 * Sections array
	 */
	public $sections = array();

	/**
	 * Fields array
	 */
	public $fields = array();

	/**
	 * Script path
	 */
	public $scriptPath;

	/**
	 * Enqueues array
	 */
	public $enqueues = array();

	/**
	 * Admin pages array to enqueue scripts
	 */
	public $enqueueOnPages = array();

	/**
	 * Admin pages array
	 */
	public $adminPages = array();

	/**
	 * Admin subpages array
	 */
	public $adminSubpages = array();

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	public function register() {

		if ( ! empty( $this->enqueues ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'adminScripts' ) );
		}

		if ( ! empty( $this->adminPages ) || ! empty( $this->adminSubpages ) ) {
			add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		}

		if ( ! empty( $this->settings ) ) {
			add_action( 'admin_init', array( $this, 'registerCustomSettings' ) );
		}
	}

	/**
	 * Dynamically enqueue styles and scripts in admin area
	 *
	 * @param  array $scripts file paths or wp related keywords of embedded files
	 * @param  array $pages pages id where to load scripts
	 *
	 * @return  $this | void instance;
	 */
	public function adminEnqueue( $scripts = array(), $pages = array() ) {
		if ( empty( $scripts ) ) {
			return;
		}

		$i = 0;
		foreach ( $scripts as $key => $value ) :
			foreach ( $value as $val ):
				$this->enqueues[ $i ] = $this->enqueueScript( $val, $key );
				$i ++;
			endforeach;
		endforeach;

		if ( ! empty( $pages ) ) :
			$this->enqueueOnPages = $pages;
		endif;

		return $this;
	}

	/**
	 * Call the right WP functions based on the file or string passed
	 *
	 * @param  array $script file path or wp related keyword of embedded file
	 * @param  string $type style | script
	 *
	 * @return array | string functions
	 */
	private function enqueueScript( $script, $type ) {
		if ( $script === 'media_uploader' ) {
			return 'wp_enqueue_media';
		}

		return ( $type === 'style' ) ? array( 'wp_enqueue_style' => $script ) : array( 'wp_enqueue_script' => $script );
	}

	/**
	 * Print the methods to be called by the admin_enqueue_scripts hook
	 *
	 * @param  string $hook page id or filename passed by admin_enqueue_scripts
	 */
	public function adminScripts( $hook ) {
		// dd( $hook );
		$this->enqueueOnPages = ( ! empty( $this->enqueueOnPages ) ) ? $this->enqueueOnPages : array( $hook );

		if ( in_array( $hook, $this->enqueueOnPages ) ) :
			foreach ( $this->enqueues as $enqueue ) :
				if ( $enqueue === 'wp_enqueue_media' ) :
					$enqueue();
				else :
					foreach ( $enqueue as $key => $val ) {
						$key( $val, $val );
					}
				endif;
			endforeach;
		endif;
	}

	/**
	 * Injects user's defined pages array into $admin_pages array
	 *
	 * @param  array $pages array of user's defined pages
	 *
	 * @return $this
	 */
	public function addPages( $pages ) {
		$this->adminPages = $pages;

		return $this;
	}

	public function withSubPage( $title = null ) {
		if ( empty( $this->adminPages ) ) {
			return $this;
		}

		$adminPage = $this->adminPages[0];

		$subpage = array(
			array(
				'parent_slug' => $adminPage['menu_slug'],
				'page_title'  => $adminPage['page_title'],
				'menu_title'  => ( $title ) ? $title : $adminPage['menu_title'],
				'capability'  => $adminPage['capability'],
				'menu_slug'   => $adminPage['menu_slug'],
				'callback'    => $adminPage['callback']
			)
		);

		$this->adminSubpages = $subpage;

		return $this;
	}

	/**
	 * Injects user's defined pages array into $admin_subpages array
	 *
	 * @param  array $pages array of user's defined pages
	 *
	 * @return $this
	 */
	public function addSubPages( $pages ) {
		$this->adminSubpages = ( count( $this->adminSubpages ) == 0 ) ? $pages : array_merge( $this->adminSubpages, $pages );

		return $this;
	}

	/**
	 * Call WordPress methods to generate Admin pages and subpages
	 */
	public function addAdminMenu() {
		foreach ($this->adminPages as $page ) {
			add_menu_page( $page['pageTitle'], $page['menuTitle'], $page['capability'], $page['menuSlug'], $page['callback'], $page['iconUrl'], $page['position'] );
		}

		foreach ($this->adminSubpages as $page ) {
			add_submenu_page( $page['parentSlug'], $page['pageTitle'], $page['menuTitle'], $page['capability'], $page['menuSlug'], $page['callback'] );
		}
	}

	/**
	 * Injects user's defined settings array into $settings array
	 *
	 * @param  array $args array of user's defined settings
	 *
	 * @return $this
	 */
	public function addSettings( $args ) {
		$this->settings = $args;

		return $this;
	}

	/**
	 * Injects user's defined sections array into $sections array
	 *
	 * @param  array $args array of user's defined sections
	 *
	 * @return $this
	 */
	public function addSections( $args ) {
		$this->sections = $args;

		return $this;
	}

	/**
	 * Injects user's defined fields array into $fields array
	 *
	 * @param  array $args array of user's defined fields
	 *
	 * @return $this
	 */
	public function addFields( $args ) {
		$this->fields = $args;

		return $this;
	}

	/**
	 * Call WordPress methods to register settings, sections, and fields
	 */
	public function registerCustomSettings() {
		foreach ( $this->settings as $setting ) {
			register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) );
		}

		foreach ( $this->sections as $section ) {
			add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
		}

		foreach ( $this->fields as $field ) {
			add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
		}
	}
}
