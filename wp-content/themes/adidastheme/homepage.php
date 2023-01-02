<?php

/**
 * Template Name: Home

 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>

<div class="banner">
    <div class="owl-carousel text-white home-banner owl-theme">
        <?php
        if (!empty(get_option("homeSlider"))) {
            $homeSliders = unserialize(get_option("homeSlider"));
            // echo "<pre>";
            // print_r($homeSliders);
            foreach ($homeSliders["outer-group"] as $homeSlider) { ?>
                <div class="item text-white" style="background: url('<?php echo $image["sizes"]["2048x2048"]; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xxl-6 col-xl-9 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h1><?php echo $homeSlider["slide_title"]; ?></h1>
                                <p><?php echo $homeSlider["slide_description"]; ?></p>
                            </div>
                            <?php
                            if (isset($homeSlider["video_url"]) && !empty($homeSlider["video_url"])) { ?>
                                <div class="col-xxl-6 col-xl-3 col-lg-12 col-md-12 col-sm-12 col-xs-12 position-relative">
                                    <div class="iconplay text-center">
                                        <a data-fancybox="gallery" href="<?php echo $homeSlider["video_url"]; ?>">
                                            <img src="<?php echo get_template_directory_uri() . "/assets/images/icon-play.png" ?>" alt="iconplay">
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="owl-carousel sports-carousel owl-theme">
                <?php
                $args = array('post_type' => 'sports', 'posts_per_page' => 16);
                $the_query = new WP_Query($args);
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <div class="item post-block">
                            <figure>
                                <?php the_post_thumbnail("full"); ?>
                            </figure>
                            <h5 class="mt-4 mb-0"><a class="text-white" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else :  ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
            </div>
            <div class="full-width mt-4 home-blogs">
                <div class="row">
                    <?php
                    $sticky_posts = get_all_sticky_posts();
                    foreach ($sticky_posts as $key => $sticky_post) {
                        $thumbnail_img =  get_the_post_thumbnail_url($sticky_post->ID, 'full');
                    ?>
                        <div class="col-xxl-12 mb-4">
                            <div class="card featured border-0" style="background-size: cover !important; background-position: center center !important; background: url('<?php echo $thumbnail_img; ?>');">
                                <div class="card-body">
                                    <a class="h4" href="<?php echo get_permalink($sticky_post->ID); ?>"><?php echo $sticky_post->post_title; ?></a>
                                    <p class="card-text"><?php echo $sticky_post->post_excerpt; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post__not_in' => get_option('sticky_posts')
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                    ?>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="card sticky h-100">
                                    <figure>
                                        <?php the_post_thumbnail('full'); ?>
                                    </figure>
                                    <div class="card-body text-white">
                                        <h4><a class="text-white" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <p class="card-text"><?php the_excerpt(); ?></p>
                                    </div>
                                    <a class="readmore" href="<?php the_permalink(); ?>">READ MORE</a>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="social-media-info full-width mb-4 mt-4">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6 col-sm-12 xs-12 mb-3">
                        <h2 class="text-white mb-3">Lates Tweets</h2>
                        <div class="card">
                            <div class="card-body twitter-feeds">
                                <?php echo do_shortcode("[show_tweets]"); ?>
                                <!-- <img class="img-fluid" src="<?php // echo get_template_directory_uri() . '/assets/images/twitter-feeds.png' 
                                                                    ?>" alt=""> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6 col-sm-12 xs-12 mb-3">
                        <h2 class="text-white mb-3">Facebook Page</h2>
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/assets/images/fb-like-page.png' ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="match-tabs mb-4 full-width">
                <ul class="nav nav-tabs" id="matchInfoTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="match-info-tab" data-bs-toggle="tab" data-bs-target="#match_info" type="button" role="tab" aria-controls="match_info" aria-selected="true">Match Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="match-results-tab" data-bs-toggle="tab" data-bs-target="#match_results" type="button" role="tab" aria-controls="match_results" aria-selected="false">Match Results</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="match-schedule-tab" data-bs-toggle="tab" data-bs-target="#match_schedule" type="button" role="tab" aria-controls="match_schedule" aria-selected="false">Match Schedule</button>
                    </li>
                </ul>
                <div class="tab-content accordion" id="matchTabsContent">
                    <div class="tab-pane show active" id="match_info" role="tabpanel" aria-labelledby="match-info-tab" tabindex="0">
                        <?php echo wpautop(get_option('match_info')); ?>
                    </div>
                    <div class="tab-pane" id="match_results" role="tabpanel" aria-labelledby="match-results-tab" tabindex="0">
                        <?php echo wpautop(get_option('match_results')); ?>
                    </div>
                    <div class="tab-pane" id="match_schedule" role="tabpanel" aria-labelledby="match-schedule-tab" tabindex="0">
                        <?php echo wpautop(get_option('match_schedule')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <aside class="sidebar-widgets">
                <?php dynamic_sidebar("home_sidebar"); ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer(); ?>