<?php
/**
 * Template part for displaying our features
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_skills_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  $img_bg = get_theme_mod('ts_demo_importer_our_skills_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_our_skills_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_skills_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_skills_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_skills_bgimage')).'\')';
  }else{
    $about_backg='';
  }

?>
<section id="our-skills" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="feature-head section_main_head text-center pt-3 pb-4 white_head head_center" data-aos="fade-up" data-aos-duration="2000">
      <?php if(get_theme_mod('ts_demo_importer_our_skills_small_heading')!=''){ ?>
        <small>
          <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_our_skills_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_our_skills_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_our_skills_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
    <div class="row" data-aos="fade-up" data-aos-duration="2000">
      <?php
      $feature_no=get_theme_mod('ts_demo_importer_our_skills_number');
      for($i=1;$i<=$feature_no;$i++)
      {
      ?>
        <div class="col-lg-4 col-md-6 mb-4 ">
          <div class="custom_block position-relative">
            <div class="custom_block_i">
              <?php if(get_theme_mod('ts_demo_importer_our_skills_icon'.$i)!=''){ ?>
                <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_skills_icon'.$i)); ?>"></i>
              <?php } ?>
            </div>
            <div class="media-body">
              <?php if(get_theme_mod('ts_demo_importer_our_skills_title'.$i)!=''){ ?>
              <h5>
                <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_skills_url'.$i)); ?>">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_our_skills_title'.$i)); ?>
                </a>
              </h5>
            <?php } if(get_theme_mod('ts_demo_importer_our_skills_text'.$i)!=''){ ?>
              <div class="skills_p">
                <?php echo get_theme_mod('ts_demo_importer_our_skills_text'.$i); ?>
              </div>
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_our_skills_percentage'.$i)!=''){ ?>
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo get_theme_mod('ts_demo_importer_our_skills_percentage'.$i); ?>%;" aria-valuenow="<?php echo get_theme_mod('ts_demo_importer_our_skills_percentage'.$i); ?>" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-value"><?php echo get_theme_mod('ts_demo_importer_our_skills_percentage'.$i); ?>%</div>
                </div>
              </div>
            <?php } ?>

            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
