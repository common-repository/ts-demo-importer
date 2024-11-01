<?php
/**
 * The Template for displaying Our Blogs.
 *
 * @package ts-demo-importer
 */
$about_section = get_theme_mod( 'ts_demo_importer_hire_us_enable' );
if ( 'Disable' == $about_section ) {
  return;
}
/*hire_us*/

$img_bg =  get_theme_mod('ts_demo_importer_hire_us_bgimage_attachment');
if( get_theme_mod('ts_demo_importer_hire_us_bgcolor') ) {
  $about_backg = 'background:'.esc_attr(get_theme_mod('ts_demo_importer_hire_us_bgcolor')).' !important;';
}elseif( get_theme_mod('ts_demo_importer_hire_us_bgimage') ){
  $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_hire_us_bgimage')).'\') !important';
}else{
  $about_backg = '';
}


?>
<section id="hire_us" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-6 hire_us_content">
        <div class="hire_us-head section_main_head white_head" data-aos="zoom-in-down" data-aos-duration="2000">
          <?php if(get_theme_mod('ts_demo_importer_hire_us_head')!=''){ ?>
            <small>
              <span class="heading_border_style white_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_hire_us_head')); ?>
            </small>
          <?php } if(get_theme_mod('ts_demo_importer_hire_us_head2')!=''){ ?>
            <h3>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_hire_us_head2')); ?>
            </h3>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-end hire_us_btn">
        <?php if( get_theme_mod('ts_demo_importer_hire_us_button_read_more') != ''){ ?>
          <div class="custom_btn" data-aos="zoom-in-down" data-aos-duration="2000">
            <a class="theme_white_btn" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_hire_us_button_read_more_url')); ?>">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_hire_us_button_read_more')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_hire_us_button_read_more_icon')); ?>"></i>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
