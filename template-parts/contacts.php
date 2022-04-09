<?php

/**

 * The template name: Contacts

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

                </div>

            </div>

        </div>

        <?php if( have_rows('dobavit_kontakty') ): ?>

        <div class="contact-block _contactpage">

            <div class="container">

                <div class="contact-row">

                  <?php while( have_rows('dobavit_kontakty') ): the_row(); ?>

                    <!-- start -->

                    <div class="cnt-item">

                        <div class="cnt-content">

                            <div class="cnt-icon">

                              <img src="<?php the_sub_field('ikonka'); ?>" alt="">

                            </div>

                            <div class="cnt-r">

                            <span><?php the_sub_field('tip_kontakta'); ?></span>

                            <?php

    if(get_sub_field('tip_kontakta') == "Email"): ?>

    <a href="mailto:<?php the_sub_field('kontakty'); ?>"><?php the_sub_field('kontakty'); ?></a>

  <?php elseif (get_sub_field('tip_kontakta') == "Phone number") : ?>

    <a href="tel:<?php the_sub_field('kontakty'); ?>"><?php the_sub_field('kontakty'); ?></a>

  <?php else: ?>

    <div class="adress"><?php the_sub_field('kontakty'); ?></div>

  		<?php endif; ?>



                            </div>

                        </div>

                    </div>

                    <!-- end -->

<?php endwhile; ?>

                </div>

            </div>

        </div><!-- end contact items -->

      <?php endif; ?>

    </div>





    <section class="contact_us">

        <div class="container">

            <div class="frm-content">

                <div class="section-title">Contact us</div>

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

</main>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Optimus Appliance & HVAC Inc",
  "image": "https://optimusappliance-hvac.com/wp-content/uploads/2022/01/logo.svg",
  "@id": "",
  "url": "https://optimusappliance-hvac.com",
  "telephone": "+1 (858) 225-17-15",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "6723 Torenia TRL #246, San Diego, CA 92130",
    "addressLocality": "San Diego",
    "addressRegion": "CA",
    "postalCode": "92130",
    "addressCountry": "US"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 32.9680244,
    "longitude": -117.1724748
  }  
}
</script>
<?php

get_footer();

