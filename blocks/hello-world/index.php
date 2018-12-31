<?php


add_action( 'init', function () {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	wp_register_script(
		'prior-hello-world',
		get_template_directory_uri() . '/blocks/hello-world/index.js',
		[ 'wp-blocks', 'wp-i18n', 'wp-element' ],
		false,
		true
	);

	register_block_type( 'prior/hello-world', [
		'editor_script' => 'prior-hello-world'
	] );

} );

/*add_action('enqueue_block_editor_assets', function () {
	wp_enqueue_script('hello-world-js', get_template_directory_uri() . '/blocks/hello-world/index.js', ['wp-blocks', 'wp-element']);
	wp_enqueue_style('hello-world-editor-css', get_template_directory_uri() . '/blocks/hello-world/editor.css', ['wp-edit-blocks']);
});

add_action('enqueue_block_assets', function () {
	wp_enqueue_style('hello-world-css', get_template_directory_uri() . '/blocks/hello-world/style.css', ['wp-blocks']);
});*/