<?php
/**
 * TS Demo Importer Customizer Custom Controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Toggle Switch Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class ts_demo_importer_Toggle_Switch_Custom_control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){

			wp_enqueue_style( 'ts_demo_importer_custom_controls_css', TS_DEMO_IMPOTER_URL. 'assets/css/customizer.css', array() ,TS_DEMO_IMPOTER );
			wp_enqueue_script( 'ts_demo_importer_custom_controls_js', TS_DEMO_IMPOTER_URL . 'assets/js/customize-controls.js', array('jquery'), TS_DEMO_IMPOTER, true);
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php echo esc_url( $this->link() ); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

// Image Toggle Radio Buttpon
	class ts_demo_importer_Image_Radio_Control extends WP_Customize_Control {

	    public function render_content() {

	        if (empty($this->choices))
	            return;

	        $name = '_customize-radio-' . $this->id;
	        ?>
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <ul class="controls" id='ts-img-container'>
	            <?php
	            foreach ($this->choices as $value => $label) :
	                $class = ($this->value() == $value) ? 'ts-radio-img-selected ts-radio-img-img' : 'ts-radio-img-img';
	                ?>
	                <li style="display: inline;">
	                    <label>
	                        <input <?php echo esc_url($this->link()); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	echo esc_url($this->link());
	                          	checked($this->value(), $value);
	                          	?> />
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>
	        <?php
	    }
	}


	/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'ts_demo_importer_switch_sanitization' ) ) {
		function ts_demo_importer_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Text sanitization
	 *
	 * @param  string	Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string	Sanitized input
	 */
	if ( ! function_exists( 'text_sanitization' ) ) {
		function text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false) {
				$input = explode( ',', $input );
			}
			if( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[$key] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			}
			else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Alpha Color (Hex, RGB & RGBa) sanitization
	 *
	 * @param  string	Input to be sanitized
	 * @return string	Sanitized input
	 */
	if ( ! function_exists( 'ts_demo_importer_hex_rgba_sanitization' ) ) {
		function ts_demo_importer_hex_rgba_sanitization( $input, $setting ) {
			if ( empty( $input ) || is_array( $input ) ) {
				return $setting->default;
			}

			if ( false === strpos( $input, 'rgb' ) ) {
				// If string doesn't start with 'rgb' then santize as hex color
				$input = sanitize_hex_color( $input );
			} else {
				if ( false === strpos( $input, 'rgba' ) ) {
					// Sanitize as RGB color
					$input = str_replace( ' ', '', $input );
					sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
					$input = 'rgb(' . ts_demo_importer_in_range( $red, 0, 255 ) . ',' . ts_demo_importer_in_range( $green, 0, 255 ) . ',' . ts_demo_importer_in_range( $blue, 0, 255 ) . ')';
				}
				else {
					// Sanitize as RGBa color
					$input = str_replace( ' ', '', $input );
					sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
					$input = 'rgba(' . ts_demo_importer_in_range( $red, 0, 255 ) . ',' . ts_demo_importer_in_range( $green, 0, 255 ) . ',' . ts_demo_importer_in_range( $blue, 0, 255 ) . ',' . ts_demo_importer_in_range( $alpha, 0, 1 ) . ')';
				}
			}
			return $input;
		}
	}

	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number	Input to be sanitized
	 * @return number	Sanitized input
	 */
	if ( ! function_exists( 'ts_demo_importer_in_range' ) ) {
		function ts_demo_importer_in_range( $input, $min, $max ){
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
			return $input;
		}
	}

}
