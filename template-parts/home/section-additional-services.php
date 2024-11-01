<?php
/**
 * Template part for displaying Additional Services
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_additional_services_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_additional_services_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_additional_services_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_additional_services_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_additional_services_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_additional_services_bgimage')).'\')';
  }else{
    $about_backg='';
  }


?>
<section id="additional_services" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="row" data-aos="fade-up" data-aos-duration="2000">
          <?php
          $feature_no=get_theme_mod('ts_demo_importer_additional_services_number');
          for($i=1;$i<=$feature_no;$i++)
          {
          ?>
            <div class="col-lg-6 col-md-6 mb-4 services_outer">
              <div class="services_block position-relative">
                <?php if(get_theme_mod('ts_demo_importer_additional_services_image'.$i)!=''){ ?>
                  <img src="<?php echo esc_attr(get_theme_mod('ts_demo_importer_additional_services_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_title'.$i)); ?>">
                <?php } ?>
                <div class="services_block_content">
                  <?php if(get_theme_mod('ts_demo_importer_additional_services_icon'.$i)!=''){ ?>
                    <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_additional_services_icon'.$i)); ?>"></i>
                  <?php } ?>
                  <?php if(get_theme_mod('ts_demo_importer_additional_services_title'.$i)!=''){ ?>
                    <h5>
                      <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_url'.$i)); ?>">
                        <?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_title'.$i)); ?>
                      </a>
                    </h5>
                  <?php } if(get_theme_mod('ts_demo_importer_additional_services_text'.$i)!=''){ ?>
                    <div class="servicesa_p">
                      <?php echo get_theme_mod('ts_demo_importer_additional_services_text'.$i); ?>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="bg_shape2"></div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="additional_services_head section_main_head pt-3 pb-4 black_head" data-aos="fade-up" data-aos-duration="2000">
          <?php if(get_theme_mod('ts_demo_importer_additional_services_small_heading')!=''){ ?>
            <small>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_small_heading')); ?><span class="heading_border_style right_side"></span>
            </small>
          <?php } if(get_theme_mod('ts_demo_importer_additional_services_main_heading')!=''){ ?>
            <h3>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_main_heading')); ?>
            </h3>
          <?php } ?>

          <?php if(get_theme_mod('ts_demo_importer_additional_services_text')!=''){ ?>
            <div class="section_text">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_text')); ?>
            </div>
          <?php } ?>

          <?php if( get_theme_mod('ts_demo_importer_additional_services_button_read_more') != ''){ ?>
            <div class="custom_btn mt-4" data-aos="zoom-in-down" data-aos-duration="2000">
              <a class="theme_button2" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_additional_services_button_read_more_url')); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_additional_services_button_read_more')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_additional_services_button_read_more_icon')); ?>"></i>
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
