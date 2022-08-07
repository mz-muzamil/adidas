<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>
<div class="container mt-5">
    <h1 class="text-white mb-3">Sports</h1>
    <div class="row">
        <?php
        $args = array('post_type' => 'sports', 'posts_per_page' => -1);
        $query = new WP_Query($args);
        ?>
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-md-2 mb-4">
                    <div class="item post-block">
                        <?php the_post_thumbnail("full"); ?>
                        <h5 class="mt-4 mb-0"><a class="text-white" href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h5>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        <?php else :  ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>