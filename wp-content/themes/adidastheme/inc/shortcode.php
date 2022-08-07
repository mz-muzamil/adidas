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
