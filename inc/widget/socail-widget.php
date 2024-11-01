<?php
/**
 * Custom Social Widget
 */
?>
<?php 
//custom socila icons
class VW_Startup_Pro_Social_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'VW_Bakery_Social_Widget', 
			// Widget name will appear in UI
			__('Social Icon', 'multi-advance'), 
			// Widget description
			array( 'description' => __( 'Widget for Social icons section', 'multi-advance' ), ) 
		);
	}
// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		?>
		<div class="social_widget">
		<?php
		$facebook = ''; $twitter = '';$google = ''; $linkedin = '';  $pinterest = '';$tumblr = ''; $instagram = ''; $youtube = '';
		
		$facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $google = $instance['google'];
        $linkedin = $instance['linkedin'];
        $pinterest = $instance['pinterest'];
        $tumblr = $instance['tumblr'];
        $instagram = $instance['instagram'];
        $youtube = $instance['youtube'];
 
        echo '<div class="custom-social-icons">';
	        if(!empty($facebook) ){ ?><a class="custom_facebook fff" href=" <?php echo esc_url($instance['facebook']); ?>"><i class="fab fa-facebook-f"></i></a><?php }
	        if(!empty($twitter) ){ ?><a class="custom_twitter" href="<?php echo esc_url($instance['twitter']); ?>"><i class="fab fa-twitter"></i></a><?php }
	        if(!empty($google) ){ ?><a class="custom_google" href="<?php echo esc_url($instance['google']); ?>"><i class="fab fa-google-plus-g"></i></a><?php }
	        if(!empty($linkedin) ){ ?><a class="custom_linkedin" href="<?php echo esc_url($instance['linkedin']); ?>"><i class="fab fa-linkedin-in"></i></a><?php }
	        if(!empty($pinterest) ){ ?><a class="custom_pinterest" href="<?php echo esc_url($instance['pinterest']); ?>"><i class="fab fa-pinterest-p"></i></a><?php }
	        if(!empty($tumblr) ){ ?><a class="custom_tumblr" href="<?php echo esc_url($instance['tumblr']); ?>"><i class="fab fa-tumblr"></i></a><?php }
	        if(!empty($instagram) ){ ?><a class="custom_instagram" href="<?php echo esc_url($instance['instagram']); ?>"><i class="fab fa-instagram"></i></a><?php }
	        if(!empty($youtube) ){ ?><a class="custom_youtube" href="<?php echo esc_url($instance['youtube']); ?>"><i class="fab fa-youtube"></i></a><?php }
	        echo '</div>';
			?>
		</div>

		<?php
			// This is where you run the code and display the output
			//echo __( 'Hello, World!', 'multi-advance' );
			//echo $args['after_widget'];
	}
		
	// Widget Backend 
	public function form( $instance ) {

        if ( isset( $instance[ 'title' ] ) ) {
			esc_html($title = $instance[ 'title' ]);
		}
		else {
			esc_html($title = '');
		}

		if ( isset( $instance[ 'facebook' ] ) ) {
			esc_html($facebook = $instance[ 'facebook' ]);
		}
		else {
			esc_html($facebook = '');
		}

		if ( isset( $instance[ 'instagram' ] ) ) {
			esc_html($instagram = $instance[ 'instagram' ]);
		}
		else {
			esc_html($instagram = '');
		}

		if ( isset( $instance[ 'twitter' ] ) ) {
			esc_html($twitter = $instance[ 'twitter' ]);
		}
		else {
			esc_html($twitter = '');
		}

		if ( isset( $instance[ 'google' ] ) ) {
			esc_html($google = $instance[ 'google' ]);
		}
		else {
			esc_html($google = '');
		}

		if ( isset( $instance[ 'linkedin' ] ) ) {
			esc_html($linkedin = $instance[ 'linkedin' ]);
		}
		else {
			esc_html($linkedin = '');
		}

		if ( isset( $instance[ 'pinterest' ] ) ) {
			esc_html($pinterest = $instance[ 'pinterest' ]);
		}
		else {
			esc_html($pinterest = '');
		}

		if ( isset( $instance[ 'tumblr' ] ) ) {
			esc_html($tumblr = $instance[ 'tumblr' ]);
		}
		else {
			esc_html($tumblr = '');
		}

		if ( isset( $instance[ 'youtube' ] ) ) {
			esc_html($youtube = $instance[ 'youtube' ]);
		}
		else {
			esc_html($youtube = '');
		}

		?>	
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('google')); ?>"><?php esc_html_e('Google+:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('google')); ?>" name="<?php echo esc_attr($this->get_field_name('google')); ?>" type="text" value="<?php echo esc_attr($google); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php esc_html_e('Tumblr:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>">
			</p>
			<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:','multi-advance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
			</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $instance['google'] = (!empty($new_instance['google']) ) ? strip_tags($new_instance['google']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? strip_tags($new_instance['linkedin']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest']) ) ? strip_tags($new_instance['pinterest']) : '';
        $instance['tumblr'] = (!empty($new_instance['tumblr']) ) ? strip_tags($new_instance['tumblr']) : '';
         $instance['youtube'] = (!empty($new_instance['youtube']) ) ? strip_tags($new_instance['youtube']) : '';
		 return $instance;
	}
} // Class VW_Bakery_Social_Widget ends here
// Register and load the widget
function vw_startup_pro_custom_load_widget() {
	register_widget( 'VW_Startup_Pro_Social_Widget' );
}
add_action( 'widgets_init', 'vw_startup_pro_custom_load_widget' );