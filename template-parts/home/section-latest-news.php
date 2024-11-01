<?php
/**
 * Template part for displaying latest news
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_latest_news_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_latest_news_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_latest_news_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_latest_news_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_latest_news_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_latest_news_bgimage')).'\')';
  }else{
    $about_backg='';
  }
  $post_excerpt="";
  if(get_theme_mod('ts_demo_importer_post_excerpt_no')!=''){
    $post_excerpt=get_theme_mod('ts_demo_importer_post_excerpt_no');
  }
  $share_col1="";
  $share_col2="";
  $share_col3="";

  if ( get_theme_mod('ts_demo_importer_post_general_settings_post_share',true) == "1" ) {
    $share_col1="col-lg-5 col-md-4 col-sm-5";
    $share_col2="col-lg-3 col-md-4 col-sm-3";
    $share_col3="col-lg-4 col-md-4 col-sm-4";
  }else{
    $share_col1="";
    $share_col2="col-lg-6 col-md-6 col-sm-6";
    $share_col3="col-lg-6 col-md-6 col-sm-6";
  }

  $template = wp_get_theme()->get( 'TextDomain' );

  if( $template == 'advance-marketing-agency' ){
    $amp_class = '';
    $amp_row = 'owl-carousel';
  } elseif ( $template == 'multi-advance' ) {
    $amp_class = 'col-lg-4 col-md-6 col-sm-6 col-12 mb-3';
    $amp_row = 'row';
  }

  if( get_theme_mod('ts_demo_importer_latest_news_carousel_loop', true) ) {
    $carousel_loop = 'true';
  } else {
    $carousel_loop = 'false';
  }

  if( get_theme_mod('ts_demo_importer_latest_news_carousel_speed') ) {
    $carousel_speed = get_theme_mod('ts_demo_importer_latest_news_carousel_speed');
  } else {
    $carousel_speed = 3000;
  }

  if( get_theme_mod('ts_demo_importer_latest_news_carousel_dots', true) ) {
    $carousel_dots = 'true';
  } else {
    $carousel_dots = 'false';
  }

  if( get_theme_mod('ts_demo_importer_latest_news_carousel_nav', true) ) { $carousel_nav = 'true';
  } else {
    $carousel_nav = 'false';
  }

?>
<section id="latest-news" style="<?php echo esc_attr($about_backg); ?>"
                          class="<?php echo esc_attr($img_bg); ?> latest-news"
                          nav="<?php echo esc_attr($carousel_nav); ?>"
                          speed="<?php echo esc_attr($carousel_speed); ?>"
                          loops="<?php echo esc_attr($carousel_loop); ?>"
                          dots="<?php echo esc_attr($carousel_dots); ?>">
  <div class="container">
    <?php if($template == 'advance-training-academy' ) { ?>
      <div class="section-title text-center pb-5 wow slideInUp delay-1000 animated" data-wow-duration="2s">
      <?php if(get_theme_mod('ts_demo_importer_latest_news_heading',true)!=""){ ?>
        <h2 class="coursehead">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_heading')); ?>
        </h2>
      <?php } ?>
      <?php if (get_theme_mod('ts_demo_importer_latest_news_paragraph') != ''){?>
        <p><?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_paragraph')); ?></p>
      <?php } ?>
    </div>
    <div class="owl-carousel">
      <?php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => get_theme_mod('ts_demo_importer_my_blog_number')
        );
        $new = new WP_Query($args);
        $loop_index = 0; $i=1;
           while ( $new->have_posts() ){
            $new->the_post();  ?>
            <div class="latest-main-box wow zoomInDown delay-1000 animated" data-wow-duration="2s">
              <?php if (has_post_thumbnail()){ ?>
                <?php the_post_thumbnail(); ?>
              <?php } ?>
              <div class="postbox-content">
                <div class="mt-2">
                  <span class="entry-date">
                    <i class="fa-solid fa-calendar me-1"></i>
                    <?php the_time( 'd M Y' ) ?>
                  </span>
                  <span class="latest-author ms-2">
                    <i class="fa-solid fa-user me-1"></i>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                      <?php the_author(); ?>
                    </a>
                  </span>
                </div>
                <h3 class="latest-post-title p-0">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <div class="news-text mt-3">
                  <?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$post_excerpt)); ?>
                </div>
                <div class="readmore_comment_link mt-4 pt-2">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="ps-0 pe-0 read-bot">
                      <?php if(get_theme_mod('ts_demo_importer_latest_news_read_more_text')!=''){ ?>
                        <a class="blog_read_more" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_read_more_text')); ?>
                        </a>
                      <?php } ?>
                    </div>
                    <div class="pe-0 ps-0">
                      <div class="comment_link d-flex justify-content-end">
                        <?php echo do_shortcode('[posts_like_dislike id='.get_the_ID().']');?><span class="post-like-text">Like</span>
                        <span class="entry-comments"><i class="fas fa-comments me-1"></i><?php comments_number( 'Comment 0', 'Comment 1', 'Comments % ' ); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; }
        wp_reset_query(); ?>
    </div>
  <?php }elseif($template == 'ts-conference'){ ?>
    <div class="section-titles pb-5 text-center"  data-aos="zoom-in" data-aos-duration="2000">
      <?php if (get_theme_mod('ts_demo_importer_latest_news_small_heading') != '') { ?>
        <h6 class="section-small-heading m-auto">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_small_heading')); ?>
        </h6>
      <?php } ?>

      <?php if (get_theme_mod('ts_demo_importer_latest_news_main_heading') != '') { ?>
        <h2 class="section-main-heading">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_main_heading')); ?>
        </h2>
      <?php } ?>
    </div>

    <div class="owl-carousel">
      <?php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => get_theme_mod('ts_demo_importer_my_blog_number')
        );
        $new = new WP_Query($args);
        $loop_index = 0; $i=1;
           while ( $new->have_posts() ){
            $new->the_post();  ?>
            <div class="latest-main-box wow zoomInDown delay-1000 animated" data-wow-duration="2s">

              <div class="position-relative">
                <?php if (has_post_thumbnail()){ ?>
                  <?php the_post_thumbnail(); ?>
                <?php } ?>

                <span class="post-date position-absolute">
                  <?php the_time( 'd M Y' ) ?>
                </span>
              </div>

              <div class="postbox-content">
                <p class="latest-author mb-0">
                  <span>
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_posted_by_text')); ?>
                  </span>
                  <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <?php the_author(); ?>
                  </a>
                </p>

                <h3 class="section-post-title py-0">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <p class="news-text mt-3">
                  <?php $excerpt = get_the_excerpt();
                    echo esc_html(ts_demo_importer_string_limit_words($excerpt,$post_excerpt)); ?>
                </p>

                <div class="readmore_comment_link mt-4 pt-2">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <?php if(get_theme_mod('ts_demo_importer_latest_news_read_more_text')!=''){ ?>
                      <a class="blog_read_more" href="<?php the_permalink(); ?>">
                        <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_read_more_text')); ?>
                      </a>
                    <?php } ?>

                    <div class="comment_link d-flex justify-content-end align-items-center">
                      <?php echo do_shortcode('[posts_like_dislike id='.get_the_ID().']');?>
                      <span class="entry-comments">
                        <i class="fas fa-comments me-1"></i>
                        <?php comments_number( '0', '1', '%' ); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; }
        wp_reset_query(); ?>
    </div>




  <?php }else{ ?>
    <div class="section_main_head text-center pt-3 pb-4 head_center black_head" data-aos="zoom-in-up" data-aos-duration="2000">
      <?php if(get_theme_mod('ts_demo_importer_latest_news_small_heading')!=''){ ?>
        <small>
          <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_latest_news_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
    <div class="<?php echo esc_attr($amp_row); ?>" data-aos="zoom-in-up" data-aos-duration="2000">
      <?php
      $i=1;
      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => get_theme_mod('ts_demo_importer_latest_news_number'),
        'order' => 'ASC'
      );
      $query = new WP_Query($args);
      if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();
      ?>
        <div class="<?php echo esc_attr($amp_class); ?>">
          <div class="news-box">
            <div class="post-meta">
              <?php if ( $template == 'multi-advance' ) {
                if ( get_theme_mod('ts_demo_importer_post_general_settings_post_date',true) == "1" ) { ?>
                  <span class="news_date"><i class="fas fa-calendar-alt"></i><?php the_time('d M Y'); ?></span>
                <?php }
              } elseif ( $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ) { ?>
                <span class="like-button">
                  <?php echo do_shortcode(get_theme_mod('ts_demo_importer_latest_blog_like_button'));?>
                  <span class="blog-like-text" ><?php echo get_theme_mod('total_blog_likes','Likes'); ?></span>
                </span>
              <?php } ?>
              <span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( 'no comments', 'one comments', '% comments' ); ?></span>
            </div>
            <div class="post_img">
              <?php the_post_thumbnail(); ?>
              <div class="link_overlay"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_box_link_text')); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_latest_news_box_link_icon')); ?>"></i></a></div>
            </div>
            <div class="news_content">
              <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <div class="news-text">
                <?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$post_excerpt)); ?>
              </div>
              <div class="auther_details">
                <?php
                  $get_author_id = get_the_author_meta('ID');
                  echo get_avatar( get_the_author_meta('ID') );
                ?>
                <span class="auther_name"><?php echo get_the_author_meta('display_name', $get_author_id); ?></span>
              </div>
            </div>
          </div>
        </div>
      <?php $i++; endwhile; endif; ?>
    </div>
  <?php } ?>
  </div>
</section>
