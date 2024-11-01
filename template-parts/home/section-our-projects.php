<?php
/**
 * Template part for displaying our projects
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_projects_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_our_projects_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_our_projects_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_projects_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_projects_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_projects_bgimage')).'\')';
  }else{
    $about_backg='';
  }

  if( get_theme_mod('ts_demo_importer_our_projects_carousel_loop') ) { $carousel_loop = 'true'; }
  else{ $carousel_loop = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_projects_carousel_speed') ) { $carousel_speed = get_theme_mod('ts_demo_importer_our_projects_carousel_speed'); }
  else{ $carousel_speed = 3000; }

  if( get_theme_mod('ts_demo_importer_our_projects_carousel_dots', true) ) { $carousel_dots = 'true'; }
    else{ $carousel_dots = 'false'; }

  if( get_theme_mod('ts_demo_importer_our_projects_carousel_nav', true) ) { $carousel_nav = 'true'; }
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
<section id="our-projects" style="<?php echo esc_attr($about_backg); ?>"
                           class="<?php echo esc_attr($img_bg); ?>"
                           data-loops="<?php echo esc_html($carousel_loop); ?>"
                           data-speed="<?php echo esc_html($carousel_speed); ?>"
                           data-dots="<?php echo esc_html($carousel_dots); ?>"
                           data-nav="<?php echo esc_html($carousel_nav); ?>">
  <div class="container">
    <div class="project-head section_main_head text-left pt-3 pb-4 black_head" data-aos="fade-up" data-aos-duration="3000">
      <?php if(get_theme_mod('ts_demo_importer_our_projects_small_heading')!=''){ ?>
        <small>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_our_projects_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
  </div>

    <?php if(defined('TS_DEMO_IMPOTER_POSTTYPE')){ ?>

      <div class="project_row mt-4 <?php echo esc_attr($amp_row); ?>">
        <?php
        $args = array(
          'post_type' => 'projects',
          'post_status' => 'publish',
          'projectscategory'=> get_theme_mod('ts_demo_importer_our_projects_categoryselection_setting'),
          'posts_per_page' => get_theme_mod('ts_demo_importer_our_projects_number')
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
        ?>

          <div class="work-info text-center <?php echo esc_attr($amp_class); ?>">
            <div class="work_title_box">
              <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <div class="image_box">
                <?php the_post_thumbnail(); ?>
                <div class="link_overlay"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_box_link_text')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_our_projects_box_link_icon')); ?>"></i></a></div>
              </div>
              <div class="project_meta">
                <?php if(get_post_meta($post->ID,'meta-projects-type',true)) { ?>
                  <span class="short_title1">
                    <?php echo esc_html(get_post_meta($post->ID,'meta-projects-type',true)); ?>
                  </span>
                <?php } ?>
                <?php if(get_post_meta($post->ID,'meta-projects-sd',true)) { ?>
                  <span class="short_title2">
                    <?php echo esc_html(get_post_meta($post->ID,'meta-projects-sd',true)); ?>
                  </span>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php endwhile; endif; ?>
      </div>
    <?php }else{ ?>
      <h5>
        <?php esc_html_e('Upload And Activate TS Demo Importer Posttype Plugin To Display Your Projects Details','ts-demo-importer'); ?>
      </h5>
    <?php } ?>
</section>
