<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package adidastheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class("custom-article"); ?> id="post-<?php the_ID(); ?>">
	<figure><?php echo get_the_post_thumbnail($post->ID, 'large'); ?></figure>
	<div class="text">
		<h4 class="text-white"><a class="h4 text-white" href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
		<div class="text-white"><?php the_excerpt(); ?></div>
		<a class="text-white" href="<?php the_permalink(); ?>" target="_blank">Read More</a>
	</div>
</article>