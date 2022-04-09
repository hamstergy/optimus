<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package atlas
 */

?>
<footer>
<div class="footer-content">
    <div class="container">
        <div class="footer-wrap">
            <div class="footer-left">
                <div class="footer-logo">
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php the_field('footer_logo', 'options'); ?>" alt="">
                  </a>
                </div>
                <?php if (get_field('copywrite', 'options')) : ?>
                <div class="copywrite"><?php the_field('copywrite', 'options'); ?></div>
              <?php endif; ?>
            </div>
            <div class="footer-center">
<div class="footer-nav">
    <div class="nav-col">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'menu-2',
          'menu_id'        => 'ft-left',
        )
      );
      ?>
    </div>
    <div class="nav-col _col">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'menu-3',
          'menu_id'        => 'ft-right',
        )
      );
      ?>
    </div>
</div>
            </div>
            <div class="footer-right">
                <ul>
                    <li><i class="phone"></i><a href="tel:<?php echo str_replace('', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'options'); ?></a></li>
                    <li><i class="location"></i><?php the_field('location', 'options'); ?></li>
                    <li><i class="mail"></i><a href="mailto:<?php the_field('mail', 'options'); ?>"><?php the_field('mail', 'options'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</footer>
<!-- mobile -->
<div class="opacity"></div>
<div class="mobile-side">
    <div class="side-wrap">
        <div class="side-menu">
            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'mobile-menu',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                            );
                            ?>
    
        </div>
        <div class="menu-contacts">
            <ul>
                <li><i class="location"></i> <?php the_field('location', 'options'); ?></li>
                <li><i class="mail"></i><a href="mailto:<?php the_field('mail', 'options'); ?>"><?php the_field('mail', 'options'); ?></a></li>
                <li><i class="phone"></i><a href="tel:<?php echo str_replace('', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'options'); ?></a></li>
            </ul>
        </div>
        <div class="side-button">
            <div class="group service-item">
                <a href="#" data-mfp-src="#popup" class="open-popup-link">Request Service</a>
            </div> 
        </div>
    </div>

</div>
<!-- end -->
<?php wp_footer(); ?>
<!-- dialog itself, mfp-hide class is required to make dialog hidden -->
<div id="popup" class="popup zoom-anim-dialog mfp-hide">
            <div class="frm-content">
                <div class="section-title">Send us a request to book an appointment or get an estimate</div>
                <form class="fprm-grid" id="form-send">
                    <input type="hidden" name="Пришел со страницы" value="<?php the_title(); ?>">
<div class="input-row">
    <div class="input-group">
        <input type="text" class="text-field" name="Name" placeholder="Your name *" required>
    </div>
    <div class="input-group">
        <input type="text" class="text-field" name="Email" placeholder="Email">
    </div>
    <div class="input-group">
        <input type="text" class="text-field" name="Phone" placeholder="Phone number *" required>
    </div>
</div>
<div class="input-grop-row">
        <div class="input-group">
        <input type="text" class="text-field" name="Adress" placeholder="Your address">
    </div>
    <div class="input-group">
        <input type="text" class="text-field" name="ZIP code" placeholder="ZIP code">
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
<?php
if(is_home() ) : ?>
<script type="text/javascript">
$(function(){
var current = location.pathname;
$('.menu-side a').each(function(){
    var $this = $(this);
    if($this.attr('href').indexOf(current) !== -1){
        $this.addClass('current-menu-item');
    }
})
})
</script>
<?php endif; ?>
<script>
    $(document).ready(function() {

  $("#form-send, #formsend").submit(function(elem) { //Change
    var th = $(this);
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php?action=send_form", //Change
      data: th.serialize()
    }).done(function(response) {
      setTimeout(function() {
        th.trigger("reset");
        $.magnificPopup.close();
       $('.mess').css('display', 'none');
        
      }, 3000);
      $('#form-send, #formsend').after().append('<div class="mess"><div class="mess-body">Your message has been sent successfully <br>We will review your message and get back to you promptly</div></div>');
    });
    return false;
  });

});

$('form input[type=text]').on('change invalid', function() {
    var textfield = $(this).get(0);

    // 'setCustomValidity not only sets the message, but also marks
    // the field as invalid. In order to see whether the field really is
    // invalid, we have to remove the message first
    textfield.setCustomValidity('');

    if (!textfield.validity.valid) {
        textfield.setCustomValidity('This field is required');  
    }
});

</script>
</body>
</html>