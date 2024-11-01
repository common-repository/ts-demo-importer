<?php
/**
 * Template part for displaying Consult Us
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_consult_us_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_consult_us_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_consult_us_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_consult_us_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_consult_us_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_consult_us_bgimage')).'\')';
  }else{
    $about_backg='';
  }

    $img_bg = get_theme_mod( 'ts_demo_importer_consult_us_bgimage_setting' );

?>
<section id="consult_us" class="<?php echo esc_attr($img_bg); ?> position-relative" style="<?php echo esc_attr($about_backg); ?>" data-aos="zoom-in-down" data-aos-duration="2000">
  <div class="right_svg">
    <?php
      if ( function_exists('ts_demo_importer_consult_us_shape') ) {
        ts_demo_importer_consult_us_shape();
      }
    ?>
  </div>
  <div class="container">
    <div class="consult_us-head section_main_head pb-4">
      <?php if(get_theme_mod('ts_demo_importer_consult_us_small_heading')!=''){ ?>
        <small>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_consult_us_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
  </div>
  <div class="owl-carousel">
    <?php
    $feature_no=get_theme_mod('ts_demo_importer_consult_us_number');
    for($i=1;$i<=$feature_no;$i++)
    {
    ?>
      <div class="consult_box">
        <div class="position-relative">
          <?php if(get_theme_mod('ts_demo_importer_consult_us_icon'.$i)!=''){ ?>
            <div class="consult_icon">
              <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_consult_us_icon'.$i)); ?>"></i>
            </div>
          <?php } ?>
          <div class="">

            <?php if(get_theme_mod('ts_demo_importer_consult_us_sub_title'.$i)!=''){ ?>
            <h6>
                <?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_sub_title'.$i)); ?>
            </h6>

            <?php } if(get_theme_mod('ts_demo_importer_consult_us_title'.$i)!=''){ ?>
            <h5>
              <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_url'.$i)); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_title'.$i)); ?>
              </a>
            </h5>

            <?php } if(get_theme_mod('ts_demo_importer_consult_us_text'.$i)!=''){ ?>
              <div class="consult_us_p">
                <?php echo get_theme_mod('ts_demo_importer_consult_us_text'.$i); ?>
              </div>
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_consult_us_box_link'.$i)!=''){ ?>
              <a class="hire_us_link" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_box_url'.$i)); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_consult_us_box_link'.$i)); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_consult_us_box_link_icon'.$i)); ?>"></i>
              </a>
            <?php } ?>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>

</section>
