<?php
/**
 * The Template for displaying footer newsletter.
 *
 * @package ts-demo-importer
 */
$newsletter_section = get_theme_mod( 'ts_demo_importer_footer_newsletter_enable' );
if ( 'Disable' == $newsletter_section ) {
  return;
}
/*banner*/
if( get_theme_mod('ts_demo_importer_footer_newsletter_bgcolor') ) {
  $newsletter_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_footer_newsletter_bgcolor')).';';
}elseif( get_theme_mod('ts_demo_importer_footer_newsletter_bgimage') ){
  $newsletter_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_footer_newsletter_bgimage')).'\')';
}else{
  $newsletter_backg = '';
}

if( get_theme_mod('ts_demo_importer_footer_newsletter_bgimage_attachment') ) {
  $newsletter_backg_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_footer_newsletter_bgimage_attachment')).';';
}
?>

<section id="newsletter">
  <div class="container">
    <div class="newsleter-content text-center" style="<?php echo $newsletter_backg; $newsletter_backg_att ?>" data-aos="zoom-in-down" data-aos-duration="2000">
      <?php if (get_theme_mod('ts_demo_importer_footer_newsletter_paragraph') != '') { ?>
          <p>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_footer_newsletter_paragraph')); ?>
          </p>
      <?php } ?>

      <?php if (get_theme_mod('ts_demo_importer_footer_newsletter_heading') != '') { ?>
          <h2 class="section-main-heading">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_footer_newsletter_heading')); ?>
          </h2>
      <?php } ?>

      <?php echo do_shortcode(get_theme_mod('ts_demo_importer_footer_newsletter_form_shortcode')); ?>

    </div>
  </div>
</section>
