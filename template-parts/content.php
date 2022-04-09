<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package atlas
 */

?>
<!-- start -->
	<div id="post-<?php the_ID(); ?>" class="news-item">
			<div class="news-cover">
					<a href="<?php the_permalink(); ?>"> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
			</div>
			<div class="news-data">
					<div class="news-date"><?php the_time('M.d,Y'); ?></div>
					<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
					<div class="news-text"><?php the_excerpt(); ?></div>
					<div class="btn-group">
							<a href="<?php the_permalink(); ?>" class="btn btn-read">Read</a>
					</div>
			</div>
	</div>
<!-- end -->
