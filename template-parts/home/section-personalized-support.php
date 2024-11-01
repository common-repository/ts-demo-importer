<?php
/**
 *   The Template for displaying Personalized Support
 */
  $section_hide = get_theme_mod( 'ts_demo_importer_personalized_support_enabledisable', 'Enable' );

  $post_categories = get_theme_mod( 'ts_demo_importer_personalized_support_names', array() );

  if ( 'Disable' == $section_hide ) {
    return;
  }
  if( get_theme_mod('ts_demo_importer_personalized_support_background_color','') ) {
    $background_setting = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_personalized_support_background_color','')).';';
  }elseif( get_theme_mod('ts_demo_importer_personalized_support_bgimage','') ){
    $background_setting = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_personalized_support_bgimage')).'\'),url(\''.esc_url(get_theme_mod('ts_demo_importer_personalized_support_bgimage1')).'\')';
  }else {
    $background_setting = '';
  }

  if( get_theme_mod('ts_demo_importer_personalized_support_background_att','scroll') ) {
    $background_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_personalized_support_background_att','')).';';
  }else {
    $background_att = '';
  }


  $template = wp_get_theme()->get( 'TextDomain' );
?>

<?php if ( $template == 'advance-training-academy' ){ ?>
  <section id="Personalized-support" class="Personalized-support" style="<?php echo esc_attr($background_setting .';'. $background_att); ?>">
    <div class="container">
      <?php if(get_theme_mod('ts_demo_importer_counter_main_heading')!=''){ ?>
        <h3 class="counter-main-heading text-center">
          <?php echo get_theme_mod('ts_demo_importer_counter_main_heading'); ?>
        </h3>
      <?php } ?>

      <div class="owl-carousel mt-5">
        <?php
          $record_no=get_theme_mod('ts_demo_importer_our_records_number');
          for($i=1;$i<=$record_no;$i++){ ?>
            <div class="our-records-info text-center">
              <div class="counter recrd_inner">
                <div class="counter-right-contents">
                  <?php if(get_theme_mod('ts_demo_importer_our_records_no'.$i)!=''){ ?>
                    <span class="counter-value count_no">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_no'.$i)); ?>
                    </span>
                  <?php } if(get_theme_mod('ts_demo_importer_our_records_no_suffix'.$i)!=''){ ?>
                    <span class="counter_suffix p-0">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_no_suffix'.$i)); ?>
                    </span>
                  <?php } ?>
                </div>
              </div>
            <?php if(get_theme_mod('ts_demo_importer_our_records_title'.$i)!=''){ ?>
              <div class="record_title pb-2 mt-1">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_our_records_title'.$i)); ?>
              </div>
            <?php } ?>
            </div>
        <?php } ?>
      </div>
    </div>
  </section>
<?php }else{ ?>
  <section id="Personalized-support" style="<?php echo esc_attr($background_setting); ?>">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 col-md-12 col-sm-12 left-content animated fadeInLeft">
          <?php if(get_theme_mod('ts_demo_importer_personalized_support_left_small_heading')!=''){ ?>
          <p class="left-small-head">
            <span class="heading_border_style white_style"></span>
            <?php echo get_theme_mod('ts_demo_importer_personalized_support_left_small_heading'); ?>
          </p>
          <?php } if(get_theme_mod('ts_demo_importer_personalized_support_left_main_heading')!=''){ ?>
          <h4 class="left-main-head">
            <?php echo get_theme_mod('ts_demo_importer_personalized_support_left_main_heading'); ?>
          </h4>
          <?php } if(get_theme_mod('ts_demo_importer_personalized_support_left_para')!=''){ ?>
          <p class="left-para">
            <?php echo get_theme_mod('ts_demo_importer_personalized_support_left_para'); ?>
          </p>
          <?php } if(get_theme_mod('ts_demo_importer_personalized_support_button_get_a_guidebook')!=''){ ?>
          <a class="theme_button2 me-0" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_personalized_support_button_url')); ?>">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_personalized_support_button_get_a_guidebook')); ?>
            <?php if(get_theme_mod('ts_demo_importer_personalized_support_button_get_a_guidebook_icon')!=''){ ?>
            <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_personalized_support_button_get_a_guidebook_icon')); ?>"></i>
          <?php } ?>
          </a>
          <?php } ?>
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 animated fadeInRight">
          <div class="row justify-content-center right-box">
            <?php
            $record_no=get_theme_mod('ts_demo_importer_personalized_support_records_number');
            for($i=1;$i<=$record_no;$i++){ ?>
            <div  class="col-lg-5 col-md-5 col-sm-12 right-inner-box box-design">
              <div class="our-records-info text-center">
               <div class="counter recrd_inner">
                  <?php if(get_theme_mod('ts_demo_importer_personalized_support_records_no'.$i)!=''){ ?>
                    <span class="counter-value count_no">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_personalized_support_records_no'.$i)); ?>
                    </span>
                  <?php } if(get_theme_mod('ts_demo_importer_personalized_support_records_title'.$i)!=''){ ?>
                    <h6 class="record_title">
                        <?php echo esc_html(get_theme_mod('ts_demo_importer_personalized_support_records_title'.$i)); ?>
                    </h6>
                  <?php } ?>
                </div>
                <?php if(get_theme_mod('ts_demo_importer_personalized_support_records_para'.$i)!=''){ ?>
                  <div class="counter-para text-center">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_personalized_support_records_para'.$i)); ?>
                    </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
