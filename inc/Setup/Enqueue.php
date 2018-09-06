<?php

namespace Prior\Setup;

class Enqueue
{
    /**
     * Register hooks and actions
     */
    public function register()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {
        /* Add main theme scripts and styles */
        wp_enqueue_style('prior', get_template_directory_uri() . '/dist/style.css', [], '1.0.0', 'all');
        wp_enqueue_script('prior', get_template_directory_uri() . '/dist/bundle.js', [], '1.0.0', true);
    }
}