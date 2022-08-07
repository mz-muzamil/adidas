<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

function sports_cp_type()
{
    $labels = array(
        'name'               => __('Sports New'),
        'singular_name'      => __('Sports new'),
        'add_new'            => __('Add New Sports new'),
        'add_new_item'       => __('Add New Sports New'),
        'edit_item'          => __('Edit Sports new'),
        'new_item'           => __('Add New Sports New'),
        'view_item'          => __('View Sports new'),
        'search_items'       => __('Search Sports new'),
        'not_found'          => __('No Sports new found'),
        'not_found_in_trash' => __('No Sports new found in trash')
    );
    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'comments',
        'revisions',
    );
    $args = array(
        'labels'               => $labels,
        'supports'             => $supports,
        'public'               => true,
        'capability_type'      => 'post',
        'rewrite'              => array('slug' => '', 'sports' => false),
        'has_archive'          => true,
        'menu_position'        => null,
        'menu_icon'            => 'dashicons-buddicons-activity'
    );
    register_post_type('sports_cp_type', $args);
}
add_action('init', 'sports_cp_type');
