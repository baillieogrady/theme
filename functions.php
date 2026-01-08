<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// utiltiy
function mytheme_is_vite_dev() {
    return isset($_GET['dev']);
}

// actions
function mytheme_enqueue_assets() {

    if ( mytheme_is_vite_dev() ) {

        $vite = 'http://10.229.39.146:5173';

        wp_enqueue_script('vite-client', $vite . '/@vite/client', [], null);
        wp_enqueue_script('mytheme-js', $vite . '/js/main.js', [], null, true);
        wp_enqueue_style('mytheme-style', $vite . '/css/style.scss', [], null);

    } else {

        wp_enqueue_script(
            'mytheme-js',
            get_template_directory_uri() . '/build/main.min.js',
            [],
            '1.0',
            true
        );

        wp_enqueue_style(
            'mytheme-style',
            get_template_directory_uri() . '/build/style.css',
            [],
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');

// filters
add_filter('script_loader_tag', function ($tag, $handle, $src) {

    if (in_array($handle, ['vite-client', 'mytheme-js'], true)) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}, 10, 3);
