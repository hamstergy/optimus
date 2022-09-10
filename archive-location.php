<?php
/**
 * Template name: Locations
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package atlas
 */

get_header();
?>
<main>
<div class="top-cover">
    <div class="cover-wrap">
        <div class="container">
          <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
            <div class="cover-container">
                <<?php the_field('tag', 356); ?> class="c-title"><?php the_field('title', 356); ?></<?php the_field('tag', 356); ?>>
                <div class="c-text"><?php the_field('kratkoe_opisanie', 356); ?></div>
                <div class="btn-group">
                  <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
$my_postid = 356;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
if ($my_postid) { ?>
<section class="seo-block _seo">
    <div class="container">
        <div class="seo-block-content">
          <?php echo $content; ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php } ?>
<?php
$location = get_field('select_location', get_option( 'page_on_front' ));
if($location ): ?>
<section class="place-area">
    <div class="container">
        <<?php the_field('loc_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('loc_title', get_option( 'page_on_front' )); ?></<?php the_field('loc_tag', get_option( 'page_on_front' )); ?>>
        <div class="place-row">
                    <?php foreach( $location as $post ):
                    setup_postdata($post); ?>
<!-- start -->
<div class="place-item">
    <a href="<?php the_permalink(); ?>" rel="nofollow"><i class="location"></i><?php the_title(); ?></a>
</div>
<!-- end -->
<?php endforeach; ?>
        </div>
    </div>
</section> <!-- end area -->
<?php else: ?>
    <?php if ( have_rows('select_list', get_option( 'page_on_front' )) ) : ?>
   <section class="place-area">
    <div class="container">
      <<?php the_field('loc_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('loc_title', get_option( 'page_on_front' )); ?></<?php the_field('loc_tag', get_option( 'page_on_front' )); ?>>
        <div class="place-row">
                   <?php while( have_rows('select_list', get_option( 'page_on_front' )) ): the_row();?>
<!-- start -->
<div class="place-item">
    <?php if (get_sub_field('custom_link')): ?>
         <a href="<?php the_sub_field('custom_link'); ?>" rel="nofollow"><i class="location"></i><?php the_sub_field('nazvanie_rajona'); ?></a>
     <?php elseif (get_sub_field('link_place')) : ?>
             <a href="<?php the_sub_field('link_place'); ?>" rel="nofollow"><i class="location"></i><?php the_sub_field('nazvanie_rajona'); ?></a>
        <?php else: ?>
             <a rel="nofollow"><i class="location"></i><?php the_sub_field('nazvanie_rajona'); ?></a>
    <?php endif ?>
</div>
<!-- end -->
<?php endwhile; ?>
        </div>
    </div>
</section> <!-- end area -->
<?php endif; ?>
<?php endif; ?>
<?php
wp_reset_postdata(); ?>
<?php if (get_field('add_seo', 356)) : ?>
<section class="seo-block _seo">
    <div class="container">
        <div class="seo-block-content">
          <?php the_field('add_seo', 356); ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php endif; ?>
<section class="contact-block">
    <div class="container">
        <<?php the_field('tag', 'options'); ?> class="section-title"><?php the_field('c_title', 'options'); ?></<?php the_field('tag', 'options'); ?>>
        <div class="contact-row">
          <?php if (get_field('phone', 'options')) : ?>
            <!-- start -->
            <div class="cnt-item">
                <div class="cnt-content">
                    <div class="cnt-icon"><i class="phone _large"></i></div>
                    <div class="cnt-r">
                        <span>Phone number</span>
                        <a href="tel:<?php echo str_replace('', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'options'); ?></a>
                    </div>
                </div>
            </div>
            <!-- end -->
          <?php endif; ?>
            <?php if (get_field('phone', 'options')) : ?>
             <!-- start -->
             <div class="cnt-item">
                <div class="cnt-content">
                    <div class="cnt-icon"><i class="mail _large"></i></div>
                    <div class="cnt-r">
                    <span>Email</span>
                    <a href="mailto:<?php the_field('mail', 'options'); ?>"><?php the_field('mail', 'options'); ?></a>
                </div>
                </div>
            </div>
            <!-- end -->
          <?php endif; ?>
            <?php if (get_field('phone', 'options')) : ?>
            <!-- start -->
            <div class="cnt-item">
                <div class="cnt-content">
                    <div class="cnt-icon"><i class="location _large"></i></div>
                    <div class="cnt-r">
                    <span>Address</span>
                    <div class="adress"><?php the_field('location', 'options'); ?></div>
                </div>
                </div>
            </div>
            <!-- end -->
          <?php endif; ?>
        </div>
    </div>
</section><!-- end contact items -->
<?php if (get_field('iframe_map', 'options')) : ?>
<section class="map-area">
  <?php the_field('iframe_map', 'options') ?>
</section>
<?php endif; ?>
</main>
<?php
get_footer();
