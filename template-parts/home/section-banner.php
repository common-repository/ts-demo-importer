<?php
/**
 * The Template for displaying Our Blogs.
 *
 * @package ts-demo-importer
 */
$about_section = get_theme_mod( 'ts_demo_importer_banner_enable' );
if ( 'Disable' == $about_section ) {
  return;
}
/*banner*/
if( get_theme_mod('ts_demo_importer_banner_bgcolor') ) {
  $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_banner_bgcolor')).';';
}elseif( get_theme_mod('ts_demo_importer_banner_bgimage') ){
  $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_banner_bgimage')).'\')';
}else{
  $about_backg = '';
}

$img_bg =  get_theme_mod('ts_demo_importer_banner_bgimage_attachment');

?>
<section id="banner" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?> ">
    <div class="row m-0">
      <div class="col-md-6">
      </div>
      <div class="col-md-6 banner_content">
        <div class="banner-head section_main_head pb-4 white_head" data-aos="zoom-in-down" data-aos-duration="2000">
          <?php if(get_theme_mod('ts_demo_importer_banner_head')!=''){ ?>
            <small>
              <span class="heading_border_style white_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_banner_head')); ?>
            </small>
          <?php } if(get_theme_mod('ts_demo_importer_banner_head2')!=''){ ?>
            <h3>
              <?php echo get_theme_mod('ts_demo_importer_banner_head2'); ?>
            </h3>
          <?php } ?>

          <?php if(get_theme_mod('ts_demo_importer_banner_text')!=''){ ?>
            <div class="section_text">
              <?php echo get_theme_mod('ts_demo_importer_banner_text'); ?>
            </div>
          <?php } ?>
        </div>

        <?php if( get_theme_mod('ts_demo_importer_banner_button_read_more') != ''){ ?>
          <div class="custom_btn" data-aos="zoom-in-down" data-aos-duration="2000">
            <a class="theme_white_btn" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_banner_button_read_more_url')); ?>">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_banner_button_read_more')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_banner_button_read_more_icon')); ?>"></i>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
</section>
