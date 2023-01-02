<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-xs-12 text-white">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <h1 class="mb-4"><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php
                    the_content();
                    ?>
                </div>
            <?php }
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