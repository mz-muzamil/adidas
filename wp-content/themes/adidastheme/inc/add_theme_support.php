<?php
if (!function_exists('adidas_setup_theme')) {
    function adidas_setup_theme()
    {
        add_theme_support("post-thumbnails");
        add_theme_support("html5", array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        add_theme_support("woocommerce");
        add_theme_support("title-tag");

        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'adidastheme'),
            'secondry_menu'  => __('Secondry Menu', 'adidastheme'),
        ));

        add_theme_support(
            'custom-background',
            apply_filters(
                'adidas_custom_background',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
    add_action('after_setup_theme', 'adidas_setup_theme');
}
