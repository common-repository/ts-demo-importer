<?php

  $template = wp_get_theme()->get( 'TextDomain' );

  $wp_customize->add_section('ts_demo_importer_section_ordering_settings',array(
      'title' => __('Section Ordering','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
  ));

  $wp_customize->add_setting( 'ts_demo_importer_section_ordering_settings_repeater',
      array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control( new ts_demo_importer_Repeater_Custom_Control( $wp_customize, 'ts_demo_importer_section_ordering_settings_repeater',
      array(
        'label' => __( 'Section Reordering','ts-demo-importer' ),
        'description' => __( 'When you change the orders of section overlapping may happen to fix this use padding option present in each section','ts-demo-importer' ),
        'section' => 'ts_demo_importer_section_ordering_settings',
        'button_labels' => array(
          'add' => __( 'Add Row','ts-demo-importer' ),
      )
    )
  ));

  // ============== Section Padding Top =================
if( $template == 'multi-advance' ){
  $wp_customize->add_setting( 'ts_demo_importer_padding_top_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_padding_top_settings',
    array(
    'label' => __('Section Padding Top Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_section_ordering_settings'
  )));
  // Our Records Padding Top
  $wp_customize->add_setting('ts_demo_importer_our_records_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_our_records_padding_top',array(
      'label' => __('Our Records Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_our_records_padding_top',
      'type'  => 'number'
  ));
  // About Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_about_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_about_us_padding_top',array(
      'label' => __('About Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_about_us_padding_top',
      'type'  => 'number'
  ));
  // Our Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_our_skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_padding_top',array(
      'label' => __('Our Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_our_skills_padding_top',
      'type'  => 'number'
  ));
  // What We do Padding Top
  $wp_customize->add_setting('ts_demo_importer_what_We_do_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_what_We_do_padding_top',array(
      'label' => __('What We do Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_what_We_do_padding_top',
      'type'  => 'number'
  ));
  // Business Process Padding Top
  $wp_customize->add_setting('ts_demo_importer_business_process_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_business_process_padding_top',array(
      'label' => __('Business Process Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_business_process_padding_top',
      'type'  => 'number'
  ));
  // Recent Projects Padding Top
  $wp_customize->add_setting('ts_demo_importer_recent_projects_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_recent_projects_padding_top',array(
      'label' => __('Recent Projects Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_recent_projects_padding_top',
      'type'  => 'number'
  ));
  // Business Features Padding Top
  $wp_customize->add_setting('ts_demo_importer_business_features_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_business_features_padding_top',array(
      'label' => __('Business Features Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_business_features_padding_top',
      'type'  => 'number'
  ));
  // Team Padding Top
  $wp_customize->add_setting('ts_demo_importer_team_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_team_padding_top',array(
      'label' => __('Team Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_team_padding_top',
      'type'  => 'number'
  ));
  // Hire Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_hire_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_hire_us_padding_top',array(
      'label' => __('Hire Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_hire_us_padding_top',
      'type'  => 'number'
  ));
  // Pricing Plans Padding Top
  $wp_customize->add_setting('ts_demo_importer_pricing_plans_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_pricing_plans_padding_top',array(
      'label' => __('Pricing Plans Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_pricing_plans_padding_top',
      'type'  => 'number'
  ));
  // Dedicated to your Business Padding Top
  $wp_customize->add_setting('ts_demo_importer_quote_banner_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_quote_banner_padding_top',array(
      'label' => __('Dedicated to your Business Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_quote_banner_padding_top',
      'type'  => 'number'
  ));
  // Consult Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_consult_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_consult_us_padding_top',array(
      'label' => __('Consult Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_consult_us_padding_top',
      'type'  => 'number'
  ));
  // Additional Services Padding Top
  $wp_customize->add_setting('ts_demo_importer_additional_services_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_additional_services_padding_top',array(
      'label' => __('Additional Services Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_additional_services_padding_top',
      'type'  => 'number'
  ));
  // Testimonials Padding Top
  $wp_customize->add_setting('ts_demo_importer_testimonials_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_testimonials_padding_top',array(
      'label' => __('Testimonials Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_testimonials_padding_top',
      'type'  => 'number'
  ));
  // Brands Padding Top
  $wp_customize->add_setting('ts_demo_importer_Brands_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Brands_padding_top',array(
      'label' => __('Brands Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Brands_padding_top',
      'type'  => 'number'
  ));
  // Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_Skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Skills_padding_top',array(
      'label' => __('Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Skills_padding_top',
      'type'  => 'number'
  ));
  // Blogs Padding Top
  $wp_customize->add_setting('ts_demo_importer_Blogs_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Blogs_padding_top',array(
      'label' => __('Blogs Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Blogs_padding_top',
      'type'  => 'number'
  ));
  // Contact Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_contact_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_contact_us_padding_top',array(
      'label' => __('Contact Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_contact_us_padding_top',
      'type'  => 'number'
  ));

} elseif ( $template == 'advance-marketing-agency' ) {
  $wp_customize->add_setting( 'ts_demo_importer_padding_top_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_padding_top_settings',
    array(
    'label' => __('Section Padding Top Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_section_ordering_settings'
  )));
  // About Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_about_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_about_us_padding_top',array(
      'label' => __('About Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_about_us_padding_top',
      'type'  => 'number'
  ));
  // Our Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_our_skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_padding_top',array(
      'label' => __('Our Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_our_skills_padding_top',
      'type'  => 'number'
  ));
  // What We do Padding Top
  $wp_customize->add_setting('ts_demo_importer_what_We_do_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_what_We_do_padding_top',array(
      'label' => __('What We do Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_what_We_do_padding_top',
      'type'  => 'number'
  ));
  // Business Process Padding Top
  $wp_customize->add_setting('ts_demo_importer_business_process_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_business_process_padding_top',array(
      'label' => __('Business Process Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_business_process_padding_top',
      'type'  => 'number'
  ));
  // Recent Projects Padding Top
  $wp_customize->add_setting('ts_demo_importer_recent_projects_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_recent_projects_padding_top',array(
      'label' => __('Recent Projects Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_recent_projects_padding_top',
      'type'  => 'number'
  ));
  // Personalized support Padding Top
  $wp_customize->add_setting('ts_demo_importer_personalized_support_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_personalized_support_padding_top',array(
      'label' => __('Personalized support Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_personalized_support_padding_top',
      'type'  => 'number'
  ));
  // Video Padding Top
  $wp_customize->add_setting('ts_demo_importer_Video_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Video_padding_top',array(
      'label' => __('Video Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Video_padding_top',
      'type'  => 'number'
  ));
  // Brands Padding Top
  $wp_customize->add_setting('ts_demo_importer_Brands_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Brands_padding_top',array(
      'label' => __('Brands Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Brands_padding_top',
      'type'  => 'number'
  ));
  // Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_Skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Skills_padding_top',array(
      'label' => __('Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Skills_padding_top',
      'type'  => 'number'
  ));
  // Our Upcoming Events Padding Top
  $wp_customize->add_setting('ts_demo_importer_our_upcoming_events_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_our_upcoming_events_padding_top',array(
      'label' => __('Our Upcoming Events Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_our_upcoming_events_padding_top',
      'type'  => 'number'
  ));
  // Blogs Padding Top
  $wp_customize->add_setting('ts_demo_importer_Blogs_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Blogs_padding_top',array(
      'label' => __('Blogs Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Blogs_padding_top',
      'type'  => 'number'
  ));
  // Contact Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_contact_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_contact_us_padding_top',array(
      'label' => __('Contact Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_contact_us_padding_top',
      'type'  => 'number'
  ));
} elseif ( $template == 'advance-consultancy' ) {
  $wp_customize->add_setting( 'ts_demo_importer_padding_top_settings',
    array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  ));
  $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_padding_top_settings',
    array(
    'label' => __('Section Padding Top Settings','ts-demo-importer'),
    'section' => 'ts_demo_importer_section_ordering_settings'
  )));
  // About Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_about_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_about_us_padding_top',array(
      'label' => __('About Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_about_us_padding_top',
      'type'  => 'number'
  ));

  // Our Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_our_skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_our_skills_padding_top',array(
      'label' => __('Our Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_our_skills_padding_top',
      'type'  => 'number'
  ));
  // What We do Padding Top
  $wp_customize->add_setting('ts_demo_importer_what_We_do_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_what_We_do_padding_top',array(
      'label' => __('What We do Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_what_We_do_padding_top',
      'type'  => 'number'
  ));
  // Business Process Padding Top
  $wp_customize->add_setting('ts_demo_importer_business_process_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_business_process_padding_top',array(
      'label' => __('Business Process Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_business_process_padding_top',
      'type'  => 'number'
  ));
  // Recent Projects Padding Top
  $wp_customize->add_setting('ts_demo_importer_recent_projects_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_recent_projects_padding_top',array(
      'label' => __('Recent Projects Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_recent_projects_padding_top',
      'type'  => 'number'
  ));
  // Personalized support Padding Top
  $wp_customize->add_setting('ts_demo_importer_personalized_support_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_personalized_support_padding_top',array(
      'label' => __('Our Records Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_personalized_support_padding_top',
      'type'  => 'number'
  ));
  // Video Padding Top
  $wp_customize->add_setting('ts_demo_importer_Video_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Video_padding_top',array(
      'label' => __('Video Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Video_padding_top',
      'type'  => 'number'
  ));
  // Brands Padding Top
  $wp_customize->add_setting('ts_demo_importer_Brands_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Brands_padding_top',array(
      'label' => __('Brands Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Brands_padding_top',
      'type'  => 'number'
  ));
  // Skills Padding Top
  $wp_customize->add_setting('ts_demo_importer_Skills_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Skills_padding_top',array(
      'label' => __('Skills Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Skills_padding_top',
      'type'  => 'number'
  ));
  // Pricing Plans Padding Top
  $wp_customize->add_setting('ts_demo_importer_pricing_plans_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_pricing_plans_padding_top',array(
      'label' => __('Pricing Plans Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_pricing_plans_padding_top',
      'type'  => 'number'
  ));
  // Testimonials Padding Top
  $wp_customize->add_setting('ts_demo_importer_testimonials_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_testimonials_padding_top',array(
      'label' => __('Testimonials Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_testimonials_padding_top',
      'type'  => 'number'
  ));
  // Contact Us Padding Top
  $wp_customize->add_setting('ts_demo_importer_contact_us_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_contact_us_padding_top',array(
      'label' => __('Contact Us Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_contact_us_padding_top',
      'type'  => 'number'
  ));
  // Blogs Padding Top
  $wp_customize->add_setting('ts_demo_importer_Blogs_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_Blogs_padding_top',array(
      'label' => __('Blogs Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_Blogs_padding_top',
      'type'  => 'number'
  ));
  // Interested Padding Top
  $wp_customize->add_setting('ts_demo_importer_interested_banner_padding_top',array(
    'default'   => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('ts_demo_importer_interested_banner_padding_top',array(
      'label' => __('Interested Padding Top','ts-demo-importer'),
      'description' => __('Add Padding Top in Pixels','ts-demo-importer'),
      'section' => 'ts_demo_importer_section_ordering_settings',
      'setting'   => 'ts_demo_importer_interested_banner_padding_top',
      'type'  => 'number'
  ));

}

  //General Color Pallete
    $wp_customize->add_section('ts_demo_importer_color_pallette',array(
      'title' => __('Typography / General settings','ts-demo-importer'),
      'panel' => 'ts_demo_importer_panel_id',
    ));

    $wp_customize->add_setting('ts_demo_importer_radio_boxed_full_layout_value',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('ts_demo_importer_radio_boxed_full_layout_value',array(
      'label' => __('Add Boxed layout Width Here','ts-demo-importer'),
      'description' => __('Boxed width is always set more than 1140px.','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_radio_boxed_full_layout_value',
      'type'    => 'number',
      'active_callback' => 'ts_demo_importer_page_boxed_layout'
      )
    );

    $wp_customize->add_setting( 'ts_demo_importer_body_typography_ct_pallete',
      array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_body_typography_ct_pallete',
      array(
      'label' => __('Body Typography ','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting('ts_demo_importer_body_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_body_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));

    $wp_customize->add_setting('ts_demo_importer_body_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('ts_demo_importer_body_font_size',array(
        'label' => __('Body Font Size in px','ts-demo-importer'),
        'section' => 'ts_demo_importer_color_pallette',
        'setting' => 'ts_demo_importer_body_font_size',
        'type'    => 'number'
      )
    );

    $wp_customize->add_setting( 'ts_demo_importer_body_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_body_color', array(
      'label' => __('Body Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_body_color',
    )));

    $wp_customize->add_setting( 'ts_demo_importer_color_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_color_pallette_settings',
      array(
      'label' => __('Global Color Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));
    $wp_customize->add_setting( 'ts_demo_importer_global_color_one', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_global_color_one', array(
      'label' => __('Primary', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_global_color_one',
    )));
    $wp_customize->add_setting( 'ts_demo_importer_global_color_two', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_global_color_two', array(
      'label' => __('Secondary', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_global_color_two',
    )));
    // -----------H1 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h1_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h1_pallette_settings',
      array(
      'label' => __('H1 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h1_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h1_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h1_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h1_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h1_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h1_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h1_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h1_font_size',
      'type'    => 'number'
    ));

    // -----------H2 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h2_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h2_pallette_settings',
      array(
      'label' => __('H2 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h2_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h2_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h2_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h2_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h2_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h2_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h2_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h2_font_size',
      'type'    => 'number'
    ));

    // -----------H3 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h3_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h3_pallette_settings',
      array(
      'label' => __('H3 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h3_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h3_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h3_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h3_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h3_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h3_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h3_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h3_font_size',
      'type'    => 'number'
    ));

    // -----------H4 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h4_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h4_pallette_settings',
      array(
      'label' => __('H4 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h4_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h4_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h4_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h4_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h4_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h4_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h4_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h4_font_size',
      'type'    => 'number'
    ));

    // -----------H5 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h5_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h5_pallette_settings',
      array(
      'label' => __('H5 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h5_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h5_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h5_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h5_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h5_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h5_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h5_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h5_font_size',
      'type'    => 'number'
    ));

    // -----------H6 Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_h6_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_h6_pallette_settings',
      array(
      'label' => __('H6 Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_h6_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_h6_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_h6_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_h6_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_h6_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_h6_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_h6_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_h6_font_size',
      'type'    => 'number'
    ));

    // -----------Paragraph Typography ---------------------------------
    $wp_customize->add_setting( 'ts_demo_importer_paragraph_pallette_settings',
      array(
      'default' => '',
      'transport' => 'postMessage',
      'sanitize_callback' => 'ts_demo_importer_text_sanitization'
    ));
    $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_paragraph_pallette_settings',
      array(
      'label' => __('Paragraph Typography Settings','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette'
    )));

    $wp_customize->add_setting( 'ts_demo_importer_paragraph_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_paragraph_color', array(
      'label' => __('Color', 'ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'settings' => 'ts_demo_importer_paragraph_color',
    )));
    $wp_customize->add_setting('ts_demo_importer_paragraph_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(
      'ts_demo_importer_paragraph_font_family', array(
      'section'  => 'ts_demo_importer_color_pallette',
      'label'    => __('Font Family','ts-demo-importer'),
      'type'     => 'select',
      'choices'  => $font_array,
    ));
    $wp_customize->add_setting('ts_demo_importer_paragraph_font_size',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_paragraph_font_size',array(
      'label' => __('Font Size','ts-demo-importer'),
      'description' => __('Add font size in px','ts-demo-importer'),
      'section' => 'ts_demo_importer_color_pallette',
      'setting' => 'ts_demo_importer_paragraph_font_size',
      'type'    => 'number'
    ));



  // //=============General Color Pallete======================
  // $wp_customize->add_section('ts_demo_importer_color_pallette',array(
  //   'title' => __('Typography / General settings','ts-demo-importer'),
  //   'panel' => 'ts_demo_importer_panel_id',
  // ));
  //
  // $wp_customize->add_setting('ts_demo_importer_radio_boxed_full_layout_value',array(
  //   'default' => '',
  //   'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );
  // $wp_customize->add_control('ts_demo_importer_radio_boxed_full_layout_value',array(
  //   'label' => __('Add Boxed layout Width Here','ts-demo-importer'),
  //   'description' => __('Boxed width is always set more than 1140px.','ts-demo-importer'),
  //   'section' => 'ts_demo_importer_color_pallette',
  //   'setting' => 'ts_demo_importer_radio_boxed_full_layout_value',
  //   'type'    => 'number',
  //   'active_callback' => 'ts_demo_importer_page_boxed_layout'
  //   )
  // );
  //
  // $wp_customize->add_setting( 'ts_demo_importer_body_typography_ct_pallete',
  //   array(
  //     'default' => '',
  //     'transport' => 'postMessage',
  //     'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  // ));
  // $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_body_typography_ct_pallete',
  //   array(
  //   'label' => __('Body Typography ','ts-demo-importer'),
  //   'section' => 'ts_demo_importer_color_pallette'
  // )));
  //
  // $wp_customize->add_setting('ts_demo_importer_body_font_family',array(
  //   'default' => '',
  //   'capability' => 'edit_theme_options',
  //   'sanitize_callback' => 'sanitize_text_field'
  // ));
  // $wp_customize->add_control(
  //   'ts_demo_importer_body_font_family', array(
  //   'section'  => 'ts_demo_importer_color_pallette',
  //   'label'    => __('Font Family','ts-demo-importer'),
  //   'type'     => 'select',
  //   'choices'  => $font_array,
  // ));
  //
  // $wp_customize->add_setting('ts_demo_importer_body_font_size',array(
  //     'default' => '',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );
  // $wp_customize->add_control('ts_demo_importer_body_font_size',array(
  //     'label' => __('Body Font Size in px','ts-demo-importer'),
  //     'section' => 'ts_demo_importer_color_pallette',
  //     'setting' => 'ts_demo_importer_body_font_size',
  //     'type'    => 'number'
  //   )
  // );
  //
  // $wp_customize->add_setting( 'ts_demo_importer_body_color', array(
  //   'default' => '',
  //   'sanitize_callback' => 'sanitize_hex_color'
  // ));
  // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_body_color', array(
  //   'label' => __('Body Color', 'ts-demo-importer'),
  //   'section' => 'ts_demo_importer_color_pallette',
  //   'settings' => 'ts_demo_importer_body_color',
  // )));
  //
  //
  // $wp_customize->add_setting( 'ts_demo_importer_color_pallette_settings',
  //   array(
  //   'default' => '',
  //   'transport' => 'postMessage',
  //   'sanitize_callback' => 'ts_demo_importer_text_sanitization'
  // ));
  // $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_color_pallette_settings',
  //   array(
  //   'label' => __('Global Color Settings','ts-demo-importer'),
  //   'section' => 'ts_demo_importer_color_pallette'
  // )));
  // $wp_customize->add_setting( 'ts_demo_importer_global_color_one', array(
  //   'default' => '#3398ff',
  //   'sanitize_callback' => 'sanitize_hex_color'
  // ));
  // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_global_color_one', array(
  //   'label' => __('Primary', 'ts-demo-importer'),
  //   'section' => 'ts_demo_importer_color_pallette',
  //   'settings' => 'ts_demo_importer_global_color_one',
  // )));
