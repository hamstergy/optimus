<?php

/**

 * The template name: About

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

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

<div class="slider-content">

                    <div class="banner-content">

                        <<?php the_field('tag'); ?> class="banner-title"><?php the_field('zagolovok'); ?></<?php the_field('tag'); ?>>

                        <div class="banner-text _light-text"><?php the_field('short'); ?></div>

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

        <div class="premi-block _abpremi">

            <div class="container">

                <div class="premi-row _ab_premi">

  <?php while( have_rows('dobavit_blok') ): the_row(); ?>

             <!-- start -->

             <div class="premi-list">

                <div class="prem-icon">

                  <img src="<?php the_sub_field('ikonka'); ?>" alt="<?php the_sub_field('zagolovok'); ?>">

                </div>

                <div class="premi-data">

                    <<?php the_sub_field('tag'); ?> class="title"><?php the_sub_field('zagolovok'); ?></<?php the_sub_field('tag'); ?>>

                    <div class="text"><?php the_sub_field('opisanie'); ?></div>

                </div>

            </div>

            <!-- end -->

          <?php endwhile; ?>

                </div>

            </div>

        </div> <!-- end-premi -->

      <?php endif; ?>

        <?php if (get_field('kratkoe_opisanie')) : ?>

        <section class="about_us">

            <div class="container">

                <div class="ab_wrap">

                    <div class="ab-col">

                        <<?php the_field('tag_about'); ?> class="section-title"><?php the_field('zagolovok_about'); ?></<?php the_field('tag_about'); ?>>

                        <div class="ab-subtitle"><?php the_field('podzagolovok'); ?></div>

                        <div class="ab-text"><?php the_field('kratkoe_opisanie'); ?></div>

                    </div>

                    <?php if (get_field('kartinka')) : ?>

                    <div class="ab-cover">

                        <div class="cover-bg">

        <img src="<?php the_field('kartinka'); ?>" alt="<?php the_field('zagolovok_about'); ?>">

                        </div>

                    </div>

                  <?php endif; ?>

                </div>

            </div>

        </section> <!-- end about -->

      <?php endif; ?>

      <?php if( have_rows('team_group',get_option( 'page_on_front' )) ): ?>

      <section class="team">

          <div class="container">

              <<?php the_field('team_tag', get_option( 'page_on_front' )); ?> class="section-title"><?php the_field('team_title', get_option( 'page_on_front' )); ?></<?php the_field('team_tag', get_option( 'page_on_front' )); ?>>

              <div class="team-wrap">

      					<?php while( have_rows('team_group', get_option( 'page_on_front' )) ): the_row(); ?>

                  <!-- start -->

                  <div class="tem-item">

                      <div class="tm-content">

                              <div class="user-cover">

                                  <img src="<?php the_sub_field('avatar', get_option( 'page_on_front' )); ?>" alt="<?php the_sub_field('name', get_option( 'page_on_front' )); ?>">

                              </div>

                         <div class="user-name"><?php the_sub_field('name', get_option( 'page_on_front' )); ?></div>

                         <div class="lever"><?php the_sub_field('posada', get_option( 'page_on_front' )); ?></div>

                         <div class="y-work"><i class="star"></i><?php the_sub_field('opyt_raboty', get_option( 'page_on_front' )); ?></div>

                      </div>

                  </div>

                  <!-- end -->

      					<?php endwhile; ?>

              </div>

          </div>

      </section> <!-- end team -->

      <?php endif; ?>

      <?php if ( get_the_content() ) : ?>

        <section class="content-block">

            <div class="container">

        <div class="content-body">

          <?php the_content(); ?>

        </div>

            </div>

        </section> <!-- end about -->

      <?php else: ?>
        <div class="hidden-div" style="padding: 80px 0;"></div>

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

