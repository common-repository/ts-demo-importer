<?php
/**
 * Template part for displaying best-services-offered
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_best_services_offered_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_best_services_offered_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_best_services_offered_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_best_services_offered_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_best_services_offered_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_best_services_offered_bgimage')).'\')';
  }else{
    $about_backg='';
  }
  $img_bg = get_theme_mod( 'ts_demo_importer_best_services_offered_bgimage_setting' );

  // video background
  $video_bg = get_theme_mod ('ts_demo_importer_best_services_offered_video_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_best_services_offered_video_bgcolor','') ) {
    $video_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_best_services_offered_video_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_best_services_offered_video_back_bgimage','') ){
    $video_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_best_services_offered_video_back_bgimage')).'\')';
  }
  $video_bg = get_theme_mod ('ts_demo_importer_best_services_offered_video_bgimage_setting');

?>

<section id="best-services-offered" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>" >
  <!-- style="<!?php echo esc_attr($about_backg); ?>" class="<!?php echo esc_attr($img_bg); ?>" -->
  <!-- <div class="background-grey"></div> -->
  <div class="container">
    <p class="small-heading ">
      <span class="heading_border_style_l white_style"></span>
      <?php echo get_theme_mod('ts_demo_importer_best_services_offered_small_heading'); ?>
      <span class="heading_border_style_r white_style"></span>
    </p>
    <h3 class="main-heading">
      <?php echo get_theme_mod('ts_demo_importer_best_services_offered_main_heading'); ?>
    </h3>
    <div class="background-img" style="<?php echo esc_attr($video_backg); ?>">

      <div id="video-popup-overlay"></div>
        <a href="">
          <img class="video-icon vpop"
          data-type="vimeo"
          data-id="172052320"
          data-autoplay='true'
          src="<?php echo esc_url(get_theme_mod('ts_demo_importer_best_services_offered_video_icon')); ?>"
          alt="">
        </a>
      <div id="video-popup-container">
        <div id="video-popup-close" class="fade">&#10006;</div>
        <div id="video-popup-iframe-container">
          <iframe id="video-popup-iframe" src="<?php echo esc_url(get_theme_mod('ts_demo_importer_best_services_offered_video_link')); ?>" width="100%" height="100%" frameborder="0"></iframe>
        </div>
      </div>

      <img class="video-bg-img" src="<?php echo esc_url(get_theme_mod('ts_demo_importer_best_services_offered_video_bgimage')); ?>" alt="">
    </div>


  </div>
</section>
