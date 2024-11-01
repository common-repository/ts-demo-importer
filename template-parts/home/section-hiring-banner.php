<?php
/**
 * The Template for displaying Hiring Banner.
 *
 * @package ts-demo-importer
 */
$about_section = get_theme_mod( 'ts_demo_importer_hiring_banner_enable' );
if ( 'Disable' == $about_section ) {
  return;
}

/*hiring_banner*/
$img_bg =  get_theme_mod('ts_demo_importer_hiring_banner_bgimage_attachment');
if( get_theme_mod('ts_demo_importer_hiring_banner_bgcolor') ) {
  $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_hiring_banner_bgcolor')).';';
}elseif( get_theme_mod('ts_demo_importer_hiring_banner_bgimage') ){
  $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_hiring_banner_bgimage')).'\')';
}else{
  $about_backg = '';
}

$overlay_backg = 'background-color : rgb(0 0 0 / ' .esc_attr(get_theme_mod('ts_demo_importer_hiring_banner_bgcolor_opacity')).') !important;';
?>
<section id="hiring_banner" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?> position-relative">
  <div class="hiring_overlay" style="<?php echo esc_attr($overlay_backg); ?>"></div>
  <div class="container">
    <div class="hiring_banner_content text-center">
      <div class="hiring_banner-head section_main_head white_head head_center" data-aos="zoom-in-down" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_hiring_banner_head')!=''){ ?>
          <small>
            <span class="heading_border_style white_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_banner_head')); ?><span class="heading_border_style right_side white_style "></span>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_hiring_banner_head2')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_banner_head2')); ?>
          </h3>
        <?php } ?>
      </div>
      <?php if( get_theme_mod('ts_demo_importer_hiring_banner_button_read_more') != ''){ ?>
        <div class="custom_btn mt-4" data-aos="zoom-in-down" data-aos-duration="2000">
          <a class="theme_button2" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_hiring_banner_button_read_more_url')); ?>">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_banner_button_read_more')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_hiring_banner_button_read_more_icon')); ?>"></i>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
