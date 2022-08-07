<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="wrapper">
        <header id="masthead" class="header">
            <?php
            if (get_option('show_top_strip')) { ?>
                <div class="header-top-strip text-center full-width p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-12">
                                <?php echo get_option("header_top_strip") ?>
                                <?php
                                if (get_option('watch_now_video_url')) { ?>
                                    /
                                    <a data-fancybox="gallery" href="<?php echo get_option("watch_now_video_url"); ?>" class="text-green">WATCH NOW</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>

            <div class="middle-header full-width">
                <div class="container">
                    <div class="row align-items-center gy-3">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <div class="logo">
                                <?php if (!has_custom_logo()) { ?>

                                    <?php if (is_front_page() && is_home()) : ?>

                                        <h2 class="text-white mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h2>

                                    <?php else : ?>

                                        <a class="text-white h2 mb-0" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                                    <?php endif; ?>

                                <?php
                                } else {
                                    the_custom_logo();
                                }
                                ?>
                                <!-- end custom logo -->
                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_navigation" aria-controls="main_navigation" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            $secondry_menu = array('theme_location'       => 'secondry_menu');
                            wp_nav_menu($secondry_menu);
                            ?>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navigation navbar-expand-lg full-width">
                <div class="container">
                    <div class="collapse navbar-collapse" id="main_navigation">
                        <div class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            $primary_menu = array('theme_location'       => 'primary_menu');
                            wp_nav_menu($primary_menu);
                            ?>
                        </div>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </nav>
        </header>
        <section class="main" role="main">