<?php

/**
 * adidastheme functions and definitions
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

include(get_template_directory() . "/inc/add_theme_support.php");
include(get_template_directory() . "/inc/widgets.php");
include(get_template_directory() . "/inc/theme_options.php");
include(get_template_directory() . "/inc/events.php");
include(get_template_directory() . "/inc/shortcode.php");
include(get_template_directory() . "/inc/pagination.php");
include(get_template_directory() . "/inc/weather_widget.php");
include(get_template_directory() . "/inc/datetime_widget.php");

function adidas_enqueue_script_styles()
{
    wp_enqueue_style("owl-styles", get_template_directory_uri() . "/lib/OwlCarousel/assets/css/owl.carousel.min.css", array(), false, "all");
    wp_enqueue_style("owl-theme-styles", get_template_directory_uri() . "/lib/OwlCarousel/assets/css/owl.theme.default.min.css", array(), false, "all");
    wp_enqueue_style("boostrap-styles", get_template_directory_uri() . "/lib/bootstrap/css/bootstrap.min.css", array(), false, "all");
    wp_enqueue_style("owl-styles", get_template_directory_uri() . "/lib/fontawesome/css/all.min.css", array(), false, "all");
    wp_enqueue_style("fancybox-styles", get_template_directory_uri() . "/lib/fancybox/css/fancybox.css", array(), false, "all");
    wp_enqueue_style("fancybox-styles", get_template_directory_uri() . "/lib/easy-responsive-aabs-to-accordion/css/easy-responsive-tabs.css", array(), false, "all");
    wp_enqueue_style("custom-styles", get_template_directory_uri() . "/assets/css/custom.css", array(), false, "all");
    wp_enqueue_style("responsive-styles", get_template_directory_uri() . "/assets/css/responsive.css", array(), false, "all");


    wp_enqueue_script("fontawesome-scripts", get_template_directory_uri() . "/lib/fontawesome/js/all.min.js", array('jquery'), false, true);
    wp_enqueue_script("owl-scripts", get_template_directory_uri() . "/lib/OwlCarousel/assets/js/owl.carousel.min.js", array('jquery'), false, true);
    wp_enqueue_script("fancybox-scripts", get_template_directory_uri() . "/lib/fancybox/js/fancybox.umd.js", array('jquery'), false, true);
    wp_enqueue_script("responsive-tabs-scripts", get_template_directory_uri() . "/lib/easy-responsive-aabs-to-accordion/js/easyResponsiveTabs.js", array('jquery'), false, true);
    wp_enqueue_script("bootstrap-scripts", get_template_directory_uri() . "/lib/bootstrap/js/bootstrap.bundle.min.js", array('jquery'), false, true);
    wp_enqueue_script("custom-scripts", get_template_directory_uri() . "/assets/js/custom.js", array('jquery'), false, true);
}
add_action("wp_enqueue_scripts", "adidas_enqueue_script_styles");


function load_custom_wp_admin_style()
{
    wp_register_style('date_date_time_css', get_template_directory_uri() . '/lib/datetimepicker/jquery.datetimepicker.css', false, '1.0.0');
    wp_enqueue_style('date_date_time_css');
    wp_register_style('admin_custom_css', get_template_directory_uri() . '/assets/css/admin-custom.css', false, '1.0.0');
    wp_enqueue_style('admin_custom_css');
    wp_register_script('date_date_time_moment_js', get_template_directory_uri() . '/lib/datetimepicker/moment.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('date_date_time_moment_js');
    wp_register_script('jquery_repeater_js', get_template_directory_uri() . '/lib/jquery-repeater/jquery.repeater.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('jquery_repeater_js');
    wp_register_script('admin_custom_scripts', get_template_directory_uri() . '/assets/js/admin-custom.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('admin_custom_scripts');
    
    wp_register_script('date_date_time_js', get_template_directory_uri() . '/lib/datetimepicker/jquery.datetimepicker.full.js', ['jquery', 'date_date_time_moment_js'], '1.0.0', true);
    wp_enqueue_script('date_date_time_js');
    wp_register_script('date_date_time_custom_js', get_template_directory_uri() . '/lib/datetimepicker/custom-datetimepicker-script.js', ['jquery', 'date_date_time_js'], '1.0.0', true);
    wp_enqueue_script('date_date_time_custom_js');
    wp_enqueue_media(); 
}

add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

function sports()
{
    $labels = array(
        'name'               => __('Sports'),
        'singular_name'      => __('Sports New'),
        'add_new'            => __('Add New Sport'),
        'add_new_item'       => __('Add New Sports New'),
        'edit_item'          => __('Edit Sports New'),
        'new_item'           => __('Add New Sports New'),
        'view_item'          => __('View Sports New'),
        'search_items'       => __('Search Sports New'),
        'not_found'          => __('No Sports New found'),
        'not_found_in_trash' => __('No Sports New found in trash')
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
        'menu_icon'            => 'dashicons-groups'
    );
    register_post_type('sports', $args);
}
add_action('init', 'sports');

function get_all_sticky_posts()
{
    $sticky = get_option('sticky_posts');
    rsort($sticky);
    $args = array(
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby'   => 'rand',
        'post__in' => $sticky
    );
    $results  = get_posts($args);
    return $results;
}

function make_curl_call($url, $method, $headers)
{
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}

add_action("wp_ajax_home_slider", "home_slider");
function home_slider()
{
    echo "<pre>";
    print_r($_POST["data"]);
    wp_die();
}

add_action('admin_post_home_slider_action_hook', 'home_slider_func');
function home_slider_func()
{


    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    exit;

    $filename = $_FILES["slide_image"]["name"];
    $tempname = $_FILES["slide_image"]["tmp_name"];



    $folder = "./image/" . $filename;

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }


    exit;

    update_option('homeSlider', serialize($_POST));
    $url = admin_url("/themes.php?page=adidas-theme-options");
    wp_redirect($url);
    exit;
}
