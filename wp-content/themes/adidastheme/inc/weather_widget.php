<?php

/**
 * adidastheme sibebar definitions
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

class Weather_widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'weather_widget',
            'description' => 'Show Weather Data',
        );
        parent::__construct('weather_widget', 'Weather', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=lahore,PK,PK&units=metric&appid=933c2411abf1aca12fe5e19659fe36cc";
        $response = make_curl_call($url, "GET", []);
        $response = json_decode($response, true);
        // echo "<pre>";
        // print_r($response);
?>
        <div class="weather-info text-white">
            <h1 class="text-center mb-2"><?php echo $response["name"] ?></h1>
            <h2 class="text-center mb-4">
                <img src="https://openweathermap.org/img/w/<?php echo $response["weather"][0]["icon"]; ?>.png" class="weather-icon" />
                <?php echo $response["main"]["temp"] ?><sup>&#8451;</sup>
            </h2>

            <h6 class="text-end"><span class="float-start">Feels Like:</span> <?php echo $response["main"]["feels_like"]; ?><sup>&#8451;</sup></h6>
            <h6 class="text-end"><span class="float-start">Humidity:</span> <?php echo $response["main"]["humidity"]; ?>%</h6>
            <h6 class="text-end"><span class="float-start">Visibility:</span> <?php echo $response["visibility"] / 1000; ?>km</h6>
            <h6 class="text-end"><span class="float-start">Pressure:</span> <?php echo $response["main"]["pressure"]; ?> mb</h6>
            <h6 class="text-end"><span class="float-start">Temp: Max - Min:</span> <?php echo $response["main"]["temp_min"] . " ~ " .  $response["main"]["temp_max"] ?><sup>&#8451;</sup></h6>
        </div>
<?php
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }
}
add_action('widgets_init', function () {
    register_widget('Weather_widget');
});
