<?php

namespace Prior\Setup;

class Enqueue
{
    public function __construct() {
        $this->registerHooks();
    }
    /**
     * Register hooks and actions
     */
    public function registerHooks()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {
        /* Add main theme scripts and styles */
        wp_enqueue_style('prior', get_template_directory_uri() . '/dist/css/style.css', [], '1.0.0', 'all');
        wp_enqueue_script('prior', get_template_directory_uri() . '/dist/js/app.js', [], '1.0.0', true);
    }
}