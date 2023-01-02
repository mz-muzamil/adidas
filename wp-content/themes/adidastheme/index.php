<?php

/**
 * The main template file
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header(); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <?php
            if (have_posts()) {
                // Start the loop.
                while (have_posts()) {
                    the_post();
                    get_template_part('loop-templates/content', get_post_format());
                }
            } else {
                get_template_part('loop-templates/content', 'none');
            }
            ?>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <aside class="sidebar-widgets">
                <?php dynamic_sidebar("home_sidebar"); ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer(); ?>