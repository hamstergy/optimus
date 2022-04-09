<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package atlas
 */

get_header();
?>
<main>
    <section class="content-block _404">
        <div class="container">
        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
    <div class="content-body">
      <div class="page_404">
         <div class="page_body">
             <div class="im-col">
                 <img src="<?php echo get_template_directory_uri(); ?>/images/404.svg" alt="">
                 <div class="im-title">Sorry! But this page doesn’t exist</div>
                 <div class="im-tx">Maybe this page was moved or deleted</div>
                 <div class="btn-group">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-back">Go Back Home</a>
                </div>
             </div>
             <div class="im-col">
                 <img src="<?php echo get_template_directory_uri(); ?>/images/whash-matchine.png" alt="">
             </div>
         </div>
      </div>
    </div>
        </div>
    </section> <!-- end about -->
</main>

<?php
get_footer();
