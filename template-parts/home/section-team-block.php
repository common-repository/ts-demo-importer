<?php

/**
 * The Template for display Team block
 * @package ts-demo-importer
 */

    $section_hide = get_theme_mod( 'ts_demo_importer_radio_team_block_enable' );
    if ( 'Disable' == $section_hide ) {
      return;
    }

    $img_bg = get_theme_mod( 'ts_demo_importer_team_block_bgimage_attachment' );
    if( get_theme_mod('ts_demo_importer_team_block_bgcolor','') ) {
      $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_team_block_bgcolor','')).';';
    }elseif( get_theme_mod('ts_demo_importer_team_block_bgimage','') ){
      $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_team_block_bgimage')).'\')';
    }else{
      $about_backg= '';
    }

    if( get_theme_mod('ts_demo_importer_team_block_carousel_loop', true) ) { $carousel_loop = 'true'; }
    else{ $carousel_loop = 'false'; }

    if( get_theme_mod('ts_demo_importer_team_block_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_team_block_carousel_speed'); }
    else{ $carousel_speed = 3000; }


?>
<section id="team_block" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?> pt-0" data-loops="<?php echo esc_html($carousel_loop); ?>" data-speed="<?php echo esc_html($carousel_speed); ?>">
  <div class="container">

    <?php if ( defined( 'TS_DEMO_IMPOTER_POSTTYPE' ) ) { ?>
      <div class="row">
        <?php

          $args = array(
            'post_type'  => 'team',
            'post_status' => 'publish',
            'order' => 'ASC',
            'posts_per_page' => -1
          );
          $query = new WP_Query($args);

          $i =1;

          if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
          if($i <= 6 ){
        ?>

          <?php if($i == 5){ ?>
            <div class="col-lg-6 col-md-12 quote_section d-flex align-items-center position-relative mb-4">
              <div class="section_main_head text-left pt-3 black_head" data-aos="fade-up" data-aos-duration="2000">

                <?php if(get_theme_mod('ts_demo_importer_team_block_sec_main_title')!=''){ ?>
                  <h3 class="team-block-main-title">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_team_block_sec_main_title')); ?>
                  </h3>
                <?php } ?>

                <?php if(get_theme_mod('ts_demo_importer_team_block_quote_icon')!=''){ ?>
                  <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_team_block_quote_icon')); ?>"></i>
                <?php } ?>

              </div>
            </div>
          <?php }?>

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


      </div>
    <?php } else{ ?>
      <h3 class="post-type-msg text-center"><?php esc_html_e('Upload And Activate TS Demo Importer To Display Your Projects Details','ts-demo-importer')?></h3>
    <?php }?>
  </div>
</section>
