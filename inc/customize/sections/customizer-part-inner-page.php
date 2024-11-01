<?php
	 if( $template != 'advance-training-academy' ){
	//--------------------------- About Us Page ----------------------

	$wp_customize->add_section('ts_demo_importer_about_us_inner_page', array(
	  'title' => __('About Us Page ', 'ts-demo-importer'),
	  'priority' => null,
	  'panel' => 'ts_demo_importer_panel_id'
	));

	$wp_customize->add_setting('ts_demo_importer_shortcodes_number', array(
	  'default' => '5',
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ts_demo_importer_shortcodes_number', array(
	  'label' => __('Number of shortcode fields', 'ts-demo-importer'),
	  'section' => 'ts_demo_importer_about_us_inner_page',
	  'setting' => 'ts_demo_importer_shortcodes_number',
	  'type' => 'number'
	));

	$shortcode_count = get_theme_mod('ts_demo_importer_shortcodes_number', 5);

	for ($i = 1; $i <= $shortcode_count; $i++) {
		$wp_customize->add_setting('ts_demo_importer_about_us_inner_page_shortcode' . $i, array(
		  'default' => '',
		  'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_about_us_inner_page_shortcode' . $i, array(
		  'label' => __('Shortcode', 'ts-demo-importer') . $i,
		  'section' => 'ts_demo_importer_about_us_inner_page',
		  'setting' => 'ts_demo_importer_about_us_inner_page_shortcode' . $i,
		  'type' => 'text'
		));
	}

  //--------------------------- Team Page ----------------------

  $wp_customize->add_section('ts_demo_importer_team_inner_page', array(
    'title' => __('Team Page', 'ts-demo-importer'),
    'priority' => null,
    'panel' => 'ts_demo_importer_panel_id'
  ));

  $wp_customize->add_setting('ts_demo_importer_shortcodes_team_number', array(
    'default' => '5',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_shortcodes_team_number', array(
    'label' => __('Number of shortcode fields', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_team_inner_page',
    'setting' => 'ts_demo_importer_shortcodes_team_number',
    'type' => 'number'
  ));

  $shortcode_count = get_theme_mod('ts_demo_importer_shortcodes_number', 5);

  for ($i = 1; $i <= $shortcode_count; $i++) {
    $wp_customize->add_setting('ts_demo_importer_team_inner_page_shortcode' . $i, array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_team_inner_page_shortcode' . $i, array(
      'label' => __('Shortcode', 'ts-demo-importer') . $i,
      'section' => 'ts_demo_importer_team_inner_page',
      'setting' => 'ts_demo_importer_team_inner_page_shortcode' . $i,
      'type' => 'text'
    ));
  }

	//--------------------------- Project Inner Page ----------------------

  $wp_customize->add_section('ts_demo_importer_project_inner_page', array(
    'title' => __('Project Page', 'ts-demo-importer'),
    'priority' => null,
    'panel' => 'ts_demo_importer_panel_id'
  ));

	$wp_customize->add_setting('ts_demo_importer_project_shortcodes_number', array(
	  'default' => '2',
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ts_demo_importer_project_shortcodes_number', array(
	  'label' => __('Number of shortcode fields', 'ts-demo-importer'),
	  'section' => 'ts_demo_importer_project_inner_page',
	  'setting' => 'ts_demo_importer_project_shortcodes_number',
	  'type' => 'number'
	));

	$project_shortcode_count = get_theme_mod('ts_demo_importer_project_shortcodes_number', 2);

	for ($i = 1; $i <= $project_shortcode_count; $i++) {
		$wp_customize->add_setting('ts_demo_importer_project_inner_page_shortcode' . $i, array(
		  'default' => '',
		  'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_project_inner_page_shortcode' . $i, array(
		  'label' => __('Shortcode', 'ts-demo-importer') . $i,
		  'section' => 'ts_demo_importer_project_inner_page',
		  'setting' => 'ts_demo_importer_project_inner_page_shortcode' . $i,
		  'type' => 'text'
		));
	}

  //--------------------------- Hiring Inner Page ----------------------

  $wp_customize->add_section('ts_demo_importer_hiring_inner_page', array(
    'title' => __('Hiring Page', 'ts-demo-importer'),
    'priority' => null,
    'panel' => 'ts_demo_importer_panel_id'
  ));

  $wp_customize->add_setting('ts_demo_importer_hiring_shortcodes_number', array(
    'default' => '2',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_hiring_shortcodes_number', array(
    'label' => __('Number of shortcode fields', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_hiring_inner_page',
    'setting' => 'ts_demo_importer_hiring_shortcodes_number',
    'type' => 'number'
  ));

  $hiring_shortcode_count = get_theme_mod('ts_demo_importer_hiring_shortcodes_number', 3);

  for ($i = 1; $i <= $hiring_shortcode_count; $i++) {
    $wp_customize->add_setting('ts_demo_importer_hiring_inner_page_shortcode' . $i, array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_hiring_inner_page_shortcode' . $i, array(
      'label' => __('Shortcode', 'ts-demo-importer') . $i,
      'section' => 'ts_demo_importer_hiring_inner_page',
      'setting' => 'ts_demo_importer_hiring_inner_page_shortcode' . $i,
      'type' => 'text'
    ));
  }
}
  //--------------------------- Blog Page ----------------------

  $wp_customize->add_section('ts_demo_importer_blog_page_page', array(
    'title' => __('Blog Page', 'ts-demo-importer'),
    'priority' => null,
    'panel' => 'ts_demo_importer_panel_id'
  ));

  $wp_customize->add_setting('ts_demo_importer_blog_page_number', array(
    'default' => '2',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ts_demo_importer_blog_page_number', array(
    'label' => __('Number of shortcode fields', 'ts-demo-importer'),
    'section' => 'ts_demo_importer_blog_page_page',
    'setting' => 'ts_demo_importer_blog_page_number',
    'type' => 'number'
  ));

  $blog_page_shortcode_count = get_theme_mod('ts_demo_importer_blog_page_number', 2);

  for ($i = 1; $i <= $blog_page_shortcode_count; $i++) {
    $wp_customize->add_setting('ts_demo_importer_blog_page_inner_page_shortcode' . $i, array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ts_demo_importer_blog_page_inner_page_shortcode' . $i, array(
      'label' => __('Shortcode', 'ts-demo-importer') . $i,
      'section' => 'ts_demo_importer_blog_page_page',
      'setting' => 'ts_demo_importer_blog_page_inner_page_shortcode' . $i,
      'type' => 'text'
    ));
  }
