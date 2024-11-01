<?php

/*
* Related Post
*/

function ts_demo_importer_page_boxed_layout(){
    if(get_theme_mod('ts_demo_importer_radio_boxed_full_layout') == 'boxed' ) {
      return true;
    }
  return false;
}

function ts_demo_importer_slider_type_image(){
  $count =  get_theme_mod('ts_demo_importer_slide_number');
  for($i=1; $i<=$count; $i++) {
    if(get_theme_mod('ts_demo_importer_slide_background_type'.$i) == 'slide_type_image' ) {
      return true;
    }
  }
  return false;
}

function ts_demo_importer_slider_video(){
  $count =  get_theme_mod('ts_demo_importer_slide_number');
  for($i=1; $i<=$count; $i++) {
    if(get_theme_mod('ts_demo_importer_slide_background_type'.$i) == 'slide_type_video' ) {
      return true;
    }
  }
  return false;
}

function ts_demo_importer_slider_gradient(){
  $count =  get_theme_mod('ts_demo_importer_slide_number');
  for($i=1; $i<=$count; $i++) {
    if(get_theme_mod('ts_demo_importer_slide_background_type'.$i) == 'slide_type_gradient' ) {
      return true;
    }
  }
  return false;
}

if (!function_exists('bmp_dimension_css')) {

    function bmp_dimension_css($key = '', $params = array()) {
        if (!$key)
            return;

        $default_params = array(
            'position' => array('left', 'top', 'bottom', 'right'),
            'selector' => '',
            'type' => 'margin',
            'unit' => 'px',
            'responsive' => true
        );

        $params = wp_parse_args($params, $default_params);

        $devices = array('desktop');
        if ($params['responsive']) {
            $devices = array('desktop', 'tablet', 'mobile');
        }
        $type = $params['type'] . '-';
        $positions = $params['position'];
        $unit = $params['unit'];
        $selector = $params['selector'];

        $css = '';
        foreach ($devices as $device) {
            $style = array();
            foreach ($positions as $position) {
                $val = get_theme_mod($key . '_' . $position . '_' . $device);
                if ($val === '0' || $val) {
                    $style[] = $type . $position . ':' . $val . $unit;
                }
            }
            if ($style) {
                if ($device == 'tablet') {
                    $css .= '@media screen and (max-width:768px){';
                } elseif ($device == 'mobile') {
                    $css .= '@media screen and (max-width:580px){';
                }
                $css .= $selector . '{' . implode(';', $style) . '}';
                if ($device == 'tablet' || $device == 'mobile') {
                    $css .= '}';
                }
            }
        }

        return $css;
    }

}

/**
 * Number with blank value sanitization callback
 *
 */
function ts_demo_importer_sanitize_number_blank($val) {
    return is_numeric($val) ? $val : '';
}

if ( !function_exists('ts_demo_importer_related_posts') ) {
    function ts_demo_importer_related_posts(){ ?>
        <div class="related-post-wrapper">
            <?php if(get_theme_mod('ts_demo_importer_related_posts_title')!=''){ ?>
                <h3>
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_related_posts_title')); ?>
                </h3>
            <?php } ?>
            <div class="row">
                <?php
                    $current_post_title = get_the_ID();
                    $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => get_theme_mod('ts_demo_importer_related_post_count')
                    );
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();

                    if(get_the_ID() != $current_post_title){?>
                    <div class="col-lg-4 col-md-4 related-post-wrap mb-4">
                        <?php
                        if(has_post_thumbnail()){
                          the_post_thumbnail();
                        }
                        ?>
                        <a href="<?php esc_url(the_permalink()); ?>" class="post-page-title pt-2"><?php the_title(); ?></a>
                        <div class="post-single-text"><?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,15)); ?></div>
                    </div>
                <?php } endwhile; endif; ?>
            </div>
        </div>
    <?php }
}

/*
* Post navigation
*/
if ( !function_exists('ts_demo_importer_single_navigation') ) {
    function ts_demo_importer_single_navigation(){
        the_post_navigation( array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __(get_theme_mod('ts_demo_importer_blog_category_next_title'), 'ts-demo-importer' ) .'</span> ' .
                '<span class="screen-reader-text">' . __( 'Next post:', 'ts-demo-importer' ) . '</span> ' .
                '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">'. __(get_theme_mod('ts_demo_importer_blog_category_prev_title'), 'ts-demo-importer' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Previous post:', 'ts-demo-importer' ) . '</span> ' .
                '<span class="post-title">%title</span>',
        ) );
    }
}

