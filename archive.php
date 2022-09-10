<?php
/**
 * The template for displaying archive pages
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
									<?php
									the_archive_title( '<h1 class="c-title">', '</h1>' );
									the_archive_description( '<div class="c-text">', '</div>' );
									?>
                </div>
            </div>
        </div>
    </div>

    <section class="content-block blog">
        <div class="container">
<div class="blog-container">
			<?php if ( have_posts() ) : ?>
    <div class="blog-wrap">
			<?php
		  /* Start the Loop */
		  while ( have_posts() ) :
		    the_post();

		    /*
		     * Include the Post-Type-specific template for the content.
		     * If you want to override this in a child theme, then include a file
		     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
		     */
		    get_template_part( 'template-parts/content', get_post_type() );

		  endwhile;


		else :

		  get_template_part( 'template-parts/content', 'none' );
		?>

    </div>
		<?php endif; ?>
</div>
<?php if ( function_exists( 'wp_corenavi' ) ) wp_corenavi(); ?>
        </div>
    </section> <!-- end about -->

</main>
<?php
get_footer();
