<?php

  $ts_demo_importer_license_key = get_option( str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key' );

  $template = wp_get_theme()->get( 'TextDomain' );

  $license_active = true;
  if ( !$ts_demo_importer_license_key ) {
    $license_active = false;
  } elseif (!empty($ts_demo_importer_license_key) && $ts_demo_importer_license_key['license_key'] == '') {
    $license_active = false;
  }

  // ------------- Our Records Multi Advance--------------
  if( $template == 'multi-advance' ){
    $wp_customize->add_section('ts_demo_importer_our_records',array(
      'title' => __('Our Records','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $record_number = get_theme_mod('ts_demo_importer_our_records_number');

    $ts_demo_importer_our_records_box_settings = array();
    $ts_demo_importer_our_records_no = array();
    $ts_demo_importer_our_records_title = array();
    $ts_demo_importer_our_records_url = array();

    for($i=1; $i<=$record_number ;$i++){
      $ts_demo_importer_our_records_box_settings[$i] = 'ts_demo_importer_our_records_box_settings'.$i;
      $ts_demo_importer_our_records_no[$i] = 'ts_demo_importer_our_records_no'.$i;
      $ts_demo_importer_our_records_title[$i] = 'ts_demo_importer_our_records_title'.$i;
      $ts_demo_importer_our_records_url[$i] = 'ts_demo_importer_our_records_url'.$i;
    }

    $record_arr = array(
                    'ts_demo_importer_our_records_enable',
                    'ts_demo_importer_our_records_settings',
                    'ts_demo_importer_our_records_bgcolor',
                    'ts_demo_importer_our_records_bgimage',
                    'ts_demo_importer_our_records_bgimage_for_mobile_about',
                    'ts_demo_importer_our_records_bgimage_setting',
                    'ts_demo_importer_our_records_bgimage_size',
                    'ts_demo_importer_our_records_content_settings',
                    'ts_demo_importer_our_records_carousel_loop',
                    'ts_demo_importer_our_records_carousel_speed',
                    'ts_demo_importer_our_records_carousel_dots',
                    'ts_demo_importer_our_records_carousel_nav',
                    'ts_demo_importer_our_records_number',
                    'ts_demo_importer_our_records_carousel_loop',
                    'ts_demo_importer_our_records_carousel_speed',
                    'ts_demo_importer_our_records_carousel_dots',
                    'ts_demo_importer_our_records_carousel_nav',
                    'ts_demo_importer_our_records_number',
                );

    $record_arr_final = array_merge($record_arr, $ts_demo_importer_our_records_box_settings, $ts_demo_importer_our_records_no, $ts_demo_importer_our_records_title, $ts_demo_importer_our_records_url);

    $wp_customize->add_setting('ts_demo_importer_record_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_record_tab_settings', array(
        'section' => 'ts_demo_importer_our_records',
        'buttons' => array(

            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => $record_arr_final,
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_our_records_color_settings',
                    'ts_demo_importer_our_records_small_heading_color',
                    'ts_demo_importer_our_records_small_heading_font_family',
                    'ts_demo_importer_our_records_small_heading_font_size',
                    'ts_demo_importer_our_records_main_heading_ct_pallete',
                    'ts_demo_importer_our_records_small_heading_ct_pallete',
                    'ts_demo_importer_our_records_main_heading_color',
                    'ts_demo_importer_our_records_main_heading_font_family',
                    'ts_demo_importer_our_records_main_heading_font_size',
                    'ts_demo_importer_our_records_text_ct_pallete',
                    'ts_demo_importer_our_records_text_color',
                    'ts_demo_importer_our_records_text_font_family',
                    'ts_demo_importer_our_records_text_font_size',
                    'ts_demo_importer_our_records_box_title_ct_pallete',
                    'ts_demo_importer_our_records_box_title_color',
                    'ts_demo_importer_our_records_box_title_font_family',
                    'ts_demo_importer_our_records_box_title_font_size',
                    'ts_demo_importer_our_records_box_text_ct_pallete',
                    'ts_demo_importer_our_records_box_text_color',
                    'ts_demo_importer_our_records_box_text_font_family',
                    'ts_demo_importer_our_records_box_text_font_size',
                    'ts_demo_importer_our_records_box_border_color',
                    'ts_demo_importer_our_records_spacing_left_desktop',
                    'ts_demo_importer_our_records_spacing_top_desktop',
                    'ts_demo_importer_our_records_spacing_bottom_desktop',
                    'ts_demo_importer_our_records_spacing_right_desktop',
                    'ts_demo_importer_our_records_spacing',

                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));
    $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_our_records_enable', array(
      'selector' => '#our-records .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_our_records_enable',
    ));
    $wp_customize->add_setting( 'ts_demo_importer_our_records_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_bgcolor', array(
      'label' => __('Section Background Color', 'ts-demo-importer'),
      'description'   => __('Either add background color or background image, if you add both background color will be top most priority','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_bgcolor',
    )));
    $wp_customize->add_setting('ts_demo_importer_our_records_bgimage',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_our_records_bgimage',array(
      'label' => __('Section Background Image','ts-demo-importer'),
      'description' => __('Dimension 1600px * 270px','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_bgimage'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_bgimage_for_mobile_about',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_our_records_bgimage_for_mobile_about',array(
      'label' => __('Section Background Image (For Mobile Devices and About Us inner page)','ts-demo-importer'),
      'description' => __('Dimension 1600px * 270px (This Image is for mobile and About Us and Inner page )','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_bgimage_for_mobile_about'
    )));

    //Work Column Layout
    $wp_customize->add_setting( 'ts_demo_importer_our_records_bgimage_setting', array(
        'default'         => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_bgimage_setting', array(
        'type'      => 'radio',
        'label'     => __('Choose image option', 'ts-demo-importer'),
        'section'   => 'ts_demo_importer_our_records',
        'choices'   => array(
          'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
          'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_bgimage_size', array(
        'default' => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_bgimage_size', array(
        'type' => 'radio',
        'label' => __('Background Image Size', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records',
        'choices' => array(
            'bg-auto' => __('Auto', 'ts-demo-importer'),
            'bg-cover' => __('Cover', 'ts-demo-importer'),
            'bg-contain' => __('Contain', 'ts-demo-importer'),
            'bg-xy' => __('Cover X & Y', 'ts-demo-importer'),
            'bg-x' => __('Cover X', 'ts-demo-importer'),
        )
    ));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_content_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_carousel_loop',
     array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_our_records_carousel_loop',
       array(
          'label' => esc_html__( 'Carousel Loop', 'ts-demo-importer' ),
          'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_speed',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_carousel_speed',array(
      'label' => __('Carousel Speed','ts-demo-importer'),
      'description'=>__('Ex. 1000 for One second','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_carousel_speed',
      'type'    => 'number'
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_dots', array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control(new ts_demo_importer_Toggle_Switch_Custom_control($wp_customize, 'ts_demo_importer_our_records_carousel_dots', array(
        'label' => esc_html__('Carousel Dots', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_nav', array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control(new ts_demo_importer_Toggle_Switch_Custom_control($wp_customize, 'ts_demo_importer_our_records_carousel_nav', array(
        'label' => esc_html__('Carousel Nav', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_number',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_number',array(
      'label' => __('No Of Records To Show','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_number',
      'type'    => 'number'
    ));

    $record_no = get_theme_mod('ts_demo_importer_our_records_number');

    for($i=1; $i<=3; $i++)
    {
      $wp_customize->add_setting( 'ts_demo_importer_our_records_box_settings'.$i,
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
      ));
      $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_settings'.$i,
        array(
        'label' => __('Record ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records'
      )));

      $wp_customize->add_setting('ts_demo_importer_our_records_no'.$i,array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_no'.$i,array(
        'label' => __('Record No ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_no'.$i,
        'type'    => 'text'
      ));
      $wp_customize->add_setting('ts_demo_importer_our_records_title'.$i,array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_title'.$i,array(
        'label' => __('Record Title ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_title'.$i,
        'type'    => 'text'
      ));

      $wp_customize->add_setting('ts_demo_importer_our_records_url'.$i,array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_url'.$i,array(
        'label' => __('Custom URL','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_url'.$i,
        'type'    => 'text'
      ));
    }
    $wp_customize->add_setting( 'ts_demo_importer_our_records_color_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_color_settings',
    array(
      'label' => __('Section Color & Typography','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_title_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_title_ct_pallete',
      array(
      'label' => __('Box Title Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_title_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_title_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_title_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_our_records_box_title_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_our_records_box_title_font_family', array(
      'section'  => 'ts_demo_importer_our_records',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_box_title_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_box_title_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_box_title_font_size',
      'type'    => 'number'
    ));


    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_text_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_text_ct_pallete',
      array(
      'label' => __('Box Text Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_text_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_text_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_text_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_our_records_box_text_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_our_records_box_text_font_family', array(
      'section'  => 'ts_demo_importer_our_records',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_box_text_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_box_text_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_box_text_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_border_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_border_color', array(
      'label' => __('Border Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_border_color',
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_left_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_top_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_bottom_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_right_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_our_records_spacing', array(
        'section' => 'ts_demo_importer_our_records',
        'label' => esc_html__('Section Spacing(px)', 'total'),
        'settings' => array(
            'desktop_left' => 'ts_demo_importer_our_records_spacing_left_desktop',
            'desktop_top' => 'ts_demo_importer_our_records_spacing_top_desktop',
            'desktop_bottom' => 'ts_demo_importer_our_records_spacing_bottom_desktop',
            'desktop_right' => 'ts_demo_importer_our_records_spacing_right_desktop'
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'responsive' => false
    )));
  }

  // ------------- About Us -------------

  if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){

    $wp_customize->add_section('ts_demo_importer_about_us',array(
      'title' => __('About Us','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_tab_settings', array(
        'section' => 'ts_demo_importer_about_us',
        'buttons' => array(

            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_about_us_enable',
                    'ts_demo_importer_about_us_settings',
                    'ts_demo_importer_about_us_bgcolor',
                    'ts_demo_importer_about_us_bgimage',
                    'ts_demo_importer_about_us_bgimage_setting',
                    'ts_demo_importer_about_us_bgimage_size',
                    'ts_demo_importer_about_us_content_settings',
                    'ts_demo_importer_about_us_small_heading',
                    'ts_demo_importer_about_us_main_heading',
                    'ts_demo_importer_about_us_text',
                    'ts_demo_importer_about_us_button_title',
                    'ts_demo_importer_about_us_button_icon',
                    'ts_demo_importer_about_us_button_url',
                    'ts_demo_importer_about_us_secion_image_settings',
                    'ts_demo_importer_about_us_heading_image',
                    'ts_demo_importer_about_us_heading_image_alt_text',
                    'ts_demo_importer_about_us_badge_settings',
                    'ts_demo_importer_about_us_badge_icon',
                    'ts_demo_importer_about_us_image_badge_text',
                ),

            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_about_us_color_settings',
                    'ts_demo_importer_about_us_small_heading_ct_pallete',
                    'ts_demo_importer_about_us_small_heading_color',
                    'ts_demo_importer_about_us_small_heading_font_family',
                    'ts_demo_importer_about_us_small_heading_font_size',
                    'ts_demo_importer_about_us_small_heading_border_color1',
                    'ts_demo_importer_about_us_small_heading_border_color2',
                    'ts_demo_importer_about_us_main_heading_ct_pallete',
                    'ts_demo_importer_about_us_main_heading_color',
                    'ts_demo_importer_about_us_main_heading_font_family',
                    'ts_demo_importer_about_us_main_heading_font_size',
                    'ts_demo_importer_about_us_text_ct_pallete',
                    'ts_demo_importer_about_us_text_color',
                    'ts_demo_importer_about_us_text_font_family',
                    'ts_demo_importer_about_us_text_font_size',
                    'ts_demo_importer_about_us_button_ct_pallete',
                    'ts_demo_importer_about_us_button_color',
                    'ts_demo_importer_about_us_button_font_family',
                    'ts_demo_importer_about_us_button_font_size',
                    'ts_demo_importer_about_us_button_bgcolor',
                    'ts_demo_importer_about_us_button_hover_bgcolor',
                    'ts_demo_importer_about_us_button_text_color_hover',
                    'ts_demo_importer_about_us_plugin_quote_ct_pallete',
                    'ts_demo_importer_about_us_quote_color',
                    'ts_demo_importer_about_us_quote_font_family',
                    'ts_demo_importer_about_us_quote_font_size',
                    'ts_demo_importer_about_us_quote_bgcolor',
                    'ts_demo_importer_about_us_quote_icon_color',
                    'ts_demo_importer_about_us_quote_icon_font_size',
                    'ts_demo_importer_about_us_right_column_bgcolor',
                    'ts_demo_importer_about_us_spacing_left_desktop',
                    'ts_demo_importer_about_us_spacing_top_desktop',
                    'ts_demo_importer_about_us_spacing_bottom_desktop',
                    'ts_demo_importer_about_us_spacing_right_desktop',
                    'ts_demo_importer_about_us_spacing',

                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));
    $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_about_us_enable', array(
      'selector' => '#about-us .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_about_us_enable',
    ));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_bgcolor', array(
      'label' => __('Section Background Color', 'ts-demo-importer'),
      'description'   => __('Either add background color or background image, if you add both background color will be top most priority','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_bgcolor',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_bgimage',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_about_us_bgimage',array(
      'label' => __('Section Background Image','ts-demo-importer'),
      'description' => __('Dimension 1600px * 430px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_bgimage'
    )));
          //Work Column Layout
    $wp_customize->add_setting( 'ts_demo_importer_about_us_bgimage_setting', array(
        'default'         => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_bgimage_setting', array(
        'type'      => 'radio',
        'label'     => __('Choose image option', 'ts-demo-importer'),
        'section'   => 'ts_demo_importer_about_us',
        'choices'   => array(
          'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
          'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_bgimage_size', array(
        'default' => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_bgimage_size', array(
        'type' => 'radio',
        'label' => __('Background Image Size', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_about_us',
        'choices' => array(
            'bg-auto' => __('Auto', 'ts-demo-importer'),
            'bg-cover' => __('Cover', 'ts-demo-importer'),
            'bg-contain' => __('Contain', 'ts-demo-importer'),
            'bg-xy' => __('Cover X & Y', 'ts-demo-importer'),
            'bg-x' => __('Cover X', 'ts-demo-importer'),
        )
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_content_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_small_heading',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_small_heading',array(
      'label' => __('Section Small Heading','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_small_heading',
      'type'    => 'text'
    ));
    $wp_customize->add_setting('ts_demo_importer_about_us_main_heading',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_main_heading',array(
      'label' => __('Section Main Heading','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_main_heading',
      'type'    => 'text'
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_text', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize, 'ts_demo_importer_about_us_text', array(
      'label' => __('Section Text', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_text',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_button_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_button_title',array(
      'label' => __('Section Button Title','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_button_title',
      'type'    => 'text'
    ));

    $wp_customize->add_setting(
    'ts_demo_importer_about_us_button_icon',
    array(
      'default'     => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control(
    new ts_demo_importer_Fontawesome_Icon_Chooser(
      $wp_customize,
      'ts_demo_importer_about_us_button_icon',
      array(
        'settings'    => 'ts_demo_importer_about_us_button_icon',
        'section'   => 'ts_demo_importer_about_us',
        'type'      => 'icon',
        'label'     => esc_html__( 'Choose Icon ', 'ts-demo-importer' ),
      )
    )
  );


    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_about_us_button_title34',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_about_us_button_title34', array(
        'section' => 'ts_demo_importer_about_us',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }



    $wp_customize->add_setting( 'ts_demo_importer_about_us_secion_image_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_secion_image_settings',
      array(
      'label' => __('Section Image Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_heading_image',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_about_us_heading_image',array(
      'label' => __('Section Image','ts-demo-importer'),
      'description' => __('Dimension 500px * 600px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_heading_image'
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_heading_image_alt_text',array(
      'default'   => '',
      'sanitize_callback' => 'sanitize_text_field'
     ));
    $wp_customize->add_control('ts_demo_importer_about_us_heading_image_alt_text',array(
          'label' => __('ALT Title','ts-demo-importer'),
          'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
          'section'   => 'ts_demo_importer_about_us',
          'setting'   => 'ts_demo_importer_about_us_heading_image_alt_text',
          'type'  => 'text'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_badge_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_badge_settings',
      array(
      'label' => __('Badge Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));




    $wp_customize->add_setting(
    'ts_demo_importer_about_us_badge_icon',
    array(
      'default'     => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control(
    new ts_demo_importer_Fontawesome_Icon_Chooser(
      $wp_customize,
      'ts_demo_importer_about_us_badge_icon',
      array(
        'settings'    => 'ts_demo_importer_about_us_badge_icon',
        'section'   => 'ts_demo_importer_about_us',
        'type'      => 'icon',
        'label'     => esc_html__( 'Choose Icon ', 'ts-demo-importer' ),
      )
    )
    );

    $wp_customize->add_setting('ts_demo_importer_about_us_image_badge_text',array(
      'default'   => '',
      'sanitize_callback' => 'sanitize_text_field'
     ));
    $wp_customize->add_control('ts_demo_importer_about_us_image_badge_text',array(
          'label' => __('Badge Text','ts-demo-importer'),
          'description' => __('This is image text for image alt attribute. This text is only for coding purpose.','ts-demo-importer'),
          'section'   => 'ts_demo_importer_about_us',
          'setting'   => 'ts_demo_importer_about_us_image_badge_text',
          'type'  => 'text'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_color_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_color_settings',
    array(
      'label' => __('Section Color & Typography','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_small_heading_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_small_heading_ct_pallete',
      array(
      'label' => __('Small Heading Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_small_heading_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_small_heading_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_small_heading_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_small_heading_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_small_heading_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_small_heading_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_small_heading_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_small_heading_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_small_heading_border_color1', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_small_heading_border_color1', array(
      'label' => __('Heading Border Color 1', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_small_heading_border_color1',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_small_heading_border_color2', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_small_heading_border_color2', array(
      'label' => __('Heading Border Color 2', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_small_heading_border_color2',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_main_heading_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_main_heading_ct_pallete',
      array(
      'label' => __('Main Heading Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_main_heading_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_main_heading_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_main_heading_color',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_main_heading_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_main_heading_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_main_heading_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_main_heading_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_main_heading_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_text_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_text_ct_pallete',
      array(
      'label' => __('Text Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_text_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_text_color', array(
      'label' => __('Section Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_text_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_text_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_text_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_text_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_text_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_text_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_button_ct_pallete',
      array(
      'label' => __('Button Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_color', array(
      'label' => __('Section Button Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_button_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_button_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Button Text Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_button_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_button_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_button_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_bgcolor', array(
      'label' => __(' Button Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_bgcolor',
    )));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_hover_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_hover_bgcolor', array(
      'label' => __('Section Button Hover Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_hover_bgcolor',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_text_color_hover', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_text_color_hover', array(
      'label' => __('Button Hover Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_text_color_hover',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_plugin_quote_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_plugin_quote_ct_pallete',
      array(
      'label' => __('Quote Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_quote_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_quote_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_quote_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_quote_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_quote_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_quote_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_quote_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_quote_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_quote_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_quote_bgcolor', array(
      'label' => __('Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_quote_bgcolor',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_quote_icon_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_quote_icon_color', array(
      'label' => __('Quote Icon Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_quote_icon_color',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_quote_icon_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_quote_icon_font_size',array(
      'label' => __('Icon Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_quote_icon_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_right_column_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_right_column_bgcolor', array(
      'label' => __('Right Column Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_right_column_bgcolor',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_left_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_top_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_bottom_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_right_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_about_us_spacing', array(
        'section' => 'ts_demo_importer_about_us',
        'label' => esc_html__('Section Spacing(px)', 'total'),
        'settings' => array(
            'desktop_left' => 'ts_demo_importer_about_us_spacing_left_desktop',
            'desktop_top' => 'ts_demo_importer_about_us_spacing_top_desktop',
            'desktop_bottom' => 'ts_demo_importer_about_us_spacing_bottom_desktop',
            'desktop_right' => 'ts_demo_importer_about_us_spacing_right_desktop'
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'responsive' => false
    )));

  }elseif( $template == 'advance-training-academy' ){
    /* ------------------------- Ts education about us section STRT ----------------------------------- */
    $wp_customize->add_section('ts_demo_importer_about_us',array(
      'title' => __('About Us','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_tab_settings', array(
        'section' => 'ts_demo_importer_about_us',
        'buttons' => array(

            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_about_us_enable',
                    'ts_demo_importer_about_us_settings',
                    'ts_demo_importer_about_us_bgcolor',
                    'ts_demo_importer_about_us_bgimage_setting',
                    'ts_demo_importer_about_us_bgimage_size',
                    'ts_demo_importer_about_us_content_settings',
                    'ts_demo_importer_about_us_title',
                    'ts_demo_importer_about_us_text',
                    'ts_demo_importer_about_us_button_text',
                    'ts_demo_importer_about_us_button_url',
                    'ts_demo_importer_about_us_right_image',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_about_us_color_settings',
                    'ts_demo_importer_about_us_main_heading_ct_pallete',
                    'ts_demo_importer_about_us_main_heading_color',
                    'ts_demo_importer_about_us_main_heading_font_family',
                    'ts_demo_importer_about_us_main_heading_font_size',
                    'ts_demo_importer_about_us_text_ct_pallete',
                    'ts_demo_importer_about_us_text_color',
                    'ts_demo_importer_about_us_text_font_family',
                    'ts_demo_importer_about_us_text_font_size',
                    'ts_demo_importer_about_us_button_ct_pallete',
                    'ts_demo_importer_about_us_button_color',
                    'ts_demo_importer_about_us_button_font_family',
                    'ts_demo_importer_about_us_button_font_size',
                    'ts_demo_importer_about_us_button_bgcolor',
                    'ts_demo_importer_about_us_button_hover_bgcolor',
                    'ts_demo_importer_about_us_button_text_color_hover',
                    'ts_demo_importer_about_us_spacing_top_desktop',
                    'ts_demo_importer_about_us_spacing_bottom_desktop',
                    'ts_demo_importer_about_us_spacing_right_desktop',
                    'ts_demo_importer_about_us_spacing',

                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));
    $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_about_us_enable', array(
      'selector' => '#about-us .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_about_us_enable',
    ));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_bgcolor', array(
      'label' => __('Section Background Color', 'ts-demo-importer'),
      'description'   => __('Either add background color or background image, if you add both background color will be top most priority','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_bgcolor',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_bgimage',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_about_us_bgimage',array(
      'label' => __('Section Background Image','ts-demo-importer'),
      'description' => __('Dimension 1600px * 430px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_bgimage'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_bgimage_setting', array(
        'default'         => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_bgimage_setting', array(
        'type'      => 'radio',
        'label'     => __('Choose image option', 'ts-demo-importer'),
        'section'   => 'ts_demo_importer_about_us',
        'choices'   => array(
          'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
          'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_bgimage_size', array(
        'default' => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_bgimage_size', array(
        'type' => 'radio',
        'label' => __('Background Image Size', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_about_us',
        'choices' => array(
            'bg-auto' => __('Auto', 'ts-demo-importer'),
            'bg-cover' => __('Cover', 'ts-demo-importer'),
            'bg-contain' => __('Contain', 'ts-demo-importer'),
            'bg-xy' => __('Cover X & Y', 'ts-demo-importer'),
            'bg-x' => __('Cover X', 'ts-demo-importer'),
        )
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_content_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_title',array(
      'label' => __('Section Main Heading','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_title',
      'type'    => 'text'
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_text', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize, 'ts_demo_importer_about_us_text', array(
      'label' => __('Section Text', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_text',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_button_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_button_text',array(
      'label' => __('Section Button Title','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_button_text',
      'type'    => 'text'
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_button_url',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_button_url',array(
      'label' => __('Section Button Url','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_button_url',
      'type'    => 'url'
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_right_image',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_about_us_right_image',array(
      'label' => __('Section Right Image','ts-demo-importer'),
      'description' => __('Dimension 1000px * 600px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_right_image'
    )));

    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_about_us_button_title34',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_about_us_button_title34', array(
        'section' => 'ts_demo_importer_about_us',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    $wp_customize->add_setting( 'ts_demo_importer_about_us_main_heading_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_main_heading_ct_pallete',
      array(
      'label' => __('Main Heading Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_main_heading_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_main_heading_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_main_heading_color',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_main_heading_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_main_heading_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_main_heading_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_main_heading_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_main_heading_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_text_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_text_ct_pallete',
      array(
      'label' => __('Text Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_text_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_text_color', array(
      'label' => __('Section Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_text_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_text_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_text_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_text_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_text_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_text_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_about_us_button_ct_pallete',
      array(
      'label' => __('Button Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_color', array(
      'label' => __('Section Button Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_about_us_button_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_about_us_button_font_family', array(
      'section'  => 'ts_demo_importer_about_us',
      'label'    => __('Button Text Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_button_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_button_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'setting' => 'ts_demo_importer_about_us_button_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_bgcolor', array(
      'label' => __(' Button Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_bgcolor',
    )));
    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_hover_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_hover_bgcolor', array(
      'label' => __('Section Button Hover Background Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_hover_bgcolor',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_button_text_color_hover', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_about_us_button_text_color_hover', array(
      'label' => __('Button Hover Text Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'settings' => 'ts_demo_importer_about_us_button_text_color_hover',
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_left_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_top_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_bottom_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_spacing_right_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_about_us_spacing', array(
        'section' => 'ts_demo_importer_about_us',
        'label' => esc_html__('Section Spacing(px)', 'total'),
        'settings' => array(
            'desktop_left' => 'ts_demo_importer_about_us_spacing_left_desktop',
            'desktop_top' => 'ts_demo_importer_about_us_spacing_top_desktop',
            'desktop_bottom' => 'ts_demo_importer_about_us_spacing_bottom_desktop',
            'desktop_right' => 'ts_demo_importer_about_us_spacing_right_desktop'
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'responsive' => false
    )));
  }elseif ($template == 'ts-conference') {
    //  ts-conference-about-us section
    $wp_customize->add_section('ts_demo_importer_about_us',array(
      'title' => __('About Us','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_tab_settings', array(
        'section' => 'ts_demo_importer_about_us',
        'buttons' => array(

            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_about_us_enable',
                    'ts_demo_importer_about_us_settings',
                    'ts_demo_importer_about_us_bgcolor',
                    'ts_demo_importer_about_us_bgimage_setting',
                    'ts_demo_importer_about_us_bgimage_size',
                    'ts_demo_importer_about_us_content_settings',
                    'ts_demo_importer_about_us_left_image',
                    'ts_demo_importer_about_us_small_heading',
                    'ts_demo_importer_about_us_main_heading',
                    'ts_demo_importer_about_us_para_one',
                    'ts_demo_importer_about_us_para_two',
                    'ts_demo_importer_about_us_read_more_button',
                    'ts_demo_importer_about_us_read_more_button_url',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_about_us_left_image_settings',
                    'ts_demo_importer_about_us_left_image_color_one',
                    'ts_demo_importer_about_us_left_image_color_two',
                    'ts_demo_importer_about_us_small_heading_ct_pallete',
                    'ts_demo_importer_about_us_small_heading_color',
                    'ts_demo_importer_about_us_small_heading_font_family',
                    'ts_demo_importer_about_us_small_heading_font_size',
                    'ts_demo_importer_about_us_main_heading_ct_pallete',
                    'ts_demo_importer_about_us_main_heading_color',
                    'ts_demo_importer_about_us_main_heading_font_family',
                    'ts_demo_importer_about_us_main_heading_font_size',
                    'ts_demo_importer_about_us_para_settings',
                    'ts_demo_importer_about_us_para_color',
                    'ts_demo_importer_about_us_para_font_family',
                    'ts_demo_importer_about_us_para_font_size',
                    'ts_demo_importer_about_us_para_ct_pallete',
                    'ts_demo_importer_about_us_para_color',
                    'ts_demo_importer_about_us_para_font_family',
                    'ts_demo_importer_about_us_para_font_size',
                    'ts_demo_importer_about_us_read_more_button_ct_pallete',
                    'ts_demo_importer_about_us_read_more_button_color',
                    'ts_demo_importer_about_us_read_more_button_font_family',
                    'ts_demo_importer_about_us_read_more_button_font_size',
                    'ts_demo_importer_about_us_read_more_button_hover_bgcolor',
                    'ts_demo_importer_about_us_read_more_button_hover_color',

                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_about_us_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_about_us_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_about_us',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));
    $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_about_us_enable', array(
      'selector' => '#about-us .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_about_us_enable',
    ));


    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_advance_training_academy_counter_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_about_us_enable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_about_us_enable0', array(
        'section' => 'ts_demo_importer_counter_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
}

  // ==================== ts education courses and  program section ============
  if( $template == 'advance-training-academy' ){
    // =================== counter section ======================
    $wp_customize->add_section('ts_demo_importer_counter_section',array(
      'title' => __('Counter','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_counter_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $content_buttons_array = array(
      'ts_demo_importer_personalized_support_enabledisable',
      'ts_demo_importer_counter_section_bg_settings',
      'ts_demo_importer_personalized_support_background_color',
      'ts_demo_importer_personalized_support_bgimage',
      'ts_demo_importer_personalized_support_background_att',
      'ts_demo_importer_personalized_support_size',
      'ts_demo_importer_counter_content_settings',
      'ts_demo_importer_counter_main_heading',
      'ts_demo_importer_our_records_number',
    );

    $record_no=get_theme_mod('ts_demo_importer_our_records_number');
    for ($i=1; $i <=$record_no ; $i++) {
      $counter_sep = 'ts_demo_importer_our_records_sep'.$i;
      $counter_number = 'ts_demo_importer_our_records_no'.$i;
      $counter_suffix = 'ts_demo_importer_our_records_no_suffix'.$i;
      $counter_title = 'ts_demo_importer_our_records_title'.$i;
      array_push($content_buttons_array, $counter_sep, $counter_number, $counter_suffix, $counter_title );
    }

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_counter_tab_settings', array(
        'section' => 'ts_demo_importer_counter_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => $content_buttons_array
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_counter_main_heading_typo_setting',
                    'ts_demo_importer_counter_main_heading_color',
                    'ts_demo_importer_counter_main_heading_font_size',
                    'ts_demo_importer_counter_main_heading_font_family',
                    'ts_demo_importer_our_records_no_typo_setting',
                    'ts_demo_importer_our_records_no_color',
                    'ts_demo_importer_our_records_no_font_size',
                    'ts_demo_importer_our_records_no_font_family',
                    'ts_demo_importer_our_records_title_typo_setting',
                    'ts_demo_importer_our_records_title_color',
                    'ts_demo_importer_our_records_title_font_size',
                    'ts_demo_importer_our_records_title_font_family'
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_personalized_support_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_personalized_support_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_counter_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_advance_training_academy_counter_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_personalized_support_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_personalized_support_enabledisable0', array(
        'section' => 'ts_demo_importer_counter_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
    // =================  courses and program section  =====================
    $wp_customize->add_section('ts_demo_importer_featured_courses_section',array(
      'title' => __('Courses and Program','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_featured_courses_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_featured_courses_tab_settings', array(
        'section' => 'ts_demo_importer_featured_courses_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_featured_courses_enabledisable',
                    'ts_demo_importer_featured_courses_bg_settings',
                    'ts_demo_importer_featured_courses_bgcolor',
                    'ts_demo_importer_featured_courses_bgimage',
                    'ts_demo_importer_featured_courses_bgimage_size',
                    'ts_demo_importer_courses_settings',
                    'ts_demo_importer_featured_courses_content_settings',
                    'ts_demo_importer_courses_top_heading',
                    'ts_demo_importer_courses_top_paragraph',
                    'ts_demo_importer_course_count',
                    'ts_demo_importer_course_button',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_courses_top_heading_typo_setting',
                    'ts_demo_importer_courses_top_heading_color',
                    'ts_demo_importer_courses_top_heading_font_size',
                    'ts_demo_importer_courses_top_heading_font_family',
                    'ts_demo_importer_courses_top_paragraph_typo_setting',
                    'ts_demo_importer_courses_top_paragraph_color',
                    'ts_demo_importer_courses_top_paragraph_font_size',
                    'ts_demo_importer_courses_top_paragraph_font_family',
                    'ts_demo_importer_courses_post_title_typo_setting',
                    'ts_demo_importer_courses_post_title_color',
                    'ts_demo_importer_courses_post_title_font_size',
                    'ts_demo_importer_courses_post_title_font_family',
                    'ts_demo_importer_courses_post_content_typo_setting',
                    'ts_demo_importer_courses_post_content_color',
                    'ts_demo_importer_courses_post_content_font_size',
                    'ts_demo_importer_courses_post_content_font_family',
                    'ts_demo_importer_course_button_typo_setting',
                    'ts_demo_importer_course_button_color',
                    'ts_demo_importer_course_button_font_size',
                    'ts_demo_importer_course_button_font_family',
                    'ts_demo_importer_course_button_hover_color',
                    'ts_demo_importer_course_card_setting',
                    'ts_demo_importer_course_card_bgcolor',
                    'ts_demo_importer_course_card_hover_bgcolor'
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_featured_courses_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_featured_courses_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_featured_courses_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_advance_training_academy_courses_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_featured_courses_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_featured_courses_enabledisable0', array(
        'section' => 'ts_demo_importer_featured_courses_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // =================== explore all program section =========================
    $wp_customize->add_section('ts_demo_importer_all_program_section',array(
      'title' => __('Explore All Programs','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_all_program_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_all_program_tab_settings', array(
        'section' => 'ts_demo_importer_all_program_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_all_program_enabledisable',
                    'ts_demo_importer_all_program_bg_settings',
                    'ts_demo_importer_all_program_bgcolor',
                    'ts_demo_importer_all_program_bgimage',
                    'ts_demo_importer_all_program_bg_att',
                    'ts_demo_importer_all_program_content_settings',
                    'ts_demo_importer_all_program_title',
                    'ts_demo_importer_all_program_paragraph',
                    'ts_demo_importer_all_program_button_text',
                    'ts_demo_importer_all_program_button_url',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_all_program_title_typo_setting',
                    'ts_demo_importer_all_program_title_color',
                    'ts_demo_importer_all_program_title_font_size',
                    'ts_demo_importer_all_program_title_font_family',
                    'ts_demo_importer_all_program_paragraph_typo_setting',
                    'ts_demo_importer_all_program_paragraph_color',
                    'ts_demo_importer_all_program_paragraph_font_size',
                    'ts_demo_importer_all_program_paragraph_font_family',
                    'ts_demo_importer_all_program_button_text_typo_setting',
                    'ts_demo_importer_all_program_button_text_color',
                    'ts_demo_importer_all_program_button_text_font_size',
                    'ts_demo_importer_all_program_button_text_font_family',
                    'ts_demo_importer_all_program_button_text_bgcolor',
                    'ts_demo_importer_all_program_button_text_hover_bgcolor',
                    'ts_demo_importer_all_program_button_text_hover_color',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_all_program_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_all_program_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_all_program_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_all_program_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_all_program_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_all_program_enabledisable0', array(
        'section' => 'ts_demo_importer_all_program_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    //  ================== explore all programs ==============================
    // $wp_customize->add_section('ts_demo_importer_all_program_section',array(
    //   'title' => __('Explore All Programs','ts-demo-importer'),
    //   'panel' => 'ts_demo_importer_panel_id',
    // ));
    //
    // $wp_customize->add_setting('ts_demo_importer_all_program_tab_settings', array(
    //   'sanitize_callback' => 'wp_kses_post',
    // ));
    //
    // $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_all_program_tab_settings', array(
    //     'section' => 'ts_demo_importer_all_program_section',
    //     'buttons' => array(
    //         array(
    //             'name' => esc_html__('Content', 'ts-demo-importer'),
    //             'icon' => 'dashicons dashicons-welcome-write-blog',
    //             'fields' => array(
    //                 'ts_demo_importer_all_program_enabledisable',
    //                 'ts_demo_importer_all_program_bg_settings',
    //                 'ts_demo_importer_all_program_bgcolor',
    //                 'ts_demo_importer_all_program_bgimage',
    //                 'ts_demo_importer_all_program_settings',
    //                 'ts_demo_importer_all_program_title',
    //                 'ts_demo_importer_all_program_paragraph',
    //                 'ts_demo_importer_all_program_button_text',
    //                 'ts_demo_importer_all_program_button_url',
    //             ),
    //         ),
    //         array(
    //             'name' => esc_html__('Style', 'ts-demo-importer'),
    //             'icon' => 'dashicons dashicons-art',
    //             'fields' => array(
    //                 'ts_demo_importer_all_program_title_typo_setting',
    //                 'ts_demo_importer_all_program_title_color',
    //                 'ts_demo_importer_all_program_title_font_size',
    //                 'ts_demo_importer_all_program_title_font_family',
    //                 'ts_demo_importer_all_program_paragraph_typo_setting',
    //                 'ts_demo_importer_all_program_paragraph_color',
    //                 'ts_demo_importer_all_program_paragraph_font_size',
    //                 'ts_demo_importer_all_program_paragraph_font_family',
    //                 'ts_demo_importer_all_program_button_text_typo_setting',
    //                 'ts_demo_importer_all_program_button_text_color',
    //                 'ts_demo_importer_all_program_button_text_font_size',
    //                 'ts_demo_importer_all_program_button_text_font_family',
    //                 'ts_demo_importer_all_program_button_text_bgcolor',
    //                 'ts_demo_importer_all_program_button_text_hover_bgcolor',
    //             ),
    //         )
    //     ),
    // )));
    //
    // $wp_customize->add_setting('ts_demo_importer_all_program_enabledisable',
    //     array(
    //   'default' => 'Enable',
    //   'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    // ));
    // $wp_customize->add_control('ts_demo_importer_all_program_enabledisable',
    //   array(
    //   'type' => 'radio',
    //   'label' => __('Do you want this section', 'ts-demo-importer'),
    //   'section' => 'ts_demo_importer_all_program_section',
    //   'choices' => array(
    //   'Enable' => __('Enable', 'ts-demo-importer'),
    //   'Disable' => __('Disable', 'ts-demo-importer')
    // )));
    //
    // if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
    //         TSDemoImporterAddon::load_our_services_section_setting($wp_customize,$font_array);
    // }else{
    //   $wp_customize->add_setting('ts_demo_importer_all_program_enabledisable0',array(
    //     'default' => '',
    //     'sanitize_callback' => 'sanitize_text_field'
    //   ));
    //   $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_all_program_enabledisable0', array(
    //     'section' => 'ts_demo_importer_all_program_section',
    //     'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
    //     'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
    //     'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
    //     '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
    //     '</a>'
    //   ),
    // )));
    // }

    // ==================  founder section ===================
    $wp_customize->add_section('ts_demo_importer_founder_section',array(
      'title' => __('Founder','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_founder_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_founder_tab_settings', array(
        'section' => 'ts_demo_importer_founder_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_founder_enabledisable',
                    'ts_demo_importer_founder_bg_settings',
                    'ts_demo_importer_founder_bgcolor_one',
                    'ts_demo_importer_founder_bgcolor_two',
                    'ts_demo_importer_founder_bgimage',
                    'ts_demo_importer_founder_bg_att',
                    'ts_demo_importer_founder_small_title_settings',
                    'ts_demo_importer_founder_small_title',
                    'ts_demo_importer_founder_title',
                    'ts_demo_importer_founder_text',
                    'ts_demo_importer_founder_signature_image',
                    'ts_demo_importer_founder_name',
                    'ts_demo_importer_founder_image',
                    'ts_demo_importer_founder_designation',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_founder_small_title_typo_setting',
                    'ts_demo_importer_founder_small_title_color',
                    'ts_demo_importer_founder_small_title_font_size',
                    'ts_demo_importer_founder_small_title_font_family',
                    'ts_demo_importer_founder_title_typo_setting',
                    'ts_demo_importer_founder_title_color',
                    'ts_demo_importer_founder_title_font_size',
                    'ts_demo_importer_founder_title_font_family',
                    'ts_demo_importer_founder_text_typo_setting',
                    'ts_demo_importer_founder_text_color',
                    'ts_demo_importer_founder_text_font_size',
                    'ts_demo_importer_founder_text_font_family',
                    'ts_demo_importer_founder_name_typo_setting',
                    'ts_demo_importer_founder_name_color',
                    'ts_demo_importer_founder_name_font_size',
                    'ts_demo_importer_founder_name_font_family',
                    'ts_demo_importer_founder_right_name_typo_setting',
                    'ts_demo_importer_founder_right_name_color',
                    'ts_demo_importer_founder_right_name_font_size',
                    'ts_demo_importer_founder_right_name_font_family',
                    'ts_demo_importer_founder_name_font_family',
                    'ts_demo_importer_founder_designation_typo_setting',
                    'ts_demo_importer_founder_designation_color',
                    'ts_demo_importer_founder_designation_font_size',
                    'ts_demo_importer_founder_designation_font_family',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_founder_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_founder_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_founder_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_founder_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_founder_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_founder_enabledisable0', array(
        'section' => 'ts_demo_importer_founder_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // =================== annual meetup section ===================
    $wp_customize->add_section('ts_demo_importer_annual_meetup_section',array(
      'title' => __('Annual Meetup','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_annual_meetup_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_annual_meetup_tab_settings', array(
        'section' => 'ts_demo_importer_annual_meetup_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_annual_meetup_enabledisable',
                    'ts_demo_importer_annual_meetup_bgimage_setting',
                    'ts_demo_importer_annual_meetup_background_color',
                    'ts_demo_importer_annual_meetup_bgimage',
                    'ts_demo_importer_annual_meetup_bgimage_att',
                    'ts_demo_importer_annual_event_title_settings',
                    'ts_demo_importer_annual_event_title',
                    'ts_demo_importer_annual_event_paragraph',
                    'ts_demo_importer_annual_meetup_post_excerpt_no',
                    'ts_demo_importer_annual_event_register_btn'
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_annual_event_title_typo_setting',
                    'ts_demo_importer_annual_event_title_color',
                    'ts_demo_importer_annual_event_title_font_size',
                    'ts_demo_importer_annual_event_title_font_family',
                    'ts_demo_importer_annual_event_paragraph_typo_setting',
                    'ts_demo_importer_annual_event_paragraph_color',
                    'ts_demo_importer_annual_event_paragraph_font_size',
                    'ts_demo_importer_annual_event_paragraph_font_family',
                    'ts_demo_importer_annual_event_post_title_typo_setting',
                    'ts_demo_importer_annual_event_post_title_color',
                    'ts_demo_importer_annual_event_post_title_font_size',
                    'ts_demo_importer_annual_event_post_title_font_family',
                    'ts_demo_importer_annual_event_post_content_typo_setting',
                    'ts_demo_importer_annual_event_post_content_color',
                    'ts_demo_importer_annual_event_post_content_font_size',
                    'ts_demo_importer_annual_event_post_content_font_family',
                    'ts_demo_importer_annual_event_right_card_setting',
                    'ts_demo_importer_annual_event_right_card_bgcolor',
                    'ts_demo_importer_annual_event_post_counter_number_typo_setting',
                    'ts_demo_importer_annual_event_post_counter_number_color',
                    'ts_demo_importer_annual_event_post_counter_number_font_size',
                    'ts_demo_importer_annual_event_post_counter_number_font_family',
                    'ts_demo_importer_annual_event_post_counter_text_typo_setting',
                    'ts_demo_importer_annual_event_post_counter_text_color',
                    'ts_demo_importer_annual_event_post_counter_text_font_size',
                    'ts_demo_importer_annual_event_post_counter_text_font_family',
                    'ts_demo_importer_annual_event_post_date_typo_setting',
                    'ts_demo_importer_annual_event_post_date_color',
                    'ts_demo_importer_annual_event_post_date_font_size',
                    'ts_demo_importer_annual_event_post_date_font_family',
                    'ts_demo_importer_annual_event_post_time_typo_setting',
                    'ts_demo_importer_annual_event_post_time_color',
                    'ts_demo_importer_annual_event_post_time_font_size',
                    'ts_demo_importer_annual_event_post_time_font_family',
                    'ts_demo_importer_annual_event_post_register_btn_typo_setting',
                    'ts_demo_importer_annual_event_post_register_btn_color',
                    'ts_demo_importer_annual_event_post_register_btn_font_size',
                    'ts_demo_importer_annual_event_post_register_btn_font_family',
                    'ts_demo_importer_annual_event_post_register_btn_bgcolor',
                    'ts_demo_importer_annual_event_post_register_btn_hover_bgcolor',
                    'ts_demo_importer_annual_event_post_register_btn_color',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_annual_meetup_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_annual_meetup_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_annual_meetup_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_annual_meetup_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_annual_meetup_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_annual_meetup_enabledisable0', array(
        'section' => 'ts_demo_importer_annual_meetup_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // ====================  upcoming events ==================
    $wp_customize->add_section('ts_demo_importer_upcoming_events_section',array(
      'title' => __('Upcoming Events','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_upcoming_events_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_upcoming_events_tab_settings', array(
        'section' => 'ts_demo_importer_upcoming_events_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_upcoming_events_enabledisable',
                    'ts_demo_importer_upcoming_events_bgsetting',
                    'ts_demo_importer_upcoming_events_background_color',
                    'ts_demo_importer_upcoming_events_bgimage',
                    'ts_demo_importer_upcoming_events_bgimage_setting',
                    'ts_demo_importer_upcoming_events_title_settings',
                    'ts_demo_importer_upcoming_events_title',
                    'ts_demo_importer_upcoming_events_paragraph',
                    'ts_demo_importer_upcoming_events_view_all_btn',
                    'ts_demo_importer_upcoming_events_view_all_btn_url',
                    'ts_demo_importer_event_listing_number'
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_upcoming_events_title_typo_setting',
                    'ts_demo_importer_upcoming_events_title_color',
                    'ts_demo_importer_upcoming_events_title_font_size',
                    'ts_demo_importer_upcoming_events_title_font_family',
                    'ts_demo_importer_upcoming_events_paragraph_typo_setting',
                    'ts_demo_importer_upcoming_events_paragraph_color',
                    'ts_demo_importer_upcoming_events_paragraph_font_size',
                    'ts_demo_importer_upcoming_events_paragraph_font_family',
                    'ts_demo_importer_upcoming_events_view_all_btn_typo_setting',
                    'ts_demo_importer_upcoming_events_view_all_btn_color',
                    'ts_demo_importer_upcoming_events_view_all_btn_font_size',
                    'ts_demo_importer_upcoming_events_view_all_btn_font_family',
                    'ts_demo_importer_upcoming_events_view_all_btn_bgcolor',
                    'ts_demo_importer_upcoming_events_view_all_btn_hover_bgcolor',
                    'ts_demo_importer_upcoming_events_view_all_btn_hover_color',
                    'ts_demo_importer_upcoming_events_left_post_title_typo_setting',
                    'ts_demo_importer_upcoming_events_left_post_title_color',
                    'ts_demo_importer_upcoming_events_left_post_title_font_size',
                    'ts_demo_importer_upcoming_events_left_post_title_font_family',
                    'ts_demo_importer_upcoming_events_left_post_meta_typo_setting',
                    'ts_demo_importer_upcoming_events_left_post_meta_color',
                    'ts_demo_importer_upcoming_events_left_post_meta_font_size',
                    'ts_demo_importer_upcoming_events_left_post_meta_font_family',
                    'ts_demo_importer_upcoming_events_right_post_title_typo_setting',
                    'ts_demo_importer_upcoming_events_right_post_title_color',
                    'ts_demo_importer_upcoming_events_right_post_title_font_size',
                    'ts_demo_importer_upcoming_events_right_post_title_font_family',
                    'ts_demo_importer_upcoming_events_right_post_meta_typo_setting',
                    'ts_demo_importer_upcoming_events_right_post_meta_color',
                    'ts_demo_importer_upcoming_events_right_post_meta_font_size',
                    'ts_demo_importer_upcoming_events_right_post_meta_font_family',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_upcoming_events_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_upcoming_events_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_upcoming_events_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_advance_training_academy_upcoming_evets_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_upcoming_events_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_upcoming_events_enabledisable0', array(
        'section' => 'ts_demo_importer_upcoming_events_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
    // ==========================  video tour section ==========================
    $wp_customize->add_section('ts_demo_importer_video_section',array(
      'title' => __('Video Section','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_video_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_video_tab_settings', array(
        'section' => 'ts_demo_importer_video_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_video_enabledisable',
                    'ts_demo_importer_video_bgimage_setting',
                    'ts_demo_importer_video_bgcolor',
                    'ts_demo_importer_video_bgimage',
                    'ts_demo_importer_video_bg_attachemnt',
                    'ts_demo_importer_video_image',
                    'ts_demo_importer_video_title_settings',
                    'ts_demo_importer_video_title',
                    'ts_demo_importer_video_text',
                    'ts_demo_importer_video_icon',
                    'ts_demo_importer_video_link'
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_video_title_typo_setting',
                    'ts_demo_importer_video_title_color',
                    'ts_demo_importer_video_title_font_size',
                    'ts_demo_importer_video_title_font_family',
                    'ts_demo_importer_video_text_typo_setting',
                    'ts_demo_importer_video_text_color',
                    'ts_demo_importer_video_text_font_size',
                    'ts_demo_importer_video_text_font_family',
                    'ts_demo_importer_video_icon_typo_setting',
                    'ts_demo_importer_video_icon_color',
                    'ts_demo_importer_video_icon_font_size',
                    'ts_demo_importer_video_icon_bgcolor',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_video_enabledisable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_video_enabledisable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_video_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_education_video_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_video_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_video_enabledisable0', array(
        'section' => 'ts_demo_importer_video_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // ======================== latest news =================================
    $wp_customize->add_section('ts_demo_importer_latest_news_section',array(
      'title' => __('Latest News','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_latest_news_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_latest_news_settings', array(
        'section' => 'ts_demo_importer_latest_news_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_latest_news_enable',
                    'ts_demo_importer_latest_news_bgimage_setting',
                    'ts_demo_importer_latest_news_bgcolor',
                    'ts_demo_importer_latest_news_bgimage',
                    'ts_demo_importer_latest_news_carousel_loop',
                    'ts_demo_importer_latest_news_carousel_speed',
                    'ts_demo_importer_latest_news_carousel_dots',
                    'ts_demo_importer_latest_news_carousel_nav',
                    'ts_demo_importer_latest_news_heading_settings',
                    'ts_demo_importer_latest_news_heading',
                    'ts_demo_importer_latest_news_paragraph',
                    'ts_demo_importer_my_blog_number',
                    'ts_demo_importer_post_excerpt_no',
                    'ts_demo_importer_latest_news_read_more_text',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_latest_news_heading_typo_setting',
                    'ts_demo_importer_latest_news_heading_color',
                    'ts_demo_importer_latest_news_heading_font_size',
                    'ts_demo_importer_latest_news_heading_font_family',
                    'ts_demo_importer_latest_news_paragraph_typo_setting',
                    'ts_demo_importer_latest_news_paragraph_color',
                    'ts_demo_importer_latest_news_paragraph_font_size',
                    'ts_demo_importer_latest_news_paragraph_font_family',
                    'ts_demo_importer_latest_news_meta_typo_setting',
                    'ts_demo_importer_latest_news_meta_color',
                    'ts_demo_importer_latest_news_meta_font_size',
                    'ts_demo_importer_latest_news_meta_font_family',
                    'ts_demo_importer_latest_news_post_title_typo_setting',
                    'ts_demo_importer_latest_news_post_title_color',
                    'ts_demo_importer_latest_news_post_title_font_size',
                    'ts_demo_importer_latest_news_post_title_font_family',
                    'ts_demo_importer_latest_news_post_content_typo_setting',
                    'ts_demo_importer_latest_news_post_content_color',
                    'ts_demo_importer_latest_news_post_content_font_size',
                    'ts_demo_importer_latest_news_post_content_font_family',
                    'ts_demo_importer_latest_news_read_more_text_typo_setting',
                    'ts_demo_importer_latest_news_read_more_text_color',
                    'ts_demo_importer_latest_news_read_more_text_font_size',
                    'ts_demo_importer_latest_news_read_more_text_font_family',
                    'ts_demo_importer_latest_news_comment_and_like_typo_setting',
                    'ts_demo_importer_latest_news_comment_and_like_color',
                    'ts_demo_importer_latest_news_comment_and_like_font_size',
                    'ts_demo_importer_latest_news_comment_and_like_font_family',
                    'ts_demo_importer_latest_news_card_background_settings',
                    'ts_demo_importer_latest_news_card_background_color',
                    'ts_demo_importer_latest_news_card_hover_background_color',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_latest_news_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_latest_news_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_latest_news_section',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_education_latest_post_section_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_latest_news_enable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_latest_news_enable0', array(
        'section' => 'ts_demo_importer_latest_news_section',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // ================== about us page ========================
    $wp_customize->add_section('ts_demo_importer_about_us_page',array(
      'title' => __('About Us Page','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_page_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_page_settings', array(
        'section' => 'ts_demo_importer_about_us_page',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_about_us_secone_enabledisable',
                    'ts_demo_importer_about_us_secone_bgimage_setting',
                    'ts_demo_importer_about_us_secone_bgcolor',
                    'ts_demo_importer_about_us_secone_bgimage',
                    'ts_demo_importer_about_us_secone_left_img',
                    'ts_demo_importer_about_us_secone_heading_settings',
                    'ts_demo_importer_about_us_secone_heading',
                    'ts_demo_importer_about_us_secone_para_one',
                    'ts_demo_importer_about_us_secone_para_two',
                    'ts_demo_importer_about_us_inner_page_sec_two_show_hide',
                    'ts_demo_importer_about_us_sectwo_bgimage_setting',
                    'ts_demo_importer_about_us_sectwo_bgcolor',
                    'ts_demo_importer_about_us_sectwo_bgimage',
                    'ts_demo_importer_about_us_inner_page_shortcode',
                    'ts_demo_importer_about_us_secthree_enabledisable',
                    'ts_demo_importer_about_us_secthree_bgimage_setting',
                    'ts_demo_importer_about_us_secthree_bgcolor',
                    'ts_demo_importer_about_us_secthree_bgimage',
                    'ts_demo_importer_about_us_secthree_content_setting',
                    'ts_demo_importer_about_us_secthree_heading',
                    'ts_demo_importer_about_us_secthree_para_one',
                    'ts_demo_importer_about_us_secthree_para_two',
                    'ts_demo_importer_about_us_secthree_video_settings',
                    'ts_demo_importer_about_us_secthree_video_image',
                    'ts_demo_importer_about_us_secthree_video_icon',
                    'ts_demo_importer_about_us_secthree_video_link',
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_about_us_secone_heading_typo_setting',
                    'ts_demo_importer_about_us_secone_heading_color',
                    'ts_demo_importer_about_us_secone_heading_font_size',
                    'ts_demo_importer_about_us_secone_heading_font_family',
                    'ts_demo_importer_about_us_secone_para_typo_setting',
                    'ts_demo_importer_about_us_secone_para_color',
                    'ts_demo_importer_about_us_secone_para_font_size',
                    'ts_demo_importer_about_us_secone_para_font_family',
                    'ts_demo_importer_about_us_secthree_heading_typo_setting',
                    'ts_demo_importer_about_us_secthree_heading_color',
                    'ts_demo_importer_about_us_secthree_heading_font_size',
                    'ts_demo_importer_about_us_secthree_heading_font_family',
                    'ts_demo_importer_about_us_secthree_para_typo_setting',
                    'ts_demo_importer_about_us_secthree_para_color',
                    'ts_demo_importer_about_us_secthree_para_font_size',
                    'ts_demo_importer_about_us_secthree_para_font_family',
                    'ts_demo_importer_about_us_secthree_video_typo_setting',
                    'ts_demo_importer_about_us_secthree_video_color',
                    'ts_demo_importer_about_us_secthree_video_font_size',
                    'ts_demo_importer_about_us_secthree_video_bgcolor',
                ),
            )
        ),
    )));

    $wp_customize->add_setting( 'ts_demo_importer_about_us_secone_enabledisable',
     array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_about_us_secone_enabledisable',
       array(
          'label' => esc_html__( 'Section One Hide or Show', 'ts-demo-importer' ),
          'section' => 'ts_demo_importer_about_us_page'
    )));

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_education_about_us_page_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_about_us_secone_enabledisable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_about_us_secone_enabledisable0', array(
        'section' => 'ts_demo_importer_about_us_page',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

    // ============== contact us page  ====================
    $wp_customize->add_section('ts_demo_importer_contact_us_page',array(
      'title' => __('Contact Us Page','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_about_us_page_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_page_settings', array(
        'section' => 'ts_demo_importer_contact_us_page',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => array(
                    'ts_demo_importer_contact_page_main_heading',
                    'ts_demo_importer_contact_page_main_para',
                    'ts_demo_importer_contact_page_phone_settings',
                    'ts_demo_importer_contact_page_phone_number',
                    'ts_demo_importer_contact_page_phone_number_icon',
                    'ts_demo_importer_contact_page_email_settings',
                    'ts_demo_importer_contact_page_email_address',
                    'ts_demo_importer_contact_page_email_address_icon',
                    'ts_demo_importer_address_map_setting',
                    'ts_demo_importer_address_latitude_settings',
                    'ts_demo_importer_address_latitude',
                    'ts_demo_importer_address_longitude',
                    'ts_demo_importer_contactpage_form_code'
                ),
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_contact_page_main_heading_typo_setting',
                    'ts_demo_importer_contact_page_main_heading_color',
                    'ts_demo_importer_contact_page_main_heading_font_size',
                    'ts_demo_importer_contact_page_main_heading_font_family',
                    'ts_demo_importer_contact_page_main_para_typo_setting',
                    'ts_demo_importer_contact_page_main_para_color',
                    'ts_demo_importer_contact_page_main_para_font_size',
                    'ts_demo_importer_contact_page_main_para_font_family',
                    'ts_demo_importer_contact_page_phone_email_typo_setting',
                    'ts_demo_importer_contact_page_phone_email_color',
                    'ts_demo_importer_contact_page_phone_email_font_size',
                    'ts_demo_importer_contact_page_phone_email_font_family',
                    'ts_demo_importer_contact_page_label_typo_setting',
                    'ts_demo_importer_contact_page_label_color',
                    'ts_demo_importer_contact_page_label_font_size',
                    'ts_demo_importer_contact_page_label_font_family',
                    'ts_demo_importer_contact_page_placeholder_text_typo_setting',
                    'ts_demo_importer_contact_page_placeholder_text_color',
                    'ts_demo_importer_contact_page_placeholder_text_font_size',
                    'ts_demo_importer_contact_page_placeholder_text_font_family',
                    'ts_demo_importer_contact_page_submit_btn_typo_setting',
                    'ts_demo_importer_contact_page_submit_btn_color',
                    'ts_demo_importer_contact_page_submit_btn_font_size',
                    'ts_demo_importer_contact_page_submit_btn_font_family',
                    'ts_demo_importer_contact_page_submit_btn_bgcolor',
                ),
            )
        ),
    )));

    /*$wp_customize->add_setting('ts_demo_importer_contact_us_page_bgcolor',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_contact_us_page_bgcolor',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_contact_us_page',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));*/

    if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
            TSDemoImporterAddon::load_education_contact_us_page_setting($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_contact_us_page_bgcolor0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_contact_us_page_bgcolor0', array(
        'section' => 'ts_demo_importer_contact_us_page',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }

  }

  // ---------------Our skills  --------------

if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_our_skills',array(
    'title' => __('Our Skills','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $skill_no=get_theme_mod('ts_demo_importer_our_skills_number');

  $ts_demo_importer_our_skills_box_settings = array();
  $ts_demo_importer_our_skills_icon = array();
  $ts_demo_importer_our_skills_title = array();
  $ts_demo_importer_our_skills_url = array();
  $ts_demo_importer_our_skills_text = array();
  $ts_demo_importer_our_skills_percentage = array();

  for($i=1; $i<=$skill_no ;$i++){
    $ts_demo_importer_our_skills_box_settings[$i] = 'ts_demo_importer_our_skills_box_settings'.$i;
    $ts_demo_importer_our_skills_icon[$i] = 'ts_demo_importer_our_skills_icon'.$i;
    $ts_demo_importer_our_skills_title[$i] = 'ts_demo_importer_our_skills_title'.$i;
    $ts_demo_importer_our_skills_url[$i] = 'ts_demo_importer_our_skills_url'.$i;
    $ts_demo_importer_our_skills_text[$i] = 'ts_demo_importer_our_skills_text'.$i;
    $ts_demo_importer_our_skills_percentage[$i] = 'ts_demo_importer_our_skills_percentage'.$i;
  }

  $skill_arr = array(
      'ts_demo_importer_our_skills_enable',
      'ts_demo_importer_our_skills_settings',
      'ts_demo_importer_our_skills_bgcolor',
      'ts_demo_importer_our_skills_bgimage',
      'ts_demo_importer_our_skills_bgimage_setting',
      'ts_demo_importer_our_skills_bgimage_size',
      'ts_demo_importer_our_skills_content_settings',
      'ts_demo_importer_our_skills_small_heading',
      'ts_demo_importer_our_skills_main_heading',
      'ts_demo_importer_our_skills_number',

  );

  $skill_arr_final = array_merge($skill_arr, $ts_demo_importer_our_skills_box_settings, $ts_demo_importer_our_skills_icon, $ts_demo_importer_our_skills_title, $ts_demo_importer_our_skills_url, $ts_demo_importer_our_skills_text, $ts_demo_importer_our_skills_percentage);

  $wp_customize->add_setting('ts_demo_importer_skill_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_skill_tab_settings', array(
      'section' => 'ts_demo_importer_our_skills',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $skill_arr_final,

          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_skills_color_settings',
                  'ts_demo_importer_our_skills_small_heading_ct_pallete',
                  'ts_demo_importer_our_skills_small_heading_color',
                  'ts_demo_importer_our_skills_small_heading_font_family',
                  'ts_demo_importer_our_skills_small_heading_font_size',
                  'ts_demo_importer_our_skills_small_heading_border_color1',
                  'ts_demo_importer_our_skills_small_heading_border_color2',
                  'ts_demo_importer_our_skills_main_heading_ct_pallete',
                  'ts_demo_importer_our_skills_main_heading_color',
                  'ts_demo_importer_our_skills_main_heading_font_family',
                  'ts_demo_importer_our_skills_main_heading_font_size',
                  'ts_demo_importer_our_skills_box_title_ct_pallete',
                  'ts_demo_importer_our_skills_box_title_color',
                  'ts_demo_importer_our_skills_box_title_font_family',
                  'ts_demo_importer_our_skills_box_title_font_size',
                  'ts_demo_importer_our_skills_box_text_ct_pallete',
                  'ts_demo_importer_our_skills_box_text_color',
                  'ts_demo_importer_our_skills_box_text_font_family',
                  'ts_demo_importer_our_skills_box_text_font_size',
                  'ts_demo_importer_our_skills_box_icon_ct_pallete',
                  'ts_demo_importer_our_skills_box_icon_color',
                  'ts_demo_importer_our_skills_box_icon_bgcolor',
                  'ts_demo_importer_our_skills_box_bgcolor',
                  'ts_demo_importer_our_skills_box_hover_bgcolor',
                  'ts_demo_importer_our_skills_box_border_color',
                  'ts_demo_importer_our_skills_box_hover_textcolor',
                  'ts_demo_importer_our_skills_box_hover_iconcolor',
                  'ts_demo_importer_our_skills_box_progress_bar_ct_pallete',
                  'ts_demo_importer_our_skills_box_progress_bar_color',
                  'ts_demo_importer_our_skills_box_progress_bar_color2',
                  'ts_demo_importer_our_skills_box_progress_bar_percentage_color',
                  'ts_demo_importer_our_skills_box_progress_bar_percentage_bgcolor',
                  'ts_demo_importer_our_skills_spacing_left_desktop',
                  'ts_demo_importer_our_skills_spacing_top_desktop',
                  'ts_demo_importer_our_skills_spacing_bottom_desktop',
                  'ts_demo_importer_our_skills_spacing_right_desktop',
                  'ts_demo_importer_our_skills_spacing',

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_our_skills_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));
  $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_our_skills_enable', array(
    'selector' => '#our-skills .container',
    'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_our_skills_enable',
  ));
  $wp_customize->add_setting( 'ts_demo_importer_our_skills_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_settings',
    array(
    'label' => __('Section Background Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));
  $wp_customize->add_setting( 'ts_demo_importer_our_skills_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_bgcolor', array(
    'label' => __('Section Background Color', 'ts-demo-importer'),
    'description'   => __('Either add background color or background image, if you add both background color will be top most priority','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_bgcolor',
  )));
  $wp_customize->add_setting('ts_demo_importer_our_skills_bgimage',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_our_skills_bgimage',array(
    'label' => __('Section Background Image','ts-demo-importer'),
    'description' => __('Dimension 1600px * 420px','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_bgimage'
  )));
  //Work Column Layout
  $wp_customize->add_setting( 'ts_demo_importer_our_skills_bgimage_setting', array(
      'default'         => '',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_bgimage_setting', array(
      'type'      => 'radio',
      'label'     => __('Choose image option', 'ts-demo-importer'),
      'section'   => 'ts_demo_importer_our_skills',
      'choices'   => array(
        'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
        'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
  )));

  $wp_customize->add_setting('ts_demo_importer_our_skills_bgimage_size', array(
      'default' => '',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_bgimage_size', array(
      'type' => 'radio',
      'label' => __('Background Image Size', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_skills',
      'choices' => array(
          'bg-auto' => __('Auto', 'ts-demo-importer'),
          'bg-cover' => __('Cover', 'ts-demo-importer'),
          'bg-contain' => __('Contain', 'ts-demo-importer'),
          'bg-xy' => __('Cover X & Y', 'ts-demo-importer'),
          'bg-x' => __('Cover X', 'ts-demo-importer'),
      )
  ));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_content_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_content_settings',
    array(
    'label' => __('Section Content Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting('ts_demo_importer_our_skills_small_heading',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_small_heading',array(
    'label' => __('Section Small Heading','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_small_heading',
    'type'    => 'text'
  ));
  $wp_customize->add_setting('ts_demo_importer_our_skills_main_heading',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_main_heading',array(
    'label' => __('Section Main Heading','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_main_heading',
    'type'    => 'text'
  ));


if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
  TSDemoImporterAddon::load_ourskiis_section_counter($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_our_skills_small_heading1',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_skills_small_heading1', array(
      'section' => 'ts_demo_importer_our_skills',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }


  $feature_no=get_theme_mod('ts_demo_importer_our_skills_number');
  for($i=1;$i<=$feature_no;$i++)
  {
    $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_settings'.$i,
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_box_settings'.$i,
      array(
      'label' => __('Skill ','ts-demo-importer').$i,
      'section' => 'ts_demo_importer_our_skills'
    )));

    // if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    //                 TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
    // }




    $wp_customize->add_setting(
      'ts_demo_importer_our_skills_icon'.$i,
      array(
        'default'     => '',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control(
      new ts_demo_importer_Fontawesome_Icon_Chooser(
        $wp_customize,
        'ts_demo_importer_our_skills_icon'.$i,
        array(
          'settings'    => 'ts_demo_importer_our_skills_icon'.$i,
          'section'   => 'ts_demo_importer_our_skills',
          'type'      => 'icon',
          'label'     => esc_html__( 'Choose Icon ', 'ts-demo-importer' ),
        )
      )
    );

    $wp_customize->add_setting('ts_demo_importer_our_skills_title'.$i,array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_skills_title'.$i,array(
      'label' => __('Skill Title ','ts-demo-importer').$i,
      'section' => 'ts_demo_importer_our_skills',
      'setting' => 'ts_demo_importer_our_skills_title'.$i,
      'type'    => 'text'
    ));
    $wp_customize->add_setting('ts_demo_importer_our_skills_url'.$i,array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_skills_url'.$i,array(
      'label' => __('Skill Title Url ','ts-demo-importer').$i,
      'section' => 'ts_demo_importer_our_skills',
      'setting' => 'ts_demo_importer_our_skills_url'.$i,
      'type'    => 'text'
    ));

    $wp_customize->add_setting('ts_demo_importer_our_skills_text'.$i,array(
      'default'   => '',
      'capability'         => 'edit_theme_options',
      'sanitize_callback'  => 'wp_kses_post'
    ));
    $wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_our_skills_text'.$i,array(
      'label' => __('Skill Text','ts-demo-importer').$i,
      'description' => __('Add Text','ts-demo-importer').$i,
      'section' => 'ts_demo_importer_our_skills',
      'setting'   => 'ts_demo_importer_our_skills_text'.$i,
    )));

    $wp_customize->add_setting('ts_demo_importer_our_skills_percentage'.$i,array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_skills_percentage'.$i,array(
      'label' => __('Percentage  ','ts-demo-importer').$i,
      'section' => 'ts_demo_importer_our_skills',
      'setting' => 'ts_demo_importer_our_skills_percentage'.$i,
      'type'    => 'number'
    ));
  }
  $wp_customize->add_setting( 'ts_demo_importer_our_skills_color_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_color_settings',
  array(
    'label' => __('Section Color & Typography','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_small_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_small_heading_ct_pallete',
    array(
    'label' => __('Small Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_small_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_small_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_small_heading_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_our_skills_small_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_our_skills_small_heading_font_family', array(
    'section'  => 'ts_demo_importer_our_skills',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_small_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_small_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_small_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_small_heading_border_color1', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_small_heading_border_color1', array(
    'label' => __('Heading Border Color 1', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_small_heading_border_color1',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_small_heading_border_color2', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_small_heading_border_color2', array(
    'label' => __('Heading Border Color 2', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_small_heading_border_color2',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_main_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_main_heading_ct_pallete',
    array(
    'label' => __('Main Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_main_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_main_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_main_heading_color',
  )));

  $wp_customize->add_setting('ts_demo_importer_our_skills_main_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_our_skills_main_heading_font_family', array(
    'section'  => 'ts_demo_importer_our_skills',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_main_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_main_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_main_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_title_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_box_title_ct_pallete',
    array(
    'label' => __('Box Title Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_title_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_title_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_title_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_our_skills_box_title_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_our_skills_box_title_font_family', array(
    'section'  => 'ts_demo_importer_our_skills',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_box_title_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_box_title_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_box_title_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_icon_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_box_icon_ct_pallete',
    array(
    'label' => __('Box Icon Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_icon_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_icon_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_icon_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_icon_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_icon_bgcolor', array(
    'label' => __('Icon Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_icon_bgcolor',
  )));


  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_text_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_box_text_ct_pallete',
    array(
    'label' => __('Box Text Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_text_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_text_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_text_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_our_skills_box_text_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_our_skills_box_text_font_family', array(
    'section'  => 'ts_demo_importer_our_skills',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_box_text_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_box_text_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'setting' => 'ts_demo_importer_our_skills_box_text_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_bgcolor', array(
    'label' => __('Box Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_bgcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_hover_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_hover_bgcolor', array(
    'label' => __('Box Hover Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_hover_bgcolor',
  )));

   $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_border_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_border_color', array(
    'label' => __('Box Border Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_border_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_hover_textcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_hover_textcolor', array(
    'label' => __('Box Hover Text Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_hover_textcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_hover_iconcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_hover_iconcolor', array(
    'label' => __('Box Hover Icon Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_hover_iconcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_progress_bar_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_skills_box_progress_bar_ct_pallete',
    array(
    'label' => __('Progress Bar Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_progress_bar_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_progress_bar_color', array(
    'label' => __('Bar Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_progress_bar_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_progress_bar_color2', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_progress_bar_color2', array(
    'label' => __('Bar Color 2', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_progress_bar_color2',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_progress_bar_percentage_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_progress_bar_percentage_color', array(
    'label' => __('Percentage Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_progress_bar_percentage_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_our_skills_box_progress_bar_percentage_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_skills_box_progress_bar_percentage_bgcolor', array(
    'label' => __('Percentage Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_skills',
    'settings' => 'ts_demo_importer_our_skills_box_progress_bar_percentage_bgcolor',
  )));

  $wp_customize->add_setting('ts_demo_importer_our_skills_spacing_left_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_spacing_top_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_spacing_bottom_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_skills_spacing_right_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_our_skills_spacing', array(
      'section' => 'ts_demo_importer_our_skills',
      'label' => esc_html__('Section Spacing(px)', 'total'),
      'settings' => array(
          'desktop_left' => 'ts_demo_importer_our_skills_spacing_left_desktop',
          'desktop_top' => 'ts_demo_importer_our_skills_spacing_top_desktop',
          'desktop_bottom' => 'ts_demo_importer_our_skills_spacing_bottom_desktop',
          'desktop_right' => 'ts_demo_importer_our_skills_spacing_right_desktop'
      ),
      'input_attrs' => array(
          'min' => 0,
          'max' => 100,
          'step' => 1,
      ),
      'responsive' => false
  )));
}

  // ------------ Our Services -----------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' || $template == 'advance-training-academy' ){
  $wp_customize->add_section('ts_demo_importer_our_services',array(
    'title' => __('Our Services','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_services_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  if ( $template == 'advance-training-academy') {
    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_services_tab_settings', array(
      'section' => 'ts_demo_importer_our_services',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_our_services_enable',
                  'ts_demo_importer_our_services_bg_settings',
                  'ts_demo_importer_our_services_bgcolor',
                  'ts_demo_importer_our_services_bgimage',
                  'ts_demo_importer_our_services_settings',
                  'ts_demo_importer_our_services_bgimage_size',
                  'ts_demo_importer_our_services_content_settings',
                  'ts_demo_importer_our_services_carousel_loop',
                  'ts_demo_importer_our_services_carousel_speed',
                  'ts_demo_importer_our_services_carousel_dots',
                  'ts_demo_importer_our_services_carousel_nav',
                  'ts_demo_importer_our_services_small_heading',
                  'ts_demo_importer_our_services_main_heading',
                  'ts_demo_importer_our_services_number',
                  'ts_demo_importer_our_services_box_link_text',
                  'ts_demo_importer_our_services_box_link_icon',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_services_color_settings',
                  'ts_demo_importer_our_services_small_heading_ct_pallete',
                  'ts_demo_importer_our_services_small_heading_color',
                  'ts_demo_importer_our_services_small_heading_font_family',
                  'ts_demo_importer_our_services_small_heading_font_size',
                  'ts_demo_importer_our_services_small_heading_border_color1',
                  'ts_demo_importer_our_services_small_heading_border_color2',
                  'ts_demo_importer_our_services_main_heading_ct_pallete',
                  'ts_demo_importer_our_services_main_heading_color',
                  'ts_demo_importer_our_services_main_heading_font_family',
                  'ts_demo_importer_our_services_main_heading_font_size',
                  'ts_demo_importer_our_services_title_ct_pallete',
                  'ts_demo_importer_our_services_title_color',
                  'ts_demo_importer_our_services_title_font_family',
                  'ts_demo_importer_our_services_title_font_size',
                  'ts_demo_importer_our_services_title_border_color',
                  'ts_demo_importer_our_services_text_ct_pallete',
                  'ts_demo_importer_our_services_text_color',
                  'ts_demo_importer_our_services_text_font_family',
                  'ts_demo_importer_our_services_text_font_size',
                  'ts_demo_importer_our_services_box_bgcolor',
                  'ts_demo_importer_our_services_box_hover_bgcolor',
                  'ts_demo_importer_our_services_box_hover_text_color',
                  'ts_demo_importer_our_services_link_overlay_color',
                  'ts_demo_importer_our_services_link_learn_more_ct_pallete',
                  'ts_demo_importer_our_services_link_learn_more_color',
                  'ts_demo_importer_our_services_link_learn_more_font_family',
                  'ts_demo_importer_our_services_link_learn_more_font_size',
                  'ts_demo_importer_our_services_spacing_left_desktop',
                  'ts_demo_importer_our_services_spacing_top_desktop',
                  'ts_demo_importer_our_services_spacing_bottom_desktop',
                  'ts_demo_importer_our_services_spacing_right_desktop',
                  'ts_demo_importer_our_services_spacing',
                ),
            )
        ),
    )));
  }elseif ($template == 'ts-conference') {
    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_services_tab_settings', array(
      'section' => 'ts_demo_importer_our_services',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_our_services_enable',
                  'ts_demo_importer_our_services_bg_settings',
                  'ts_demo_importer_our_services_bgcolor',
                  'ts_demo_importer_our_services_bgimage',
                  'ts_demo_importer_our_services_settings',
                  'ts_demo_importer_our_services_bgimage_size',
                  'ts_demo_importer_our_services_content_settings',
                  'ts_demo_importer_our_services_small_heading',
                  'ts_demo_importer_our_services_main_heading',
                  'ts_demo_importer_our_services_number'
              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_services_small_heading_ct_pallete',
                  'ts_demo_importer_our_services_small_heading_color',
                  'ts_demo_importer_our_services_small_heading_font_family',
                  'ts_demo_importer_our_services_small_heading_font_size',
                  'ts_demo_importer_our_services_main_heading_ct_pallete',
                  'ts_demo_importer_our_services_main_heading_color',
                  'ts_demo_importer_our_services_main_heading_font_family',
                  'ts_demo_importer_our_services_main_heading_font_size',
                  'ts_demo_importer_our_services_title_ct_pallete',
                  'ts_demo_importer_our_services_title_color',
                  'ts_demo_importer_our_services_title_font_family',
                  'ts_demo_importer_our_services_title_font_size',
                  'ts_demo_importer_our_services_text_ct_pallete',
                  'ts_demo_importer_our_services_text_color',
                  'ts_demo_importer_our_services_text_font_family',
                  'ts_demo_importer_our_services_text_font_size',
                  'ts_demo_importer_our_services_tab_title_ct_pallete',
                  'ts_demo_importer_our_services_tab_title_color',
                  'ts_demo_importer_our_services_tab_title_font_family',
                  'ts_demo_importer_our_services_tab_title_font_size',
                  'ts_demo_importer_our_services_active_tab_title_border_color',
                  'ts_demo_importer_our_services_over_image_title_ct_pallete',
                  'ts_demo_importer_our_services_over_image_title_color',
                  'ts_demo_importer_our_services_over_image_title_font_family',
                  'ts_demo_importer_our_services_over_image_title_font_size',
                  'ts_demo_importer_our_services_over_image_title_bgcolor',
                  ''
                ),
            )
        ),
    )));
  }else {
    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_services_tab_settings', array(
      'section' => 'ts_demo_importer_our_services',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_our_services_enable',
                  'ts_demo_importer_our_services_bg_settings',
                  'ts_demo_importer_our_services_bgcolor',
                  'ts_demo_importer_our_services_bgimage',
                  'ts_demo_importer_our_services_settings',
                  'ts_demo_importer_our_services_bgimage_size',
                  'ts_demo_importer_our_services_content_settings',
                  'ts_demo_importer_our_services_carousel_loop',
                  'ts_demo_importer_our_services_carousel_speed',
                  'ts_demo_importer_our_services_carousel_dots',
                  'ts_demo_importer_our_services_carousel_nav',
                  'ts_demo_importer_our_services_small_heading',
                  'ts_demo_importer_our_services_main_heading',
                  'ts_demo_importer_our_services_number',
                  'ts_demo_importer_our_services_box_link_text',
                  'ts_demo_importer_our_services_box_link_icon',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_services_color_settings',
                  'ts_demo_importer_our_services_small_heading_ct_pallete',
                  'ts_demo_importer_our_services_small_heading_color',
                  'ts_demo_importer_our_services_small_heading_font_family',
                  'ts_demo_importer_our_services_small_heading_font_size',
                  'ts_demo_importer_our_services_small_heading_border_color1',
                  'ts_demo_importer_our_services_small_heading_border_color2',
                  'ts_demo_importer_our_services_main_heading_ct_pallete',
                  'ts_demo_importer_our_services_main_heading_color',
                  'ts_demo_importer_our_services_main_heading_font_family',
                  'ts_demo_importer_our_services_main_heading_font_size',
                  'ts_demo_importer_our_services_title_ct_pallete',
                  'ts_demo_importer_our_services_title_color',
                  'ts_demo_importer_our_services_title_font_family',
                  'ts_demo_importer_our_services_title_font_size',
                  'ts_demo_importer_our_services_title_border_color',
                  'ts_demo_importer_our_services_text_ct_pallete',
                  'ts_demo_importer_our_services_text_color',
                  'ts_demo_importer_our_services_text_font_family',
                  'ts_demo_importer_our_services_text_font_size',
                  'ts_demo_importer_our_services_box_bgcolor',
                  'ts_demo_importer_our_services_box_hover_bgcolor',
                  'ts_demo_importer_our_services_box_hover_text_color',
                  'ts_demo_importer_our_services_link_overlay_color',
                  'ts_demo_importer_our_services_link_learn_more_ct_pallete',
                  'ts_demo_importer_our_services_link_learn_more_color',
                  'ts_demo_importer_our_services_link_learn_more_font_family',
                  'ts_demo_importer_our_services_link_learn_more_font_size',
                  'ts_demo_importer_our_services_spacing_left_desktop',
                  'ts_demo_importer_our_services_spacing_top_desktop',
                  'ts_demo_importer_our_services_spacing_bottom_desktop',
                  'ts_demo_importer_our_services_spacing_right_desktop',
                  'ts_demo_importer_our_services_spacing',
                ),
            )
        ),
    )));
  }

  $wp_customize->add_setting('ts_demo_importer_our_services_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_services_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_services',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
          TSDemoImporterAddon::load_our_services_section_setting($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_our_services_enable0',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_services_enable0', array(
      'section' => 'ts_demo_importer_our_services',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
}

  /*-------------------------------------------- Banner Section --------------------------------------*/
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_banner_sec',array(
    'title' => __('Banner Section','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_banner_tab_settings', array(
      'section' => 'ts_demo_importer_banner_sec',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_banner_enable',
                  'ts_demo_importer_banner_sec_bg_settings',
                  'ts_demo_importer_banner_bgcolor',
                  'ts_demo_importer_banner_bgimage',
                  'ts_demo_importer_banner_bgimage_attachment',
                  'ts_demo_importer_banner_bgimage_size',
                  'ts_demo_importer_banner_sec_content_settings',
                  'ts_demo_importer_banner_head',
                  'ts_demo_importer_banner_head2',
                  'ts_demo_importer_banner_text',
                  'ts_demo_importer_banner_ct_pallete',
                  'ts_demo_importer_banner_button_read_more',
                  'ts_demo_importer_banner_button_read_more_url',
                  'ts_demo_importer_banner_button_read_more_icon',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_banner_content_color_settings',
                  'ts_demo_importer_banner_small_heading_ct_pallete',
                  'ts_demo_importer_banner_small_heading_color',
                  'ts_demo_importer_banner_small_heading_font_family',
                  'ts_demo_importer_banner_small_heading_font_size',
                  'ts_demo_importer_banner_small_heading_border_color1',
                  'ts_demo_importer_banner_small_heading_border_color2',
                  'ts_demo_importer_banner_main_heading_ct_pallete',
                  'ts_demo_importer_banner_main_heading_color',
                  'ts_demo_importer_banner_main_heading_font_family',
                  'ts_demo_importer_banner_main_heading_font_size',
                  'ts_demo_importer_banner_text_ct_pallete',
                  'ts_demo_importer_banner_text_color',
                  'ts_demo_importer_banner_text_font_family',
                  'ts_demo_importer_banner_text_font_size',
                  'ts_demo_importer_banner_button_ct_pallete',
                  'ts_demo_importer_banner_button_color',
                  'ts_demo_importer_banner_button_font_family',
                  'ts_demo_importer_banner_button_font_size',
                  'ts_demo_importer_banner_button_bgcolor',
                  'ts_demo_importer_banner_button_hover_bgcolor',
                  'ts_demo_importer_banner_button_text_color_hover',
                  'ts_demo_importer_banner_overlay_color',
                  'ts_demo_importer_banner_sec_spacing_left_desktop',
                  'ts_demo_importer_banner_sec_spacing_top_desktop',
                  'ts_demo_importer_banner_sec_spacing_bottom_desktop',
                  'ts_demo_importer_banner_sec_spacing_right_desktop',
                  'ts_demo_importer_banner_sec_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_enable',
      array(
          'default' => 'Enable',
          'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_enable',
      array(
          'type' => 'radio',
          'label' => __('Do you want this section', 'ts-demo-importer'),
          'section' => 'ts_demo_importer_banner_sec',
          'choices' => array(
          'Enable' => __('Enable', 'ts-demo-importer'),
          'Disable' => __('Disable', 'ts-demo-importer')
          ),
  ));

  $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_banner_enable', array(
      'selector' => '#banner .section_main_head small',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_banner_enable',
  ) );

  $wp_customize->add_setting( 'ts_demo_importer_banner_sec_bg_settings',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_sec_bg_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_bgcolor', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_bgcolor', array(
        'label' => __('Background Color','ts-demo-importer'),
        'description' => __('Either add background color or background image, if you add both background color will be top most priority', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_banner_sec',
        'settings' => 'ts_demo_importer_banner_bgcolor',
    )));
    $wp_customize->add_setting('ts_demo_importer_banner_bgimage',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_banner_bgimage',
        array(
            'label' => __('Background Image','ts-demo-importer'),
            'description' => __('Dimension 1600px * 718px','ts-demo-importer'),
            'section' => 'ts_demo_importer_banner_sec',
            'settings' => 'ts_demo_importer_banner_bgimage'
    )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_bgimage_attachment', array(
    'default'         => '',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_bgimage_attachment', array(
    'type'      => 'radio',
    'label'     => __('Choose image option', 'ts-demo-importer'),
    'section'   => 'ts_demo_importer_banner_sec',
    'choices'   => array(
      'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
      'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_bgimage_size', array(
      'default' => '',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_bgimage_size', array(
      'type' => 'radio',
      'label' => __('Background Image Size', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_banner_sec',
      'choices' => array(
          'bg-auto' => __('Auto', 'ts-demo-importer'),
          'bg-cover' => __('Cover', 'ts-demo-importer'),
          'bg-contain' => __('Contain', 'ts-demo-importer'),
          'bg-xy' => __('100% 100%', 'ts-demo-importer'),
          'bg-x' => __('100%', 'ts-demo-importer'),
      )
  ));

  $wp_customize->add_setting( 'ts_demo_importer_banner_sec_content_settings',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_sec_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_head',array(
      'default'=> '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_head',array(
      'label' => __('Section Head 1','ts-demo-importer'),
      'section'=> 'ts_demo_importer_banner_sec',
      'setting'=> 'ts_demo_importer_banner_head',
      'type'=> 'text'
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_head2',array(
      'default'=> '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_head2',array(
      'label' => __('Section Head 2','ts-demo-importer'),
      'section'=> 'ts_demo_importer_banner_sec',
      'setting'=> 'ts_demo_importer_banner_head2',
      'type'=> 'text'
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_text', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize, 'ts_demo_importer_banner_text', array(
    'label' => __('Banner Text', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'setting' => 'ts_demo_importer_banner_text',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_ct_pallete',
    array(
    'label' => __('Section Button Setting ','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_button_read_more', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_button_read_more', array(
      'label' => __('Section Button Text', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_banner_sec',
      'setting' => 'ts_demo_importer_banner_button_read_more',
      'type' => 'text'
  ));


  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
          TSDemoImporterAddon::loadbtn_url_banner_section2($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_banner_button_read_more1',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_banner_button_read_more1', array(
      'section' => 'ts_demo_importer_banner_sec',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }




  $wp_customize->add_setting(
    'ts_demo_importer_banner_button_read_more_icon',
    array(
      'default'     => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
    new ts_demo_importer_Fontawesome_Icon_Chooser(
      $wp_customize,
      'ts_demo_importer_banner_button_read_more_icon',
      array(
        'settings'    => 'ts_demo_importer_banner_button_read_more_icon',
        'section'   => 'ts_demo_importer_banner_sec',
        'type'      => 'icon',
        'label'     => esc_html__( 'Choose Icon ', 'ts-demo-importer' ),
      )
    )
  );

  $wp_customize->add_setting('ts_demo_importer_banner_content_color_settings', array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control(new TS_Themes_Seperator_custom_Control($wp_customize, 'ts_demo_importer_banner_content_color_settings', array(
      'label' => __('Section Color & Typography', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_small_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_small_heading_ct_pallete',
    array(
    'label' => __('Small Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_small_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_small_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_small_heading_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_banner_small_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_banner_small_heading_font_family', array(
    'section'  => 'ts_demo_importer_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_small_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_small_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'setting' => 'ts_demo_importer_banner_small_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_banner_small_heading_border_color1', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_small_heading_border_color1', array(
    'label' => __('Heading Border Color 1', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_small_heading_border_color1',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_small_heading_border_color2', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_small_heading_border_color2', array(
    'label' => __('Heading Border Color 2', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_small_heading_border_color2',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_main_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_main_heading_ct_pallete',
    array(
    'label' => __('Main Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_main_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_main_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_main_heading_color',
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_main_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_banner_main_heading_font_family', array(
    'section'  => 'ts_demo_importer_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_main_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_main_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'setting' => 'ts_demo_importer_banner_main_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_banner_text_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_text_ct_pallete',
    array(
    'label' => __('Text Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_text_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_text_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_text_color',
  )));

  $wp_customize->add_setting('ts_demo_importer_banner_text_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_banner_text_font_family', array(
    'section'  => 'ts_demo_importer_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_text_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_text_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'setting' => 'ts_demo_importer_banner_text_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_banner_button_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_banner_button_ct_pallete',
    array(
    'label' => __('Button Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_button_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_button_color', array(
    'label' => __('Section Button Text Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_button_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_banner_button_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_banner_button_font_family', array(
    'section'  => 'ts_demo_importer_banner_sec',
    'label'    => __('Button Text Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_button_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_banner_button_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'setting' => 'ts_demo_importer_banner_button_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_banner_button_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_button_bgcolor', array(
    'label' => __(' Button Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_button_bgcolor',
  )));
  $wp_customize->add_setting( 'ts_demo_importer_banner_button_hover_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_button_hover_bgcolor', array(
    'label' => __('Section Button Hover Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_button_hover_bgcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_button_text_color_hover', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_banner_button_text_color_hover', array(
    'label' => __('Button Hover Text Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_banner_sec',
    'settings' => 'ts_demo_importer_banner_button_text_color_hover',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_banner_overlay_color',
     array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
     )
  );

  $wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_banner_overlay_color',
     array(
        'label' => __( 'Background Overlay','ts-demo-importer' ),
        'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
        'section' => 'ts_demo_importer_banner_sec',
        'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
        'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
           '#000',
           '#fff',
           '#df312c',
           '#df9a23',
           '#eef000',
           '#7ed934',
           '#1571c1',
           '#8309e7'
        )
     )
  ) );

  // $wp_customize->add_setting( 'ts_demo_importer_banner_overlay_color',
  //    array(
  //       'default' => '',
  //       'transport' => 'postMessage',
  //       'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
  //    )
  // );
  //
  // $wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_banner_overlay_color',
  //    array(
  //       'label' => __( 'Background Overlay','ts-demo-importer' ),
  //       'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
  //       'section' => 'ts_demo_importer_banner_sec',
  //       'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
  //       'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
  //          '#000',
  //          '#fff',
  //          '#df312c',
  //          '#df9a23',
  //          '#eef000',
  //          '#7ed934',
  //          '#1571c1',
  //          '#8309e7'
  //       )
  //    )
  // ) );

  $wp_customize->add_setting('ts_demo_importer_banner_sec_spacing_left_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_sec_spacing_top_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_sec_spacing_bottom_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_banner_sec_spacing_right_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_banner_sec_spacing', array(
      'section' => 'ts_demo_importer_banner_sec',
      'label' => esc_html__('Section Spacing(px)', 'total'),
      'settings' => array(
          'desktop_left' => 'ts_demo_importer_banner_sec_spacing_left_desktop',
          'desktop_top' => 'ts_demo_importer_banner_sec_spacing_top_desktop',
          'desktop_bottom' => 'ts_demo_importer_banner_sec_spacing_bottom_desktop',
          'desktop_right' => 'ts_demo_importer_banner_sec_spacing_right_desktop'
      ),
      'input_attrs' => array(
          'min' => 0,
          'max' => 100,
          'step' => 1,
      ),
      'responsive' => false
  )));
}


  // ---------- Our Projects -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_our_projects',array(
    'title' => __('Our Projects','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_projects_home_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_projects_home_tab_settings', array(
      'section' => 'ts_demo_importer_our_projects',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_our_projects_enable',
                  'ts_demo_importer_our_projects_settings',
                  'ts_demo_importer_our_projects_bgcolor',
                  'ts_demo_importer_our_projects_bgimage',
                  'ts_demo_importer_our_projects_bgimage_setting',
                  'ts_demo_importer_our_projects_bgimage_size',
                  'ts_demo_importer_our_projects_content_settings',
                  'ts_demo_importer_our_projects_carousel_loop',
                  'ts_demo_importer_our_projects_carousel_speed',
                  'ts_demo_importer_our_projects_carousel_dots',
                  'ts_demo_importer_our_projects_carousel_nav',
                  'ts_demo_importer_our_projects_small_heading',
                  'ts_demo_importer_our_projects_main_heading',
                  'ts_demo_importer_our_projects_number',
                  'ts_demo_importer_our_projects_box_link_text',
                  'ts_demo_importer_our_projects_box_link_icon',
                  'ts_demo_importer_our_projects_categoryselection_setting',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_projects_color_settings',
                  'ts_demo_importer_our_projects_small_heading_ct_pallete',
                  'ts_demo_importer_our_projects_small_heading_color',
                  'ts_demo_importer_our_projects_small_heading_font_family',
                  'ts_demo_importer_our_projects_small_heading_font_size',
                  'ts_demo_importer_our_projects_small_heading_border_color1',
                  'ts_demo_importer_our_projects_small_heading_border_color2',
                  'ts_demo_importer_our_projects_main_heading_ct_pallete',
                  'ts_demo_importer_our_projects_main_heading_color',
                  'ts_demo_importer_our_projects_main_heading_font_family',
                  'ts_demo_importer_our_projects_main_heading_font_size',
                  'ts_demo_importer_our_projects_title_ct_pallete',
                  'ts_demo_importer_our_projects_title_color',
                  'ts_demo_importer_our_projects_title_font_family',
                  'ts_demo_importer_our_projects_title_font_size',
                  'ts_demo_importer_our_projects_title_border_color',
                  'ts_demo_importer_our_projects_type_ct_pallete',
                  'ts_demo_importer_our_projects_type_color',
                  'ts_demo_importer_our_projects_type_font_family',
                  'ts_demo_importer_our_projects_type_font_size',
                  'ts_demo_importer_our_projects_short_title_ct_pallete',
                  'ts_demo_importer_our_projects_short_title_color',
                  'ts_demo_importer_our_projects_short_title_font_family',
                  'ts_demo_importer_our_projects_short_title_font_size',
                  'ts_demo_importer_our_projects_box_bgcolor',
                  'ts_demo_importer_our_projects_box_hover_bgcolor',
                  'ts_demo_importer_our_projects_box_hover_text_color',
                  'ts_demo_importer_our_projects_link_overlay_color',
                  'ts_demo_importer_our_projects_link_learn_more_ct_pallete',
                  'ts_demo_importer_our_projects_link_learn_more_color',
                  'ts_demo_importer_our_projects_link_learn_more_font_family',
                  'ts_demo_importer_our_projects_link_learn_more_font_size',
                  'ts_demo_importer_our_projects_spacing_left_desktop',
                  'ts_demo_importer_our_projects_spacing_top_desktop',
                  'ts_demo_importer_our_projects_spacing_bottom_desktop',
                  'ts_demo_importer_our_projects_spacing_right_desktop',
                  'ts_demo_importer_our_projects_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_our_projects_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_projects_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_projects',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
         TSDemoImporterAddon::load_our_project_section($wp_customize,$font_array);
       }else{
         $wp_customize->add_setting('ts_demo_importer_our_projects_enable',array(
           'default' => '',
           'sanitize_callback' => 'sanitize_text_field'
         ));
         $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_projects_enable', array(
           'section' => 'ts_demo_importer_our_projects',
           'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
           'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
           'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
           '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
           '</a>'
         ),
       )));
     }
}


// ----------------  Personalized support -------------------------------
if( $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){

  $wp_customize->add_section('ts_demo_importer_personalized_support_sec',array(
  'title' => __('Our supports Section','ts-demo-importer'),
  'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_personalized_support_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_personalized_support_tab_settings', array(
    'section' => 'ts_demo_importer_personalized_support_sec',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'ts_demo_importer_personalized_support_enabledisable',
                'ts_demo_importer_personalized_support_sec_bg_settings',
                'ts_demo_importer_personalized_support_background_color',
                'ts_demo_importer_personalized_support_bgimage',
                'ts_demo_importer_personalized_support_bgimage1',
                'ts_demo_importer_personalized_support_bgimage_attachment',
                'ts_demo_importer_personalized_support_bgimage_size',
                'ts_demo_importer_personalized_support_sec_content_settings',
                'ts_demo_importer_personalized_support_left_small_heading',
                'ts_demo_importer_personalized_support_left_main_heading',
                'ts_demo_importer_personalized_support_left_para',
                'ts_demo_importer_personalized_support_ct_pallete',
                'ts_demo_importer_personalized_support_button_get_a_guidebook',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_icon',
                'ts_demo_importer_personalized_support_records_number',
                'ts_demo_importer_personalized_support_records_number_box_settings1',
                'ts_demo_importer_personalized_support_records_number_box_settings2',
                'ts_demo_importer_personalized_support_records_number_box_settings3',
                'ts_demo_importer_personalized_support_records_number_box_settings4',
                'ts_demo_importer_personalized_support_records_no1',
                'ts_demo_importer_personalized_support_records_no2',
                'ts_demo_importer_personalized_support_records_no3',
                'ts_demo_importer_personalized_support_records_no4',
                'ts_demo_importer_personalized_support_records_title1',
                'ts_demo_importer_personalized_support_records_title2',
                'ts_demo_importer_personalized_support_records_title3',
                'ts_demo_importer_personalized_support_records_title4',
                'ts_demo_importer_personalized_support_records_para1',
                'ts_demo_importer_personalized_support_records_para2',
                'ts_demo_importer_personalized_support_records_para3',
                'ts_demo_importer_personalized_support_records_para4',
                        ),
        ),
        array(
            'name' => esc_html__('Style', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'ts_demo_importer_personalized_support_content_color_settings',
                'ts_demo_importer_personalized_support_left_small_heading_ct_pallete',
                'ts_demo_importer_personalized_support_left_small_heading_color',
                'ts_demo_importer_personalized_support_left_small_heading_font_family',
                'ts_demo_importer_personalized_support_left_small_heading_font_size',
                'ts_demo_importer_personalized_support_left_small_heading_border_color1',
                'ts_demo_importer_personalized_support_left_small_heading_border_color2',
                'ts_demo_importer_personalized_support_left_main_heading_ct_pallete',
                'ts_demo_importer_personalized_support_left_main_heading_color',
                'ts_demo_importer_personalized_support_left_main_heading_font_family',
                'ts_demo_importer_personalized_support_left_main_heading_font_size',
                'ts_demo_importer_personalized_support_left_para_ct_pallete',
                'ts_demo_importer_personalized_support_left_para_color',
                'ts_demo_importer_personalized_support_left_para_font_family',
                'ts_demo_importer_personalized_support_left_para_font_size',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_ct_pallete',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_color',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_font_family',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_font_size',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_bgcolor',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_hover_bgcolor',
                'ts_demo_importer_personalized_support_button_get_a_guidebook_button_text_color_hover',
                'ts_demo_importer_personalized_support_records_no_ct_pallete',
                'ts_demo_importer_personalized_support_records_no_color',
                'ts_demo_importer_personalized_support_records_no_font_family',
                'ts_demo_importer_personalized_support_records_no_font_size',
                'ts_demo_importer_personalized_support_records_title_ct_pallete',
                'ts_demo_importer_personalized_support_records_title_color',
                'ts_demo_importer_personalized_support_records_title_font_family',
                'ts_demo_importer_personalized_support_records_title_font_size',
                'ts_demo_importer_personalized_support_records_para_ct_pallete',
                'ts_demo_importer_personalized_support_records_para_color',
                'ts_demo_importer_personalized_support_records_para_font_family',
                'ts_demo_importer_personalized_support_records_para_font_size',
                'ts_demo_importer_personalized_support_records_box_ct_pallete',
                'ts_demo_importer_personalized_support_records_box_color',
                'ts_demo_importer_personalized_support_records_box_text_hover_color',
                'ts_demo_importer_personalized_support_records_box_hover_color',
                'ts_demo_importer_personalized_support_sec_spacing_left_desktop',
                'ts_demo_importer_personalized_support_sec_spacing_top_desktop',
                'ts_demo_importer_personalized_support_sec_spacing_bottom_desktop',
                'ts_demo_importer_personalized_support_sec_spacing_right_desktop',
            ),
        )
    ),
  )));

  $wp_customize->add_setting('ts_demo_importer_personalized_support_enabledisable',
    array(
        'default' => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_personalized_support_enabledisable',
    array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_personalized_support_sec',
        'choices' => array(
        'Enable' => __('Enable', 'ts-demo-importer'),
        'Disable' => __('Disable', 'ts-demo-importer')
        ),
  ));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
         TSDemoImporterAddon::load_personalized_support_section($wp_customize,$font_array);
       }else{
         $wp_customize->add_setting('ts_demo_importer_personalized_support_enabledisable_addon',array(
           'default' => '',
           'sanitize_callback' => 'sanitize_text_field'
         ));
         $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_personalized_support_enabledisable_addon', array(
           'section' => 'ts_demo_importer_personalized_support_sec',
           'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
           'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
           'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
           '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
           '</a>'
         ),
       )));
     }

}

    // ---------------- best services offered ------------------------------
if( $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_best_services_offered_sec',array(
  'title' => __('Best Services Offered To You','ts-demo-importer'),
  'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_best_services_offered_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_best_services_offered_tab_settings', array(
    'section' => 'ts_demo_importer_best_services_offered_sec',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'ts_demo_importer_best_services_offered_enable',
                'ts_demo_importer_best_services_offered_bgimage_settings',
                'ts_demo_importer_best_services_offered_bgcolor',
                'ts_demo_importer_best_services_offered_bgimage',
                'ts_demo_importer_best_services_offered_bgimage_setting',
                'ts_demo_importer_best_services_offered_bgimage_size',
                'ts_demo_importer_best_services_offered_content_settings',
                'ts_demo_importer_best_services_offered_small_heading',
                'ts_demo_importer_best_services_offered_main_heading',
                'ts_demo_importer_best_services_offered_video_bgimage',
                'ts_demo_importer_best_services_offered_video_back_bgimage',
                'ts_demo_importer_best_services_offered_video_link',
            ),
        ),
        array(
            'name' => esc_html__('Style', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'ts_demo_importer_best_services_offered_content_color_settings',
                'ts_demo_importer_best_services_offered_small_heading_ct_pallete',
                'ts_demo_importer_best_services_offered_small_heading_color',
                'ts_demo_importer_best_services_offered_small_heading_font_family',
                'ts_demo_importer_best_services_offered_small_heading_font_size',
                'ts_demo_importer_best_services_offered_small_heading_border_color1',
                'ts_demo_importer_best_services_offered_small_heading_border_color2',
                'ts_demo_importer_best_services_offered_main_heading_ct_pallete',
                'ts_demo_importer_best_services_offered_main_heading_color',
                'ts_demo_importer_best_services_offered_main_heading_font_family',
                'ts_demo_importer_best_services_offered_main_heading_font_size',
            ),
        )
    ),
  )));

  $wp_customize->add_setting('ts_demo_importer_best_services_offered_enable',
    array(
        'default' => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_best_services_offered_enable',
    array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_best_services_offered_sec',
        'choices' => array(
        'Enable' => __('Enable', 'ts-demo-importer'),
        'Disable' => __('Disable', 'ts-demo-importer')
        ),
  ));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
         TSDemoImporterAddon::load_best_services_offered_section($wp_customize,$font_array);
       }else{
         $wp_customize->add_setting('ts_demo_importer_best_services_offered_enable_addon',array(
           'default' => '',
           'sanitize_callback' => 'sanitize_text_field'
         ));
         $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_best_services_offered_enable_addon', array(
           'section' => 'ts_demo_importer_best_services_offered_sec',
           'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
           'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
           'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
           '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
           '</a>'
         ),
       )));
     }
}

  //-----------------Features ---------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' ){
  $wp_customize->add_section('ts_demo_importer_features',array(
    'title' => __('Features','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $feature_no=get_theme_mod('ts_demo_importer_features_number');

  $ts_demo_importer_features_box_settings = array();
  $ts_demo_importer_features_icon = array();
  $ts_demo_importer_features_title = array();
  $ts_demo_importer_features_title2 = array();
  $ts_demo_importer_features_url = array();

  for($i=1; $i<=$feature_no ;$i++){
    $ts_demo_importer_features_box_settings[$i] = 'ts_demo_importer_features_box_settings'.$i;
    $ts_demo_importer_features_icon[$i] = 'ts_demo_importer_features_icon'.$i;
    $ts_demo_importer_features_title[$i] = 'ts_demo_importer_features_title'.$i;
    $ts_demo_importer_features_title2[$i] = 'ts_demo_importer_features_title2'.$i;
    $ts_demo_importer_features_url[$i] = 'ts_demo_importer_features_url'.$i;
  }

  $feature_arr = array(
                  'ts_demo_importer_features_enable',
                  'ts_demo_importer_features_settings',
                  'ts_demo_importer_features_bgcolor',
                  'ts_demo_importer_features_bgimage',
                  'ts_demo_importer_features_bgimage_setting',
                  'ts_demo_importer_features_bgimage_size',
                  'ts_demo_importer_features_content_settings',
                  'ts_demo_importer_features_number',

              );

  $feature_arr_final = array_merge($feature_arr, $ts_demo_importer_features_box_settings, $ts_demo_importer_features_icon, $ts_demo_importer_features_title, $ts_demo_importer_features_title2, $ts_demo_importer_features_url);

$wp_customize->add_setting('ts_demo_importer_features_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_features_tab_settings', array(
      'section' => 'ts_demo_importer_features',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $feature_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_features_color_settings',
                  'ts_demo_importer_features_box_title_ct_pallete',
                  'ts_demo_importer_features_box_title_color',
                  'ts_demo_importer_features_box_title_font_family',
                  'ts_demo_importer_features_box_title_font_size',
                  'ts_demo_importer_features_box_text_ct_pallete',
                  'ts_demo_importer_features_box_text_color',
                  'ts_demo_importer_features_box_text_font_family',
                  'ts_demo_importer_features_box_text_font_size',
                  'ts_demo_importer_features_box_icon_ct_pallete',
                  'ts_demo_importer_features_box_icon_color',
                  'ts_demo_importer_features_box_icon_bgcolor',
                  'ts_demo_importer_features_box_color_ct_pallete',
                  'ts_demo_importer_features_box_bgcolor',
                  'ts_demo_importer_features_box_border_color',
                  'ts_demo_importer_features_box_hover_bgcolor',
                  'ts_demo_importer_features_box_hover_bgcolor',
                  'ts_demo_importer_features_box_hover_text_color',
                  'ts_demo_importer_features_box_hover_icon_color',
                  'ts_demo_importer_features_box_hover_icon_bg_color',
                  'ts_demo_importer_features_spacing_left_desktop',
                  'ts_demo_importer_features_spacing_top_desktop',
                  'ts_demo_importer_features_spacing_bottom_desktop',
                  'ts_demo_importer_features_spacing_right_desktop',
                  'ts_demo_importer_features_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_features_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_features_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_features',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));


  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_features_section($wp_customize,$font_array);
  }else{
  $wp_customize->add_setting('ts_demo_importer_features_enable1',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_features_enable1', array(
    'section' => 'ts_demo_importer_features',
    'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
    'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
    'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
    '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
    '</a>'
  ),
  )));
  }
}

  /*--------------------Team Section Multi Advance------------------------------*/

if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_team_section',array(
      'title'         => __('Team Section','ts-demo-importer'),
      'priority'      => null,
      'panel'         => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_team_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_team_tab_settings', array(
      'section' => 'ts_demo_importer_team_section',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_radio_team_enable',
                  'ts_demo_importer_our_team_back_option',
                  'ts_demo_importer_team_bgcolor',
                  'ts_demo_importer_our_team_bgimage',
                  'ts_demo_importer_our_team_bgimage_attachment',
                  'ts_demo_importer_our_team_content_option',
                  'ts_demo_importer_team_sec_title',
                  'ts_demo_importer_team_sec_main_title',
                  'ts_demo_importer_team_sec_subtitle',
                  'ts_demo_importer_team_sec_ct_pallete',
                  'ts_demo_importer_team_sec_button_read_more',
                  'ts_demo_importer_team_sec_button_read_more_url',
                  'ts_demo_importer_team_sec_button_read_more_icon',
                  'ts_demo_importer_our_team_option',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_team_content_color_settings',
                  'ts_demo_importer_our_team_small_heading_ct_pallete',
                  'ts_demo_importer_our_team_small_heading_color',
                  'ts_demo_importer_our_team_small_heading_font_family',
                  'ts_demo_importer_our_team_small_heading_font_size',
                  'ts_demo_importer_our_team_small_heading_border_color1',
                  'ts_demo_importer_our_team_small_heading_border_color2',
                  'ts_demo_importer_our_team_main_heading_ct_pallete',
                  'ts_demo_importer_our_team_main_heading_color',
                  'ts_demo_importer_our_team_main_heading_font_family',
                  'ts_demo_importer_our_team_main_heading_font_size',
                  'ts_demo_importer_our_team_text_ct_pallete',
                  'ts_demo_importer_our_team_text_color',
                  'ts_demo_importer_our_team_text_font_family',
                  'ts_demo_importer_our_team_text_font_size',
                  'ts_demo_importer_our_team_button_ct_pallete',
                  'ts_demo_importer_our_team_button_color',
                  'ts_demo_importer_our_team_button_font_family',
                  'ts_demo_importer_our_team_button_font_size',
                  'ts_demo_importer_our_team_button_bgcolor',
                  'ts_demo_importer_our_team_button_hover_bgcolor',
                  'ts_demo_importer_our_team_button_text_color_hover',
                  'ts_demo_importer_our_team_box_title_ct_pallete',
                  'ts_demo_importer_our_team_box_title_color',
                  'ts_demo_importer_our_team_box_title_font_family',
                  'ts_demo_importer_our_team_box_title_font_size',
                  'ts_demo_importer_our_team_box_desig_ct_pallete',
                  'ts_demo_importer_our_team_box_desig_color',
                  'ts_demo_importer_our_team_box_desig_font_family',
                  'ts_demo_importer_our_team_box_desig_font_size',
                  'ts_demo_importer_our_team_box_icon_ct_pallete',
                  'ts_demo_importer_our_team_box_icon_color',
                  'ts_demo_importer_our_team_box_icon_font_size',
                  'ts_demo_importer_our_team_box_bgcolor',
                  'ts_demo_importer_our_team_spacing_left_desktop',
                  'ts_demo_importer_our_team_spacing_top_desktop',
                  'ts_demo_importer_our_team_spacing_bottom_desktop',
                  'ts_demo_importer_our_team_spacing_right_desktop',
                  'ts_demo_importer_our_team_spacing',
              ),
          )
      ),
  )));

    $wp_customize->add_setting( 'ts_demo_importer_our_team_option',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    )
    );
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_team_option',
    array(
        'label' => __('Team Option','ts-demo-importer'),
        'section' => 'ts_demo_importer_team_section'
    )
    ) );
    $wp_customize->add_setting('ts_demo_importer_radio_team_enable',array(
        'default'           => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_radio_team_enable', array(
        'type'        => 'radio',
        'label'       => 'Do you want this section',
        'section'     => 'ts_demo_importer_team_section',
        'choices'     => array(
            'Enable'  => 'Enable',
            'Disable' => 'Disable'
        ),
    ));



    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_team_section($wp_customize,$font_array);

  }else{
    $wp_customize->add_setting('ts_demo_importer_radio_team_enable326',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_radio_team_enable326', array(
      'section' => 'ts_demo_importer_team_section',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
}

  /*-------------------------------------------- Hire Us Section --------------------------------------*/
if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_hire_us_sec',array(
    'title' => __('Hire Us Section','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_hire_us_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_hire_us_tab_settings', array(
      'section' => 'ts_demo_importer_hire_us_sec',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_hire_us_enable',
                  'ts_demo_importer_hire_us_sec_bg_settings',
                  'ts_demo_importer_hire_us_bgcolor',
                  'ts_demo_importer_hire_us_bgimage',
                  'ts_demo_importer_hire_us_bgimage_attachment',
                  'ts_demo_importer_hire_us_bgimage_size',
                  'ts_demo_importer_hire_us_sec_content_settings',
                  'ts_demo_importer_hire_us_head',
                  'ts_demo_importer_hire_us_head2',
                  'ts_demo_importer_hire_us_ct_pallete',
                  'ts_demo_importer_hire_us_button_read_more',
                  'ts_demo_importer_hire_us_button_read_more_url',
                  'ts_demo_importer_hire_us_button_read_more_icon',
                  'ts_demo_importer_hire_us_spacing_left_desktop',
                  'ts_demo_importer_hire_us_spacing_top_desktop',
                  'ts_demo_importer_hire_us_spacing_bottom_desktop',
                  'ts_demo_importer_hire_us_spacing_right_desktop',
                  'ts_demo_importer_hire_us_spacing',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_hire_us_content_color_settings',
                  'ts_demo_importer_hire_us_small_heading_ct_pallete',
                  'ts_demo_importer_hire_us_small_heading_color',
                  'ts_demo_importer_hire_us_small_heading_font_family',
                  'ts_demo_importer_hire_us_small_heading_font_size',
                  'ts_demo_importer_hire_us_small_heading_border_color1',
                  'ts_demo_importer_hire_us_small_heading_border_color2',
                  'ts_demo_importer_hire_us_main_heading_ct_pallete',
                  'ts_demo_importer_hire_us_main_heading_color',
                  'ts_demo_importer_hire_us_main_heading_font_family',
                  'ts_demo_importer_hire_us_main_heading_font_size',
                  'ts_demo_importer_hire_us_button_ct_pallete',
                  'ts_demo_importer_hire_us_button_color',
                  'ts_demo_importer_hire_us_button_font_family',
                  'ts_demo_importer_hire_us_button_font_size',
                  'ts_demo_importer_hire_us_button_bgcolor',
                  'ts_demo_importer_hire_us_button_hover_bgcolor',
                  'ts_demo_importer_hire_us_button_text_color_hover'

              ),
          )
      ),
  )));
  $wp_customize->add_setting('ts_demo_importer_hire_us_enable',
      array(
          'default' => 'Enable',
          'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_hire_us_enable',
      array(
          'type' => 'radio',
          'label' => __('Do you want this section', 'ts-demo-importer'),
          'section' => 'ts_demo_importer_hire_us_sec',
          'choices' => array(
          'Enable' => __('Enable', 'ts-demo-importer'),
          'Disable' => __('Disable', 'ts-demo-importer')
          ),
  ));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
          TSDemoImporterAddon::load_hire_us_section($wp_customize,$font_array);
          }else{
            $wp_customize->add_setting('ts_demo_importer_hire_us_enable1',array(
              'default' => '',
              'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_hire_us_enable1', array(
              'section' => 'ts_demo_importer_hire_us_sec',
              'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
              'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
              'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
              '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
              '</a>'
            ),
          )));
        }

  // if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
  //         TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
  // }
}

  // -------------- Pricing Plan --------------

if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_pricing_plan',array(
    'title' => __('Pricing Plan','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $plan_no=get_theme_mod('ts_demo_importer_pricing_plan_number');


  $ts_demo_importer_pricing_plan_box_settings = array();
  $ts_demo_importer_pricing_plan_icon = array();
  $ts_demo_importer_pricing_plan_title = array();
  $ts_demo_importer_pricing_plan_price_currency = array();
  $ts_demo_importer_pricing_plan_price = array();
  $ts_demo_importer_pricing_plan_duration = array();
  $ts_demo_importer_pricing_plan_feature_no = array();
  $ts_demo_importer_pricing_plan_button_title = array();
  $ts_demo_importer_pricing_plan_button_icon = array();
  $ts_demo_importer_pricing_plan_button_url = array();
  $ts_demo_importer_pricing_plan_feature_title = array();

  $k = 1;

  for($i=1; $i<=$plan_no ;$i++){
    $ts_demo_importer_pricing_plan_box_settings[$i] = 'ts_demo_importer_pricing_plan_box_settings'.$i;
    $ts_demo_importer_pricing_plan_icon[$i] = 'ts_demo_importer_pricing_plan_icon'.$i;
    $ts_demo_importer_pricing_plan_title[$i] = 'ts_demo_importer_pricing_plan_title'.$i;
    $ts_demo_importer_pricing_plan_price_currency[$i] = 'ts_demo_importer_pricing_plan_price_currency'.$i;
    $ts_demo_importer_pricing_plan_price[$i] = 'ts_demo_importer_pricing_plan_price'.$i;
    $ts_demo_importer_pricing_plan_duration[$i] = 'ts_demo_importer_pricing_plan_duration'.$i;
    $ts_demo_importer_pricing_plan_feature_no[$i] = 'ts_demo_importer_pricing_plan_feature_no'.$i;
    $ts_demo_importer_pricing_plan_button_title[$i] = 'ts_demo_importer_pricing_plan_button_title'.$i;
    $ts_demo_importer_pricing_plan_button_icon[$i] = 'ts_demo_importer_pricing_plan_button_icon'.$i;
    $ts_demo_importer_pricing_plan_button_url[$i] = 'ts_demo_importer_pricing_plan_button_url'.$i;

    $plan_feature = get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i);

    for($j=1; $j<=$plan_feature; $j++){

      $ts_demo_importer_pricing_plan_feature_title[$k] = 'ts_demo_importer_pricing_plan_feature_title'.$i.$j;

      $k++;
    }
  }

  $plan_arr = array(
                  'ts_demo_importer_pricing_plan_enable',
                  'ts_demo_importer_pricing_plan_settings',
                  'ts_demo_importer_pricing_plan_bgcolor',
                  'ts_demo_importer_pricing_plan_bgimage',
                  'ts_demo_importer_pricing_plan_bgimage_setting',
                  'ts_demo_importer_pricing_plan_bgimage_size',
                  'ts_demo_importer_pricing_plan_content_settings',
                  'ts_demo_importer_pricing_plan_small_heading',
                  'ts_demo_importer_pricing_plan_main_heading',
                  'ts_demo_importer_pricing_plan_number',
                  'ts_demo_importer_pricing_plan_feature_icon'
              );

  $plan_arr_final = array_merge($plan_arr, $ts_demo_importer_pricing_plan_box_settings, $ts_demo_importer_pricing_plan_icon, $ts_demo_importer_pricing_plan_title, $ts_demo_importer_pricing_plan_price_currency, $ts_demo_importer_pricing_plan_price,$ts_demo_importer_pricing_plan_duration,$ts_demo_importer_pricing_plan_feature_no, $ts_demo_importer_pricing_plan_button_title, $ts_demo_importer_pricing_plan_button_icon, $ts_demo_importer_pricing_plan_button_url, $ts_demo_importer_pricing_plan_feature_title);

$wp_customize->add_setting('ts_demo_importer_pricing_plan_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_pricing_plan_tab_settings', array(
      'section' => 'ts_demo_importer_pricing_plan',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $plan_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_pricing_plan_color_settings',
                  'ts_demo_importer_pricing_plan_small_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_small_heading_color',
                  'ts_demo_importer_pricing_plan_small_heading_font_family',
                  'ts_demo_importer_pricing_plan_small_heading_font_size',
                  'ts_demo_importer_pricing_plan_small_heading_border_color1',
                  'ts_demo_importer_pricing_plan_small_heading_border_color2',
                  'ts_demo_importer_pricing_plan_main_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_main_heading_color',
                  'ts_demo_importer_pricing_plan_main_heading_font_family',
                  'ts_demo_importer_pricing_plan_main_heading_font_size',
                  'ts_demo_importer_pricing_plan_title_odd_ct_pallete',
                  'ts_demo_importer_pricing_plan_title_oddbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_title_odd_color',
                  'ts_demo_importer_pricing_plan_title_odd_font_family',
                  'ts_demo_importer_pricing_plan_title_odd_font_size',
                  'ts_demo_importer_pricing_plan_title_evenbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_title_even_color',
                  'ts_demo_importer_pricing_plan_title_even_font_family',
                  'ts_demo_importer_pricing_plan_title_even_font_size',
                  'ts_demo_importer_pricing_plan_icon_ct_pallete',
                  'ts_demo_importer_pricing_plan_icon_odd_bgcolor',
                  'ts_demo_importer_pricing_plan_icon_odd_color',
                  'ts_demo_importer_pricing_plan_icon_even_bgcolor',
                  'ts_demo_importer_pricing_plan_icon_even_color',
                  'ts_demo_importer_pricing_plan_border_ct_pallete',
                  'ts_demo_importer_pricing_plan_border_odd_color',
                  'ts_demo_importer_pricing_plan_border_even_color',
                  'ts_demo_importer_pricing_plan_price_odd_ct_pallete',
                  'ts_demo_importer_pricing_plan_price_oddbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_price_odd_color',
                  'ts_demo_importer_pricing_plan_price_odd_font_family',
                  'ts_demo_importer_pricing_plan_price_odd_font_size',
                  'ts_demo_importer_pricing_plan_price_evenbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_price_even_color',
                  'ts_demo_importer_pricing_plan_price_even_font_family',
                  'ts_demo_importer_pricing_plan_price_even_font_size',
                  'ts_demo_importer_pricing_plan_package_ct_pallete',
                  'ts_demo_importer_pricing_plan_package_oddbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_package_odd_color',
                  'ts_demo_importer_pricing_plan_package_odd_font_family',
                  'ts_demo_importer_pricing_plan_package_odd_font_size',
                  'ts_demo_importer_pricing_plan_package_evenbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_package_even_color',
                  'ts_demo_importer_pricing_plan_package_even_font_family',
                  'ts_demo_importer_pricing_plan_package_even_font_size',
                  'ts_demo_importer_pricing_plan_feature_odd_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_oddbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_odd_color',
                  'ts_demo_importer_pricing_plan_feature_odd_font_family',
                  'ts_demo_importer_pricing_plan_feature_odd_font_size',
                  'ts_demo_importer_pricing_plan_feature_icon_odd_color',
                  'ts_demo_importer_pricing_plan_feature_icon_odd_bgcolor',
                  'ts_demo_importer_pricing_plan_feature_evenbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_even_color',
                  'ts_demo_importer_pricing_plan_feature_even_font_family',
                  'ts_demo_importer_pricing_plan_feature_even_font_size',
                  'ts_demo_importer_pricing_plan_feature_icon_even_color',
                  'ts_demo_importer_pricing_plan_feature_icon_even_bgcolor',
                  'ts_demo_importer_pricing_plan_feature_button_odd_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_sub_oddbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_button_title_odd_color',
                  'ts_demo_importer_pricing_plan_button_title_odd_font_family',
                  'ts_demo_importer_pricing_plan_button_title_odd_font_size',
                  'ts_demo_importer_pricing_plan_button_title_odd_bgcolor',
                  'ts_demo_importer_pricing_plan_button_title_odd_bgcolor_hover',
                  'ts_demo_importer_pricing_plan_button_title_odd_color_hover',
                  'ts_demo_importer_pricing_plan_feature_sub_evenbox_ct_pallete',
                  'ts_demo_importer_pricing_plan_button_title_even_color',
                  'ts_demo_importer_pricing_plan_button_title_even_font_family',
                  'ts_demo_importer_pricing_plan_button_title_even_font_size',
                  'ts_demo_importer_pricing_plan_button_title_even_font_size',
                  'ts_demo_importer_pricing_plan_button_title_even_bgcolor',
                  'ts_demo_importer_pricing_plan_button_title_even_bgcolor_hover',
                  'ts_demo_importer_pricing_plan_button_title_even_color_hover',
                  'ts_demo_importer_pricing_plan_box_odd_bgcolor',
                  'ts_demo_importer_pricing_plan_box_even_bgcolor',
                  'ts_demo_importer_pricing_plan_background_box_color',
                  'ts_demo_importer_pricing_plan_spacing_left_desktop',
                  'ts_demo_importer_pricing_plan_spacing_top_desktop',
                  'ts_demo_importer_pricing_plan_spacing_bottom_desktop',
                  'ts_demo_importer_pricing_plan_spacing_right_desktop',
                  'ts_demo_importer_pricing_plan_spacing',
              ),
          )
      ),
  )));
  $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_pricing_plan_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_pricing_plan',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_pricing_plan_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_pricing_plan_enable1', array(
        'section' => 'ts_demo_importer_pricing_plan',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
} elseif ( $template == 'advance-consultancy' ) {
  $wp_customize->add_section('ts_demo_importer_pricing_plan',array(
    'title' => __('Pricing Plan','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $plan_no=get_theme_mod('ts_demo_importer_pricing_plan_number');


  $ts_demo_importer_pricing_plan_box_settings = array();
  $ts_demo_importer_pricing_plan_icon = array();
  $ts_demo_importer_pricing_plan_title = array();
  $ts_demo_importer_pricing_plan_price_currency = array();
  $ts_demo_importer_pricing_plan_price = array();
  $ts_demo_importer_pricing_plan_duration = array();
  $ts_demo_importer_pricing_plan_feature_no = array();
  $ts_demo_importer_pricing_plan_button_title = array();
  $ts_demo_importer_pricing_plan_button_icon = array();
  $ts_demo_importer_pricing_plan_button_url = array();
  $ts_demo_importer_pricing_plan_feature_title = array();

  $k = 1;

  for($i=1; $i<=$plan_no ;$i++){
    $ts_demo_importer_pricing_plan_box_settings[$i] = 'ts_demo_importer_pricing_plan_box_settings'.$i;
    $ts_demo_importer_pricing_plan_icon[$i] = 'ts_demo_importer_pricing_plan_icon'.$i;
    $ts_demo_importer_pricing_plan_title[$i] = 'ts_demo_importer_pricing_plan_title'.$i;
    $ts_demo_importer_pricing_plan_price_currency[$i] = 'ts_demo_importer_pricing_plan_price_currency'.$i;
    $ts_demo_importer_pricing_plan_price[$i] = 'ts_demo_importer_pricing_plan_price'.$i;
    $ts_demo_importer_pricing_plan_duration[$i] = 'ts_demo_importer_pricing_plan_duration'.$i;
    $ts_demo_importer_pricing_plan_feature_no[$i] = 'ts_demo_importer_pricing_plan_feature_no'.$i;
    $ts_demo_importer_pricing_plan_button_title[$i] = 'ts_demo_importer_pricing_plan_button_title'.$i;
    $ts_demo_importer_pricing_plan_button_icon[$i] = 'ts_demo_importer_pricing_plan_button_icon'.$i;
    $ts_demo_importer_pricing_plan_button_url[$i] = 'ts_demo_importer_pricing_plan_button_url'.$i;

    $plan_feature = get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i);

    for($j=1; $j<=$plan_feature; $j++){

      $ts_demo_importer_pricing_plan_feature_title[$k] = 'ts_demo_importer_pricing_plan_feature_title'.$i.$j;

      $k++;
    }
  }

  $plan_arr = array(
                  'ts_demo_importer_pricing_plan_enable',
                  'ts_demo_importer_pricing_plan_settings',
                  'ts_demo_importer_pricing_plan_bgcolor',
                  'ts_demo_importer_pricing_plan_bgimage',
                  'ts_demo_importer_pricing_plan_bgimage_setting',
                  'ts_demo_importer_pricing_plan_bgimage_size',
                  'ts_demo_importer_pricing_plan_content_settings',
                  'ts_demo_importer_pricing_plan_small_heading',
                  'ts_demo_importer_pricing_plan_main_heading',
                  'ts_demo_importer_pricing_plan_number',
                  'ts_demo_importer_pricing_plan_box_settings',
                  'ts_demo_importer_pricing_plan_icon',
                  'ts_demo_importer_pricing_plan_title',
                  'ts_demo_importer_pricing_plan_price_currency',
                  'ts_demo_importer_pricing_plan_price',
                  'ts_demo_importer_pricing_plan_duration',
                  'ts_demo_importer_pricing_plan_feature_no',
                  'ts_demo_importer_pricing_plan_feature_title',
                  'ts_demo_importer_pricing_plan_button_title',
                  'ts_demo_importer_pricing_plan_button_icon',
                  'ts_demo_importer_pricing_plan_button_url',
                  'ts_demo_importer_pricing_plan_feature_icon',
              );

  $plan_arr_final = array_merge($plan_arr, $ts_demo_importer_pricing_plan_box_settings, $ts_demo_importer_pricing_plan_icon, $ts_demo_importer_pricing_plan_title, $ts_demo_importer_pricing_plan_price_currency, $ts_demo_importer_pricing_plan_price,$ts_demo_importer_pricing_plan_duration,$ts_demo_importer_pricing_plan_feature_no, $ts_demo_importer_pricing_plan_button_title, $ts_demo_importer_pricing_plan_button_icon, $ts_demo_importer_pricing_plan_button_url, $ts_demo_importer_pricing_plan_feature_title);

$wp_customize->add_setting('ts_demo_importer_pricing_plan_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_pricing_plan_tab_settings', array(
      'section' => 'ts_demo_importer_pricing_plan',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $plan_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_pricing_plan_color_settings',
                  'ts_demo_importer_pricing_plan_small_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_small_heading_color',
                  'ts_demo_importer_pricing_plan_small_heading_font_family',
                  'ts_demo_importer_pricing_plan_small_heading_font_size',
                  'ts_demo_importer_pricing_plan_small_heading_border_color1',
                  'ts_demo_importer_pricing_plan_small_heading_border_color2',
                  'ts_demo_importer_pricing_plan_main_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_main_heading_color',
                  'ts_demo_importer_pricing_plan_main_heading_font_family',
                  'ts_demo_importer_pricing_plan_main_heading_font_size',
                  'ts_demo_importer_pricing_plan_start_up_title_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_title_color',
                  'ts_demo_importer_pricing_plan_start_up_title_font_family',
                  'ts_demo_importer_pricing_plan_start_up_title_font_size',
                  'ts_demo_importer_pricing_plan_start_up_price_typo_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_price_typo_color',
                  'ts_demo_importer_pricing_plan_start_up_price_typo_font_family',
                  'ts_demo_importer_pricing_plan_start_up_price_typo_font_size',
                  'ts_demo_importer_pricing_plan_start_up_feature_active_text_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_feature_active_text_color',
                  'ts_demo_importer_pricing_plan_start_up_feature_active_text_font_family',
                  'ts_demo_importer_pricing_plan_start_up_feature_active_text_font_size',
                  'ts_demo_importer_pricing_plan_start_up_feature_text_border_color',
                  'ts_demo_importer_pricing_plan_start_up_package_content_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_package_content_color',
                  'ts_demo_importer_pricing_plan_start_up_package_content_font_family',
                  'ts_demo_importer_pricing_plan_start_up_package_content_font_size',
                  'ts_demo_importer_pricing_plan_start_up_button_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_button_icon_color',
                  'ts_demo_importer_pricing_plan_start_up_button_icon_font_size',
                  'ts_demo_importer_pricing_plan_start_up_button_color',
                  'ts_demo_importer_pricing_plan_start_up_button_font_family',
                  'ts_demo_importer_pricing_plan_start_up_button_font_size',
                  'ts_demo_importer_pricing_plan_start_up_button_bgcolor',
                  'ts_demo_importer_pricing_plan_start_up_box_typo_ct_pallete',
                  'ts_demo_importer_pricing_plan_start_up_box_border_color',
                  'ts_demo_importer_pricing_plan_start_up_box_bgcolor',
                  'ts_demo_importer_pricing_plan_spacing_left_desktop',
                  'ts_demo_importer_pricing_plan_spacing_top_desktop',
                  'ts_demo_importer_pricing_plan_spacing_bottom_desktop',
                  'ts_demo_importer_pricing_plan_spacing_right_desktop',
                  'ts_demo_importer_pricing_plan_spacing'


              ),
          )
      ),
  )));
  $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_pricing_plan_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_pricing_plan',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));
  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_pricing_plan_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_pricing_plan_enable1', array(
        'section' => 'ts_demo_importer_pricing_plan',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
}elseif ( $template == 'ts-conference') {
  $wp_customize->add_section('ts_demo_importer_pricing_plan',array(
    'title' => __('Pricing Plan','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $plan_no=get_theme_mod('ts_demo_importer_pricing_plan_number');


  $ts_demo_importer_pricing_plan_box_settings = array();
  $ts_demo_importer_pricing_plan_icon = array();
  $ts_demo_importer_pricing_plan_title = array();
  $ts_demo_importer_pricing_plan_price_currency = array();
  $ts_demo_importer_pricing_plan_price = array();
  $ts_demo_importer_pricing_plan_duration = array();
  $ts_demo_importer_pricing_plan_feature_no = array();
  $ts_demo_importer_pricing_plan_button_title = array();
  $ts_demo_importer_pricing_plan_button_icon = array();
  $ts_demo_importer_pricing_plan_button_url = array();
  $ts_demo_importer_pricing_plan_feature_title = array();

  $k = 1;

  for($i=1; $i<=$plan_no ;$i++){
    $ts_demo_importer_pricing_plan_settings[$i] = 'ts_demo_importer_pricing_plan_settings'.$i;
    $ts_demo_importer_pricing_plan_feature_heading[$i] = 'ts_demo_importer_pricing_plan_feature_heading'.$i;
    $ts_demo_importer_pricing_plan_price[$i] = 'ts_demo_importer_pricing_plan_price'.$i;
    $ts_demo_importer_pricing_plan_per_user[$i] = 'ts_demo_importer_pricing_plan_per_user'.$i;
    $ts_demo_importer_pricing_plan_short_description[$i] = 'ts_demo_importer_pricing_plan_short_description'.$i;
    $ts_demo_importer_pricing_plan_feature_no[$i] = 'ts_demo_importer_pricing_plan_feature_no'.$i;
    $ts_demo_importer_pricing_plan_get_started_btn[$i] = 'ts_demo_importer_pricing_plan_get_started_btn'.$i;
    $ts_demo_importer_pricing_plan_get_started_btn_url[$i] = 'ts_demo_importer_pricing_plan_get_started_btn_url'.$i;

    $plan_feature = get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i);
    for($j=1; $j<=$plan_feature; $j++){
      $ts_demo_importer_pricing_plan_feature_title[$k] = 'ts_demo_importer_pricing_plan_feature_title'.$i.$j;
      $k++;
    }
  }

  $plan_arr = array(
                  'ts_demo_importer_pricing_plan_enable',
                  'ts_demo_importer_pricing_plan_settings',
                  'ts_demo_importer_pricing_plan_bgcolor',
                  'ts_demo_importer_pricing_plan_bgimage',
                  'ts_demo_importer_pricing_plan_bgimage_setting',
                  'ts_demo_importer_pricing_plan_bgimage_size',
                  'ts_demo_importer_pricing_plan_content_settings',
                  'ts_demo_importer_pricing_plan_small_heading',
                  'ts_demo_importer_pricing_plan_main_heading',
                  'ts_demo_importer_pricing_plan_number',
              );

  $plan_arr_final = array_merge($plan_arr, $ts_demo_importer_pricing_plan_settings, $ts_demo_importer_pricing_plan_feature_heading, $ts_demo_importer_pricing_plan_price, $ts_demo_importer_pricing_plan_per_user, $ts_demo_importer_pricing_plan_short_description,$ts_demo_importer_pricing_plan_feature_no,$ts_demo_importer_pricing_plan_get_started_btn, $ts_demo_importer_pricing_plan_get_started_btn_url, $ts_demo_importer_pricing_plan_feature_title );

$wp_customize->add_setting('ts_demo_importer_pricing_plan_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_pricing_plan_tab_settings', array(
      'section' => 'ts_demo_importer_pricing_plan',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $plan_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_pricing_plan_small_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_small_heading_color',
                  'ts_demo_importer_pricing_plan_small_heading_font_family',
                  'ts_demo_importer_pricing_plan_small_heading_font_size',
                  'ts_demo_importer_pricing_plan_main_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_main_heading_color',
                  'ts_demo_importer_pricing_plan_main_heading_font_family',
                  'ts_demo_importer_pricing_plan_main_heading_font_size',
                  'ts_demo_importer_pricing_plan_feature_heading_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_heading_color',
                  'ts_demo_importer_pricing_plan_feature_heading_font_family',
                  'ts_demo_importer_pricing_plan_feature_heading_font_size',
                  'ts_demo_importer_pricing_plan_feature_heading_bgcolor',
                  'ts_demo_importer_pricing_plan_price_ct_pallete',
                  'ts_demo_importer_pricing_plan_price_color',
                  'ts_demo_importer_pricing_plan_price_font_family',
                  'ts_demo_importer_pricing_plan_price_font_size',
                  'ts_demo_importer_pricing_plan_short_description_ct_pallete',
                  'ts_demo_importer_pricing_plan_short_description_color',
                  'ts_demo_importer_pricing_plan_short_description_font_family',
                  'ts_demo_importer_pricing_plan_short_description_font_size',
                  'ts_demo_importer_pricing_plan_feature_title_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_title_color',
                  'ts_demo_importer_pricing_plan_feature_title_font_family',
                  'ts_demo_importer_pricing_plan_feature_title_font_size',
                  'ts_demo_importer_pricing_plan_feature_title_icon_ct_pallete',
                  'ts_demo_importer_pricing_plan_feature_title_icon_icon_color',
                  'ts_demo_importer_pricing_plan_feature_title_icon_icon_font_size',
                  'ts_demo_importer_pricing_plan_get_started_btn_ct_pallete',
                  'ts_demo_importer_pricing_plan_get_started_btn_color',
                  'ts_demo_importer_pricing_plan_get_started_btn_font_family',
                  'ts_demo_importer_pricing_plan_get_started_btn_font_size',
              ),
          )
      ),
  )));
  $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_pricing_plan_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_pricing_plan',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));
  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_pricing_plan_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_pricing_plan_enable1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_pricing_plan_enable1', array(
        'section' => 'ts_demo_importer_pricing_plan',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
}

  /*-------------------------------------------- Quote Banner Section --------------------------------------*/

if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_quote_banner_sec',array(
    'title' => __('Quote Banner Section','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_quote_banner_tab_settings', array(
      'section' => 'ts_demo_importer_quote_banner_sec',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_quote_banner_enable',
                  'ts_demo_importer_quote_banner_sec_bg_settings',
                  'ts_demo_importer_quote_banner_bgcolor',
                  'ts_demo_importer_quote_banner_bgimage',
                  'ts_demo_importer_quote_banner_bgimage_attachment',
                  'ts_demo_importer_quote_banner_bgimage_size',
                  'ts_demo_importer_quote_banner_sec_content_settings',
                  'ts_demo_importer_quote_banner_head',
                  'ts_demo_importer_quote_banner_text',
                  'ts_demo_importer_quote_banner_head2',
                  'ts_demo_importer_quote_banner_ct_pallete',
                  'ts_demo_importer_quote_banner_button_read_more',
                  'ts_demo_importer_quote_banner_button_read_more_url',
                  'ts_demo_importer_quote_banner_button_read_more_icon',
                  'ts_demo_importer_quote_banner_column_image',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_quote_banner_content_color_settings',
                  'ts_demo_importer_quote_banner_small_heading_ct_pallete',
                  'ts_demo_importer_quote_banner_small_heading_color',
                  'ts_demo_importer_quote_banner_small_heading_font_family',
                  'ts_demo_importer_quote_banner_small_heading_font_size',
                  'ts_demo_importer_quote_banner_small_heading_border_color1',
                  'ts_demo_importer_quote_banner_small_heading_border_color2',
                  'ts_demo_importer_quote_banner_main_heading_ct_pallete',
                  'ts_demo_importer_quote_banner_main_heading_color',
                  'ts_demo_importer_quote_banner_main_heading_font_family',
                  'ts_demo_importer_quote_banner_main_heading_font_size',
                  'ts_demo_importer_quote_banner_text_ct_pallete',
                  'ts_demo_importer_quote_banner_text_color',
                  'ts_demo_importer_quote_banner_text_font_family',
                  'ts_demo_importer_quote_banner_text_font_size',
                  'ts_demo_importer_quote_banner_button_ct_pallete',
                  'ts_demo_importer_quote_banner_button_color',
                  'ts_demo_importer_quote_banner_button_font_family',
                  'ts_demo_importer_quote_banner_button_font_size',
                  'ts_demo_importer_quote_banner_button_bgcolor',
                  'ts_demo_importer_quote_banner_button_hover_bgcolor',
                  'ts_demo_importer_quote_banner_button_text_color_hover',
                  'ts_demo_importer_quote_banner_section_bgcolor',
                  'ts_demo_importer_quote_banner_spacing_left_desktop',
                  'ts_demo_importer_quote_banner_spacing_top_desktop',
                  'ts_demo_importer_quote_banner_spacing_bottom_desktop',
                  'ts_demo_importer_quote_banner_spacing_right_desktop',
                  'ts_demo_importer_quote_banner_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_enable',
      array(
          'default' => 'Enable',
          'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_enable',
      array(
          'type' => 'radio',
          'label' => __('Do you want this section', 'ts-demo-importer'),
          'section' => 'ts_demo_importer_quote_banner_sec',
          'choices' => array(
          'Enable' => __('Enable', 'ts-demo-importer'),
          'Disable' => __('Disable', 'ts-demo-importer')
          ),
  ));

  $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_quote_banner_enable', array(
      'selector' => '#quote_banner .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_quote_banner_enable',
  ) );

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_sec_bg_settings',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_sec_bg_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_bgcolor', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_bgcolor', array(
        'label' => __('Background Color','ts-demo-importer'),
        'description' => __('Either add background color or background image, if you add both background color will be top most priority', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_quote_banner_sec',
        'settings' => 'ts_demo_importer_quote_banner_bgcolor',
    )));
    $wp_customize->add_setting('ts_demo_importer_quote_banner_bgimage',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_quote_banner_bgimage',
        array(
            'label' => __('Background Image','ts-demo-importer'),
            'description' => __('Dimension 1600px * 718px','ts-demo-importer'),
            'section' => 'ts_demo_importer_quote_banner_sec',
            'settings' => 'ts_demo_importer_quote_banner_bgimage'
    )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_bgimage_attachment', array(
    'default'         => '',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_bgimage_attachment', array(
    'type'      => 'radio',
    'label'     => __('Choose image option', 'ts-demo-importer'),
    'section'   => 'ts_demo_importer_quote_banner_sec',
    'choices'   => array(
      'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
      'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_bgimage_size', array(
      'default' => '',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_bgimage_size', array(
      'type' => 'radio',
      'label' => __('Background Image Size', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_quote_banner_sec',
      'choices' => array(
          'bg-auto' => __('Auto', 'ts-demo-importer'),
          'bg-cover' => __('Cover', 'ts-demo-importer'),
          'bg-contain' => __('Contain', 'ts-demo-importer'),
          'bg-xy' => __('100% 100%', 'ts-demo-importer'),
          'bg-x' => __('100%', 'ts-demo-importer'),
      )
  ));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_sec_content_settings',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_sec_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_head',array(
      'default'=> '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_head',array(
      'label' => __('Section Head 1','ts-demo-importer'),
      'section'=> 'ts_demo_importer_quote_banner_sec',
      'setting'=> 'ts_demo_importer_quote_banner_head',
      'type'=> 'text'
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_head2',array(
      'default'=> '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_head2',array(
      'label' => __('Section Head 2','ts-demo-importer'),
      'section'=> 'ts_demo_importer_quote_banner_sec',
      'setting'=> 'ts_demo_importer_quote_banner_head2',
      'type'=> 'text'
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_text', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize, 'ts_demo_importer_quote_banner_text', array(
    'label' => __('quote_Banner Text', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'setting' => 'ts_demo_importer_quote_banner_text',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_ct_pallete',
    array(
    'label' => __('Section Button Setting ','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_button_read_more', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_button_read_more', array(
      'label' => __('Section Button Text', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_quote_banner_sec',
      'setting' => 'ts_demo_importer_quote_banner_button_read_more',
      'type' => 'text'
  ));


    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
          TSDemoImporterAddon::loadbtn_url_banner_section5($wp_customize,$font_array);
        }else{
          $wp_customize->add_setting('ts_demo_importer_quote_banner_button_read_more32',array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
          ));
          $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_quote_banner_button_read_more32', array(
            'section' => 'ts_demo_importer_quote_banner_sec',
            'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
            'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
            'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
            '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
            '</a>'
          ),
        )));
      }




  $wp_customize->add_setting(
    'ts_demo_importer_quote_banner_button_read_more_icon',
    array(
      'default'     => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
    new ts_demo_importer_Fontawesome_Icon_Chooser(
      $wp_customize,
      'ts_demo_importer_quote_banner_button_read_more_icon',
      array(
        'settings'    => 'ts_demo_importer_quote_banner_button_read_more_icon',
        'section'   => 'ts_demo_importer_quote_banner_sec',
        'type'      => 'icon',
        'label'     => esc_html__( 'Choose Icon ', 'ts-demo-importer' ),
      )
    )
  );

  $wp_customize->add_setting('ts_demo_importer_quote_banner_column_image',array(
      'default'=> '',
      'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_quote_banner_column_image',
      array(
          'label' => __('Column Image','ts-demo-importer'),
          'description' => __('Dimension 1600px * 718px','ts-demo-importer'),
          'section' => 'ts_demo_importer_quote_banner_sec',
          'settings' => 'ts_demo_importer_quote_banner_column_image'
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_content_color_settings', array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control(new TS_Themes_Seperator_custom_Control($wp_customize, 'ts_demo_importer_quote_banner_content_color_settings', array(
      'label' => __('Section Color & Typography', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_small_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_small_heading_ct_pallete',
    array(
    'label' => __('Small Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_small_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_small_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_small_heading_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_quote_banner_small_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_quote_banner_small_heading_font_family', array(
    'section'  => 'ts_demo_importer_quote_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_small_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_small_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'setting' => 'ts_demo_importer_quote_banner_small_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_small_heading_border_color1', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_small_heading_border_color1', array(
    'label' => __('Heading Border Color 1', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_small_heading_border_color1',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_small_heading_border_color2', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_small_heading_border_color2', array(
    'label' => __('Heading Border Color 2', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_small_heading_border_color2',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_main_heading_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_main_heading_ct_pallete',
    array(
    'label' => __('Main Heading Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_main_heading_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_main_heading_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_main_heading_color',
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_main_heading_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_quote_banner_main_heading_font_family', array(
    'section'  => 'ts_demo_importer_quote_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_main_heading_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_main_heading_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'setting' => 'ts_demo_importer_quote_banner_main_heading_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_text_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_text_ct_pallete',
    array(
    'label' => __('Text Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_text_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_text_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_text_color',
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_text_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_quote_banner_text_font_family', array(
    'section'  => 'ts_demo_importer_quote_banner_sec',
    'label'    => __('Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_text_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_text_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'setting' => 'ts_demo_importer_quote_banner_text_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_button_ct_pallete',
    array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_quote_banner_button_ct_pallete',
    array(
    'label' => __('Button Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_button_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_button_color', array(
    'label' => __('Section Button Text Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_button_color',
  )));
  $wp_customize->add_setting('ts_demo_importer_quote_banner_button_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(
    'ts_demo_importer_quote_banner_button_font_family', array(
    'section'  => 'ts_demo_importer_quote_banner_sec',
    'label'    => __('Button Text Font Family','ts-demo-importer'),
    'type'     => 'select',
    'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_button_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_button_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Add font size in px','ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'setting' => 'ts_demo_importer_quote_banner_button_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_button_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_button_bgcolor', array(
    'label' => __(' Button Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_button_bgcolor',
  )));
  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_button_hover_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_button_hover_bgcolor', array(
    'label' => __('Section Button Hover Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_button_hover_bgcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_button_text_color_hover', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_button_text_color_hover', array(
    'label' => __('Button Hover Text Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_button_text_color_hover',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_quote_banner_section_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_quote_banner_section_bgcolor', array(
    'label' => __('Section Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_quote_banner_sec',
    'settings' => 'ts_demo_importer_quote_banner_section_bgcolor',
  )));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_spacing_left_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_spacing_top_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_spacing_bottom_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_setting('ts_demo_importer_quote_banner_spacing_right_desktop', array(
      'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
  ));

  $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_quote_banner_spacing', array(
      'section' => 'ts_demo_importer_quote_banner',
      'label' => esc_html__('Section Spacing(px)', 'total'),
      'settings' => array(
          'desktop_left' => 'ts_demo_importer_quote_banner_spacing_left_desktop',
          'desktop_top' => 'ts_demo_importer_quote_banner_spacing_top_desktop',
          'desktop_bottom' => 'ts_demo_importer_quote_banner_spacing_bottom_desktop',
          'desktop_right' => 'ts_demo_importer_quote_banner_spacing_right_desktop'
      ),
      'input_attrs' => array(
          'min' => 0,
          'max' => 100,
          'step' => 1,
      ),
      'responsive' => false
  )));
}

  // --------------- Consult Us  --------------

if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_consult_us',array(
    'title' => __('Consult Us','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $consult_no=get_theme_mod('ts_demo_importer_consult_us_number');


  $ts_demo_importer_consult_us_box_settings = array();
  $ts_demo_importer_consult_us_icon = array();
  $ts_demo_importer_consult_us_sub_title = array();
  $ts_demo_importer_consult_us_title = array();
  $ts_demo_importer_consult_us_url = array();
  $ts_demo_importer_consult_us_box_link = array();
  $ts_demo_importer_consult_us_box_link_icon = array();
  $ts_demo_importer_consult_us_box_url = array();

  for($i=1; $i<=$consult_no ;$i++){
    $ts_demo_importer_consult_us_box_settings[$i] = 'ts_demo_importer_consult_us_box_settings'.$i;
    $ts_demo_importer_consult_us_icon[$i] = 'ts_demo_importer_consult_us_icon'.$i;
    $ts_demo_importer_consult_us_sub_title[$i] = 'ts_demo_importer_consult_us_sub_title'.$i;
    $ts_demo_importer_consult_us_title[$i] = 'ts_demo_importer_consult_us_title'.$i;
    $ts_demo_importer_consult_us_url[$i] = 'ts_demo_importer_consult_us_url'.$i;
    $ts_demo_importer_consult_us_box_link[$i] = 'ts_demo_importer_consult_us_box_link'.$i;
    $ts_demo_importer_consult_us_box_link_icon[$i] = 'ts_demo_importer_consult_us_box_link_icon'.$i;
    $ts_demo_importer_consult_us_box_url[$i] = 'ts_demo_importer_consult_us_box_url'.$i;
  }

  $plan_arr = array(
                  'ts_demo_importer_consult_us_enable',
                  'ts_demo_importer_consult_us_settings',
                  'ts_demo_importer_consult_us_bgcolor',
                  'ts_demo_importer_consult_us_bgimage',
                  'ts_demo_importer_consult_us_bgimage_setting',
                  'ts_demo_importer_consult_us_bgimage_size',
                  'ts_demo_importer_consult_us_content_settings',
                  'ts_demo_importer_consult_us_small_heading',
                  'ts_demo_importer_consult_us_main_heading',
                  'ts_demo_importer_consult_us_number',
                  'ts_demo_importer_consult_us_box_settings',
                  'ts_demo_importer_consult_us_icon',
                  'ts_demo_importer_consult_us_sub_title',
                  'ts_demo_importer_consult_us_title',
                  'ts_demo_importer_consult_us_url',
                  'ts_demo_importer_consult_us_box_link',
                  'ts_demo_importer_consult_us_box_link_icon',
                  'ts_demo_importer_consult_us_box_url',


              );

  $plan_arr_final = array_merge($plan_arr, $ts_demo_importer_consult_us_box_settings, $ts_demo_importer_consult_us_icon, $ts_demo_importer_consult_us_sub_title, $ts_demo_importer_consult_us_title, $ts_demo_importer_consult_us_url,$ts_demo_importer_consult_us_box_link,$ts_demo_importer_consult_us_box_link_icon, $ts_demo_importer_consult_us_box_url);

$wp_customize->add_setting('ts_demo_importer_consult_us_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_consult_us_tab_settings', array(
      'section' => 'ts_demo_importer_consult_us',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $plan_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_consult_us_color_settings',
                  'ts_demo_importer_consult_us_small_heading_ct_pallete',
                  'ts_demo_importer_consult_us_small_heading_color',
                  'ts_demo_importer_consult_us_small_heading_font_family',
                  'ts_demo_importer_consult_us_small_heading_font_size',
                  'ts_demo_importer_consult_us_small_heading_border_color1',
                  'ts_demo_importer_consult_us_small_heading_border_color2',
                  'ts_demo_importer_consult_us_main_heading_ct_pallete',
                  'ts_demo_importer_consult_us_main_heading_color',
                  'ts_demo_importer_consult_us_main_heading_font_family',
                  'ts_demo_importer_consult_us_main_heading_font_size',
                  'ts_demo_importer_consult_us_box_icon_ct_pallete',
                  'ts_demo_importer_consult_us_box_icon_ct_pallete',
                  'ts_demo_importer_consult_us_box_icon_color',
                  'ts_demo_importer_consult_us_box_icon_bgcolor',
                  'ts_demo_importer_consult_us_box_title_ct_pallete',
                  'ts_demo_importer_consult_us_box_title_color',
                  'ts_demo_importer_consult_us_box_title_font_family',
                  'ts_demo_importer_consult_us_box_title_font_size',
                  'ts_demo_importer_consult_us_box_short_title_ct_pallete',
                  'ts_demo_importer_consult_us_box_short_title_color',
                  'ts_demo_importer_consult_us_box_short_title_font_family',
                  'ts_demo_importer_consult_us_box_short_title_font_size',
                  'ts_demo_importer_consult_us_box_text_ct_pallete',
                  'ts_demo_importer_consult_us_box_text_color',
                  'ts_demo_importer_consult_us_box_text_font_family',
                  'ts_demo_importer_consult_us_box_text_font_size',
                  'ts_demo_importer_consult_us_box_link_ct_pallete',
                  'ts_demo_importer_consult_us_box_link_color',
                  'ts_demo_importer_consult_us_box_link_font_family',
                  'ts_demo_importer_consult_us_box_link_font_size',
                  'ts_demo_importer_consult_us_box_bgcolor',
                  'ts_demo_importer_consult_us_box_hover_bgcolor',
                  'ts_demo_importer_consult_us_box_hover_textcolor',
                  'ts_demo_importer_consult_us_box_hover_icon_color',
                  'ts_demo_importer_consult_us_box_hover_icon_bgcolor',
                  'ts_demo_importer_consult_us_box_border_color',
                  'ts_demo_importer_consult_us_bg_wave_color',
                  'ts_demo_importer_consult_us_spacing_left_desktop',
                  'ts_demo_importer_consult_us_spacing_top_desktop',
                  'ts_demo_importer_consult_us_spacing_bottom_desktop',
                  'ts_demo_importer_consult_us_spacing_right_desktop',
                  'ts_demo_importer_consult_us_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_consult_us_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_consult_us_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_consult_us',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_consult_us_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_consult_us_enable322',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_consult_us_enable322', array(
         'section' => 'ts_demo_importer_consult_us',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }
}

  // --------------- Additional Services  --------------

if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_additional_services',array(
    'title' => __('Additional Services','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $ad_no=get_theme_mod('ts_demo_importer_additional_services_number');


  $ts_demo_importer_additional_services_box_settings = array();
  $ts_demo_importer_additional_services_image = array();
  $ts_demo_importer_additional_services_icon = array();
  $ts_demo_importer_additional_services_title = array();
  $ts_demo_importer_additional_services_url = array();
  $ts_demo_importer_additional_services_text = array();

  for($i=1; $i<=$ad_no ;$i++){
    $ts_demo_importer_additional_services_box_settings[$i] = 'ts_demo_importer_additional_services_box_settings'.$i;
    $ts_demo_importer_additional_services_image[$i] = 'ts_demo_importer_additional_services_image'.$i;
    $ts_demo_importer_additional_services_icon[$i] = 'ts_demo_importer_additional_services_icon'.$i;
    $ts_demo_importer_additional_services_title[$i] = 'ts_demo_importer_additional_services_title'.$i;
    $ts_demo_importer_additional_services_url[$i] = 'ts_demo_importer_additional_services_url'.$i;
    $ts_demo_importer_additional_services_text[$i] = 'ts_demo_importer_additional_services_text'.$i;
  }

  $ad_arr = array(
                  'ts_demo_importer_additional_services_enable',
                  'ts_demo_importer_additional_services_settings',
                  'ts_demo_importer_additional_services_bgcolor',
                  'ts_demo_importer_additional_services_bgimage',
                  'ts_demo_importer_additional_services_bgimage_setting',
                  'ts_demo_importer_additional_services_bgimage_size',
                  'ts_demo_importer_additional_services_content_settings',
                  'ts_demo_importer_additional_services_small_heading',
                  'ts_demo_importer_additional_services_main_heading',
                  'ts_demo_importer_additional_services_text',
                  'ts_demo_importer_additional_services_ct_pallete',
                  'ts_demo_importer_additional_services_button_read_more',
                  'ts_demo_importer_additional_services_button_read_more_url',
                  'ts_demo_importer_additional_services_button_read_more_icon',
                  'ts_demo_importer_additional_services_number',
                  'ts_demo_importer_additional_services_box_settings',
                  'ts_demo_importer_additional_services_image',
                  'ts_demo_importer_additional_services_icon',
                  'ts_demo_importer_additional_services_title',
                  'ts_demo_importer_additional_services_url',

              );

  $ad_arr_final = array_merge($ad_arr, $ts_demo_importer_additional_services_box_settings, $ts_demo_importer_additional_services_image, $ts_demo_importer_additional_services_icon, $ts_demo_importer_additional_services_title, $ts_demo_importer_additional_services_url,$ts_demo_importer_additional_services_text);

  $wp_customize->add_setting('ts_demo_importer_additional_services_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_additional_services_tab_settings', array(
      'section' => 'ts_demo_importer_additional_services',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $ad_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_additional_services_color_settings',
                  'ts_demo_importer_additional_services_small_heading_ct_pallete',
                  'ts_demo_importer_additional_services_small_heading_color',
                  'ts_demo_importer_additional_services_small_heading_font_family',
                  'ts_demo_importer_additional_services_small_heading_font_size',
                  'ts_demo_importer_additional_services_small_heading_border_color1',
                  'ts_demo_importer_additional_services_small_heading_border_color2',
                  'ts_demo_importer_additional_services_main_heading_ct_pallete',
                  'ts_demo_importer_additional_services_main_heading_color',
                  'ts_demo_importer_additional_services_main_heading_font_family',
                  'ts_demo_importer_additional_services_main_heading_font_size',
                  'ts_demo_importer_additional_services_text_ct_pallete',
                  'ts_demo_importer_additional_services_text_color',
                  'ts_demo_importer_additional_services_text_font_family',
                  'ts_demo_importer_additional_services_text_font_size',
                  'ts_demo_importer_additional_services_button_ct_pallete',
                  'ts_demo_importer_additional_services_button_color',
                  'ts_demo_importer_additional_services_button_font_family',
                  'ts_demo_importer_additional_services_button_font_size',
                  'ts_demo_importer_additional_services_button_bgcolor',
                  'ts_demo_importer_additional_services_button_hover_bgcolor',
                  'ts_demo_importer_additional_services_button_text_color_hover',
                  'ts_demo_importer_additional_services_box_icon_ct_pallete',
                  'ts_demo_importer_additional_services_box_icon_color',
                  'ts_demo_importer_additional_services_box_icon_font_size',
                  'ts_demo_importer_additional_services_box_title_ct_pallete',
                  'ts_demo_importer_additional_services_box_title_color',
                  'ts_demo_importer_additional_services_box_title_font_family',
                  'ts_demo_importer_additional_services_box_title_font_size',
                  'ts_demo_importer_additional_services_box_text_ct_pallete',
                  'ts_demo_importer_additional_services_box_text_color',
                  'ts_demo_importer_additional_services_box_text_font_family',
                  'ts_demo_importer_additional_services_box_text_font_size',
                  'ts_demo_importer_additional_services_box_hover_bgcolor',
                  'ts_demo_importer_additional_services_bg_shape_color',
                  'ts_demo_importer_additional_services_border_bottom_color',
                  'ts_demo_importer_additional_services_spacing_left_desktop',
                  'ts_demo_importer_additional_services_spacing_top_desktop',
                  'ts_demo_importer_additional_services_spacing_bottom_desktop',
                  'ts_demo_importer_additional_services_spacing_right_desktop',
                  'ts_demo_importer_additional_services_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_additional_services_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_additional_services_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_additional_services',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_additional_services_section($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_additional_services_enable45',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_additional_services_enable45', array(
      'section' => 'ts_demo_importer_additional_services',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
// if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
//         TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
// }
}

  // -------------- Testimonials --------------
if( $template == 'multi-advance' ){
  $wp_customize->add_section('ts_demo_importer_testimonials',array(
    'title' => __('Testimonials','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $ad_arr = array(
                  'ts_demo_importer_testimonials_enable',
                  'ts_demo_importer_testimonials_settings',
                  'ts_demo_importer_testimonials_bgcolor',
                  'ts_demo_importer_testimonials_bgimage',
                  'ts_demo_importer_testimonials_bgimage_setting',
                  'ts_demo_importer_testimonials_bgimage_size',
                  'ts_demo_importer_testimonials_content_settings',
                  'ts_demo_importer_testimonials_small_heading',
                  'ts_demo_importer_testimonials_main_heading',
                  'ts_demo_importer_testimonials_carousel_loop',
                  'ts_demo_importer_testimonials_carousel_speed',
                  'ts_demo_importer_testimonials_carousel_dots',
                  'ts_demo_importer_testimonials_carousel_nav',
                  'ts_demo_importer_testimonial_content_settings',
                  'ts_demo_importer_testimonial_number',
                  'ts_demo_importer_testimonial_excerpt_no',

              );

  $wp_customize->add_setting('ts_demo_importer_testimonials_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_testimonials_tab_settings', array(
      'section' => 'ts_demo_importer_testimonials',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $ad_arr
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_testimonials_color_settings',
                  'ts_demo_importer_testimonials_small_heading_ct_pallete',
                  'ts_demo_importer_testimonials_small_heading_color',
                  'ts_demo_importer_testimonials_small_heading_font_family',
                  'ts_demo_importer_testimonials_small_heading_font_size',
                  'ts_demo_importer_testimonials_small_heading_border_color1',
                  'ts_demo_importer_testimonials_small_heading_border_color2',
                  'ts_demo_importer_testimonials_main_heading_ct_pallete',
                  'ts_demo_importer_testimonials_main_heading_color',
                  'ts_demo_importer_testimonials_main_heading_font_family',
                  'ts_demo_importer_testimonials_main_heading_font_size',
                  'ts_demo_importer_testimonials_text_ct_pallete',
                  'ts_demo_importer_testimonial_text_color',
                  'ts_demo_importer_testimonial_text_font_family',
                  'ts_demo_importer_testimonial_text_font_size',
                  'ts_demo_importer_testimonials_title_ct_pallete',
                  'ts_demo_importer_testimonial_title_color',
                  'ts_demo_importer_testimonial_title_font_family',
                  'ts_demo_importer_testimonial_title_font_size',
                  'ts_demo_importer_testimonials_desig_ct_pallete',
                  'ts_demo_importer_testimonial_desig_color',
                  'ts_demo_importer_testimonial_desig_font_family',
                  'ts_demo_importer_testimonial_desig_font_size',
                  'ts_demo_importer_testimonial_quote_color',
                  'ts_demo_importer_testimonial_spacing_left_desktop',
                  'ts_demo_importer_testimonial_spacing_top_desktop',
                  'ts_demo_importer_testimonial_spacing_bottom_desktop',
                  'ts_demo_importer_testimonial_spacing_right_desktop',
                  'ts_demo_importer_testimonial_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_testimonials_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_testimonials_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_testimonials',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_testimonial_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_testimonials_enable2',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_testimonials_enable2', array(
         'section' => 'ts_demo_importer_testimonials',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }
} elseif ( $template == 'advance-consultancy' ) {
  $wp_customize->add_section('ts_demo_importer_testimonials',array(
    'title' => __('Testimonials','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $ad_arr = array(
                  'ts_demo_importer_testimonials_enable',
                  'ts_demo_importer_testimonials_settings',
                  'ts_demo_importer_testimonials_bgcolor',
                  'ts_demo_importer_testimonials_bgimage',
                  'ts_demo_importer_testimonials_bgimage_setting',
                  'ts_demo_importer_testimonials_bgimage_size',
                  'ts_demo_importer_testimonials_content_settings',
                  'ts_demo_importer_testimonials_small_heading',
                  'ts_demo_importer_testimonials_main_heading',
                  'ts_demo_importer_testimonials_carousel_loop',
                  'ts_demo_importer_testimonials_carousel_speed',
                  'ts_demo_importer_testimonials_carousel_dots',
                  'ts_demo_importer_testimonials_carousel_nav',
                  'ts_demo_importer_testimonial_content_settings',
                  'ts_demo_importer_testimonial_number',
                  'ts_demo_importer_testimonial_excerpt_no',

              );

  $wp_customize->add_setting('ts_demo_importer_testimonials_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_testimonials_tab_settings', array(
      'section' => 'ts_demo_importer_testimonials',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $ad_arr
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_testimonials_color_settings',
                  'ts_demo_importer_testimonials_small_heading_ct_pallete',
                  'ts_demo_importer_testimonials_small_heading_color',
                  'ts_demo_importer_testimonials_small_heading_font_family',
                  'ts_demo_importer_testimonials_small_heading_font_size',
                  'ts_demo_importer_testimonials_small_heading_border_color1',
                  'ts_demo_importer_testimonials_small_heading_border_color2',
                  'ts_demo_importer_testimonials_main_heading_ct_pallete',
                  'ts_demo_importer_testimonials_main_heading_color',
                  'ts_demo_importer_testimonials_main_heading_font_family',
                  'ts_demo_importer_testimonials_main_heading_font_size',
                  'ts_demo_importer_testimonials_text_ct_pallete',
                  'ts_demo_importer_testimonial_text_color',
                  'ts_demo_importer_testimonial_text_font_family',
                  'ts_demo_importer_testimonial_text_font_size',
                  'ts_demo_importer_testimonials_nav_setting_ct_pallete',
                  'ts_demo_importer_testimonial_navigation_color',
                  'ts_demo_importer_testimonial_navigation_bgcolor',
                  'ts_demo_importer_testimonial_navigation_hover_color',
                  'ts_demo_importer_testimonial_navigation_hover_bgcolor',
                  'ts_demo_importer_testimonial_spacing_left_desktop',
                  'ts_demo_importer_testimonial_spacing_top_desktop',
                  'ts_demo_importer_testimonial_spacing_bottom_desktop',
                  'ts_demo_importer_testimonial_spacing_right_desktop',
                  'ts_demo_importer_testimonial_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_testimonials_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_testimonials_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_testimonials',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_testimonial_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_testimonials_enable2',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_testimonials_enable2', array(
         'section' => 'ts_demo_importer_testimonials',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }
}

  // ----------- Our Brand --------------
  if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' || $template == 'ts-conference' ){
    $wp_customize->add_section('ts_demo_importer_our_brand',array(
      'title' => __('Our Brand','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));


    $brands_content_array =   array(
          'name' => esc_html__('Content', 'ts-demo-importer'),
          'icon' => 'dashicons dashicons-welcome-write-blog',
          'fields' => array(
              'ts_demo_importer_our_brand_enable',
              'ts_demo_importer_our_brand_settings',
              'ts_demo_importer_our_brand_bgcolor',
              'ts_demo_importer_our_brand_bgimage',
              'ts_demo_importer_our_brand_bgimage_setting',
              'ts_demo_importer_our_brand_bgimage_size',
              'ts_demo_importer_our_brand_carousel_loop',
              'ts_demo_importer_our_brand_carousel_speed',
              'ts_demo_importer_our_brand_carousel_dots',
              'ts_demo_importer_our_brand_carousel_nav',
              'ts_demo_importer_our_brand_content_settings',
              'ts_demo_importer_our_brand_number'
          ),
      );

      if ( $template == 'ts-conference' ) {
        $brand_headings = array(
          'ts_demo_importer_our_brand_small_heading',
          'ts_demo_importer_our_brand_main_heading'
        );
      }else {
        $brand_headings = array(
          'ts_demo_importer_our_brand_main_heading'
        );
      }
      $brands_content_array_final = array_push($brand_headings);

      $brands_no=get_theme_mod('ts_demo_importer_our_brand_number');
      for ($i=1; $i <=$brands_no ; $i++) {
        $ts_demo_importer_our_brand_url = 'ts_demo_importer_our_brand_url'.$i;
        $ts_demo_importer_our_brand_image = 'ts_demo_importer_our_brand_image'.$i;
        $brands_content_array_final = array_push($brands_content_array, $ts_demo_importer_our_brand_url, $ts_demo_importer_our_brand_image );
      }

      // $wp_customize->add_setting('ts_demo_importer_latest_news_tab_settings', array(
      //   'sanitize_callback' => 'wp_kses_post',
      // ));
      //
    // $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_latest_news_tab_settings', array(
    //   'section' => 'ts_demo_importer_our_brand',
    //   'buttons' => array(
    //     array(
    //       $brands_content_array_final,
    //     ),
    //
    //       array(
    //           'name' => esc_html__('Style', 'ts-demo-importer'),
    //           'icon' => 'dashicons dashicons-art',
    //           'fields' => array(
    //               'ts_demo_importer_latest_news_color_settings',
    //               'ts_demo_importer_latest_news_small_heading_ct_pallete',
    //               'ts_demo_importer_latest_news_small_heading_color',
    //               'ts_demo_importer_latest_news_small_heading_font_family',
    //               'ts_demo_importer_latest_news_small_heading_font_size',
    //               'ts_demo_importer_latest_news_small_heading_border_color1',
    //               'ts_demo_importer_latest_news_small_heading_border_color2',
    //               'ts_demo_importer_latest_news_main_heading_ct_pallete',
    //               'ts_demo_importer_latest_news_main_heading_color',
    //               'ts_demo_importer_latest_news_main_heading_font_family',
    //               'ts_demo_importer_latest_news_main_heading_font_size',
    //
    //               'ts_demo_importer_latest_news_blog_like_button_ct_pallete',
    //               'ts_demo_importer_latest_news_blog_like_button_icon_color',
    //               'ts_demo_importer_latest_news_blog_like_button_icon_size',
    //               'ts_demo_importer_latest_news_blog_like_button_color',
    //               'ts_demo_importer_latest_news_blog_like_button_font_family',
    //               'ts_demo_importer_latest_news_blog_like_button_font_size',
    //
    //               'ts_demo_importer_latest_news_title_ct_pallete',
    //               'ts_demo_importer_latest_news_title_color',
    //               'ts_demo_importer_latest_news_title_font_family',
    //               'ts_demo_importer_latest_news_title_font_size',
    //               'ts_demo_importer_latest_news_text_ct_pallete',
    //               'ts_demo_importer_latest_news_text_color',
    //               'ts_demo_importer_latest_news_text_font_family',
    //               'ts_demo_importer_latest_news_text_font_size',
    //               'ts_demo_importer_latest_news_meta_ct_pallete',
    //               'ts_demo_importer_latest_news_meta_color',
    //               'ts_demo_importer_latest_news_meta_font_family',
    //               'ts_demo_importer_latest_news_meta_font_size',
    //               'ts_demo_importer_latest_news_auther_ct_pallete',
    //               'ts_demo_importer_latest_news_auther_color',
    //               'ts_demo_importer_latest_news_auther_font_family',
    //               'ts_demo_importer_latest_news_auther_font_size',
    //               'ts_demo_importer_latest_news_meta_icon_color',
    //               'ts_demo_importer_latest_news_meta_icon_font_size',
    //               'ts_demo_importer_latest_news_meta_border_bottom_color',
    //               'ts_demo_importer_latest_news_read_more_ct_pallete',
    //               'ts_demo_importer_latest_news_read_more_color',
    //               'ts_demo_importer_latest_news_read_more_font_family',
    //               'ts_demo_importer_latest_news_read_more_font_size',
    //               'ts_demo_importer_latest_news_read_more_overlay_color',
    //               'ts_demo_importer_latest_news_box_bgcolor',
    //               'ts_demo_importer_latest_news_box_bgcolor_hover',
    //               'ts_demo_importer_latest_news_box_text_color_hover',
    //               'ts_demo_importer_latest_news_spacing_left_desktop',
    //               'ts_demo_importer_latest_news_spacing_top_desktop',
    //               'ts_demo_importer_latest_news_spacing_bottom_desktop',
    //               'ts_demo_importer_latest_news_spacing_right_desktop',
    //               'ts_demo_importer_latest_news_spacing',
    //           ),
    //       )
    //   ),
    // )));

    $wp_customize->add_setting('ts_demo_importer_our_brand_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_brand_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_brand',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_our_brand_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_our_brand_enable12',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_brand_enable12', array(
        'section' => 'ts_demo_importer_our_brand',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
  }



// if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy'){
//   $wp_customize->add_section('ts_demo_importer_our_brand',array(
//     'title' => __('Our Brand','ts-demo-importer'),
//     'panel' => 'ts_demo_importer_panel_id',
//   ));
//
//   $wp_customize->add_setting('ts_demo_importer_our_brand_enable',
//       array(
//     'default' => 'Enable',
//     'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
//   ));
//   $wp_customize->add_control('ts_demo_importer_our_brand_enable',
//     array(
//     'type' => 'radio',
//     'label' => __('Do you want this section', 'ts-demo-importer'),
//     'section' => 'ts_demo_importer_our_brand',
//     'choices' => array(
//     'Enable' => __('Enable', 'ts-demo-importer'),
//     'Disable' => __('Disable', 'ts-demo-importer')
//   )));
//
//   if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
//     TSDemoImporterAddon::load_our_brand_section($wp_customize,$font_array);
//     }else{
//       $wp_customize->add_setting('ts_demo_importer_our_brand_enable12',array(
//         'default' => '',
//         'sanitize_callback' => 'sanitize_text_field'
//       ));
//       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_brand_enable12', array(
//         'section' => 'ts_demo_importer_our_brand',
//         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
//         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
//         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
//         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
//         '</a>'
//       ),
//     )));
//     }
// }
  // --------------- Skills Showcase  --------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_skills_showcase',array(
    'title' => __('Skills Showcase','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $skillsshow_no=get_theme_mod('ts_demo_importer_skills_showcase_number');


  $ts_demo_importer_skills_showcase_box_settings = array();
  $ts_demo_importer_skills_showcase_title = array();
  $ts_demo_importer_skills_showcase_percentage = array();

  for($i=1; $i<=$skillsshow_no ;$i++){
    $ts_demo_importer_skills_showcase_box_settings[$i] = 'ts_demo_importer_skills_showcase_box_settings'.$i;
    $ts_demo_importer_skills_showcase_title[$i] = 'ts_demo_importer_skills_showcase_title'.$i;
    $ts_demo_importer_skills_showcase_percentage[$i] = 'ts_demo_importer_skills_showcase_percentage'.$i;
  }

  $skills_showcase_arr = array(
                  'ts_demo_importer_skills_showcase_enable',
                  'ts_demo_importer_skills_showcase_settings',
                  'ts_demo_importer_skills_showcase_bgcolor',
                  'ts_demo_importer_skills_showcase_bgimage',
                  'ts_demo_importer_skills_showcase_bgimage_setting',
                  'ts_demo_importer_skills_showcase_bgimage_attachment',
                  'ts_demo_importer_skills_showcase_bgimage_size',
                  'ts_demo_importer_skills_showcase_content_settings',
                  'ts_demo_importer_skills_showcase_small_heading',
                  'ts_demo_importer_skills_showcase_main_heading',
                  'ts_demo_importer_skills_showcase_section_text',
                  'ts_demo_importer_skills_showcase_number',
                  'ts_demo_importer_skills_showcase_box_settings',
                  'ts_demo_importer_skills_showcase_title',
                  'ts_demo_importer_skills_showcase_percentage',

              );

  $askills_showcase_arr_final = array_merge($skills_showcase_arr, $ts_demo_importer_skills_showcase_box_settings, $ts_demo_importer_skills_showcase_title, $ts_demo_importer_skills_showcase_percentage);

  $wp_customize->add_setting('ts_demo_importer_skills_showcase_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_skills_showcase_tab_settings', array(
        'section' => 'ts_demo_importer_skills_showcase',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => $askills_showcase_arr_final
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_skills_showcase_color_settings',
                    'ts_demo_importer_skills_showcase_small_heading_ct_pallete',
                    'ts_demo_importer_skills_showcase_small_heading_color',
                    'ts_demo_importer_skills_showcase_small_heading_font_family',
                    'ts_demo_importer_skills_showcase_small_heading_font_size',
                    'ts_demo_importer_skills_showcase_small_heading_border_color1',
                    'ts_demo_importer_skills_showcase_small_heading_border_color2',
                    'ts_demo_importer_skills_showcase_main_heading_ct_pallete',
                    'ts_demo_importer_skills_showcase_main_heading_color',
                    'ts_demo_importer_skills_showcase_main_heading_font_family',
                    'ts_demo_importer_skills_showcase_main_heading_font_size',
                    'ts_demo_importer_skills_showcase_text_ct_pallete',
                    'ts_demo_importer_skills_showcase_text_color',
                    'ts_demo_importer_skills_showcase_text_font_family',
                    'ts_demo_importer_skills_showcase_text_font_size',
                    'ts_demo_importer_skills_showcase_box_title_ct_pallete',
                    'ts_demo_importer_skills_showcase_box_title_color',
                    'ts_demo_importer_skills_showcase_box_title_font_family',
                    'ts_demo_importer_skills_showcase_box_title_font_size',
                    'ts_demo_importer_skills_showcase_box_percentage_ct_pallete',
                    'ts_demo_importer_skills_showcase_box_percentage_color',
                    'ts_demo_importer_skills_showcase_box_percentage_font_family',
                    'ts_demo_importer_skills_showcase_box_percentage_font_size',
                    'ts_demo_importer_skills_showcase_box_percentage_bar_color1',
                    'ts_demo_importer_skills_showcase_box_percentage_bar_color2',
                    'ts_demo_importer_skills_showcase_box_bgcolor',
                    'ts_demo_importer_skills_showcase_box_back_overlay_color',
                    'ts_demo_importer_skills_showcase_spacing_left_desktop',
                    'ts_demo_importer_skills_showcase_spacing_top_desktop',
                    'ts_demo_importer_skills_showcase_spacing_bottom_desktop',
                    'ts_demo_importer_skills_showcase_spacing_right_desktop',
                    'ts_demo_importer_skills_showcase_spacing',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_skills_showcase_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_skills_showcase_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_skills_showcase',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
                TSDemoImporterAddon::load_skill_showcase_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_skills_showcase_enable23',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_skills_showcase_enable23', array(
        'section' => 'ts_demo_importer_skills_showcase',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }

}


// --------------------- Upcoming Events START----------------------------
if( $template == 'advance-marketing-agency' || $template == 'ts-conference' ){
  $wp_customize->add_section('ts_demo_importer_upcoming_events_sec',array(
  'title' => __('Upcoming Events ','ts-demo-importer'),
  'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_upcoming_events_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  if ( $template == 'advance-marketing-agency') {
    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_upcoming_events_tab_settings', array(
      'section' => 'ts_demo_importer_upcoming_events_sec',
      'buttons' => array(
        array(
          'name' => esc_html__('Content', 'ts-demo-importer'),
          'icon' => 'dashicons dashicons-welcome-write-blog',
          'fields' => array(
            'ts_demo_importer_upcoming_events_enabledisable',
            'ts_demo_importer_upcoming_events_bgimage_settings',
            'ts_demo_importer_upcoming_events_background_color',
            'ts_demo_importer_upcoming_events_bgimage',
            'ts_demo_importer_upcoming_events_bgimage_setting',
            'ts_demo_importer_upcoming_events_bgimage_size',
            'ts_demo_importer_upcoming_events_content_settings',
            'ts_demo_importer_upcoming_events_small_heading',
            'ts_demo_importer_upcoming_events_main_heading',
            'ts_demo_importer_upcoming_events_tab_time_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_time_icon',
            'ts_demo_importer_upcoming_events_tab_location_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_location_icon',
          ),
        ),
        array(
          'name' => esc_html__('Style', 'ts-demo-importer'),
          'icon' => 'dashicons dashicons-art',
          'fields' => array(
            'ts_demo_importer_upcoming_events_content_color_settings',
            'ts_demo_importer_upcoming_events_small_heading_ct_pallete',
            'ts_demo_importer_upcoming_events_small_heading_color',
            'ts_demo_importer_upcoming_events_small_heading_font_family',
            'ts_demo_importer_upcoming_events_small_heading_font_size',
            'ts_demo_importer_upcoming_events_small_heading_border_color1',
            'ts_demo_importer_upcoming_events_small_heading_border_color2',
            'ts_demo_importer_upcoming_events_main_heading_ct_pallete',
            'ts_demo_importer_upcoming_events_main_heading_color',
            'ts_demo_importer_upcoming_events_main_heading_font_family',
            'ts_demo_importer_upcoming_events_main_heading_font_size',
            'ts_demo_importer_upcoming_events_tab_menu_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_text_color',
            'ts_demo_importer_upcoming_events_tab_bgcolor',
            'ts_demo_importer_upcoming_events_tab_border_color',
            'ts_demo_importer_upcoming_events_tab_hover_text_color',
            'ts_demo_importer_upcoming_events_tab_hover_bgcolor',
            'ts_demo_importer_upcoming_events_tab_content_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_content_bgcolor',
            'ts_demo_importer_upcoming_events_tab_title_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_title_color',
            'ts_demo_importer_upcoming_events_tab_title_font_family',
            'ts_demo_importer_upcoming_events_tab_title_font_size',
            'ts_demo_importer_upcoming_events_tab_description_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_description_color',
            'ts_demo_importer_upcoming_events_tab_description_font_family',
            'ts_demo_importer_upcoming_events_tab_description_font_size',
            'ts_demo_importer_upcoming_events_tab_sub_title_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_sub_title_color',
            'ts_demo_importer_upcoming_events_tab_sub_title_font_family',
            'ts_demo_importer_upcoming_events_tab_sub_title_font_size',
            'ts_demo_importer_upcoming_events_tab_time_typography_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_time_icon_color',
            'ts_demo_importer_upcoming_events_tab_time_color',
            'ts_demo_importer_upcoming_events_tab_time_font_family',
            'ts_demo_importer_upcoming_events_tab_time_font_size',
            'ts_demo_importer_upcoming_events_tab_location_typography_ct_pallete',
            'ts_demo_importer_upcoming_events_tab_location_icon_color',
            'ts_demo_importer_upcoming_events_tab_location_color',
            'ts_demo_importer_upcoming_events_tab_location_font_family',
            'ts_demo_importer_upcoming_events_tab_location_font_size',
           ),
          )
        ),
      )));
    }elseif ( $template == 'ts-conference') {
      $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_upcoming_events_tab_settings', array(
        'section' => 'ts_demo_importer_upcoming_events_sec',
        'buttons' => array(
          array(
            'name' => esc_html__('Content', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
              'ts_demo_importer_upcoming_events_enabledisable',
              'ts_demo_importer_upcoming_events_bgimage_settings',
              'ts_demo_importer_upcoming_events_background_color',
              'ts_demo_importer_upcoming_events_bgimage',
              'ts_demo_importer_upcoming_events_bgimage_setting',
              'ts_demo_importer_upcoming_events_bgimage_size',
              'ts_demo_importer_upcoming_events_content_settings',
              'ts_demo_importer_upcoming_events_small_heading',
              'ts_demo_importer_upcoming_events_main_heading',
              'ts_demo_importer_upcoming_events_number',
              'ts_demo_importer_upcoming_events_date_icon',
              'ts_demo_importer_upcoming_events_location_icon',
              'ts_demo_importer_upcoming_events_read_more_btn',
              'ts_demo_importer_upcoming_events_register_space_background_settings',
              'ts_demo_importer_upcoming_events_register_space_background_color',
              'ts_demo_importer_upcoming_events_register_space_bgimage',
              'ts_demo_importer_upcoming_events_register_space_heading',
              'ts_demo_importer_upcoming_events_register_space_para',
              'ts_demo_importer_upcoming_events_book_now_btn',
              'ts_demo_importer_upcoming_events_book_now_btn_url',
            ),
          ),
          array(
            'name' => esc_html__('Style', 'ts-demo-importer'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
              'ts_demo_importer_upcoming_events_small_heading_ct_pallete',
              'ts_demo_importer_upcoming_events_small_heading_color',
              'ts_demo_importer_upcoming_events_small_heading_font_family',
              'ts_demo_importer_upcoming_events_small_heading_font_size',
              'ts_demo_importer_upcoming_events_main_heading_ct_pallete',
              'ts_demo_importer_upcoming_events_main_heading_color',
              'ts_demo_importer_upcoming_events_main_heading_font_family',
              'ts_demo_importer_upcoming_events_main_heading_font_size',
              'ts_demo_importer_upcoming_events_post_title_ct_pallete',
              'ts_demo_importer_upcoming_events_post_title_color',
              'ts_demo_importer_upcoming_events_post_title_font_family',
              'ts_demo_importer_upcoming_events_post_title_font_size',
              'ts_demo_importer_upcoming_events_post_content_ct_pallete',
              'ts_demo_importer_upcoming_events_post_content_color',
              'ts_demo_importer_upcoming_events_post_content_font_family',
              'ts_demo_importer_upcoming_events_post_content_font_size',
              'ts_demo_importer_upcoming_events_post_meta_ct_pallete',
              'ts_demo_importer_upcoming_events_post_meta_color',
              'ts_demo_importer_upcoming_events_post_meta_font_family',
              'ts_demo_importer_upcoming_events_post_meta_font_size',
              'ts_demo_importer_upcoming_events_post_read_more_btn_ct_pallete',
              'ts_demo_importer_upcoming_events_post_read_more_btn_color',
              'ts_demo_importer_upcoming_events_post_read_more_btn_font_family',
              'ts_demo_importer_upcoming_events_post_read_more_btn_font_size',
              'ts_demo_importer_upcoming_events_post_read_more_content_bg_ct_pallete',
              'ts_demo_importer_upcoming_events_post_read_more_content_bgcolor',
              'ts_demo_importer_upcoming_events_register_space_heading_ct_pallete',
              'ts_demo_importer_upcoming_events_register_space_heading_color',
              'ts_demo_importer_upcoming_events_register_space_heading_font_family',
              'ts_demo_importer_upcoming_events_register_space_heading_font_size',
              'ts_demo_importer_upcoming_events_register_space_para_ct_pallete',
              'ts_demo_importer_upcoming_events_register_space_para_color',
              'ts_demo_importer_upcoming_events_register_space_para_font_family',
              'ts_demo_importer_upcoming_events_register_space_para_font_size',
              'ts_demo_importer_upcoming_events_book_now_btn_ct_pallete',
              'ts_demo_importer_upcoming_events_book_now_btn_color',
              'ts_demo_importer_upcoming_events_book_now_btn_font_family',
              'ts_demo_importer_upcoming_events_book_now_btn_font_size',
              'ts_demo_importer_upcoming_events_book_now_btn_bgcolor',
             ),
            )
          ),
        )));
    }

  $wp_customize->add_setting('ts_demo_importer_upcoming_events_enabledisable',
    array(
        'default' => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_upcoming_events_enabledisable',
    array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_upcoming_events_sec',
        'choices' => array(
        'Enable' => __('Enable', 'ts-demo-importer'),
        'Disable' => __('Disable', 'ts-demo-importer')
        ),
  ));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
         TSDemoImporterAddon::load_upcoming_events_section($wp_customize,$font_array);
       }else{
         $wp_customize->add_setting('ts_demo_importer_upcoming_events_enable_addon',array(
           'default' => '',
           'sanitize_callback' => 'sanitize_text_field'
         ));
         $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_upcoming_events_enable_addon', array(
           'section' => 'ts_demo_importer_upcoming_events_sec',
           'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
           'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
           'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
           '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
           '</a>'
         ),
       )));
     }
}

  // -------------- Latest News --------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_latest_news',array(
  'title' => __('Latest News','ts-demo-importer'),
  'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_latest_news_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  if ($template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy') {

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_latest_news_tab_settings', array(
      'section' => 'ts_demo_importer_latest_news',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_latest_news_enable',
                  'ts_demo_importer_latest_news_settings',
                  'ts_demo_importer_latest_news_bgcolor',
                  'ts_demo_importer_latest_news_bgimage',
                  'ts_demo_importer_latest_news_bgimage_setting',
                  'ts_demo_importer_latest_news_bgimage_size',
                  'ts_demo_importer_latest_news_carousel_loop',
                  'ts_demo_importer_latest_news_carousel_speed',
                  'ts_demo_importer_latest_news_carousel_dots',
                  'ts_demo_importer_latest_news_carousel_nav',
                  'ts_demo_importer_latest_news_content_settings',
                  'ts_demo_importer_latest_news_small_heading',
                  'ts_demo_importer_latest_news_main_heading',
                  'ts_demo_importer_latest_news_number',
                  'ts_demo_importer_latest_blog_like_button',
                  'ts_demo_importer_latest_news_button_content_settings',
                  'ts_demo_importer_latest_news_box_link_text',
                  'ts_demo_importer_latest_news_box_link_icon',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_latest_news_color_settings',
                  'ts_demo_importer_latest_news_small_heading_ct_pallete',
                  'ts_demo_importer_latest_news_small_heading_color',
                  'ts_demo_importer_latest_news_small_heading_font_family',
                  'ts_demo_importer_latest_news_small_heading_font_size',
                  'ts_demo_importer_latest_news_small_heading_border_color1',
                  'ts_demo_importer_latest_news_small_heading_border_color2',
                  'ts_demo_importer_latest_news_main_heading_ct_pallete',
                  'ts_demo_importer_latest_news_main_heading_color',
                  'ts_demo_importer_latest_news_main_heading_font_family',
                  'ts_demo_importer_latest_news_main_heading_font_size',

                  'ts_demo_importer_latest_news_blog_like_button_ct_pallete',
                  'ts_demo_importer_latest_news_blog_like_button_icon_color',
                  'ts_demo_importer_latest_news_blog_like_button_icon_size',
                  'ts_demo_importer_latest_news_blog_like_button_color',
                  'ts_demo_importer_latest_news_blog_like_button_font_family',
                  'ts_demo_importer_latest_news_blog_like_button_font_size',

                  'ts_demo_importer_latest_news_title_ct_pallete',
                  'ts_demo_importer_latest_news_title_color',
                  'ts_demo_importer_latest_news_title_font_family',
                  'ts_demo_importer_latest_news_title_font_size',
                  'ts_demo_importer_latest_news_text_ct_pallete',
                  'ts_demo_importer_latest_news_text_color',
                  'ts_demo_importer_latest_news_text_font_family',
                  'ts_demo_importer_latest_news_text_font_size',
                  'ts_demo_importer_latest_news_meta_ct_pallete',
                  'ts_demo_importer_latest_news_meta_color',
                  'ts_demo_importer_latest_news_meta_font_family',
                  'ts_demo_importer_latest_news_meta_font_size',
                  'ts_demo_importer_latest_news_auther_ct_pallete',
                  'ts_demo_importer_latest_news_auther_color',
                  'ts_demo_importer_latest_news_auther_font_family',
                  'ts_demo_importer_latest_news_auther_font_size',
                  'ts_demo_importer_latest_news_meta_icon_color',
                  'ts_demo_importer_latest_news_meta_icon_font_size',
                  'ts_demo_importer_latest_news_meta_border_bottom_color',
                  'ts_demo_importer_latest_news_read_more_ct_pallete',
                  'ts_demo_importer_latest_news_read_more_color',
                  'ts_demo_importer_latest_news_read_more_font_family',
                  'ts_demo_importer_latest_news_read_more_font_size',
                  'ts_demo_importer_latest_news_read_more_overlay_color',
                  'ts_demo_importer_latest_news_box_bgcolor',
                  'ts_demo_importer_latest_news_box_bgcolor_hover',
                  'ts_demo_importer_latest_news_box_text_color_hover',
                  'ts_demo_importer_latest_news_spacing_left_desktop',
                  'ts_demo_importer_latest_news_spacing_top_desktop',
                  'ts_demo_importer_latest_news_spacing_bottom_desktop',
                  'ts_demo_importer_latest_news_spacing_right_desktop',
                  'ts_demo_importer_latest_news_spacing',
              ),
          )
      ),
    )));
  }elseif ( $template == 'ts-conference') {
    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_latest_news_tab_settings', array(
      'section' => 'ts_demo_importer_latest_news',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_latest_news_enable',
                  'ts_demo_importer_latest_news_settings',
                  'ts_demo_importer_latest_news_bgcolor',
                  'ts_demo_importer_latest_news_bgimage',
                  'ts_demo_importer_latest_news_bgimage_setting',
                  'ts_demo_importer_latest_news_bgimage_size',
                  'ts_demo_importer_latest_news_carousel_loop',
                  'ts_demo_importer_latest_news_carousel_speed',
                  'ts_demo_importer_latest_news_carousel_dots',
                  'ts_demo_importer_latest_news_carousel_nav',
                  'ts_demo_importer_latest_news_content_settings',
                  'ts_demo_importer_latest_news_small_heading',
                  'ts_demo_importer_latest_news_main_heading',
                  'ts_demo_importer_latest_news_number',
                  'ts_demo_importer_latest_news_posted_by_text',
                  'ts_demo_importer_latest_news_read_more_text'
              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_latest_news_color_settings',
                  'ts_demo_importer_latest_news_small_heading_ct_pallete',
                  'ts_demo_importer_latest_news_small_heading_color',
                  'ts_demo_importer_latest_news_small_heading_font_family',
                  'ts_demo_importer_latest_news_small_heading_font_size',
                  'ts_demo_importer_latest_news_main_heading_ct_pallete',
                  'ts_demo_importer_latest_news_main_heading_color',
                  'ts_demo_importer_latest_news_main_heading_font_family',
                  'ts_demo_importer_latest_news_main_heading_font_size',
                  'ts_demo_importer_latest_news_blog_post_date_ct_pallete',
                  'ts_demo_importer_latest_news_blog_post_date_color',
                  'ts_demo_importer_latest_news_blog_post_date_font_family',
                  'ts_demo_importer_latest_news_blog_post_date_font_size',
                  'ts_demo_importer_latest_news_blog_post_date_bgcolor',
                  'ts_demo_importer_latest_news_posted_by_text_ct_pallete',
                  'ts_demo_importer_latest_news_posted_by_text_color',
                  'ts_demo_importer_latest_news_posted_by_text_font_family',
                  'ts_demo_importer_latest_news_posted_by_text_font_size',
                  'ts_demo_importer_latest_news_auther_ct_pallete',
                  'ts_demo_importer_latest_news_auther_color',
                  'ts_demo_importer_latest_news_auther_font_family',
                  'ts_demo_importer_latest_news_auther_font_size',
                  'ts_demo_importer_latest_news_title_ct_pallete',
                  'ts_demo_importer_latest_news_title_color',
                  'ts_demo_importer_latest_news_title_font_family',
                  'ts_demo_importer_latest_news_title_font_size',
                  'ts_demo_importer_latest_news_text_ct_pallete',
                  'ts_demo_importer_latest_news_text_color',
                  'ts_demo_importer_latest_news_text_font_family',
                  'ts_demo_importer_latest_news_text_font_size',
                  'ts_demo_importer_latest_news_read_more_ct_pallete',
                  'ts_demo_importer_latest_news_read_more_color',
                  'ts_demo_importer_latest_news_read_more_font_family',
                  'ts_demo_importer_latest_news_read_more_font_size',
                  'ts_demo_importer_latest_news_read_more_overlay_color',
                  'ts_demo_importer_latest_news_meta_ct_pallete',
                  'ts_demo_importer_latest_news_meta_color',
                  'ts_demo_importer_latest_news_meta_font_family',
                  'ts_demo_importer_latest_news_meta_font_size',
                  'ts_demo_importer_latest_news_meta_icon_color',
                  'ts_demo_importer_latest_news_meta_icon_font_size',
                  'ts_demo_importer_latest_news_box_border_color',
                  'ts_demo_importer_latest_news_spacing_left_desktop',
                  'ts_demo_importer_latest_news_spacing_top_desktop',
                  'ts_demo_importer_latest_news_spacing_bottom_desktop',
                  'ts_demo_importer_latest_news_spacing_right_desktop',
                  'ts_demo_importer_latest_news_spacing',
              ),
          )
      ),
    )));
  }

  $wp_customize->add_setting('ts_demo_importer_latest_news_enable',
    array(
  'default' => 'Enable',
  'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_latest_news_enable',
  array(
  'type' => 'radio',
  'label' => __('Do you want this section', 'ts-demo-importer'),
  'section' => 'ts_demo_importer_latest_news',
  'choices' => array(
  'Enable' => __('Enable', 'ts-demo-importer'),
  'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
                 TSDemoImporterAddon::load_latest_news_section($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_latest_news_enable23',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_latest_news_enable23', array(
      'section' => 'ts_demo_importer_latest_news',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }

}
  // ------------- Interested Banner --------------
if( $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_interested_banner',array(
    'title' => __('Interested Banner','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_interested_banner_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_interested_banner_tab_settings', array(
      'section' => 'ts_demo_importer_interested_banner',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_interested_banner_enable',
                  'ts_demo_importer_interested_banner_bgcolor',
                  'ts_demo_importer_interested_banner_bgimage',
                  'ts_demo_importer_interested_banner_bgimage_setting',
                  'ts_demo_importer_interested_banner_bg_gradient_name',
                  'ts_demo_importer_interested_banner_bg_gradient_direction',
                  'ts_demo_importer_interested_banner_background_color_one',
                  'ts_demo_importer_interested_banner_background_color_two',
                  'ts_demo_importer_interested_banner_background_color_three',
                  'ts_demo_importer_interested_banner_content_settings',
                  'ts_demo_importer_interested_banner_left_main_heading',
                  'ts_demo_importer_interested_banner_button',
                  'ts_demo_importer_interested_banner_button_icon',
                  'ts_demo_importer_interested_banner_button_url',
                  'ts_demo_importer_interested_banner_right_image',
                  'ts_demo_importer_interested_banner_right_image_alt_text'

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_interested_banner_content_color_settings',
                  'ts_demo_importer_interested_banner_left_main_heading_ct_pallete',
                  'ts_demo_importer_interested_banner_left_main_heading_color',
                  'ts_demo_importer_interested_banner_left_main_heading_font_family',
                  'ts_demo_importer_interested_banner_left_main_heading_font_size',
                  'ts_demo_importer_interested_banner_button_ct_pallete',
                  'ts_demo_importer_interested_banner_button_color',
                  'ts_demo_importer_interested_banner_button_font_family',
                  'ts_demo_importer_interested_banner_button_font_size',
                  'ts_demo_importer_interested_banner_button_bgcolor',
                  'ts_demo_importer_interested_banner_button_hover_bgcolor',
                  'ts_demo_importer_interested_banner_button_text_color_hover',
                  'ts_demo_importer_interested_banner_spacing_left_desktop',
                  'ts_demo_importer_interested_banner_spacing_top_desktop',
                  'ts_demo_importer_interested_banner_spacing_bottom_desktop',
                  'ts_demo_importer_interested_banner_spacing_right_desktop',
                  'ts_demo_importer_interested_banner_spacing'

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_interested_banner_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_interested_banner_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_interested_banner',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_interested_banner_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_interested_banner_enable32',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_interested_banner_enable32', array(
         'section' => 'ts_demo_importer_interested_banner',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }



}

  // ------------- Contact Us -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_contact_map',array(
    'title' => __('Contact & Map','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_contact_map_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_contact_map_tab_settings', array(
      'section' => 'ts_demo_importer_contact_map',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_contact_map_enable',
                  'ts_demo_importer_contact_map_settings',
                  // 'ts_demo_importer_contact_map_bgcolor',
                  // 'ts_demo_importer_contact_map_bgimage',
                  // 'ts_demo_importer_contact_map_bgimage_setting',
                  'ts_demo_importer_contact_map_content_settings',
                  'ts_demo_importer_contact_map_longitude',
                  'ts_demo_importer_contact_map_latitude',
                  'ts_demo_importer_contact_map_small_heading',
                  'ts_demo_importer_contact_map_main_heading',
                  'ts_demo_importer_contact_map_shortcode',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_contact_map_content_ct_pallete',
                  'ts_demo_importer_contact_map_small_heading_ct_pallete',
                  'ts_demo_importer_contact_map_small_heading_color',
                  'ts_demo_importer_contact_map_small_heading_font_family',
                  'ts_demo_importer_contact_map_small_heading_font_size',
                  'ts_demo_importer_contact_map_small_heading_border_color1',
                  'ts_demo_importer_contact_map_small_heading_border_color2',
                  'ts_demo_importer_contact_map_main_heading_ct_pallete',
                  'ts_demo_importer_contact_map_main_heading_color',
                  'ts_demo_importer_contact_map_main_heading_font_family',
                  'ts_demo_importer_contact_map_main_heading_font_size',
                  'ts_demo_importer_contact_map_form_ct_pallete',
                  'ts_demo_importer_contact_map_form_input_color',
                  'ts_demo_importer_contact_map_form_input_font_family',
                  'ts_demo_importer_contact_map_form_input_font_size',
                  'ts_demo_importer_contact_map_form_input_bgcolor',
                  // 'ts_demo_importer_contact_map_form_input_border_color',
                  'ts_demo_importer_contact_map_form_btn_ct_pallete',
                  'ts_demo_importer_contact_map_form_btn_color',
                  'ts_demo_importer_contact_map_form_btn_font_family',
                  'ts_demo_importer_contact_map_form_btn_font_size',
                  'ts_demo_importer_contact_map_form_btn_bgcolor',
                  'ts_demo_importer_contact_map_form_btn_bgcolor_hover',
                  'ts_demo_importer_contact_map_form_btn_color_hover',
                  'ts_demo_importer_contact_map_form_bgcolor',
                  'ts_demo_importer_contact_map_form_outer_bgcolor',
                  // 'ts_demo_importer_contact_map_spacing_left_desktop',
                  // 'ts_demo_importer_contact_map_spacing_top_desktop',
                  // 'ts_demo_importer_contact_map_spacing_bottom_desktop',
                  // 'ts_demo_importer_contact_map_spacing_right_desktop',
                  // 'ts_demo_importer_contact_map_spacing',
              ),
          )
      ),
  )));


  $wp_customize->add_setting('ts_demo_importer_contact_map_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_contact_map_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_contact_map',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_contact_and_map_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_contact_map_enable32',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_contact_map_enable32', array(
         'section' => 'ts_demo_importer_contact_map',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }

}elseif ( $template == 'ts-conference') {
  $wp_customize->add_section('ts_demo_importer_contact_map',array(
    'title' => __('Contact & Map','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_contact_map_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_contact_map_tab_settings', array(
      'section' => 'ts_demo_importer_contact_map',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_contact_map_enable',
                  'ts_demo_importer_contact_map_settings',
                  'ts_demo_importer_contact_map_content_settings',
                  'ts_demo_importer_contact_map_longitude',
                  'ts_demo_importer_contact_map_latitude',
                  'ts_demo_importer_contact_map_main_heading',
                  'ts_demo_importer_contact_map_description',
                  'ts_demo_importer_contact_map_shortcode',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_contact_map_content_ct_pallete',
                  'ts_demo_importer_contact_map_main_heading_ct_pallete',
                  'ts_demo_importer_contact_map_main_heading_color',
                  'ts_demo_importer_contact_map_main_heading_font_family',
                  'ts_demo_importer_contact_map_main_heading_font_size',
                  'ts_demo_importer_contact_map_description_ct_pallete',
                  'ts_demo_importer_contact_map_description_color',
                  'ts_demo_importer_contact_map_description_font_family',
                  'ts_demo_importer_contact_map_description_font_size',
                  'ts_demo_importer_contact_map_form_ct_pallete',
                  'ts_demo_importer_contact_map_form_input_color',
                  'ts_demo_importer_contact_map_form_input_font_family',
                  'ts_demo_importer_contact_map_form_input_font_size',
                  'ts_demo_importer_contact_map_form_input_bgcolor',
                  'ts_demo_importer_contact_map_form_btn_ct_pallete',
                  'ts_demo_importer_contact_map_form_btn_color',
                  'ts_demo_importer_contact_map_form_btn_font_family',
                  'ts_demo_importer_contact_map_form_btn_font_size',
                  'ts_demo_importer_contact_map_form_btn_bgcolor',
                  'ts_demo_importer_contact_map_form_btn_bgcolor_hover',
                  'ts_demo_importer_contact_map_form_btn_color_hover',
                  'ts_demo_importer_contact_map_form_bgcolor',
                  'ts_demo_importer_contact_map_form_outer_bgcolor',
              ),
          )
      ),
  )));


  $wp_customize->add_setting('ts_demo_importer_contact_map_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_contact_map_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_contact_map',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
       TSDemoImporterAddon::load_contact_and_map_section($wp_customize,$font_array);
     }else{
       $wp_customize->add_setting('ts_demo_importer_contact_map_enable32',array(
         'default' => '',
         'sanitize_callback' => 'sanitize_text_field'
       ));
       $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_contact_map_enable32', array(
         'section' => 'ts_demo_importer_contact_map',
         'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
         'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
         'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
         '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
         '</a>'
       ),
     )));
   }
}


  // ------------- Achievements -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_achievements',array(
    'title' => __('About Us Page - Achievements','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $achievements_no=get_theme_mod('ts_demo_importer_achievements_number');


  $ts_demo_importer_achievements_years = array();
  $ts_demo_importer_achievements_small_heading = array();
  $ts_demo_importer_achievements_main_heading = array();
  $ts_demo_importer_achievements_text = array();
  $ts_demo_importer_achievements_secion_image_settings = array();
  $ts_demo_importer_achievements_heading_image = array();
  $ts_demo_importer_achievements_heading_image_alt_text = array();

  for($i=1; $i<=$achievements_no ;$i++){
    $ts_demo_importer_achievements_years[$i] = 'ts_demo_importer_achievements_years'.$i;
    $ts_demo_importer_achievements_small_heading[$i] = 'ts_demo_importer_achievements_small_heading'.$i;
    $ts_demo_importer_achievements_main_heading[$i] = 'ts_demo_importer_achievements_main_heading'.$i;
    $ts_demo_importer_achievements_text[$i] = 'ts_demo_importer_achievements_text'.$i;
    $ts_demo_importer_achievements_secion_image_settings[$i] = 'ts_demo_importer_achievements_secion_image_settings'.$i;
    $ts_demo_importer_achievements_heading_image[$i] = 'ts_demo_importer_achievements_heading_image'.$i;
    $ts_demo_importer_achievements_heading_image_alt_text[$i] = 'ts_demo_importer_achievements_heading_image_alt_text'.$i;
  }

  $achievements_arr = array(
                  'ts_demo_importer_achievements_enable',
                  'ts_demo_importer_achievements_settings',
                  'ts_demo_importer_achievements_bgcolor',
                  'ts_demo_importer_achievements_bgimage',
                  'ts_demo_importer_achievements_bgimage_setting',
                  'ts_demo_importer_achievements_bgimage_size',
                  'ts_demo_importer_achievements_content_settings',
                  'ts_demo_importer_achievements_number',
                  'ts_demo_importer_achievements_years',
                  'ts_demo_importer_achievements_small_heading',
                  'ts_demo_importer_achievements_main_heading',
                  'ts_demo_importer_achievements_text',
                  'ts_demo_importer_achievements_secion_image_settings',
                  'ts_demo_importer_achievements_heading_image',
                  'ts_demo_importer_achievements_heading_image_alt_text',
                  'ts_demo_importer_achievements_quote_icon',
                  'ts_demo_importer_achievements_bgquote_icon',
                  'ts_demo_importer_achievements_number',

              );

  $achievements_final_arr = array_merge($achievements_arr, $ts_demo_importer_achievements_years, $ts_demo_importer_achievements_small_heading, $ts_demo_importer_achievements_main_heading, $ts_demo_importer_achievements_text, $ts_demo_importer_achievements_secion_image_settings, $ts_demo_importer_achievements_heading_image, $ts_demo_importer_achievements_heading_image_alt_text);

$wp_customize->add_setting('ts_demo_importer_achievements_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_achievements_tab_settings', array(
      'section' => 'ts_demo_importer_achievements',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $achievements_final_arr,

          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_achievements_color_settings',
                  'ts_demo_importer_achievements_small_heading_ct_pallete',
                  'ts_demo_importer_achievements_small_heading_color',
                  'ts_demo_importer_achievements_small_heading_font_family',
                  'ts_demo_importer_achievements_small_heading_font_size',
                  'ts_demo_importer_achievements_small_heading_border_color1',
                  'ts_demo_importer_achievements_small_heading_border_color2',
                  'ts_demo_importer_achievements_main_heading_ct_pallete',
                  'ts_demo_importer_achievements_main_heading_color',
                  'ts_demo_importer_achievements_main_heading_font_family',
                  'ts_demo_importer_achievements_main_heading_font_size',
                  'ts_demo_importer_achievements_text_ct_pallete',
                  'ts_demo_importer_achievements_text_color',
                  'ts_demo_importer_achievements_text_font_family',
                  'ts_demo_importer_achievements_text_font_size',
                  'ts_demo_importer_achievements_quote_ct_pallete',
                  'ts_demo_importer_achievements_quote_icon_color',
                  'ts_demo_importer_achievements_quote_bgicon_color',
                  'ts_demo_importer_achievements_years_ct_pallete',
                  'ts_demo_importer_achievements_years_color',
                  'ts_demo_importer_achievements_years_font_family',
                  'ts_demo_importer_achievements_years_font_size',
                  'ts_demo_importer_achievements_years_active_color',
                  'ts_demo_importer_achievements_years_bar_color',
                  'ts_demo_importer_achievements_nav_icon_color',
                  'ts_demo_importer_achievements_nav_icon_bgcolor',
                  'ts_demo_importer_achievements_nav_icon_hover_color',
                  'ts_demo_importer_achievements_nav_icon_hover_bgcolor',
                  'ts_demo_importer_achievements_spacing_left_desktop',
                  'ts_demo_importer_achievements_spacing_top_desktop',
                  'ts_demo_importer_achievements_spacing_bottom_desktop',
                  'ts_demo_importer_achievements_spacing_right_desktop',
                  'ts_demo_importer_achievements_spacing',

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_achievements_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_achievements_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_achievements',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
          TSDemoImporterAddon::load_about_us_page_achivements($wp_customize,$font_array);
        }else{
          $wp_customize->add_setting('ts_demo_importer_achievements_enable122',array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
          ));
          $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_achievements_enable122', array(
            'section' => 'ts_demo_importer_achievements',
            'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
            'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
            'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
            '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
            '</a>'
          ),
        )));
      }
}

  // ------------- Our Records Advance marketing agency --------------
  if( $template == 'advance-marketing-agency' || $template == 'advance-consultancy'){
    $wp_customize->add_section('ts_demo_importer_our_records',array(
      'title' => __('About Us Page - Our Records','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $record_number = get_theme_mod('ts_demo_importer_our_records_number');

    $ts_demo_importer_our_records_box_settings = array();
    $ts_demo_importer_our_records_no = array();
    $ts_demo_importer_our_records_title = array();
    $ts_demo_importer_our_records_url = array();

    for($i=1; $i<=$record_number ;$i++){
      $ts_demo_importer_our_records_box_settings[$i] = 'ts_demo_importer_our_records_box_settings'.$i;
      $ts_demo_importer_our_records_no[$i] = 'ts_demo_importer_our_records_no'.$i;
      $ts_demo_importer_our_records_title[$i] = 'ts_demo_importer_our_records_title'.$i;
      $ts_demo_importer_our_records_url[$i] = 'ts_demo_importer_our_records_url'.$i;
    }

    $record_arr = array(
                    'ts_demo_importer_our_records_enable',
                    'ts_demo_importer_our_records_settings',
                    'ts_demo_importer_our_records_bgcolor',
                    'ts_demo_importer_our_records_bgimage',
                    'ts_demo_importer_our_records_bgimage_setting',
                    'ts_demo_importer_our_records_bgimage_size',
                    'ts_demo_importer_our_records_content_settings',
                    'ts_demo_importer_our_records_carousel_loop',
                    'ts_demo_importer_our_records_carousel_speed',
                    'ts_demo_importer_our_records_carousel_dots',
                    'ts_demo_importer_our_records_carousel_nav',
                    'ts_demo_importer_our_records_number',
                    'ts_demo_importer_our_records_carousel_loop',
                    'ts_demo_importer_our_records_carousel_speed',
                    'ts_demo_importer_our_records_carousel_dots',
                    'ts_demo_importer_our_records_carousel_nav',
                    'ts_demo_importer_our_records_number',


                );

    $record_arr_final = array_merge($record_arr, $ts_demo_importer_our_records_box_settings, $ts_demo_importer_our_records_no, $ts_demo_importer_our_records_title, $ts_demo_importer_our_records_url);

    $wp_customize->add_setting('ts_demo_importer_record_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_record_tab_settings', array(
        'section' => 'ts_demo_importer_our_records',
        'buttons' => array(

            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => $record_arr_final,
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_our_records_color_settings',
                    'ts_demo_importer_our_records_small_heading_color',
                    'ts_demo_importer_our_records_small_heading_font_family',
                    'ts_demo_importer_our_records_small_heading_font_size',
                    'ts_demo_importer_our_records_main_heading_ct_pallete',
                    'ts_demo_importer_our_records_small_heading_ct_pallete',
                    'ts_demo_importer_our_records_main_heading_color',
                    'ts_demo_importer_our_records_main_heading_font_family',
                    'ts_demo_importer_our_records_main_heading_font_size',
                    'ts_demo_importer_our_records_text_ct_pallete',
                    'ts_demo_importer_our_records_text_color',
                    'ts_demo_importer_our_records_text_font_family',
                    'ts_demo_importer_our_records_text_font_size',
                    'ts_demo_importer_our_records_box_title_ct_pallete',
                    'ts_demo_importer_our_records_box_title_color',
                    'ts_demo_importer_our_records_box_title_font_family',
                    'ts_demo_importer_our_records_box_title_font_size',
                    'ts_demo_importer_our_records_box_text_ct_pallete',
                    'ts_demo_importer_our_records_box_text_color',
                    'ts_demo_importer_our_records_box_text_font_family',
                    'ts_demo_importer_our_records_box_text_font_size',
                    'ts_demo_importer_our_records_box_border_color',
                    'ts_demo_importer_our_records_spacing_left_desktop',
                    'ts_demo_importer_our_records_spacing_top_desktop',
                    'ts_demo_importer_our_records_spacing_bottom_desktop',
                    'ts_demo_importer_our_records_spacing_right_desktop',
                    'ts_demo_importer_our_records_spacing',

                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));
    $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_our_records_enable', array(
      'selector' => '#our-records .container',
      'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_our_records_enable',
    ));
    $wp_customize->add_setting( 'ts_demo_importer_our_records_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_settings',
      array(
      'label' => __('Section Background Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_bgcolor', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_bgcolor', array(
      'label' => __('Section Background Color', 'ts-demo-importer'),
      'description'   => __('Either add background color or background image, if you add both background color will be top most priority','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_bgcolor',
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_bgimage',array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize,'ts_demo_importer_our_records_bgimage',array(
      'label' => __('Section Background Image','ts-demo-importer'),
      'description' => __('Dimension 1600px * 270px (This Image is for mobile and About Us and Inner page )','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_bgimage'
    )));

    //Work Column Layout
    $wp_customize->add_setting( 'ts_demo_importer_our_records_bgimage_setting', array(
        'default'         => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_bgimage_setting', array(
        'type'      => 'radio',
        'label'     => __('Choose image option', 'ts-demo-importer'),
        'section'   => 'ts_demo_importer_our_records',
        'choices'   => array(
          'bg-fixed'      => __( 'Fixed', 'ts-demo-importer' ),
          'bg-scroll'      => __( 'Scroll', 'ts-demo-importer' ),
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_bgimage_size', array(
        'default' => '',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_bgimage_size', array(
        'type' => 'radio',
        'label' => __('Background Image Size', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records',
        'choices' => array(
            'bg-auto' => __('Auto', 'ts-demo-importer'),
            'bg-cover' => __('Cover', 'ts-demo-importer'),
            'bg-contain' => __('Contain', 'ts-demo-importer'),
            'bg-xy' => __('Cover X & Y', 'ts-demo-importer'),
            'bg-x' => __('Cover X', 'ts-demo-importer'),
        )
    ));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_content_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_content_settings',
      array(
      'label' => __('Section Content Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_carousel_loop',
     array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_our_records_carousel_loop',
       array(
          'label' => esc_html__( 'Carousel Loop', 'ts-demo-importer' ),
          'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_speed',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_carousel_speed',array(
      'label' => __('Carousel Speed','ts-demo-importer'),
      'description'=>__('Ex. 1000 for One second','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_carousel_speed',
      'type'    => 'number'
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_dots', array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control(new ts_demo_importer_Toggle_Switch_Custom_control($wp_customize, 'ts_demo_importer_our_records_carousel_dots', array(
        'label' => esc_html__('Carousel Dots', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_carousel_nav', array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control(new ts_demo_importer_Toggle_Switch_Custom_control($wp_customize, 'ts_demo_importer_our_records_carousel_nav', array(
        'label' => esc_html__('Carousel Nav', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_number',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_number',array(
      'label' => __('No Of Records To Show','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_number',
      'type'    => 'number'
    ));

    $record_no = get_theme_mod('ts_demo_importer_our_records_number');

    for($i=1; $i<=3; $i++)
    {
      $wp_customize->add_setting( 'ts_demo_importer_our_records_box_settings'.$i,
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
      ));
      $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_settings'.$i,
        array(
        'label' => __('Record ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records'
      )));

      $wp_customize->add_setting('ts_demo_importer_our_records_no'.$i,array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_no'.$i,array(
        'label' => __('Record No ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_no'.$i,
        'type'    => 'text'
      ));
      $wp_customize->add_setting('ts_demo_importer_our_records_title'.$i,array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_title'.$i,array(
        'label' => __('Record Title ','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_title'.$i,
        'type'    => 'text'
      ));

      $wp_customize->add_setting('ts_demo_importer_our_records_url'.$i,array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('ts_demo_importer_our_records_url'.$i,array(
        'label' => __('Custom URL','ts-demo-importer').$i,
        'section' => 'ts_demo_importer_our_records',
        'setting' => 'ts_demo_importer_our_records_url'.$i,
        'type'    => 'text'
      ));
    }
    $wp_customize->add_setting( 'ts_demo_importer_our_records_color_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_color_settings',
    array(
      'label' => __('Section Color & Typography','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_title_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_title_ct_pallete',
      array(
      'label' => __('Box Title Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_title_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_title_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_title_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_our_records_box_title_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_our_records_box_title_font_family', array(
      'section'  => 'ts_demo_importer_our_records',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_box_title_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_box_title_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_box_title_font_size',
      'type'    => 'number'
    ));


    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_text_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_records_box_text_ct_pallete',
      array(
      'label' => __('Box Text Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_text_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_text_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_text_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_our_records_box_text_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_our_records_box_text_font_family', array(
      'section'  => 'ts_demo_importer_our_records',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_box_text_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_our_records_box_text_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'setting' => 'ts_demo_importer_our_records_box_text_font_size',
      'type'    => 'number'
    ));

    $wp_customize->add_setting( 'ts_demo_importer_our_records_box_border_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_our_records_box_border_color', array(
      'label' => __('Border Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_our_records',
      'settings' => 'ts_demo_importer_our_records_box_border_color',
    )));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_left_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_top_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_bottom_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_setting('ts_demo_importer_our_records_spacing_right_desktop', array(
        'sanitize_callback' => 'ts_demo_importer_sanitize_number_blank',
    ));

    $wp_customize->add_control(new ts_demo_importer_Dimensions_Control($wp_customize, 'ts_demo_importer_our_records_spacing', array(
        'section' => 'ts_demo_importer_our_records',
        'label' => esc_html__('Section Spacing(px)', 'total'),
        'settings' => array(
            'desktop_left' => 'ts_demo_importer_our_records_spacing_left_desktop',
            'desktop_top' => 'ts_demo_importer_our_records_spacing_top_desktop',
            'desktop_bottom' => 'ts_demo_importer_our_records_spacing_bottom_desktop',
            'desktop_right' => 'ts_demo_importer_our_records_spacing_right_desktop'
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'responsive' => false
    )));
  }

  // ------------- Our Vision -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_our_vision',array(
    'title' => __('About Us Page - Our Vision','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_our_vision_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_vision_tab_settings', array(
      'section' => 'ts_demo_importer_our_vision',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_our_vision_enable',
                  'ts_demo_importer_our_vision_settings',
                  'ts_demo_importer_our_vision_bgcolor',
                  'ts_demo_importer_our_vision_bgimage',
                  'ts_demo_importer_our_vision_bgimage_setting',
                  'ts_demo_importer_our_vision_bgimage_size',
                  'ts_demo_importer_our_vision_content_settings',
                  'ts_demo_importer_our_vision_small_heading',
                  'ts_demo_importer_our_vision_main_heading',
                  'ts_demo_importer_our_vision_text',
                  'ts_demo_importer_our_vision_button_title',
                  'ts_demo_importer_our_vision_button_icon',
                  'ts_demo_importer_our_vision_button_url',
                  'ts_demo_importer_our_vision_secion_image_settings',
                  'ts_demo_importer_our_vision_heading_image',
                  'ts_demo_importer_our_vision_heading_image_alt_text',
                  // 'ts_demo_importer_our_vision_badge_settings',
                  // 'ts_demo_importer_our_vision_badge_icon',
                  'ts_demo_importer_our_vision_image_badge_text',
                  'ts_demo_importer_our_vision_video_icon',
                  'ts_demo_importer_our_vision_video_url',


              ),

          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_vision_color_settings',
                  'ts_demo_importer_our_vision_small_heading_ct_pallete',
                  'ts_demo_importer_our_vision_small_heading_color',
                  'ts_demo_importer_our_vision_small_heading_font_family',
                  'ts_demo_importer_our_vision_small_heading_font_size',
                  'ts_demo_importer_our_vision_small_heading_border_color1',
                  'ts_demo_importer_our_vision_small_heading_border_color2',
                  'ts_demo_importer_our_vision_main_heading_ct_pallete',
                  'ts_demo_importer_our_vision_main_heading_color',
                  'ts_demo_importer_our_vision_main_heading_font_family',
                  'ts_demo_importer_our_vision_main_heading_font_size',
                  'ts_demo_importer_our_vision_text_ct_pallete',
                  'ts_demo_importer_our_vision_text_color',
                  'ts_demo_importer_our_vision_text_font_family',
                  'ts_demo_importer_our_vision_text_font_size',
                  'ts_demo_importer_our_vision_button_ct_pallete',
                  'ts_demo_importer_our_vision_button_color',
                  'ts_demo_importer_our_vision_button_font_family',
                  'ts_demo_importer_our_vision_button_font_size',
                  'ts_demo_importer_our_vision_button_bgcolor',
                  'ts_demo_importer_our_vision_button_hover_bgcolor',
                  'ts_demo_importer_our_vision_button_text_color_hover',
                  'ts_demo_importer_our_vision_left_column_bgcolor',
                  'ts_demo_importer_our_vision_video_icon_bgcolor',
                  'ts_demo_importer_our_vision_video_icon_color',
                  'ts_demo_importer_our_vision_image_overlay_color',
                  'ts_demo_importer_our_vision_spacing_left_desktop',
                  'ts_demo_importer_our_vision_spacing_top_desktop',
                  'ts_demo_importer_our_vision_spacing_bottom_desktop',
                  'ts_demo_importer_our_vision_spacing_right_desktop',
                  'ts_demo_importer_our_vision_spacing',

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_our_vision_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_our_vision_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_vision',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));


  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
        TSDemoImporterAddon::load_our_vision_section($wp_customize,$font_array);
      }else{
        $wp_customize->add_setting('ts_demo_importer_our_vision_enable87',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_vision_enable87', array(
          'section' => 'ts_demo_importer_our_vision',
          'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
          'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
          'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
          '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
          '</a>'
        ),
      )));
    }
}


  /*-------------------------------------------- Hiring Banner Section --------------------------------------*/
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_hiring_banner_sec',array(
    'title' => __('About Us Page - Hiring Banner','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_hiring_banner_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_hiring_banner_tab_settings', array(
      'section' => 'ts_demo_importer_hiring_banner_sec',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_hiring_banner_enable',
                  'ts_demo_importer_hiring_banner_sec_bg_settings',
                  'ts_demo_importer_hiring_banner_bgcolor',
                  'ts_demo_importer_hiring_banner_bgcolor_opacity',
                  'ts_demo_importer_hiring_banner_bgimage',
                  'ts_demo_importer_hiring_banner_bgimage_attachment',
                  'ts_demo_importer_hiring_banner_bgimage_size',
                  'ts_demo_importer_hiring_banner_sec_content_settings',
                  'ts_demo_importer_hiring_banner_head',
                  'ts_demo_importer_hiring_banner_head2',
                  'ts_demo_importer_hiring_banner_ct_pallete',
                  'ts_demo_importer_hiring_banner_button_read_more',
                  'ts_demo_importer_hiring_banner_button_read_more_url',
                  'ts_demo_importer_hiring_banner_button_read_more_icon',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_hiring_banner_content_color_settings',
                  'ts_demo_importer_hiring_banner_small_heading_ct_pallete',
                  'ts_demo_importer_hiring_banner_small_heading_color',
                  'ts_demo_importer_hiring_banner_small_heading_font_family',
                  'ts_demo_importer_hiring_banner_small_heading_font_size',
                  'ts_demo_importer_hiring_banner_small_heading_border_color1',
                  'ts_demo_importer_hiring_banner_small_heading_border_color2',
                  'ts_demo_importer_hiring_banner_main_heading_ct_pallete',
                  'ts_demo_importer_hiring_banner_main_heading_color',
                  'ts_demo_importer_hiring_banner_main_heading_font_family',
                  'ts_demo_importer_hiring_banner_main_heading_font_size',
                  'ts_demo_importer_hiring_banner_button_ct_pallete',
                  'ts_demo_importer_hiring_banner_button_color',
                  'ts_demo_importer_hiring_banner_button_font_family',
                  'ts_demo_importer_hiring_banner_button_font_size',
                  'ts_demo_importer_hiring_banner_button_bgcolor',
                  'ts_demo_importer_hiring_banner_button_hover_bgcolor',
                  'ts_demo_importer_hiring_banner_button_text_color_hover',
                  'ts_demo_importer_hiring_banner_overlay_color',
                  'ts_demo_importer_hiring_banner_sec_spacing_left_desktop',
                  'ts_demo_importer_hiring_banner_sec_spacing_top_desktop',
                  'ts_demo_importer_hiring_banner_sec_spacing_bottom_desktop',
                  'ts_demo_importer_hiring_banner_sec_spacing_right_desktop',
                  'ts_demo_importer_hiring_banner_sec_spacing',
              ),
          )
      ),
  )));
  $wp_customize->add_setting('ts_demo_importer_hiring_banner_enable',
      array(
          'default' => 'Enable',
          'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_hiring_banner_enable',
      array(
          'type' => 'radio',
          'label' => __('Do you want this section', 'ts-demo-importer'),
          'section' => 'ts_demo_importer_hiring_banner_sec',
          'choices' => array(
          'Enable' => __('Enable', 'ts-demo-importer'),
          'Disable' => __('Disable', 'ts-demo-importer')
          ),
  ));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_hiring_banner_section($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_hiring_banner_enable122',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_hiring_banner_enable122', array(
      'section' => 'ts_demo_importer_hiring_banner_sec',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }

// if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
//         TSDemoImporterAddon::loadbtn_url_banner_section($wp_customize,$font_array);
// }

}

  // --------------- Business Skills  --------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_business_skills',array(
    'title' => __('About Us Page - Business Skills','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $skills_business_no=get_theme_mod('ts_demo_importer_business_skills_number');

  $ts_demo_importer_business_skills_box_settings = array();
  $ts_demo_importer_business_skills_icon = array();
  $ts_demo_importer_business_skills_title = array();
  $ts_demo_importer_business_skills_percentage = array();
  $ts_demo_importer_business_skills_desc = array();

  for($i=1; $i<=$skills_business_no ;$i++){
    $ts_demo_importer_business_skills_box_settings[$i] = 'ts_demo_importer_business_skills_box_settings'.$i;
    $ts_demo_importer_business_skills_icon[$i] = 'ts_demo_importer_business_skills_icon'.$i;
    $ts_demo_importer_business_skills_title[$i] = 'ts_demo_importer_business_skills_title'.$i;
    $ts_demo_importer_business_skills_percentage[$i] = 'ts_demo_importer_business_skills_percentage'.$i;
    $ts_demo_importer_business_skills_desc[$i] = 'ts_demo_importer_business_skills_desc'.$i;
  }

  $business_skills_arr = array(
                  'ts_demo_importer_business_skills_enable',
                  'ts_demo_importer_business_skills_settings',
                  'ts_demo_importer_business_skills_bgcolor',
                  'ts_demo_importer_business_skills_bgimage',
                  'ts_demo_importer_business_skills_bgimage_setting',
                  // 'ts_demo_importer_business_skills_bgimage_attachment',
                  'ts_demo_importer_business_skills_bgimage_size',
                  'ts_demo_importer_business_skills_content_settings',
                  'ts_demo_importer_business_skills_small_heading',
                  'ts_demo_importer_business_skills_main_heading',
                  'ts_demo_importer_business_skills_number',
                  'ts_demo_importer_business_skills_box_settings',
                  'ts_demo_importer_business_skills_icon',
                  'ts_demo_importer_business_skills_title',
                  'ts_demo_importer_business_skills_percentage',
                  'ts_demo_importer_business_skills_desc',

              );

  $business_skills_arr_final = array_merge($business_skills_arr, $ts_demo_importer_business_skills_box_settings, $ts_demo_importer_business_skills_icon, $ts_demo_importer_business_skills_title, $ts_demo_importer_business_skills_percentage, $ts_demo_importer_business_skills_desc);

$wp_customize->add_setting('ts_demo_importer_business_skills_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_business_skills_tab_settings', array(
      'section' => 'ts_demo_importer_business_skills',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $business_skills_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_business_skills_color_settings',
                  'ts_demo_importer_business_skills_small_heading_ct_pallete',
                  'ts_demo_importer_business_skills_small_heading_color',
                  'ts_demo_importer_business_skills_small_heading_font_family',
                  'ts_demo_importer_business_skills_small_heading_font_size',
                  'ts_demo_importer_business_skills_small_heading_border_color1',
                  'ts_demo_importer_business_skills_small_heading_border_color2',
                  'ts_demo_importer_business_skills_main_heading_ct_pallete',
                  'ts_demo_importer_business_skills_main_heading_color',
                  'ts_demo_importer_business_skills_main_heading_font_family',
                  'ts_demo_importer_business_skills_main_heading_font_size',
                  'ts_demo_importer_business_skills_box_title_ct_pallete',
                  'ts_demo_importer_business_skills_box_title_color',
                  'ts_demo_importer_business_skills_box_title_font_family',
                  'ts_demo_importer_business_skills_box_title_font_size',
                  'ts_demo_importer_business_skills_box_text_ct_pallete',
                  'ts_demo_importer_business_skills_box_text_color',
                  'ts_demo_importer_business_skills_box_text_font_family',
                  'ts_demo_importer_business_skills_box_text_font_size',
                  'ts_demo_importer_business_skills_box_icon_ct_pallete',
                  'ts_demo_importer_business_skills_box_icon_color',
                  'ts_demo_importer_business_skills_box_icon_font_size',
                  'ts_demo_importer_business_skills_box_circular_bar_color1',
                  'ts_demo_importer_business_skills_box_circular_bar_color2',
                  'ts_demo_importer_business_skills_spacing_left_desktop',
                  'ts_demo_importer_business_skills_spacing_top_desktop',
                  'ts_demo_importer_business_skills_spacing_bottom_desktop',
                  'ts_demo_importer_business_skills_spacing_right_desktop',
                  'ts_demo_importer_business_skills_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_business_skills_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_business_skills_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_business_skills',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
     TSDemoImporterAddon::load_about_us_business_skills_section($wp_customize,$font_array);
   }else{
     $wp_customize->add_setting('ts_demo_importer_business_skills_enable21',array(
       'default' => '',
       'sanitize_callback' => 'sanitize_text_field'
     ));
     $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_business_skills_enable21', array(
       'section' => 'ts_demo_importer_business_skills',
       'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
       'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
}
  // ------------- team Video -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_team_video',array(
    'title' => __(' Team Page - Team Video','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_team_video_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_team_video_tab_settings', array(
      'section' => 'ts_demo_importer_team_video',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_team_video_enable',
                  'ts_demo_importer_team_video_settings',
                  'ts_demo_importer_team_video_bgcolor',
                  'ts_demo_importer_team_video_bgimage',
                  'ts_demo_importer_team_video_bgimage_setting',
                  'ts_demo_importer_team_video_bgimage_size',
                  'ts_demo_importer_team_video_content_settings',
                  'ts_demo_importer_team_video_small_heading',
                  'ts_demo_importer_team_video_main_heading',
                  'ts_demo_importer_team_video_text',
                  'ts_demo_importer_team_video_secion_image_settings',
                  'ts_demo_importer_team_video_heading_image',
                  // 'ts_demo_importer_team_video_heading_image_alt_text',
                  'ts_demo_importer_team_video_video_icon',
                  'ts_demo_importer_team_video_video_url',

              ),

          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_team_video_color_settings',
                  'ts_demo_importer_team_video_small_heading_ct_pallete',
                  'ts_demo_importer_team_video_small_heading_color',
                  'ts_demo_importer_team_video_small_heading_font_family',
                  'ts_demo_importer_team_video_small_heading_font_size',
                  'ts_demo_importer_team_video_small_heading_border_color1',
                  'ts_demo_importer_team_video_small_heading_border_color2',
                  'ts_demo_importer_team_video_main_heading_ct_pallete',
                  'ts_demo_importer_team_video_main_heading_color',
                  'ts_demo_importer_team_video_main_heading_font_family',
                  'ts_demo_importer_team_video_main_heading_font_size',
                  'ts_demo_importer_team_video_text_ct_pallete',
                  'ts_demo_importer_team_video_text_color',
                  'ts_demo_importer_team_video_text_font_family',
                  'ts_demo_importer_team_video_text_font_size',
                  'ts_demo_importer_team_video_icon_bgcolor',
                  'ts_demo_importer_team_video_icon_color',
                  'ts_demo_importer_team_video_image_overlay_color',
                  'ts_demo_importer_team_video_spacing_left_desktop',
                  'ts_demo_importer_team_video_spacing_top_desktop',
                  'ts_demo_importer_team_video_spacing_bottom_desktop',
                  'ts_demo_importer_team_video_spacing_right_desktop',
                  'ts_demo_importer_team_video_spacing',


              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_team_video_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_team_video_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_team_video',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
     TSDemoImporterAddon::load_team_video_section($wp_customize,$font_array);
   }else{
     $wp_customize->add_setting('ts_demo_importer_team_video_enable12',array(
       'default' => '',
       'sanitize_callback' => 'sanitize_text_field'
     ));
     $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_team_video_enable12', array(
       'section' => 'ts_demo_importer_team_video',
       'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
       'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
       'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
       '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
       '</a>'
     ),
   )));
 }
}
 /*--------------------Team Section------------------------------*/
if( $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
 $wp_customize->add_section('ts_demo_importer_team_section',array(
     'title'         => __('Team Page - Our Team ','ts-demo-importer'),
     'priority'      => null,
     'panel'         => 'ts_demo_importer_panel_id',
 ));

 $wp_customize->add_setting('ts_demo_importer_team_tab_settings', array(
 'sanitize_callback' => 'wp_kses_post',
 ));

 $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_team_tab_settings', array(
     'section' => 'ts_demo_importer_team_section',
     'buttons' => array(
         array(
             'name' => esc_html__('Content', 'ts-demo-importer'),
             'icon' => 'dashicons dashicons-welcome-write-blog',
             'fields' => array(
                 'ts_demo_importer_radio_team_enable',
                 'ts_demo_importer_our_team_back_option',
                 'ts_demo_importer_team_bgcolor',
                 'ts_demo_importer_our_team_bgimage',
                 'ts_demo_importer_our_team_bgimage_attachment',
                 'ts_demo_importer_our_team_content_option',
                 'ts_demo_importer_team_sec_title',
                 'ts_demo_importer_team_sec_main_title',
                 'ts_demo_importer_team_sec_subtitle',
                 'ts_demo_importer_team_sec_ct_pallete',
                 'ts_demo_importer_team_sec_button_read_more',
                 'ts_demo_importer_team_sec_button_read_more_url',
                 'ts_demo_importer_team_sec_button_read_more_icon',
                 'ts_demo_importer_our_team_option',

             ),
         ),
         array(
             'name' => esc_html__('Style', 'ts-demo-importer'),
             'icon' => 'dashicons dashicons-art',
             'fields' => array(
                 'ts_demo_importer_our_team_content_color_settings',
                 'ts_demo_importer_our_team_small_heading_ct_pallete',
                 'ts_demo_importer_our_team_small_heading_color',
                 'ts_demo_importer_our_team_small_heading_font_family',
                 'ts_demo_importer_our_team_small_heading_font_size',
                 'ts_demo_importer_our_team_small_heading_border_color1',
                 'ts_demo_importer_our_team_small_heading_border_color2',
                 'ts_demo_importer_our_team_main_heading_ct_pallete',
                 'ts_demo_importer_our_team_main_heading_color',
                 'ts_demo_importer_our_team_main_heading_font_family',
                 'ts_demo_importer_our_team_main_heading_font_size',
                 'ts_demo_importer_our_team_text_ct_pallete',
                 'ts_demo_importer_our_team_text_color',
                 'ts_demo_importer_our_team_text_font_family',
                 'ts_demo_importer_our_team_text_font_size',
                 'ts_demo_importer_our_team_button_ct_pallete',
                 'ts_demo_importer_our_team_button_color',
                 'ts_demo_importer_our_team_button_font_family',
                 'ts_demo_importer_our_team_button_font_size',
                 'ts_demo_importer_our_team_button_bgcolor',
                 'ts_demo_importer_our_team_button_hover_bgcolor',
                 'ts_demo_importer_our_team_button_text_color_hover',
                 'ts_demo_importer_our_team_box_title_ct_pallete',
                 'ts_demo_importer_our_team_box_title_color',
                 'ts_demo_importer_our_team_box_title_font_family',
                 'ts_demo_importer_our_team_box_title_font_size',
                 'ts_demo_importer_our_team_box_desig_ct_pallete',
                 'ts_demo_importer_our_team_box_desig_color',
                 'ts_demo_importer_our_team_box_desig_font_family',
                 'ts_demo_importer_our_team_box_desig_font_size',
                 'ts_demo_importer_our_team_box_icon_ct_pallete',
                 'ts_demo_importer_our_team_box_icon_color',
                 'ts_demo_importer_our_team_box_icon_font_size',
                 'ts_demo_importer_our_team_box_bgcolor',
                 'ts_demo_importer_our_team_spacing_left_desktop',
                 'ts_demo_importer_our_team_spacing_top_desktop',
                 'ts_demo_importer_our_team_spacing_bottom_desktop',
                 'ts_demo_importer_our_team_spacing_right_desktop',
                 'ts_demo_importer_our_team_spacing',
             ),
         )
     ),
 )));

   $wp_customize->add_setting( 'ts_demo_importer_our_team_option',
   array(
       'default' => '',
       'transport' => 'postMessage',
       'sanitize_callback' => 'ts_demo_importer_text_sanitization'
   )
   );
   $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_team_option',
   array(
       'label' => __('Team Option','ts-demo-importer'),
       'section' => 'ts_demo_importer_team_section'
   )
   ) );
   $wp_customize->add_setting('ts_demo_importer_radio_team_enable',array(
       'default'           => 'Enable',
       'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
   ));
   $wp_customize->add_control('ts_demo_importer_radio_team_enable', array(
       'type'        => 'radio',
       'label'       => 'Do you want this section',
       'section'     => 'ts_demo_importer_team_section',
       'choices'     => array(
           'Enable'  => 'Enable',
           'Disable' => 'Disable'
       ),
   ));



   if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
   TSDemoImporterAddon::load_team_section($wp_customize,$font_array);

 }else{
   $wp_customize->add_setting('ts_demo_importer_radio_team_enable326',array(
     'default' => '',
     'sanitize_callback' => 'sanitize_text_field'
   ));
   $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_radio_team_enable326', array(
     'section' => 'ts_demo_importer_team_section',
     'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
     'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
     'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
     '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
     '</a>'
   ),
 )));
 }
}
if ( $template == 'ts-conference') {
  $wp_customize->add_section('ts_demo_importer_team_section',array(
      'title'         => __('Our Speakers ','ts-demo-importer'),
      'priority'      => null,
      'panel'         => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_team_tab_settings', array(
  'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_team_tab_settings', array(
      'section' => 'ts_demo_importer_team_section',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_radio_team_enable',
                  'ts_demo_importer_our_team_back_option',
                  'ts_demo_importer_team_bgcolor',
                  'ts_demo_importer_our_team_bgimage',
                  'ts_demo_importer_our_team_bgimage_attachment',
                  'ts_demo_importer_our_team_content_option',
                  'ts_demo_importer_our_team_small_heading',
                  'ts_demo_importer_our_team_main_heading',
                  'ts_demo_importer_our_team_see_all_speaker_btn',
                  'ts_demo_importer_our_team_see_all_speaker_btn_url',
              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_team_small_heading_ct_pallete',
                  'ts_demo_importer_our_team_small_heading_color',
                  'ts_demo_importer_our_team_small_heading_font_family',
                  'ts_demo_importer_our_team_small_heading_font_size',
                  'ts_demo_importer_our_team_main_heading_ct_pallete',
                  'ts_demo_importer_our_team_main_heading_color',
                  'ts_demo_importer_our_team_main_heading_font_family',
                  'ts_demo_importer_our_team_main_heading_font_size',
                  'ts_demo_importer_our_team_degination_ct_pallete',
                  'ts_demo_importer_our_team_degination_color',
                  'ts_demo_importer_our_team_degination_font_family',
                  'ts_demo_importer_our_team_degination_font_size',
                  'ts_demo_importer_our_team_name_ct_pallete',
                  'ts_demo_importer_our_team_name_color',
                  'ts_demo_importer_our_team_name_font_family',
                  'ts_demo_importer_our_team_name_font_size',
                  'ts_demo_importer_our_team_social_icon_ct_pallete',
                  'ts_demo_importer_our_team_social_icon_color',
                  'ts_demo_importer_our_team_social_icon_font_size',
                  'ts_demo_importer_our_team_button_ct_pallete',
                  'ts_demo_importer_our_team_button_color',
                  'ts_demo_importer_our_team_button_font_family',
                  'ts_demo_importer_our_team_button_font_size',
                  'ts_demo_importer_our_team_button_bgcolor',
              ),
          )
      ),
  )));

    $wp_customize->add_setting( 'ts_demo_importer_our_team_option',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    )
    );
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_our_team_option',
    array(
        'label' => __('Team Option','ts-demo-importer'),
        'section' => 'ts_demo_importer_team_section'
    )
    ) );
    $wp_customize->add_setting('ts_demo_importer_radio_team_enable',array(
        'default'           => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_radio_team_enable', array(
        'type'        => 'radio',
        'label'       => 'Do you want this section',
        'section'     => 'ts_demo_importer_team_section',
        'choices'     => array(
            'Enable'  => 'Enable',
            'Disable' => 'Disable'
        ),
    ));



    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_team_section($wp_customize,$font_array);

  }else{
    $wp_customize->add_setting('ts_demo_importer_radio_team_enable326',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_radio_team_enable326', array(
      'section' => 'ts_demo_importer_team_section',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
}
  /*--------------------Team Block------------------------------*/
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_team_block_section',array(
      'title'         => __('Team Page - Team block','ts-demo-importer'),
      'priority'      => null,
      'panel'         => 'ts_demo_importer_panel_id',
  ));
    $wp_customize->add_setting('ts_demo_importer_team_block_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_team_block_tab_settings', array(
      'section' => 'ts_demo_importer_team_block_section',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_radio_team_block_enable',
                  'ts_demo_importer_team_block_back_option',
                  'ts_demo_importer_team_block_bgcolor',
                  'ts_demo_importer_team_block_bgimage',
                  'ts_demo_importer_team_block_bgimage_attachment',
                  'ts_demo_importer_team_block_bgimage_size',
                  'ts_demo_importer_team_block_content_option',
                  'ts_demo_importer_team_block_sec_main_title',
                  'ts_demo_importer_team_block_quote_icon',
                  'ts_demo_importer_team_block_bgimage_size',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_team_block_content_color_settings',
                  'ts_demo_importer_team_block_main_heading_ct_pallete',
                  'ts_demo_importer_team_block_main_heading_color',
                  'ts_demo_importer_team_block_main_heading_font_family',
                  'ts_demo_importer_team_block_main_heading_font_size',
                  'ts_demo_importer_team_block_box_title_ct_pallete',
                  'ts_demo_importer_team_block_box_title_color',
                  'ts_demo_importer_team_block_box_title_font_family',
                  'ts_demo_importer_team_block_box_title_font_size',
                  'ts_demo_importer_team_block_box_desig_ct_pallete',
                  'ts_demo_importer_team_block_box_desig_color',
                  'ts_demo_importer_team_block_box_desig_font_family',
                  'ts_demo_importer_team_block_box_desig_font_size',
                  'ts_demo_importer_team_block_box_icon_ct_pallete',
                  'ts_demo_importer_team_block_box_icon_color',
                  'ts_demo_importer_team_block_box_icon_font_size',
                  'ts_demo_importer_team_block_box_bgcolor',
                  'ts_demo_importer_team_block_content_box_bgcolor',
                  'ts_demo_importer_team_block_content_box_quote_color',
                  'ts_demo_importer_team_block_content_box_quote_font_size',
                  'ts_demo_importer_team_block_spacing_left_desktop',
                  'ts_demo_importer_team_block_spacing_top_desktop',
                  'ts_demo_importer_team_block_spacing_bottom_desktop',
                  'ts_demo_importer_team_block_spacing_right_desktop',
                  'ts_demo_importer_team_block_spacing',
              ),
          )
      ),
  )));

    // $wp_customize->add_setting( 'ts_demo_importer_team_block_option',
    // array(
    //     'default' => '',
    //     'transport' => 'postMessage',
    //     'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    // )
    // );
    // $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_team_block_option',
    // array(
    //     'label' => __('Team Block Option','ts-demo-importer'),
    //     'section' => 'ts_demo_importer_team_block_section'
    // )
    // ) );
    $wp_customize->add_setting('ts_demo_importer_radio_team_block_enable',array(
        'default'           => 'Enable',
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_radio_team_block_enable', array(
        'type'        => 'radio',
        'label'       => 'Do you want this section',
        'section'     => 'ts_demo_importer_team_block_section',
        'choices'     => array(
            'Enable'  => 'Enable',
            'Disable' => 'Disable'
        ),
    ));

    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_team_block_video_section($wp_customize,$font_array);
      }else{
        $wp_customize->add_setting('ts_demo_importer_radio_team_block_enable34',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_radio_team_block_enable34', array(
          'section' => 'ts_demo_importer_team_block_section',
          'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
          'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
          'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
          '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
          '</a>'
        ),
      )));
      }
}
  // ------------- Single Team -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_single_team',array(
    'title' => __('Team Page - Single Team','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $single_team_no=get_theme_mod('ts_demo_importer_single_team_number');

  $ts_demo_importer_single_team_social_icon = array();
  $ts_demo_importer_single_team_social_icon_url = array();

  for($i=1; $i<=$single_team_no ;$i++){
    $ts_demo_importer_single_team_social_icon[$i] = 'ts_demo_importer_single_team_social_icon'.$i;
    $ts_demo_importer_single_team_social_icon_url[$i] = 'ts_demo_importer_single_team_social_icon_url'.$i;
  }

  $single_team_arr = array(
                  'ts_demo_importer_single_team_enable',
                  'ts_demo_importer_single_team_settings',
                  'ts_demo_importer_single_team_bgcolor',
                  'ts_demo_importer_single_team_bgimage',
                  'ts_demo_importer_single_team_bgimage_setting',
                  'ts_demo_importer_single_team_bgimage_size',
                  'ts_demo_importer_single_team_content_settings',
                  'ts_demo_importer_single_team_small_heading',
                  'ts_demo_importer_single_team_main_heading',
                  'ts_demo_importer_single_team_text',
                  'ts_demo_importer_single_team_secion_image_settings',
                  'ts_demo_importer_single_team_image',
                  'ts_demo_importer_single_team_image_alt_text',
                  'ts_demo_importer_single_team_member_name',
                  // 'ts_demo_importer_single_team_badge_icon',
                  'ts_demo_importer_single_team_member_desig',
                  'ts_demo_importer_single_team_social_icon_settings',
                  'ts_demo_importer_single_team_number',
                  'ts_demo_importer_single_team_social_icon',
                  'ts_demo_importer_single_team_social_icon_url',

              );

  $single_team_arr_final = array_merge($single_team_arr, $ts_demo_importer_single_team_social_icon, $ts_demo_importer_single_team_social_icon_url);

  $wp_customize->add_setting('ts_demo_importer_single_team_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_single_team_tab_settings', array(
      'section' => 'ts_demo_importer_single_team',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $single_team_arr_final

          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_single_team_color_settings',
                  'ts_demo_importer_single_team_small_heading_ct_pallete',
                  'ts_demo_importer_single_team_small_heading_color',
                  'ts_demo_importer_single_team_small_heading_font_family',
                  'ts_demo_importer_single_team_small_heading_font_size',
                  'ts_demo_importer_single_team_small_heading_border_color1',
                  'ts_demo_importer_single_team_small_heading_border_color2',
                  'ts_demo_importer_single_team_main_heading_ct_pallete',
                  'ts_demo_importer_single_team_main_heading_color',
                  'ts_demo_importer_single_team_main_heading_font_family',
                  'ts_demo_importer_single_team_main_heading_font_size',
                  'ts_demo_importer_single_team_text_ct_pallete',
                  'ts_demo_importer_single_team_text_color',
                  'ts_demo_importer_single_team_text_font_family',
                  'ts_demo_importer_single_team_text_font_size',
                  'ts_demo_importer_single_team_member_name_ct_pallete',
                  'ts_demo_importer_single_team_member_name_color',
                  'ts_demo_importer_single_team_member_name_font_family',
                  'ts_demo_importer_single_team_member_name_font_size',
                  'ts_demo_importer_single_team_member_desig_ct_pallete',
                  'ts_demo_importer_single_team_member_desig_color',
                  'ts_demo_importer_single_team_member_desig_font_family',
                  'ts_demo_importer_single_team_member_desig_font_size',
                  'ts_demo_importer_single_team_member_social_icon_ct_pallete',
                  'ts_demo_importer_single_team_member_social_icon_color',
                  'ts_demo_importer_single_team_member_social_icon_bgcolor',
                  'ts_demo_importer_single_team_image_bubble_ct_pallete',
                  'ts_demo_importer_single_team_image_bubble_color1',
                  'ts_demo_importer_single_team_image_bubble_color2',
                  'ts_demo_importer_single_team_spacing_left_desktop',
                  'ts_demo_importer_single_team_spacing_top_desktop',
                  'ts_demo_importer_single_team_spacing_bottom_desktop',
                  'ts_demo_importer_single_team_spacing_right_desktop',
                  'ts_demo_importer_single_team_spacing',

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_single_team_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_single_team_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_single_team',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
                  TSDemoImporterAddon::load_single_team_page_section($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_single_team_enable22',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_single_team_enable22', array(
      'section' => 'ts_demo_importer_single_team',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
}

  // ---------- Our Projects tab -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_our_projects_tab',array(
    'title' => __('Portfolio Page - Projects Tab','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $project_tab_no = get_theme_mod('ts_demo_importer_our_projects_tab_number');

  $ts_demo_importer_our_projects_tab_name = array();
  $ts_demo_importer_our_projects_tab_no = array();
  $ts_demo_importer_our_projects_tab_categoryselection_setting = array();
  $ts_demo_importer_our_projects_tab_name_seperator = array();


  for($i=1; $i<=$project_tab_no ;$i++){
    $ts_demo_importer_our_projects_tab_name[$i] = 'ts_demo_importer_our_projects_tab_name'.$i;
    $ts_demo_importer_our_projects_tab_no[$i] = 'ts_demo_importer_our_projects_tab_no'.$i;
    $ts_demo_importer_our_projects_tab_categoryselection_setting[$i] = 'ts_demo_importer_our_projects_tab_categoryselection_setting'.$i;
    $ts_demo_importer_our_projects_tab_name_seperator[$i] = 'ts_demo_importer_our_projects_tab_name_seperator'.$i;
  }

  $project_tab_arr = array(
                  'ts_demo_importer_our_projects_tab_enable',
                  'ts_demo_importer_our_projects_tab_settings',
                  'ts_demo_importer_our_projects_tab_bgcolor',
                  'ts_demo_importer_our_projects_tab_bgimage',
                  'ts_demo_importer_our_projects_tab_bgimage_setting',
                  'ts_demo_importer_our_projects_tab_bgimage_size',
                  'ts_demo_importer_our_projects_tab_content_settings',
                  'ts_demo_importer_our_projects_tab_small_heading',
                  'ts_demo_importer_our_projects_tab_main_heading',
                  'ts_demo_importer_our_projects_tab_text',
                  'ts_demo_importer_our_projects_tab_box_link_text',
                  'ts_demo_importer_our_projects_tab_number',
                  'ts_demo_importer_our_projects_tab_name_seperator',
                  'ts_demo_importer_our_projects_tab_name',
                  'ts_demo_importer_our_projects_tab_categoryselection_setting',

              );

  $project_tab_final = array_merge($project_tab_arr, $ts_demo_importer_our_projects_tab_name, $ts_demo_importer_our_projects_tab_no, $ts_demo_importer_our_projects_tab_categoryselection_setting, $ts_demo_importer_our_projects_tab_name_seperator);

  $wp_customize->add_setting('ts_demo_importer_our_projects_tab_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_our_projects_tab_tab_settings', array(
      'section' => 'ts_demo_importer_our_projects_tab',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $project_tab_final,
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_our_projects_tab_color_settings',
                  'ts_demo_importer_our_projects_tab_small_heading_ct_pallete',
                  'ts_demo_importer_our_projects_tab_small_heading_color',
                  'ts_demo_importer_our_projects_tab_small_heading_font_family',
                  'ts_demo_importer_our_projects_tab_small_heading_font_size',
                  'ts_demo_importer_our_projects_tab_small_heading_border_color1',
                  'ts_demo_importer_our_projects_tab_small_heading_border_color2',
                  'ts_demo_importer_our_projects_tab_main_heading_ct_pallete',
                  'ts_demo_importer_our_projects_tab_main_heading_color',
                  'ts_demo_importer_our_projects_tab_main_heading_font_family',
                  'ts_demo_importer_our_projects_tab_main_heading_font_size',
                  'ts_demo_importer_our_projects_tab_text_ct_pallete',
                  'ts_demo_importer_our_projects_tab_text_color',
                  'ts_demo_importer_our_projects_tab_text_font_family',
                  'ts_demo_importer_our_projects_tab_text_font_size',
                  'ts_demo_importer_our_projects_tab_title_ct_pallete',
                  'ts_demo_importer_our_projects_tab_title_color',
                  'ts_demo_importer_our_projects_tab_title_font_family',
                  'ts_demo_importer_our_projects_tab_title_font_size',
                  'ts_demo_importer_our_projects_tab_nav_bgcolor',
                  'ts_demo_importer_our_projects_tab_box_title_ct_pallete',
                  'ts_demo_importer_our_projects_tab_box_title_color',
                  'ts_demo_importer_our_projects_tab_box_title_font_family',
                  'ts_demo_importer_our_projects_tab_box_title_font_size',
                  'ts_demo_importer_our_projects_tab_box_short_title_ct_pallete',
                  'ts_demo_importer_our_projects_tab_box_short_title_color',
                  'ts_demo_importer_our_projects_tab_box_short_title_font_family',
                  'ts_demo_importer_our_projects_tab_box_short_title_font_size',
                  'ts_demo_importer_our_projects_tab_box_short_title_border_color',
                  'ts_demo_importer_our_projects_tab_box_bgcolor',
                  'ts_demo_importer_our_projects_tab_link_learn_more_ct_pallete',
                  'ts_demo_importer_our_projects_tab_link_learn_more_color',
                  'ts_demo_importer_our_projects_tab_link_learn_more_font_family',
                  'ts_demo_importer_our_projects_tab_link_learn_more_font_size',

                  'ts_demo_importer_our_projects_tab_box_hover_bgcolor',
                  'ts_demo_importer_our_projects_tab_box_hover_text_color',
                  'ts_demo_importer_our_projects_tab_title_border_color',
                  'ts_demo_importer_our_projects_tab_type_ct_pallete',
                  'ts_demo_importer_our_projects_tab_type_color',
                  'ts_demo_importer_our_projects_tab_type_font_family',
                  'ts_demo_importer_our_projects_tab_type_font_size',
                  'ts_demo_importer_our_projects_tab_short_title_ct_pallete',
                  'ts_demo_importer_our_projects_tab_short_title_color',
                  'ts_demo_importer_our_projects_tab_short_title_font_family',
                  'ts_demo_importer_our_projects_tab_short_title_font_size',
                  'ts_demo_importer_our_projects_tab_link_overlay_color',
                  'ts_demo_importer_our_projects_tab_spacing_left_desktop',
                  'ts_demo_importer_our_projects_tab_spacing_top_desktop',
                  'ts_demo_importer_our_projects_tab_spacing_bottom_desktop',
                  'ts_demo_importer_our_projects_tab_spacing_right_desktop',
                  'ts_demo_importer_our_projects_tab_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_our_projects_tab_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));

  $wp_customize->add_control('ts_demo_importer_our_projects_tab_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_our_projects_tab',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_projects_tab_section($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_our_projects_tab_enable21',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_our_projects_tab_enable21', array(
      'section' => 'ts_demo_importer_our_projects_tab',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
  ),
    )));
  }
}
  //----------------- Hiring Features ---------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_hiring_features',array(
    'title' => __('Hiring Page - Hiring Features','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $feature_no=get_theme_mod('ts_demo_importer_hiring_features_number');

  $ts_demo_importer_hiring_features_box_settings = array();
  $ts_demo_importer_hiring_features_icon = array();
  $ts_demo_importer_hiring_features_title = array();
  $ts_demo_importer_hiring_features_desc = array();
  $ts_demo_importer_hiring_features_url = array();

  for($i=1; $i<=$feature_no ;$i++){
    $ts_demo_importer_hiring_features_box_settings[$i] = 'ts_demo_importer_hiring_features_box_settings'.$i;
    $ts_demo_importer_hiring_features_icon[$i] = 'ts_demo_importer_hiring_features_icon'.$i;
    $ts_demo_importer_hiring_features_title[$i] = 'ts_demo_importer_hiring_features_title'.$i;
    $ts_demo_importer_hiring_features_desc[$i] = 'ts_demo_importer_hiring_features_desc'.$i;
    $ts_demo_importer_hiring_features_url[$i] = 'ts_demo_importer_hiring_features_url'.$i;
  }

  $feature_arr = array(
                  'ts_demo_importer_hiring_features_enable',
                  'ts_demo_importer_hiring_features_settings',
                  'ts_demo_importer_hiring_features_bgcolor',
                  'ts_demo_importer_hiring_features_bgimage',
                  'ts_demo_importer_hiring_features_bgimage_setting',
                  'ts_demo_importer_hiring_features_bgimage_size',
                  'ts_demo_importer_hiring_features_content_settings',
                  'ts_demo_importer_hiring_features_number',
                  'ts_demo_importer_hiring_features_box_settings',
                  'ts_demo_importer_hiring_features_icon',
                  'ts_demo_importer_hiring_features_title',
                  'ts_demo_importer_hiring_features_url',
                  'ts_demo_importer_hiring_features_desc',

              );

  $feature_arr_final = array_merge($feature_arr, $ts_demo_importer_hiring_features_box_settings, $ts_demo_importer_hiring_features_icon, $ts_demo_importer_hiring_features_title, $ts_demo_importer_hiring_features_desc, $ts_demo_importer_hiring_features_url);

$wp_customize->add_setting('ts_demo_importer_hiring_features_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_hiring_features_tab_settings', array(
      'section' => 'ts_demo_importer_hiring_features',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $feature_arr_final
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_hiring_features_color_settings',
                  'ts_demo_importer_hiring_features_box_title_ct_pallete',
                  'ts_demo_importer_hiring_features_box_title_color',
                  'ts_demo_importer_hiring_features_box_title_font_family',
                  'ts_demo_importer_hiring_features_box_title_font_size',
                  'ts_demo_importer_hiring_features_box_text_ct_pallete',
                  'ts_demo_importer_hiring_features_box_text_color',
                  'ts_demo_importer_hiring_features_box_text_font_family',
                  'ts_demo_importer_hiring_features_box_text_font_size',
                  'ts_demo_importer_hiring_features_box_icon_ct_pallete',
                  'ts_demo_importer_hiring_features_box_icon_color',
                  // 'ts_demo_importer_hiring_features_box_icon_bgcolor',
                  'ts_demo_importer_hiring_features_box_color_ct_pallete',
                  'ts_demo_importer_hiring_features_box_bgcolor',
                  // 'ts_demo_importer_hiring_features_box_border_color',
                  'ts_demo_importer_hiring_features_box_hover_bgcolor',
                  // 'ts_demo_importer_hiring_features_box_hover_bgcolor',
                  'ts_demo_importer_hiring_features_box_hover_text_color',
                  // 'ts_demo_importer_hiring_features_box_hover_icon_color',
                  // 'ts_demo_importer_hiring_features_box_hover_icon_bg_color',
                  'ts_demo_importer_hiring_features_spacing_left_desktop',
                  'ts_demo_importer_hiring_features_spacing_top_desktop',
                  'ts_demo_importer_hiring_features_spacing_bottom_desktop',
                  'ts_demo_importer_hiring_features_spacing_right_desktop',
                  'ts_demo_importer_hiring_features_spacing',

              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_hiring_features_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_hiring_features_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_hiring_features',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_hiring_features_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_hiring_features_enable12',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_hiring_features_enable12', array(
        'section' => 'ts_demo_importer_hiring_features',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
}
  // ---------- Hiring Roles -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_hiring_roles',array(
    'title' => __('Hiring Page - Hiring Roles','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $hiring_roles_no=get_theme_mod('ts_demo_importer_hiring_roles_number');

  $ts_demo_importer_hiring_roles_box_settings = array();
    $ts_demo_importer_hiring_roles_image = array();
    $ts_demo_importer_hiring_roles_title = array();
    $ts_demo_importer_hiring_roles_url = array();
    $ts_demo_importer_hiring_roles_sub_title = array();
    $ts_demo_importer_hiring_roles_type = array();
    $ts_demo_importer_hiring_roles_box_link = array();
    $ts_demo_importer_hiring_roles_box_link_icon = array();
    $ts_demo_importer_hiring_roles_box_url = array();

    for($i=1; $i<=$hiring_roles_no ;$i++){
      $ts_demo_importer_hiring_roles_box_settings[$i] = 'ts_demo_importer_hiring_roles_box_settings'.$i;
      $ts_demo_importer_hiring_roles_image[$i] = 'ts_demo_importer_hiring_roles_image'.$i;
      $ts_demo_importer_hiring_roles_title[$i] = 'ts_demo_importer_hiring_roles_title'.$i;
      $ts_demo_importer_hiring_roles_url[$i] = 'ts_demo_importer_hiring_roles_url'.$i;
      $ts_demo_importer_hiring_roles_sub_title[$i] = 'ts_demo_importer_hiring_roles_sub_title'.$i;
      $ts_demo_importer_hiring_roles_type[$i] = 'ts_demo_importer_hiring_roles_type'.$i;
      $ts_demo_importer_hiring_roles_box_link[$i] = 'ts_demo_importer_hiring_roles_box_link'.$i;
      $ts_demo_importer_hiring_roles_box_link_icon[$i] = 'ts_demo_importer_hiring_roles_box_link_icon'.$i;
      $ts_demo_importer_hiring_roles_box_url[$i] = 'ts_demo_importer_hiring_roles_box_url'.$i;
    }

    $hiring_roles_arr = array(
                    'ts_demo_importer_hiring_roles_enable',
                    'ts_demo_importer_hiring_roles_settings',
                    'ts_demo_importer_hiring_roles_bgcolor',
                    'ts_demo_importer_hiring_roles_bgimage',
                    'ts_demo_importer_hiring_roles_bgimage_setting',
                    'ts_demo_importer_hiring_roles_bgimage_size',
                    'ts_demo_importer_hiring_roles_carousel_loop',
                    'ts_demo_importer_hiring_roles_carousel_speed',
                    'ts_demo_importer_hiring_roles_carousel_dots',
                    'ts_demo_importer_hiring_roles_carousel_nav',
                    'ts_demo_importer_hiring_roles_content_settings',
                    'ts_demo_importer_hiring_roles_small_heading',
                    'ts_demo_importer_hiring_roles_main_heading',
                    'ts_demo_importer_hiring_roles_number',
                    'ts_demo_importer_hiring_roles_box_settings',
                    'ts_demo_importer_hiring_roles_image',
                    'ts_demo_importer_hiring_roles_title',
                    'ts_demo_importer_hiring_roles_url',
                    'ts_demo_importer_hiring_roles_sub_title',
                    'ts_demo_importer_hiring_roles_type',
                    'ts_demo_importer_hiring_roles_box_link',
                    'ts_demo_importer_hiring_roles_box_link_icon',
                    'ts_demo_importer_hiring_roles_box_url',

                    'ts_demo_importer_hiring_roles_box_link_text',
                    'ts_demo_importer_hiring_roles_box_link_icon',

                );

    $hiring_roles_final = array_merge($hiring_roles_arr, $ts_demo_importer_hiring_roles_box_settings, $ts_demo_importer_hiring_roles_image, $ts_demo_importer_hiring_roles_title, $ts_demo_importer_hiring_roles_url, $ts_demo_importer_hiring_roles_sub_title, $ts_demo_importer_hiring_roles_type, $ts_demo_importer_hiring_roles_box_link, $ts_demo_importer_hiring_roles_box_link_icon, $ts_demo_importer_hiring_roles_box_url);

  $wp_customize->add_setting('ts_demo_importer_hiring_roles_tab_settings', array(
      'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_hiring_roles_tab_settings', array(
        'section' => 'ts_demo_importer_hiring_roles',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-welcome-write-blog',
                'fields' => $hiring_roles_final,
            ),
            array(
                'name' => esc_html__('Style', 'ts-demo-importer'),
                'icon' => 'dashicons dashicons-art',
                'fields' => array(
                    'ts_demo_importer_hiring_roles_color_settings',
                    'ts_demo_importer_hiring_roles_small_heading_ct_pallete',
                    'ts_demo_importer_hiring_roles_small_heading_color',
                    'ts_demo_importer_hiring_roles_small_heading_font_family',
                    'ts_demo_importer_hiring_roles_small_heading_font_size',
                    'ts_demo_importer_hiring_roles_small_heading_border_color1',
                    'ts_demo_importer_hiring_roles_small_heading_border_color2',
                    'ts_demo_importer_hiring_roles_main_heading_ct_pallete',
                    'ts_demo_importer_hiring_roles_main_heading_color',
                    'ts_demo_importer_hiring_roles_main_heading_font_family',
                    'ts_demo_importer_hiring_roles_main_heading_font_size',
                    'ts_demo_importer_hiring_roles_title_ct_pallete',
                    'ts_demo_importer_hiring_roles_title_color',
                    'ts_demo_importer_hiring_roles_title_font_family',
                    'ts_demo_importer_hiring_roles_title_font_size',
                    'ts_demo_importer_hiring_roles_title_border_color',
                    'ts_demo_importer_hiring_roles_type_ct_pallete',
                    'ts_demo_importer_hiring_roles_type_color',
                    'ts_demo_importer_hiring_roles_type_font_family',
                    'ts_demo_importer_hiring_roles_type_font_size',
                    'ts_demo_importer_hiring_roles_short_title_ct_pallete',
                    'ts_demo_importer_hiring_roles_short_title_color',
                    'ts_demo_importer_hiring_roles_short_title_font_family',
                    'ts_demo_importer_hiring_roles_short_title_font_size',
                    'ts_demo_importer_hiring_roles_box_bgcolor',
                    'ts_demo_importer_hiring_roles_box_hover_bgcolor',
                    'ts_demo_importer_hiring_roles_box_hover_text_color',
                    'ts_demo_importer_hiring_roles_link_overlay_color',
                    'ts_demo_importer_hiring_roles_link_learn_more_ct_pallete',
                    'ts_demo_importer_hiring_roles_link_learn_more_color',
                    'ts_demo_importer_hiring_roles_link_learn_more_font_family',
                    'ts_demo_importer_hiring_roles_link_learn_more_font_size',
                    'ts_demo_importer_hiring_roles_spacing_left_desktop',
                    'ts_demo_importer_hiring_roles_spacing_top_desktop',
                    'ts_demo_importer_hiring_roles_spacing_bottom_desktop',
                    'ts_demo_importer_hiring_roles_spacing_right_desktop',
                    'ts_demo_importer_hiring_roles_spacing',
                ),
            )
        ),
    )));

    $wp_customize->add_setting('ts_demo_importer_hiring_roles_enable',
        array(
      'default' => 'Enable',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control('ts_demo_importer_hiring_roles_enable',
      array(
      'type' => 'radio',
      'label' => __('Do you want this section', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_hiring_roles',
      'choices' => array(
      'Enable' => __('Enable', 'ts-demo-importer'),
      'Disable' => __('Disable', 'ts-demo-importer')
    )));

    if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
      TSDemoImporterAddon::load_hiring_roles_section($wp_customize,$font_array);
    }else{
      $wp_customize->add_setting('ts_demo_importer_hiring_roles_enable23',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_hiring_roles_enable23', array(
        'section' => 'ts_demo_importer_hiring_roles',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
    }
}
  // ------------- Hiring Contact -------------
if( $template == 'multi-advance' || $template == 'advance-marketing-agency' || $template == 'advance-consultancy' ){
  $wp_customize->add_section('ts_demo_importer_hiring_contact',array(
    'title' => __('Hiring Page - Hiring Contact','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_hiring_contact_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_hiring_contact_tab_settings', array(
      'section' => 'ts_demo_importer_hiring_contact',
      'buttons' => array(
          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                  'ts_demo_importer_hiring_contact_enable',
                  'ts_demo_importer_hiring_contact_settings',
                  'ts_demo_importer_hiring_contact_bgcolor',
                  'ts_demo_importer_hiring_contact_bgimage',
                  'ts_demo_importer_hiring_contact_bgimage_setting',
                  'ts_demo_importer_hiring_contact_bgimage_size',
                  'ts_demo_importer_hiring_contact_content_settings',
                  // 'ts_demo_importer_hiring_contact_longitude',
                  // 'ts_demo_importer_hiring_contact_latitude',
                  'ts_demo_importer_hiring_contact_small_heading',
                  'ts_demo_importer_hiring_contact_main_heading',
                  'ts_demo_importer_hiring_contact_text',
                  'ts_demo_importer_hiring_contact_shortcode',

              ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_hiring_contact_content_ct_pallete',
                  'ts_demo_importer_hiring_contact_small_heading_ct_pallete',
                  'ts_demo_importer_hiring_contact_small_heading_color',
                  'ts_demo_importer_hiring_contact_small_heading_font_family',
                  'ts_demo_importer_hiring_contact_small_heading_font_size',
                  'ts_demo_importer_hiring_contact_small_heading_border_color1',
                  'ts_demo_importer_hiring_contact_small_heading_border_color2',
                  'ts_demo_importer_hiring_contact_main_heading_ct_pallete',
                  'ts_demo_importer_hiring_contact_main_heading_color',
                  'ts_demo_importer_hiring_contact_main_heading_font_family',
                  'ts_demo_importer_hiring_contact_main_heading_font_size',
                  'ts_demo_importer_hiring_contact_text_ct_pallete',
                  'ts_demo_importer_hiring_contact_text_color',
                  'ts_demo_importer_hiring_contact_text_font_family',
                  'ts_demo_importer_hiring_contact_text_font_size',
                  'ts_demo_importer_hiring_contact_form_ct_pallete',
                  'ts_demo_importer_hiring_contact_form_input_color',
                  'ts_demo_importer_hiring_contact_form_input_font_family',
                  'ts_demo_importer_hiring_contact_form_input_font_size',
                  'ts_demo_importer_hiring_contact_form_input_bgcolor',
                  'ts_demo_importer_hiring_contact_form_input_border_color',
                  'ts_demo_importer_hiring_contact_form_btn_ct_pallete',
                  'ts_demo_importer_hiring_contact_form_btn_color',
                  'ts_demo_importer_hiring_contact_form_btn_font_family',
                  'ts_demo_importer_hiring_contact_form_btn_font_size',
                  'ts_demo_importer_hiring_contact_form_btn_bgcolor',
                  'ts_demo_importer_hiring_contact_form_btn_bgcolor_hover',
                  'ts_demo_importer_hiring_contact_form_btn_color_hover',
                  'ts_demo_importer_hiring_contact_form_bgcolor',
                  'ts_demo_importer_hiring_contact_spacing_left_desktop',
                  'ts_demo_importer_hiring_contact_spacing_top_desktop',
                  'ts_demo_importer_hiring_contact_spacing_bottom_desktop',
                  'ts_demo_importer_hiring_contact_spacing_right_desktop',
                  'ts_demo_importer_hiring_contact_spacing',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_hiring_contact_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_hiring_contact_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_hiring_contact',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));

  if( class_exists('TSDemoImporterAddon') && is_plugin_active('ts-demo-importer-addon/index.php') && $license_active ){
    TSDemoImporterAddon::load_hiring_contact_page($wp_customize,$font_array);
  }else{
    $wp_customize->add_setting('ts_demo_importer_hiring_contact_enable32',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_hiring_contact_enable32', array(
      'section' => 'ts_demo_importer_hiring_contact',
      'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
      'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
      'content' => sprintf( __( '%1$sBuy Now%2$s', 'ts-demo-importer' ),
      '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
      '</a>'
    ),
  )));
  }
}

    // --------------- General Settings -------------

  $wp_customize->add_section('ts_demo_importer_general_settings',array(
    'title' => __('General Settings','ts-demo-importer'),
    'description'   => __('See section settings below and do check documentation too.','ts-demo-importer'),
    'priority'  => null,
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting( 'ts_demo_importer_page_title_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_page_title_settings',
    array(
    'label' => __('Page Title Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));

  //Page Title layout
  $wp_customize->add_setting('ts_demo_importer_page_title_content_option',array(
    'default' => __('Left','ts-demo-importer'),
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_page_title_content_option', array(
      'type' => 'select',
      'label' => __('Page Title Layouts','ts-demo-importer'),
      'section' => 'ts_demo_importer_general_settings',
      'choices' => array(
       'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/header-layout1.png',
          'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/header-layout2.png',
          'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/header-layout3.png',
  ))));

  $wp_customize->add_setting( 'ts_demo_importer_page_short_title_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_page_short_title_ct_pallete',
  array(
    'label' => __('Short Title Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_page_short_title_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_page_short_title_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_page_short_title_color',
  )));
  //This is Slider Heading FontFamily picker setting
  $wp_customize->add_setting('ts_demo_importer_page_short_title_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control(
      'ts_demo_importer_page_short_title_font_family', array(
      'section'  => 'ts_demo_importer_general_settings',
      'label'    => __( 'Fonts','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_page_short_title_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_page_short_title_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('Default Font size is 14px','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'setting' => 'ts_demo_importer_page_short_title_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_page_title_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_page_title_ct_pallete',
  array(
    'label' => __('Main Title Typography ','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_page_title_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_page_title_color', array(
    'label' => __('Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_page_title_color',
  )));
  //This is Slider Heading FontFamily picker setting
  $wp_customize->add_setting('ts_demo_importer_page_title_font_family',array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control(
      'ts_demo_importer_page_title_font_family', array(
      'section'  => 'ts_demo_importer_general_settings',
      'label'    => __( 'Fonts','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));

  $wp_customize->add_setting('ts_demo_importer_page_title_font_size',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_page_title_font_size',array(
    'label' => __('Font Size','ts-demo-importer'),
    'description' => __('default Font Size is 40px','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'setting' => 'ts_demo_importer_page_title_font_size',
    'type'    => 'number'
  ));

  $wp_customize->add_setting( 'ts_demo_importer_products_spinner_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_products_spinner_settings',
    array(
    'label' => __('Spinner Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));

  $wp_customize->add_setting('ts_demo_importer_spinner_opacity_color',array(
      'default'              => '1',
      'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));

  $wp_customize->add_control( 'ts_demo_importer_spinner_opacity_color', array(
    'label'       => esc_html__( 'Spinner Loader Opacity','ts-demo-importer' ),
    'section'     => 'ts_demo_importer_general_settings',
    'type'        => 'select',
    'settings'    => 'ts_demo_importer_spinner_opacity_color',
    'choices' => array(
        '0' =>  esc_attr('0','ts-demo-importer'),
        '0.1' =>  esc_attr('0.1','ts-demo-importer'),
        '0.2' =>  esc_attr('0.2','ts-demo-importer'),
        '0.3' =>  esc_attr('0.3','ts-demo-importer'),
        '0.4' =>  esc_attr('0.4','ts-demo-importer'),
        '0.5' =>  esc_attr('0.5','ts-demo-importer'),
        '0.6' =>  esc_attr('0.6','ts-demo-importer'),
        '0.7' =>  esc_attr('0.7','ts-demo-importer'),
        '0.8' =>  esc_attr('0.8','ts-demo-importer'),
        '0.9' =>  esc_attr('0.9','ts-demo-importer'),
        '1' =>  esc_attr('1','ts-demo-importer')
    ),
  ));

 $wp_customize->add_setting( 'ts_demo_importer_general_settings_scroll_top',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_general_settings_scroll_top',
    array(
    'label' => __('Scroll Top Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));

  $wp_customize->add_setting( 'ts_demo_importer_general_scroll_top_icon_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_general_scroll_top_icon_color', array(
    'label' => __('Scroll Top Icon Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_general_scroll_top_icon_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_general_scroll_top_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_general_scroll_top_bgcolor', array(
    'label' => __('Scroll Top Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_general_scroll_top_bgcolor',
  )));
  $wp_customize->add_setting( 'ts_demo_importer_general_scroll_top_hover_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_general_scroll_top_hover_bgcolor', array(
    'label' => __('Scroll Top Hover Background Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_general_scroll_top_hover_bgcolor',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_general_scroll_top_hover_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_general_scroll_top_hover_color', array(
    'label' => __('Scroll Top Hover Color', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings',
    'settings' => 'ts_demo_importer_general_scroll_top_hover_color',
  )));

  $wp_customize->add_setting( 'ts_demo_importer_site_frame_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_site_frame_settings',
    array(
    'label' => __('Site Frame Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_general_settings'
  )));
  $wp_customize->add_setting('ts_demo_importer_site_frame_width',array(
      'default'   => '',
      'sanitize_callback' => 'sanitize_textarea_field',
  ));
  $wp_customize->add_control('ts_demo_importer_site_frame_width',array(
      'label' => __('Frame Width','ts-demo-importer'),
      'section'   => 'ts_demo_importer_general_settings',
      'type'      => 'number'
  ));

  $wp_customize->add_setting('ts_demo_importer_site_frame_type',array(
        'default' => __('','ts-demo-importer'),
        'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_site_frame_type',array(
        'type' => 'select',
        'label' => __('Frame Type','ts-demo-importer'),
        'section' => 'ts_demo_importer_general_settings',
        'choices' => array(
            '' => __('','ts-demo-importer'),
            'solid' => __('Solid','ts-demo-importer'),
            'dashed' => __('Dashed','ts-demo-importer'),
            'double' => __('Double','ts-demo-importer'),
            'groove' => __('Groove','ts-demo-importer'),
            'ridge' => __('Ridge','ts-demo-importer'),
            'inset' => __('Inset','ts-demo-importer')
        ),
   ) );

  $wp_customize->add_setting( 'ts_demo_importer_site_frame_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_site_frame_color', array(
      'label' => __('Frame Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_general_settings',
      'settings' => 'ts_demo_importer_site_frame_color',
  )));
  // ------------- Button Settings ----------

    $wp_customize->add_setting( 'ts_demo_importer_breadcrumb_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_breadcrumb_ct_pallete',
      array(
      'label' => __('Breadcrumb Typography','ts-demo-importer'),
      'section' => 'ts_demo_importer_general_settings'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_site_breadcrumb_enable',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));
    $wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_site_breadcrumb_enable',array(
          'label' => esc_html__( 'Show / Hide Breadcrumb','ts-demo-importer' ),
          'section' => 'ts_demo_importer_general_settings'
    )));

    $wp_customize->add_setting('ts_demo_importer_breadcrumb_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_breadcrumb_color', array(
        'label' => __('Color', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_general_settings',
        'settings' => 'ts_demo_importer_breadcrumb_color'
    )));

    $wp_customize->add_setting('ts_demo_importer_breadcrumb_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_breadcrumb_font_family', array(
      'section'  => 'ts_demo_importer_general_settings',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_breadcrumb_font_size', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_breadcrumb_font_size', array(
        'label' => __('Font Size', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_general_settings',
        'setting' => 'ts_demo_importer_breadcrumb_font_size',
        'type' => 'number'
    ));

    $wp_customize->add_setting('ts_demo_importer_breadcrumb_bgcolor', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_breadcrumb_bgcolor', array(
        'label' => __('Background Color', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_general_settings',
        'settings' => 'ts_demo_importer_breadcrumb_bgcolor'
    )));

    $wp_customize->add_setting('ts_demo_importer_post_general_settings_show_hide_page_title', array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
    ));

    $wp_customize->add_control(new ts_demo_importer_Toggle_Switch_Custom_control($wp_customize, 'ts_demo_importer_post_general_settings_show_hide_page_title', array(
        'label' => esc_html__('Show or Hide Page Title', 'ts-demo-importer'),
        'section' => 'ts_demo_importer_general_settings'
    )));

  /*-----------------------Blog Page Settings--------------------------*/

  $wp_customize->add_section('ts_demo_importer_blog_page_settings',array(
    'title' => __('Blog Page Settings','ts-demo-importer'),
    'description'   => __('See section settings below and do check documentation too.','ts-demo-importer'),
    'priority'  => null,
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $categories = get_categories();
  $cats = array();
  $i = 0;
  foreach($categories as $category){
    if($i==0){
      $default = $category->slug;
      $i++;
    }
    $cats[$category->slug] = $category->name;
  }
  $wp_customize->add_setting('ts_demo_importer_category_setting',array(
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_category_setting',array(
    'type'    => 'select',
    'choices' => $cats,
    'label' => __('Blog page','ts-demo-importer'),
    'description' => __('Select category to show selected post','ts-demo-importer'),
    'section' => 'ts_demo_importer_blog_page_settings',
  ));

  //Blog layout
  $wp_customize->add_setting('ts_demo_importer_post_content_layout',array(
        'default' => __('Left','ts-demo-importer'),
        'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
    ));
    $wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_post_content_layout', array(
        'type' => 'select',
        'label' => __('Post Content Layout','ts-demo-importer'),
        'section' => 'ts_demo_importer_blog_page_settings',
        'choices' => array(
            'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
            'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
            'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
    ))));

  //Shortcode Section
    $wp_customize->add_section('ts_demo_importer_shortcode_section',array(
        'title' => __('Shortcode Settings','ts-demo-importer'),
        'priority'  => null,
        'panel' => 'ts_demo_importer_panel_id',
    ));
    $wp_customize->add_setting( 'ts_demo_importer_shortcode',
       array(
           'default' => '',
           'transport' => 'postMessage',
           'sanitize_callback' => 'ts_demo_importer_text_sanitization'
       )
   );
   $wp_customize->add_control( new TS_Themes_Simple_Notice_Custom_Control( $wp_customize, 'ts_demo_importer_shortcode',
       array(
           'label' => __( 'Sections Shortcodes', 'ts-demo-importer'),
           'description' => __('Below  shortcodes are present in the theme. Simply copy and paste into any page or post and get their listing <br><br> <ul><li><strong>[ts-demo-importer-achievements]</li></strong><br><li><strong>[ts-demo-importer-record]</strong></li><br><li><strong>[ts-demo-importer-brands]</strong></li><br><li><strong>[ts-demo-importer-our-vision]</strong></li><li><strong>[ts-demo-importer-hiring-banner]</strong></li><li><strong>[ts-demo-importer-business-skills]</strong></li><li><strong>[ts-demo-importer-contact-map]</strong></li><li><strong>[ts-demo-importer-team]</strong></li><li><strong>[ts-demo-importer-team-video]</strong></li><li><strong>[ts-demo-importer-team-block]</strong></li><li><strong>[ts-demo-importer-team-block]</strong></li><li><strong>[ts-demo-importer-team-block]</strong></li><li><strong>[ts-demo-importer-single-team]</strong></li><li><strong>[ts-demo-importer-our-projects-tab]</strong></li><li><strong>[ts-demo-importer-hiring-features]</strong></li><li><strong>[ts-demo-importer-hiring-roles]</strong></li><li><strong>[ts-demo-importer-hiring-contact]</strong></li><li><strong>[ts-demo-importer-latest-news]</strong></li></ul>','ts-demo-importer' ),
           'section' => 'ts_demo_importer_shortcode_section'
       )
   ));


//  =============== ts-conference schedule conference ==============
if ( $template == 'ts-conference' ) {
  //  ts-conference-about-us section
  $wp_customize->add_section('ts_demo_importer_conferernce_schedule_sec',array(
    'title' => __('Schedule Conference','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_about_us_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));


  $schedule_conference = array(
      'ts_demo_importer_conferernce_schedule_enabledisable',
      'ts_demo_importer_conferernce_schedule_bg_settings',
      'ts_demo_importer_conferernce_schedule_background_color',
      'ts_demo_importer_conferernce_schedule_bgimage',
      'ts_demo_importer_conferernce_schedule_bgimage_att',
      'ts_demo_importer_conferernce_schedule_content_settings',
      'ts_demo_importer_conferernce_schedule_small_heading',
      'ts_demo_importer_conferernce_schedule_main_heading',
      'ts_demo_importer_conferernce_schedule_propogenda_no',
  );

  $propogenda_number = get_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_no');
  for ($i=1; $i <=$propogenda_number ; $i++) {
    $propogenda_settings = 'ts_demo_importer_conferernce_schedule_propogenda_settings'.$i;
    $propogenda_time = 'ts_demo_importer_conferernce_schedule_propogenda_time'.$i;
    $propogenda_heading = 'ts_demo_importer_conferernce_schedule_propogenda_heading'.$i;
    array_push( $schedule_conference, $propogenda_settings, $propogenda_time, $propogenda_heading );
  }


  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_about_us_tab_settings', array(
      'section' => 'ts_demo_importer_conferernce_schedule_sec',
      'buttons' => array(

          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => $schedule_conference,
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_conferernce_schedule_small_heading_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_small_heading_color',
                  'ts_demo_importer_conferernce_schedule_small_heading_font_family',
                  'ts_demo_importer_conferernce_schedule_small_heading_font_size',
                  'ts_demo_importer_conferernce_schedule_main_heading_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_main_heading_color',
                  'ts_demo_importer_conferernce_schedule_main_heading_font_family',
                  'ts_demo_importer_conferernce_schedule_main_heading_font_size',
                  'ts_demo_importer_conferernce_schedule_title_bg_settings',
                  'ts_demo_importer_conferernce_schedule_bgcolor',
                  'ts_demo_importer_conferernce_schedule_post_title_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_post_title_color',
                  'ts_demo_importer_conferernce_schedule_post_title_font_family',
                  'ts_demo_importer_conferernce_schedule_post_title_font_size',
                  'ts_demo_importer_conferernce_schedule_post_meta_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_post_meta_color',
                  'ts_demo_importer_conferernce_schedule_post_meta_font_family',
                  'ts_demo_importer_conferernce_schedule_post_meta_font_size',
                  'ts_demo_importer_conferernce_schedule_propogenda_time_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_propogenda_time_color',
                  'ts_demo_importer_conferernce_schedule_propogenda_time_font_family',
                  'ts_demo_importer_conferernce_schedule_propogenda_time_font_size',
                  'ts_demo_importer_conferernce_schedule_propogenda_heading_ct_pallete',
                  'ts_demo_importer_conferernce_schedule_propogenda_heading_color',
                  'ts_demo_importer_conferernce_schedule_propogenda_heading_font_family',
                  'ts_demo_importer_conferernce_schedule_propogenda_heading_font_size',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_about_us_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_about_us_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_conferernce_schedule_sec',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));
  $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_about_us_enable', array(
    'selector' => '#about-us .container',
    'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_about_us_enable',
  ));


  if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
          TSDemoImporterAddon::load_advance_training_academy_counter_section_setting($wp_customize,$font_array);
  }else{
      $wp_customize->add_setting('ts_demo_importer_about_us_enable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_about_us_enable0', array(
        'section' => 'ts_demo_importer_conferernce_schedule_sec',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
}

if ( $template == 'ts-conference' ) {
  //  ts-conference-about-us section
  $wp_customize->add_section('ts_demo_importer_footer_newsletter_sec',array(
    'title' => __('Footer Newsletter','ts-demo-importer'),
    'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting('ts_demo_importer_footer_newsletter_tab_settings', array(
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_footer_newsletter_tab_settings', array(
      'section' => 'ts_demo_importer_footer_newsletter_sec',
      'buttons' => array(

          array(
              'name' => esc_html__('Content', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-welcome-write-blog',
              'fields' => array(
                'ts_demo_importer_footer_newsletter_enable',
                'ts_demo_importer_footer_newsletter_bgcolor',
                'ts_demo_importer_footer_newsletter_bgimage',
                'ts_demo_importer_footer_newsletter_bgimage_attachment',
                'ts_demo_importer_footer_newsletter_paragraph',
                'ts_demo_importer_footer_newsletter_heading',
                'ts_demo_importer_footer_newsletter_form_shortcode',
               ),
          ),
          array(
              'name' => esc_html__('Style', 'ts-demo-importer'),
              'icon' => 'dashicons dashicons-art',
              'fields' => array(
                  'ts_demo_importer_footer_newsletter_paragraph_ct_pallete',
                  'ts_demo_importer_footer_newsletter_paragraph_color',
                  'ts_demo_importer_footer_newsletter_paragraph_font_family',
                  'ts_demo_importer_footer_newsletter_paragraph_font_size',
                  'ts_demo_importer_footer_newsletter_heading_ct_pallete',
                  'ts_demo_importer_footer_newsletter_heading_color',
                  'ts_demo_importer_footer_newsletter_heading_font_family',
                  'ts_demo_importer_footer_newsletter_heading_font_size',
                  'ts_demo_importer_footer_newsletter_form_settings',
                  'ts_demo_importer_footer_newsletter_input_bgcolor',
                  'ts_demo_importer_footer_newsletter_input_placeholder_color',
                  'ts_demo_importer_footer_newsletter_input_placeholder_font_family',
                  'ts_demo_importer_footer_newsletter_input_placeholder_font_size',
                  'ts_demo_importer_footer_newsletter_summit_btn_ct_pallete',
                  'ts_demo_importer_footer_newsletter_summit_btn_color',
                  'ts_demo_importer_footer_newsletter_summit_btn_font_size',
              ),
          )
      ),
  )));

  $wp_customize->add_setting('ts_demo_importer_footer_newsletter_enable',
      array(
    'default' => 'Enable',
    'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
  ));
  $wp_customize->add_control('ts_demo_importer_footer_newsletter_enable',
    array(
    'type' => 'radio',
    'label' => __('Do you want this section', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_footer_newsletter_sec',
    'choices' => array(
    'Enable' => __('Enable', 'ts-demo-importer'),
    'Disable' => __('Disable', 'ts-demo-importer')
  )));
  $wp_customize->selective_refresh->add_partial( 'ts_demo_importer_footer_newsletter_enable', array(
    'selector' => '#newsletter .container',
    'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_footer_newsletter_enable',
  ));


  if(class_exists('TSDemoImporterAddon') && is_plugin_active( 'ts-demo-importer-addon/index.php')){
          TSDemoImporterAddon::load_advance_training_academy_counter_section_setting($wp_customize,$font_array);
  }else{
      $wp_customize->add_setting('ts_demo_importer_footer_newsletter_enable0',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new TS_Button_Custom_Content( $wp_customize, 'ts_demo_importer_footer_newsletter_enable0', array(
        'section' => 'ts_demo_importer_footer_newsletter_sec',
        'label' => __( 'Buy Premium Plugin', 'ts-demo-importer' ),
        'description' => __( 'Buy our premium plugin to get more settings.', 'ts-demo-importer' ),
        'content' => sprintf( __( ' %1$sBuy Now%2$s', 'ts-demo-importer' ),
        '<a href="' . esc_url( TS_buy_now_url) . '" class="button button-secondary" target="_blank">',
        '</a>'
      ),
    )));
  }
}
