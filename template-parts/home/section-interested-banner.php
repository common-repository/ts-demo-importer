<?php
/**
 * Template part for interested banner
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_interested_banner_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_interested_banner_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_interested_banner_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_interested_banner_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_interested_banner_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_interested_banner_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  $ts_bgcolor_gradient = 'background-image:'.esc_attr(
                  get_theme_mod('ts_demo_importer_interested_banner_bg_gradient_name'). '(' .
                  get_theme_mod('ts_demo_importer_interested_banner_bg_gradient_direction') .',' .
                  get_theme_mod('ts_demo_importer_interested_banner_background_color_one') . ',' .
                  get_theme_mod('ts_demo_importer_interested_banner_background_color_two') . ',' .
                  get_theme_mod('ts_demo_importer_interested_banner_background_color_three') . ')'
                  ).'!important;';

?>
<section id="interested-banner" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container" style="<?php echo esc_attr($ts_bgcolor_gradient) ?>">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-sm-12 left-content">
      <?php  if(get_theme_mod('ts_demo_importer_interested_banner_left_main_heading')!=''){ ?>
      <h4 class="left-main-head">
        <?php echo get_theme_mod('ts_demo_importer_interested_banner_left_main_heading'); ?>
      </h4>
    <?php } if(get_theme_mod('ts_demo_importer_interested_banner_button')!=''){ ?>
      <a class="theme_button2" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_interested_banner_button_url')); ?>">
        <?php echo esc_html(get_theme_mod('ts_demo_importer_interested_banner_button')); ?>
        <?php if(get_theme_mod('ts_demo_importer_interested_banner_button_icon')!=''){ ?>
        <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_interested_banner_button_icon')); ?>"></i>
      <?php } ?>
      </a>
      <?php } ?>
      </div>
      <div class="col-lg-5 col-md-6 col-sm-12">
        <?php if ( get_theme_mod('ts_demo_importer_interested_banner_right_image') != "" ) { ?>
          <img  src="<?php echo esc_url(get_theme_mod('ts_demo_importer_interested_banner_right_image')); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_interested_banner_right_image_alt_text')); ?>" >
        <?php } ?>
      </div>
    </div>
  </div>
</section>
