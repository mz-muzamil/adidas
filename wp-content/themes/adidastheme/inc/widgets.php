<?php

/**
 * adidastheme sibebar definitions
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('adidas_register_sidebars')) {
    function adidas_register_sidebars()
    {
        $agrs_home_sidebar = array(
            'name'          => __('Home Sidebard', 'adidastheme'),
            'id'            => 'home_sidebar',
            'description'   => __('Widgets in this area will be shown on Homepage', 'adidastheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        );


        $agrs_footer_sidebar = array(
            'name'          => __('Footer Full', 'adidastheme'),
            'id'            => 'footer_sidebar',
            'description'   => __('Full sized footer widget with dynamic grid', 'adidastheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s dynamic-classes">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        );
        register_sidebar($agrs_home_sidebar);
        register_sidebar($agrs_footer_sidebar);
    }
    add_action('after_setup_theme', 'adidas_register_sidebars', 1);
}

if (!function_exists('adidas_widget_classes')) {
    function adidas_widget_classes($params)
    {
        global $sidebars_widgets;
        $sidebars_widgets_count = apply_filters('sidebars_widgets', $sidebars_widgets);

        if (isset($params[0]['id']) && strpos($params[0]['before_widget'], 'dynamic-classes')) {
            $sidebar_id   = $params[0]['id'];
            $widget_count = count($sidebars_widgets_count[$sidebar_id]);

            $widget_classes = 'widget-count-' . $widget_count;
            if ($widget_count === 0 % 4 || $widget_count > 6) {
                $widget_classes .= ' col-md-3';
            } elseif ($widget_count === 6) {
                $widget_classes .= ' col-md-2';
            } elseif ($widget_count === 3) {
                $widget_classes .= ' col-md-4';
            } elseif ($widget_count === 4) {
                $widget_classes .= ' col-md-3';
            } elseif ($widget_count === 2) {
                $widget_classes .= ' col-md-6';
            } elseif ($widget_count === 1) {
                $widget_classes .= ' col-md-12';
            }
            $params[0]['before_widget'] = str_replace('dynamic-classes', $widget_classes, $params[0]['before_widget']);
        }
        return $params;
    }
}
add_filter('dynamic_sidebar_params', 'adidas_widget_classes');


function get_next_prev_event_posts($limit = 3, $date = '')
{
    global $wpdb, $post;

    echo $limit;
}
add_action('admin_post_nopriv_get_next_prev_events', 'get_next_prev_event_posts');
