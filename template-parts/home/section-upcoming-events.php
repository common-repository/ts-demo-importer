<?php
/**
 *   The Template for displaying Upcoming Events
 */
  $section_hide = get_theme_mod( 'ts_demo_importer_upcoming_events_enabledisable', 'Enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  $post_categories = get_theme_mod( 'ts_demo_importer_upcoming_events_names', array() );

  $ue_img_bg = get_theme_mod('ts_demo_importer_upcoming_events_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_upcoming_events_background_color','') ) {
    $ue_background_setting = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_upcoming_events_background_color','')).';';
  }elseif( get_theme_mod('ts_demo_importer_upcoming_events_bgimage','') ){
      $ue_background_setting = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_upcoming_events_bgimage')).'\')';
  }else {
    $ue_background_setting = '';
  }
?>
<section id="upcoming-events" style="<?php echo esc_attr($ue_background_setting); ?> "
                              class="<?php echo esc_attr($ue_img_bg); ?>">
<?php if ( $template == 'advance-training-academy'){ ?>
  <div class="container">
    <div class="d-flex align-items-center">
      <div class="section-title text-md-start text-center">
         <?php if(get_theme_mod('ts_demo_importer_upcoming_events_title') != ''){?>
           <h2 class="upcoming-event-title mt-2"><?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_title')); ?></h2>
         <?php } ?>
         <?php if (get_theme_mod('ts_demo_importer_upcoming_events_paragraph') !=''){?>
            <p class="upcoming-event-text"><?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_paragraph')); ?></p>
         <?php } ?>
      </div>
      <?php if (get_theme_mod('ts_demo_importer_upcoming_events_view_all_btn') !='') {?>
        <a class="upcoming-view-all-btn" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_view_all_btn_url')); ?>">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_view_all_btn')); ?>
        </a>
      <?php } ?>
    </div>

    <div class="row align-items-center mt-5">
      <div class="col-lg-6" data-aos="zoom-in-down" data-aos-duration="2000">
        <?php
        $query = new WP_Query( array(
          'post_type' => 'event_listing',
          'posts_per_page' =>get_theme_mod('ts_demo_importer_event_listing_number',  '4')
          )
        ); ?>
        <div class="slider-for">
          <?php if ( $query->have_posts() ){
            while ($query->have_posts()) :
              $query->the_post(); ?>
              <div class="position-relative">
                <?php the_post_thumbnail(); ?>
                <div class="upcoming-left-content position-absolute">
                  <h3>                    
                      <?php echo get_the_title(); ?>
                  </h3>
                  <p class="events-meta mb-0 d-flex align-items-center justify-content-around">
                    <span>
                      <?php if(get_post_meta($post->ID,'_event_start_date',true)) {
                        $date=date_create(get_post_meta($post->ID,'_event_start_date',true));
                        echo date_format($date,"M d, Y"); ?>
                      <?php } ?>
                    </span>

                    <span>
                      <?php if (get_post_meta($post->ID,'_event_start_time',true)){
                        $date = get_post_meta($post->ID,'_event_start_time',true);
                        echo date('h:i a', strtotime($date));
                      } ?>
                    </span>

                    <span>
                      <?php if (get_post_meta($post->ID,'_event_location',true)){
                        echo esc_html(get_post_meta($post->ID,'_event_location',true));
                      } ?>
                    </span>
                  </p>
                </div>
              </div>


            <?php endwhile;
           }else {
            echo "<h4> No Post Found </h4>";
           } ?>
        </div>
      </div>
      <div class="col-lg-6" data-aos="zoom-in-up" data-aos-duration="2000">
        <?php
        $query = new WP_Query( array(
          'post_type' => 'event_listing',
          'posts_per_page' =>get_theme_mod('ts_demo_importer_event_listing_number',  '4'))
        ); ?>
        <div class="slider-nav">
          <?php if ( $query->have_posts() ){
            while ($query->have_posts()) :
              $query->the_post(); ?>
              <div class="d-flex align-items-center upcoming-right-content">
                <div class="col-4">
                  <?php the_post_thumbnail(); ?>
                </div>
                <div class="col-8 ps-3">
                  <h5>
                   
                    <?php echo get_the_title(); ?>
                  </h5>
                  <p class="events-meta mb-0 d-flex align-items-center justify-content-between">
                    <span>
                      <?php if(get_post_meta($post->ID,'_event_start_date',true)) {
                        $date=date_create(get_post_meta($post->ID,'_event_start_date',true));
                        echo date_format($date,"M d, Y"); ?>
                      <?php } ?>
                    </span>

                    <span>
                      <?php if (get_post_meta($post->ID,'_event_start_time',true)){
                        $date = get_post_meta($post->ID,'_event_start_time',true);
                        echo date('h:i a', strtotime($date));
                      } ?>
                    </span>

                    <span>
                      <?php if (get_post_meta($post->ID,'_event_location',true)){
                        echo esc_html(get_post_meta($post->ID,'_event_location',true));
                      } ?>
                    </span>
                  </p>
                </div>
              </div>

            <?php endwhile; wp_reset_query();
           }else {
            echo "<h4> No Post Found </h4>";
           } ?>
       </div>
      </div>
    </div>


  </div>
