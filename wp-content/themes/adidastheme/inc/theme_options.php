<?php

/**
 * adidastheme theme options definitions
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

function adidas_theme_options_cb()
{ ?>
    <h1>Header Top Strip Settings</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('options_group1'); ?>
        <?php do_settings_sections('options_group1'); ?>
        <table class="form-table">
            <tr>
                <th>Header Top Strip</th>
                <td>
                    <input style="width: 100%;" type="text" name="header_top_strip" value="<?php echo esc_attr(get_option('header_top_strip')); ?>" />
                </td>
            </tr>
            <tr>
                <th>Show/Hide Top Strip</th>
                <td>
                    <input type="checkbox" name="show_top_strip" value="show_hide" <?php if (get_option('show_top_strip', true)) echo "checked" ?> />
                </td>
            </tr>
            <tr>
                <th>Watch Now Video URL</th>
                <td>
                    <input style="width: 100%;" type="text" name="watch_now_video_url" value="<?php echo esc_attr(get_option('watch_now_video_url')); ?>" />
                </td>
            </tr>
        </table>
        <?php submit_button("Save Options", "primary", "submit", true, null) ?>
    </form>
    <h1>Footer Disclaimer/Copyright Settings</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('footer_options'); ?>
        <?php do_settings_sections('footer_options'); ?>
        <table class="form-table">
            <tr>
                <th>Disclaimer/Copyright</th>
                <td>
                    <input style="width: 100%;" type="text" name="footer_copy_right" value="<?php echo esc_attr(get_option('footer_copy_right')); ?>" />
                </td>
            </tr>
            <tr>
                <th>Show/Hide footer Bottom Strip</th>
                <td>
                    <input type="checkbox" name="show_hide_footer_strip" value="show_hide_footer" <?php if (get_option('show_hide_footer_strip', true)) echo "checked" ?> />
                </td>
            </tr>
        </table>
        <?php submit_button("Save Options", "primary", "submit", true, null) ?>
    </form>
    <h1>Home Page Tabs Content</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('tabs_content'); ?>
        <?php do_settings_sections('tabs_content'); ?>
        <table class="form-table">
            <tr>
                <th>Match Info Content</th>
                <td>
                    <textarea style="width: 100%;" name="match_info" cols="30" rows="10"><?php echo esc_attr(get_option('match_info')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>Match Results Content</th>
                <td>
                    <textarea style="width: 100%;" name="match_results" cols="30" rows="10"><?php echo esc_attr(get_option('match_results')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>Match Schedule Content</th>
                <td>
                    <textarea style="width: 100%;" name="match_schedule" cols="30" rows="10"><?php echo esc_attr(get_option('match_schedule')); ?></textarea>
                </td>
            </tr>
        </table>
        <?php submit_button("Save Options", "primary", "submit", true, null) ?>
    </form>

    <h1>Show Homepage twitter feeds</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('show_twitter_feeds'); ?>
        <?php do_settings_sections('show_twitter_feeds'); ?>
        <table class="form-table">
            <tr>
                <th>Twitter User Numeric Id</th>
                <td>
                    <input placeholder="1931563526" style="width: 100%;" type="text" name="twitter_user_id" value="<?php echo esc_attr(get_option('twitter_user_id')); ?>" />
                </td>
            </tr>
            <tr>
                <th>Bearer Token</th>
                <td>
                    <input style="width: 100%;" type="text" name="bearer_token" value="<?php echo esc_attr(get_option('bearer_token')); ?>" />
                </td>
            </tr>
        </table>
        <?php submit_button("Save Options", "primary", "submit", true, null) ?>
    </form>

    <h1>DateTime Widget</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('show_time_based_on_city'); ?>
        <?php do_settings_sections('show_time_based_on_city'); ?>
        <table class="form-table">
            <tr>
                <th>Select City</th>
                <td>
                    <select name="show_city_datetime">
                        <option value="Asia/Karachi" <?php if (get_option("show_city_datetime") == "Asia/Karachi") echo "selected" ?>>Karachi</option>
                        <option value="America/Los_Angeles" <?php if (get_option("show_city_datetime") == "America/Los_Angeles") echo "selected" ?>>Los Angeles</option>
                        <option value="America/Mexico_City" <?php if (get_option("show_city_datetime") == "America/Mexico_City") echo "selected" ?>>Mexico City</option>
                        <option value="America/New_York" <?php if (get_option("show_city_datetime") == "America/New_York") echo "selected" ?>>New York City</option>
                        <option value="America/Sao_Paulo" <?php if (get_option("show_city_datetime") == "America/Sao_Paulo") echo "selected" ?>>São Paulo</option>
                        <option value="Europe/London" <?php if (get_option("show_city_datetime") == "Europe/London") echo "selected" ?>>London</option>
                        <option value="Asia/Kolkata" <?php if (get_option("show_city_datetime") == "Asia/Kolkata") echo "selected" ?>>Mumbai</option>
                        <option value="Asia/Tokyo" <?php if (get_option("show_city_datetime") == "Asia/Tokyo") echo "selected" ?>>Tokyo</option>
                        <option value="Asia/Hong_Kong" <?php if (get_option("show_city_datetime") == "Asia/Hong_Kong") echo "selected" ?>>Hong Kong</option>
                        <option value="Australia/Sydney" <?php if (get_option("show_city_datetime") == "Australia/Sydney") echo "selected" ?>>Sydney</option>
                    </select>
                </td>
            </tr>
        </table>
        <?php submit_button("Save Options", "primary", "submit", true, null) ?>
    </form>

    <div class="home-slider">
        <h1>Homepage Slider</h1>
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST" class="outer-repeater" enctype="multipart/form-data">
            <input type="hidden" name="action" value="home_slider_action_hook">
            
            <div data-repeater-list="outer-group">
                <?php
                if (!empty(get_option("homeSlider"))) {
                    $homeSliders = unserialize(get_option("homeSlider"));
                    // echo "<pre>";
                    // print_r($homeSliders);
                    foreach ($homeSliders["outer-group"] as $homeSlider) { ?>
                        <div data-repeater-item class="outer">
                            <input data-repeater-delete type="button" value="&minus;" class="outer btn-delete" />
                            <div class="form-fields">
                                <label>Title</label>
                                <input style="width: 100%;" type="text" name="slide_title" required value="<?php echo $homeSlider["slide_title"]; ?>" />
                            </div>
                            <div class="form-fields">
                                <label>Description</label>
                                <!-- <input style="width: 100%;" type="text" name="slide_description" value="<?php // echo $homeSlider["slide_description"]; ?>" /> -->
                                <textarea style="width: 100%;" type="text" name="slide_description" id="" cols="30" rows="10">
<?php echo $homeSlider["slide_description"]; ?></textarea>
                            </div>
                            <div class="form-fields">
                                <label>Video URL</label>
                                <input style="width: 100%;" type="text" name="video_url" value="<?php echo $homeSlider["video_url"]; ?>" />
                            </div>
                            <div class="form-fields">
                                <label>Image</label>
                                <!-- <input id="img-data" type="file" name="slide_image" /> -->


                                <input id="img-data" type="file" />
                                <input id="img-hidden-field" type="hidden" name="custom_img_data" />
                                <input id="img-upload-btn" type="button" class="button" value="Add Image" />
                                <input id="img-delete-btn" type="button" class="button" value="Delete Image" />

                            </div>
                        </div>
                <?php }
                }
                ?>
            </div>
            <input data-repeater-create type="button" value="&plus;" class="outer button button-primary" />
            <input type="submit" value="Save Slider" class="button button-primary" />
        </form>
    </div>
<?php }

function adidas_admin_init_cb()
{
    register_setting("options_group1", "header_top_strip");
    register_setting("options_group1", "show_top_strip");
    register_setting("options_group1", "watch_now_video_url");
    register_setting("footer_options", "footer_copy_right");
    register_setting("footer_options", "show_hide_footer_strip");
    register_setting("tabs_content", "match_info");
    register_setting("tabs_content", "match_results");
    register_setting("tabs_content", "match_schedule");
    register_setting("show_twitter_feeds", "bearer_token");
    register_setting("show_twitter_feeds", "twitter_user_id");
    register_setting("show_time_based_on_city", "show_city_datetime");
}

function adidas_admin_menu()
{
    add_theme_page("Manage Theme Options", "Theme Options", "manage_options", "adidas-theme-options", "adidas_theme_options_cb");
    add_action('admin_init', 'adidas_admin_init_cb');
}
add_action('admin_menu', 'adidas_admin_menu');
