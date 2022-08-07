<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (have_posts()) {
            ?>

                <?php
                the_archive_title('<h1 class="text-white mb-4">', '</h1>');
                the_archive_description('<div class="taxonomy-description">', '</div>');
                ?>

            <?php
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
    </div>
</div>
<?php get_footer(); ?>