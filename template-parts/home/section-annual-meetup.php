<?php
/**
 *   The Template for displaying Upcoming Events
 */
  $section_hide = get_theme_mod( 'ts_demo_importer_annual_meetup_enabledisable', 'Enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  if( get_theme_mod('ts_demo_importer_annual_meetup_background_color','') ) {
    $annual_background_setting = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_annual_meetup_background_color','')).';';
  }elseif( get_theme_mod('ts_demo_importer_annual_meetup_bgimage','') ){
      $annual_background_setting = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_annual_meetup_bgimage')).'\')';
  }

  if( get_theme_mod('ts_demo_importer_annual_meetup_bgimage_att','fixed') ) {
    $annual_background_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_annual_meetup_bgimage_att','')).';';
  }else {
    $annual_background_att = '';
  }

  $post_excerpt="";
  if(get_theme_mod('ts_demo_importer_annual_meetup_post_excerpt_no', '20')){
    $post_excerpt=get_theme_mod('ts_demo_importer_annual_meetup_post_excerpt_no', '20');
  }

?>
<section id="annual-meetup">
  <div class="section-title text-center">
    <?php if(get_theme_mod('ts_demo_importer_annual_event_title') != ''){?>
      <h2 class="anuual-event-title mt-2"><?php echo esc_html(get_theme_mod('ts_demo_importer_annual_event_title')); ?></h2>
    <?php } ?>
    <?php if (get_theme_mod('ts_demo_importer_annual_event_paragraph') !=''){?>
      <p class="annual-event-main-text"><?php echo esc_html(get_theme_mod('ts_demo_importer_annual_event_paragraph')); ?></p>
    <?php } ?>
  </div>
  <div class="annual-content-container" style="<?php echo esc_attr($annual_background_setting .';'. $annual_background_att); ?>">
    <div class="container" data-aos="fade-up" data-aos-duration="2000">
      <div class="row align-items-center py-5">
        <?php
        $args = array(
          'post_type' => 'event_listing',
          'post_status' => 'publish',
          'posts_per_page' => '1'
        );
        $query = new WP_Query($args);
          if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
         ?>
          <div class="col-lg-6 col-md-6 pt-3 pb-3 text-md-start text-center" data-aos="slide-right" data-aos-duration="2000">
             <h2 class="anuual-event-title mt-2">
               <?php echo get_the_title(); ?>
             </h2>
             <p class="annual-event-text">
               <?php $excerpt = get_the_content(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$post_excerpt)); ?>
             </p>
          </div>
          <div class="col-lg-6 col-md-6 annual_meetup-boxes" data-aos="slide-left" data-aos-duration="2000">
            <div id="timer" class="countdown mt-3">
              <?php $dateday = get_post_meta($post->ID,'_event_registration_deadline',true);
                    $date=date_create($dateday);
                     $date_format = date_format($date,"F d, Y H:i:s");
                    ?>
                <input type="hidden" id="evetns-last-date" class="date" value="<?php echo esc_html($date_format); ?>">
            </div>

            <div class="d-flex flex-wrap align-items-center mt-4">
              <div class="">
                <p class="mb-0 events-start-date">
                  <?php if(get_post_meta($post->ID,'_event_start_date',true)) {
                    $date=date_create(get_post_meta($post->ID,'_event_start_date',true));
                    echo date_format($date,"M d, Y"); ?>
                  <?php } ?>
                </p>
                <p class="mb-0 events-start-time">
                  <?php
                      $date = get_post_meta($post->ID,'_event_start_date',true);
                      $newDate = date('l', strtotime($date));
                      echo $newDate;
                   ?>

                  <?php if (get_post_meta($post->ID,'_event_start_time',true)){
                      $date = get_post_meta($post->ID,'_event_start_time',true);
                      echo date('h:i a', strtotime($date));
                   } ?>
               </p>
              </div>
              <a class="events-register-btn" href="<?php the_permalink(); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_annual_event_register_btn', 'Register Now')); ?>
              </a>
            </div>

          </div>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>


</section>
