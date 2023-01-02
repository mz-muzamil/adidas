<?php

/**
 * adidastheme sibebar definitions
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

class Datetime_widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'datetime_widget',
            'description' => 'Show Datetime Data',
        );
        parent::__construct('datetime_widget', 'Datetime', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $cityname = !empty(get_option("show_city_datetime")) ? get_option("show_city_datetime") : "";
        $cityTitle = explode("/", $cityname);
        $time = new DateTime("" . $cityname . "");
        $date = $time->format('l j F, Y');
        $time = $time->format('g:i:s A');
?>
        <div class="datetime-widget text-white">
            <h3>
                <?php
                echo $cityTitle[0] . ": " . preg_replace('/[^a-z0-9]/i', ' ', $cityTitle[1]);
                ?>
            </h3>
            <h5><?php echo $date; ?></h5>
            <div class="time-text"><?php echo $time; ?></div>
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
    register_widget('Datetime_widget');
});
