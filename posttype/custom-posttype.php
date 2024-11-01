<?php

/*
 TS Demo Importer Posttype
*/

add_action( 'init', 'ts_demo_importer_posttype' );
add_action( 'init', 'ts_demo_importer_projectscategory');
add_action( 'init', 'ts_demo_importer_eventscategory', 0 );
add_action( 'init', 'ts_demo_importer_eventtags');


add_action( 'eventscategory_add_form_fields', 'add_eventscategory_image', 10, 2 );
add_action( 'created_eventscategory', 'save_category_image', 10, 2 );
add_action( 'eventscategory_edit_form_fields', 'update_category_image', 10, 2 );
add_action( 'edited_eventscategory', 'updated_category_image', 10, 2 );
add_action( 'admin_enqueue_scripts', 'load_media' );
add_action( 'admin_footer', 'add_script' );

function ts_demo_importer_posttype() {
  $template = wp_get_theme()->get( 'TextDomain' );
  register_post_type( 'services',
    array(
        'labels' => array(
          'name' => __( 'Services','ts-demo-importer-posttype' ),
          'singular_name' => __( 'Services','ts-demo-importer-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-tag',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );

  register_post_type( 'projects',
    array(
        'labels' => array(
            'name' => __( 'Projects','ts-demo-importer-posttype' ),
            'singular_name' => __( 'Projects','ts-demo-importer-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-welcome-learn-more',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );


  if ($template != 'advance-training-academy') {
  
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events','ts-demo-importer-posttype' ),
        'singular_name' => __( 'events','ts-demo-importer-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-format-status',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'author',
        'comments'
      )
    )
  );
  }

  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonial','ts-demo-importer-posttype' ),
        'singular_name' => __( 'Testimonial','ts-demo-importer-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-businessman',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );

  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Team','ts-demo-importer-posttype' ),
        'singular_name' => __( 'Team','ts-demo-importer-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array(
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

/* ----------------- Services --------------------- */
function ts_demo_importer_posttype_images_metabox_enqueue($hook) {
  if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
    wp_enqueue_script('ts-demo-importer-posttype-images-metabox', plugin_dir_url( __FILE__ ) . '/js/img-metabox.js', array('jquery', 'jquery-ui-sortable') ,TS_DEMO_IMPOTER);

    global $post;
    if ( $post ) {
      wp_enqueue_media( array(
          'post' => $post->ID,
        )
      );
    }

  }
}
add_action('admin_enqueue_scripts', 'ts_demo_importer_posttype_images_metabox_enqueue');
// Services Meta
function ts_demo_importer_posttype_bn_custom_meta_services() {

    add_meta_box( 'bn_meta', __( 'Services Meta', 'ts-demo-importer-posttype' ), 'ts_demo_importer_posttype_bn_meta_callback_services', 'services', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'ts_demo_importer_posttype_bn_custom_meta_services');
}

function ts_demo_importer_posttype_bn_meta_callback_services( $post ) {
    $template = wp_get_theme()->get( 'TextDomain' );
    
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    if($template == 'advance-training-academy' ) {
      $btn_text = get_post_meta( $post->ID, 'service-read-more-btn', true );
    }else {
      $short_title = get_post_meta( $post->ID, 'meta-short-title', true );
    }
    ?>
  <div id="property_stuff">
    <table id="list-table">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <?php
          if($template == 'advance-training-academy' ) { ?>
            <td class="left">
              <?php esc_html_e( 'Button Text', 'ts-demo-importer-posttype' )?>
            </td>
            <td class="left" >
              <input type="text" name="service-read-more-btn" id="service-read-more-btn" value="<?php echo esc_attr( $btn_text ); ?>" />
            </td>
          <?php }else { ?>
            <td class="left">
              <?php esc_html_e( 'Short Title', 'ts-demo-importer-posttype' )?>
            </td>
            <td class="left" >
              <input type="text" name="meta-short-title" id="meta-short-title" value="<?php echo esc_attr( $short_title ); ?>" />
            </td>
          <?php } ?>

        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function ts_demo_importer_posttype_bn_meta_save_services( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if($template == 'advance-training-academy' ) {
    if( isset( $_POST[ 'service-read-more-btn' ] ) ) {
      update_post_meta( $post_id, 'service-read-more-btn', sanitize_text_field($_POST[ 'service-read-more-btn']) );
    }
  }else {
    if( isset( $_POST[ 'meta-short-title' ] ) ) {
      update_post_meta( $post_id, 'meta-short-title', sanitize_text_field($_POST[ 'meta-short-title']) );
    }
  }



}
add_action( 'save_post', 'ts_demo_importer_posttype_bn_meta_save_services' );

// ---------------- projects ---------------

function ts_demo_importer_projectscategory() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Categories', 'ts-demo-importer-posttype' ),
    'singular_name'     => __( 'Categories', 'ts-demo-importer-posttype' ),
    'search_items'      => __( 'Search cats', 'ts-demo-importer-posttype' ),
    'all_items'         => __( 'All Categories', 'ts-demo-importer-posttype' ),
    'parent_item'       => __( 'Parent Categories', 'ts-demo-importer-posttype' ),
    'parent_item_colon' => __( 'Parent Categories:', 'ts-demo-importer-posttype' ),
    'edit_item'         => __( 'Edit Categories', 'ts-demo-importer-posttype' ),
    'update_item'       => __( 'Update Categories', 'ts-demo-importer-posttype' ),
    'add_new_item'      => __( 'Add New Categories', 'ts-demo-importer-posttype' ),
    'new_item_name'     => __( 'New Categories Name', 'ts-demo-importer-posttype' ),
    'menu_name'         => __( 'Categories', 'ts-demo-importer-posttype' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'projectscategory' ),
  );
  register_taxonomy( 'projectscategory', array( 'projects' ), $args );
}


function ts_demo_importer_posttype_images_projects_metabox_enqueue($hook) {
  if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
    wp_enqueue_script('ts-demo-importer-posttype-images-metabox', plugin_dir_url( __FILE__ ) . '/js/img-metabox.js', array('jquery', 'jquery-ui-sortable') ,TS_DEMO_IMPOTER);

    global $post;
    if ( $post ) {
      wp_enqueue_media( array(
          'post' => $post->ID,
        )
      );
    }
  }
}
add_action('admin_enqueue_scripts', 'ts_demo_importer_posttype_images_projects_metabox_enqueue');
// Services Meta
function ts_demo_importer_posttype_bn_custom_meta_projects() {

    add_meta_box( 'bn_meta', __( 'Projects Meta', 'ts-demo-importer-posttype' ), 'ts_demo_importer_posttype_bn_meta_callback_projects', 'projects', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'ts_demo_importer_posttype_bn_custom_meta_projects');
}

function ts_demo_importer_posttype_bn_meta_callback_projects( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce1' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $project_duration = get_post_meta( $post->ID, 'meta-project-duration', true );
    $project_location = get_post_meta( $post->ID, 'meta-projects-location', true );
    $project_client_name = get_post_meta( $post->ID, 'meta-project-client', true );
    $project_type = get_post_meta( $post->ID, 'meta-projects-type', true );
    $project_sd = get_post_meta( $post->ID, 'meta-projects-sd', true );

    ?>
  <div id="property_stuff">
    <table id="list-table">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php esc_html_e( 'Project Duration', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-project-duration" id="meta-project-duration" value="<?php echo esc_attr( $project_duration ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php esc_html_e( 'Project Location', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-projects-location" id="meta-projects-location" value="<?php echo esc_attr( $project_location ); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php esc_html_e( 'Client Name', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-project-client" id="meta-project-client" value="<?php echo esc_attr( $project_client_name ); ?>" />
          </td>
        </tr>
        <tr id="meta-4">
          <td class="left">
            <?php esc_html_e( 'Project Type', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-projects-type" id="meta-projects-type" value="<?php echo esc_attr( $project_type ); ?>" />
          </td>
        </tr>

        <tr id="meta-4">
          <td class="left">
            <?php esc_html_e( 'Short Description', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-projects-sd" id="meta-projects-sd" value="<?php echo esc_attr( $project_sd ); ?>" />
          </td>
        </tr>

      </tbody>
    </table>
  </div>
  <?php
}

function ts_demo_importer_posttype_bn_meta_save_projects( $post_id ) {


  if (!isset($_POST['bn_nonce1']) || !wp_verify_nonce($_POST['bn_nonce1'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if( isset( $_POST[ 'meta-project-duration' ] ) ) {
    update_post_meta( $post_id, 'meta-project-duration', sanitize_text_field($_POST[ 'meta-project-duration']) );
  }

  if( isset( $_POST[ 'meta-projects-location' ] ) ) {
    update_post_meta( $post_id, 'meta-projects-location', sanitize_text_field($_POST[ 'meta-projects-location']) );
  }

  if( isset( $_POST[ 'meta-project-client' ] ) ) {
    update_post_meta( $post_id, 'meta-project-client', sanitize_text_field($_POST[ 'meta-project-client']) );
  }
  if( isset( $_POST[ 'meta-projects-type' ] ) ) {
    update_post_meta( $post_id, 'meta-projects-type', sanitize_text_field($_POST[ 'meta-projects-type']) );
  }
  if( isset( $_POST[ 'meta-projects-sd' ] ) ) {
    update_post_meta( $post_id, 'meta-projects-sd', sanitize_text_field($_POST[ 'meta-projects-sd']) );
  }

}
add_action( 'save_post', 'ts_demo_importer_posttype_bn_meta_save_projects' );

/* Project shortcode */
function ts_demo_importer_posttype_projects_func( $atts ) {
  $thumb_url="";
  $projects = '';
  $projects = '<div class="row short-projects" id="our-projects">';
  $query = new WP_Query( array( 'post_type' => 'projects') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=projects');
  while ($new->have_posts()) : $new->the_post();

        $custom_url ='';
        $post_id = get_the_ID();
        $project_type= get_post_meta($post_id,'meta-projects-type',true);
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
        if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
        $url = $thumb['0'];
        $excerpt = wp_trim_words(get_the_excerpt(),12);
        $custom_url = get_permalink();
        $projects .= '
            <div class="col-lg-4 col-md-6">
              <div class="work-info <?php echo esc_attr($amp_class); ?>">
                <img src="'.esc_url($thumb_url).'" alt="'.esc_attr(get_the_title()) .' post thumbnail icon" />
                <div class="work_title_box">
                  <h5><a href="'.esc_url(get_the_permalink()) .'">'.esc_html(get_the_title()) .'</a></h5>';
                  if(get_post_meta(get_the_ID(),'meta-projects-type',true)) {
                    $projects .= '<div class="short_title">
                      '.$project_type.'
                    </div>';
                  }
                $projects .= '</div>
              </div>
            </div>';
    if($k%2 == 0){
      $projects.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $projects = '<h2 class="center">'.esc_html__('Post Not Found','ts_demo_importer_posttype').'</h2>';
  endif;
  return $projects;
}

add_shortcode( 'ts-demo-importer-projects', 'ts_demo_importer_posttype_projects_func' );

/*---------------------------------- Testimonial section -------------------------------------*/

/* Adds a meta box to the Testimonial editing screen */
function ts_demo_importer_posttype_bn_testimonial_meta_box() {
  add_meta_box( 'ts-demo-importer-posttype-testimonial-meta', __( 'Enter Details', 'ts-demo-importer-posttype' ), 'ts_demo_importer_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'ts_demo_importer_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function ts_demo_importer_posttype_bn_testimonial_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'ts_demo_importer_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory = get_post_meta( $post->ID, 'ts_demo_importer_posttype_testimonial_desigstory', true );
  $tes_phone = get_post_meta( $post->ID, 'meta-tes-phone', true );
  $tes_email = get_post_meta( $post->ID, 'meta-tes-email', true );
  $test_facebook = get_post_meta( $post->ID, 'meta-tes-facebookurl', true );
  $test_linkedin = get_post_meta( $post->ID, 'meta-tes-linkdenurl', true );
  $test_twitter = get_post_meta( $post->ID, 'meta-tes-twitterurl', true );
  $test_instagram = get_post_meta( $post->ID, 'meta-tes-instagram', true );
  $test_pinterest = get_post_meta( $post->ID, 'meta-tes-pinterest', true );
  ?>
  <div id="testimonials_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php esc_html_e( 'Designation', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="ts_demo_importer_posttype_testimonial_desigstory" id="ts_demo_importer_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php esc_html_e( 'Facebook Url', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-facebookurl" id="meta-tes-facebookurl" value="<?php echo esc_attr($test_facebook); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php esc_html_e( 'Linkedin Url', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-linkdenurl" id="meta-tes-linkdenurl" value="<?php echo esc_attr($test_linkedin); ?>" />
          </td>
        </tr>
        <tr id="meta-4">
          <td class="left">
            <?php esc_html_e( 'Twitter Url', 'ts-demo-importer-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-twitterurl" id="meta-tes-twitterurl" value="<?php echo esc_attr($test_twitter); ?>" />
          </td>
        </tr>
        <tr id="meta-6">
          <td class="left">
            <?php esc_html_e( 'Instagram Url', 'ts-demo-importer-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-instagram" id="meta-tes-instagram" value="<?php echo esc_attr($test_instagram); ?>" />
          </td>
        </tr>
        <tr id="meta-7">
          <td class="left">
            <?php esc_html_e( 'Pinterest Url', 'ts-demo-importer-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-pinterest" id="meta-tes-pinterest" value="<?php echo esc_attr($test_pinterest); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function ts_demo_importer_posttype_bn_metadesig_save( $post_id ) {
  if (!isset($_POST['ts_demo_importer_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['ts_demo_importer_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save phone.
  if( isset( $_POST[ 'ts_demo_importer_posttype_testimonial_desigstory' ] ) ) {
    update_post_meta( $post_id, 'ts_demo_importer_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'ts_demo_importer_posttype_testimonial_desigstory']) );
  }

  // Save Facebook
  if( isset( $_POST[ 'meta-tes-facebookurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-facebookurl', sanitize_text_field( $_POST['meta-tes-facebookurl'] ));
  }
  // Save Linkedin
  if( isset( $_POST[ 'meta-tes-linkdenurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-linkdenurl', sanitize_text_field( $_POST['meta-tes-linkdenurl'] ));
  }

  // Save Twitter
  if( isset( $_POST[ 'meta-tes-twitterurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-twitterurl', sanitize_text_field( $_POST['meta-tes-twitterurl'] ));
  }

  // Save Instagram
  if( isset( $_POST[ 'meta-tes-instagram' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-instagram', sanitize_text_field( $_POST['meta-tes-instagram'] ));
  }
  // Save Pinterest
  if( isset( $_POST[ 'meta-tes-pinterest' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-pinterest', sanitize_text_field( $_POST['meta-tes-pinterest'] ));
  }

}

add_action( 'save_post', 'ts_demo_importer_posttype_bn_metadesig_save' );

/*-------------------------------------- team-------------------------------------------*/
/* Adds a meta box for Designation */
function ts_demo_importer_posttype_bn_team_meta() {
    add_meta_box( 'ts_demo_importer_posttype_bn_meta', __( 'Enter Details','ts-demo-importer-posttype' ), 'ts_demo_importer_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'ts_demo_importer_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function ts_demo_importer_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ts_demo_importer_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $teacher_email = get_post_meta( $post->ID, 'meta-team-email', true );
    $teacher_phone = get_post_meta( $post->ID, 'meta-team-phone', true );
    $teacher_facebook = get_post_meta( $post->ID, 'meta-tfacebookurl', true );
    $teacher_linkedin = get_post_meta( $post->ID, 'meta-tlinkdenurl', true );
    $teacher_twitter = get_post_meta( $post->ID, 'meta-ttwitterurl', true );
    $teacher_desig = get_post_meta( $post->ID, 'meta-designation', true );
    $teacher_instagram = get_post_meta( $post->ID, 'meta-tinstagram', true );
    $teacher_pinterest = get_post_meta( $post->ID, 'meta-pinterest', true );
    ?>

    <div id="agent_custom_stuff">
        <table id="list-table">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-9">
                  <td class="left">
                    <?php esc_html_e( 'Designation', 'ts-demo-importer-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-designation" id="meta-designation" value="<?php echo esc_attr($teacher_desig); ?>" />
                  </td>
                </tr>

                <tr id="meta-1">
                  <td class="left">
                      <?php esc_html_e( 'Email', 'ts-demo-importer-posttype' )?>
                  </td>
                  <td class="left" >
                      <input type="text" name="meta-team-email" id="meta-team-email" value="<?php echo esc_attr($teacher_email); ?>" />
                  </td>
                </tr>
                <tr id="meta-1">
                  <td class="left">
                      <?php esc_html_e( 'Phone', 'ts-demo-importer-posttype' )?>
                  </td>
                  <td class="left" >
                      <input type="text" name="meta-team-phone" id="meta-team-phone" value="<?php echo esc_attr($teacher_phone); ?>" />
                  </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php esc_html_e( 'Facebook Url', 'ts-demo-importer-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tfacebookurl" id="meta-tfacebookurl" value="<?php echo esc_attr($teacher_facebook); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php esc_html_e( 'Linkedin Url', 'ts-demo-importer-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tlinkdenurl" id="meta-tlinkdenurl" value="<?php echo esc_attr($teacher_linkedin); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php esc_html_e( 'Twitter Url', 'ts-demo-importer-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-ttwitterurl" id="meta-ttwitterurl" value="<?php echo esc_attr($teacher_twitter); ?>" />
                  </td>
                </tr>

                <tr id="meta-7">
                  <td class="left">
                    <?php esc_html_e( 'Instagram Url', 'ts-demo-importer-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tinstagram" id="meta-tinstagram" value="<?php echo esc_attr($teacher_instagram); ?>" />
                  </td>
                </tr>
                <tr id="meta-8">
                  <td class="left">
                    <?php esc_html_e( 'Pinterest Url', 'ts-demo-importer-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-pinterest" id="meta-pinterest" value="<?php echo esc_attr($teacher_pinterest); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function ts_demo_importer_posttype_ex_bn_metadesig_save( $post_id ) {

    if( isset( $_POST[ 'meta-team-email' ] ) ) {
        update_post_meta( $post_id, 'meta-team-email', sanitize_text_field( $_POST['meta-team-email'] ));
    }
    if( isset( $_POST[ 'meta-team-phone' ] ) ) {
        update_post_meta( $post_id, 'meta-team-phone', sanitize_text_field( $_POST['meta-team-phone'] ));
    }

    // Save facebookurl
    if( isset( $_POST[ 'meta-tfacebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-tfacebookurl', sanitize_text_field( $_POST['meta-tfacebookurl'] ));
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-tlinkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-tlinkdenurl', sanitize_text_field( $_POST['meta-tlinkdenurl'] ));
    }
    if( isset( $_POST[ 'meta-ttwitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-ttwitterurl', sanitize_text_field( $_POST['meta-ttwitterurl'] ));
    }
    // Save Instagram
    if( isset( $_POST[ 'meta-tinstagram' ] ) ) {
      update_post_meta( $post_id, 'meta-tinstagram', sanitize_text_field( $_POST['meta-tinstagram'] ));
    }
    // Save Pinterest
    if( isset( $_POST[ 'meta-pinterest' ] ) ) {
      update_post_meta( $post_id, 'meta-pinterest', sanitize_text_field( $_POST['meta-pinterest'] ));
    }
    // Save designation
    if( isset( $_POST[ 'meta-designation' ] ) ) {
      update_post_meta( $post_id, 'meta-designation', sanitize_text_field( $_POST['meta-designation'] ));
    }
}
add_action( 'save_post', 'ts_demo_importer_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'ts_demo_importer_bn_meta_save' );
/* Saves the custom meta input */
function ts_demo_importer_bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'ts_demo_importer_posttype_team_featured' ] )) {
      update_post_meta( $post_id, 'ts_demo_importer_posttype_team_featured', sanitize_text_field(1));
  }else{
    update_post_meta( $post_id, 'ts_demo_importer_posttype_team_featured', sanitize_text_field(0));
  }
}


//  ------------- event ------------------------------
// ---------------event category start -------------
function ts_demo_importer_eventscategory() {

  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Categories', 'ts-demo-importer-posttype' ),
    'singular_name'     => __( 'Categories', 'ts-demo-importer-posttype' ),
    'search_items'      => __( 'Search cats', 'ts-demo-importer-posttype' ),
    'all_items'         => __( 'All Categories', 'ts-demo-importer-posttype' ),
    'parent_item'       => __( 'Parent Categories', 'ts-demo-importer-posttype' ),
    'parent_item_colon' => __( 'Parent Categories:', 'ts-demo-importer-posttype' ),
    'edit_item'         => __( 'Edit Categories', 'ts-demo-importer-posttype' ),
    'update_item'       => __( 'Update Categories', 'ts-demo-importer-posttype' ),
    'add_new_item'      => __( 'Add New Categories', 'ts-demo-importer-posttype' ),
    'new_item_name'     => __( 'New Categories Name', 'ts-demo-importer-posttype' ),
    'menu_name'         => __( 'Categories', 'ts-demo-importer-posttype' ),
  );
  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'has_archive'       => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'eventscategory' ),
  );
  register_taxonomy( 'eventscategory', array( 'events' ), $args );
}
// -------------- event Category end ----------------------------
// --------------- event tag start ---------------------
function ts_demo_importer_eventtags() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Tags', 'tc-feminine-pro-posttype' ),
    'singular_name'     => __( 'Tags', 'tc-feminine-pro-posttype' ),
    'search_items'      => __( 'Search Tags', 'tc-feminine-pro-posttype' ),
    'all_items'         => __( 'All Tags', 'tc-feminine-pro-posttype' ),
    'parent_item'       => __( 'Parent Tags', 'tc-feminine-pro-posttype' ),
    'parent_item_colon' => __( 'Parent Tags:', 'tc-feminine-pro-posttype' ),
    'edit_item'         => __( 'Edit Tags', 'tc-feminine-pro-posttype' ),
    'update_item'       => __( 'Update Tags', 'tc-feminine-pro-posttype' ),
    'add_new_item'      => __( 'Add New Tags', 'tc-feminine-pro-posttype' ),
    'new_item_name'     => __( 'New Tags', 'tc-feminine-pro-posttype' ),
    'menu_name'         => __( 'Tags', 'tc-feminine-pro-posttype' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'eventtags' )
  );

  register_taxonomy( 'eventtags', array( 'events' ), $args );
}

// --------------- event tag end ---------------------
// postmeta event start
// -----------event meta time---------
function ts_demo_importer_posttype_bn_event_posttype_meta_box() {
  add_meta_box( 'ts-demo-importer-posttype-event-loc-meta', __( 'Enter Details', 'ts-demo-importer-posttype' ), 'ts_demo_importer_posttype_bn_event_meta_callback', 'events', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'ts_demo_importer_posttype_bn_event_posttype_meta_box');
}
function ts_demo_importer_posttype_bn_event_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'ts_demo_importer_posttype_posttype_event_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  if(!empty($bn_stored_meta['ts_demo_importer_event_time'][0]))
      $ts_demo_importer_event_time = $bn_stored_meta['ts_demo_importer_event_time'][0];
    else
      $ts_demo_importer_event_time = '';
  if(!empty($bn_stored_meta['ts_demo_importer_event_location'][0]))
      $ts_demo_importer_event_location = $bn_stored_meta['ts_demo_importer_event_location'][0];
    else
      $ts_demo_importer_event_location = '';
  ?>
  <div id="ts_demo_importer_event_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Time', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="ts_demo_importer_event_time" id="ts_demo_importer_event_time" value="<?php echo esc_attr( $ts_demo_importer_event_time ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php _e( 'Location', 'ts-demo-importer-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="ts_demo_importer_event_location" id="ts_demo_importer_event_location" value="<?php echo esc_attr( $ts_demo_importer_event_location ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}
// postmeta event end

function add_eventscategory_image ( $taxonomy ) { ?>
  <div class="form-field term-group">
    <label for="eventscategory-image-id"><?php _e('Image', 'hero-theme'); ?></label>
    <input type="hidden" id="eventscategory-image-id" name="eventscategory-image-id" class="custom_media_url" value="">
    <div id="eventscategory-image-wrapper"></div>
    <p>
      <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
      <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
   </p>
  </div>
<?php
}

function save_category_image ( $term_id, $tt_id ) {
  if( isset( $_POST['eventscategory-image-id'] ) && '' !== $_POST['eventscategory-image-id'] ){
    $image = $_POST['eventscategory-image-id'];
    add_term_meta( $term_id, 'eventscategory-image-id', $image, true );
  }
}

function update_category_image ( $term, $taxonomy ) { ?>
  <tr class="form-field term-group-wrap">
    <th scope="row">
      <label for="eventscategory-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
    </th>
    <td>
      <?php $image_id = get_term_meta ( $term -> term_id, 'eventscategory-image-id', true ); ?>
      <input type="hidden" id="eventscategory-image-id" name="eventscategory-image-id" value="<?php echo $image_id; ?>">
      <div id="eventscategory-image-wrapper">
        <?php if ( $image_id ) { ?>
          <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
        <?php } ?>
      </div>
      <p>
        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
      </p>
    </td>
  </tr>
<?php
}

function updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['eventscategory-image-id'] ) && '' !== $_POST['eventscategory-image-id'] ){
     $image = $_POST['eventscategory-image-id'];
     update_term_meta ( $term_id, 'eventscategory-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'eventscategory-image-id', '' );
   }
 }

function load_media() {
  wp_enqueue_media();
}

function add_script() { ?>
  <script>
    jQuery(document).ready( function($) {
      function ct_media_upload(button_class) {
        var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
        $('body').on('click', button_class, function(e) {
          var button_id = '#'+$(this).attr('id');
          var send_attachment_bkp = wp.media.editor.send.attachment;
          var button = $(button_id);
          _custom_media = true;
          wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
              $('#eventscategory-image-id').val(attachment.id);
              $('#eventscategory-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
              $('#eventscategory-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
            } else {
              return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
           }
        wp.media.editor.open(button);
        return false;
      });
    }
    ct_media_upload('.ct_tax_media_button.button');
    $('body').on('click','.ct_tax_media_remove',function(){
      $('#eventscategory-image-id').val('');
      $('#eventscategory-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
    });
    $(document).ajaxComplete(function(event, xhr, settings) {
      var queryStringArr = settings.data.split('&');
      if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
        var xml = xhr.responseXML;
        $response = $(xml).find('term_id').text();
        if($response!=""){
          // Clear the thumb image
          $('#eventscategory-image-wrapper').html('');
        }
      }
    });
  });
</script>
<?php }