/*
* Show Page title on pages, post.
*/
if ( !function_exists('ts_demo_importer_post_auther_bio') ) {

    function ts_demo_importer_post_auther_bio(){ ?>
        <div class="authordetails">
            <div class="authordescription">
                <?php
                $author_details = "";
                $user_posts=get_author_posts_url( get_the_author_meta( 'ID' ) );
                global $post;
                $content ='';
                                // Detect if it is a single post with a post author
                if ( is_single() && isset( $post->post_author ) ) {
                                    // Get author's display name
                    $display_name = get_the_author_meta( 'display_name', $post->post_author );
                                    // Get author's biographical information or description
                    $user_description = get_the_author_meta( 'user_description', $post->post_author );
                    if ( ! empty( $user_description ) )
                        $author_details .= '<p class="author_links"><a href="'. $user_posts .'"> ' . esc_html($display_name) . '</a>';
                                    // Author avatar and bio
                    $author_details .= '<div class="clear"></div><div class="row"><div class="col-md-2 col-lg-2 author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ).'</div><div class="col-md-10 col-lg-10 b-content">' . nl2br( $user_description ). '</div>';

                    $author_details .= '</div>';

                                    // Pass all this info to post content
                    $content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
                }
                echo esc_html($content);
                ?>
            </div>
            <ul class ="social-profile">
                <?php
                $tumbler_url = get_the_author_meta( 'tumbler_url' );
                if ( $tumbler_url && $tumbler_url != '' ) {
                    echo '<li class="tumbler">
                    <a href="' . esc_url($tumbler_url) . '" target="_blank"><i class="fab fa-tumblr"></i></a></li>';
                }

                $pinterest_profile = get_the_author_meta( 'pinterest_profile' );
                if ( $pinterest_profile && $pinterest_profile != '' ) {
                    echo '<li class="google">
                    <a href="' . esc_url($pinterest_profile) . '" rel="author" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>';
                }

                $twitter_profile = get_the_author_meta( 'twitter_profile' );
                if ( $twitter_profile && $twitter_profile != '' ) {
                    echo '<li class="twitter">
                    <a href="' . esc_url($twitter_profile) . '" target="_blank"> <i class="fab fa-twitter"></i></a></li>';
                }

                $facebook_profile = get_the_author_meta( 'facebook_profile' );
                if ( $facebook_profile && $facebook_profile != '' ) {
                    echo '<li class="facebook">
                    <a href="' . esc_url($facebook_profile) . '" target="_blank"> <i class="fab fa-facebook-f"></i></a></li>';
                }
                ?>
            </ul>
        </div>
    <?php
    }
}

/*
* Show post Share
*/
if ( !function_exists('ts_demo_importer_social_share') ) {
    /**
     * [ts_demo_importer_social_share show all the social share buttons
     * @return [type] string
     */
    function ts_demo_importer_social_share(){
        ?>
        <?php do_action('ts_demo_importer_before_blog_sharing'); ?>

            <?php if(get_theme_mod('ts_demo_importer_post_general_settings_post_share_facebook',true)==1 || get_theme_mod('ts_demo_importer_post_general_settings_post_share_linkedin',true)==1 || get_theme_mod('ts_demo_importer_post_general_settings_post_share_twitter',true)==1){ ?>

            <span class="share_text"><?php echo esc_html('Share: ','ts-demo-importer'); ?></span>

            <?php }

            if ( get_theme_mod('ts_demo_importer_post_general_settings_post_share_facebook',true) == "1" ) { ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(the_permalink()); ?>" target="_blank"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php echo esc_html('facebook.com', 'ts-demo-importer' ) ; ?></span></a>
            <?php }

            if ( get_theme_mod('ts_demo_importer_post_general_settings_post_share_linkedin',true) == "1" ) { ?>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url(the_permalink()); ?>&title=<?php the_title(); ?>&source=<?php the_title(); ?>" target="_blank"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php echo esc_html('linkedin.com', 'ts-demo-importer' ) ; ?></span></a>
            <?php }

            if ( get_theme_mod('ts_demo_importer_post_general_settings_post_share_twitter',true) == "1" ) { ?>
                <a href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>&amp;text=<?php echo the_title(); ?>" target="_blank"><i class="fab fa-twitter"></i><span class="screen-reader-text"><?php echo esc_html('twitter.com', 'ts-demo-importer' ) ; ?></span></a>
            <?php } ?>
        <?php
    }
}

