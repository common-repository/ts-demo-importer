<?php
/**
 * Template part for displaying Hiring Roles
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_hiring_roles_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_hiring_roles_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_hiring_roles_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_hiring_roles_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_hiring_roles_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_hiring_roles_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  if( get_theme_mod('ts_demo_importer_hiring_roles_carousel_loop') ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_hiring_roles_carousel_speed') ) {
    $carousel_speed = get_theme_mod('ts_demo_importer_hiring_roles_carousel_speed');
   } else {
    $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_hiring_roles_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_hiring_roles_carousel_nav', true) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-3 col-md-4 col-sm-6 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }
?>
<section id="hiring_roles" style="<?php echo esc_attr($about_backg); ?>"
                           class="<?php echo esc_attr($img_bg); ?>"
                           data-loops="<?php echo esc_html($carousel_loop); ?>"
                           data-speed="<?php echo esc_html($carousel_speed); ?>"
                           data-dots="<?php echo esc_html($carousel_dots); ?>"
                           data-nav="<?php echo esc_html($carousel_nav); ?>">
  <div class="container">
    <div class="hiring-head section_main_head text-left pt-3 pb-4 black_head" data-aos="fade-up" data-aos-duration="3000">
      <?php if(get_theme_mod('ts_demo_importer_hiring_roles_small_heading')!=''){ ?>
        <small>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_hiring_roles_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
  </div>

  <div class="container hiring_row mt-4 <?php echo esc_attr($amp_row); ?>">
    <?php
    $hiring_roles_no = get_theme_mod('ts_demo_importer_hiring_roles_number');
    for($i=1;$i<=$hiring_roles_no;$i++)
    {
    ?>
      <div class="hiring-info text-center <?php echo esc_attr($amp_class); ?>">
        <div class="hiring_title_box">

          <?php if(get_theme_mod('ts_demo_importer_hiring_roles_title'.$i)) { ?>
            <h5><a href="<?php echo esc_url(get_theme_mod('ts_demo_importer_hiring_roles_url'.$i)); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_title'.$i)); ?></a></h5>
          <?php } ?>

          <div class="image_box">

            <?php if(get_theme_mod('ts_demo_importer_hiring_roles_image'.$i)) { ?>
              <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_hiring_roles_image'.$i)); ?>">
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_hiring_roles_box_link'.$i)) { ?>
              <div class="link_overlay"><a href="<?php echo esc_url(get_theme_mod('ts_demo_importer_hiring_roles_box_url'.$i)); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_box_link'.$i)); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_hiring_roles_box_link_icon'.$i)); ?>"></i></a></div>
            <?php } ?>

          </div>
          <div class="hiring_meta">
            <?php if(get_theme_mod('ts_demo_importer_hiring_roles_type'.$i)) { ?>
              <span class="short_title1">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_type'.$i)); ?>
              </span>
            <?php } ?>
            <?php if(get_theme_mod('ts_demo_importer_hiring_roles_sub_title'.$i)) { ?>
              <span class="short_title2">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_hiring_roles_sub_title'.$i)); ?>
              </span>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

</section>
