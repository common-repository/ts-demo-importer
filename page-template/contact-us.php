<?php
/**
 * Template Name:Contact Us
*/

get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );

$template = wp_get_theme()->get( 'TextDomain' ); ?>

<section id="contact-us" class="contact-us">
  <div class="container">
    <div class="contact-us-box">
      <div class="row">
        <div class="col-lg-6">
          <div class="contact-us-left-content">
            <?php if (get_theme_mod('ts_demo_importer_contact_page_main_heading',true) != ""){?>
               <h3 class="contact-page-heading">
                 <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_main_heading')); ?>
               </h3>
            <?php } ?>

            <?php if (get_theme_mod('ts_demo_importer_contact_page_main_para',true) != ""){?>
               <p>
                 <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_main_para')); ?>
               </p>
            <?php } ?>

            <?php if (get_theme_mod('ts_demo_importer_contact_page_phone_number',true) != ""){ ?>
               <a href="tel:<?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_phone_number')); ?>">
                 <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_phone_number_icon')); ?>"></i>
                 <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_phone_number')); ?>
               </a>
            <?php } ?>

            <?php if (get_theme_mod('ts_demo_importer_contact_page_email_address',true) != ""){?>
               <a href="mailto:<?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_email_address')); ?>">
                 <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_email_address_icon')); ?>"></i>
                 <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_page_email_address')); ?>
               </a>
            <?php } ?>

            <?php do_action('ts_demo_importer_before_map'); ?>
               <div class="google-map" id="map">
                 <?php if ( get_theme_mod('ts_demo_importer_address_latitude',true) != "" && get_theme_mod('ts_demo_importer_address_longitude',true) != "" ) { ?>
                   <embed width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                          src="https://maps.google.com/maps?q=<?php echo esc_attr(get_theme_mod('ts_demo_importer_address_latitude')); ?>,<?php echo esc_attr(get_theme_mod('ts_demo_importer_address_longitude')); ?>&hl=es;z=14&amp;output=embed">
                  </embed>
                <?php } ?>
              </div>
            <?php do_action('ts_demo_importer_after_map'); ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-us-right-content">
            <?php if (get_theme_mod('ts_demo_importer_contactpage_form_code') != '') {
               echo do_shortcode(get_theme_mod('ts_demo_importer_contactpage_form_code'));
            }else {
              echo "<h4> Please install and activate the contact form 7 plugin </h4>";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>
