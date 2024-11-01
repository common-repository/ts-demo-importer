<?php
/**
 * Template part for displaying our features
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_features_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
    $img_bg = get_theme_mod( 'ts_demo_importer_features_bgimage_setting' );
  if( get_theme_mod('ts_demo_importer_features_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_features_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_features_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_features_bgimage')).'\')';
  }else{
    $about_backg='';
  }



?>
<section id="business_features" class="<?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="owl-carousel">
      <?php
      $feature_no=get_theme_mod('ts_demo_importer_features_number');
      for($i=1;$i<=$feature_no;$i++)
      {
      ?>
        <div class="" data-aos="zoom-in-down" data-aos-duration="2000">
          <div class="features_box media position-relative">
            <?php if(get_theme_mod('ts_demo_importer_features_icon'.$i)!=''){ ?>
              <div class="i_block">
                <i class="pr-2 d-flex align-self-center <?php echo esc_attr(get_theme_mod('ts_demo_importer_features_icon'.$i)); ?>"></i>
              </div>
            <?php } ?>
            <div class="media-body">
              <?php if(get_theme_mod('ts_demo_importer_features_title'.$i)!=''){ ?>
              <h5>
                <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_features_url'.$i)); ?>">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_features_title'.$i)); ?>
                </a>
              </h5>
            <?php } if(get_theme_mod('ts_demo_importer_features_title2'.$i)!=''){ ?>
              <div class="features_p">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_features_title2'.$i)); ?>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
