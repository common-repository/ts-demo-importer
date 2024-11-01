<?php
/**
 * Template part for displaying our process
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_how_we_work_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_how_we_work_bgimage_setting');

  if( get_theme_mod('ts_demo_importer_how_we_work_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_how_we_work_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_how_we_work_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_how_we_work_bgimage')).'\')';
  }else{
    $about_backg='';
  }

?>
<section id="how-we-work" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">

    <div class="process-head section_main_head text-center pb-4 " data-aos="fade-up" data-aos-duration="2000">
      <?php if(get_theme_mod('ts_demo_importer_how_we_work_small_heading')!=''){ ?>
        <small>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_how_we_work_small_heading')); ?>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_how_we_work_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_how_we_work_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>

    <div class="row">
      <?php
      $process_no=get_theme_mod('ts_demo_importer_how_we_work_number');
      for($i=1;$i<=$process_no;$i++)
      {
      ?>
        <div class="col-lg-3 col-md-6 col-sm-6 process-box text-center" data-aos="flip-down" data-aos-duration="2000">
          <div class="position-relative how_outer">
            <div class="how_img">
              <?php if(get_theme_mod('ts_demo_importer_how_we_work_icon'.$i)!=''){ ?>
                <img src="<?php echo esc_html(get_theme_mod('ts_demo_importer_how_we_work_icon'.$i)); ?>"  alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_image_alt_text'.$i)); ?>" loading="lazy">
              <?php } ?>
              <div class="circle_box1"></div>
            <div class="circle_box2"></div>
            </div>

            <?php if(get_theme_mod('ts_demo_importer_how_we_work_title'.$i)!=''){ ?>
              <?php if(get_theme_mod('ts_demo_importer_how_we_work_url'.$i) == ''){ ?>
                <h5>
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_how_we_work_title'.$i)); ?>
                </h5>
              <?php } else { ?>
                <a href="<?php echo esc_url(get_theme_mod('ts_demo_importer_how_we_work_url'.$i)); ?>">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_how_we_work_title'.$i)); ?>
                </a>
              <?php } ?>
            <?php } ?>

          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
