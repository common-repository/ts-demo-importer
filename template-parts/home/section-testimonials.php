<?php
/**
 * Template part for displaying testimonials
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_testimonials_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_testimonials_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_testimonials_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_testimonials_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_testimonials_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_testimonials_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  $template = wp_get_theme()->get( 'TextDomain' );
  if($number != ''){

if ( $template == 'multi-advance' ) {

    if( get_theme_mod('ts_demo_importer_testimonials_carousel_loop', true) ) { $carousel_loop = 'true'; }
    else{ $carousel_loop = 'false'; }

    if( get_theme_mod('ts_demo_importer_testimonials_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_testimonials_carousel_speed'); }
    else{ $carousel_speed = 3000; }

    if( get_theme_mod('ts_demo_importer_testimonials_carousel_dots', true) ) { $carousel_dots = 'true'; }
      else{ $carousel_dots = 'false'; }

      if( get_theme_mod('ts_demo_importer_testimonials_carousel_nav', true) ) { $carousel_nav = 'true'; }
      else{ $carousel_nav = 'false'; }

    $testimonial_excerpt="";
    if(get_theme_mod('ts_demo_importer_testimonial_excerpt_no')!=''){
      $testimonial_excerpt=get_theme_mod('ts_demo_importer_testimonial_excerpt_no');
    }

    if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
      $amp_class = 'col-lg-6 col-md-6 col-sm-12 col-12 mb-3';
      $amp_row = 'row';
    }
    else{
      $amp_class = '';
      $amp_row = 'owl-carousel';
    }
} elseif ( $template == 'advance-consultancy' ) {
  if( get_theme_mod('ts_demo_importer_testimonials_carousel_loop', true) ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_testimonials_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_testimonials_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_testimonials_carousel_dots', true) ) { $carousel_dots = 'false'; }
    else{ $carousel_dots = 'false'; }

    if( get_theme_mod('ts_demo_importer_testimonials_carousel_nav', true) ) { $carousel_nav = 'true'; }
    else{ $carousel_nav = 'false'; }

  $testimonial_excerpt="";
  if(get_theme_mod('ts_demo_importer_testimonial_excerpt_no')!=''){
    $testimonial_excerpt=get_theme_mod('ts_demo_importer_testimonial_excerpt_no');
  }

  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
    $amp_class = 'col-lg-6 col-md-6 col-sm-12 col-12 mb-3';
    $amp_row = 'row';
  }
  else{
    $amp_class = '';
    $amp_row = 'owl-carousel';
  }
}
?>

<?php if ( $template == 'multi-advance' ) { ?>
<section id="testimonials" style="<?php echo esc_attr($about_backg); ?>"  class="<?php echo esc_attr($img_bg); ?>" data-loops="<?php echo esc_html($carousel_loop); ?>" data-speed="<?php echo esc_html($carousel_speed); ?>" data-dots="<?php echo esc_html($carousel_dots); ?>" data-nav="<?php echo esc_html($carousel_nav); ?>">
  <div class="container">
    <div class="section_main_head text-center pt-3 head_center black_head" data-aos="zoom-in-up" data-aos-duration="2000">
      <?php if(get_theme_mod('ts_demo_importer_testimonials_small_heading')!=''){ ?>
        <small>
          <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_testimonials_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_testimonials_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_testimonials_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>

    <div class="testimonial_row row" data-aos="zoom-in-up" data-aos-duration="2000">
      <?php if ( get_theme_mod('ts_demo_importer_testimonial_enable',true) == "1" ) { ?>
        <?php if(defined('TS_DEMO_IMPOTER_POSTTYPE')){ ?>
          <div class="<?php echo esc_attr($amp_row); ?>">
            <?php
            $args = array(
              'post_type' => 'testimonials',
              'post_status' => 'publish',
              'posts_per_page' => get_theme_mod('ts_demo_importer_testimonial_number')
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
            ?>
              <div class="testimonial-box <?php echo esc_attr($amp_class); ?> text-center">
                <div class="testimonial-image align-items-center">
                  <div class="testimonial_image">
                    <?php the_post_thumbnail(); ?>
                    <i class="fas fa-quote-left"></i>
                  </div>
                  <div class="testimonial_text mt-3"><?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$testimonial_excerpt)); ?></div>
                  <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <?php if(get_post_meta($post->ID,'ts_demo_importer_posttype_testimonial_desigstory',true)) { ?>
                    <cite>
                      <?php echo esc_html(get_post_meta($post->ID,'ts_demo_importer_posttype_testimonial_desigstory',true)); ?>
                    </cite>
                  <?php } ?>
                </div>
              </div>
            <?php endwhile; endif; ?>
          </div>
        <?php }else{ ?>
          <h5>
            <?php esc_html_e('Upload And Activate TS Demo Importer Posttype Plugin To Display Your Testimonials Details','ts-demo-importer'); ?>
          </h5>
        <?php } ?>
      <?php }  ?>
    </div>
  </div>
</section>
  <!-- testimonial 2 -->
<?php } elseif ( $template == 'advance-consultancy' ) {?>
<section id="testimonials" style="<?php echo esc_attr($about_backg); ?>"  class="<?php echo esc_attr($img_bg); ?>" data-loops="<?php echo esc_html($carousel_loop); ?>" data-speed="<?php echo esc_html($carousel_speed); ?>" data-dots="<?php echo esc_html($carousel_dots); ?>" data-nav="<?php echo esc_html($carousel_nav); ?>">
  <div class="container">
    <div class="" data-aos="zoom-in-up" data-aos-duration="2000">
    <?php if ( get_theme_mod('ts_demo_importer_testimonial_enable',true) == "1" ) { ?>
    <?php if(defined('TS_DEMO_IMPOTER_POSTTYPE')){ ?>
      <div class="<?php echo esc_attr($amp_row); ?>">
      <?php
      $args = array(
      'post_type' => 'testimonials',
      'post_status' => 'publish',
      'posts_per_page' => get_theme_mod('ts_demo_importer_testimonial_number')
      );
      $query = new WP_Query($args);
      if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
      ?>
        <div class="<?php echo esc_attr($amp_class); ?> text-center">
            <div class="row align-items-center">
              <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php the_post_thumbnail(); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="section_main_head">
                  <?php if(get_theme_mod('ts_demo_importer_testimonials_small_heading')!=''){ ?>
                    <small class="small-heading">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_testimonials_small_heading')); ?>
                    <span class="heading_border_style right_side"></span>
                    </small>
                  <?php } if(get_theme_mod('ts_demo_importer_testimonials_main_heading')!=''){ ?>
                    <h3 class="main-heading">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_testimonials_main_heading')); ?>
                    </h3>
                  <?php } ?>
                </div>
                <div class="text-content mt-3">
                  <?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$testimonial_excerpt)); ?>
                </div>
              </div>
            </div>
        </div>
      <?php endwhile; endif; ?>
      </div>
    <?php }else{ ?>
    <h5>
    <?php esc_html_e('Upload And Activate TS Demo Importer Posttype Plugin To Display Your Testimonials Details','ts-demo-importer'); ?>
    </h5>
    <?php } ?>
    <?php }  ?>
    </div>
  </div>
</section>
<?php } ?>
<?php } ?>
