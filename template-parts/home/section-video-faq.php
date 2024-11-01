<?php
/**
 * Template part for displaying about us
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_video_faq_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
    $img_bg = get_theme_mod('ts_demo_importer_video_faq_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_video_faq_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_video_faq_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_video_faq_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_video_faq_bgimage')).'\')';
  }else{
    $about_backg='';
  }
  $about_col1="";
  $about_col2="";
  if(get_theme_mod('ts_demo_importer_video_image')!=''){
    $about_col1="col-lg-6 col-md-12";
    $about_col2="col-lg-6 col-md-12";
  }else{
    $about_col1="col-lg-12 col-md-12";
    $about_col2="";
  }
?>
<section id="video_faq" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="row">
      <div class="<?php echo esc_attr($about_col2); ?> video-image ">
        <div class="position-relative">
          <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_video_image')); ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_video_image_alt')); ?>" loading="lazy">
            <div class="ps_video">
              <i class="fas fa-play" data-popup-open="popup-1"></i>
            </div>
        </div>
          <div class="over_video">
            <div class="popup" data-popup="popup-1">
              <div class="popup-inner">
                <?php if( get_theme_mod('ts_demo_importer_video_url', true) != ''){ ?>
                  <div class="video">
                    <embed height="400px" width="100%" src="<?php echo esc_attr(get_theme_mod('ts_demo_importer_video_url')); ?>" allowfullscreen>
                  </div>
                  <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <div class="<?php echo esc_attr($about_col1); ?> faq-content pb-5">
        <div class="faq-head section_main_head text-left">
          <?php if(get_theme_mod('ts_demo_importer_video_faq_small_heading')!=''){ ?>
            <small>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_video_faq_small_heading')); ?>
            </small>
          <?php } if(get_theme_mod('ts_demo_importer_video_faq_main_heading')!=''){ ?>
            <h3>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_video_faq_main_heading')); ?>
            </h3>
          <?php } ?>
          <?php if(get_theme_mod('ts_demo_importer_video_faq_text')!=''){ ?>
            <div class="section-text">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_video_faq_text')); ?>
            </div>
          <?php } ?>
        </div>

        <?php if ( defined( 'TS_DEMO_IMPOTER_POSTTYPE' ) ) { ?>
        <div class="accordion mt-3" id="accordionfaq">
          <?php
          $args = array(
            'post_type' => 'faq',
            'post_status' => 'publish',
            'posts_per_page' => get_theme_mod('ts_demo_importer_faq_number')
          );
          $new = new WP_Query($args);
           $i=1;
            while ( $new->have_posts() ){
              $new->the_post();  ?>
              <div class="accordion-item">

                <h4 class="accordion-header" id="heading<?php echo esc_attr($i); ?>">
                  <!-- <a role="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($i); ?>"  href="#collapse<?php echo esc_attr($i); ?>" aria-expanded="false" aria-controls="collapse<?php echo esc_attr($i); ?>" class="accordion-button">
                    <?php the_title(); ?>
                  </a> -->
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($i); ?>" aria-expanded="false" aria-controls="collapse<?php echo esc_attr($i); ?>">
                    <?php the_title(); ?>
                  </button>
                </h4>

                <div id="collapse<?php echo esc_attr($i); ?>" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo esc_attr($i); ?>" data-bs-parent="#accordionfaq">
                  <div class="accordion-body">
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
              <?php $i++; }
            wp_reset_query(); ?>
        </div>
      <?php } else{ echo '<h5 class="text-center">' . esc_html__( 'Please Activate TS Demo Importer Posttype and create the Faq to make it appear here.', 'ts-demo-importer' ) . '</h5>'; } ?>

      </div>
    </div>
  </div>
</section>
