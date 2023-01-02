<?php

/**
 *  Pagination layout
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('adidas_pagination')) {
    function adidas_pagination($args = array(), $class = 'pagination')
    {
        if (!isset($args['total']) && $GLOBALS['wp_query']->max_num_pages <= 1) {
            return;
        }

        $args = wp_parse_args(
            $args,
            array(
                'mid_size'           => 2,
                'prev_next'          => true,
                'prev_text'          => __('&laquo;', 'adidastheme'),
                'next_text'          => __('&raquo;', 'adidastheme'),
                'type'               => 'array',
                'current'            => max(1, get_query_var('paged')),
                'screen_reader_text' => __('Posts navigation', 'adidastheme'),
            )
        );

        $links = paginate_links($args);
        if (!$links) {
            return;
        }
?>
        <nav class="pagination full-width justify-content-center">
            <ul class="mb-0 <?php echo esc_attr($class); ?>">
                <?php foreach ($links as $key => $link) { ?>
                    <li class="page-item <?php echo strpos($link, 'current') ? 'active' : ''; ?>">
                        <?php echo str_replace('page-numbers', 'page-link', $link);
                        ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
<?php
    }
}
