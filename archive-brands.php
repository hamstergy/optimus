<?php
/**
 * Template name: Brands
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
                <<?php the_field('tag_zagolovka', 363); ?> class="c-title"><?php the_field('title', 363); ?></<?php the_field('tag_zagolovka', 363); ?>>
                <div class="c-text"><?php the_field('kratkoe_opisanie', 363); ?></div>
                <div class="btn-group">
                    <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup">Request Service</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$r = array(
	'post_type' => 'brands',
    'posts_per_page' => -1,
     'orderby' => 'title',
      'order' => 'ASC',
);
$b = new WP_Query( $r ); ?>

<?php if ( $b->have_posts() ) : ?>

<section class="brands-slider _brand_carts">
    <div class="container ">
        <div class="brand-wrap">
                <div class="cart-row">
                  	<?php while ( $b->have_posts() ) : $b->the_post(); ?>
                    <!-- start -->
                    <div class="swiper-slide">
                      <a href="<?php the_permalink(); ?>">
                        <div class="sl-item">
                            <img src="<?php the_field('brand_cover'); ?>" alt="<?php the_title(); ?>">
                        </div></a>
                    </div>
                    <!-- end -->
                  <?php endwhile; ?>
                </div>


        </div>

    </div>
</section> <!-- end brand slider -->
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php
$my_postid = 363;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
if ($my_postid) { ?>
<section class="seo-block">
    <div class="container">
        <div class="seo-block-content">
          <?php echo $content; ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php } ?>
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
<?php
$featured_posts = get_field('vybrat_tehniku', 363);
if( $featured_posts ): ?>
<section class="product-block">
    <div class="container">
        <div class="product-wrapper">
          <<?php the_field('tag_zagolovka_type', 363); ?> class="section-title"><?php the_field('zagolovok_bloka', 363); ?></<?php the_field('tag_zagolovka_type', 363); ?>>
          <<?php the_field('tag_zagolovka_p', 363); ?> class="section-subtitle"><?php the_field('pod_zagolovok', 363); ?></<?php the_field('tag_zagolovka_p', 363); ?>>
            <div class="product-row">

							<?php foreach( $featured_posts as $post ):

							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post); ?>
<!-- start -->
<div class="product-item 	<?php if (get_field('npd')) : ?>_npd <?php endif; ?>">
    <div class="pr-content">
        <a href="<?php the_permalink(); ?>">
            <div class="pr-cover">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </div>
        </a>
    </div>
    <a class="pr-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>
<!-- end -->
<?php endforeach; ?>
<!-- start -->
<div class="product-item _pd">
    <div class="pr-content">
       <div class="pr-full">
           <div class="pd-title">Request Service</div>
           <div class="pd-text">Send us a request to calculate the appliance repair</div>
           <div class="btn-group">
               <a class="btn btn-link-pr open-popup-link" data-mfp-src="#popup">Send Request</a>
           </div>
       </div>
    </div>
</div>
<!-- end -->
            </div>
        </div>
    </div>
</section> <!-- end product -->
<?php
// Reset the global post object so that the rest of the page works correctly.
wp_reset_postdata(); ?>
<?php endif; ?>
<?php
$args = array(
	'posts_per_page' => get_field('rew_count', get_option( 'page_on_front' )),
	'post_type' => 'rewiew'
);
$query = new WP_Query( $args ); ?>

<?php if ( $query->have_posts() ) : ?>

<section class="rewiews">
  <<?php the_field('rew_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('rew_title', get_option( 'page_on_front' )); ?></<?php the_field('rew_tag', get_option( 'page_on_front' )); ?>>
    <div class="rewiew-slider">
        <div class="container-fluid">
            <div class="swiper rew-slider">
                <div class="swiper-wrapper">
                  	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                             <!-- start -->
                             <div class="swiper-slide">
                                <div class="rewiew-content">
                                    <div class="rew-rating">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="rew-text"><?php the_content(); ?></div>
                                    <div class="rew-autor"><?php the_title(); ?></div>
                                </div>
                            </div>
                            <!-- end -->
													<?php endwhile; ?>
													<?php wp_reset_postdata(); ?>
                </div>
                <div class="slider-nav">
                    <div class="nav-prev" id="n-prev"></div>
                    <div class="nav-next" id="n-next"></div>
                </div>
								<?php if (get_field('rew_link', get_option( 'page_on_front' ))) : ?>
                <div class="btn-group">
                    <a href="<?php the_field('rew_link', get_option( 'page_on_front' )); ?>" class="btn btn-primary"><?php the_field('rew_name', get_option( 'page_on_front' )); ?></a>
                </div>
							<?php endif; ?>
            </div>
        </div>
    </div><!-- rew end -->
    </section>
  <?php endif; ?>
    <div class="section-line container"></div>
    <?php if (get_field('dobavit_seo_d', 363)) : ?>
    <section class="seo-block">
        <div class="container">
            <div class="seo-block-content">
              <?php the_field('dobavit_seo_d', 363); ?>
            </div>
        </div>
    </section> <!-- end seo -->
    <?php endif; ?>
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
