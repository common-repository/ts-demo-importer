<?php
/**
 * Template part for displaying Single Team
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_single_team_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_single_team_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_single_team_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_single_team_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_single_team_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_single_team_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  $about_col1="";
  $about_col2="";
  if(get_theme_mod('ts_demo_importer_single_team_image')!=''){
    $about_col1="col-lg-6 col-md-12";
    $about_col2="col-lg-6 col-md-12";
  }else{
    $about_col1="col-lg-12 col-md-12";
    $about_col2="";
  }

?>
<section id="single-team" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="row">
      <?php if(get_theme_mod('ts_demo_importer_single_team_image')!=''){ ?>
        <div class="<?php echo esc_attr($about_col2); ?> about-image ">
          <div class="position-relative">
            <div class="shape_converage">
              <svg id="team_svg" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 727.9 731.55"><defs>
              </defs><path class="team_svg_cls" d="M0,0V731.55H727.9V0ZM724.62,428C703.16,547.75,293.75,819.5,97.09,699.72S34.51,16.77,265.14,2.46,746.07,308.18,724.62,428Z"/></svg>
              <div class="circle_shape"></div>
            </div>
            <div class="about_single_outer">
              <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_single_team_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_single_team_image_alt_text')); ?>">
            </div>
          </div>
        </div>
      <?php } ?>

      <div class="<?php echo esc_attr($about_col1); ?> d-flex align-items-center" data-aos="fade-right" data-aos-duration="2000">
        <div class="about-head section_main_head black_head">
            <div class="about-title">
              <?php if(get_theme_mod('ts_demo_importer_single_team_small_heading')!=''){ ?>
              <small>
                <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_single_team_small_heading')); ?>
              </small>
            <?php } if(get_theme_mod('ts_demo_importer_single_team_main_heading')!=''){ ?>
              <h3>
                <?php echo esc_html(get_theme_mod('ts_demo_importer_single_team_main_heading')); ?>
              </h3>
            <?php } ?>
            </div>

            <?php if(get_theme_mod('ts_demo_importer_single_team_text')!=''){ ?>
              <div class="about-text">
                <?php echo get_theme_mod('ts_demo_importer_single_team_text'); ?>
              </div>
            <?php } ?>

            <div class="member_details">
              <?php if(get_theme_mod('ts_demo_importer_single_team_member_name')!=''){ ?>
                <h6><?php echo esc_html(get_theme_mod('ts_demo_importer_single_team_member_name')); ?> </h6>
              <?php } ?>
              <?php if(get_theme_mod('ts_demo_importer_single_team_member_desig')!=''){ ?>
                <span><?php echo esc_html(get_theme_mod('ts_demo_importer_single_team_member_desig')); ?> </span>
              <?php } ?>
            </div>
            <div class="single_team_icon mt-4">
              <?php $si_no=get_theme_mod('ts_demo_importer_single_team_number');
                for($i=1;$i<=$si_no;$i++)
                {

                if( get_theme_mod('ts_demo_importer_single_team_social_icon'.$i) != '' ){ ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'ts_demo_importer_single_team_social_icon_url'.$i ) ); ?>" target="_blank"><i class="<?php echo esc_attr( get_theme_mod( 'ts_demo_importer_single_team_social_icon'.$i ) ); ?>"></i></a>
                <?php }

              }?>
            </div>

        </div>


      </div>
    </div>
  </div>
</section>
