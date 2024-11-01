<?php
/**
 * Custom About us Widget
 */

class ts_demo_importer_CTA_Banner_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'ts_demo_importer_CTA_Banner_Widget',
			__('Support Banner', 'ts-demo-importer'),
			array( 'description' => __( 'Widget for supprt section in footer', 'ts-demo-importer' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		?>
		<aside class="widget">
			<?php
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$description = isset( $instance['description'] ) ? $instance['description'] : '';
			$upload_image = isset( $instance['upload_image'] ) ? $instance['upload_image'] : '';

	        echo '<div class="support_widget">'; ?>
	        <div class="media">
	        	
	        	<div class="media-body">
			        <?php if(!empty($title) ){ ?>
			        	<h6 class="cta_banner_title"><?php echo esc_html($title); ?></h6>
			        <?php } ?>
				    <?php if(!empty($description) ){ ?>
				    	<span class="cta_banner_text"><?php echo esc_html($description); ?></span>
				    <?php } ?>
				</div>
				<img src="<?php echo esc_url($upload_image);?>" alt="<?php echo esc_html($title); ?>">
			</div>
	        <?php echo '</div>';
			?>
		</aside>
		<?php
	}
	
	// Widget Backend 
	public function form( $instance ) {	

		$title= ''; $author = ''; $description= ''; $read_more_text = ''; $read_more_url = ''; $upload_image = '';

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$description = isset( $instance['description'] ) ? $instance['description'] : '';
		$upload_image = isset( $instance['upload_image'] ) ? $instance['upload_image'] : '';
	?>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','ts-demo-importer'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    	</p>

    	<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e( 'Content:','ts-demo-importer' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" type="text"  value="<?php echo esc_attr( $description ); ?>" ><?php if (!empty($description))  { echo esc_html($description); } ?></textarea>
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'upload_image' )); ?>"><?php esc_html_e( 'Image Url:','ts-demo-importer'); ?></label>
		<?php
			if ( $upload_image != '' ) :
			echo '<img class="custom_media_image" src="' . esc_url($upload_image) . '" style="margin:10px 0;padding:0;max-width:100%;float:left;display:inline-block" /><br />';
			endif;
		?>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'upload_image' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'upload_image' )); ?>" type="text" value="<?php echo esc_url( $upload_image ); ?>" />
	   	</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();	
		$instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
		$instance['description'] = (!empty($new_instance['description']) ) ? strip_tags($new_instance['description']) : '';

        $instance['upload_image'] = ( ! empty( $new_instance['upload_image'] ) ) ? $new_instance['upload_image'] : '';

		return $instance;
	}
}
// Register and load the widget
function ts_demo_importer_cta_banner_load_widget() {
	register_widget( 'ts_demo_importer_CTA_Banner_Widget' );
}
add_action( 'widgets_init', 'ts_demo_importer_cta_banner_load_widget' );