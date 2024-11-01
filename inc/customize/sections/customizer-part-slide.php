<?php

$ts_demo_importer_license_key = get_option( str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key' );

$template = wp_get_theme()->get( 'TextDomain' );

	if (  $template == 'multi-advance'  ) {
		$wp_customize->add_section('ts_demo_importer_slider_section',array(
			'title'	=> __('Slider Settings','ts-demo-importer'),
			'priority'	=> null,
			'panel' => 'ts_demo_importer_panel_id',
		));


		$number = get_theme_mod('ts_demo_importer_slide_number');

		$ts_demo_importer_slider_section_settings = array();
		$ts_demo_importer_slide_background_type = array();
		$ts_demo_importer_slide_vide_link = array();
		$ts_demo_importer_slide_background_color_one = array();
		$ts_demo_importer_slide_background_color_two = array();
		$ts_demo_importer_slide_height = array();
		$ts_demo_importer_slide_image = array();
		$ts_demo_importer_slide_image_alt_text = array();
		$ts_demo_importer_slide_small_heading = array();
		$ts_demo_importer_slide_heading = array();
		$ts_demo_importer_slide_text = array();
		$ts_demo_importer_slide_btn_one_text = array();
		$ts_demo_importer_slide_btn_one_url = array();
		$ts_demo_importer_slide_btn_one_icon = array();

		for($i=1; $i<=$number ;$i++){
			$ts_demo_importer_slider_section_settings[$i] = 'ts_demo_importer_slider_section_settings'.$i;
			$ts_demo_importer_slide_background_type[$i] = 'ts_demo_importer_slide_background_type'.$i;
			$ts_demo_importer_slide_vide_link[$i] = 'ts_demo_importer_slide_vide_link'.$i;
			$ts_demo_importer_slide_background_color_one[$i] = 'ts_demo_importer_slide_background_color_one'.$i;
			$ts_demo_importer_slide_background_color_two[$i] = 'ts_demo_importer_slide_background_color_two'.$i;
			$ts_demo_importer_slide_height[$i] = 'ts_demo_importer_slide_height'.$i;

			$ts_demo_importer_slide_image[$i] = 'ts_demo_importer_slide_image'.$i;
			$ts_demo_importer_slide_image_alt_text[$i] = 'ts_demo_importer_slide_image_alt_text'.$i;
			$ts_demo_importer_slide_small_heading[$i] = 'ts_demo_importer_slide_small_heading'.$i;
			$ts_demo_importer_slide_heading[$i] = 'ts_demo_importer_slide_heading'.$i;
			$ts_demo_importer_slide_text[$i] = 'ts_demo_importer_slide_text'.$i;
			$ts_demo_importer_slide_btn_one_text[$i] = 'ts_demo_importer_slide_btn_one_text'.$i;
			$ts_demo_importer_slide_btn_one_url[$i] = 'ts_demo_importer_slide_btn_one_url'.$i;
			$ts_demo_importer_slide_btn_one_icon[$i] = 'ts_demo_importer_slide_btn_one_icon'.$i;
		}

		$arr1 = array(
										'ts_demo_importer_slider_enabledisable',
										'ts_demo_importer_slide_number',
										'ts_demo_importer_slide_delay',
										'ts_demo_importer_slide_remove_fade',
										'ts_demo_importer_slider_section_content_option',
										'ts_demo_importer_our_records_content_settings',
										'ts_demo_importer_slide_overlay',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_our_records_carousel_loop',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_slider_arrows',
										'ts_demo_importer_slider_dots',
										'ts_demo_importer_slider_section_content_spacing',
										'ts_demo_importer_slider_section_slider_top_spacing',
										'ts_demo_importer_slider_section_slider_bottom_spacing',
										'ts_demo_importer_slider_section_slider_left_spacing',
										'ts_demo_importer_slider_section_slider_right_spacing');

		$arr_final = array_merge($arr1, $ts_demo_importer_slider_section_settings, $ts_demo_importer_slide_background_type, $ts_demo_importer_slide_vide_link, $ts_demo_importer_slide_background_color_one, $ts_demo_importer_slide_background_color_two, $ts_demo_importer_slide_height, $ts_demo_importer_slide_image, $ts_demo_importer_slide_image_alt_text, $ts_demo_importer_slide_small_heading, $ts_demo_importer_slide_heading, $ts_demo_importer_slide_text, $ts_demo_importer_slide_btn_one_text, $ts_demo_importer_slide_btn_one_url, $ts_demo_importer_slide_btn_one_icon);

		$wp_customize->add_setting('ts_demo_importer_slider_tab_settings', array(
				'sanitize_callback' => 'wp_kses_post',
		 ));

			$wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_slider_tab_settings', array(
				'section' => 'ts_demo_importer_slider_section',
				'buttons' => array(
						// array(
						//     'name' => esc_html__('Layout', 'ts-demo-importer'),
						//     'icon' => 'dashicons dashicons-layout',
						//     'fields' => array(
						//     ),
						//     'active' => true,
						// ),
						array(
								'name' => esc_html__('Content', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-welcome-write-blog',
								'fields' => $arr_final,

						),
						array(
								'name' => esc_html__('Style', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-art',
								'fields' => array(
										'ts_demo_importer_slide_content_color_settings',
										'ts_demo_importer_slider_small_heading_ct_pallete',
										'ts_demo_importer_slide_small_heading_color',
										'ts_demo_importer_slide_small_heading_font_family',
										'ts_demo_importer_slide_small_heading_font_size',
										'ts_demo_importer_slider_heading_ct_pallete',
										'ts_demo_importer_sliderHeading_color',
										'ts_demo_importer_sliderHeading_font_family',
										'ts_demo_importer_sliderHeading_font_size',
										'ts_demo_importer_slider_text_ct_pallete',
										'ts_demo_importer_slidertext_color',
										'ts_demo_importer_slidertext_font_family',
										'ts_demo_importer_slidertext_font_size',
										'ts_demo_importer_slider_button1_ct_pallete',
										'ts_demo_importer_slide_buttoncolor',
										'ts_demo_importer_button_fontfamily',
										'ts_demo_importer_button_font_size',
										'ts_demo_importer_slide_button_first_bgcolor_one',
										'ts_demo_importer_slide_button_first_bgcolor_one_hover',
										'ts_demo_importer_slide_buttoncolor_hover',
										'ts_demo_importer_slider_button2_ct_pallete',
										'ts_demo_importer_slide_button_twocolor',
										'ts_demo_importer_button_twofontfamily',
										'ts_demo_importer_button_twofont_size',
										'ts_demo_importer_slide_button_first_bgcolor_two',
										'ts_demo_importer_slide_button_first_bgcolor_two_hover',
										'ts_demo_importer_slide_button_twocolor_hover',
										'ts_demo_importer_slider_nav_ct_pallete',
										'ts_demo_importer_slide_nav_one_color',
										'ts_demo_importer_slide_nav_one',
										'ts_demo_importer_slide_nav_hover_bgcolor',
										'ts_demo_importer_slide_nav_hover_color'
								),
						)
				),
		)));

		$wp_customize->add_setting('ts_demo_importer_slider_enabledisable',array(
					'default'=> 'Enable',
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
		$wp_customize->add_control('ts_demo_importer_slider_enabledisable', array(
					'type' => 'radio',
					'label' => 'Do you want this section',
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Enable' => 'Enable',
							'Disable' => 'Disable'
					),
			));
			$wp_customize->selective_refresh->add_partial( 'ts_demo_importer_slider_enabledisable', array(
			'selector' => '.slider-box h2',
			'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_slider_enabledisable',
			) );
		$wp_customize->add_setting('ts_demo_importer_slide_number',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_number',array(
			'label'	=> __('Number of slides to show','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'type'		=> 'number'
		));
		$count =  get_theme_mod('ts_demo_importer_slide_number');
		for($i=1; $i<=$count; $i++) {

			$wp_customize->add_setting( 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'default' => '',
					'transport' => 'postMessage',
					'sanitize_callback' => 'ts_demo_importer_text_sanitization'
			 ));
			 $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'label' => __('Slider Settings ','ts-demo-importer').$i,
					'section' => 'ts_demo_importer_slider_section'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_type'. $i, array(
				'default' => 'slide_type_image',
				'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
			$wp_customize->add_control('ts_demo_importer_slide_background_type'. $i, array(
				'type' => 'radio',
				'label' => __('Slide Background Type ', 'ts-demo-importer'). $i,
				'section' => 'ts_demo_importer_slider_section',
				'choices' => array(
					'slide_type_image' => __('Image', 'ts-demo-importer'),
					'slide_type_video' => __('Video', 'ts-demo-importer'),
					'slide_type_gradient' => __('Gradient', 'ts-demo-importer')
				)
			));

			$wp_customize->add_setting('ts_demo_importer_slide_vide_link' . $i, array(
						'default' => '',
						'sanitize_callback' => 'sanitize_text_field'
				));
			$wp_customize->add_control('ts_demo_importer_slide_vide_link' . $i, array(
					'label' => __('Slide Video Embed Link', 'ts-demo-importer') . $i,
					'description' => __('For this option to enable first you have to select "Slide Background Type" as "Video". Note: Upload video in Media and add link here', 'ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'setting' => 'ts_demo_importer_slide_vide_link' . $i,
					'type' => 'url',
					'active_callback' => 'ts_demo_importer_slider_video'
			));

				$wp_customize->add_setting('ts_demo_importer_slide_background_color_one'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_one'. $i, array(
				'label' => __('Slider Background Color one', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_one'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'

			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_two'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_two'. $i, array(
				'label' => __('Slider Background Color two', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_two'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_height'. $i, array(
						'default' => __('600', 'ts-demo-importer'),
						'sanitize_callback' => 'sanitize_text_field'
				));
			$wp_customize->add_control('ts_demo_importer_slide_height'. $i, array(
					'label' => __('Slide Height', 'ts-demo-importer'). $i,
					'description' => __('This setting will only work for "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'setting' => 'ts_demo_importer_slide_height'. $i,
					'type' => 'number',
					'active_callback' => 'ts_demo_importer_slider_gradient'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_image'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_image'.$i,
						array(
							'label' => __('Slider Image ','ts-demo-importer'). $i,
							'description' => __('Dimension 1500px * 700px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
							'section' => 'ts_demo_importer_slider_section',
							'settings' => 'ts_demo_importer_slide_image'.$i,
							'active_callback' => 'ts_demo_importer_slider_type_image'
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_image_alt_text'.$i,array(
					'default' => '',
					'sanitize_callback' => 'sanitize_textarea_field',
				));
				$wp_customize->add_control('ts_demo_importer_slide_image_alt_text'.$i,array(
					'label' => __('Slider Image ALT Text ','ts-demo-importer').$i,
					'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'setting' => 'ts_demo_importer_slide_image_alt_text'.$i,
					'type' => 'text',
					'active_callback' => 'ts_demo_importer_slider_type_image'
				));
			$wp_customize->add_setting('ts_demo_importer_slide_small_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_small_heading'.$i,array(
				'label' => __('Slide Small Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_small_heading'.$i,
				'type'	=> 'text'
			));
			$wp_customize->add_setting('ts_demo_importer_slide_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_heading'.$i,array(
				'label' => __('Slide Main Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_text'.$i,array(
				'default'   => '',
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'wp_kses_post'
			));
			$wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_slide_text'.$i,array(
				'label' => __('Slide Text','ts-demo-importer').$i,
				'description' => __('Add Text','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'   => 'ts_demo_importer_slide_text'.$i,
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_text'.$i,array(
				'label' => __('Slider Button Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting(
				'ts_demo_importer_slide_btn_one_icon'.$i,
				array(
					'default'     => '',
					'sanitize_callback' => 'sanitize_text_field'
				)
			);
			$wp_customize->add_control(
				new ts_demo_importer_Fontawesome_Icon_Chooser(
					$wp_customize,
					'ts_demo_importer_slide_btn_one_icon'.$i,
					array(
						'settings'    => 'ts_demo_importer_slide_btn_one_icon'.$i,
						'section'   => 'ts_demo_importer_slider_section',
						'type'      => 'icon',
						'label'     => esc_html__( 'Choose Icon ', 'advance-one-page-pro' ),
					)
				)
			);

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_url'.$i,array(
				'label' => __('Slider Button Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_url'.$i,
				'type'	=> 'text'
			));

		}
		// Other Settings
		$wp_customize->add_setting('ts_demo_importer_slide_delay',array(
			'default'	=> '1000',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_delay',array(
			'label'	=> __('Slide Delay','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'ts-demo-importer'),
			'type'		=> 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_remove_fade',
			 array(
					'default' => 1,
					'transport' => 'refresh',
					'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			 )
			);
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slide_remove_fade',
				 array(
						'label' => esc_html__( 'Fade Effect', 'ts-demo-importer' ),
						'section' => 'ts_demo_importer_slider_section'
				 )
			));

		$wp_customize->add_setting('ts_demo_importer_slider_section_content_option',array(
					'default' => __('Left','ts-demo-importer'),
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_slider_section_content_option', array(
					'type' => 'select',
					'label' => __('Slider Content Layouts','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
							'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
							'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
			))));
		$wp_customize->add_setting('ts_demo_importer_slider_section_content_spacing',array(
			'sanitize_callback'	=> 'esc_html'
		));
		$wp_customize->add_control('ts_demo_importer_slider_section_content_spacing',array(
			'label'	=> esc_html__('Slider Content Spacing','ts-demo-importer'),
			'description'	=> __('Add value in percentage here.','ts-demo-importer'),
			'section'=> 'ts_demo_importer_slider_section',
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'label' => esc_html__( 'Top','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'label' => esc_html__( 'Bottom','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'label' => esc_html__( 'Left','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'label' => esc_html__('Right','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slide_overlay',
				 array(
						'default' => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
				 )
		);

		$wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_slide_overlay',
		 array(
				'label' => __( 'Slide Overlay','ts-demo-importer' ),
				'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section',
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

		$wp_customize->add_setting( 'ts_demo_importer_slide_content_color_settings',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_content_color_settings',
		array(
			'label' => __('Section Color & Typography','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_small_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_small_heading_ct_pallete',
		array(
			'label' => __('Slide Small Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

			$wp_customize->add_setting( 'ts_demo_importer_slide_small_heading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_small_heading_color', array(
			'label' => __('Slider Small Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_small_heading_color',
		)));
		//This is Slider Heading FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_slide_small_heading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slide_small_heading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Small Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slide_small_heading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slide_small_heading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slide_small_heading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'label' => __('Slide Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Heading Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_sliderHeading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_sliderHeading_color', array(
			'label' => __('Slider Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_sliderHeading_color',
		)));
		//This is Slider Heading FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_sliderHeading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_sliderHeading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_sliderHeading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'label' => __('Slide Text Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Text Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_slidertext_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slidertext_color', array(
			'label' => __('Slider Text Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slidertext_color',
		)));
		//This is Slider Text FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_slidertext_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slidertext_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slidertext_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slidertext_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'label' => __('Slide Button Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// Button 1 color settings
		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor', array(
			'label' => __('Button Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor',
		)));
		$wp_customize->add_setting('ts_demo_importer_button_fontfamily',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		 ));
		$wp_customize->add_control(
				'ts_demo_importer_button_fontfamily', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Button Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_button_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_button_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_button_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'label' => __('Button Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'label' => __('Button Hover Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor_hover', array(
			'label' => __('Button Hover Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'label' => __('Slide Nav Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one_color', array(
			'label' => 'Slider Nav Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one_color',
		)));
		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one', array(
			'label' => 'Slider Nav Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one',
		)));
		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'label' => 'Slider Nav Hover Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_bgcolor',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_color', array(
			'label' => 'Slider Nav Hover Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_arrows',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_arrows',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Nav', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
		$wp_customize->add_setting( 'ts_demo_importer_slider_dots',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_dots',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Dots', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
	} elseif ( $template == 'advance-marketing-agency' ) {
		$wp_customize->add_section('ts_demo_importer_slider_section',array(
			'title'	=> __('Slider Settings','ts-demo-importer'),
			'priority'	=> null,
			'panel' => 'ts_demo_importer_panel_id',
		));


		$number = get_theme_mod('ts_demo_importer_slide_number');

		$ts_demo_importer_slider_section_settings = array();
		$ts_demo_importer_slide_background_type = array();
		$ts_demo_importer_slide_vide_link = array();
		$ts_demo_importer_slide_background_color_one = array();
		$ts_demo_importer_slide_background_color_two = array();
		$ts_demo_importer_slide_height = array();
		$ts_demo_importer_slide_two_image = array();
		$ts_demo_importer_slide_two_image_alt_text = array();
		$ts_demo_importer_slide_two_left_girl_img = array();
		$ts_demo_importer_slide_two_left_girl_img_alt_text = array();
		$ts_demo_importer_slide_two_right_boy_img = array();
		$ts_demo_importer_slide_two_right_boy_img_alt_text = array();
		$ts_demo_importer_slide_small_heading = array();
		$ts_demo_importer_slide_heading = array();
		$ts_demo_importer_slide_text = array();
		$ts_demo_importer_slide_btn_one_text = array();
		$ts_demo_importer_slide_btn_one_url = array();
		$ts_demo_importer_slide_btn_one_icon = array();

		for($i=1; $i<=$number ;$i++){
			$ts_demo_importer_slider_section_settings[$i] = 'ts_demo_importer_slider_section_settings'.$i;
			$ts_demo_importer_slide_background_type[$i] = 'ts_demo_importer_slide_background_type'.$i;
			$ts_demo_importer_slide_vide_link[$i] = 'ts_demo_importer_slide_vide_link'.$i;
			$ts_demo_importer_slide_background_color_one[$i] = 'ts_demo_importer_slide_background_color_one'.$i;
			$ts_demo_importer_slide_background_color_two[$i] = 'ts_demo_importer_slide_background_color_two'.$i;
			$ts_demo_importer_slide_height[$i] = 'ts_demo_importer_slide_height'.$i;
			$ts_demo_importer_slide_two_image[$i] = 'ts_demo_importer_slide_two_image'.$i;
			$ts_demo_importer_slide_two_image_alt_text[$i] = 'ts_demo_importer_slide_two_image_alt_text'.$i;
			$ts_demo_importer_slide_two_left_girl_img[$i] = 'ts_demo_importer_slide_two_left_girl_img'.$i;
			$ts_demo_importer_slide_two_left_girl_img_alt_text[$i] = 'ts_demo_importer_slide_two_left_girl_img_alt_text'.$i;
			$ts_demo_importer_slide_two_right_boy_img[$i] = 'ts_demo_importer_slide_two_right_boy_img'.$i;
			$ts_demo_importer_slide_two_right_boy_img_alt_text[$i] = 'ts_demo_importer_slide_two_right_boy_img_alt_text'.$i;
			$ts_demo_importer_slide_small_heading[$i] = 'ts_demo_importer_slide_small_heading'.$i;
			$ts_demo_importer_slide_heading[$i] = 'ts_demo_importer_slide_heading'.$i;
			$ts_demo_importer_slide_text[$i] = 'ts_demo_importer_slide_text'.$i;
			$ts_demo_importer_slide_btn_one_text[$i] = 'ts_demo_importer_slide_btn_one_text'.$i;
			$ts_demo_importer_slide_btn_one_url[$i] = 'ts_demo_importer_slide_btn_one_url'.$i;
			$ts_demo_importer_slide_btn_one_icon[$i] = 'ts_demo_importer_slide_btn_one_icon'.$i;
		}

		$arr1 = array(
										'ts_demo_importer_slider_enabledisable',
										'ts_demo_importer_slide_number',
										'ts_demo_importer_slide_delay',
										'ts_demo_importer_slide_remove_fade',
										'ts_demo_importer_slider_section_content_option',
										'ts_demo_importer_our_records_content_settings',
										'ts_demo_importer_slide_overlay',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_our_records_carousel_loop',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_slider_arrows',
										'ts_demo_importer_slider_dots',
										'ts_demo_importer_slider_section_content_spacing',
										'ts_demo_importer_slider_section_slider_top_spacing',
										'ts_demo_importer_slider_section_slider_bottom_spacing',
										'ts_demo_importer_slider_section_slider_left_spacing',
										'ts_demo_importer_slider_section_slider_right_spacing');

		$arr_final = array_merge($arr1, $ts_demo_importer_slider_section_settings, $ts_demo_importer_slide_background_type, $ts_demo_importer_slide_vide_link, $ts_demo_importer_slide_background_color_one, $ts_demo_importer_slide_background_color_two, $ts_demo_importer_slide_height, $ts_demo_importer_slide_two_image, $ts_demo_importer_slide_two_image_alt_text,$ts_demo_importer_slide_two_left_girl_img,$ts_demo_importer_slide_two_left_girl_img_alt_text, $ts_demo_importer_slide_two_right_boy_img , $ts_demo_importer_slide_two_right_boy_img_alt_text , $ts_demo_importer_slide_small_heading, $ts_demo_importer_slide_heading, $ts_demo_importer_slide_text, $ts_demo_importer_slide_btn_one_text, $ts_demo_importer_slide_btn_one_url, $ts_demo_importer_slide_btn_one_icon);

		$wp_customize->add_setting('ts_demo_importer_slider_tab_settings', array(
				'sanitize_callback' => 'wp_kses_post',
		 ));

			$wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_slider_tab_settings', array(
				'section' => 'ts_demo_importer_slider_section',
				'buttons' => array(
						array(
								'name' => esc_html__('Content', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-welcome-write-blog',
								'fields' => $arr_final,

						),
						array(
								'name' => esc_html__('Style', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-art',
								'fields' => array(
										'ts_demo_importer_slide_content_color_settings',
										'ts_demo_importer_slider_left_circle_ct_pallete',
										'ts_demo_importer_slider_left_top_circle_color',
										'ts_demo_importer_slider_left_top_circle_height',
										'ts_demo_importer_slider_left_top_circle_width',
										'ts_demo_importer_slider_left_bottom_circle_color',
										'ts_demo_importer_slider_left_bottom_circle_height',
										'ts_demo_importer_slider_left_bottom_circle_width',
										'ts_demo_importer_slider_right_circle_ct_pallete',
										'ts_demo_importer_slider_right_top_circle_color',
										'ts_demo_importer_slider_right_top_circle_height',
										'ts_demo_importer_slider_right_top_circle_width',
										'ts_demo_importer_slider_right_bottom_circle_color',
										'ts_demo_importer_slider_right_bottom_circle_height',
										'ts_demo_importer_slider_right_bottom_circle_width',
										'ts_demo_importer_slider_small_heading_ct_pallete',
										'ts_demo_importer_slide_small_heading_color',
										'ts_demo_importer_slide_small_heading_font_family',
										'ts_demo_importer_slide_small_heading_font_size',
										'ts_demo_importer_slider_heading_ct_pallete',
										'ts_demo_importer_sliderHeading_color',
										'ts_demo_importer_sliderHeading_font_family',
										'ts_demo_importer_sliderHeading_font_size',
										'ts_demo_importer_slider_text_ct_pallete',
										'ts_demo_importer_slidertext_color',
										'ts_demo_importer_slidertext_font_family',
										'ts_demo_importer_slidertext_font_size',
										'ts_demo_importer_slider_button1_ct_pallete',
										'ts_demo_importer_slide_buttoncolor',
										'ts_demo_importer_button_fontfamily',
										'ts_demo_importer_button_font_size',
										'ts_demo_importer_slide_button_first_bgcolor_one',
										'ts_demo_importer_slide_button_first_bgcolor_one_hover',
										'ts_demo_importer_slide_buttoncolor_hover',
										'ts_demo_importer_slider_button2_ct_pallete',
										'ts_demo_importer_slide_button_twocolor',
										'ts_demo_importer_button_twofontfamily',
										'ts_demo_importer_button_twofont_size',
										'ts_demo_importer_slide_button_first_bgcolor_two',
										'ts_demo_importer_slide_button_first_bgcolor_two_hover',
										'ts_demo_importer_slide_button_twocolor_hover',
								),
						)
				),
		)));

		$wp_customize->add_setting('ts_demo_importer_slider_enabledisable',array(
					'default'=> 'Enable',
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
		$wp_customize->add_control('ts_demo_importer_slider_enabledisable', array(
					'type' => 'radio',
					'label' => 'Do you want this section',
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Enable' => 'Enable',
							'Disable' => 'Disable'
					),
			));

		$wp_customize->selective_refresh->add_partial( 'ts_demo_importer_slider_enabledisable', array(
	    'selector' => '.carousel-caption container ',
	    'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_slider_enabledisable',
	  ));

		$wp_customize->add_setting('ts_demo_importer_slide_number',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_number',array(
			'label'	=> __('Number of slides to show','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'type'		=> 'number'
		));
		$count =  get_theme_mod('ts_demo_importer_slide_number');
		for($i=1; $i<=$count; $i++) {

			$wp_customize->add_setting( 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'default' => '',
					'transport' => 'postMessage',
					'sanitize_callback' => 'ts_demo_importer_text_sanitization'
			 ));
			 $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'label' => __('Slider Settings ','ts-demo-importer').$i,
					'section' => 'ts_demo_importer_slider_section'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_type'. $i, array(
				'default' => 'slide_type_image',
				'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
			$wp_customize->add_control('ts_demo_importer_slide_background_type'. $i, array(
				'type' => 'radio',
				'label' => __('Slide Background Type ', 'ts-demo-importer'). $i,
				'section' => 'ts_demo_importer_slider_section',
				'choices' => array(
					'slide_type_image' => __('Image', 'ts-demo-importer'),
					'slide_type_video' => __('Video', 'ts-demo-importer'),
					'slide_type_gradient' => __('Gradient', 'ts-demo-importer')
				)
			));

			$wp_customize->add_setting('ts_demo_importer_slide_vide_link' . $i, array(
						'default' => '',
						'sanitize_callback' => 'sanitize_text_field'
				));
				$wp_customize->add_control('ts_demo_importer_slide_vide_link' . $i, array(
						'label' => __('Slide Video Embed Link', 'ts-demo-importer') . $i,
						'description' => __('For this option to enable first you have to select "Slide Background Type" as "Video". Note: Upload video in Media and add link here', 'ts-demo-importer'),
						'section' => 'ts_demo_importer_slider_section',
						'setting' => 'ts_demo_importer_slide_vide_link' . $i,
						'type' => 'url',
						'active_callback' => 'ts_demo_importer_slider_video'
				));

				$wp_customize->add_setting('ts_demo_importer_slide_background_color_one'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_one'. $i, array(
				'label' => __('Slider Background Color one', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_one'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'

			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_two'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_two'. $i, array(
				'label' => __('Slider Background Color two', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_two'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_height'. $i, array(
						'default' => __('600', 'ts-demo-importer'),
						'sanitize_callback' => 'sanitize_text_field'
				));
				$wp_customize->add_control('ts_demo_importer_slide_height'. $i, array(
						'label' => __('Slide Height', 'ts-demo-importer'). $i,
						'description' => __('This setting will only work for "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
						'section' => 'ts_demo_importer_slider_section',
						'setting' => 'ts_demo_importer_slide_height'. $i,
						'type' => 'number',
						'active_callback' => 'ts_demo_importer_slider_gradient'
				));

				// slider background img
			$wp_customize->add_setting('ts_demo_importer_slide_two_image'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_two_image'.$i,
				array(
					'label' => __('Slider Background Image ','ts-demo-importer'). $i,
					'description' => __('Dimension 1500px * 700px  Background(Image will only display if slide type is "Image")', 'ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'settings' => 'ts_demo_importer_slide_two_image'.$i,
					'active_callback' => 'ts_demo_importer_slider_type_image'
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_two_image_alt_text'.$i,array(
					'default' => '',
					'sanitize_callback' => 'sanitize_textarea_field',
				));
			$wp_customize->add_control('ts_demo_importer_slide_two_image_alt_text'.$i,array(
				'label' => __('Slider Background Image ALT Text ','ts-demo-importer').$i,
				'description' => __('This is Background image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_two_image_alt_text'.$i,
				'type' => 'text',
				'active_callback' => 'ts_demo_importer_slider_type_image'
			));
			// Left image
			$wp_customize->add_setting('ts_demo_importer_slide_two_left_girl_img'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_two_left_girl_img'.$i,
				array(
					'label' => __('Slider Left Image ','ts-demo-importer'). $i,
					'description' => __('Dimension 466px * 783px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'settings' => 'ts_demo_importer_slide_two_left_girl_img'.$i,
					'active_callback' => 'ts_demo_importer_slider_type_image'
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_two_left_girl_img_alt_text'.$i,array(
					'default' => '',
					'sanitize_callback' => 'sanitize_textarea_field',
				));
			$wp_customize->add_control('ts_demo_importer_slide_two_left_girl_img_alt_text'.$i,array(
				'label' => __('Slider Left Image ALT Text ','ts-demo-importer').$i,
				'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_two_left_girl_img_alt_text'.$i,
				'type' => 'text',
				'active_callback' => 'ts_demo_importer_slider_type_image'
			));
			// right image
			$wp_customize->add_setting('ts_demo_importer_slide_two_right_boy_img'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_two_right_boy_img'.$i,
				array(
					'label' => __('Slider Right Image ','ts-demo-importer'). $i,
					'description' => __('Dimension 466px * 783px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'settings' => 'ts_demo_importer_slide_two_right_boy_img'.$i,
					'active_callback' => 'ts_demo_importer_slider_type_image'
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_two_right_boy_img_alt_text'.$i,array(
					'default' => '',
					'sanitize_callback' => 'sanitize_textarea_field',
				));
			$wp_customize->add_control('ts_demo_importer_slide_two_right_boy_img_alt_text'.$i,array(
				'label' => __('Slider Right Image ALT Text ','ts-demo-importer').$i,
				'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_two_right_boy_img_alt_text'.$i,
				'type' => 'text',
				'active_callback' => 'ts_demo_importer_slider_type_image'
			));




			$wp_customize->add_setting('ts_demo_importer_slide_small_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_small_heading'.$i,array(
				'label' => __('Slide Small Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_small_heading'.$i,
				'type'	=> 'text'
			));
			$wp_customize->add_setting('ts_demo_importer_slide_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_heading'.$i,array(
				'label' => __('Slide Main Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_text'.$i,array(
				'default'   => '',
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'wp_kses_post'
			));
			$wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_slide_text'.$i,array(
				'label' => __('Slide Text','ts-demo-importer').$i,
				'description' => __('Add Text','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'   => 'ts_demo_importer_slide_text'.$i,
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_text'.$i,array(
				'label' => __('Slider Button Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting(
				'ts_demo_importer_slide_btn_one_icon'.$i,
				array(
					'default'     => '',
					'sanitize_callback' => 'sanitize_text_field'
				)
			);
			$wp_customize->add_control(
				new ts_demo_importer_Fontawesome_Icon_Chooser(
					$wp_customize,
					'ts_demo_importer_slide_btn_one_icon'.$i,
					array(
						'settings'    => 'ts_demo_importer_slide_btn_one_icon'.$i,
						'section'   => 'ts_demo_importer_slider_section',
						'type'      => 'icon',
						'label'     => esc_html__( 'Choose Icon ', 'advance-one-page-pro' ),
					)
				)
			);

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_url'.$i,array(
				'label' => __('Slider Button Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_url'.$i,
				'type'	=> 'text'
			));

		}
		// Other Settings
		$wp_customize->add_setting('ts_demo_importer_slide_delay',array(
			'default'	=> '1000',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_delay',array(
			'label'	=> __('Slide Delay','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'ts-demo-importer'),
			'type'		=> 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_remove_fade',
			 array(
					'default' => 1,
					'transport' => 'refresh',
					'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			 )
			);
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slide_remove_fade',
				 array(
						'label' => esc_html__( 'Fade Effect', 'ts-demo-importer' ),
						'section' => 'ts_demo_importer_slider_section'
				 )
			));

		$wp_customize->add_setting('ts_demo_importer_slider_section_content_option',array(
					'default' => __('Left','ts-demo-importer'),
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_slider_section_content_option', array(
					'type' => 'select',
					'label' => __('Slider Content Layouts','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
							'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
							'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
			))));
		$wp_customize->add_setting('ts_demo_importer_slider_section_content_spacing',array(
			'sanitize_callback'	=> 'esc_html'
		));
		$wp_customize->add_control('ts_demo_importer_slider_section_content_spacing',array(
			'label'	=> esc_html__('Slider Content Spacing','ts-demo-importer'),
			'description'	=> __('Add value in percentage here.','ts-demo-importer'),
			'section'=> 'ts_demo_importer_slider_section',
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'label' => esc_html__( 'Top','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'label' => esc_html__( 'Bottom','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'label' => esc_html__( 'Left','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'label' => esc_html__('Right','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slide_overlay',
				 array(
						'default' => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
				 )
		);

		$wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_slide_overlay',
		 array(
				'label' => __( 'Slide Overlay','ts-demo-importer' ),
				'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section',
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

		$wp_customize->add_setting( 'ts_demo_importer_slide_content_color_settings',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_content_color_settings',
		array(
			'label' => __('Section Color & Typography','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));
		// Left Circle design
		$wp_customize->add_setting( 'ts_demo_importer_slider_left_circle_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_left_circle_ct_pallete',
		array(
			'label' => __('Slider Left Circle Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_left_top_circle_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_left_top_circle_color', array(
			'label' => __('Slider Left Top Circle Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_left_top_circle_color',
		)));
		$wp_customize->add_setting('ts_demo_importer_slider_left_top_circle_height',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_left_top_circle_height',array(
			'label' => __('Height','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_left_top_circle_height',
			'type'    => 'number'
		));
		$wp_customize->add_setting('ts_demo_importer_slider_left_top_circle_width',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_left_top_circle_width',array(
			'label' => __('Width','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_left_top_circle_width',
			'type'    => 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slider_left_bottom_circle_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_left_bottom_circle_color', array(
			'label' => __('Slider Left Bottom Circle Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_left_bottom_circle_color',
		)));
		$wp_customize->add_setting('ts_demo_importer_slider_left_bottom_circle_height',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_left_bottom_circle_height',array(
			'label' => __('Height','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_left_bottom_circle_height',
			'type'    => 'number'
		));
		$wp_customize->add_setting('ts_demo_importer_slider_left_bottom_circle_width',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_left_bottom_circle_width',array(
			'label' => __('Width','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_left_bottom_circle_width',
			'type'    => 'number'
		));

		// Right Circle design
		$wp_customize->add_setting( 'ts_demo_importer_slider_right_circle_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_right_circle_ct_pallete',
		array(
			'label' => __('Slider Right Circle Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_right_top_circle_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_right_top_circle_color', array(
			'label' => __('Slider Right Top Circle Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_right_top_circle_color',
		)));
		$wp_customize->add_setting('ts_demo_importer_slider_right_top_circle_height',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_right_top_circle_height',array(
			'label' => __('Height','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_right_top_circle_height',
			'type'    => 'number'
		));
		$wp_customize->add_setting('ts_demo_importer_slider_right_top_circle_width',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_right_top_circle_width',array(
			'label' => __('Width','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_right_top_circle_width',
			'type'    => 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slider_right_bottom_circle_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_right_bottom_circle_color', array(
			'label' => __('Slider Right Bottom Circle Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_right_bottom_circle_color',
		)));
		$wp_customize->add_setting('ts_demo_importer_slider_right_bottom_circle_height',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_right_bottom_circle_height',array(
			'label' => __('Height','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_right_bottom_circle_height',
			'type'    => 'number'
		));
		$wp_customize->add_setting('ts_demo_importer_slider_right_bottom_circle_width',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slider_right_bottom_circle_width',array(
			'label' => __('Width','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slider_right_bottom_circle_width',
			'type'    => 'number'
		));

		// small heading typography
		$wp_customize->add_setting( 'ts_demo_importer_slider_small_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_small_heading_ct_pallete',
		array(
			'label' => __('Slide Small Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_small_heading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_small_heading_color', array(
			'label' => __('Slider Small Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_small_heading_color',
		)));
		//This is Slider Heading FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_slide_small_heading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slide_small_heading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Small Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slide_small_heading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slide_small_heading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slide_small_heading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'label' => __('Slide Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Heading Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_sliderHeading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_sliderHeading_color', array(
			'label' => __('Slider Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_sliderHeading_color',
		)));
		//This is Slider Heading FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_sliderHeading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_sliderHeading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_sliderHeading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'label' => __('Slide Text Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Text Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_slidertext_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slidertext_color', array(
			'label' => __('Slider Text Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slidertext_color',
		)));
		//This is Slider Text FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_slidertext_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slidertext_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slidertext_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slidertext_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'label' => __('Slide Button Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// Button 1 color settings
		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor', array(
			'label' => __('Button Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor',
		)));
		$wp_customize->add_setting('ts_demo_importer_button_fontfamily',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		 ));
		$wp_customize->add_control(
				'ts_demo_importer_button_fontfamily', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Button Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_button_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_button_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_button_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'label' => __('Button Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'label' => __('Button Hover Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor_hover', array(
			'label' => __('Button Hover Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_arrows',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_arrows',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Nav', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
		$wp_customize->add_setting( 'ts_demo_importer_slider_dots',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_dots',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Dots', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
	} elseif ( $template == 'advance-consultancy' ) {
		$wp_customize->add_section('ts_demo_importer_slider_section',array(
			'title'	=> __('Slider Settings','ts-demo-importer'),
			'priority'	=> null,
			'panel' => 'ts_demo_importer_panel_id',
		));


		$number = get_theme_mod('ts_demo_importer_slide_number');

		$ts_demo_importer_slider_section_settings = array();
		$ts_demo_importer_slide_background_type = array();
		$ts_demo_importer_slide_vide_link = array();
		$ts_demo_importer_slide_background_color_one = array();
		$ts_demo_importer_slide_background_color_two = array();
		$ts_demo_importer_slide_height = array();
		$ts_demo_importer_slide_image = array();
		$ts_demo_importer_slide_image_alt_text = array();
		$ts_demo_importer_slide_heading = array();
		$ts_demo_importer_slide_text = array();
		$ts_demo_importer_slide_btn_one_text = array();
		$ts_demo_importer_slide_btn_one_url = array();
		$ts_demo_importer_slide_btn_one_icon = array();

		for($i=1; $i<=$number ;$i++){
			$ts_demo_importer_slider_section_settings[$i] = 'ts_demo_importer_slider_section_settings'.$i;
			$ts_demo_importer_slide_background_type[$i] = 'ts_demo_importer_slide_background_type'.$i;
			$ts_demo_importer_slide_vide_link[$i] = 'ts_demo_importer_slide_vide_link'.$i;
			$ts_demo_importer_slide_background_color_one[$i] = 'ts_demo_importer_slide_background_color_one'.$i;
			$ts_demo_importer_slide_background_color_two[$i] = 'ts_demo_importer_slide_background_color_two'.$i;
			$ts_demo_importer_slide_height[$i] = 'ts_demo_importer_slide_height'.$i;
			$ts_demo_importer_slide_image[$i] = 'ts_demo_importer_slide_image'.$i;
			$ts_demo_importer_slide_image_alt_text[$i] = 'ts_demo_importer_slide_image_alt_text'.$i;
			$ts_demo_importer_slide_heading[$i] = 'ts_demo_importer_slide_heading'.$i;
			$ts_demo_importer_slide_text[$i] = 'ts_demo_importer_slide_text'.$i;
			$ts_demo_importer_slide_btn_one_text[$i] = 'ts_demo_importer_slide_btn_one_text'.$i;
			$ts_demo_importer_slide_btn_one_url[$i] = 'ts_demo_importer_slide_btn_one_url'.$i;
			$ts_demo_importer_slide_btn_one_icon[$i] = 'ts_demo_importer_slide_btn_one_icon'.$i;
		}

		$arr1 = array(
										'ts_demo_importer_slider_enabledisable',
										'ts_demo_importer_slide_number',
										'ts_demo_importer_slide_delay',
										'ts_demo_importer_slide_remove_fade',
										'ts_demo_importer_slider_section_content_option',
										'ts_demo_importer_our_records_content_settings',
										'ts_demo_importer_slide_overlay',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_our_records_carousel_loop',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_slider_arrows',
										'ts_demo_importer_slider_dots',
										'ts_demo_importer_slider_section_content_spacing',
										'ts_demo_importer_slider_section_slider_top_spacing',
										'ts_demo_importer_slider_section_slider_bottom_spacing',
										'ts_demo_importer_slider_section_slider_left_spacing',
										'ts_demo_importer_slider_section_slider_right_spacing');

		$arr_final = array_merge($arr1, $ts_demo_importer_slider_section_settings, $ts_demo_importer_slide_background_type, $ts_demo_importer_slide_vide_link, $ts_demo_importer_slide_background_color_one, $ts_demo_importer_slide_background_color_two, $ts_demo_importer_slide_height, $ts_demo_importer_slide_image, $ts_demo_importer_slide_image_alt_text, $ts_demo_importer_slide_heading, $ts_demo_importer_slide_text, $ts_demo_importer_slide_btn_one_text, $ts_demo_importer_slide_btn_one_url, $ts_demo_importer_slide_btn_one_icon);

		$wp_customize->add_setting('ts_demo_importer_slider_tab_settings', array(
				'sanitize_callback' => 'wp_kses_post',
		 ));

			$wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_slider_tab_settings', array(
				'section' => 'ts_demo_importer_slider_section',
				'buttons' => array(
						// array(
						//     'name' => esc_html__('Layout', 'ts-demo-importer'),
						//     'icon' => 'dashicons dashicons-layout',
						//     'fields' => array(
						//     ),
						//     'active' => true,
						// ),
						array(
								'name' => esc_html__('Content', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-welcome-write-blog',
								'fields' => $arr_final,

						),
						array(
								'name' => esc_html__('Style', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-art',
								'fields' => array(
										'ts_demo_importer_slide_content_color_settings',
										'ts_demo_importer_slider_heading_ct_pallete',
										'ts_demo_importer_sliderHeading_color',
										'ts_demo_importer_sliderHeading_font_family',
										'ts_demo_importer_sliderHeading_font_size',
										'ts_demo_importer_slider_text_ct_pallete',
										'ts_demo_importer_slidertext_color',
										'ts_demo_importer_slidertext_font_family',
										'ts_demo_importer_slidertext_font_size',
										'ts_demo_importer_slider_button1_ct_pallete',
										'ts_demo_importer_slide_buttoncolor',
										'ts_demo_importer_button_fontfamily',
										'ts_demo_importer_button_font_size',
										'ts_demo_importer_slide_button_first_bgcolor_one',
										'ts_demo_importer_slide_button_first_bgcolor_one_hover',
										'ts_demo_importer_slide_buttoncolor_hover',
										'ts_demo_importer_slider_button2_ct_pallete',
										'ts_demo_importer_slide_button_twocolor',
										'ts_demo_importer_button_twofontfamily',
										'ts_demo_importer_button_twofont_size',
										'ts_demo_importer_slide_button_first_bgcolor_two',
										'ts_demo_importer_slide_button_first_bgcolor_two_hover',
										'ts_demo_importer_slide_button_twocolor_hover',

										'ts_demo_importer_slider_start_up_nav_ct_pallete',
										'ts_demo_importer_slider_start_up_nav_color',
										'ts_demo_importer_slider_start_up_nav_border_color',
										'ts_demo_importer_slider_start_up_nav_bgcolor',
										'ts_demo_importer_slider_start_up_nav_hover_bgcolor',
										'ts_demo_importer_slider_start_up_nav_hover_color',
										'ts_demo_importer_slider_start_up_dot_ct_pallete',
										'ts_demo_importer_slider_start_up_dots_color',
										'ts_demo_importer_slider_start_up_dots_border_color',
										'ts_demo_importer_slider_start_up_dots_active_color',
										'ts_demo_importer_slider_start_up_dots_active_border_color',
										'ts_demo_importer_slider_start_up_dots_outer_border_color'
								),
						)
				),
		)));

		$wp_customize->add_setting('ts_demo_importer_slider_enabledisable',array(
					'default'=> 'Enable',
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
		$wp_customize->add_control('ts_demo_importer_slider_enabledisable', array(
					'type' => 'radio',
					'label' => 'Do you want this section',
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Enable' => 'Enable',
							'Disable' => 'Disable'
					),
			));
			$wp_customize->selective_refresh->add_partial( 'ts_demo_importer_slider_enabledisable', array(
			'selector' => '.slider-box h2',
			'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_slider_enabledisable',
			) );
		$wp_customize->add_setting('ts_demo_importer_slide_number',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_number',array(
			'label'	=> __('Number of slides to show','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'type'		=> 'number'
		));
		$count =  get_theme_mod('ts_demo_importer_slide_number');
		for($i=1; $i<=$count; $i++) {

			$wp_customize->add_setting( 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'default' => '',
					'transport' => 'postMessage',
					'sanitize_callback' => 'ts_demo_importer_text_sanitization'
			 ));
			 $wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_section_settings'.$i,
					array(
					'label' => __('Slider Settings ','ts-demo-importer').$i,
					'section' => 'ts_demo_importer_slider_section'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_type'. $i, array(
				'default' => 'slide_type_image',
				'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
			$wp_customize->add_control('ts_demo_importer_slide_background_type'. $i, array(
				'type' => 'radio',
				'label' => __('Slide Background Type ', 'ts-demo-importer'). $i,
				'section' => 'ts_demo_importer_slider_section',
				'choices' => array(
					'slide_type_image' => __('Image', 'ts-demo-importer'),
					'slide_type_video' => __('Video', 'ts-demo-importer'),
					'slide_type_gradient' => __('Gradient', 'ts-demo-importer')
				)
			));

			$wp_customize->add_setting('ts_demo_importer_slide_vide_link' . $i, array(
						'default' => '',
						'sanitize_callback' => 'sanitize_text_field'
				));
				$wp_customize->add_control('ts_demo_importer_slide_vide_link' . $i, array(
						'label' => __('Slide Video Embed Link', 'ts-demo-importer') . $i,
						'description' => __('For this option to enable first you have to select "Slide Background Type" as "Video". Note: Upload video in Media and add link here', 'ts-demo-importer'),
						'section' => 'ts_demo_importer_slider_section',
						'setting' => 'ts_demo_importer_slide_vide_link' . $i,
						'type' => 'url',
						'active_callback' => 'ts_demo_importer_slider_video'
				));

				$wp_customize->add_setting('ts_demo_importer_slide_background_color_one'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_one'. $i, array(
				'label' => __('Slider Background Color one', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_one'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'

			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_two'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_two'. $i, array(
				'label' => __('Slider Background Color two', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_two'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_height'. $i, array(
						'default' => __('600', 'ts-demo-importer'),
						'sanitize_callback' => 'sanitize_text_field'
				));
				$wp_customize->add_control('ts_demo_importer_slide_height'. $i, array(
						'label' => __('Slide Height', 'ts-demo-importer'). $i,
						'description' => __('This setting will only work for "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
						'section' => 'ts_demo_importer_slider_section',
						'setting' => 'ts_demo_importer_slide_height'. $i,
						'type' => 'number',
						'active_callback' => 'ts_demo_importer_slider_gradient'
				));


			$wp_customize->add_setting('ts_demo_importer_slide_image'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_image'.$i,
						array(
							'label' => __('Slider Image ','ts-demo-importer'). $i,
							'description' => __('Dimension 1500px * 700px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
							'section' => 'ts_demo_importer_slider_section',
							'settings' => 'ts_demo_importer_slide_image'.$i,
							'active_callback' => 'ts_demo_importer_slider_type_image'
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_image_alt_text'.$i,array(
					'default' => '',
					'sanitize_callback' => 'sanitize_textarea_field',
				));
				$wp_customize->add_control('ts_demo_importer_slide_image_alt_text'.$i,array(
					'label' => __('Slider Image ALT Text ','ts-demo-importer').$i,
					'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'setting' => 'ts_demo_importer_slide_image_alt_text'.$i,
					'type' => 'text',
					'active_callback' => 'ts_demo_importer_slider_type_image'
				));
			$wp_customize->add_setting('ts_demo_importer_slide_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_heading'.$i,array(
				'label' => __('Slide Main Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_text'.$i,array(
				'default'   => '',
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'wp_kses_post'
			));
			$wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_slide_text'.$i,array(
				'label' => __('Slide Text','ts-demo-importer').$i,
				'description' => __('Add Text','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'   => 'ts_demo_importer_slide_text'.$i,
			)));
			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_text'.$i,array(
				'label' => __('Slider Button Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting(
				'ts_demo_importer_slide_btn_one_icon'.$i,
				array(
					'default'     => '',
					'sanitize_callback' => 'sanitize_text_field'
				)
			);
			$wp_customize->add_control(
				new ts_demo_importer_Fontawesome_Icon_Chooser(
					$wp_customize,
					'ts_demo_importer_slide_btn_one_icon'.$i,
					array(
						'settings'    => 'ts_demo_importer_slide_btn_one_icon'.$i,
						'section'   => 'ts_demo_importer_slider_section',
						'type'      => 'icon',
						'label'     => esc_html__( 'Choose Icon ', 'advance-one-page-pro' ),
					)
				)
			);

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_url'.$i,array(
				'label' => __('Slider Button Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_url'.$i,
				'type'	=> 'text'
			));

		}
		// Other Settings
		$wp_customize->add_setting('ts_demo_importer_slide_delay',array(
			'default'	=> '1000',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_delay',array(
			'label'	=> __('Slide Delay','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'ts-demo-importer'),
			'type'		=> 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_remove_fade',
			 array(
					'default' => 1,
					'transport' => 'refresh',
					'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			 )
			);
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slide_remove_fade',
				 array(
						'label' => esc_html__( 'Fade Effect', 'ts-demo-importer' ),
						'section' => 'ts_demo_importer_slider_section'
				 )
			));

		$wp_customize->add_setting('ts_demo_importer_slider_section_content_option',array(
					'default' => __('Left','ts-demo-importer'),
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_slider_section_content_option', array(
					'type' => 'select',
					'label' => __('Slider Content Layouts','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
							'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
							'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
			))));
		$wp_customize->add_setting('ts_demo_importer_slider_section_content_spacing',array(
			'sanitize_callback'	=> 'esc_html'
		));
		$wp_customize->add_control('ts_demo_importer_slider_section_content_spacing',array(
			'label'	=> esc_html__('Slider Content Spacing','ts-demo-importer'),
			'description'	=> __('Add value in percentage here.','ts-demo-importer'),
			'section'=> 'ts_demo_importer_slider_section',
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'label' => esc_html__( 'Top','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'label' => esc_html__( 'Bottom','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'label' => esc_html__( 'Left','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'label' => esc_html__('Right','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slide_overlay',
				 array(
						'default' => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
				 )
		);

		$wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_slide_overlay',
		 array(
				'label' => __( 'Slide Overlay','ts-demo-importer' ),
				'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section',
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

		$wp_customize->add_setting( 'ts_demo_importer_slide_content_color_settings',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_content_color_settings',
		array(
			'label' => __('Section Color & Typography','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'label' => __('Slide Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Heading Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_sliderHeading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_sliderHeading_color', array(
			'label' => __('Slider Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_sliderHeading_color',
		)));
		//This is Slider Heading FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_sliderHeading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_sliderHeading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_sliderHeading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'label' => __('Slide Text Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// This is Slider Text Color picker setting
		$wp_customize->add_setting( 'ts_demo_importer_slidertext_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slidertext_color', array(
			'label' => __('Slider Text Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slidertext_color',
		)));
		//This is Slider Text FontFamily picker setting
		$wp_customize->add_setting('ts_demo_importer_slidertext_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slidertext_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slidertext_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slidertext_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'label' => __('Slide Button Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// Button 1 color settings
		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor', array(
			'label' => __('Button Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor',
		)));
		$wp_customize->add_setting('ts_demo_importer_button_fontfamily',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		 ));
		$wp_customize->add_control(
				'ts_demo_importer_button_fontfamily', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Button Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_button_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_button_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_button_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'label' => __('Button Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'label' => __('Button Hover Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor_hover', array(
			'label' => __('Button Hover Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_ct_pallete',
		array(
			'label' => __('Slide Nav Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_color', array(
			'label' => 'Slider Nav Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_nav_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_border_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_border_color', array(
			'label' => 'Slider Nav Border Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_nav_border_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_bgcolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_bgcolor', array(
			'label' => 'Slider Nav Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_nav_bgcolor',
		)));
		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_hover_bgcolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_hover_bgcolor', array(
			'label' => 'Slider Nav Hover Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_nav_hover_bgcolor',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_nav_hover_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_nav_hover_color', array(
			'label' => 'Slider Nav Hover Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_nav_hover_color',
		)));
		// ===============================


		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dot_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dot_ct_pallete',
		array(
			'label' => __('Slide Dot Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dots_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dots_color', array(
			'label' => 'Slider Dot Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_dots_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dots_border_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dots_border_color', array(
			'label' => 'Slider Dot Border Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_dots_border_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dots_active_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dots_active_color', array(
			'label' => 'Slider Dot Active Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_dots_active_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dots_active_border_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dots_active_border_color', array(
			'label' => 'Slider Dot Active Border Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_dots_active_border_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_start_up_dots_outer_border_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slider_start_up_dots_outer_border_color', array(
			'label' => 'Slider Dot Outer Border Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slider_start_up_dots_outer_border_color',
		)));



		// ===============================

		$wp_customize->add_setting( 'ts_demo_importer_slider_arrows',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_arrows',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Nav', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
		$wp_customize->add_setting( 'ts_demo_importer_slider_dots',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_dots',
			 array(
					'label' => esc_html__( 'Show/Hide Slider Dots', 'ts-demo-importer' ),
					'section' => 'ts_demo_importer_slider_section'
			)));
	}elseif ( $template == 'advance-training-academy' ) {
		$wp_customize->add_section('ts_demo_importer_slider_section',array(
			'title'	=> __('Slider Settings','ts-demo-importer'),
			'priority'	=> null,
			'panel' => 'ts_demo_importer_panel_id',
		));

		$number = get_theme_mod('ts_demo_importer_slide_number');

		$ts_demo_importer_slider_section_settings = array();
		$ts_demo_importer_slide_background_type = array();
		$ts_demo_importer_slide_vide_link = array();
		$ts_demo_importer_slide_background_color_one = array();
		$ts_demo_importer_slide_background_color_two = array();
		$ts_demo_importer_slide_height = array();
		$ts_demo_importer_slide_image = array();
		$ts_demo_importer_slide_image_alt_text = array();
		$ts_demo_importer_slide_heading = array();
		$ts_demo_importer_slide_text = array();
		$ts_demo_importer_slide_btn_one_text = array();
		$ts_demo_importer_slide_btn_one_url = array();
		$ts_demo_importer_slide_btn_one_icon = array();

		for($i=1; $i<=$number ;$i++){
			$ts_demo_importer_slider_section_settings[$i] = 'ts_demo_importer_slider_section_settings'.$i;
			$ts_demo_importer_slide_background_type[$i] = 'ts_demo_importer_slide_background_type'.$i;
			$ts_demo_importer_slide_vide_link[$i] = 'ts_demo_importer_slide_vide_link'.$i;
			$ts_demo_importer_slide_background_color_one[$i] = 'ts_demo_importer_slide_background_color_one'.$i;
			$ts_demo_importer_slide_background_color_two[$i] = 'ts_demo_importer_slide_background_color_two'.$i;
			$ts_demo_importer_slide_height[$i] = 'ts_demo_importer_slide_height'.$i;

			$ts_demo_importer_slide_image[$i] = 'ts_demo_importer_slide_image'.$i;
			$ts_demo_importer_slide_image_alt_text[$i] = 'ts_demo_importer_slide_image_alt_text'.$i;
			$ts_demo_importer_slide_heading[$i] = 'ts_demo_importer_slide_heading'.$i;
			$ts_demo_importer_slide_text[$i] = 'ts_demo_importer_slide_text'.$i;
			$ts_demo_importer_slide_btn_one_text[$i] = 'ts_demo_importer_slide_btn_one_text'.$i;
			$ts_demo_importer_slide_btn_one_url[$i] = 'ts_demo_importer_slide_btn_one_url'.$i;
		}

		$arr1 = array(
										'ts_demo_importer_slider_enabledisable',
										'ts_demo_importer_slide_number',
										'ts_demo_importer_slide_delay',
										'ts_demo_importer_slide_remove_fade',
										'ts_demo_importer_slider_section_content_option',
										'ts_demo_importer_our_records_content_settings',
										'ts_demo_importer_slide_overlay',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_our_records_carousel_loop',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_slider_arrows',
										'ts_demo_importer_slider_dots',
										'ts_demo_importer_slider_section_content_spacing',
										'ts_demo_importer_slider_section_slider_top_spacing',
										'ts_demo_importer_slider_section_slider_bottom_spacing',
										'ts_demo_importer_slider_section_slider_left_spacing',
										'ts_demo_importer_slider_section_slider_right_spacing');

		$arr_final = array_merge($arr1, $ts_demo_importer_slider_section_settings, $ts_demo_importer_slide_background_type, $ts_demo_importer_slide_vide_link, $ts_demo_importer_slide_background_color_one, $ts_demo_importer_slide_background_color_two, $ts_demo_importer_slide_height, $ts_demo_importer_slide_image, $ts_demo_importer_slide_image_alt_text, $ts_demo_importer_slide_heading, $ts_demo_importer_slide_text, $ts_demo_importer_slide_btn_one_text, $ts_demo_importer_slide_btn_one_url, $ts_demo_importer_slide_btn_one_icon);

		$wp_customize->add_setting('ts_demo_importer_slider_tab_settings', array(
				'sanitize_callback' => 'wp_kses_post',
		 ));

			$wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_slider_tab_settings', array(
				'section' => 'ts_demo_importer_slider_section',
				'buttons' => array(
						array(
								'name' => esc_html__('Content', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-welcome-write-blog',
								'fields' => $arr_final,

						),
						array(
								'name' => esc_html__('Style', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-art',
								'fields' => array(
										'ts_demo_importer_slide_content_color_settings',
										'ts_demo_importer_slider_heading_ct_pallete',
										'ts_demo_importer_sliderHeading_color',
										'ts_demo_importer_sliderHeading_font_family',
										'ts_demo_importer_sliderHeading_font_size',
										'ts_demo_importer_slider_text_ct_pallete',
										'ts_demo_importer_slidertext_color',
										'ts_demo_importer_slidertext_font_family',
										'ts_demo_importer_slidertext_font_size',
										'ts_demo_importer_slider_button1_ct_pallete',
										'ts_demo_importer_slide_buttoncolor',
										'ts_demo_importer_button_fontfamily',
										'ts_demo_importer_button_font_size',
										'ts_demo_importer_slide_button_first_bgcolor_one',
										'ts_demo_importer_slide_button_first_bgcolor_one_hover',
										'ts_demo_importer_slide_buttoncolor_hover',
										'ts_demo_importer_slide_button_first_bgcolor_two',
										'ts_demo_importer_slide_button_first_bgcolor_two_hover',
										'ts_demo_importer_slide_button_twocolor_hover',
										'ts_demo_importer_slider_nav_ct_pallete',
										'ts_demo_importer_slide_nav_one_color',
										'ts_demo_importer_slide_nav_one',
										'ts_demo_importer_slide_nav_hover_bgcolor',
										'ts_demo_importer_slide_nav_hover_color'
								),
						)
				),
		)));

		$wp_customize->add_setting('ts_demo_importer_slider_enabledisable',array(
			'default'=> 'Enable',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control('ts_demo_importer_slider_enabledisable', array(
			'type' => 'radio',
			'label' => 'Do you want this section',
			'section' => 'ts_demo_importer_slider_section',
			'choices' => array(
				'Enable' => 'Enable',
				'Disable' => 'Disable'
			),
		));
		$wp_customize->selective_refresh->add_partial( 'ts_demo_importer_slider_enabledisable', array(
			'selector' => '.slider-box .slider-heading',
			'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_slider_enabledisable',
		) );

		$wp_customize->add_setting('ts_demo_importer_slide_number',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_number',array(
			'label'	=> __('Number of slides to show','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'type'		=> 'number'
		));

		$count =  get_theme_mod('ts_demo_importer_slide_number');
		for($i=1; $i<=$count; $i++) {

			$wp_customize->add_setting( 'ts_demo_importer_slider_section_settings'.$i,
			array(
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'ts_demo_importer_text_sanitization'
			));
			$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_section_settings'.$i,
			array(
				'label' => __('Slider Settings ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_type'. $i, array(
				'default' => 'slide_type_image',
				'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
			$wp_customize->add_control('ts_demo_importer_slide_background_type'. $i, array(
				'type' => 'radio',
				'label' => __('Slide Background Type ', 'ts-demo-importer'). $i,
				'section' => 'ts_demo_importer_slider_section',
				'choices' => array(
					'slide_type_image' => __('Image', 'ts-demo-importer'),
					'slide_type_video' => __('Video', 'ts-demo-importer'),
					'slide_type_gradient' => __('Gradient', 'ts-demo-importer')
				)
			));

			$wp_customize->add_setting('ts_demo_importer_slide_vide_link' . $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field'
			));
			$wp_customize->add_control('ts_demo_importer_slide_vide_link' . $i, array(
				'label' => __('Slide Video Embed Link', 'ts-demo-importer') . $i,
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Video". Note: Upload video in Media and add link here', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_vide_link' . $i,
				'type' => 'url',
				'active_callback' => 'ts_demo_importer_slider_video'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_one'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_one'. $i, array(
				'label' => __('Slider Background Color one', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_one'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'

			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_two'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_two'. $i, array(
				'label' => __('Slider Background Color two', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_two'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_height'. $i, array(
				'default' => __('600', 'ts-demo-importer'),
				'sanitize_callback' => 'sanitize_text_field'
			));
			$wp_customize->add_control('ts_demo_importer_slide_height'. $i, array(
				'label' => __('Slide Height', 'ts-demo-importer'). $i,
				'description' => __('This setting will only work for "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_height'. $i,
				'type' => 'number',
				'active_callback' => 'ts_demo_importer_slider_gradient'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_image'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_image'.$i,
			array(
				'label' => __('Slider Image ','ts-demo-importer'). $i,
				'description' => __('Dimension 1500px * 700px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_image'.$i,
				'active_callback' => 'ts_demo_importer_slider_type_image'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_image_alt_text'.$i,array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_image_alt_text'.$i,array(
				'label' => __('Slider Image ALT Text ','ts-demo-importer').$i,
				'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_image_alt_text'.$i,
				'type' => 'text',
				'active_callback' => 'ts_demo_importer_slider_type_image'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_heading'.$i,array(
				'label' => __('Slide Main Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_text'.$i,array(
				'default'   => '',
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'wp_kses_post'
			));
			$wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_slide_text'.$i,array(
				'label' => __('Slide Text','ts-demo-importer').$i,
				'description' => __('Add Text','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'   => 'ts_demo_importer_slide_text'.$i,
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_text'.$i,array(
				'label' => __('Slider Button Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_url'.$i,array(
				'label' => __('Slider Button Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_url'.$i,
				'type'	=> 'text'
			));
		}

		// Other Settings
		$wp_customize->add_setting('ts_demo_importer_slide_delay',array(
			'default'	=> '1000',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_delay',array(
			'label'	=> __('Slide Delay','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'ts-demo-importer'),
			'type'		=> 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_remove_fade',
			 array(
					'default' => 1,
					'transport' => 'refresh',
					'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			 )
			);
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slide_remove_fade',
				 array(
						'label' => esc_html__( 'Fade Effect', 'ts-demo-importer' ),
						'section' => 'ts_demo_importer_slider_section'
				 )
			));

		$wp_customize->add_setting('ts_demo_importer_slider_section_content_option',array(
					'default' => __('Left','ts-demo-importer'),
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_slider_section_content_option', array(
					'type' => 'select',
					'label' => __('Slider Content Layouts','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
							'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
							'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
			))));
		$wp_customize->add_setting('ts_demo_importer_slider_section_content_spacing',array(
			'sanitize_callback'	=> 'esc_html'
		));
		$wp_customize->add_control('ts_demo_importer_slider_section_content_spacing',array(
			'label'	=> esc_html__('Slider Content Spacing','ts-demo-importer'),
			'description'	=> __('Add value in percentage here.','ts-demo-importer'),
			'section'=> 'ts_demo_importer_slider_section',
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'label' => esc_html__( 'Top','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'label' => esc_html__( 'Bottom','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'label' => esc_html__( 'Left','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'label' => esc_html__('Right','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slide_overlay',
				 array(
						'default' => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
				 )
		);

		$wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_slide_overlay',
		 array(
				'label' => __( 'Slide Overlay','ts-demo-importer' ),
				'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section',
				'show_opacity' => true,
				'palette' => array(
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

		$wp_customize->add_setting( 'ts_demo_importer_slide_content_color_settings',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_content_color_settings',
		array(
			'label' => __('Section Color & Typography','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// slider main heading
		$wp_customize->add_setting( 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'label' => __('Slide Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_sliderHeading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_sliderHeading_color', array(
			'label' => __('Slider Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_sliderHeading_color',
		)));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_sliderHeading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_sliderHeading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_sliderHeading_font_size',
			'type'    => 'number'
		));

		// slider text typography
		$wp_customize->add_setting( 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'label' => __('Slide Text Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slidertext_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slidertext_color', array(
			'label' => __('Slider Text Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slidertext_color',
		)));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slidertext_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slidertext_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slidertext_font_size',
			'type'    => 'number'
		));

		// slider button typography
		$wp_customize->add_setting( 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'label' => __('Slide Button Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor', array(
			'label' => __('Button Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor',
		)));

		$wp_customize->add_setting('ts_demo_importer_button_fontfamily',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		 ));
		$wp_customize->add_control(
			'ts_demo_importer_button_fontfamily', array(
			'section'  => 'ts_demo_importer_slider_section',
			'label'    => __( 'Button Text Fonts','ts-demo-importer'),
			'type'     => 'select',
			'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_button_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_button_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_button_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'label' => __('Button Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'label' => __('Button Hover Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor_hover', array(
			'label' => __('Button Hover Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor_hover',
		)));

		// slider nav
		$wp_customize->add_setting( 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'label' => __('Slide Nav Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one_color', array(
			'label' => 'Slider Nav Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one', array(
			'label' => 'Slider Nav Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'label' => 'Slider Nav Hover Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_bgcolor',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_color', array(
			'label' => 'Slider Nav Hover Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_arrows',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
		$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_arrows',
		 array(
				'label' => esc_html__( 'Show/Hide Slider Nav', 'ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_dots',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
		$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_dots',
		 array(
				'label' => esc_html__( 'Show/Hide Slider Dots', 'ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section'
		)));
	}elseif ( $template == 'ts-conference' ) {
		$wp_customize->add_section('ts_demo_importer_slider_section',array(
			'title'	=> __('Slider Settings','ts-demo-importer'),
			'priority'	=> null,
			'panel' => 'ts_demo_importer_panel_id',
		));

		$number = get_theme_mod('ts_demo_importer_slide_number');

		$ts_demo_importer_slider_section_settings = array();
		$ts_demo_importer_slide_background_type = array();
		$ts_demo_importer_slide_vide_link = array();
		$ts_demo_importer_slide_background_color_one = array();
		$ts_demo_importer_slide_background_color_two = array();
		$ts_demo_importer_slide_height = array();
		$ts_demo_importer_slide_image = array();
		$ts_demo_importer_slide_image_alt_text = array();
		$ts_demo_importer_slide_small_heading = array();
		$ts_demo_importer_slide_heading = array();
		$ts_demo_importer_slide_text = array();
		$ts_demo_importer_slide_btn_one_text = array();
		$ts_demo_importer_slide_btn_one_url = array();
		$ts_demo_importer_slide_btn_two_text = array();
		$ts_demo_importer_slide_btn_two_url = array();


		for($i=1; $i<=$number ;$i++){
			$ts_demo_importer_slider_section_settings[$i] = 'ts_demo_importer_slider_section_settings'.$i;
			$ts_demo_importer_slide_background_type[$i] = 'ts_demo_importer_slide_background_type'.$i;
			$ts_demo_importer_slide_vide_link[$i] = 'ts_demo_importer_slide_vide_link'.$i;
			$ts_demo_importer_slide_background_color_one[$i] = 'ts_demo_importer_slide_background_color_one'.$i;
			$ts_demo_importer_slide_background_color_two[$i] = 'ts_demo_importer_slide_background_color_two'.$i;
			$ts_demo_importer_slide_height[$i] = 'ts_demo_importer_slide_height'.$i;

			$ts_demo_importer_slide_image[$i] = 'ts_demo_importer_slide_image'.$i;
			$ts_demo_importer_slide_image_alt_text[$i] = 'ts_demo_importer_slide_image_alt_text'.$i;
			$ts_demo_importer_slide_small_heading[$i] = 'ts_demo_importer_slide_small_heading'.$i;
			$ts_demo_importer_slide_heading[$i] = 'ts_demo_importer_slide_heading'.$i;
			$ts_demo_importer_slide_text[$i] = 'ts_demo_importer_slide_text'.$i;
			$ts_demo_importer_slide_btn_one_text[$i] = 'ts_demo_importer_slide_btn_one_text'.$i;
			$ts_demo_importer_slide_btn_one_url[$i] = 'ts_demo_importer_slide_btn_one_url'.$i;
			$ts_demo_importer_slide_btn_two_text[$i] = 'ts_demo_importer_slide_btn_two_text'.$i;
			$ts_demo_importer_slide_btn_two_url[$i] = 'ts_demo_importer_slide_btn_two_url'.$i;
		}

		$arr1 = array(
										'ts_demo_importer_slider_enabledisable',
										'ts_demo_importer_slide_number',
										'ts_demo_importer_slide_delay',
										'ts_demo_importer_slide_remove_fade',
										'ts_demo_importer_slider_section_content_option',
										'ts_demo_importer_our_records_content_settings',
										'ts_demo_importer_slide_overlay',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_our_records_carousel_loop',
										'ts_demo_importer_our_records_carousel_speed',
										'ts_demo_importer_our_records_carousel_dots',
										'ts_demo_importer_our_records_carousel_nav',
										'ts_demo_importer_our_records_number',
										'ts_demo_importer_slider_arrows',
										'ts_demo_importer_slider_dots',
										'ts_demo_importer_slider_section_content_spacing',
										'ts_demo_importer_slider_section_slider_top_spacing',
										'ts_demo_importer_slider_section_slider_bottom_spacing',
										'ts_demo_importer_slider_section_slider_left_spacing',
										'ts_demo_importer_slider_section_slider_right_spacing',
										'ts_demo_importer_slide_below_heading'
									);

		$arr_final = array_merge($arr1, $ts_demo_importer_slider_section_settings, $ts_demo_importer_slide_background_type, $ts_demo_importer_slide_vide_link, $ts_demo_importer_slide_background_color_one, $ts_demo_importer_slide_background_color_two, $ts_demo_importer_slide_height, $ts_demo_importer_slide_image, $ts_demo_importer_slide_image_alt_text, $ts_demo_importer_slide_heading, $ts_demo_importer_slide_small_heading, $ts_demo_importer_slide_text, $ts_demo_importer_slide_btn_one_text, $ts_demo_importer_slide_btn_one_url, $ts_demo_importer_slide_btn_two_text, $ts_demo_importer_slide_btn_two_url);

		$wp_customize->add_setting('ts_demo_importer_slider_tab_settings', array(
				'sanitize_callback' => 'wp_kses_post',
		 ));

			$wp_customize->add_control(new ts_demo_importer_Tab_Control($wp_customize, 'ts_demo_importer_slider_tab_settings', array(
				'section' => 'ts_demo_importer_slider_section',
				'buttons' => array(
						array(
								'name' => esc_html__('Content', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-welcome-write-blog',
								'fields' => $arr_final,

						),
						array(
								'name' => esc_html__('Style', 'ts-demo-importer'),
								'icon' => 'dashicons dashicons-art',
								'fields' => array(
										'ts_demo_importer_slide_content_color_settings',
										'ts_demo_importer_slider_heading_ct_pallete',
										'ts_demo_importer_sliderHeading_color',
										'ts_demo_importer_sliderHeading_font_family',
										'ts_demo_importer_sliderHeading_font_size',
										'ts_demo_importer_slider_text_ct_pallete',
										'ts_demo_importer_slidertext_color',
										'ts_demo_importer_slidertext_font_family',
										'ts_demo_importer_slidertext_font_size',
										'ts_demo_importer_slider_button1_ct_pallete',
										'ts_demo_importer_slide_buttoncolor',
										'ts_demo_importer_button_fontfamily',
										'ts_demo_importer_button_font_size',
										'ts_demo_importer_slide_button_first_bgcolor_one',
										'ts_demo_importer_slide_button_first_bgcolor_one_hover',
										'ts_demo_importer_slide_buttoncolor_hover',
										'ts_demo_importer_slide_button_first_bgcolor_two',
										'ts_demo_importer_slide_button_first_bgcolor_two_hover',
										'ts_demo_importer_slide_button_twocolor_hover',
										'ts_demo_importer_slider_nav_ct_pallete',
										'ts_demo_importer_slide_nav_one_color',
										'ts_demo_importer_slide_nav_one',
										'ts_demo_importer_slide_nav_hover_bgcolor',
										'ts_demo_importer_slide_nav_hover_color',
										'ts_demo_importer_slide_below_heading_ct_pallete',
										'ts_demo_importer_slide_below_heading_color',
										'ts_demo_importer_slide_below_heading_font_family',
										'ts_demo_importer_slide_below_heading_font_size',
										'ts_demo_importer_slide_below_bg_color_one',
										'ts_demo_importer_slide_below_bg_color_two'
								),
						)
				),
		)));

		$wp_customize->add_setting('ts_demo_importer_slider_enabledisable',array(
			'default'=> 'Enable',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control('ts_demo_importer_slider_enabledisable', array(
			'type' => 'radio',
			'label' => 'Do you want this section',
			'section' => 'ts_demo_importer_slider_section',
			'choices' => array(
				'Enable' => 'Enable',
				'Disable' => 'Disable'
			),
		));
		$wp_customize->selective_refresh->add_partial( 'ts_demo_importer_slider_enabledisable', array(
			'selector' => '.slider-box .slider-heading',
			'render_callback' => 'ts_demo_importer_customize_partial_ts_demo_importer_slider_enabledisable',
		) );

		$wp_customize->add_setting('ts_demo_importer_slide_number',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_number',array(
			'label'	=> __('Number of slides to show','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'type'		=> 'number'
		));

		$count =  get_theme_mod('ts_demo_importer_slide_number');
		for($i=1; $i<=$count; $i++) {

			$wp_customize->add_setting( 'ts_demo_importer_slider_section_settings'.$i,
			array(
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'ts_demo_importer_text_sanitization'
			));
			$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_section_settings'.$i,
			array(
				'label' => __('Slider Settings ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_type'. $i, array(
				'default' => 'slide_type_image',
				'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
			));
			$wp_customize->add_control('ts_demo_importer_slide_background_type'. $i, array(
				'type' => 'radio',
				'label' => __('Slide Background Type ', 'ts-demo-importer'). $i,
				'section' => 'ts_demo_importer_slider_section',
				'choices' => array(
					'slide_type_image' => __('Image', 'ts-demo-importer'),
					'slide_type_video' => __('Video', 'ts-demo-importer'),
					'slide_type_gradient' => __('Gradient', 'ts-demo-importer')
				)
			));

			$wp_customize->add_setting('ts_demo_importer_slide_vide_link' . $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field'
			));
			$wp_customize->add_control('ts_demo_importer_slide_vide_link' . $i, array(
				'label' => __('Slide Video Embed Link', 'ts-demo-importer') . $i,
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Video". Note: Upload video in Media and add link here', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_vide_link' . $i,
				'type' => 'url',
				'active_callback' => 'ts_demo_importer_slider_video'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_one'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_one'. $i, array(
				'label' => __('Slider Background Color one', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_one'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'

			)));

			$wp_customize->add_setting('ts_demo_importer_slide_background_color_two'. $i, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_hex_color'
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ts_demo_importer_slide_background_color_two'. $i, array(
				'label' => __('Slider Background Color two', 'ts-demo-importer'),
				'description' => __('For this option to enable first you have to select "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_background_color_two'. $i,
				'active_callback' => 'ts_demo_importer_slider_gradient'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_height'. $i, array(
				'default' => __('600', 'ts-demo-importer'),
				'sanitize_callback' => 'sanitize_text_field'
			));
			$wp_customize->add_control('ts_demo_importer_slide_height'. $i, array(
				'label' => __('Slide Height', 'ts-demo-importer'). $i,
				'description' => __('This setting will only work for "Slide Background Type" as "Gradient" ', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_height'. $i,
				'type' => 'number',
				'active_callback' => 'ts_demo_importer_slider_gradient'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_image'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ts_demo_importer_slide_image'.$i,
			array(
				'label' => __('Slider Image ','ts-demo-importer'). $i,
				'description' => __('Dimension 1500px * 700px (Image will only display if slide type is "Image")', 'ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'settings' => 'ts_demo_importer_slide_image'.$i,
				'active_callback' => 'ts_demo_importer_slider_type_image'
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_image_alt_text'.$i,array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_image_alt_text'.$i,array(
				'label' => __('Slider Image ALT Text ','ts-demo-importer').$i,
				'description' => __('This is image text for image alt attribute.This text is only for coding purpose.','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting' => 'ts_demo_importer_slide_image_alt_text'.$i,
				'type' => 'text',
				'active_callback' => 'ts_demo_importer_slider_type_image'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_small_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_small_heading'.$i,array(
				'label' => __('Slide Small Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_small_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_heading'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_text_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_heading'.$i,array(
				'label' => __('Slide Main Heading ','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_heading'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_text'.$i,array(
				'default'   => '',
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'wp_kses_post'
			));
			$wp_customize->add_control(new ts_demo_importer_Editor_Control($wp_customize,'ts_demo_importer_slide_text'.$i,array(
				'label' => __('Slide Text','ts-demo-importer').$i,
				'description' => __('Add Text','ts-demo-importer').$i,
				'section' => 'ts_demo_importer_slider_section',
				'setting'   => 'ts_demo_importer_slide_text'.$i,
			)));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_text'.$i,array(
				'label' => __('Slider Button One Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_one_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_one_url'.$i,array(
				'label' => __('Slider Button One Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_one_url'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_two_text'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'sanitize_textarea_field',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_two_text'.$i,array(
				'label' => __('Slider Button Two Text','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_two_text'.$i,
				'type'	=> 'text'
			));

			$wp_customize->add_setting('ts_demo_importer_slide_btn_two_url'.$i,array(
				'default'	=> '',
				'sanitize_callback'	=> 'esc_url_raw',
			));
			$wp_customize->add_control('ts_demo_importer_slide_btn_two_url'.$i,array(
				'label' => __('Slider Button Two Url','ts-demo-importer'),
				'section' => 'ts_demo_importer_slider_section',
				'setting'	=> 'ts_demo_importer_slide_btn_two_url'.$i,
				'type'	=> 'text'
			));
		}

		// Other Settings
		$wp_customize->add_setting('ts_demo_importer_slide_delay',array(
			'default'	=> '1000',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_delay',array(
			'label'	=> __('Slide Delay','ts-demo-importer'),
			'section'	=> 'ts_demo_importer_slider_section',
			'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'ts-demo-importer'),
			'type'		=> 'number'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_remove_fade',
			 array(
					'default' => 1,
					'transport' => 'refresh',
					'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			 )
			);
			$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slide_remove_fade',
				 array(
						'label' => esc_html__( 'Fade Effect', 'ts-demo-importer' ),
						'section' => 'ts_demo_importer_slider_section'
				 )
			));

		$wp_customize->add_setting('ts_demo_importer_slider_section_content_option',array(
					'default' => __('Left','ts-demo-importer'),
					'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(new ts_demo_importer_Image_Radio_Control($wp_customize, 'ts_demo_importer_slider_section_content_option', array(
					'type' => 'select',
					'label' => __('Slider Content Layouts','ts-demo-importer'),
					'section' => 'ts_demo_importer_slider_section',
					'choices' => array(
							'Left' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content1.png',
							'Center' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content2.png',
							'Right' => TS_DEMO_IMPOTER_URL.'/assets/images/slider-content3.png',
			))));
		$wp_customize->add_setting('ts_demo_importer_slider_section_content_spacing',array(
			'sanitize_callback'	=> 'esc_html'
		));
		$wp_customize->add_control('ts_demo_importer_slider_section_content_spacing',array(
			'label'	=> esc_html__('Slider Content Spacing','ts-demo-importer'),
			'description'	=> __('Add value in percentage here.','ts-demo-importer'),
			'section'=> 'ts_demo_importer_slider_section',
		));

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_top_spacing', array(
			'label' => esc_html__( 'Top','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_bottom_spacing', array(
			'label' => esc_html__( 'Bottom','ts-demo-importer' ),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_left_spacing', array(
			'label' => esc_html__( 'Left','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'default'  => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'ts_demo_importer_slider_section_slider_right_spacing', array(
			'label' => esc_html__('Right','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'type'  => 'number',
			'input_attrs' => array(
				'step' => 1,
				'min' => 0,
				'max' => 100,
			),
		) );

		$wp_customize->add_setting( 'ts_demo_importer_slide_overlay',
				 array(
						'default' => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'ts_demo_importer_hex_rgba_sanitization'
				 )
		);

		$wp_customize->add_control( new ts_demo_importer_Customize_Alpha_Color_Control( $wp_customize, 'ts_demo_importer_slide_overlay',
		 array(
				'label' => __( 'Slide Overlay','ts-demo-importer' ),
				'description' => __( 'Use RGBA Color option','ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section',
				'show_opacity' => true,
				'palette' => array(
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

		$wp_customize->add_setting( 'ts_demo_importer_slide_content_color_settings',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_content_color_settings',
		array(
			'label' => __('Section Color & Typography','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		// slider main heading
		$wp_customize->add_setting( 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_heading_ct_pallete',
		array(
			'label' => __('Slide Heading Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_sliderHeading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_sliderHeading_color', array(
			'label' => __('Slider Heading Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_sliderHeading_color',
		)));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_sliderHeading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Heading Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_sliderHeading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_sliderHeading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_sliderHeading_font_size',
			'type'    => 'number'
		));

		// slider text typography
		$wp_customize->add_setting( 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_text_ct_pallete',
		array(
			'label' => __('Slide Text Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slidertext_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slidertext_color', array(
			'label' => __('Slider Text Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slidertext_color',
		)));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slidertext_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Slider Text Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slidertext_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slidertext_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slidertext_font_size',
			'type'    => 'number'
		));

		// slider button typography
		$wp_customize->add_setting( 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_button1_ct_pallete',
		array(
			'label' => __('Slide Button Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor', array(
			'label' => __('Button Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor',
		)));

		$wp_customize->add_setting('ts_demo_importer_button_fontfamily',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		 ));
		$wp_customize->add_control(
			'ts_demo_importer_button_fontfamily', array(
			'section'  => 'ts_demo_importer_slider_section',
			'label'    => __( 'Button Text Fonts','ts-demo-importer'),
			'type'     => 'select',
			'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_button_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_button_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_button_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one', array(
			'label' => __('Button Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_button_first_bgcolor_one_hover', array(
			'label' => __('Button Hover Background Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_button_first_bgcolor_one_hover',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_buttoncolor_hover', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_buttoncolor_hover', array(
			'label' => __('Button Hover Text Color','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_buttoncolor_hover',
		)));

		// slider nav
		$wp_customize->add_setting( 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slider_nav_ct_pallete',
		array(
			'label' => __('Slide Nav Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one_color', array(
			'label' => 'Slider Nav Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_one', array(
			'label' => 'Slider Nav Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_bgcolor', array(
			'label' => 'Slider Nav Hover Background Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_bgcolor',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_nav_hover_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_nav_hover_color', array(
			'label' => 'Slider Nav Hover Color',
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_nav_hover_color',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_arrows',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
		$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_arrows',
		 array(
				'label' => esc_html__( 'Show/Hide Slider Nav', 'ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slider_dots',
		 array(
				'default' => 1,
				'transport' => 'refresh',
				'sanitize_callback' => 'ts_demo_importer_switch_sanitization'
			));
		$wp_customize->add_control( new ts_demo_importer_Toggle_Switch_Custom_control( $wp_customize, 'ts_demo_importer_slider_dots',
		 array(
				'label' => esc_html__( 'Show/Hide Slider Dots', 'ts-demo-importer' ),
				'section' => 'ts_demo_importer_slider_section'
		)));

		//  below slider settings
		$wp_customize->add_setting( 'ts_demo_importer_slide_below_heading_ct_pallete',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'ts_demo_importer_text_sanitization'
		));
		$wp_customize->add_control( new TS_Themes_Seperator_custom_Control( $wp_customize, 'ts_demo_importer_slide_below_heading_ct_pallete',
		array(
			'label' => __('Slider Below Typography ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section'
		)));

		$wp_customize->add_setting('ts_demo_importer_slide_below_heading',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));
		$wp_customize->add_control('ts_demo_importer_slide_below_heading',array(
			'label' => __('Below Slider Heading ','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting'	=> 'ts_demo_importer_slide_below_heading',
			'type'	=> 'text'
		));
		$wp_customize->add_setting( 'ts_demo_importer_slide_below_heading_color', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_below_heading_color', array(
			'label' => __('Color', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_below_heading_color',
		)));
		$wp_customize->add_setting('ts_demo_importer_slide_below_heading_font_family',array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'ts_demo_importer_sanitize_choices'
		));
		$wp_customize->add_control(
				'ts_demo_importer_slide_below_heading_font_family', array(
				'section'  => 'ts_demo_importer_slider_section',
				'label'    => __( 'Fonts','ts-demo-importer'),
				'type'     => 'select',
				'choices'  => $font_array,
		));

		$wp_customize->add_setting('ts_demo_importer_slide_below_heading_font_size',array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ts_demo_importer_slide_below_heading_font_size',array(
			'label' => __('Font Size','ts-demo-importer'),
			'description' => __('Add font size in px','ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'setting' => 'ts_demo_importer_slide_below_heading_font_size',
			'type'    => 'number'
		));

		$wp_customize->add_setting( 'ts_demo_importer_slide_below_bg_color_one', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_below_bg_color_one', array(
			'label' => __('Background Color One', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_below_bg_color_one',
		)));

		$wp_customize->add_setting( 'ts_demo_importer_slide_below_bg_color_two', array(
			'default' => '',
			'sanitize_callback'	=> 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ts_demo_importer_slide_below_bg_color_two', array(
			'label' => __('Background Color Two', 'ts-demo-importer'),
			'section' => 'ts_demo_importer_slider_section',
			'settings' => 'ts_demo_importer_slide_below_bg_color_two',
		)));

	}
