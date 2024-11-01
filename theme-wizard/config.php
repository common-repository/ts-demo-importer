<?php
/**
 * Settings for theme wizard
 *
 * @package Tdi_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'TDI_WHIZZIE_DIR' ) ) {
	define( 'TDI_WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Tdi_Whizzie class and other dependencies
require trailingslashit( TDI_WHIZZIE_DIR ) . 'whizzie.php';
// Gets the theme object
$current_plugin = get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE );
$plugin_title = $current_plugin['Name'];


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['page_slug'] 	= 'ts-demo-importer';
$config['page_title']	= 'TS Setup Wizard';
$config['page_heading']	= 'TS Demo Importer';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro', // ID for section - don't rename
		'title'			=> __( 'Welcome to ', 'ts-demo-importer' ) . $plugin_title, // Section title
		'icon'			=> 'dashboard', // Uses Dashicons
		'button_text'	=> __( 'Start Now', 'ts-demo-importer' ), // Button text
		'can_skip'		=> false // Show a skip button?
	),

	'themes' => array(
		'id'			=> 'themes',
		'title'			=> __( 'Themes', 'ts-demo-importer' ),
		'icon'				=>	'admin-appearance',
		'button_text'	=> __( 'Install Themes', 'ts-demo-importer' ),
		'can_skip'		=> false,
		'imports'     =>  array(
			array(
				'card_text' => 'Multi Advance',
				'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_one.png',
				'page'      =>  1
			),
			array(
				'card_text' => 'Advance Marketing Agency',
				'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_two.png',
				'page'      =>  2
			)
		)
  ),

	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'ts-demo-importer' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'ts-demo-importer' ),
		'can_skip'		=> true
	),


	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'ts-demo-importer' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Import Demo', 'ts-demo-importer' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'ts-demo-importer' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Tdi_Whizzie' ) ) {
	$Tdi_Whizzie = new Tdi_Whizzie( $config );
}
