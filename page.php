<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
<div class="swiper-slide _single-cover" style="background-image: url(<?php the_field('oblozhka'); ?>);">
    <div class="container">
		<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
        <div class="slider-content _banner_info">
            <div class="banner-content">
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


</main>
<?php
get_footer();
