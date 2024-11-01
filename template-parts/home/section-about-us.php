<?php
/**
 * Template part for displaying about us
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_about_us_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_about_us_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_about_us_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_about_us_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_about_us_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_about_us_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  $about_col1="";
  $about_col2="";
  if(get_theme_mod('ts_demo_importer_about_us_heading_image')!=''){
    $about_col1="col-lg-6 col-md-12";
    $about_col2="col-lg-6 col-md-12";
  }else{
    $about_col1="col-lg-12 col-md-12";
    $about_col2="";
  }

?>
<section id="about-us" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <?php if( $template == 'advance-training-academy' ) { ?>
    <div class="container">
      <?php if( get_theme_mod('ts_demo_importer_about_us_right_image','') ){
        $about_right_image = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_about_us_right_image')).'\')';
      }else{
        $about_right_image='';
      } ?>
      <div class="d-flex about-right-image-bg" style="<?php echo esc_attr($about_right_image); ?>">
        <div class="about-left-content" data-aos="slide-right" data-aos-duration="2000">
          <div class="about-box text-center">
            <?php if (get_theme_mod('ts_demo_importer_about_us_title') != '') { ?>
              <h3 class="about-main-heading">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_title')); ?>
              </h3>
            <?php } ?>
            <?php if (get_theme_mod('ts_demo_importer_about_us_text') != '') { ?>
              <p>
                <?php echo (get_theme_mod('ts_demo_importer_about_us_text')); ?>
              </p>
            <?php } ?>
            <?php if (get_theme_mod('ts_demo_importer_about_us_button_text') != '') { ?>
              <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_button_url')); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_button_text')); ?>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php }elseif( $template == 'ts-conference' ){ ?>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="left-image-container position-relative">
            <?php if (get_theme_mod('ts_demo_importer_about_us_left_image') != '') { ?>
              <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_about_us_left_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_about_us_left_image_alt_text')); ?>">
            <?php } ?>
          </div>
        </div>
        <div class="col-md-6 about-us-right-content">

          <?php if (get_theme_mod('ts_demo_importer_about_us_small_heading') != '') { ?>
            <h6 class="section-small-heading mt-4">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_small_heading')); ?>
            </h6>
          <?php } ?>

          <?php if (get_theme_mod('ts_demo_importer_about_us_main_heading') != '') { ?>
            <h2 class="section-main-heading">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_main_heading')); ?>
            </h2>
          <?php } ?>

          <?php if (get_theme_mod('ts_demo_importer_about_us_para_one') != '') { ?>
            <p class="section-para mt-3">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_para_one')); ?>
            </p>
          <?php } ?>

          <?php if (get_theme_mod('ts_demo_importer_about_us_para_two') != '') { ?>
            <p class="section-para">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_para_two')); ?>
            </p>
          <?php } ?>

          <?php if (get_theme_mod('ts_demo_importer_about_us_read_more_button') != '') { ?>
            <a class="section-btn mt-4 d-inline-block" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_read_more_button_url')); ?>">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_read_more_button')); ?>
            </a>
          <?php } ?>

        </div>
      </div>
    </div>
  <?php }else{ ?>
    <div class="container">
      <div class="row">
        <?php if(get_theme_mod('ts_demo_importer_about_us_heading_image')!=''){ ?>
          <div class="<?php echo esc_attr($about_col2); ?> about-image position-relative">
            <div class="">
              <div class="position-relative about_outer">

                <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_about_us_heading_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_about_us_heading_image_alt_text')); ?>">

              <div class="image_badge">
                <div class="media d-flex">
                  <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_about_us_badge_icon')); ?>"></i>
                  <div class="media-body">
                    <span class="badge_text d-block"><?php echo get_theme_mod('ts_demo_importer_about_us_image_badge_text'); ?></span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          </div>
        <?php } ?>

        <div class="<?php echo esc_attr($about_col1); ?> about-details" data-aos="fade-right" data-aos-duration="2000">
          <div class="about-head section_main_head">
              <div class="about-title">
                <?php if(get_theme_mod('ts_demo_importer_about_us_small_heading')!=''){ ?>
                <small>
                  <span class="heading_border_style"></span><?php echo get_theme_mod('ts_demo_importer_about_us_small_heading'); ?>
                </small>
              <?php } if(get_theme_mod('ts_demo_importer_about_us_main_heading')!=''){ ?>
                <h3>
                  <?php echo get_theme_mod('ts_demo_importer_about_us_main_heading'); ?>
                </h3>
              <?php } ?>
              </div>
          </div>
          <?php if(get_theme_mod('ts_demo_importer_about_us_text')!=''){ ?>
            <div class="about-text">
              <?php echo get_theme_mod('ts_demo_importer_about_us_text'); ?>
            </div>
          <?php } ?>
          <?php if(get_theme_mod('ts_demo_importer_about_us_button_title')!=''){ ?>
            <a class="theme_button2" href="<?php echo get_theme_mod('ts_demo_importer_about_us_button_url'); ?>">
              <?php echo get_theme_mod('ts_demo_importer_about_us_button_title'); ?>
              <?php if(get_theme_mod('ts_demo_importer_about_us_button_icon')!=''){ ?>
                <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_about_us_button_icon')); ?>"></i>
              <?php } ?>
            </a>
          <?php } ?>
          <div class="bg_shape"></div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>