function ts_demo_importer_string_limit_words($string, $word_limit) {
  $word_limit = '20';
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// Recent post widget with thumbnails
// include ts_demo_importer_EXT_DIR.'../../../wp-includes/default-widgets.php';
Class Tdi_My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
    function widget($args, $instance) {
            if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'ts-demo-importer' );
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
        if ($r->have_posts()) :
        ?>
        <?php echo esc_html($args['before_widget']); ?>
        <?php if ( $title ) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        } ?>
        <ul>
          <?php while ( $r->have_posts() ) : $r->the_post(); ?>
              <li>
                <div class="recent-post-box">
                  <div class="media post-thumb">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail(); } ?>
                    <div class="media-body post-content pl-3">
                      <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                     <?php if ( $show_date ) : ?>
                         <p class="post-date"><?php the_date(); ?></p>
                     <?php endif; ?>
                    </div>
                  </div>
                </div>
              </li>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </ul>

        <?php  esc_html($args['after_widget']);

        endif;
    }
}
function tdi_my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('Tdi_My_Recent_Posts_Widget');
}
add_action('widgets_init', 'tdi_my_recent_widget_registration');


/* Excerpt Read more overwrite */
function ts_demo_importer_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }
    $link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ts-demo-importer' ), get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'ts_demo_importer_excerpt_more' );

/*Radio Button sanitization*/
function ts_demo_importer_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}



/*===================================================================================
* Add Author Links
* =================================================================================*/
function ts_add_to_author_profile( $contactmethods ) {

$contactmethods['tumbler_url'] = 'Tumbler URL';
$contactmethods['pinterest_profile'] = 'Pinterest Profile URL';
$contactmethods['twitter_profile'] = 'Twitter Profile URL';
$contactmethods['facebook_profile'] = 'Facebook Profile URL';

return $contactmethods;
}
add_filter( 'user_contactmethods', 'ts_add_to_author_profile', 10, 1);

/*
* Feature Section Shape
*/

if ( !function_exists('ts_demo_importer_feature_shape') ) {
    function ts_demo_importer_feature_shape(){
        ?>


    <svg class="feature_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 328.57 479.4">
        <defs>
            <style>
            .feature-cls-1{
                fill:#f5f9ff;
                isolation:isolate;
            }
        </style>
        </defs>
        <g id="Layer_2" data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
                <path class="feature-cls-1" d="M0,477.7s85.9,17.67,151.9-60.93a48.71,48.71,0,0,0,3.79-5.12c10.91-17.07,83.5-121.23,95.38-133.23,14.85-15,86.79-55.5,76.5-111.22-9.81-53.12-78-148-242.87-165.82A223.45,223.45,0,0,0,26.13,2.54C16.08,4.12,6.13,6.43,0,9.81Z"/>
            </g>
        </g>
    </svg>

    <?php }
}

/*
* Why Choose Us Section Shape
*/

if ( !function_exists('ts_demo_importer_consult_us_shape') ) {
    function ts_demo_importer_consult_us_shape(){
        ?>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1921.088 1123.99">
          <path id="Union_4" width="100%" height="100%" data-name="Union 4" d="M301.837,1170.478C115.4,1137.335,135.023,1068.4,14,1055.729V334.2S240.778,50.06,518.8,116.934s372.163,271.208,633.129,136.457S1460.813,6.914,1647.252,80.262s166.814,225.9,287.836,253.94v721.526s-226.778,128.4-504.8,98.177-372.163-122.552-633.129-61.661c-203.753,47.541-277.651,88.74-388.987,88.745C376.907,1180.991,342.711,1177.745,301.837,1170.478Z" transform="translate(-14 -57)" fill="#e5f2ff" opacity="0.6"/>
        </svg>

    <?php }
}
