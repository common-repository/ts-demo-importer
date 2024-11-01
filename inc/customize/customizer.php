<?php
//  =============================
//  = Default Theme Customizer Settings  =

function vwthemes_customize_register( $wp_customize ) {
    $wp_customize->add_panel( 'ts_demo_importer_panel_id', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Premium Settings', 'ts-demo-importer' ),
        'description' => __( 'Description of what this panel does.', 'ts-demo-importer' ),
    ) );

    $font_array = array(
        '' => __( 'No Fonts', 'ts-demo-importer' ),
        'Abril Fatface' => __( 'Abril Fatface', 'ts-demo-importer' ),
        'Acme' => __( 'Acme', 'ts-demo-importer' ),
        'Anton' => __( 'Anton', 'ts-demo-importer' ),
        'Architects Daughter' => __( 'Architects Daughter', 'ts-demo-importer' ),
        'Arimo' => __( 'Arimo', 'ts-demo-importer' ),
        'Arsenal' => __( 'Arsenal', 'ts-demo-importer' ),
        'Arvo' => __( 'Arvo', 'ts-demo-importer' ),
        'Alegreya' => __( 'Alegreya', 'ts-demo-importer' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'ts-demo-importer' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'ts-demo-importer' ),
        'Bangers' => __( 'Bangers', 'ts-demo-importer' ),
        'Boogaloo' => __( 'Boogaloo', 'ts-demo-importer' ),
        'Bad Script' => __( 'Bad Script', 'ts-demo-importer' ),
        'Bitter' => __( 'Bitter', 'ts-demo-importer' ),
        'Bree Serif' => __( 'Bree Serif', 'ts-demo-importer' ),
        'BenchNine' => __( 'BenchNine', 'ts-demo-importer' ),
        'Cabin' => __( 'Cabin', 'ts-demo-importer' ),
        'Cardo' => __( 'Cardo', 'ts-demo-importer' ),
        'Courgette' => __( 'Courgette', 'ts-demo-importer' ),
        'Cherry Swash' => __( 'Cherry Swash', 'ts-demo-importer' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'ts-demo-importer' ),
        'Crimson Text' => __( 'Crimson Text', 'ts-demo-importer' ),
        'Cuprum' => __( 'Cuprum', 'ts-demo-importer' ),
        'Cookie' => __( 'Cookie', 'ts-demo-importer' ),
        'Chewy' => __( 'Chewy', 'ts-demo-importer' ),
        'Days One' => __( 'Days One', 'ts-demo-importer' ),
        'Dosis' => __( 'Dosis', 'ts-demo-importer' ),
        'Economica' => __( 'Economica', 'ts-demo-importer' ),
        'Fredoka One' => __( 'Fredoka One', 'ts-demo-importer' ),
        'Fjalla One' => __( 'Fjalla One', 'ts-demo-importer' ),
        'Francois One' => __( 'Francois One', 'ts-demo-importer' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'ts-demo-importer' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'ts-demo-importer' ),
        'Great Vibes' => __( 'Great Vibes', 'ts-demo-importer' ),
        'Handlee' => __( 'Handlee', 'ts-demo-importer' ),
        'Hammersmith One' => __( 'Hammersmith One', 'ts-demo-importer' ),
        'Inconsolata' => __( 'Inconsolata', 'ts-demo-importer' ),
        'Indie Flower' => __( 'Indie Flower', 'ts-demo-importer' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'ts-demo-importer' ),
        'Julius Sans One' => __( 'Julius Sans One', 'ts-demo-importer' ),
        'Josefin Slab' => __( 'Josefin Slab', 'ts-demo-importer' ),
        'Josefin Sans' => __( 'Josefin Sans', 'ts-demo-importer' ),
        'Kanit' => __( 'Kanit', 'ts-demo-importer' ),
        'Lobster' => __( 'Lobster', 'ts-demo-importer' ),
        'Lato' => __( 'Lato', 'ts-demo-importer' ),
        'Lora' => __( 'Lora', 'ts-demo-importer' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'ts-demo-importer' ),
        'Lobster Two' => __( 'Lobster Two', 'ts-demo-importer' ),
        'Merriweather' => __( 'Merriweather', 'ts-demo-importer' ),
        'Monda' => __( 'Monda', 'ts-demo-importer' ),
        'Montserrat' => __( 'Montserrat', 'ts-demo-importer' ),
        'Muli' => __( 'Muli', 'ts-demo-importer' ),
        'Marck Script' => __( 'Marck Script', 'ts-demo-importer' ),
        'Noto Serif' => __( 'Noto Serif', 'ts-demo-importer' ),
        'Open Sans' => __( 'Open Sans', 'ts-demo-importer' ),
        'Overpass' => __( 'Overpass', 'ts-demo-importer' ),
        'Overpass Mono' => __( 'Overpass Mono', 'ts-demo-importer' ),
        'Oxygen' => __( 'Oxygen', 'ts-demo-importer' ),
        'Orbitron' => __( 'Orbitron', 'ts-demo-importer' ),
        'Patua One' => __( 'Patua One', 'ts-demo-importer' ),
        'Pacifico' => __( 'Pacifico', 'ts-demo-importer' ),
        'Padauk' => __( 'Padauk', 'ts-demo-importer' ),
        'Playball' => __( 'Playball', 'ts-demo-importer' ),
        'Playfair Display' => __( 'Playfair Display', 'ts-demo-importer' ),
        'PT Sans' => __( 'PT Sans', 'ts-demo-importer' ),
        'Philosopher' => __( 'Philosopher', 'ts-demo-importer' ),
        'Permanent Marker' => __( 'Permanent Marker', 'ts-demo-importer' ),
        'Poiret One' => __( 'Poiret One', 'ts-demo-importer' ),
        'Quicksand' => __( 'Quicksand', 'ts-demo-importer' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'ts-demo-importer' ),
        'Raleway' => __( 'Raleway', 'ts-demo-importer' ),
        'Rubik' => __( 'Rubik', 'ts-demo-importer' ),
        'Rokkitt' => __( 'Rokkitt', 'ts-demo-importer' ),
        'Russo One' => __( 'Russo One', 'ts-demo-importer' ),
        'Righteous' => __( 'Righteous', 'ts-demo-importer' ),
        'Stylish' => __( 'Stylish', 'ts-demo-importer' ),
        'Slabo' => __( 'Slabo', 'ts-demo-importer' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'ts-demo-importer' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'ts-demo-importer'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'ts-demo-importer' ),
        'Sacramento' => __( 'Sacramento', 'ts-demo-importer' ),
        'Shrikhand' => __( 'Shrikhand', 'ts-demo-importer' ),
        'Tangerine' => __( 'Tangerine', 'ts-demo-importer' ),
        'Ubuntu' => __( 'Ubuntu', 'ts-demo-importer' ),
        'VT323' => __( 'VT323', 'ts-demo-importer' ),
        'Varela Round' => __( 'Varela Round', 'ts-demo-importer' ),
        'Vampiro One' => __( 'Vampiro One', 'ts-demo-importer' ),
        'Vollkorn' => __( 'Vollkorn', 'ts-demo-importer' ),
        'Volkhov' => __( 'Volkhov', 'ts-demo-importer' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'ts-demo-importer' )
    );

    // new code start
    


    // new code end

    include_once(plugin_dir_path(__FILE__) . '/controls/customizer-text-radio-button/class/customizer-text-radio-button.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/customizer-notice/class/customizer-notice.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/customizer-seperator/class/customizer-seperator.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/social-icons/social-icon-picker.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/slider-line-control/slider-line-control.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/customize-repeater/customize-repeater.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/alpha-color-picker.php' );

    include_once(plugin_dir_path(__FILE__) . 'controls/admin/customize-texteditor-control.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/custom-controls.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/button-controls.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/alpha-color-picker.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/dimensions-control/dimensions-control.php' );
    include_once(plugin_dir_path(__FILE__) . 'controls/tab-control/tab-control.php' );

    include_once( plugin_dir_path(__FILE__) . 'sections/customizer-general-settings.php' );
    include_once( plugin_dir_path(__FILE__) . 'sections/customizer-part-slide.php' );
    include_once( plugin_dir_path(__FILE__) . 'sections/customizer-part-home.php' );
    include_once( plugin_dir_path(__FILE__) . 'sections/customizer-part-inner-page.php' );

    $wp_customize->register_control_type('ts_demo_importer_Tab_Control');
    $wp_customize->register_control_type('ts_demo_importer_Dimensions_Control');

}
add_action('customize_register','vwthemes_customize_register');
