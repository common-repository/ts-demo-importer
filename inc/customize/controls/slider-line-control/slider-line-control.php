<?php

if ( ! class_exists( 'WP_Customize_Control' ) ){
	return;
}
	/**
	 * Toggle Switch Custom Control
	 *
	 *  */
	class ts_demo_importer_Slider_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php echo esc_url($this->link()); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
		<?php
		}
	}
	function ts_demo_importer_slider_line_script() {

	    wp_enqueue_script( 'custom-toggle-switch', TS_DEMO_IMPOTER_URL . 'inc/customize/controls/slider-line-control/slider-line-control.js', array( 'jquery' ), TS_DEMO_IMPOTER, true );
		wp_enqueue_style( 'custom-toggle-switch-js', TS_DEMO_IMPOTER_URL. 'inc/customize/controls/slider-line-control/slider-line-control.css', array(), TS_DEMO_IMPOTER );

	}
	add_action( 'customize_controls_enqueue_scripts', 'ts_demo_importer_slider_line_script' );
?>
