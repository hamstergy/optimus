<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package atlas
 */

get_header();
?>
<main>
<div class="top-banner _single-banner">
<div class="banner-wrap">
    <div class="main-slider">
          <!-- start -->
<div class="swiper-slide _single-cover" style="background-image: url(<?php the_field('cover'); ?>);">
    <div class="container">
		<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
        <div class="slider-content _banner_info">
            <div class="banner-content">
                <div class="banner-meta">
                    <div class="news-date"><?php the_date('M.d,Y'); ?></div>
                    <div class="news-author">Author: <?php the_author(); ?></div>
                </div>
                <<?php the_field('tag'); ?> class="banner-title"><?php the_title(); ?></<?php the_field('tag'); ?>>
            </div>
        </div>
    </div>

</div>
        <!-- end -->
    </div>
</div>
</div>


<section class="content-block">
    <div class="container">
<div class="content-body">
  <?php the_content(); ?>
</div>
    </div>
</section> <!-- end about -->
<?php if (get_field('war_tag', get_option( 'page_on_front' ))) : ?>
<section class="form_bg atlasrepair single-block">
    <div class="container">
        <div class="frb-content">
            <<?php the_field('war_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('war_title', get_option( 'page_on_front' )); ?></<?php the_field('war_tag', get_option( 'page_on_front' )); ?>>
            <div class="btn-group">
               <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
            </div>
        </div>
    </div>
</section>
<!-- end atlas -->
<?php endif; ?>
<?php
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'showposts'=>10,
'caller_get_posts'=>1);
$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
echo '<section class="article-area">
    <div class="container">
        <div class="section-title">Recent Articles for Homeowners</div>
        <div class="news-block">
            <div class="swiper news-init">
                <div class="swiper-wrapper">';
while ($my_query->have_posts()) {
$my_query->the_post();
?>
<!-- start -->
<div class="swiper-slide">
		<div class="news-item">
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
</div>
<!-- end -->
<?php
}
echo '</div>
</div>
<div class="slider-nav">
	<div class="nav-prev" id="news_prev"></div>
	<div class="nav-next" id="news_next"></div>
</div>
</div>
</div>
</section>';
}
wp_reset_query();
}
?>

</main>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_permalink(); ?>"
  },
  "headline": "<?php the_title(); ?>",
  "image": "<?php the_field('cover'); ?>",  
  "author": {
    "@type": "Person",
    "name": "<?php the_author(); ?>",
    "url": "<?php echo $author_link  = get_author_posts_url(get_the_author_meta("ID")); ?>"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "<?php bloginfo( 'name' ); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "http://atlas.e-dev.pp.ua/wp-content/uploads/2022/01/logo.svg"
    }
  },
    "datePublished": "<?php the_time('Y-m-d h:i:s') ?>",
  "dateModified": "<?php the_time('Y-m-d h:i:s') ?>"

}
</script>
<?php
get_footer();
