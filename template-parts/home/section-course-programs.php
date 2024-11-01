<?php

/**
 * The Template for displaying Courses
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_featured_courses_enabledisable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  if( get_theme_mod('ts_demo_importer_featured_courses_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_featured_courses_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_featured_courses_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_featured_courses_bgimage')).'\')';
  }else{
    $about_backg= '';
  }

  if( get_theme_mod('ts_demo_importer_featured_courses_bg_settings', '') ) {
    $about_backg_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_featured_courses_bg_settings','')).';';
  }else {
    $about_backg_att = '';
  }

?>

<section id="featured-courses" style="<?php echo esc_attr($about_backg . ';' . $about_backg_att); ?>" class="featured-courses mt-5 pb-0">
  <div class="container">
    <div class="featured-head" data-aos="slide-up" data-aos-duration="2000">
      <div class="section-title text-center pb-5">
        <?php if(get_theme_mod('ts_demo_importer_courses_top_heading',true)!=""){ ?>
          <h2 class="coursehead">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_courses_top_heading')); ?>
          </h2>
        <?php } ?>
        <?php if (get_theme_mod('ts_demo_importer_courses_top_paragraph') != ''){?>
          <p><?php echo esc_html(get_theme_mod('ts_demo_importer_courses_top_paragraph')); ?></p>
        <?php } ?>
      </div>
    </div>
    <div class="main-box">
      <div class="row g-5">
        <?php
          $args = array(
            'post_type' => 'lp_course',
            'post_status' => 'publish',
            'posts_per_page' => get_theme_mod('ts_demo_importer_course_count', '6')
          );
          $query = new WP_Query($args);
            if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();

            $course = LP_Global::course();
            $price = $course->get_price_html();
            $lessons = $course->get_items( LP_LESSON_CPT );
            $lessons  = count( $lessons );
            $p = learn_press_format_price( $price, true );
            $students = $course->count_students();
            ?>
          <div class="col-lg-4 col-md-6 featured-courses-contents" data-aos="zoom-in-down" data-aos-duration="2000">
            <div class="post-image text-center">
             <?php the_post_thumbnail() ?>
            </div>
            <div class="con-box text-lg-start text-md-start text-sm-start text-center">
              <h3 class="course-title">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
              <div class="featured-course-det mt-2">
                <div class="courses-text">
                  <p>
                    <?php $excerpt = get_the_excerpt();
                    echo esc_html(ts_demo_importer_string_limit_words($excerpt,20)); ?>
                  </p>
                </div>
              </div>
              <div class="course-buttons mt-3 pt-2 pb-3"><a href="<?php the_permalink(); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_course_button')); ?>
              </a>
              </div>
            </div>
          </div>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
