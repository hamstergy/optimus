<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package atlas
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
</head>


<body>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62431bba0bfe3f4a8770460c/1fvb28k9e';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<?php wp_body_open(); ?>
<header>
<div class="top-line">
    <div class="container">
        <div class="header-contacts">
            <div class="contact-left">
                <ul>
                    <li><i class="location"></i><?php the_field('location', 'options'); ?></li>
                    <li><i class="mail"></i><a href="mailto:<?php the_field('mail', 'options'); ?>"><?php the_field('mail', 'options'); ?></a></li>
                </ul>
            </div>
            <div class="contact-right">
                <ul>
                    <li><i class="phone"></i><a href="tel:<?php echo str_replace('', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'options'); ?></a></li>
                </ul>
                <div class="mobile-toogle">
                    <a href="#" class="toggle-mnu"><span></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-primary">
    <div class="container">
        <div class="header-top">
            <div class="logo-side">
              <?php
              the_custom_logo();
              if ( is_front_page() && is_home() ) :
                ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php   endif;?>
            </div>
            <button class="service-item open-popup-link" data-mfp-src="#popup">Request Service</button>
            <div class="menu-side">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								)
							);
							?>
  <div class="top-btn">
                    <div class="group service-item">
                        <a href="#" data-mfp-src="#popup" class="open-popup-link">Request Service</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
</header>
