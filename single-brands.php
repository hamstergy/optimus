<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package atlas
 */

get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php endwhile; ?> <?php endif; ?>
<main>
    <div class="top-banner">
        <div class="banner-wrap">
            <div class="main-slider">
                  <!-- start -->
        <div class="swiper-slide" style="background-image: url(<?php the_field('cover') ?>);">
            <div class="fludi">
            <div class="container">
            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
               <div class="brd-wrap">
                <div class="slider-content">
                    <div class="banner-content">
                        <<?php the_field('tag_zagolovka') ?> class="banner-title"><?php the_field('title') ?></<?php the_field('tag_zagolovka') ?>>
                        <div class="banner-text _light-text"><?php the_field('kratkoe_opisanie'); ?></div>
                        <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
                    </div>

                </div>
               </div>
            </div>

        </div>

        </div>
                <!-- end -->
            </div>
        </div>
        </div>
        <?php if( have_rows('dobavit_blok', get_option( 'page_on_front' )) ): ?>
        <div class="premi-block">
            <div class="container">
                <div class="premi-row">
        					<?php while( have_rows('dobavit_blok', get_option( 'page_on_front' )) ): the_row();  ?>
                    <!-- start -->
                    <div class="premi-list">
                        <div class="prem-icon">
                        <img src="<?php the_sub_field('ikonka', get_option( 'page_on_front' )); ?>" alt="">
                        </div>
                        <div class="premi-data">
                            <<?php the_sub_field('title_tag', get_option( 'page_on_front' )); ?> class="title"><?php the_sub_field('title', get_option( 'page_on_front' )); ?></<?php the_sub_field('title_tag', get_option( 'page_on_front' )); ?>>
                            <div class="text"><?php the_sub_field('kratkoe_opisanie', get_option( 'page_on_front' )); ?></div>
                        </div>
                    </div>
                    <!-- end -->
        						<?php endwhile; ?>
                </div>
            </div>
        </div> <!-- end-premi -->
        <?php endif; ?>
        <?php if ( get_the_content() ) { ?>
        <section class="seo-block _seo">
            <div class="container">
                <div class="seo-block-content">
                  <?php the_content(); ?>
                </div>
            </div>
        </section> <!-- end seo -->
        <?php } ?>

        <?php
        $loc = get_field('vybrat_tehniku');
        if( $loc ): ?>
        <section class="product-block">
            <div class="container">
                <div class="product-wrapper">
                    <<?php the_field('tag_zagolovka_type'); ?> class="section-title"><?php the_field('zagolovok_bloka'); ?></<?php the_field('tag_zagolovka_type'); ?>>
                    <<?php the_field('tag_zagolovka_p'); ?> class="section-subtitle"><?php the_field('pod_zagolovok'); ?></<?php the_field('tag_zagolovka_p'); ?>>

                    <div class="product-row">

        							<?php foreach( $loc as $post ):

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
          <?php if (get_field('kartinka_v_tekste')) : ?>
        <section class="about_us">
            <div class="container">
                <div class="ab_wrap">
                  <?php if (get_field('tekst_sleva')) : ?>
                    <div class="ab-col">
                        <div class="ab-text">
                          <?php the_field('tekst_sleva'); ?>
                        </div>

                    </div>
                  <?php endif; ?>
                  <?php if (get_field('kartinka_v_tekste')) : ?>
                    <div class="ab-cover">
                        <div class="cover-bg">
        <img src="<?php the_field('kartinka_v_tekste'); ?>" alt="">
                        </div>
                    </div>
                  <?php endif; ?>
                </div>
                <?php if (get_field('full_text')) : ?>

                <div class="full-text">
                  <?php the_field('full_text'); ?>
                </div>
              <?php endif; ?>
            </div>
        </section> <!-- end about -->
      <?php endif; ?>
        <?php if( have_rows('dobavit_work', get_option( 'page_on_front' )) ): ?>
        <section class="we-work">
            <div class="container">
                <<?php the_field('work_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('w_title', get_option( 'page_on_front' )); ?></<?php the_field('work_tag', get_option( 'page_on_front' )); ?>>
                <div class="we-work-steps">
        					<?php while( have_rows('dobavit_work', get_option( 'page_on_front' )) ): the_row(); ?>
        <!-- start -->
        <div class="steps-item">
            <div class="step-content">
                <div class="step-icon"></div>
                <<?php the_sub_field('title_tag', get_option( 'page_on_front' )); ?> class="title"><?php the_sub_field('title', get_option( 'page_on_front' )); ?></<?php the_sub_field('title_tag', get_option( 'page_on_front' )); ?>>
                <div class="text"><?php the_sub_field('opisanie', get_option( 'page_on_front' )); ?></div>
            </div>

        </div>
        <!-- end -->
        <?php endwhile; ?>
                </div>
            </div>
        </section> <!-- end we wrk -->
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
     <?php
$location = get_field('select_location', get_option( 'page_on_front' ));
if($location ): ?>
<section class="place-area _place">
    <div class="container">
        <<?php the_field('tag_loc'); ?> class="section-title"><?php the_field('title_loc'); ?></<?php the_field('tag_loc'); ?>>
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
   <section class="place-area _place">
    <div class="container">
        <<?php the_field('tag_loc'); ?> class="section-title"><?php the_field('title_loc'); ?></<?php the_field('tag_loc'); ?>>
        <div class="place-row">
                   <?php while( have_rows('select_list', get_option( 'page_on_front' )) ): the_row();?>
<!-- start -->
<div class="place-item">
    <?php if (get_sub_field('ssylka', get_option( 'page_on_front' ))): ?>
         <a href="<?php the_sub_field('ssylka', get_option( 'page_on_front' )); ?>" rel="nofollow"><i class="location"></i><?php the_sub_field('nazvanie_rajona', get_option( 'page_on_front' )); ?></a>
        <?php else: ?>
             <a rel="nofollow"><i class="location"></i><?php the_sub_field('nazvanie_rajona', get_option( 'page_on_front' )); ?></a>
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
            <?php
            $args = array(
            	'posts_per_page' => get_field('rew_count', get_option( 'page_on_front' )),
            	'post_type' => 'rewiew'
            );
            $query = new WP_Query( $args ); ?>

            <?php if ( $query->have_posts() ) : ?>

            <section class="rewiews _rew">
              <<?php the_field('rew_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('rew_title', get_option( 'page_on_front' )); ?></<?php the_field('rew_tag', get_option( 'page_on_front' )); ?>>
                <div class="rewiew-slider">
                    <div class="container-fluid">
                        <div class="swiper rew-slider">
                            <div class="swiper-wrapper">
                              	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                         <!-- start -->
                                         <div class="swiper-slide">
                                            <div class="rewiew-content">
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
              <?php if( have_rows('faq') ): ?>
                <section class="faq">
                    <div class="container">
                        <<?php the_field('tag_fag'); ?> class="section-title"><?php the_field('title_faq'); ?></<?php the_field('tag_fag'); ?>>
                        <div class="faq-container">
                          <?php while( have_rows('faq') ): the_row(); ?>
                            <!-- start -->
                            <div class="faq-list">
                                <div class="faq-header">
                                    <h3 class="faq-title"><?php the_sub_field('vopros'); ?></h3>
                                    <div class="toogle"></div>
                                </div>
                                <div class="faq-content">
                                <?php the_sub_field('otvet'); ?>
                                </div>
                            </div>
                            <!-- end -->
                          <?php endwhile; ?>
                        </div>
                    </div>
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
    if( have_rows('faq') ):
        $i = 1;
        $comma = '';
        echo '<script type="application/ld+json"> {
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "mainEntity": [';
        while ( have_rows('faq') ) : 
            the_row();
            echo $comma;
?>  
  {
    "@type": "Question",
    "name": "<?php the_sub_field( 'vopros' ); ?>",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "<?php the_sub_field( 'otvet' ); ?>"
    }
  }
<?php
        $comma = ',';
        $i++;
        endwhile;
        echo ' ]
        }  </script>';
    endif;
?>  
<?php
get_footer();
