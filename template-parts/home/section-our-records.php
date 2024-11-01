<?php
/**
 * Template part for displaying our records
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_records_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $our_records_bg = get_theme_mod('ts_demo_importer_our_records_bgimage_setting');
  
  if( get_theme_mod('ts_demo_importer_our_records_bgcolor','') ) {
    $our_records_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_records_bgcolor','')).'!important;';
  }elseif( get_theme_mod('ts_demo_importer_our_records_bgimage','') ){
    $our_records_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_records_bgimage')).'\')';
  }else{
    $our_records_backg='';
  }

  if( get_theme_mod('ts_demo_importer_our_records_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_our_records_carousel_nav', false) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_records_carousel_loop', true) ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_records_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_our_records_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-3 col-md-4 col-sm-6 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }

?>
<section id="our-records" style="<?php echo esc_attr($our_records_backg); ?>"
                          class="<?php echo esc_attr($our_records_bg); ?>"
                          data-loops="<?php echo esc_html($carousel_loop); ?>"
                          data-speed="<?php echo esc_html($carousel_speed); ?>"
                          data-dots="<?php echo esc_html($carousel_dots); ?>"
                          data-nav="<?php echo esc_html($carousel_nav); ?>">
  <!-- <div class="record_overlay"></div> -->
  <div class="container">

    <div class="<?php echo esc_attr($amp_row); ?>">
      <?php
      $records_no=get_theme_mod('ts_demo_importer_our_records_number');
      for($i=1;$i<=$records_no;$i++)
      {
      ?>
        <div class="records-info <?php echo esc_attr($amp_class); ?>" data-aos="zoom-in-down" data-aos-duration="2000">
          <div class="media">
            <div class="media-body">
              <?php if(get_theme_mod('ts_demo_importer_our_records_no'.$i)!=''){ ?>
                <span class="multi-advance-count">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_no'.$i)); ?>
                </span>
              <?php } if(get_theme_mod('ts_demo_importer_our_records_title'.$i)!=''){ ?>
                <h6>
                  <?php if( get_theme_mod('ts_demo_importer_our_records_url'.$i) ) { ?>
                    <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_url'.$i)); ?>">
                  <?php } ?>
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_title'.$i)); ?>

                  <?php if( get_theme_mod('ts_demo_importer_our_records_url'.$i) ) { ?>
                    </a>
                  <?php } ?>

                </h6>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
