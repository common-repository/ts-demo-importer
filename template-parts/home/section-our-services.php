<?php
/**
 * Template part for displaying our services
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_services_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  $img_bg = get_theme_mod('ts_demo_importer_our_services_settings');
  if( get_theme_mod('ts_demo_importer_our_services_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_services_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_services_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_services_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  if( get_theme_mod('ts_demo_importer_our_services_carousel_loop') ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_services_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_our_services_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_our_services_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_our_services_carousel_nav', true) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-3 col-md-6 col-sm-6 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }

?>
<section id="our-services" style="<?php echo esc_attr($about_backg); ?>"
                           class="<?php echo esc_attr($img_bg); ?>"
                           data-loops="<?php echo esc_html($carousel_loop); ?>"
                           data-speed="<?php echo esc_html($carousel_speed); ?>"
                           data-dots="<?php echo esc_html($carousel_dots); ?>"
                           data-nav="<?php echo esc_html($carousel_nav); ?>">

  <?php if($template == 'advance-training-academy' ) { ?>
    <div class="container">
      <div class="service-main-box">
        <div class="owl-carousel">
          <?php
          $query = new WP_Query( array(
          'post_type' => 'services',
          'posts_per_page' =>get_theme_mod('ts_demo_importer_our_services_number')) );

          if ( $query->have_posts() ){
          while ($query->have_posts()) :
            $query->the_post(); ?>
              <div class="service-boxx">
                <div class="our-services py-5 px-4">
                  <?php if (has_post_thumbnail()){ ?>
                    <div class="pic servicesbox">
                      <?php the_post_thumbnail(); ?>
                      <div class="servicess-inner-box">
                        <div class="image-title mt-3">
                          <h3 class="servicestitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                          <div class="servicesbox-content">
                            <p>
                              <?php echo get_the_content(); ?>
                            </p>
                          </div>
                          <?php if(get_post_meta($post->ID,'service-read-more-btn',true)){?>
                          <div class="service-button">
                            <a href="<?php the_permalink(); ?>">
                              <?php echo esc_html(get_post_meta($post->ID,'service-read-more-btn',true)); ?>
                            </a>
                          </div>
                          <?php }?>
                        </div>

                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <?php endwhile; ?>
            <?php }else {
              echo "<h4> No Post Found </h4>";
            } ?>
          </div>
        </div>
      </div>
    </div>
  <?php }elseif($template == 'ts-conference' ){ ?>
    <div class="container">
      <div class="section-titles pb-lg-5 pb-4 mb-md-0 mb-5 text-center">
        <?php if (get_theme_mod('ts_demo_importer_our_services_small_heading') != '') { ?>
          <h6 class="section-small-heading m-auto">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_services_small_heading')); ?>
          </h6>
        <?php } ?>

        <?php if (get_theme_mod('ts_demo_importer_our_services_main_heading') != '') { ?>
          <h2 class="section-main-heading">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_services_main_heading')); ?>
          </h2>
        <?php } ?>
      </div>

      <div class="services-main-box position-relative">
        <?php
        $args = array(
          'post_type' => 'services',
          'post_status' => 'publish',
          'posts_per_page' => get_theme_mod('ts_demo_importer_our_services_number')
        );
        $query = new WP_Query($args);
        ?>
        <div class="tab-content" id="nav-tabContent">
          <?php $i=1; if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post(); ?>
            <div class="tab-pane fade <?php if ($i==1) { echo "show active"; } ?>" id="nav-<?php echo $i; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $i; ?>-tab">
              <div class="row">
                <div class="col-md-8 pe-lg-0 p-0 order-md-1 order-2">
                  <div class="services-content d-flex">
                    <h3 class="section-main-heading">
                      <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                      </a>
                    </h3>
                    <p class="section-para text-md-start text-center">
                      <?php echo get_the_content(); ?>
                    </p>
                  </div>
                </div>
                <div class="col-md-4 p-0 order-md-2 order-1">
                  <div class="position-relative">
                    <img class="w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                    <span class="right-service-tab-title position-absolute start-0">
                      <?php echo esc_html(get_post_meta($post->ID,'meta-short-title',true)); ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>

          <?php $i++; endwhile; endif; ?>
        </div>

        <div class="row position-absolute bottom-md-0 start-0 w-100 services-tab-row">
          <div class="col-lg-8 tab-column">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <?php $i=1; if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post(); ?>
                <button
                  class="nav-link <?php if ($i==1) { echo "active"; } ?>"
                  id="nav-<?php echo $i; ?>-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-<?php echo $i; ?>"
                  type="button" role="tab"
                  aria-controls="nav-<?php echo $i; ?>"
                  aria-selected="<?php if ($i==1) { echo "true"; } ?>">
                    <?php echo esc_html(get_post_meta($post->ID,'meta-short-title',true)); ?>
                </button>
              <?php $i++; endwhile; endif; ?>
            </div>
          </div>
          <div class="col-lg-4">

          </div>
        </div>
      </div>

    </div>
  <?php }else{ ?>
   <div class="container">
     <div class="services-head section_main_head text-center pt-3 pb-4 head_center black_head">
       <?php if(get_theme_mod('ts_demo_importer_our_services_small_heading')!=''){ ?>
         <small>
           <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_our_services_small_heading')); ?><span class="heading_border_style right_side"></span>
         </small>
       <?php } if(get_theme_mod('ts_demo_importer_our_services_main_heading')!=''){ ?>
         <h3>
           <?php echo esc_html(get_theme_mod('ts_demo_importer_our_services_main_heading')); ?>
         </h3>
       <?php } ?>
     </div>

     <?php if(defined('TS_DEMO_IMPOTER_POSTTYPE')){ ?>
       <div class="<?php echo esc_attr($amp_row); ?> services_row" data-aos="fade-up" data-aos-duration="2000">
         <?php
         $i=1;
         $args = array(
           'post_type' => 'services',
           'post_status' => 'publish',
           'posts_per_page' => get_theme_mod('ts_demo_importer_our_services_number')
         );
         $query = new WP_Query($args);
         if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
         ?>
           <div class="services-info text-center <?php echo esc_attr($amp_class); ?>" >
             <div class="service_title_box">
               <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
               <div class="image_box">
                 <?php the_post_thumbnail(); ?>
                 <div class="link_overlay"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_our_services_box_link_text')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_services_box_link_icon')); ?>"></i></a></div>
               </div>
               <div class="short_title">
                 <?php echo esc_html(get_post_meta($post->ID,'meta-short-title',true)); ?>
               </div>
             </div>
           </div>
         <?php $i++; endwhile; endif; ?>
       </div>
     <?php }else{ ?>
       <h5>
         <?php esc_html_e('Upload And Activate TS Demo Importer Posttype Plugin To Display Your Services Details','ts-demo-importer'); ?>
       </h5>
     <?php } ?>
   </div>
 <?php }  ?>


</section>
