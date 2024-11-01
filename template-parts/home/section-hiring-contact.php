<?php
/**
 * Template part for displaying Hiring Contact
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_hiring_contact_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  $img_bg = get_theme_mod('ts_demo_importer_hiring_contact_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_hiring_contact_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_hiring_contact_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_hiring_contact_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_hiring_contact_bgimage')).'\')';
  }else{
    $about_backg='';
  }

?>
<section id="hiring-contact" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container position-relative">
    <div class="hiring_contact_block">
      <div class="section_main_head pt-3 pb-2 black_head" data-aos="zoom-in-up" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_hiring_contact_small_heading')!=''){ ?>
          <small>
            <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_contact_small_heading')); ?>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_hiring_contact_main_heading')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_contact_main_heading')); ?>
          </h3>
        <?php } ?>

        <?php if(get_theme_mod('ts_demo_importer_hiring_contact_text')!=''){ ?>
          <div class="section_desc">
            <?php echo get_theme_mod('ts_demo_importer_hiring_contact_text'); ?>
          </div>
        <?php } ?>

        <?php if(get_theme_mod('ts_demo_importer_hiring_contact_shortcode')!=''){ ?>
          <div class="hiring-contact-shortcode">
            <?php echo do_shortcode(get_theme_mod('ts_demo_importer_hiring_contact_shortcode')); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
