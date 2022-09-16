<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package atlas
 */

get_header();

// update_post_meta($post_ID,'_yoast_wpseo_meta-robots-noindex', '2');

$location = get_query_var('location');
$type = get_query_var('type');

// вытаскиваю пост с типом location и где slug = $location
$location_post = get_posts([
    'name' => $location,
    'post_type' => 'location',
    'post_status' => 'publish',
    'numberposts' => 1
])[0];

// вытаскиваю пост с типом catalog и где slug = $type
$catalog_post = get_posts([
    'name' => $type,
    'post_type' => 'catalog',
    'post_status' => 'publish',
    'numberposts' => 1
])[0];

$replace_text = function($text) use ($location_post, $catalog_post) {
    $text = str_replace("[location]", $location_post->post_title, $text);
    $text = str_replace("[type]", $catalog_post->post_title, $text);
    return $text;
}
?>
<main>
    <div class="top-banner">
        <div class="banner-wrap">
            <div class="main-slider">
                  <!-- start -->
        <div class="swiper-slide" style="background-image: url(<?php the_field('oblozhka', $catalog_post->id); ?>);">
            <div class="container">
                <div class="breadgrums" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="http://optimus.test" itemprop="item">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </span>
                    <span class="sep"></span>
                    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="http://optimus.test/appliance-repair/" itemprop="item">
                            <span itemprop="name">Appliance repair</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </span>
                    <span class="sep"></span>
                    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="http://optimus.test/appliance-repair/<?php echo $catalog_post->post_name; ?>" itemprop="item">
                            <span itemprop="name"><?php echo $catalog_post->post_title; ?></span>
                        </a>
                        <meta itemprop="position" content="2">
                    </span>
                    <span class="sep"></span>
                    <span class="kb_title"><?php echo $catalog_post->post_title.' in '.$location_post->post_title; ?></span>
                </div>

                <div class="slider-content">
                    <div class="banner-content">
                        <h1 class="banner-title"><?php echo $catalog_post->post_title.' in '.$location_post->post_title; ?></h1>
                        <div class="banner-text _light-text"><?php the_field('kratkoe_opisanie', $catalog_post->id); ?></div>
                        <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
                    </div>
                </div>
            </div>

        </div>
                <!-- end -->
            </div>
        </div>
        </div>
        <?php if( have_rows('dobavit_blok') ): ?>
        <div class="premi-block">
            <div class="container">
                <div class="premi-row">
        					<?php while( have_rows('dobavit_blok') ): the_row();  ?>
                    <!-- start -->
                    <div class="premi-list">
                        <div class="prem-icon">
                        <img src="<?php the_sub_field('ikonka'); ?>" alt="">
                        </div>
                        <div class="premi-data">
                            <<?php the_sub_field('title_tag'); ?> class="title"><?php the_sub_field('title'); ?></<?php the_sub_field('title_tag'); ?>>
                            <div class="text"><?php the_sub_field('kratkoe_opisanie'); ?></div>
                        </div>
                    </div>
                    <!-- end -->
        						<?php endwhile; ?>
                </div>
            </div>
        </div> <!-- end-premi -->
        <?php endif; ?>
        <?php if (get_field('type_area_full_text','options')) : ?>
<section class="seo-block _seo">
    <div class="container">
        <div class="seo-block-content">
          <?php echo $replace_text(get_field('type_area_full_text', 'options')); ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php endif; ?>
<?php
$featured_posts = get_field('tehnika');
if( $featured_posts ): ?>
<section class="product-block">
    <div class="container">
        <div class="product-wrapper">
            <<?php the_field('tag_t'); ?> class="section-title"><?php the_field('zagolovok_bloka'); ?></<?php the_field('tag_t'); ?>>
            <<?php the_field('tag_p'); ?> class="section-subtitle"><?php the_field('podzagolovok'); ?></<?php the_field('tag_p'); ?>>

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
<?php if (get_field('add_seo')) : ?>
<section class="seo-block">
    <div class="container">
        <div class="seo-block-content">
          <?php the_field('add_seo'); ?>
        </div>
    </div>
</section> <!-- end seo -->
<?php endif; ?>
<?php
$brands = get_field('brands');
if( $brands ): ?>
<section class="brands-slider">
    <div class="container ">
        <<?php the_field('tag_b');?> class="section-title"><?php the_field('bl_title');?></<?php the_field('tag_b');?>>
        <div class="brand-wrap">
            <div class="swiper brands-init">
                <div class="swiper-wrapper cart-row">
									<?php foreach( $brands as $post ):
									setup_postdata($post); ?>
                    <!-- start -->
                    <div class="swiper-slide">
                        <div class="sl-item">
													<a href="<?php the_permalink(); ?>"><img src="<?php the_field('brand_cover'); ?>" alt="<?php the_title();?>"></a>
                        </div>
                    </div>
                    <!-- end -->
										<?php endforeach; ?>
                </div>

            </div>
            <div class="slider-nav">
                <div class="nav-prev" id="brend-prev"></div>
                <div class="nav-next" id="brend-next"></div>
            </div>
						<?php if (get_field('brendlink',get_option( 'page_on_front' ))) : ?>
            <div class="btn-group">
                <a href="<?php the_field('brendlink',get_option( 'page_on_front' )); ?>" class="btn btn-primary">See all Brands</a>
            </div>
					<?php endif; ?>
        </div>

    </div>
</section> <!-- end brand slider -->
<?php wp_reset_postdata(); endif; ?>
<section class="content-block">
    <div class="container">
<div class="content-body">
  <?php the_content(); ?>
</div>
    </div>
</section> <!-- end about -->
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
