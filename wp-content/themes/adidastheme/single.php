<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-xs-12 text-white text-white">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <h1><?php the_title(); ?></h1>
                <figure>
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail("full", array("class" => "img-fluid"));
                    }
                    ?>
                </figure>
                <div class="post-options">
                    <strong>Posted By:</strong> <?php the_author(); ?>,
                    <strong>Posted On:</strong> <?php the_date(); ?>
                </div>
                <div class="single-page-content">
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