<?php
/**
 * Template part for displaying Skills
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_skills_showcase_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_skills_showcase_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_skills_showcase_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_skills_showcase_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_skills_showcase_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_skills_showcase_bgimage')).'\')';
  }else{
    $about_backg='';
  }

    $img_bg = get_theme_mod( 'ts_demo_importer_skills_showcase_bgimage_setting' );

?>
<section id="skills_show_case" class="position-relative <?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="skills_block">
      <div class="feature-head section_main_head pt-3 pb-3 black_head" data-aos="fade-up" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_skills_showcase_small_heading')!=''){ ?>
          <small>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_skills_showcase_small_heading')); ?><span class="heading_border_style right_side"></span>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_skills_showcase_main_heading')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_skills_showcase_main_heading')); ?>
          </h3>
        <?php } ?>

        <?php if(get_theme_mod('ts_demo_importer_skills_showcase_section_text')!=''){ ?>
          <div class="section_text">
            <?php echo get_theme_mod('ts_demo_importer_skills_showcase_section_text'); ?>
          </div>
        <?php } ?>
      </div>
      <div data-aos="fade-up" data-aos-duration="2000">
        <?php
        $skills_no=get_theme_mod('ts_demo_importer_skills_showcase_number');
        for($i=1;$i<=$skills_no;$i++)
        {
        ?>
          <div class="Skills_box">
            <?php if(get_theme_mod('ts_demo_importer_skills_showcase_title'.$i)!=''){ ?>
              <h6><?php echo esc_html(get_theme_mod('ts_demo_importer_skills_showcase_title'.$i)); ?></h6>
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_skills_showcase_percentage'.$i)!=''){ ?>
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo get_theme_mod('ts_demo_importer_skills_showcase_percentage'.$i); ?>%;" aria-valuenow="<?php echo get_theme_mod('ts_demo_importer_skills_showcase_percentage'.$i); ?>" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-value"><?php echo get_theme_mod('ts_demo_importer_skills_showcase_percentage'.$i); ?>%</div>
                </div>
              </div>
            <?php } ?>

          </div>
        <?php } ?>
      </div>

    </div>
    <div class="skills_bg"></div>
  </div>

</section>
