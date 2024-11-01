<?php
/**
 * Template part for displaying Our Vision
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_vision_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_our_vision_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_our_vision_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_vision_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_vision_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_vision_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  $about_col1="";
  $about_col2="";
  if(get_theme_mod('ts_demo_importer_our_vision_heading_image')!=''){
    $about_col1="col-lg-6 col-md-12";
    $about_col2="col-lg-6 col-md-12";
  }else{
    $about_col1="col-lg-12 col-md-12";
    $about_col2="";
  }
  
?>
<section id="our-vision" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="row">

      <div class="<?php echo esc_attr($about_col1); ?> about-details" data-aos="fade-right" data-aos-duration="2000">
        <div class="about-head section_main_head black_head">
            <div class="about-title">
              <?php if(get_theme_mod('ts_demo_importer_our_vision_small_heading')!=''){ ?>
              <small>
                <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_our_vision_small_heading')); ?>
              </small>
            <?php } if(get_theme_mod('ts_demo_importer_our_vision_main_heading')!=''){ ?>
              <h3>
                <?php echo esc_html(get_theme_mod('ts_demo_importer_our_vision_main_heading')); ?>
              </h3>
            <?php } ?>
            </div>
        </div>
        <?php if(get_theme_mod('ts_demo_importer_our_vision_text')!=''){ ?>
          <div class="about-text">
            <?php echo get_theme_mod('ts_demo_importer_our_vision_text'); ?>
          </div>
        <?php } ?>
        <?php if(get_theme_mod('ts_demo_importer_our_vision_button_title')!=''){ ?>
          <a class="theme_button2" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_vision_button_url')); ?>">

            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_vision_button_title')); ?>
            <?php if(get_theme_mod('ts_demo_importer_our_vision_button_icon')!=''){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_vision_button_icon')); ?>"></i>
            <?php } ?>
          </a>
        <?php } ?>
        <div class="bg_shape"></div>
      </div>

      <?php if(get_theme_mod('ts_demo_importer_our_vision_heading_image')!=''){ ?>

        <div class="<?php echo esc_attr($about_col2); ?> video-image ">
          <div class="position-relative">
            <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_our_vision_heading_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_vision_heading_image_alt_text')); ?>" loading="lazy">
              <div class="ps_video">
                <div class="video_overlay">
                  <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_vision_video_icon')); ?>" data-popup-open="popup-1"></i>
                </div>
              </div>
          </div>
          <div class="over_video">  
            <div class="popup" data-popup="popup-1">
              <div class="popup-inner">
                <?php if( get_theme_mod('ts_demo_importer_our_vision_video_url', true) != ''){ ?>
                  <div class="video">
                    <embed height="400px" width="100%" src="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_vision_video_url')); ?>" allowfullscreen>
                  </div>
                  <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>