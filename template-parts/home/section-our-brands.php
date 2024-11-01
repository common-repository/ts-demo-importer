<?php
/**
 * Template part for displaying our brands
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_brand_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
   $img_bg = get_theme_mod('ts_demo_importer_our_brand_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_our_brand_bgcolor','') ) {
    $brands_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_brand_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_brand_bgimage','') ){
    $brands_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_brand_bgimage')).'\')';
  }else{
    $brands_backg='';
  }

  if( get_theme_mod('ts_demo_importer_our_brand_carousel_loop', true) ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_brand_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_our_brand_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_our_brand_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_our_brand_carousel_nav', false) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-3 col-md-4 col-sm-6 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }

  $template = wp_get_theme()->get( 'TextDomain' );

?>
<section id="our-brands" style="<?php echo esc_attr($brands_backg); ?>"
                         class="<?php echo esc_attr($img_bg); ?>"
                         data-loops="<?php echo esc_html($carousel_loop); ?>"
                         data-speed="<?php echo esc_html($carousel_speed); ?>"
                         data-dots="<?php echo esc_html($carousel_dots); ?>"
                         data-nav="<?php echo esc_html($carousel_nav); ?>">
  <div class="container">
    <?php if ( $template == 'ts-conference' ) { ?>
      <div class="section-titles pb-lg-5 pb-4 text-center"  data-aos="zoom-in" data-aos-duration="2000">
        <?php if (get_theme_mod('ts_demo_importer_our_brand_small_heading') != '') { ?>
          <h6 class="section-small-heading m-auto">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_small_heading')); ?>
          </h6>
        <?php } ?>

        <?php if (get_theme_mod('ts_demo_importer_our_brand_main_heading') != '') { ?>
          <h2 class="section-main-heading">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_main_heading')); ?>
          </h2>
        <?php } ?>
      </div>
    <?php } else { ?>
      <div class="brand-head section_main_head text-center pb-4" data-aos="zoom-in-down" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_our_brand_main_heading')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_main_heading')); ?>
          </h3>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="<?php echo esc_attr($amp_row); ?>">
      <?php
      $brands_no=get_theme_mod('ts_demo_importer_our_brand_number');
      for($i=1;$i<=$brands_no;$i++){ ?>

        <div class="brand-images <?php echo esc_attr($amp_class); ?>" data-aos="zoom-in-down" data-aos-duration="2000">
          <?php if( get_theme_mod('ts_demo_importer_our_brand_url'.$i) ) { ?>
            <a href="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_url'.$i)); ?>">
          <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_our_brand_image'.$i)!=''){ ?>
              <img src="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_our_brand_image_alt_text'.$i)); ?>" loading="lazy">
            <?php } ?>

          <?php if( get_theme_mod('ts_demo_importer_our_brand_url'.$i) ) { ?>
            </a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
