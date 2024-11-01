<?php
/**
 * Template part for displaying Skills
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_business_skills_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_business_skills_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_business_skills_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_business_skills_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_business_skills_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_business_skills_bgimage')).'\')';
  }else{
    $about_backg='';
  }

    $img_bg = get_theme_mod( 'ts_demo_importer_business_skills_bgimage_setting' );

?>
<section id="business_skills" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="skills_block">
      <div class="feature-head section_main_head pt-3 pb-4 black_head head_center text-center" data-aos="fade-up" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_business_skills_small_heading')!=''){ ?>
          <small>
            <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_business_skills_small_heading')); ?><span class="heading_border_style right_side"></span>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_business_skills_main_heading')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_business_skills_main_heading')); ?>
          </h3>
        <?php } ?>
      </div>
      <div class="row" data-aos="fade-up" data-aos-duration="2000">
        <?php
        $skills_no=get_theme_mod('ts_demo_importer_business_skills_number');
        for($i=1;$i<=$skills_no;$i++)
        {
        ?>
          <div class="Skills_box col-lg-3 col-md-6 text-center">
            <?php if(get_theme_mod('ts_demo_importer_business_skills_percentage'.$i)!=''){ ?>
              <div class="progress mx-auto" data-value='<?php echo get_theme_mod('ts_demo_importer_business_skills_percentage'.$i); ?>'>
                <span class="progress-left">
                  <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                  <span class="progress-bar"></span>
                </span>
                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                  <?php if(get_theme_mod('ts_demo_importer_business_skills_icon'.$i)!=''){ ?>
                    <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_business_skills_icon'.$i)); ?>"></i>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
            <div class="skills_content mt-2">
              <?php if(get_theme_mod('ts_demo_importer_business_skills_title'.$i)!=''){ ?>
                <h5><?php echo esc_html(get_theme_mod('ts_demo_importer_business_skills_title'.$i)); ?></h5>
              <?php } ?>

              <?php if(get_theme_mod('ts_demo_importer_business_skills_desc'.$i)!=''){ ?>
                <div class="box_desc"><?php echo get_theme_mod('ts_demo_importer_business_skills_desc'.$i); ?></div>
              <?php } ?>
            </div>

          </div>
        <?php } ?>
      </div>

    </div>
  </div>

</section>
