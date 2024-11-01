<?php
/**
 * Template part for displaying Achievements
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_achievements_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_achievements_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_achievements_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_achievements_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_achievements_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_achievements_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  if( get_theme_mod('ts_demo_importer_achievements_carousel_loop', true) ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_achievements_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_achievements_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_achievements_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_achievements_carousel_nav', false) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-12 col-md-12 col-sm-12 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }

  $achievements_no = get_theme_mod('ts_demo_importer_achievements_number');

?>
<section id="achievements" style="<?php echo esc_attr($about_backg); ?>" class="carousel carousel-fade slide <?php echo esc_attr($img_bg); ?>" data-bs-ride="carousel">
  <div class="container custom_cls">
    <ol class="carousel-indicators">
      <?php for($i=1;$i<=$achievements_no;$i++){ ?>
        <li data-bs-target="#achievements" data-bs-slide-to="<?php echo($i-1); ?>" class="<?php if($i==1){echo 'active';} ?>"><span><?php echo esc_html(get_theme_mod('ts_demo_importer_achievements_years'.$i)); ?></span></li>
      <?php } ?>
    </ol>
  </div>
  <div class="container">
    <div class="carousel-inner">

      <?php

      for($i=1;$i<=$achievements_no;$i++)
      {

        $about_col1="";
        $about_col2="";
        if(get_theme_mod('ts_demo_importer_achievements_heading_image'.$i)!=''){
          $about_col1="col-lg-6 col-md-12";
          $about_col2="col-lg-6 col-md-12";
        }else{
          $about_col1="col-lg-12 col-md-12";
          $about_col2="";
        }

      ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <div class="row ">
            <?php if(get_theme_mod('ts_demo_importer_achievements_heading_image'.$i)!=''){ ?>
              <div class="<?php echo esc_attr($about_col2); ?> about-image position-relative ">
                <div class="achievements_outer">
                  <div class="position-relative achievements_outer">

                    <?php if(get_theme_mod('ts_demo_importer_achievements_bgquote_icon')!=''){ ?>
                      <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_achievements_bgquote_icon')); ?> bg_quote"></i>
                    <?php } ?>

                    <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_achievements_heading_image'.$i)); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_achievements_heading_image_alt_text'.$i)); ?>">
                    <?php if(get_theme_mod('ts_demo_importer_achievements_quote_icon')!=''){ ?>
                      <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_achievements_quote_icon')); ?> bottom_quote"></i>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>

            <div class="<?php echo esc_attr($about_col1); ?> achievements-details" data-aos="fade-right" data-aos-duration="2000">
              <div class="achievements-head section_main_head black_head ">
                  <div class="achievements-title">
                    <?php if(get_theme_mod('ts_demo_importer_achievements_small_heading'.$i)!=''){ ?>
                    <small>
                      <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_achievements_small_heading'.$i)); ?>
                    </small>
                  <?php } if(get_theme_mod('ts_demo_importer_achievements_main_heading'.$i)!=''){ ?>
                    <h3>
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_achievements_main_heading'.$i)); ?>
                    </h3>
                  <?php } ?>
                  </div>
              </div>
              <?php if(get_theme_mod('ts_demo_importer_achievements_text'.$i)!=''){ ?>
                <div class="achievements-text">
                  <?php echo get_theme_mod('ts_demo_importer_achievements_text'.$i); ?>
                </div>
              <?php } ?>

              <div class="slide_nav">
                <a class="carousel-prev-button hvr-shrink" href="#achievements" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                  <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
                </a>
                <a class="carousel-next-button hvr-shrink" href="#achievements" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                  <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
                </a>
              </div>

            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
