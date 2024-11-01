<?php
/**
 * Alpha Color Picker.
 * @package TS Demo Importer
 */
if ( ! class_exists( 'WP_Customize_Control' ) ){
	return;
}
/**
 * Sortable Repeater Custom Control
 *
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @link https://github.com/maddisondesigns
 */
class ts_demo_importer_Repeater_Custom_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'sortable_repeater';
	/**
		 * Button labels
		 */
	public $button_labels = array();
	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
		// Merge the passed button labels with our default labels
		$this->button_labels = wp_parse_args( $this->button_labels,
			array(
				'add' => __( 'Add', 'ts-demo-importer' ),
			)
		);
	}
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {

		// wp_enqueue_script( 'themeshopy_custom_controls_js', TS_DEMO_IMPOTER_URL . 'inc/customize/controls/customize-repeater/js/customize-repeater.js', array( 'jquery' ),TS_DEMO_IMPOTER, true );
		$template = wp_get_theme()->get( 'TextDomain' );

		wp_register_script('themeshopy_custom_controls_js', TS_DEMO_IMPOTER_URL . 'inc/customize/controls/customize-repeater/js/customize-repeater.js', 		array('jquery'),TS_DEMO_IMPOTER, true);
			wp_localize_script(
				'themeshopy_custom_controls_js',
				'themeshopy_custom_controls_customscripts_obj',
				array(
					'theme_text_domain' => wp_get_theme()->get( 'TextDomain' )
				)
			);
			wp_enqueue_script( 'themeshopy_custom_controls_js' );



		wp_enqueue_style( 'themeshopy_custom_controls_css', TS_DEMO_IMPOTER_URL. 'inc/customize/controls/customize-repeater/css/customize-repeater.css', array(), TS_DEMO_IMPOTER );
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		$template = wp_get_theme()->get( 'TextDomain' );
		// multi-adnvance
		if( $template == 'multi-advance' ){
			$section_name = array("our-records","about-us","our-skills","our-services","banner","our-projects","features","team","hire-us","pricing-plan","quote-banner","consult-us","additional-services","testimonials","our-brands","skills-showcase","latest-news","contact-map","content-area");
		} elseif ( $template == 'advance-marketing-agency' ) {
			$section_name = array("about-us","our-skills","our-services","banner","our-projects","features","team","hire-us","pricing-plan","quote-banner","consult-us","additional-services","testimonials","our-brands","skills-showcase","latest-news","contact-map","content-area");
		} elseif ( $template == 'advance-consultancy' ) {
			$section_name = array("about-us","our-skills","our-services","banner","our-projects","personalized-support","best-services-offered","our-brands","skills-showcase","pricing-plan","testimonials","contact-map","content-area","latest-news","interested-banner");
		}elseif ( $template == 'advance-training-academy' ) {
			$section_name = array("our-services","about-us","personalized-support","course-programs","all-program","founder","annual-meetup","upcoming-events","video","latest-news");
		}

		$string_array = rtrim(implode(',', $section_name), ',');
	?>
	    <div class="sortable_repeater_control">
			<?php if( !empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } ?>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $string_array ); ?>" class="customize-control-sortable-repeater" <?php echo esc_url($this->link()); ?> />
			<div class="sortable">
				<div class="repeater">
					<input type="text" value="" class="repeater-input" placeholder="" disabled="disabled" /><span class="dashicons dashicons-sort"></span>
				</div>
			</div>
		</div>
	<?php
	}
}
