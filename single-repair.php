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
<div class="top-banner">
<div class="banner-wrap">
    <div class="main-slider">
          <!-- start -->
<div class="swiper-slide" style="background-image: url(<?php the_field('oblozhka'); ?>);">
    <div class="container">
      <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
        <div class="slider-content _banner_info">
            <div class="banner-content">
                <div class="banner-meta">
                  <div class="news-date"><?php the_date('M.d,Y'); ?></div>
                  <div class="news-author">Author: <?php the_author(); ?></div>
                </div>
                <<?php the_field('tag'); ?> class="banner-title"><?php the_field('zagolovok'); ?></<?php the_field('tag'); ?>>
            </div>
        </div>
    </div>

</div>
        <!-- end -->
    </div>
</div>
</div>
<?php if (get_field('seo_blok')) : ?>
<section class="seo-block _seo">
    <div class="container">
        <div class="seo-block-content">
        <?php the_field('seo_blok'); ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php endif; ?>
<?php if (get_field('z_cover', get_option( 'page_on_front' ))) : ?>
<section class="form_bg"  style="background-image: url('<?php the_field('z_cover', get_option( 'page_on_front' )); ?>">
<div class="container">
    <div class="frb-content">
        <<?php the_field('z_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('z_title', get_option( 'page_on_front' )); ?></<?php the_field('z_tag', get_option( 'page_on_front' )); ?>>
        <div class="btn-group">
					  <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
        </div>
    </div>

</div>
</section> <!-- end frm -->
<?php endif; ?>
<section class="content-block">
    <div class="container">
<div class="content-body _is">
  <?php the_content(); ?>
</div>
    </div>
</section> <!-- end about -->


    <section class="contact_us">
        <div class="container">
            <div class="frm-content">
                <<?php the_field('tag_z', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('zagolovok_formy', get_option( 'page_on_front' )); ?></<?php the_field('tag_z', get_option( 'page_on_front' )); ?>>
                <form action="" class="fprm-grid" id="formsend">
                     <input type="hidden" name="Пришел со страницы" value="<?php the_title(); ?>">
<div class="input-row">
    <div class="input-group">
        <input type="text" class="text-field" name="Name" placeholder="Your name *" required>
    </div>
    <div class="input-group">
        <input type="text" class="text-field" name="Email" placeholder="Email *">
    </div>
    <div class="input-group">
        <input type="text" class="text-field" name="Phone" placeholder="Phone number *" required>
    </div>
</div>
<div class="text-group">
    <textarea  class="text-field" name="Comment" placeholder="Your comment"></textarea>
</div>
<div class="btn-group">
    <button type="submit" class="btn btn-link">Request Service</button>
</div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact end -->
    <?php
    $featured_posts = get_field('another_issues');
    if( $featured_posts ): ?>
    <section class="common">
        <div class="container">
            <<?php the_field('tag_other'); ?> class="section-title"><?php the_field('zagolovok_s'); ?></<?php the_field('tag_other'); ?>>
            <div class="comn-row">
              <?php foreach( $featured_posts as $post ):
              setup_postdata($post); ?>
                <!-- start -->
                <div class="com-item">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
                <!-- end -->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata(); ?>
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
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_permalink(); ?>"
  },
  "headline": "<?php the_title(); ?>",
  "image": "<?php the_field('oblozhka'); ?>",  
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
