<?php
/*
 Title Banner Image
*/

define( 'TITLE_BANNER_IMAGE_VERSION', '0.1' );

/** Add side meta box for Banner image **/
function title_banner_image_add_custom_meta_boxes() {

	// Define the Banner Image for custom post, posts & pages.
	$post_types = array ( 'post', 'page', 'services', 'projects', 'team', 'testimonials' );
	add_meta_box(
		'title_banner_image_metabox',
		__( 'Banner Image', 'title-banner-image' ),
		'title_banner_image_render_metabox',
		$post_types,
		'side'
	);

}

add_action('add_meta_boxes', 'title_banner_image_add_custom_meta_boxes');

function title_banner_image_render_metabox($post_id) {

	wp_nonce_field(basename(__FILE__), 'title_banner_image_metabox_nonce');

	$title_banner_image_title_on_banner_on_off = get_post_meta($post_id->ID, 'title_banner_image_title_on_banner_on_off', true);
	$title_banner_image_title_hide_or_show_breadcrumb = get_post_meta($post_id->ID, 'title_banner_image_title_hide_or_show_breadcrumb', true);
	$title_banner_image_title_below_on_off = get_post_meta($post_id->ID, 'title_banner_image_title_below_on_off', true);
	$title_banner_image_wp_custom_attachment = get_post_meta($post_id->ID, 'title_banner_image_wp_custom_attachment', true);
	$title_banner_image_title_short = get_post_meta( $post_id->ID, 'title_banner_image_title_short', true );

	$banner_url = '';
	if ( isset( $title_banner_image_wp_custom_attachment ) ) {
		$banner_url = $title_banner_image_wp_custom_attachment;
	}

	?>
	<div class="meta-wrapper">
		<div>
			<p><strong><?php esc_html_e("Upload Image","title-banner-image") ?></strong></p>
			<input type="hidden" class="img widefat" name="title_banner_image_wp_custom_attachment" id="title_banner_image_wp_custom_attachment" value="<?php echo esc_url( $banner_url ); ?>" />
			<input type="button" class="select-img button button-primary" value="<?php esc_attr_e( 'Upload', 'title-banner-image' ); ?>" data-uploader_title="<?php esc_attr_e( 'Select Image', 'title-banner-image' ); ?>" data-uploader_button_text="<?php esc_attr_e( 'Choose Image', 'title-banner-image' ); ?>" />
			<?php
			$wrap_style = '';
			if ( empty( $banner_url ) ) {
				$wrap_style = ' style="display:none;" ';
			}
			?>
			<div class="custom-theme-preview-wrap" <?php echo $wrap_style; ?>>
				<img src="<?php echo esc_url( $banner_url ); ?>" alt="" />
			</div>
		</div>

		<p><input type="checkbox" name="wp_custom_attachment_remove" id="wp_custom_attachment_remove" value="on" />&nbsp;<?php esc_html_e("Remove banner","title-banner-image") ?></p>
		<hr />
		<p>
			<input type="checkbox" name="title_banner_image_title_on_banner_on_off" id="title_banner_image_title_on_banner_on_off" value="on" <?php checked( $title_banner_image_title_on_banner_on_off, 'on' ); ?> />
			&nbsp;<?php esc_html_e("Show Title on the banner","title-banner-image") ?>
		</p>

		<p><input type="checkbox" name="title_banner_image_title_below_on_off" id="title_banner_image_title_below_on_off" value="on" <?php checked( $title_banner_image_title_below_on_off, 'on' ); ?> />&nbsp;<?php esc_html_e("Show Title below banner","title-banner-image") ?></p>
		<p><input type="checkbox" name="title_banner_image_title_hide_or_show_breadcrumb" id="title_banner_image_title_hide_or_show_breadcrumb" value="on" <?php checked( $title_banner_image_title_hide_or_show_breadcrumb, 'on' ); ?> />&nbsp;<?php esc_html_e("Show Breadcrumb","title-banner-image") ?></p>

		<p><?php esc_html_e("Page Short Title","title-banner-image") ?><br><input type="text" name="title_banner_image_title_short" id="title_banner_image_title_short" value="<?php echo esc_attr( $title_banner_image_title_short ); ?>" /></p>

	</div><!-- .meta-wrapper -->
	<?php
}

function title_banner_image_save_custom_meta_data($post_id) {
	if (!isset($_POST['title_banner_image_metabox_nonce']) || !wp_verify_nonce($_POST['title_banner_image_metabox_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	$title_banner_image_title_on_banner_on_off = ( isset( $_POST['title_banner_image_title_on_banner_on_off'] ) && 'on' === $_POST['title_banner_image_title_on_banner_on_off'] ) ? 'on' : '';
	update_post_meta($post_id, 'title_banner_image_title_on_banner_on_off', $title_banner_image_title_on_banner_on_off);

	$title_banner_image_title_hide_or_show_breadcrumb = ( isset( $_POST['title_banner_image_title_hide_or_show_breadcrumb'] ) && 'on' === $_POST['title_banner_image_title_hide_or_show_breadcrumb'] ) ? 'on' : '';
	update_post_meta($post_id, 'title_banner_image_title_hide_or_show_breadcrumb', $title_banner_image_title_hide_or_show_breadcrumb);

	$title_banner_image_title_below_on_off = ( isset( $_POST['title_banner_image_title_below_on_off'] ) && 'on' === $_POST['title_banner_image_title_below_on_off'] ) ? 'on' : '';
	update_post_meta($post_id, 'title_banner_image_title_below_on_off', $title_banner_image_title_below_on_off);

	if ( isset( $_POST['title_banner_image_wp_custom_attachment'] ) ) {
		$upload = sanitize_text_field( $_POST['title_banner_image_wp_custom_attachment'] );
		update_post_meta($post_id, 'title_banner_image_wp_custom_attachment', $upload);
	}

	$wp_custom_attachment_remove = ( isset( $_POST['wp_custom_attachment_remove'] ) && 'on' === $_POST['wp_custom_attachment_remove'] ) ? 'on' : '';

	if ( 'on' === $wp_custom_attachment_remove ) {
		// Remove banner image.
		update_post_meta($post_id, 'title_banner_image_wp_custom_attachment', '');
	}

	if( isset( $_POST[ 'title_banner_image_title_short' ] ) ) {
    	update_post_meta( $post_id, 'title_banner_image_title_short', sanitize_text_field($_POST[ 'title_banner_image_title_short']) );
  	}

}

add_action('save_post', 'title_banner_image_save_custom_meta_data');

function title_banner_image_metabox_enqueue($hook) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_style('title-banner-image-metabox', plugin_dir_url( __FILE__ ) . '/title-banner-image.css', array(), TS_DEMO_IMPOTER );
		wp_enqueue_script('title-banner-image-metabox', plugin_dir_url( __FILE__ ) . '/title-banner-image.js', array('jquery'),TS_DEMO_IMPOTER);
	}
}

add_action('admin_enqueue_scripts', 'title_banner_image_metabox_enqueue');
