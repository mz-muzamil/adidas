<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>
<div class="container mt-5">
    <h1 class="text-white mb-4">
        <?php
        printf(
            /* translators: %s: query term */
            esc_html__('Search Results for: %s', 'adidastheme'),
            '<span>' . get_search_query() . '</span>'
        );
        ?>
    </h1>
    <div class="row">
        <div class="col-md-12 text-white">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <article <?php post_class("custom-article mb-5 full-width"); ?> id="post-<?php the_ID(); ?>">
                    <?php
                    if (has_post_thumbnail()) { ?>
                        <figure><?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?></figure>
                    <?php } ?>

                    <div class="text pb-3 border-bottom <?php if (!has_post_thumbnail()) echo "m-0" ?>">
                        <h4 class="text-white"><a class="h4 text-white" href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
                        <div class="text-white"><?php the_excerpt(); ?></div>
                        <a class="text-white" href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </article>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>