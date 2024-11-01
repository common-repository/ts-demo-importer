<?php
/**
 * Template part for displaying our Hiring Features
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_hiring_features_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }

  $img_bg = get_theme_mod( 'ts_demo_importer_hiring_features_bgimage_setting' );
  
  if( get_theme_mod('ts_demo_importer_hiring_features_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_hiring_features_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_hiring_features_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_hiring_features_bgimage')).'\')';
  }else{
    $about_backg='';
  }



?>
<section id="business_hiring_features" class="<?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="row">
      <?php
      $feature_no=get_theme_mod('ts_demo_importer_hiring_features_number');
      for($i=1;$i<=$feature_no;$i++)
      {
      ?>
        <div class="col-md-4 col-sm-6 mb-4" data-aos="zoom-in-down" data-aos-duration="2000">
          <div class="hiring_features_box media position-relative">
            <?php if(get_theme_mod('ts_demo_importer_hiring_features_icon'.$i)!=''){ ?>
              <div class="i_block">
                <i class="pr-2 d-flex align-self-center <?php echo esc_attr(get_theme_mod('ts_demo_importer_hiring_features_icon'.$i)); ?>"></i>
              </div>
            <?php } ?>
            <div class="media-body">
              <?php if(get_theme_mod('ts_demo_importer_hiring_features_title'.$i)!=''){ ?>
              <h5>
                <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_features_url'.$i)); ?>">
                  <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_features_title'.$i)); ?>
                </a>
              </h5>
            <?php } if(get_theme_mod('ts_demo_importer_hiring_features_desc'.$i)!=''){ ?>
              <div class="hiring_features_p">
                <?php echo get_theme_mod('ts_demo_importer_hiring_features_desc'.$i); ?>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