<?php }elseif($template == 'ts-conference'){ ?>
  <div class="container">
    <div class="section-titles pb-5 text-center">
      <?php if (get_theme_mod('ts_demo_importer_upcoming_events_small_heading') != '') { ?>
        <h6 class="section-small-heading m-auto">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_small_heading')); ?>
        </h6>
      <?php } ?>

      <?php if (get_theme_mod('ts_demo_importer_upcoming_events_main_heading') != '') { ?>
        <h2 class="section-main-heading">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_main_heading')); ?>
        </h2>
      <?php } ?>
    </div>
    <?php
    $query = new WP_Query( array(
      'post_type' => 'tribe_events',
      'posts_per_page' =>get_theme_mod('ts_demo_importer_upcoming_events_number')
      )
    ); ?>

    <div class="owl-carousel">
      <?php if ( $query->have_posts() ){
      while ($query->have_posts()) :
        $query->the_post(); ?>
          <div class="position-relative upcoming-events-main-box">
            <?php if(has_post_thumbnail()){ ?>
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
            <?php } ?>

            <div class="upcoming-events-content position-absolute bottom-0">
              <h3 class="section-post-title">
                <?php echo get_the_title(); ?>
              </h3>
              <p class="section-para">
                <?php echo get_the_content(); ?>
              </p>
              <div class="d-flex align-items-center upcoming-events-meta">
                <?php if (get_post_meta($post->ID,'_EventStartDate',true)){ ?>
                  <span class="events-start-date">
                    <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_date_icon')); ?>"></i>
                    <?php echo esc_html(get_post_meta($post->ID,'_EventStartDate',true)); ?>
                  </span>
                <?php } ?>

                <?php if (get_post_meta($post->ID,'_EventVenueID',true)){ ?>
                  <span class="event-location">
                    <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_location_icon')); ?>"></i>
                  <?php $venue_post_id = get_post_meta($post->ID,'_EventVenueID',true);
                  $venue_args = array("post_type" => "mytype");
                  echo esc_html(get_post( $venue_post_id )->post_title); ?>
                </span>
                <?php } ?>
              </div>
              <a class="read-more-btn" href="<?php echo get_the_permalink(); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_upcoming_events_read_more_btn')); ?>
              </a>
            </div>

          </div>
        <?php endwhile; } wp_reset_query(); ?>
    </div>
  </div>

  <?php
    if( get_theme_mod('ts_demo_importer_upcoming_events_register_space_background_color','') ) {
      $register_bg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_upcoming_events_register_space_background_color','')).';';
    }elseif( get_theme_mod('ts_demo_importer_upcoming_events_register_space_bgimage','') ){
        $register_bg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_upcoming_events_register_space_bgimage')).'\')';
    }else {
      $register_bg = '';
    }
   ?>

  <div class="resigter-space text-center" style="<?php echo $register_bg; ?>">
    <?php if(get_theme_mod('ts_demo_importer_upcoming_events_register_space_heading')!=''){ ?>
      <h3 class="section-main-heading">
        <?php echo (get_theme_mod('ts_demo_importer_upcoming_events_register_space_heading')); ?>
      </h3>
    <?php } ?>

    <?php if(get_theme_mod('ts_demo_importer_upcoming_events_register_space_para')!=''){ ?>
      <p class="section-para">
        <?php echo (get_theme_mod('ts_demo_importer_upcoming_events_register_space_para')); ?>
      </p>
    <?php } ?>

    <?php if(get_theme_mod('ts_demo_importer_upcoming_events_book_now_btn')!=''){ ?>
      <a class="section-btn" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_upcoming_events_book_now_btn_url')); ?>">
        <?php echo (get_theme_mod('ts_demo_importer_upcoming_events_book_now_btn')); ?>
      </a>
    <?php } ?>

  </div>

<?php }else{ ?>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center small-heading">
        <?php if(get_theme_mod('ts_demo_importer_upcoming_events_small_heading')!=''){ ?>
          <small>
            <span class="heading_border_style_l white_style"></span>
              <?php echo (get_theme_mod('ts_demo_importer_upcoming_events_small_heading')); ?>
            <span class="heading_border_style_r white_style"></span>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_upcoming_events_main_heading')!=''){ ?>
          <h3 class="main-heading">
            <?php echo (get_theme_mod('ts_demo_importer_upcoming_events_main_heading')); ?>
          </h3>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="latest-tabs">
          <div class="ue-tab-menu">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <?php $all_featured_shows_cats  = get_theme_mod( 'ts_demo_importer_upcoming_eventscategory_names', array() ); ?>
              <?php foreach ( $all_featured_shows_cats as $all_featured_shows_cat_key => $all_featured_shows_cat_value ): ?>
                <li class="nav-item" role="presentation">
                 <button
                     class="nav-link <?php if($all_featured_shows_cat_key==0){ echo 'active'; } ?> "
                     id="pills-<?php echo esc_attr($all_featured_shows_cat_key);?>-tab"
                     data-bs-toggle="pill"
                     data-bs-target="#pills-<?php echo esc_attr($all_featured_shows_cat_key);?>"
                     type="button"
                     role="tab"
                     aria-controls="pills-<?php echo esc_attr($all_featured_shows_cat_key);?>"
                     aria-selected="<?php if($all_featured_shows_cat_key==0){ echo 'true'; } ?>">
                     <?php
                        $term = get_term_by('slug', $all_featured_shows_cat_value, 'eventscategory' );
                        if ($term) {
                          $name = $term->name;
                          echo esc_html( $name );
                        }
                        ?>
                 </button>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="tab-content" id="pills-tabContent">
              <?php foreach ( $all_featured_shows_cats as $all_featured_shows_cat_key => $all_featured_shows_cat_value ): ?>
                <?php
                $args = array(
                      'posts_per_page' => 3,
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'eventscategory',
                          'field'    => 'slug',
                          'terms'    => $all_featured_shows_cat_value
                        ),
                      ),
                      'post_type' => 'events',
                    );
                  $query = new WP_Query($args);
                     $term = get_term_by('slug', $all_featured_shows_cat_value, 'eventscategory' ); ?>
                     <?php if ($term) {
                         $name = $term->name;
                         $description = $term->description;
                         $id = get_term_meta($term->term_id, 'eventscategory-image-id');
                         $post_thumbnail_img = wp_get_attachment_image_src( $id[0], 'full');
                       } ?>
                  <div class="tab-pane fade <?php if($all_featured_shows_cat_key==0){ echo 'active show'; } ?>" id="pills-<?php echo esc_attr($all_featured_shows_cat_key); ?>" role="tabpanel" aria-labelledby="pills-<?php echo esc_attr($all_featured_shows_cat_key); ?>-tab">
                    <div class="row d-flex align-items-center">
                      <div class="col-lg-4 col-md-12 col-sm-12 tab-content-left">
                        <img class="upcoming-event-cat-img" src="<?php echo esc_html($post_thumbnail_img[0]); ?>">
                      </div>
                      <div class="my-auto col-lg-8 col-md-12 col-sm-12 tab-content-right">
                        <div class="card">
                        <div class="card-body">
                        <h3 class="upcoming-event-title">
                          <?php echo esc_html( $name ); ?>
                        </h3>
                        <p class="upcoming-event-con">
                          <?php echo $description ?>
                        </p>
                        <?php if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post(); ?>
                          <div class="event-btm-border">
                            <p class="event-name">
                              <?php echo the_title();  ?>
                            </p>
                            <i class="time-icon <?php echo get_theme_mod('ts_demo_importer_upcoming_events_tab_time_icon','fas fa-clock'); ?>">
                            </i>
                            <?php if(get_post_meta($post->ID,'ts_demo_importer_event_time',true)!= ''){ ?>
                              <span class="text-center time-text">
                                <?php echo esc_html(get_post_meta($post->ID,'ts_demo_importer_event_time',true)); ?>
                              </span>
                            <?php }?>
                            <i class="loc-icon <?php echo get_theme_mod('ts_demo_importer_upcoming_events_tab_location_icon','fa fa-map-marker'); ?>" aria-hidden="true">
                            </i>
                            <?php if(get_post_meta($post->ID,'ts_demo_importer_event_location',true)!= ''){ ?>
                              <span class="text-center loc-text">
                                <?php echo esc_html(get_post_meta($post->ID,'ts_demo_importer_event_location',true)); ?>
                              </span>
                            <?php }?>
                            </div>
                          <?php endwhile; endif;?>
                          <?php wp_reset_query(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

</section>
