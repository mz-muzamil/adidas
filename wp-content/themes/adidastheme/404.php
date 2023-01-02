<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>

<div class="container mt-5 text-center">
    <div class="row">
        <div class="col-md-12 text-white">
            <h1 class="mt-4"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'adidastheme'); ?></h1>
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'adidastheme'); ?></p>
            <div class="search404 full-width mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
            <div class="full-width mt-4">
                <a class="btn btn-success text-white mb-0" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url">Go back to Hom Page</a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
