<?php

/**
 * The Template for displaying Team
 *
 * @package ts-demo-importer
 */

    $section_hide = get_theme_mod( 'ts_demo_importer_radio_team_enable' );
    if ( 'Disable' == $section_hide ) {
      return;
    }
    if( get_theme_mod('ts_demo_importer_team_bgcolor','') ) {
      $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_team_bgcolor','')).';';
    }elseif( get_theme_mod('ts_demo_importer_our_team_bgimage','') ){
      $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_team_bgimage')).'\')';
    }else{
      $about_backg= '';
    }

    if( get_theme_mod('ts_demo_importer_our_team_carousel_loop', true) ) { $carousel_loop = 'true'; }
    else{ $carousel_loop = 'false'; }

    if( get_theme_mod('ts_demo_importer_our_team_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_our_team_carousel_speed'); }
    else{ $carousel_speed = 3000; }

    $img_bg = get_theme_mod( 'ts_demo_importer_our_team_bgimage_attachment' );

    $template = wp_get_theme()->get( 'TextDomain' );
?>
<section id="team" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>" data-loops="<?php echo esc_html($carousel_loop); ?>" data-speed="<?php echo esc_html($carousel_speed); ?>">
  <div class="container">
    <?php if ( defined( 'TS_DEMO_IMPOTER_POSTTYPE' ) ) { ?>
      <?php if ($template == 'ts-conference'){ ?>
        <div class="section-titles py-5 text-center">
          <?php if (get_theme_mod('ts_demo_importer_our_team_small_heading') != '') { ?>
            <h6 class="section-small-heading m-auto">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_our_team_small_heading')); ?>
            </h6>
          <?php } ?>

          <?php if (get_theme_mod('ts_demo_importer_our_team_main_heading') != '') { ?>
            <h2 class="section-main-heading">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_our_team_main_heading')); ?>
            </h2>
          <?php } ?>
        </div>

        <div class="row justify-content-center">
          <?php
            $args = array(
              'post_type' => 'team',
              'post_status' => 'publish',
              'posts_per_page' => '3'
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
              <div class="team-main-box position-relative">
                <?php if(has_post_thumbnail()){ ?>
                  <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                <?php } ?>
                <div class="team-content position-absolute w-100 bottom-0 text-lg-start text-center">
                  <?php if(get_post_meta(get_the_ID(),'meta-designation',true)!=''){ ?>
                    <span class="team-designation">
                      <?php echo esc_html(get_post_meta(get_the_ID(),'meta-designation',true)); ?>
                    </span>
                  <?php } ?>
                  <h3 class="section-post-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                      <?php echo get_the_title(); ?>
                    </a>
                  </h3>

                  <div class="team_social">
                    <?php if(get_post_meta(get_the_ID(),'meta-tfacebookurl',true)){ ?>
                      <a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-tfacebookurl',true)); ?>" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    <?php } ?>
                    <?php if(get_post_meta(get_the_ID(),'meta-ttwitterurl',true)){ ?>
                      <a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-ttwitterurl',true)); ?>" target="_blank">
                        <i class="fab fa-twitter"></i>
                      </a>
                    <?php } ?>
                    <?php if(get_post_meta(get_the_ID(),'meta-tinstagram',true)){ ?>
                      <a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-tinstagram',true)); ?>" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    <?php } ?>
                  </div>

                </div>
              </div>
            </div>
            <?php endwhile; endif; ?>
          </div>
        <?php if(get_theme_mod('ts_demo_importer_our_team_see_all_speaker_btn')!=''){ ?>
          <a class="section-btn" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_our_team_see_all_speaker_btn_url')); ?>">
            <?php echo (get_theme_mod('ts_demo_importer_our_team_see_all_speaker_btn')); ?>
          </a>
        <?php } ?>

      <?php }else { ?>
        <div class="row">
          <?php
            $args = array(
              'post_type' => 'team',
              'post_status' => 'publish',
              'posts_per_page' => -1
            );
            $query = new WP_Query($args);

            $i =1;

            if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
            if($i <= 6 ){
          ?>
            <div class="instructors-details col-lg-3 col-md-6 mb-4 column<?php echo $i; ?>" data-aos="zoom-in-down" data-aos-duration="2000">
              <div class="team_auther box">
                <div class="team_images">
                  <?php the_post_thumbnail() ?>
                  <div class="team-sec">
                    <div class="team-box"><h5 class="team_head">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                      <?php if(get_post_meta(get_the_ID(),'meta-designation',true)!=''){ ?>
                        <span><?php echo esc_html(get_post_meta(get_the_ID(),'meta-designation',true)); ?></span>
                      <?php } ?>
                    </div>
                    <div class="team_social">
                      <?php if(get_post_meta(get_the_ID(),'meta-tfacebookurl',true)){?><a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-tfacebookurl',true)); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                      <?php }?>
                      <?php if(get_post_meta(get_the_ID(),'meta-ttwitterurl',true)){?><a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-ttwitterurl',true)); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                      <?php }?>
                      <?php if(get_post_meta(get_the_ID(),'meta-tlinkdenurl',true)){?><a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-tlinkdenurl',true)); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                      <?php }?>
                      <?php if(get_post_meta(get_the_ID(),'meta-tinstagram',true)){?><a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-tinstagram',true)); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                      <?php }?>
                      <?php if(get_post_meta(get_the_ID(),'meta-pinterest',true)){?><a class="" href="<?php echo esc_html(get_post_meta(get_the_ID(),'meta-pinterest',true)); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php $i++; endwhile; endif; ?>
          <div class="col-lg-6 col-md-12">
            <div class="section_main_head text-left pt-3 black_head" data-aos="fade-up" data-aos-duration="2000">
              <?php if(get_theme_mod('ts_demo_importer_team_sec_title')!=''){ ?>
                <small>
                  <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_team_sec_title')); ?>
                </small>
              <?php } if(get_theme_mod('ts_demo_importer_team_sec_main_title')!=''){ ?>
                <h3>
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_team_sec_main_title')); ?>
                </h3>
              <?php } ?>
              <?php if(get_theme_mod('ts_demo_importer_team_sec_subtitle')!=''){ ?>
                <div class="section_text">
                  <?php echo get_theme_mod('ts_demo_importer_team_sec_subtitle'); ?>
                </div>
              <?php } ?>

              <?php if( get_theme_mod('ts_demo_importer_team_sec_button_read_more') != ''){ ?>
                <div class="custom_btn mt-3" data-aos="zoom-in-down" data-aos-duration="2000">
                  <a class="theme_button2" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_team_sec_button_read_more_url')); ?>">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_team_sec_button_read_more')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_team_sec_button_read_more_icon')); ?>"></i>
                  </a>
                </div>
              <?php } ?>

            </div>
          </div>

        </div>
    <?php } ?>
    <?php } else{ ?>
    <h3 class="post-type-msg text-center"><?php esc_html_e('Upload And Activate TS Demo Importer Posttype Plugin To Display Your Projects Details','ts-demo-importer')?></h3>
  <?php }?>


  </div>
</section>
