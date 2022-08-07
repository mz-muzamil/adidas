<?php
function adidas_theme_options_cb()
{ ?>
    <h2>Header Top Strip Settings</h2>
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
    <h2>Footer Disclaimer/Copyright Settings</h2>
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
    <h2>Home Page Tabs Content</h2>
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
}

function adidas_admin_menu()
{
    add_menu_page("Manage Theme Options", "Theme Options", "manage_options", "adidas-theme-options", "adidas_theme_options_cb");
    add_action('admin_init', 'adidas_admin_init_cb');
}
add_action('admin_menu', 'adidas_admin_menu');
