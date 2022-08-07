<?php
include(get_template_directory() . "/inc/add_theme_support.php");
include(get_template_directory() . "/inc/widgets.php");
include(get_template_directory() . "/inc/theme_options.php");
include(get_template_directory() . "/inc/events.php");
include(get_template_directory() . "/inc/shortcode.php");


function adidas_enqueue_script_styles()
{
    wp_enqueue_style("owl-styles", get_template_directory_uri() . "/lib/OwlCarousel/assets/css/owl.carousel.min.css", array(), false, "all");
    wp_enqueue_style("owl-theme-styles", get_template_directory_uri() . "/lib/OwlCarousel/assets/css/owl.theme.default.min.css", array(), false, "all");
    wp_enqueue_style("boostrap-styles", get_template_directory_uri() . "/lib/bootstrap/css/bootstrap.min.css", array(), false, "all");
    wp_enqueue_style("owl-styles", get_template_directory_uri() . "/lib/fontawesome/css/all.min.css", array(), false, "all");
    wp_enqueue_style("fancybox-styles", get_template_directory_uri() . "/lib/fancybox/css/fancybox.css", array(), false, "all");
    wp_enqueue_style("fancybox-styles", get_template_directory_uri() . "/lib/easy-responsive-aabs-to-accordion/css/easy-responsive-tabs.css", array(), false, "all");
    wp_enqueue_style("custom-styles", get_template_directory_uri() . "/assets/css/custom.css", array(), false, "all");
    wp_enqueue_style("responsive-styles", get_template_directory_uri() . "/assets/css/responsive.css", array(), false, "all");


    wp_enqueue_script("fontawesome-scripts", get_template_directory_uri() . "/lib/fontawesome/js/all.min.js", array('jquery'), false, true);
    wp_enqueue_script("owl-scripts", get_template_directory_uri() . "/lib/OwlCarousel/assets/js/owl.carousel.min.js", array('jquery'), false, true);
    wp_enqueue_script("fancybox-scripts", get_template_directory_uri() . "/lib/fancybox/js/fancybox.umd.js", array('jquery'), false, true);
    wp_enqueue_script("responsive-tabs-scripts", get_template_directory_uri() . "/lib/easy-responsive-aabs-to-accordion/js/easyResponsiveTabs.js", array('jquery'), false, true);
    wp_enqueue_script("bootstrap-scripts", get_template_directory_uri() . "/lib/bootstrap/js/bootstrap.bundle.min.js", array('jquery'), false, true);
    wp_enqueue_script("custom-scripts", get_template_directory_uri() . "/assets/js/custom.js", array('jquery'), false, true);
}
add_action("wp_enqueue_scripts", "adidas_enqueue_script_styles");


function load_custom_wp_admin_style()
{
    wp_register_style('date_date_time_css', get_template_directory_uri() . '/lib/datetimepicker/jquery.datetimepicker.css', false, '1.0.0');
    wp_enqueue_style('date_date_time_css');
    wp_register_script('date_date_time_moment_js', get_template_directory_uri() . '/lib/datetimepicker/moment.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('date_date_time_moment_js');
    wp_register_script('date_date_time_js', get_template_directory_uri() . '/lib/datetimepicker/jquery.datetimepicker.full.js', ['jquery', 'date_date_time_moment_js'], '1.0.0', true);
    wp_enqueue_script('date_date_time_js');
    wp_register_script('date_date_time_custom_js', get_template_directory_uri() . '/lib/datetimepicker/custom-datetimepicker-script.js', ['jquery', 'date_date_time_js'], '1.0.0', true);
    wp_enqueue_script('date_date_time_custom_js');
}

add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

function sports()
{
    $labels = array(
        'name'               => __('Sports'),
        'singular_name'      => __('Sports New'),
        'add_new'            => __('Add New Sport'),
        'add_new_item'       => __('Add New Sports New'),
        'edit_item'          => __('Edit Sports New'),
        'new_item'           => __('Add New Sports New'),
        'view_item'          => __('View Sports New'),
        'search_items'       => __('Search Sports New'),
        'not_found'          => __('No Sports New found'),
        'not_found_in_trash' => __('No Sports New found in trash')
    );
    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'comments',
        'revisions',
    );
    $args = array(
        'labels'               => $labels,
        'supports'             => $supports,
        'public'               => true,
        'capability_type'      => 'post',
        'rewrite'              => array('slug' => '', 'sports' => false),
        'has_archive'          => true,
        'menu_position'        => null,
        'menu_icon'            => 'dashicons-groups'
    );
    register_post_type('sports', $args);
}
add_action('init', 'sports');

function get_all_sticky_posts()
{
    $sticky = get_option('sticky_posts');
    rsort($sticky);
    $args = array(
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'post__in' => $sticky
    );
    $results  = get_posts($args);
    return $results;
}

function make_curl_call($url)
{
    $cn = curl_init();
    curl_setopt($cn, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cn, CURLOPT_URL, $url);    // get the contents using url
    $weatherdata = curl_exec($cn); // execute the curl request
    curl_close($cn); //close the cURL
    return $weatherdata;
}

function get_weather_data()
{
    ob_start();

    $url = "http://api.openweathermap.org/data/2.5/weather?q=Lahore,PK,PK&units=metric&appid=933c2411abf1aca12fe5e19659fe36cc";
    $response = make_curl_call($url);
    $response = json_decode($response, true);
    // echo "<pre>";
    // print_r($response);
?>
    <div class="weather-info text-white">
        <h1 class="text-center mb-2"><?php echo $response["name"] ?></h1>
        <h2 class="text-center mb-4"><?php echo $response["main"]["temp"] ?><sup>&#8451;</sup></h2>
        <h6 class="text-end"><span class="float-start">Feels Like:</span> <?php echo $response["main"]["feels_like"]; ?><sup>&#8451;</sup></h6>
        <h6 class="text-end"><span class="float-start">Humidity:</span> <?php echo $response["main"]["humidity"]; ?>%</h6>
        <h6 class="text-end"><span class="float-start">Visibility:</span> <?php echo $response["visibility"]/1000; ?>km</h6>
        <h6 class="text-end"><span class="float-start">Pressure:</span> <?php echo $response["main"]["pressure"]; ?> mb</h6>
        <h6 class="text-end"><span class="float-start">Temp: Max - Min:</span> <?php echo $response["main"]["temp_min"] . " ~ " .  $response["main"]["temp_max"] ?><sup>&#8451;</sup></h6>
    </div>
<?php

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('Weather', 'get_weather_data');
