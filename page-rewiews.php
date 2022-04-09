<?php
/**
 * Template name: Rewiews
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
                  <?php the_title('<h1 class="c-title">', '</h1>'); ?>
                    <div class="c-text"><?php the_content(); ?></div>
                      <a href="#" class="btn btn-link open-popup-link" data-mfp-src="#popup" >Request Service</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content-block">
        <div class="container">
    <div class="content-body">
      <?php
  		$args = array(
  			'post_type' => 'rewiew'
  		);
  $query = new WP_Query( $args ); ?>

  <?php if ( $query->have_posts() ) : ?>
    		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <!-- start -->
      <div class="rew-list">
        <div class="rewiew-content">
            <div class="rew-text">
              <?php the_content(); ?>
            </div>
            <div class="rew-autor"> <?php the_title(); ?></div>
        </div>
     </div>
     <!-- end -->
   <?php endwhile; ?>
     	<?php wp_reset_postdata(); ?>
   <?php endif; ?>
     <div class="rewiews">
        <?php if( have_rows('rew_wiget', get_option( 'page_on_front' )) ): ?>
        <div class="rew-wigets">
            <?php while( have_rows('rew_wiget', get_option( 'page_on_front' )) ): the_row(); ?>
             <!-- start -->
            <div class="wg-item">
                <a href="<?php the_sub_field('cat_link', get_option( 'page_on_front' )); ?>" rel="nofollow" target="_blank">
                <div class="wh-cnt">
                           <img src="<?php the_sub_field('zagruzit_kartinku', get_option( 'page_on_front' )); ?>" alt=""> 
                </div>
            </a>
            </div>
            <!-- end -->
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
     </div>
    </div>
        </div>
    </section> <!-- end about -->

    <section class="contact_us">
        <div class="container">
            <div class="frm-content">
              <<?php the_field('tag'); ?> class="section-title"><?php the_field('form_title'); ?></<?php the_field('tag'); ?>>
                <form method="post" class="fprm-grid" id="rewiew-post">
                   <input type="hidden" name="action" value="rewiew_post" />
                   <input type="hidden" name="post_type" id="post_type" value="rewiew" />
<div class="input-row">
    <div class="input-group">
        <input type="text" class="text-field" name="cptTitle" id="cptTitle" placeholder="Your name *" required>
    </div>
    <div class="input-group">
        <input type="email" class="text-field" name="email" id="email" placeholder="Email *" required>
    </div>
    <div class="input-group">
        <input type="phone" class="text-field" name="phone" id="phone" placeholder="Phone number *" required>
    </div>
</div>
<div class="text-group">
    <textarea  class="text-field" name="cptContent" id="cptContent" placeholder="Your rewiew"></textarea>
</div>



<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
<div class="btn-group">
    <button class="btn btn-link" type="submit">Send Review</button>
</div>

                </form>
            </div>
        </div>
    </section>
    <!-- contact end -->
</main>
<?php
get_footer(); ?>
<script>
jQuery(document).ready(function ($) {

        $('#rewiew-post').on('submit', function (e) {

            let ajaxurl = "<?= admin_url('admin-ajax.php') ?>";

            e.preventDefault();

            $.post(ajaxurl, $(this).serialize(), function (data) {

                console.dir(data);

                if (data.success) {

                    $('#rewiew-post').after().append('<div class="mess"><div class="mess-body">Your rewiew has been sent successfully <br>We will review your rewiew and get back to you promptly</div></div>');

                    setTimeout(function () {
                        $('#rewiew-post').trigger("reset");
                        $('.mess').css('display', 'none');

                    }, 3000);
                }
            });
        })
    });
</script>
