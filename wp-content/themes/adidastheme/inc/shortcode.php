<?php
function link_shortcode($atts)
{
    ob_start();

    $atts = shortcode_atts(
        array(
            'url' => '',
            'title' => '',
            'class' => ''
        ),
        $atts,
        'url',
        'title',
        'class',
    );

    $url = $atts['url'];
    $title = $atts['title'];
    $class = $atts['class'];

?>
    <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_attr($url); ?>"><?php echo $title; ?></a>
<?php

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('wpb-link', 'link_shortcode');

function copyright_year_shortcode()
{
    ob_start();

    echo date("Y");

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('copyright_year', 'copyright_year_shortcode');

function show_datetime()
{
    ob_start();

    $time = new DateTime("Asia/Karachi");
    $date = $time->format('l j F, Y');
    $time = $time->format('g:i:s');

?>
    <div class="datetime-widget text-white">
        <h5><?php echo $date; ?></h5>
        <div class="time-text"><?php echo $time; ?></div>
    </div>
    <?php

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('date_time', 'show_datetime');


// Shortcode to show twitter feeds on homepage
$bearer_token = get_option('bearer_token');
define(
    "HEADERS",
    [
        "Content-Type: application/json",
        "Authorization: Bearer " . $bearer_token . ""
    ]
);

function get_twitter_data()
{
    ob_start();

    if (!empty(get_option('twitter_user_id'))) {
        $url = "https://api.twitter.com/2/users/" . get_option('twitter_user_id') . "/tweets";
        $tweets = make_curl_call($url, "GET", HEADERS);
        $tweets = json_decode($tweets, true);
        // echo "<pre>";
        // print_r($tweets);
        // exit;
        if (!empty($tweets) && $tweets["status"] != 401 && empty($tweets["errors"])) {
            foreach ($tweets["data"] as $tweet) { ?>
                <p class="border-bottom pb-3"><?php echo $tweet["text"] ?></p>
            <?php }
        } else { ?>
            <p class="mt-5 mb-5 text-center">can not access the twitter feeds please check your internet connection.</p>
        <?php }
    } else { ?>
        <p class="mt-5 mb-5 text-center">Please go to dashboard and check the in the theme options (Twitter User Numeric Id & Bearer Token) fields must be filled with valid user info otherwise tweets will not be showup.</p>
<?php }

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('show_tweets', 'get_twitter_data');
