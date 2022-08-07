<?php

/**
 * Registers the event post type.
 */
function adidas_event_post_type()
{

    $labels = array(
        'name' => __('Events'),
        'singular_name' => __('Event'),
        'add_new' => __('Add New Event'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('Add New Event'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Event'),
        'not_found' => __('No events found'),
        'not_found_in_trash' => __('No events found in trash')
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'comments',
        'revisions',
    );

    $args = array(
        'labels' => $labels,
        'supports' => $supports,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => false,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-calendar-alt',
        'register_meta_box_cb' => 'add_adidas_event_metaboxes',
    );

    register_post_type('events', $args);
}
add_action('init', 'adidas_event_post_type');

function get_events($port_per_page)
{
    $args = array(
        'post_type' => 'events',
        'post_status' => 'publish',
        'posts_per_page' => $port_per_page,
        'order' => 'ASC'
    );
    $results = get_posts($args);
    return $results;
}

/**
 * Adds a metabox to the right side of the screen under the “Publish” box
 */
function add_adidas_event_metaboxes()
{
    add_meta_box(
        'adidas_events',
        'Event Details',
        'adidas_events',
        'events',
        'side',
        'high'
    );
}

/**
 * Output the HTML for the metabox.
 */
function adidas_events()
{
    global $post;

    $date_format = 'm/d/Y';

    // Nonce field to validate form request came from current site
    wp_nonce_field(basename(__FILE__), 'event_fields');

    $start_date = get_post_meta($post->ID, 'event_start_date', true);

    $start_time = get_post_meta($post->ID, 'event_start_time', true);
    $end_time = get_post_meta($post->ID, 'event_end_time', true);

    $start_date_obj = DateTime::createFromFormat('Y-m-d', get_post_meta($post->ID, 'event_start_date', true), new DateTimeZone('EDT'));

    if (!empty($start_date_obj)) {
        $start_date = $start_date_obj->format($date_format);
    } else {
        $start_date = date($date_format);
    }

    // Output the field
    $fields = '';

    $fields .= '<br />';
    $field_id = 'event_start_date';
    $fields .= '<div id="div_' . $field_id . '" class="w-30 f-l">';
    $fields .= '<label for="'  . $field_id . '"><strong>Event Start Date</strong></label>';
    $fields .= '<input type="text" name="' . $field_id . '" size="30" value="' . $start_date . '" id="start_date" class="widefat">';
    $fields .= '</div>';

    $fields .= '<br />';
    $field_id = 'event_start_time';
    $fields .= '<div id="div_' . $field_id . '" class="w-20 f-l">';
    $fields .= '<label for="'  . $field_id . '"><strong>Event Start Time</strong></label>';
    $fields .= '<input type="text" name="' . $field_id . '" size="30" value="' . $start_time . '" id="' . $field_id . '" class="widefat">';
    $fields .= '</div>';

    $fields .= '<br />';
    $field_id = 'event_end_time';
    $fields .= '<div id="div_' . $field_id . '" class="w-20 f-l ml-2">';
    $fields .= '<label for="'  . $field_id . '"><strong>Event End Time</strong></label>';
    $fields .= '<input type="text" name="' . $field_id . '" size="30" value="' . $end_time . '" id="' . $field_id . '" class="widefat">';
    $fields .= '</div>';

    echo $fields;
}

/**
 * Save the metabox data
 */
function adidas_save_events_meta($post_id, $post)
{

    $date_time_format = 'm/d/Y';

    // Return if the user doesn't have edit permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if (!isset($_POST['event_start_date']) || !wp_verify_nonce($_POST['event_fields'], basename(__FILE__))) {
        return $post_id;
    }

    //    echo '<pre>';
    //    print_r($_POST);
    //    exit;

    // Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.

    $start_date_obj = DateTime::createFromFormat($date_time_format, $_POST['event_start_date'], new DateTimeZone('EDT'));

    $events_meta['event_start_date'] = $start_date_obj->format('Y-m-d');
    $events_meta['event_start_time'] = esc_textarea($_POST['event_start_time']);
    $events_meta['event_end_time'] = esc_textarea($_POST['event_end_time']);

    // Cycle through the $events_meta array.
    // Note, in this example we just have one item, but this is helpful if you have multiple.
    foreach ($events_meta as $key => $value) :

        // Don't store custom data twice
        if ('revision' === $post->post_type) {
            return;
        }

        if (get_post_meta($post_id, $key, false)) {
            // If the custom field already has a value, update it.
            update_post_meta($post_id, $key, $value);
        } else {
            // If the custom field doesn't have a value, add it.
            add_post_meta($post_id, $key, $value);
        }

        if (!$value) {
            // Delete the meta key if there's no value
            delete_post_meta($post_id, $key);
        }

    endforeach;
}

add_action('save_post', 'adidas_save_events_meta', 1, 2);


// Add the custom columns to the book post type:
function set_events_columns($columns)
{
    unset($columns['author']);
    $publish_date = $columns['date'];
    unset($columns['date']);
    $columns['event_start_date'] = __('Event Date & Start Time', 'adidastheme');
    $columns['event_end_date'] = __('End Event Time', 'adidastheme');
    $columns['date'] = $publish_date;

    return $columns;
}
add_filter('manage_events_posts_columns', 'set_events_columns');

// Add the data to the custom columns for the book post type:
function custom_event_column($column, $post_id)
{
    switch ($column) {
        case 'event_start_date':
            $start_date = get_post_meta($post_id, 'event_start_date', true);
            $start_time = get_post_meta($post_id, 'event_start_time', true);
            echo DateTime::createFromFormat('Y-m-d', $start_date)->format('jS M, Y') . ', ' . $start_time;
            break;
        case 'event_end_date':
            $end_time = get_post_meta($post_id, 'event_end_time', true);
            echo $end_time;
            break;
    }
}
add_action('manage_events_posts_custom_column', 'custom_event_column', 10, 2);


function get_events_for_shortcode($atts)
{
    ob_start();

    $atts = shortcode_atts(
        array(
            'port_per_page' => ''
        ),
        $atts,
        'port_per_page'
    );

    $port_per_page = $atts['port_per_page'];
    $events = get_events($port_per_page);
?>
    <div class="row">
        <?php foreach ($events as $event) {
            if ($port_per_page == "") { ?>
                <div class="col-xxl-3 mb-4">
                    <div class="post-block event-tile h-100">
                        <?php if (has_post_thumbnail($event->ID)) : ?>
                            <figure class="text-center">
                                <img class="img-fluid" alt="event-thumbnail" src="<?php echo get_the_post_thumbnail_url($event->ID, 'full'); ?>">
                            </figure>
                        <?php endif; ?>
                        <div class="text">
                            <h5 class="text-uppercase mb-2">
                                <a class="h5 text-white" href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a>
                            </h5>
                            <p class="mb-0"><?php echo date("jS M, Y", strtotime($event->event_start_date)); ?></p>
                            <p><?php echo $event->event_start_time . " - " . $event->event_end_time; ?></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-xxl-12">
                    <div class="event-article text-white mb-3" id="post-<?php echo $event->ID; ?>">
                        <?php if (has_post_thumbnail($event->ID)) : ?>
                            <figure>
                                <img class="img-fluid" alt="event-thumbnail" src="<?php echo get_the_post_thumbnail_url($event->ID, 'full'); ?>">
                            </figure>
                        <?php endif; ?>
                        <div class="text">
                            <h5 class="text-uppercase mb-2">
                                <a class="h5 text-white" href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a>
                            </h5>
                            <p class="mb-0"><?php echo date("jS M, Y", strtotime($event->event_start_date)); ?></p>
                            <p><?php echo $event->event_start_time . " - " . $event->event_end_time; ?></p>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
<?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('Events', 'get_events_for_shortcode');
