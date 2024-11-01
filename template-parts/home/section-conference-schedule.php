<?php
/**
 *   The Template for displaying Upcoming Events
 */
  $section_hide = get_theme_mod( 'ts_demo_importer_conferernce_schedule_enabledisable', 'Enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  if( get_theme_mod('ts_demo_importer_conferernce_schedule_background_color','') ) {
    $annual_background_setting = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_conferernce_schedule_background_color','')).';';
  }elseif( get_theme_mod('ts_demo_importer_conferernce_schedule_bgimage','') ){
      $annual_background_setting = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_conferernce_schedule_bgimage')).'\')';
  }

  if( get_theme_mod('ts_demo_importer_conferernce_schedule_bgimage_att','fixed') ) {
    $annual_background_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_conferernce_schedule_bgimage_att','')).';';
  }else {
    $annual_background_att = '';
  }

?>
<section id="conference-schedule">
  <div class="section-titles pb-5 text-center">
    <?php if (get_theme_mod('ts_demo_importer_conferernce_schedule_small_heading') != '') { ?>
      <h6 class="section-small-heading m-auto">
        <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_small_heading')); ?>
      </h6>
    <?php } ?>

    <?php if (get_theme_mod('ts_demo_importer_conferernce_schedule_main_heading') != '') { ?>
      <h2 class="section-main-heading">
        <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_main_heading')); ?>
      </h2>
    <?php } ?>
  </div>

  <div class="container">
    <div class="conference-schedule-main-box">
      <?php $query = new WP_Query( array(
        'post_type' => 'tribe_events',
        'posts_per_page' => '1'
        )
      );
       if ( $query->have_posts() ){
         while ($query->have_posts()) :
           $query->the_post(); ?>
           <div class="conference-title-box">
              <h3 class="post-title text-center">
                <?php
                if (get_post_meta($post->ID,'_EventStartDate',true)){ ?>
                  <span class="events-start-date">
                    <?php $date = get_post_meta($post->ID,'_EventStartDate',true);
                    $newDate = date("d M :", strtotime($date));
                    echo $newDate;
                    ?>
                  </span>
                  <?php }
                 echo get_the_title(); ?>
              </h3>
              <div class="d-flex flex-lg-nowrap flex-wrap justify-lg-content-between justify-content-center text-lg-start text-center px-lg-4 px-2 py-2">
                <p class="mb-0">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_venue_text'));
                    if (get_post_meta($post->ID,'_EventVenueID',true)){
                      $venue_post_id = get_post_meta($post->ID,'_EventVenueID',true);
                      $venue_args = array("post_type" => "mytype");
                      echo " : " . esc_html(get_post( $venue_post_id )->post_title);
                     }
                  ?>
                </p>
                <p class="mb-0">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_note_text')); ?>
                </p>
              </div>
            </div>
            <div class="conference-propogenda-steps">
              <ul>
                <?php
                $propognda_number = get_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_no');
                for ($i=1; $i <=$propognda_number ; $i++) { ?>
                  <li>
                    <p class="mb-0">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_time'.$i)); ?>
                    </p>
                    <h4 class="propogenda-heading mt-0 pt-0">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_heading'.$i)); ?>
                    </h4>
                  </li>
                <?php } ?>
              </ul>
            </div>

         <?php endwhile; } wp_reset_query(); ?>
    </div>
  </div>
</section>
