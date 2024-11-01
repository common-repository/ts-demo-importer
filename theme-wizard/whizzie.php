<?php
/**
 * Wizard
 *
 * @package Tdi_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */


class Tdi_Whizzie {

 protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $plugin_name = '';
	protected $plugin_title = '';

	/** @var string Wizard page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';

	/** @var array Wizard steps set by user. */
	protected $config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tdi_tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tdi_tgmpa_menu_slug = 'tdi-tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tdi_tgmpa_url = 'themes.php?page=tdi-tgmpa-install-plugins';

	// Where to find the widget.wie file
	protected $widget_file_url = '';

	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();

    $this->plugin_slug = plugin_basename( __DIR__ );
		$this->plugin_version = '1.0';
		$this->cache_key = 'tsdi_plugin_update';
		$this->cache_allowed = false;
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {

		require_once trailingslashit( TDI_WHIZZIE_DIR ) . 'tgm/class-tdi-tgm-plugin-activation.php';
		require_once trailingslashit( TDI_WHIZZIE_DIR ) . 'tgm/tgm.php';

		require_once trailingslashit( TDI_WHIZZIE_DIR ) . 'widgets/class-ts-widget-importer.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}

		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}

		if( isset( $config['page_heading'] ) ) {
			$this->page_heading = esc_attr( $config['page_heading'] );
		}


		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( TS_DEMO_IMPOTER_URL . $relative_url );
    $current_plugin			=	get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE );
		$this->plugin_name =	strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_plugin[ 'Name' ] ) );
		$this->page_slug = apply_filters( $this->plugin_name . '_theme_setup_wizard_page_slug', $this->plugin_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->plugin_name . '_theme_setup_wizard_parent_slug', '' );

    $template = wp_get_theme()->get( 'TextDomain' );
    if ( $template == 'multi-advance' ) {
      $this->widget_file_url = trailingslashit( TDI_WHIZZIE_DIR ) . 'widgets/ts-demo-importer-multi-advance-widgets.wie';
    } elseif ( $template == 'advance-marketing-agency' ) {
      $this->widget_file_url = trailingslashit( TDI_WHIZZIE_DIR ) . 'widgets/ts-demo-importer-advance-marketing-agency-widgets.wie';
    } elseif ( $template == 'advance-consultancy' ) {
      $this->widget_file_url = trailingslashit( TDI_WHIZZIE_DIR ) . 'widgets/ts-demo-importer-advance-consultancy-widgets.wie';
    }


	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {

		add_action( 'after_switch_theme', array( $this, 'redirect_to_wizard' ) );
		if ( class_exists( 'TDI_TGM_Plugin_Activation' ) && isset( $GLOBALS['tdi_tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tdi_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tdi_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tdi_tgmpa_load', array( $this, 'tdi_tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_ts_demo_importer_setup_plugins', array( $this, 'ts_demo_importer_setup_plugins' ) );
    add_action( 'wp_ajax_activate_tsdi_license', array( $this, 'tsdi_license_activate' ) );
    add_action( 'wp_ajax_tsdi_activation_status', array( $this, 'tsdi_activation_status' ) );
    add_action( 'wp_ajax_tsdi_install_plugin_hook', array( $this, 'tsdi_install_plugin_hook' ) );
    add_action( 'wp_ajax_ts_demo_importer_setup_themes', array( $this, 'ts_demo_importer_setup_themes' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );

    $ts_demo_importer_license_key = get_option( str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key' );
    if ( !$ts_demo_importer_license_key ) {
      add_action( 'admin_notices', array( $this, 'tsdi_admin_notice_pro_plugin' ) );
    } elseif (!empty($ts_demo_importer_license_key) && $ts_demo_importer_license_key['license_key'] == '') {
      add_action( 'admin_notices', array( $this, 'tsdi_admin_notice_pro_plugin' ) );
    }

	//	add_action( 'init', array( $this, 'setup_widgets') );
	//	$this->setup_widgets();
	//	$widgets = get_option( 'sidebars_widgets' );
	//	print_r( $widgets );
	}

  function tsdi_admin_notice_pro_plugin(){
    $tsdi_pro_theme_plugin_action_url = admin_url( 'themes.php?page=ts-demoimporter-license' );
    ?>
    <div id="tsdi-admin-notice" class="notice notice-info is-dismissible">
      <p>
        <?php
        printf(
          '%s <strong>%s</strong> %s <a href="%s" target="_blank">Click Here</a>.',
          __( 'To activate premium feature get our', 'ts-demo-importer' ),
          __( 'TS Demo Importer Addon', 'ts-demo-importer' ),
          __( 'plugin', 'ts-demo-importer' ),
          __( 'https://www.themeshopy.com/themes/creative-wordpress-theme/', 'ts-demo-importer' )
        );
        ?>
      </p>
      <p>
        <a href="<?php echo esc_url( $tsdi_pro_theme_plugin_action_url ); ?>" class="button-primary">
          <?php esc_html_e( 'Enter License Key', 'ts-demo-importer' ); ?>
        </a>
      </p>
    </div>
    <?php
  }

  public function tsdi_license_activate() {
    if ( !isset( $_POST['add_on_key'] ) ) {
      wp_send_json(
    		array(
    			'status'	=> false,
    			'msg' 		=> __( 'Please Provide The KEY!', 'ts-demo-importer' )
    		)
    	);
      exit;
    }


    $tsdi_post_add_on_key  = sanitize_text_field( $_POST['add_on_key'] );

    $tsdi_activate_license_endpoint = TS_DEMO_IMPOTER_LICENSE_API_ENDPOINT . 'ibtana_client_activate_premium_theme';

    $tsdi_response = wp_remote_post( $tsdi_activate_license_endpoint , array(
      'method'      => 'POST',
      'body'        => wp_json_encode( array(
          'theme_license_key'          =>  $tsdi_post_add_on_key,
          'site_url'            =>  site_url(),
          'theme_text_domain'  =>  get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain']
      ) ),
      'headers'     => [
          'Content-Type' => 'application/json',
      ],
      'data_format' => 'body'
    ) );

    if ( is_wp_error( $tsdi_response ) ) {
      wp_send_json(
    		array(
    			'status'	=> false,
    			'msg' 		=> __( 'Something Went Wrong!', 'ts-demo-importer' )
    		)
    	);
      exit;
    } else {
      $tsdi_response     = wp_remote_retrieve_body( $tsdi_response );

      $tsdi_api_response = json_decode( $tsdi_response, true );


    	$tsdi_key = str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key';

      if ( $tsdi_api_response['status'] == true ) {
        update_option( $tsdi_key, [
          'license_key'     			=>	$tsdi_post_add_on_key,
          'license_status'  			=>	true,
    			'plan_expiration_date'	=>	isset( $tsdi_api_response['dates_with_diff_info']['plan_expiration_date'] ) ? $tsdi_api_response['dates_with_diff_info']['plan_expiration_date'] : '',
    			'is_envato_key'					=>	false
        ] );
        wp_send_json(
    			array(
    				'status'	=> true,
    				'msg' 		=> __( $tsdi_api_response['msg'], 'ts-demo-importer' )
    			)
    		);
        exit;
      } else {
        update_option( $tsdi_key, [
          'license_key'     => '',
          'license_status'  => false
        ]);
        wp_send_json(
    			array(
    				'status'	=>	false,
    				'msg'			=>	__( $tsdi_api_response['msg'], 'ts-demo-importer' )
    			)
    		);
        exit;
      }
    }
  }

  function tsdi_install_plugin_hook(){

    if ( ! current_user_can( 'install_plugins' ) || ! current_user_can( 'activate_plugins' ) ) {
  		exit;
  	}

    $plugins = array(
      array('name' => 'TS Demo Importer Addon', 'path' => 'https://themeshopy.com/demo/bb_theme_zips/05_04_22_ts_demo_importer_addon/ts-demo-importer-addon.zip', 'install' => 'ts-demo-importer-addon/index.php')
    );

    $args = array(
      'path' => ABSPATH.'wp-content/plugins/',
      'preserve_zip' => false
    );

    foreach($plugins as $plugin){

      if (!file_exists( TS_DEMO_IMPOTER_WP_PLUGINS_DIR . $plugin['install'] )) {

        $this->tsdi_plugin_download($plugin['path'], $args['path'].$plugin['name'].'.zip');
        $this->tsdi_plugin_unpack($args, $args['path'].$plugin['name'].'.zip');
        $this->tsdi_plugin_activate($plugin['install']);

      } else {

        $this->tsdi_plugin_activate($plugin['install']);
      }
    }
  }

  function tsdi_plugin_download($url, $path) {
    $response	=	wp_remote_get( $url );
  	if ( !is_wp_error( $response ) ) {
  		$data	=	wp_remote_retrieve_body( $response );
  		if( file_put_contents( $path, $data ) ) {
  			return true;
  		} else {
  			return false;
  		}
  	} else {
  		return false;
  	}
  }

  function tsdi_plugin_unpack($args, $target){

    global $wp_filesystem;
    require_once ABSPATH . '/wp-admin/includes/file.php';
    WP_Filesystem();

    $plugin_path = str_replace( ABSPATH, $wp_filesystem->abspath(), TS_DEMO_IMPOTER_DIR ); /* get remote system absolute path */

  	$plugin_path = str_replace( "ts-demo-importer/", "", $plugin_path );

  	/* Acceptable way to use the function */
  	$file	=	$target;
  	$to		=	$plugin_path;

  	$result = unzip_file( $file, $to );

  	if( $result !== true ) {
  		return false;
  	} else {
  		wp_delete_file( $file );
  		return true;
  	}
  }

  function tsdi_plugin_activate($installer){

    wp_cache_flush();
  	$plugin = plugin_basename( trim( $installer ) );
  	$activate_plugin = activate_plugin( $plugin );

    return true;
  }

  function tsdi_activation_status() {
    $ts_demo_importer_license_key = get_option( str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key' );

    $tsdi_license_key 		=	'';
    if ( $ts_demo_importer_license_key ) {
      if ( isset( $ts_demo_importer_license_key['license_key'] ) && isset( $ts_demo_importer_license_key['license_status'] ) ) {
        if ( $ts_demo_importer_license_key['license_key'] ) {
          $tsdi_license_key    = $ts_demo_importer_license_key['license_key'];
        }
      }
    }

    if ( $tsdi_license_key == '' ) {
      wp_send_json( array( 'status' => false ) );
      exit;
    }

    $request_body = array(
      'theme_license_key'          =>  $tsdi_license_key,
      'site_url'            =>  site_url(),
      'theme_text_domain'  =>  get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain']
    );

    $tsdi_activation_status_endpoint = TS_DEMO_IMPOTER_LICENSE_API_ENDPOINT . 'ibtana_client_premium_theme_check_activation_status';

    $tsdi_response = wp_remote_post( $tsdi_activation_status_endpoint, array(
      'method'      => 'POST',
      'body'        => wp_json_encode( $request_body ),
      'headers'     => [
        'Content-Type' => 'application/json',
      ],
      'data_format' => 'body'
    ));

    if ( is_wp_error( $tsdi_response ) ) {
      wp_send_json(
        array(
          'status'	=>	false,
          'msg'			=>	__( 'Something Went Wrong!', 'ts-demo-importer' )
        )
      );
      exit;
    } else {
      $tsdi_response			=	wp_remote_retrieve_body( $tsdi_response );
      $tsdi_api_response	=	json_decode( $tsdi_response, true );

      if ( $tsdi_api_response['status'] == true ) {

        $tsdi_add_on_license_key = get_option( $tsdi_key );
        $tsdi_add_on_license_key['license_status']	=	true;

        update_option( $tsdi_key, $tsdi_add_on_license_key );

        if ( $tsdi_api_response['msg_type'] === 'before_expiration_message' ) {
          wp_send_json( array(
            'status'					=>	true,
            'msg'							=>	$tsdi_api_response['msg'],
            'display_string'	=>	$tsdi_api_response['display_string']
          ) );
        } else {
          wp_send_json(
            array(
              'status'	=>	true,
              'msg'			=>	__( $tsdi_api_response['msg'], 'ts-demo-importer' )
            )
          );
          exit;
        }
      } else {

        // Update the template limit here
        $tsdi_key = str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key';
        $tsdi_add_on_license_key = get_option( $tsdi_key );

        if ( $tsdi_add_on_license_key ) {

          if ( isset( $tsdi_api_response['is_suspended'] ) ) {
            $tsdi_add_on_license_key['is_suspended']	=	$tsdi_api_response['is_suspended'];
          }

          if ( isset( $tsdi_api_response['is_expired'] ) ) {
            $tsdi_add_on_license_key['is_expired']	=	$tsdi_api_response['is_expired'];
          }

          $tsdi_add_on_license_key['license_status']	=	false;

          update_option( $tsdi_key, $tsdi_add_on_license_key );
        }
        // Update the template limit here finished

        wp_send_json(
          array(
            'status'	=>	false,
            'msg'			=>	__( $tsdi_api_response['msg'], 'ts-demo-importer' )
          )
        );
        exit;
      }
    }
  }

	public function redirect_to_wizard() {
		global $pagenow;
		if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
			wp_redirect( admin_url( 'themes.php?page=' . esc_attr( $this->page_slug ) ) );
		}
	}

	public function enqueue_scripts() {
		wp_register_script( 'theme-wizard-script', TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ), TS_DEMO_IMPOTER );
		wp_enqueue_style( 'theme-wizard-style', TS_DEMO_IMPOTER_URL. 'theme-wizard/assets/css/theme-wizard-style.css' , array(), TS_DEMO_IMPOTER);
		wp_localize_script(
			'theme-wizard-script',
			'ts_demo_importer_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
        'admin_url'			=>	admin_url(),
				'wpnonce' 		=> wp_create_nonce( 'ts_demo_importer_whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'ts-demo-importer' )

			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tdi_tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tdi_tgmpa_instance() {
		$this->tdi_tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tdi_tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tdi_tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tdi_tgmpa_url() {
		$this->tdi_tgmpa_menu_slug = ( property_exists( $this->tdi_tgmpa_instance, 'menu' ) ) ? $this->tdi_tgmpa_instance->menu : $this->tdi_tgmpa_menu_slug;
		$this->tdi_tgmpa_menu_slug = apply_filters( $this->plugin_name . '_theme_setup_wizard_tdi_tgmpa_menu_slug', $this->tdi_tgmpa_menu_slug );
		$tdi_tgmpa_parent_slug = ( property_exists( $this->tdi_tgmpa_instance, 'parent_slug' ) && $this->tdi_tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tdi_tgmpa_url = apply_filters( $this->plugin_name . '_theme_setup_wizard_tdi_tgmpa_url', $tdi_tgmpa_parent_slug . '?page=' . $this->tdi_tgmpa_menu_slug );
	}

	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'wizard_page' ) );
    add_theme_page( esc_html('License Activation'), esc_html('License Activation'), 'manage_options', 'ts-demoimporter-license', array( $this, 'license_page' ) );
	}

	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() {
		tdi_tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TDI_TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tdi_tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php printf( '<h1>%s</h1>', esc_html( $this->page_heading) );
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'ts-demo-importer' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}



            // importing multiple home page
            if( isset( $step['button_text'] ) && $step['button_text'] && isset($step['multiple']) ) {



              echo "<div class='multiple-home-page-imports'>";
              foreach ( $step['multiple'] as $import ) {
                $button_html = '<div class="button-wrap">
                  <a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s" data-slug="'  . $import['slug'] . '">
                    <img src="'.$import['card_image'].'" />
                    <p class="themes-name"> %s </p>
                  </a>
                </div>';

                printf(
                  $button_html,
                  esc_attr( $step['callback'] ),
                  esc_attr( $step['id'] ),
                  esc_html( $import['card_text'] )
                );
              }
              echo "</div>";


            } elseif( isset( $step['button_text'] ) && $step['button_text'] ) {
              printf(
                '<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
                esc_attr( $step['callback'] ),
                esc_attr( $step['id'] ),
                esc_html( $step['button_text'] )
              );
            }


						// The skip button
						if( isset( $step['can_skip'] ) && $step['can_skip'] ) {
							printf(
								'<div class="button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								'do_next_step',
								esc_attr( $step['id'] ),
								__( 'Skip', 'ts-demo-importer' )
							);
						}

					echo '</li>';
				}
				echo '</ul>';
				echo '<ul class="whizzie-nav">';
					foreach( $steps as $step ) {
						if( isset( $step['icon'] ) && $step['icon'] ) {
							echo '<li class="nav-step-' . esc_attr( $step['id'] ) . '"><span class="dashicons dashicons-' . esc_attr( $step['icon'] ) . '"></span></li>';
						}
					}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>


			</div><!-- .whizzie-wrap -->

			<div class="other_content">
				<div class="contact-col">
			        <h3>Documentation</h3>
			        <p>Read the detailed documentation of the theme. The documentation contains all the necessary information required to set up the Total theme.</p>
			        <a class="button button-primary" target="_blank" href="#">Read Full Documentation</a>
			    </div>
			    <div class="contact-col">
			        <h3>Create Support Tickets</h3>
			        <p>Still, having problems after reading all the documentation? No Problem!! Please create a support ticket. Our dedicated support team will help you to solve your problem.</p>
			        <a class="button button-primary" target="_blank" href="">Create Support Tickets</a>
			    </div>
			</div>

		</div><!-- .wrap -->
	<?php }

  // License Key Activation Code START
  public function license_page(){

    $license_messege     = '';
    $tsdi_license_key    = '';
    $tsdi_license_status = false;

    $tsdi_license_key_option = get_option( str_replace( '-', '_', get_plugin_data( TS_DEMO_IMPOTER_EXT_FILE )['TextDomain'] ) . '_license_key' );
    if ( $tsdi_license_key_option ) {
      if (
    		isset( $tsdi_license_key_option['license_key'] ) &&
    		isset( $tsdi_license_key_option['license_status'] )

    	) {
        if (
    			$tsdi_license_key_option['license_key']

    		) {
    			$is_envato_key = false;

    			if ( !$is_envato_key ) {
    				$tsdi_license_key    = $tsdi_license_key_option['license_key'];
    	      $tsdi_license_status = $tsdi_license_key_option['license_status'];


    				// Remaining Days Calculation
    				$current_date            		= date( 'Y-m-d' );
    				$current_date_obj        		= date_create( $current_date );

    				$plan_expiration_date				=	$tsdi_license_key_option['plan_expiration_date'];
    				$plan_expiration_date_obj		=	date_create( $plan_expiration_date );

    				$diffObj										= date_diff( $plan_expiration_date_obj, $current_date_obj );
    				$tsdi_plan_expiration_date	= (int)$diffObj->format( "%r%a" );
    			}

        }
      }
    }

    ?>
      <div class="tsdi-license-wrapper">
  			<h3><?php esc_html_e( 'Enter Your Plugin License Key:', 'ts-demo-importer' );?></h3>
        <div class="plugin_activation_spinner" style="display: none;">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <g transform="translate(50,50)">
              <g transform="scale(0.7)">
                <circle cx="0" cy="0" r="50" fill="#0f81d0"></circle>
                <circle cx="0" cy="-28" r="15" fill="#cfd7dd">
                  <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 0 0;360 0 0"></animateTransform>
                </circle>
              </g>
            </g>
          </svg>
        </div>
  			<div class="tsdi-license-desc-row"><?php echo html_entity_decode( $license_messege ); ?></div>
  			<div class="tsdi-license-cards-row">
          <form id="tsdi-license-form">
            <input
      				type="text" id="tsdi_license_key_input"
      				placeholder="<?php esc_attr_e( 'Enter License Key', 'ts-demo-importer' ) ?>"
      				required=""
      				<?php echo esc_attr( $tsdi_license_status ? 'disabled' : '' ); ?>
      				value="<?php echo esc_html( $tsdi_license_key ); ?>"
      			>
      			<div class="tsdi-addon-license-key-buttons-wrap">
      	      <?php
      				if ( !$tsdi_license_status ) {
      					?>
      	        <button type="submit" name="button">
      	          <?php esc_html_e( 'Activate', 'ts-demo-importer' ); ?>
      	        </button>
      	        <?php
      	      } else {
      	        ?>
      	        <button class="tsdi_activate_key" type="submit" name="button" disabled>
      	          <?php esc_html_e( 'Activated', 'ts-demo-importer' ); ?>
      	        </button>
      					<button class="tsdi_change_key" type="reset" name="tsdi_change_key">
      						<?php esc_html_e( 'Change Key', 'ts-demo-importer' ); ?>
      					</button>
      	        <?php
      	      }
      	      ?>
      			</div>
          </form>
  			</div>
  		</div>
    <?php
  }
  // License Key Activation Code END

	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'ts-demo-importer' ) . $this->plugin_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'ts-demo-importer' ),
				'can_skip'		=> false // Show a skip button?
			),

// Install theme step //

			'themes' => array(
  			'id'					=>	'themes',
  			'title'				=>	__( 'Theme', 'ts-demo-importer'),
  			'view'				=>	'get_step_themes',
  			'callback'		=>	'install_themes',
  			'button_text'	=>	__( 'Install Theme', 'ts-demo-importer'),
  			'can_skip'		=>	false,
        'multiple'    =>  array(
          array(
            'card_text'   =>  'Multi Advance',
            'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_one.png',
            'slug'        =>  'multi-advance'
          ),
          array(
            'card_text'   =>  'Advance Marketing Agency',
            'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_two.png',
            'slug'        =>  'advance-marketing-agency'
          ),
          array(
            'card_text'   =>  'Advance Consultancy Pro',
            'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_three.png',
            'slug'        =>  'advance-consultancy'
          ),
          array(
            'card_text'   =>  'Advance Training Academy Pro',
            'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_four.png',
            'slug'        =>  'advance-training-academy'
          ),
          array(
            'card_text'   =>  'Conference Pro',
            'card_image'  =>  TS_DEMO_IMPOTER_URL . 'theme-wizard/assets/images/home_five.png',
            'slug'        =>  'ts-conference'
          ),
        )
			),


			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'ts-demo-importer' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'ts-demo-importer' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'ts-demo-importer' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'ts-demo-importer' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'ts-demo-importer' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/**
	 * Print the content for the intro step
	 */
	public function get_step_intro() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this '.$this->plugin_title.' Plugin. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.','ts-demo-importer'); ?>
			</p>
			<p>
				<?php esc_html_e('You may even skip the steps and get back to the dashboard if you have no time at the present moment. You can come back any time if you change your mind.','ts-demo-importer'); ?>
			</p>
		</div>
	<?php }


  public function get_step_themes() {
		$themes = $this->get_themes();

		$content = array();
		// The summary element will be the content visible to the user
		$content['summary'] = sprintf(
			'<p>%s</p>',
			__(
				'This plugin works only when required themes are installed. Click the button to install. You can still install or deactivate plugins later from the dashboard.',
				'ts-demo-importer'
			),
			'ts-demo-importer'
		);
		$content = apply_filters( 'whizzie_filter_summary_content', $content );

		// The detail element is initially hidden from the user
		$content['detail'] = '<ul class="ts-demo-importer-do-themes">';
		// Add each theme into a list
		foreach( $themes['all'] as $slug => $theme ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $theme['name'] ) . '<span>';
			$keys = array();
			if ( isset( $themes['install'][ $slug ] ) ) {
			    $keys[]	=	esc_html( 'Installation' );
			}
			if ( isset( $themes['update'][ $slug ] ) ) {
			    $keys[]	=	esc_html( 'Update' );
			}

			if ( isset( $themes['network_enable'][ $slug ] ) ) {
			    $keys[]	=	esc_html( 'Network Enable' );
			}

			if ( isset( $themes['activate'][ $slug ] ) ) {
			    $keys[]	=	esc_html( 'Activation' );
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}



	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','ts-demo-importer') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';

			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme supports importing the demo content and adding widgets. Get them installed with the below button. Using the Customizer, it is possible to update or even deactivate them','ts-demo-importer'); ?>
			</p>
		</div>
	<?php }

	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="ts-demo-setup-guid">
			<div class="ts-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','ts-demo-importer'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','ts-demo-importer'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','ts-demo-importer'); ?></h4>
				<ul>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','ts-demo-importer'); ?></li>
				</ul>
				<h4><?php esc_html_e('B) Add Pages To Menu','ts-demo-importer'); ?></h4>
				<ul>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','ts-demo-importer'); ?></li>
				</ul>
			</div>
			<div class="ts-setup-contact">
				<h3><?php esc_html_e('Setup Contact Page','ts-demo-importer'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Contact Page','ts-demo-importer'); ?></p>
				<h4><?php esc_html_e('A) Upload And Activate Contact Form 7 Plugin','ts-demo-importer'); ?></h4>
				<ul>
					<li><?php esc_html_e('Go to Dashboard >> Plugins >> Add New','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Click On The Upload Plugin Option','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Choose Your Plugin File And Click On The Install Now Button','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Go to Dashboard >> Plugins >> Installed Plugins And Activate Contact Form 7 Plugin','ts-demo-importer'); ?></li>
				</ul>
				<h4><?php esc_html_e('B) Create Contact Form And Add Shortcode','ts-demo-importer'); ?></h4>
				<ul>
					<li><?php esc_html_e('Go to Dashboard >> Contact >> Add New','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Create Contact Form And Save Changes','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Copy The Form Shortcode','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Customize >> Theme Settings >> Contact','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Add The Form Shortcode In The Customizer','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Save Changes','ts-demo-importer'); ?></li>
				</ul>
			</div>
			<div class="ts-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','ts-demo-importer'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','ts-demo-importer'); ?></p>
				<ul>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','ts-demo-importer'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','ts-demo-importer'); ?></li>
				</ul>
			</div>
			<div class="ts-setup-dots">
				<input type="radio" name="r1" id="ts-setup-menu">
				<input type="radio" name="r1" id="ts-setup-contact">
				<input type="radio" name="r1" id="ts-setup-widget">
			</div>
			<div class="ts-setup-finish">
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">Finish</a>
			</div>
		</div>

	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tdi_tgmpa'] ), 'get_instance' ) );

    // echo "<pre>";
    // print_r( $instance );
    // exit;

		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug => $plugin ) {

			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {

				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {

					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}

					if( $instance->can_plugin_activate( $slug ) ) {

						$plugins['activate'][$slug] = $plugin;

					}


				}
			}
		}

		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}



  public function can_theme_activate( $slug ) {
    return ( ( wp_get_theme()->get( 'TextDomain' ) != $slug ) && !get_theme_update_available( wp_get_theme( $slug ) ) );
  }

  public function is_theme_available_to_network_activate( $slug ) {
		return !isset( wp_get_themes( array( 'errors' => false, 'allowed' => 'network' ) ) [$slug] );
	}

  public function get_themes() {
		$themes = array(
			'all' 						=>	array(),
			'install'					=>	array(),
			'update'					=>	array(),
			'network_enable'	=>	array(),
			'activate'				=>	array()
		);

		$instance_themes = array(
			'multi-advance'	=> array(
				'name' 								=> 'Multi Advance',
				'slug' 								=> 'multi-advance',
				'source' 							=> 'repo',
				'required' 						=> 1,
				'version' 						=> '',
				'force_activation' 		=> '',
				'force_deactivation'	=> '',
				'external_url' 				=> '',
				'is_callable' 				=> '',
				'file_path' 					=> 'multi-advance',
				'source_type' 				=> ''
			),
			'advance-marketing-agency'	=> array(
				'name' 								=> 'Advance Marketing Agency',
				'slug' 								=> 'advance-marketing-agency',
				'source' 							=> 'repo',
				'required' 						=> 1,
				'version' 						=> '',
				'force_activation' 		=> '',
				'force_deactivation'	=> '',
				'external_url' 				=> '',
				'is_callable' 				=> '',
				'file_path' 					=> 'advance-marketing-agency',
				'source_type' 				=> ''
			)
		);

		foreach( $instance_themes as $slug => $theme ) {

			if( ( wp_get_theme()->get( 'TextDomain' ) == $slug ) && ( false === get_theme_update_available( wp_get_theme() ) ) ) {
				// Theme is installed and up to date
				continue;
			} else {
				$themes['all'][$slug] = $theme;

				if( !wp_get_theme( $slug )->exists() ) {
					$themes['install'][$slug] = $theme;
				} else {

					if( false != get_theme_update_available( wp_get_theme( $slug ) ) ) {
						$themes['update'][$slug] = $theme;
					}

					if (
						current_user_can( 'manage_network_themes' ) &&
						$this->is_theme_available_to_network_activate( $slug ) &&
						$this->can_theme_activate( $slug )
					) {
						$themes['network_enable'][$slug] = $theme;
					} else if( $this->can_theme_activate( $slug ) ) {
						$themes['activate'][$slug] = $theme;
					}

				}
			}
		}

		return $themes;

}





  public function ts_demo_importer_setup_themes() {

			if ( ! check_ajax_referer( 'ts_demo_importer_whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
				wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found' ) ) );
			}


			$json = array();
			// send back some json we use to hit up TGM
			$themes = $this->get_themes();

			if ( current_user_can( 'manage_network_themes' ) ) {
				foreach ( $themes['network_enable'] as $slug => $theme ) {
					if ( $_POST['slug'] == $slug ) {
						$encoded_slug = urlencode( $slug );
						$theme_network_enable_url = wp_nonce_url(
							network_admin_url( 'themes.php?action=enable&amp;theme=' . $encoded_slug ), 'enable-theme_' . $slug
						);
						$theme_network_enable_url	=	str_replace( '&amp;', '&', $theme_network_enable_url );
						$json = array(
							'url'           =>	$theme_network_enable_url,
							'theme'        	=>	array( $slug ),
							'tgmpa-page'    =>	$this->tdi_tgmpa_menu_slug,
							'theme_status' 	=>	'all',
							'_wpnonce'      =>	wp_create_nonce( 'bulk-plugins' ),
							'action'        =>	$theme_network_enable_url,
							'action2'       =>	-1,
							'message'       =>	esc_html__( 'Network Enabling Theme' ),
						);
						break;
					}
				}
			}

			// what are we doing with this plugin?
			foreach ( $themes['activate'] as $slug => $theme ) {
				if ( $_POST['slug'] == $slug ) {

					$encoded_slug				=	urlencode( $slug );
					$theme_activate_url	=	wp_nonce_url(
						admin_url( 'themes.php?action=activate&amp;stylesheet=' . $encoded_slug ), 'switch-theme_' . $slug
					);
					$theme_activate_url	=	str_replace( '&amp;', '&', $theme_activate_url );
					$json = array(
						'url'           =>	$theme_activate_url,
						'theme'        	=>	array( $slug ),
						'tgmpa-page'    =>	$this->tdi_tgmpa_menu_slug,
						'theme_status' 	=>	'all',
						'_wpnonce'      =>	wp_create_nonce( 'bulk-plugins' ),
						'action'        =>	$theme_activate_url,
						'action2'       =>	-1,
						'message'       =>	esc_html__( 'Activating Theme' ),
					);
					break;
				}
			}

			foreach ( $themes['update'] as $slug => $theme ) {
				if ( $_POST['slug'] == $slug ) {
					$update_php				= admin_url( 'update.php?action=upgrade-theme' );
					$theme_update_url = add_query_arg(
						array(
							'theme'    => $slug,
							'_wpnonce' => wp_create_nonce( 'upgrade-theme_' . $slug ),
						),
						$update_php
					);
					$json = array(
						'url'           =>	$theme_update_url,
						'theme'        	=>	array( $slug ),
						'tgmpa-page'    =>	$this->tdi_tgmpa_menu_slug,
						'theme_status' 	=>	'all',
						'_wpnonce'      =>	wp_create_nonce( 'bulk-plugins' ),
						'action'        =>	$theme_update_url,
						'action2'       =>	-1,
						'message'       =>	esc_html__( 'Updating Theme' ),
					);
					break;
				}

			}

			foreach ( $themes['install'] as $slug => $theme ) {

				if ( $_POST['slug'] == $slug ) {
					$install_php				= admin_url( 'update.php?action=install-theme' );
					$theme_install_url	= add_query_arg(
						array(
							'theme'    => $slug,
							'_wpnonce' => wp_create_nonce( 'install-theme_' . $slug ),
						),
						$install_php
					);
					$json = array(
						'url'           =>	$theme_install_url,
						'theme'        	=>	array( $slug ),
						'tgmpa-page'    =>	$this->tdi_tgmpa_menu_slug,
						'theme_status' 	=>	'all',
						'_wpnonce'      =>	wp_create_nonce( 'bulk-plugins' ),
						'action'        =>	$theme_install_url,
						'action2'       =>	-1,
						'message'       =>	esc_html__( 'Installing Theme' ),
					);
					break;
				}
		}

			if ( $json ) {
				$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next theme
				wp_send_json( $json );
			} else {
				wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success' ) ) );
			}
			exit;
	}


	public function ts_demo_importer_setup_plugins() {
		if ( ! check_ajax_referer( 'ts_demo_importer_whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','ts-demo-importer' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM

		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tdi_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tdi_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tdi-tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','ts-demo-importer' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tdi_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tdi_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tdi-tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','ts-demo-importer' ),
				);
				break;
			}
	}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tdi_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tdi_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tdi-tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','ts-demo-importer' ),
				);

				break;
			}
		}

		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','ts-demo-importer' ) ) );
		}
		exit;
	}

	public function theme_create_customizer_primary_nav_menu() {

		 // ------- Create Nav Menu --------
        $menuname = $lblg_themename . 'Primary Menu';
		$bpmenulocation = 'primary';
		$menu_exists = wp_get_nav_menu_object( $menuname );

		if( !$menu_exists){
		    $menu_id = wp_create_nav_menu($menuname);
		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Home','ts-demo-importer'),
		        'menu-item-classes' => 'home',
		        'menu-item-url' => home_url( '/' ),
		        'menu-item-status' => 'publish'));

			$parent_item = wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Blog','ts-demo-importer'),
				'menu-item-status' => 'publish',
        'menu-item-url' => '#'
			));
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Blog With No Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'blog-page',
				'menu-item-url' => get_permalink( get_page_by_title( 'Blog' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $parent_item
			));
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Blog Left Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'blog-left-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Blog Left Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $parent_item
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Blog Right Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'blog-right-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Blog Right Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $parent_item
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Blog Left / Right Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'blog-with-left-right-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Blog Left / Right Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $parent_item
			));

			$page_parent_item = wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Page','ts-demo-importer'),
				'menu-item-status' => 'publish',
        'menu-item-url' => '#'
			));
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Page With No Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'page-with-no-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Page With No Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $page_parent_item
			));
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Page Left Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'page-left-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Page Left Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $page_parent_item
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Page Right Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'page-right-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Page Right Sidebar' )),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $page_parent_item
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => __('Page Left / Right Sidebar','ts-demo-importer'),
				'menu-item-classes' => 'page-with-left-right-sidebar',
				'menu-item-url' => get_permalink( get_page_by_title( 'Page Left / Right Sidebar' ) ),
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $page_parent_item
			));

			$service_parent_item = wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  __('Hiring','ts-demo-importer'),
				'menu-item-classes' => 'hiring',
				'menu-item-url' => get_permalink( get_page_by_title( 'Hiring' )),
				'menu-item-status' => 'publish'
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  __('Portfolio','ts-demo-importer'),
				'menu-item-classes' => 'projects',
				'menu-item-url' => get_permalink( get_page_by_title( 'Portfolio' )),
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  __('About Us','ts-demo-importer'),
				'menu-item-classes' => 'about-us',
				'menu-item-url' => get_permalink( get_page_by_title( 'About Us' )),
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  __('Team','ts-demo-importer'),
				'menu-item-classes' => 'team',
				'menu-item-url' => get_permalink( get_page_by_title( 'Team' )),
				'menu-item-status' => 'publish',
			));

		    if( !has_nav_menu( $bpmenulocation ) ){
		        $locations = get_theme_mod('nav_menu_locations');
		        $locations[$bpmenulocation] = $menu_id;
		        set_theme_mod( 'nav_menu_locations', $locations );
		    }
		}
	}

	public function theme_create_customizer_footer_nav_menu_1() {
    // ------- Create Nav Menu --------
   $menuname = $lblg_themename . 'Footer Menu 1';
   $bpmenulocation = 'footer1';
   $menu_exists = wp_get_nav_menu_object( $menuname );

   if( !$menu_exists){
       $menu_id = wp_create_nav_menu($menuname);
        wp_update_nav_menu_item($menu_id, 0, array(
           'menu-item-title' =>  __('About','medical-doctor-pro'),
           'menu-item-classes' => 'about',
           'menu-item-url' => home_url( '/index.php/about-us/' ),
           'menu-item-status' => 'publish'));

       wp_update_nav_menu_item($menu_id, 0, array(
          'menu-item-title' =>  __('Service','medical-doctor-pro'),
          'menu-item-classes' => 'services',
          'menu-item-url' => home_url( '#' ),
          'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id, 0, array(
         'menu-item-title' =>  __('Pricing','medical-doctor-pro'),
         'menu-item-classes' => 'pricing',
         'menu-item-url' => home_url( '#' ),
         'menu-item-status' => 'publish'));

     wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Location','medical-doctor-pro'),
        'menu-item-classes' => 'location',
        'menu-item-url' => home_url( '#' ),
        'menu-item-status' => 'publish'));


            if( !has_nav_menu( $bpmenulocation ) ){
           $locations = get_theme_mod('nav_menu_locations');
           $locations[$bpmenulocation] = $menu_id;
           set_theme_mod( 'nav_menu_locations', $locations );
       }
   }
  }

public function import_demo_multi_advance() {

  // importing common things
  $this->import_demo_theme_common_section();

  //POST and update the customizer and other related data of Advance Coaching Pro
  $home_id=''; $ts_blog_id=''; $page_id=''; $contact_id='';
  // Create a front page and assigned the template
  $home_content = '';
  $home_title = 'Home';
  $home = array(
    'post_type' => 'page',
    'post_title' => $home_title,
    'post_content'  => wp_slash( $home_content),
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'home'
  );
  $home_id = wp_insert_post($home);

  //Set the home page template
  add_post_meta( $home_id, '_wp_page_template', 'page-template/home-page.php' );

  //Set the static front page
  $home = get_page_by_title( 'Home' );
  update_option( 'page_on_front', $home->ID );
  update_option( 'show_on_front', 'page' );


  // Create a About page and assigned the template
  $about_title = 'About Us';
  $about_us = array(
    'post_type' => 'page',
    'post_title' => $about_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'about-us'
  );
  $about_id = wp_insert_post($about_us);

  //Set the blog with right sidebar template
  add_post_meta( $about_id, '_wp_page_template', 'page-template/about-us.php' );
  update_post_meta( $about_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $about_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/page-banner/about-us-image.png');
  update_post_meta( $about_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $about_id,'title_banner_image_title_below_on_off', false);

  // Create a Services page and assigned the template
  $team_title = 'Team';
  $team_us = array(
    'post_type' => 'page',
    'post_title' => $team_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'team'
  );
  $team_id = wp_insert_post($team_us);

  //Set the blog with right sidebar template
  add_post_meta( $team_id, '_wp_page_template', 'page-template/team.php' );
  update_post_meta( $team_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $team_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/page-banner/we-are-hiring-image.png');
  update_post_meta( $team_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $team_id,'title_banner_image_title_below_on_off', false);

  // Create a Project page and assigned the template
  $projects_title = 'Projects';
  $projects_us = array(
    'post_type' => 'page',
    'post_title' => $projects_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'projects'
  );
  $projects_id = wp_insert_post($projects_us);

  //Set the blog with right sidebar template
  add_post_meta( $projects_id, '_wp_page_template', 'page-template/projects.php' );
  update_post_meta( $projects_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $projects_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/page-banner/portfolio-header.png');
  update_post_meta( $projects_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $projects_id,'title_banner_image_title_below_on_off', false);

  // Create a Project page and assigned the template
  $hiring_title = 'Hiring';
  $hiring_us = array(
    'post_type' => 'page',
    'post_title' => $hiring_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' => 'hiring'
  );
  $hiring_id = wp_insert_post($hiring_us);

  //Set the blog with right sidebar template
  add_post_meta( $hiring_id, '_wp_page_template', 'page-template/hiring.php' );
  update_post_meta( $hiring_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $hiring_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/page-banner/hiring-header.png');
  update_post_meta( $hiring_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $hiring_id,'title_banner_image_title_below_on_off', false);

  // Create a projects page and assigned the template
  $projects_title = 'Portfolio';
  $projects = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $projects_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'projects'
  );
  $projects_id = wp_insert_post($projects);

  //Set the blog with right sidebar template
  add_post_meta( $projects_id, '_wp_page_template', 'page-template/projects.php' );
  add_post_meta( $projects_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a about-us page and assigned the template
  $about_us_title = 'About Us';
  $about_us = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $about_us_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'about-us'
  );
  $about_us_id = wp_insert_post($about_us);

  //Set the blog with right sidebar template
  add_post_meta( $about_us_id, '_wp_page_template', 'page-template/about-us.php' );
  add_post_meta( $about_us_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a team page and assigned the template
  $team_title = 'Team';
  $team = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $team_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'team'
  );
  $team_id = wp_insert_post($team);

  //Set the blog with right sidebar template
  add_post_meta( $team_id, '_wp_page_template', 'page-template/team.php' );
  add_post_meta( $team_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // -------------- Section Ordering ---------------
  set_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater', 'our-records,about-us,our-skills,our-services,banner,our-projects,features,team,hire-us,pricing-plan,quote-banner,consult-us,additional-services,testimonials,our-brands,skills-showcase,latest-news,contact-map,content-area');

  /*  customizer-part-slide.php  */
  set_theme_mod( 'ts_demo_importer_slide_number', '3' );
  // Slider Images Section
  for($i=1; $i<=3; $i++) {
    set_theme_mod( 'ts_demo_importer_slide_image'.$i,TS_DEMO_IMPOTER_URL.'/assets/images/slides/slide'.$i.'.png' );
    set_theme_mod('ts_demo_importer_slide_image_alt_text'.$i,'Alt Tag for image slider');
    //Slide top title
    set_theme_mod('ts_demo_importer_slide_small_heading'.$i,'Simple and Effective Business Solutions');
    set_theme_mod( 'ts_demo_importer_slide_heading'.$i, 'Simple and Intuitive Solutions');
    //Slide Text section
    set_theme_mod( 'ts_demo_importer_slide_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore' );
    //Slider Button 1 Text section
    set_theme_mod( 'ts_demo_importer_slide_btn_one_text'.$i, 'View More' );
    set_theme_mod( 'ts_demo_importer_slide_btn_one_icon'.$i, 'fas fa-arrow-right' );
  }
  //Slide Delay
  set_theme_mod( 'ts_demo_importer_slide_delay', '10000' );

  // ------ Topbar -----------------------
  set_theme_mod( 'multi_advance_topbar_text','Revolutionary Products For Business Solutions' );
  set_theme_mod( 'multi_advance_mail_address','contact@business.com' );
  set_theme_mod( 'multi_advance_phoneno','+1 1234 567 890' );
  set_theme_mod( 'multi_advance_facebook_url','https://www.facebook.com/' );
  set_theme_mod( 'multi_advance_twitter_url','https://twitter.com/' );
  set_theme_mod( 'multi_advance_instagram_url','https://www.instagram.com/accounts/login/' );
  set_theme_mod( 'multi_advance_linkedin_url','https://www.linkedin.com/check/manage-account' );
  set_theme_mod( 'multi_advance_youtube_url','https://www.youtube.com/' );
  /*customizer-part-social-icons.php*/

  //twitter link
  set_theme_mod( 'ts_demo_importer_headertwitter', 'https://twitter.com/' );
  //facebook link
  set_theme_mod( 'ts_demo_importer_headerfacebook', 'https://www.facebook.com/' );
  //GooglePlus link
  set_theme_mod( 'ts_demo_importer_headeryoutube', 'https://www.youtube.com/' );
  //Instagram link
  set_theme_mod( 'ts_demo_importer_headerinstagram', 'https://www.instagram.com/' );

  // ------------- About Us -------------
  set_theme_mod( 'ts_demo_importer_about_us_small_heading', 'About Us' );
  set_theme_mod( 'ts_demo_importer_about_us_main_heading', 'Helping Client Achieve a Compititive Advantage' );
  set_theme_mod( 'ts_demo_importer_about_us_text', 'Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odi sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan. Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita.' );
  set_theme_mod( 'ts_demo_importer_about_us_button_title', 'View More' );
  set_theme_mod( 'ts_demo_importer_about_us_button_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_about_us_button_url', '#' );
  set_theme_mod( 'ts_demo_importer_about_us_heading_image', TS_DEMO_IMPOTER_URL.'assets/images/about/about-us-image.png');
  set_theme_mod( 'ts_demo_importer_about_us_heading_image_alt_text', 'About Left Image' );
  set_theme_mod( 'ts_demo_importer_about_us_badge_icon', 'fas fa-quote-left' );
  set_theme_mod( 'ts_demo_importer_about_us_image_badge_text', 'Engagement and Brand storytelling are the heart of our approach.' );

  // ----------- Our Skills -----------
  set_theme_mod( 'ts_demo_importer_our_skills_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/our-skills-bg.png');
  set_theme_mod( 'ts_demo_importer_our_skills_small_heading', 'Our Skills' );
  set_theme_mod( 'ts_demo_importer_our_skills_main_heading', 'Compose The Perfect Business' );
  set_theme_mod( 'ts_demo_importer_our_skills_number', 3);
  $skills_title=array('Brand Positioning','Market Targeting ','customer Service');
  $skills_icon=array('fas fa-handshake','fas fa-envelope-open','fas fa-headphones');
  $skills_percent=array('25','45','75');
  for($i=1; $i<=4; $i++)
  {
    set_theme_mod( 'ts_demo_importer_our_skills_icon'.$i, $skills_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_skills_title'.$i, $skills_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_skills_url'.$i, '#' );
    set_theme_mod( 'ts_demo_importer_our_skills_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' );
    set_theme_mod( 'ts_demo_importer_our_skills_percentage'.$i, $skills_percent[$i-1] );
  }

  // --------------- Our Services -----------
  set_theme_mod( 'ts_demo_importer_our_services_small_heading', 'What We do' );
  set_theme_mod( 'ts_demo_importer_our_services_main_heading', 'Leading Services In The Industry' );
  set_theme_mod( 'ts_demo_importer_our_services_number', 5 );
  $services_title=array('Business Opportunity','Commercial Approch','Investment Strategy','Business Solutions', 'Business Analyst');
  for($i=1;$i<=5;$i++){
    $ts_title = $services_title[$i-1];
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $ts_title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'services',
    );

    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id,'meta-short-title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/services/service-image'.$i.'.png';

    $image_name= 'service-image'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'services',
      'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }
  set_theme_mod( 'ts_demo_importer_our_services_box_link_text', 'SEE PROJECT' );
  set_theme_mod( 'ts_demo_importer_our_services_box_link_icon', 'fas fa-arrow-right' );

  // ------------ Banner ------------
  set_theme_mod( 'ts_demo_importer_banner_head', 'Business Process');
  set_theme_mod( 'ts_demo_importer_banner_head2', 'The Best solution for your business website');
  set_theme_mod( 'ts_demo_importer_banner_text', 'Nulla eleifend, lectus eu gravida facilisis, ipsum metus faucibus eros, vitae vulputate nibh libero ac metus. Phasellus magna erat, consectetur nec faucibus at, mollis vitae mauris.');
  set_theme_mod( 'ts_demo_importer_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/banner.png');
  set_theme_mod( 'ts_demo_importer_banner_button_read_more', 'Watch Video');
  set_theme_mod( 'ts_demo_importer_banner_button_read_more_icon', 'fas fa-arrow-right');

  // ---------------- Our Projects ---------
  set_theme_mod( 'ts_demo_importer_our_projects_small_heading', 'Recent Projects' );
  set_theme_mod( 'ts_demo_importer_our_projects_main_heading', 'Realize Your Projects, You Envision we Create' );
  set_theme_mod( 'ts_demo_importer_our_projects_number', 6);
  $project_title=array('Nike','yahoo!','Nvidia','Samsung','Marketing','Development');
  $project_type=array('Development','Design','Planning','Analysis','Testing','SEO');
  wp_insert_term(
  'All', // the term
  'projectscategory', // the taxonomy
  array(
  'description'=> 'Category description',
  'slug' => 'All',
  'term_id'=>23,
  'term_taxonomy_id'=>34,
  ));

  set_theme_mod( 'ts_demo_importer_our_projects_categoryselection_setting','All' );
  for($i=1; $i<=6; $i++){
    $ts_title = $project_title[$i-1];
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $ts_title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'projects',
    );

    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    $ts_term = get_term_by('name', 'All', 'projectscategory');
    wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
    update_post_meta( $ts_post_id,'meta-projects-type',$project_type[$i-1]);
    update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/projects/work'.$i.'.png';

    $image_name= 'work'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'projects',
      'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }
  set_theme_mod( 'ts_demo_importer_our_projects_box_link_text', 'LEARN MORE' );
  set_theme_mod( 'ts_demo_importer_our_projects_box_link_icon', 'fas fa-arrow-right' );

  /*--- Features---*/
  set_theme_mod( 'ts_demo_importer_features_number', 4 );
  $icon_array =array('fas fa-briefcase','fas fa-chart-line','fas fa-object-group','fas fa-globe');
  $title1_array =array('Business','Marketing','Finances','Marketing');
  $title2_array =array('opprtunities Full of wide growth','Competitive Sector Of The Industry','Group Productive And Innovative','Campaign and Marketing Analytics');
  for($i=1;$i<=4;$i++){
    set_theme_mod( 'ts_demo_importer_features_icon'.$i, $icon_array[$i-1] );
    set_theme_mod( 'ts_demo_importer_features_title'.$i, $title1_array[$i-1] );
    set_theme_mod( 'ts_demo_importer_features_title2'.$i, $title2_array[$i-1] );
  }

  // ------------ Hire us ------------
  set_theme_mod( 'ts_demo_importer_hire_us_head', 'Hire Us');
  set_theme_mod( 'ts_demo_importer_hire_us_head2', 'Suspendisse Arcu Consectetur Eget Urna, Condimenturm Volutpat Felis');
  set_theme_mod( 'ts_demo_importer_hire_us_button_read_more', 'Hire Us');
  set_theme_mod( 'ts_demo_importer_hire_us_button_read_more_icon', 'fas fa-arrow-right');

  // ----------- Pricing Plan ------------
  set_theme_mod( 'ts_demo_importer_pricing_plan_small_heading', 'Pricing' );
  set_theme_mod( 'ts_demo_importer_pricing_plan_main_heading', 'Best Service, Unbeatable Price' );
  set_theme_mod( 'ts_demo_importer_pricing_plan_number', 3);
  $plan_title=array('Website Optimization','Marketing Optimization','Complete Development');
  $plan_feature=array('Basic Website Checkup','SEO Recommendation','Google Ads Recommendation','W3C Validator Recommendation');
  $plan_price=array('149','199','299');
  $plan_basic=array('Starter Package','Upgrade Package','Full Package');
  $plan_icon=array('fas fa-globe','fas fa-handshake','fas fa-battery-full');
  for($i=1;$i<=3;$i++)
  {
    set_theme_mod( 'ts_demo_importer_pricing_plan_icon'.$i, $plan_icon[$i-1]);
    set_theme_mod( 'ts_demo_importer_pricing_plan_price_currency'.$i, '$');
    set_theme_mod( 'ts_demo_importer_pricing_plan_title'.$i,$plan_title[$i-1]);
    set_theme_mod( 'ts_demo_importer_pricing_plan_price'.$i, $plan_price[$i-1] );
    set_theme_mod( 'ts_demo_importer_pricing_plan_duration'.$i, $plan_basic[$i-1] );
    set_theme_mod( 'ts_demo_importer_pricing_plan_feature_no'.$i, 4);
    for($j=1;$j<=4;$j++)
    {
      set_theme_mod( 'ts_demo_importer_pricing_plan_feature_title'.$i.$j,$plan_feature[$j-1]);
    }
    set_theme_mod( 'ts_demo_importer_pricing_plan_button_title'.$i, 'View More' );
    set_theme_mod( 'ts_demo_importer_pricing_plan_button_icon'.$i, 'fas fa-arrow-right');
  }
  set_theme_mod( 'ts_demo_importer_pricing_plan_feature_icon', 'fas fa-check');

  // ------------ Quote Banner ------------
  set_theme_mod( 'ts_demo_importer_quote_banner_head', 'Dedicated to your Business');
  set_theme_mod( 'ts_demo_importer_quote_banner_head2', 'Better Business with Advantage');
  set_theme_mod( 'ts_demo_importer_quote_banner_text', 'Nulla eleifend, lectus eu gravida facilisis, ipsum metus faucibus eros, vitae vulputate nibh libero ac metus. Phasellus magna erat, consectetur nec faucibus at, mollis vitae mauris.');
  set_theme_mod( 'ts_demo_importer_quote_banner_button_read_more', 'GET A QUOTE NOW');
  set_theme_mod( 'ts_demo_importer_quote_banner_button_read_more_icon', 'fas fa-arrow-right');
  set_theme_mod( 'ts_demo_importer_quote_banner_column_image', TS_DEMO_IMPOTER_URL.'assets/images/business-woman.png');

  // ----------- Consult Us -----------
  set_theme_mod( 'ts_demo_importer_consult_us_small_heading', 'Consult Us' );
  set_theme_mod( 'ts_demo_importer_consult_us_main_heading', 'Capitalizing on the Real world Experience of our Financial Advisor' );
  set_theme_mod( 'ts_demo_importer_consult_us_number', 5);

  $consult_title = array('Acquisition Consulting','Strategic Consulting Services','Company & Business Setup','Investment and Management','Company Management');
  $consult_subtitle = array('Ligal','Analytics','Business','Finance','Resources');
  $consult_icon = array('fas fa-balance-scale','fas fa-chart-line','fas fa-briefcase','fas fa-camera','fas fa-users');

  for($i=1; $i<=5; $i++)
  {
    set_theme_mod( 'ts_demo_importer_consult_us_icon'.$i, $consult_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_consult_us_sub_title'.$i, $consult_subtitle[$i-1] );
    set_theme_mod( 'ts_demo_importer_consult_us_title'.$i, $consult_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_consult_us_text'.$i, 'Nulla eleifend, lectus eu gravida facilisis, ipsum metus faucibus eros, vitae vulputate nibh libero ac metus.' );
    set_theme_mod( 'ts_demo_importer_consult_us_box_link'.$i, 'Hire Us' );
    set_theme_mod( 'ts_demo_importer_consult_us_box_link_icon'.$i, 'fas fa-arrow-right');
  }

  // ----------- Additional Services -----------
  set_theme_mod( 'ts_demo_importer_additional_services_number', 4);
  $ad_icon = array('fas fa-cogs','fab fa-accessible-icon','fas fa-anchor','fas fa-address-book');
  $ad_title = array('Automated Process','Density Engineering','Brand Positioning','Brand Positioning');
  for($i=1; $i<=4; $i++)
  {
    set_theme_mod( 'ts_demo_importer_additional_services_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/additional-services/additional-services-image'.$i.'.png');
    set_theme_mod( 'ts_demo_importer_additional_services_icon'.$i, $ad_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_additional_services_title'.$i, $ad_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_additional_services_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud' );
  }
  set_theme_mod( 'ts_demo_importer_additional_services_small_heading', 'Additional Services' );
  set_theme_mod( 'ts_demo_importer_additional_services_main_heading', 'Always Interested In New, Challenging And Exciting Projects' );
  set_theme_mod( 'ts_demo_importer_additional_services_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
  consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.' );
  set_theme_mod( 'ts_demo_importer_additional_services_button_read_more', 'GET A FREE QUOTE' );
  set_theme_mod( 'ts_demo_importer_additional_services_button_read_more_icon', 'fas fa-arrow-right');

  // ------------ Testimonial  ------------
  set_theme_mod( 'ts_demo_importer_testimonials_small_heading', 'Testimonials' );
  set_theme_mod( 'ts_demo_importer_testimonials_main_heading', 'Find Out Why People Love Working With Us' );
  set_theme_mod( 'ts_demo_importer_testimonial_number', 3 );
  set_theme_mod( 'ts_demo_importer_testimonial_excerpt_no', 25 );
  $testimonials_title=array('Alin Decros','John Fernandez','Alin Decros');
  for($i=1;$i<=3;$i++)
  {
    $ts_title = $testimonials_title[$i-1];
    $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo';
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $ts_title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'testimonials',
    );
    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id,'ts_demo_importer_posttype_testimonial_desigstory','Developers');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/testimonial/client'.$i.'.png';
    $image_name= 'client'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'testimonials',
      'post_status'    => 'inherit'
    );
    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }

  // ----------- Skills Showcase -----------
  set_theme_mod( 'ts_demo_importer_skills_showcase_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/skills-showcase/skills-image.png');
  set_theme_mod( 'ts_demo_importer_skills_showcase_small_heading', 'Skills' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_main_heading', 'Professional and Reliable Partner' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_section_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_number', 4 );
  $skills_percent_title=array('65','75','60','50');
  for($i=1;$i<=4;$i++)
  {
    set_theme_mod( 'ts_demo_importer_skills_showcase_title'.$i, 'Business Process Name '.$i );
    set_theme_mod( 'ts_demo_importer_skills_showcase_percentage'.$i, $skills_percent_title[$i-1] );
  }

  // ----------- Latest News -----------
  set_theme_mod( 'ts_demo_importer_latest_news_small_heading', 'Blogs' );
  set_theme_mod( 'ts_demo_importer_latest_news_main_heading', 'Latest News From Us' );
  set_theme_mod( 'ts_demo_importer_post_excerpt_no', '15' );
  wp_delete_post(1);
  set_theme_mod( 'ts_demo_importer_latest_news_number', 3);
  $news_title=array('How is rural marketing capturing the uncap...','What the IPO financing clampdown means f...','How 15 Best Cities for Business in the Worl...','Essential Hotel Management Strategies','The True Cost Of Your Handmade Soap','Creating Ideas and Building Brands','Process Of Creating a Strong, Positive Perce...','How is rural marketing capturing the uncap...','The New Minimalist Office Spaces in Monte...','Apps That Can Help You With Productivity','Finding Cleaner Ways To Power The World...','Tips On Brand Positioning and Startup','Apps That Can Help You With Productivity','Finding Cleaner Ways To Power The World...','Tips On Brand Positioning and Startup');
  $image_1 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image7.png';
  $image_2 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image4.png';

  for($i=1;$i<=15;$i++)
  {
    $ts_title = $news_title[$i-1];
    $content = '<div class="entry-content"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
                <blockquote class="wp-block-quote"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, </p><cite>Tom Hank</cite></blockquote>
                <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
                <figure class="wp-block-gallery columns-2 is-cropped"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_1.'" alt="" data-id="377" data-link="'.$image_1.'" class="wp-image-377"></figure></li><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_2.'" alt="" data-id="378" data-link="'.$image_2.'" class="wp-image-378"></figure></li></ul></figure>
                <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p></div>';
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $ts_title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'post',
    );

    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image'.$i.'.png';

    $image_name= 'blog-list-image'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
    } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'post',
      'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_text', 'LEARN MORE' );
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_icon', 'fas fa-arrow-right');

  // contact form shortcode
  $cf7title = "Contact Map";
  $cf7content = '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]
  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [_site_admin_email]
  Reply-To: [your-email]

  0
  0

  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [your-email]
  Reply-To: [_site_admin_email]

  0
  0
  Thank you for your message. It has been sent.
  There was an error trying to send your message. Please try again later.
  One or more fields have an error. Please check and try again.
  There was an error trying to send your message. Please try again later.
  You must accept the terms and conditions before sending your message.
  The field is required.
  The field is too long.
  The field is too short.
  There was an unknown error uploading the file.
  You are not allowed to upload files of this type.
  The file is too big.
  There was an error uploading the file.';

  $cf7_post = array(
  'post_title'    => wp_strip_all_tags( $cf7title ),
  'post_content'  => wp_slash($cf7content),
  'post_status'   => 'publish',
  'post_type'     => 'wpcf7_contact_form',
  );
  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]' );

  $cf7mail_data  = array(
  'subject' => '[_site_title] "[your-subject]"',
  'sender' => '[_site_title] <supprt@themeshopy.com>',
  'body' => 'From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])',
  'recipient' => '[_site_admin_email]',
  'additional_headers' => 'Reply-To: [your-email]',
  'attachments' => '',
  'use_html' => 0,
  'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);
  // Gets term object from Tree in the database.

  $cf7shortcode3 = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';

  set_theme_mod( 'ts_demo_importer_contact_map_shortcode',$cf7shortcode3 );

  //post setting
  set_theme_mod( 'ts_demo_importer_related_posts_title', 'Related Posts' );
  set_theme_mod( 'ts_demo_importer_related_post_count', 3 );
  set_theme_mod( 'ts_demo_importer_blog_category_prev_title', 'Previous' );
  set_theme_mod( 'ts_demo_importer_blog_category_next_title', 'Next' );

  // ------------ Project Tab ----------
  set_theme_mod( 'ts_demo_importer_our_projects_tab_small_heading', 'Portfolio' );
  set_theme_mod( 'ts_demo_importer_our_projects_tab_main_heading', 'Perfect Partner For Your Success' );
  set_theme_mod( 'ts_demo_importer_our_projects_tab_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.' );
  set_theme_mod( 'ts_demo_importer_our_projects_tab_number', 5);

  $project_tab_title = array('All','Business','Development','Finance','Ligal','Proffession','Advisor','Dedication');
  $project_name = array('Computing','Zee','Blogger','Optimization','Telemarketing','Innovation','Investment','Finance','Business','Taxes','Management','Cloud','Collaboration','Services');
  $project_tab_type = array('Development','Design','Planning','Analysis','Testing','SEO','Manage','Deliver');

  set_theme_mod( 'ts_demo_importer_our_projects_tab_box_link_text', 'View More' );

  for($i=1; $i<=8; $i++){
    wp_insert_term(
    $project_tab_title[$i-1], // the term
    'projectscategory', // the taxonomy
    array(
    'description'=> 'This is category description',
    'slug' => $project_tab_title[$i-1],
    'term_id'=>23,
    'term_taxonomy_id'=>34,
    ));

    set_theme_mod( 'ts_demo_importer_our_projects_tab_name'.$i,$project_tab_title[$i-1] );
    for($j=1; $j<=8; $j++){
      $ts_title = $project_name[$j-1];
      $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

      set_theme_mod( 'ts_demo_importer_our_projects_tab_categoryselection_setting'.$j,$project_tab_title[$j-1] );

      // Create post object
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $ts_title ),
        'post_content'  => wp_slash($content),
        'post_status'   => 'publish',
        'post_type'     => 'projects',
      );

      // Insert the post into the database
      $ts_post_id = wp_insert_post( $my_post );
      $ts_term = get_term_by('name', $project_tab_title[$i-1], 'projectscategory');
      wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
      update_post_meta( $ts_post_id,'meta-projects-type',$project_tab_type[$i-1]);
      update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

      $image_url = TS_DEMO_IMPOTER_URL.'assets/images/portfolio/portfolio-image-'.$j.'.png';

      $image_name= 'portfolio-image-'.$i.'.png';
      $upload_dir = wp_upload_dir();
      // Set upload folder
      $image_data = file_get_contents($image_url);
      // Get image data
      $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
      // Generate unique name
      $filename= basename( $unique_file_name );
      // Create image file name
      // Check folder permission and define file location
      if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
      } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
      }
      // Create the image  file on the server
      file_put_contents( $file, $image_data );
      // Check image file type
      $wp_filetype = wp_check_filetype( $filename, null );
      // Set attachment data
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name( $filename ),
        'post_content'   => '',
        'post_type'     => 'projects',
        'post_status'    => 'inherit'
      );

      // Create the attachment
      $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
      // Include image.php
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      // Define attachment metadata
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
      // Assign metadata to attachment
      wp_update_attachment_metadata( $attach_id, $attach_data );
      // And finally assign featured image to post
      set_post_thumbnail( $ts_post_id, $attach_id );
    }
  }

  // ------------ Single Pages ----------
  set_theme_mod( 'ts_demo_importer_our_projects_type_title', 'Project Type : ' );
  set_theme_mod( 'ts_demo_importer_our_projects_duration_title', 'Project Duration : ' );
  set_theme_mod( 'ts_demo_importer_our_projects_location_title', 'Project Location : ' );
  set_theme_mod( 'ts_demo_importer_our_projects_client_title', 'Project Client : ' );

  // ----------- Our Records ----------
  set_theme_mod( 'ts_demo_importer_our_records_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/our-record-wave.png');
  set_theme_mod( 'ts_demo_importer_our_records_bgimage_for_mobile_about', TS_DEMO_IMPOTER_URL.'assets/images/our-records-image.png');
  set_theme_mod( 'ts_demo_importer_our_records_number',3);
  $records_no=array('12','1729','546','358');
  $records_title=array('Years of Experience','Satisfied Customer','Finished Projects','Employees Worldwide');
  for($i=1;$i<=4;$i++)
  {
    set_theme_mod( 'ts_demo_importer_our_records_no'.$i,$records_no[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_records_title'.$i,$records_title[$i-1] );
  }
  // footer
  set_theme_mod( 'multi_advance_footer_copy','(c) Copyright 2022, Multi Advance Theme' );

}

public function import_demo_advance_marketing_agency() {

  // importing common things
  $this->import_demo_theme_common_section();

  $home_id='';

  // Create a front page and assigned the template

  $home_content = '';

  $home_title = 'Home';
  $home = array(
     'post_type' => 'page',
     'post_title' => $home_title,
     'post_content'  => wp_slash( $home_content),
     'post_status' => 'publish',
     'post_author' => 1,
     'post_slug' => 'home'
   );
  $home_id = wp_insert_post($home);

  //Set the home page template
  add_post_meta( $home_id, '_wp_page_template', 'page-template/home-page.php' );


  //Set the static front page
  $home = get_page_by_title( 'Home' );
  update_option( 'page_on_front', $home->ID );
  update_option( 'show_on_front', 'page' );

  // Create a hiring-sidebar page and assigned the template
  $hiring_title = 'Hiring';
  $hiring = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $hiring_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'hiring'
  );
  $hiring_id = wp_insert_post($hiring);

  //Set the blog with right sidebar template
  add_post_meta( $hiring_id, '_wp_page_template', 'page-template/hiring.php' );
  add_post_meta( $hiring_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a projects page and assigned the template
  $projects_title = 'Portfolio';
  $projects = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $projects_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'projects'
  );
  $projects_id = wp_insert_post($projects);

  //Set the blog with right sidebar template
  add_post_meta( $projects_id, '_wp_page_template', 'page-template/projects.php' );
  add_post_meta( $projects_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a about-us page and assigned the template
  $about_us_title = 'About Us';
  $about_us = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $about_us_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'about-us'
  );
  $about_us_id = wp_insert_post($about_us);

  //Set the blog with right sidebar template
  add_post_meta( $about_us_id, '_wp_page_template', 'page-template/about-us.php' );
  add_post_meta( $about_us_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a team page and assigned the template
  $team_title = 'Team';
  $team = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $team_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'team'
  );
  $team_id = wp_insert_post($team);

  //Set the blog with right sidebar template
  add_post_meta( $team_id, '_wp_page_template', 'page-template/team.php' );
  add_post_meta( $team_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

  // -------------- Section Ordering ---------------
  // set_theme_mod( 'custom_logo' ,TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Header/logo.png' );
  // ------ Topbar -----------------------
  set_theme_mod( 'multi_advance_topbar_text','Revolutionary Products For Business Solutions' );
  set_theme_mod( 'multi_advance_mail_address','contact@business.com' );
  set_theme_mod( 'multi_advance_phoneno','+1 1234 567 890' );

  set_theme_mod( 'multi_advance_facebook_url','https://www.facebook.com/' );
  set_theme_mod( 'multi_advance_twitter_url','https://twitter.com/' );
  set_theme_mod( 'multi_advance_instagram_url','https://www.instagram.com/accounts/login/' );
  set_theme_mod( 'multi_advance_linkedin_url','https://www.linkedin.com/check/manage-account' );
  set_theme_mod( 'multi_advance_youtube_url','https://www.youtube.com/' );

  // header right button
  set_theme_mod( 'multi_advance_header_button_text','REACH US' );
  set_theme_mod( 'multi_advance_header_button_url','#' );

  set_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater', 'about-us,our-skills,our-services,banner,our-projects,personalized-support,best-services-offered,our-brands,skills-showcase,upcoming-events,latest-news,contact-map,content-area');

  /*  customizer-part-slide.php  */
    set_theme_mod( 'ts_demo_importer_slide_number', '3' );

  //================= home page second START ===================
  // ------------------Slider Template 2 START-----------------
  set_theme_mod('ts_demo_importer_slide_two_number', 3);
  for ($i=1; $i <=3 ; $i++) {
    set_theme_mod('ts_demo_importer_slide_two_image'.$i, TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Header/header-bg.png');

    set_theme_mod('ts_demo_importer_slide_small_heading'.$i,'Simple and Effective Business Solutions');
    set_theme_mod( 'ts_demo_importer_slide_heading'.$i, 'Simple and Intuitive Solutions');
    set_theme_mod( 'ts_demo_importer_slide_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore' );
    set_theme_mod( 'ts_demo_importer_slide_btn_one_text'.$i, 'View More' );
    set_theme_mod( 'ts_demo_importer_slide_btn_one_icon'.$i, 'fas fa-arrow-right' );

    set_theme_mod('ts_demo_importer_slide_two_left_girl_img'.$i, TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Header/girl-image.png');
    set_theme_mod('ts_demo_importer_slide_two_right_boy_img'.$i, TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Header/boy-image.png');
  }
  // slider 2 Delay
  set_theme_mod('ts_demo_importer_slide_delay','10000');
  // ------------------Slider Template 2 END-----------------
  // ------------- About Us START-------------
  set_theme_mod( 'ts_demo_importer_about_us_small_heading', 'About Us' );
  set_theme_mod( 'ts_demo_importer_about_us_main_heading', 'Helping Client Achieve a Compititive Advantage' );
  set_theme_mod( 'ts_demo_importer_about_us_text', 'Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odi sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan. Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita.' );

  set_theme_mod( 'ts_demo_importer_about_us_button_title', 'View More' );
  set_theme_mod( 'ts_demo_importer_about_us_button_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_about_us_button_url', '#' );
  set_theme_mod( 'ts_demo_importer_about_us_heading_image', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/AboutUs/about-us-image.png');
  set_theme_mod( 'ts_demo_importer_about_us_heading_image_alt_text', 'About Left Image' );

  set_theme_mod( 'ts_demo_importer_about_us_badge_icon', 'fas fa-quote-left' );
  set_theme_mod( 'ts_demo_importer_about_us_image_badge_text', 'Engagement and Brand storytelling are the heart of our approach.' );
  // ------------- About Us END-------------
  // ------------- Business Process start -----------------
  set_theme_mod( 'ts_demo_importer_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/BusinessProcess/business-process.png');
  // ------------- Business Process end -----------------
  // ----------- Our Skills START-----------
  set_theme_mod( 'ts_demo_importer_our_skills_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/OurSkills/our-skills-bg.png');
  set_theme_mod( 'ts_demo_importer_our_skills_small_heading', 'Our Skills' );
  set_theme_mod( 'ts_demo_importer_our_skills_main_heading', 'Compose The Perfect Business' );

  set_theme_mod( 'ts_demo_importer_our_skills_number', 3);
  $skills_title=array('Brand Positioning','Market Targeting ','customer Service');
  $skills_icon=array('fas fa-handshake','fas fa-envelope-open','fas fa-headphones');
  $skills_percent=array('25','45','75');
  for($i=1; $i<=4; $i++)
    {
  set_theme_mod( 'ts_demo_importer_our_skills_icon'.$i, $skills_icon[$i-1] );
  set_theme_mod( 'ts_demo_importer_our_skills_title'.$i, $skills_title[$i-1] );
  set_theme_mod( 'ts_demo_importer_our_skills_url'.$i, '#' );
  set_theme_mod( 'ts_demo_importer_our_skills_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' );
  set_theme_mod( 'ts_demo_importer_our_skills_percentage'.$i, $skills_percent[$i-1] );
    }
  // ----------- Our Skills END-----------
  // --------------- Our Services START -----------
  set_theme_mod( 'ts_demo_importer_our_services_small_heading', 'What We do' );
  set_theme_mod( 'ts_demo_importer_our_services_main_heading', 'Leading Services In The Industry' );

  set_theme_mod( 'ts_demo_importer_our_services_number', 5 );
  $services_title=array('Business Opportunity','Commercial Approch','Investment Strategy','Business Solutions', 'Business Analyst');
  for($i=1;$i<=5;$i++){
    $ts_title = $services_title[$i-1];
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

    // Create post object
    $my_post = array(
     'post_title'    => wp_strip_all_tags( $ts_title ),
     'post_content'  => wp_slash($content),
     'post_status'   => 'publish',
     'post_type'     => 'services',
    );

     // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id,'meta-short-title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/services/service-image'.$i.'.png';

    $image_name= 'service-image'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
    } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title'     => sanitize_file_name( $filename ),
     'post_content'   => '',
     'post_type'     => 'services',
     'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
     wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }

  set_theme_mod( 'ts_demo_importer_our_services_box_link_text', 'SEE PROJECT' );
  set_theme_mod( 'ts_demo_importer_our_services_box_link_icon', 'fas fa-arrow-right' );
  // --------------- Our Services END-----------
  // ------------ Banner START------------
  set_theme_mod( 'ts_demo_importer_banner_head', 'Business Process');
  set_theme_mod( 'ts_demo_importer_banner_head2', 'The Best solution for your business website');
  set_theme_mod( 'ts_demo_importer_banner_text', 'Nulla eleifend, lectus eu gravida facilisis, ipsum metus faucibus eros, vitae vulputate nibh libero ac metus. Phasellus magna erat, consectetur nec faucibus at, mollis vitae mauris.');
  set_theme_mod( 'ts_demo_importer_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/BusinessProcess/business-process.png');
  set_theme_mod( 'ts_demo_importer_banner_button_read_more', 'Watch Video');
  set_theme_mod ( 'ts_demo_importer_banner_button_read_more_url','#' );
  set_theme_mod( 'ts_demo_importer_banner_button_read_more_icon', 'fas fa-arrow-right');
  // ------------ Banner END------------
  // ---------------- Our Projects START---------
    set_theme_mod( 'ts_demo_importer_our_projects_small_heading', 'Recent Projects' );
    set_theme_mod( 'ts_demo_importer_our_projects_main_heading', 'Realize Your Projects, You Envision we Create' );

    set_theme_mod( 'ts_demo_importer_our_projects_number', 6);

    $project_title=array('Nike','yahoo!','Nvidia','Samsung','Marketing','Development');
    $project_type=array('Development','Design','Planning','Analysis','Testing','SEO');

    wp_insert_term(
      'All', // the term
      'projectscategory', // the taxonomy
      array(
        'description'=> 'Category description',
        'slug' => 'All',
        'term_id'=>23,
        'term_taxonomy_id'=>34,
    ));

  set_theme_mod( 'ts_demo_importer_our_projects_categoryselection_setting','All' );

  for($i=1; $i<=6; $i++){

  $ts_title = $project_title[$i-1];
  $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

  // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags( $ts_title ),
    'post_content'  => wp_slash($content),
    'post_status'   => 'publish',
    'post_type'     => 'projects',
  );

  // Insert the post into the database
  $ts_post_id = wp_insert_post( $my_post );

  $ts_term = get_term_by('name', 'All', 'projectscategory');
  wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
  update_post_meta( $ts_post_id,'meta-projects-type',$project_type[$i-1]);
  update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

  $image_url = TS_DEMO_IMPOTER_URL.'assets/images/projects/work'.$i.'.png';

  $image_name= 'work'.$i.'.png';
  $upload_dir = wp_upload_dir();
  // Set upload folder
  $image_data = file_get_contents($image_url);
  // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
  // Generate unique name
  $filename= basename( $unique_file_name );
  // Create image file name
  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
   $file = $upload_dir['path'] . '/' . $filename;
  } else {
   $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'projects',
  'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );
  // And finally assign featured image to post
  set_post_thumbnail( $ts_post_id, $attach_id );
  }

  set_theme_mod( 'ts_demo_importer_our_projects_box_link_text', 'LEARN MORE' );
    set_theme_mod( 'ts_demo_importer_our_projects_box_link_icon', 'fas fa-arrow-right' );

  /*--- Features---*/

  set_theme_mod( 'ts_demo_importer_features_number', 4 );
  $icon_array =array('fas fa-briefcase','fas fa-chart-line','fas fa-object-group','fas fa-globe');
  $title1_array =array('Business','Marketing','Finances','Marketing');
  $title2_array =array('opprtunities Full of wide growth','Competitive Sector Of The Industry','Group Productive And Innovative','Campaign and Marketing Analytics');
  for($i=1;$i<=4;$i++){
  set_theme_mod( 'ts_demo_importer_features_icon'.$i, $icon_array[$i-1] );
  set_theme_mod( 'ts_demo_importer_features_title'.$i, $title1_array[$i-1] );
  set_theme_mod( 'ts_demo_importer_features_title2'.$i, $title2_array[$i-1] );
  }

// ------------ Project Tab ----------
set_theme_mod( 'ts_demo_importer_our_projects_tab_small_heading', 'Portfolio' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_main_heading', 'Perfect Partner For Your Success' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_number', 5);

$project_tab_title = array('All','MARKETING','PROJECT','FINANCE','LIGAL','PROFFESSION','ADVISOR','DEDICATION');
$project_name = array('Vans','Yahoo!','Nvidia','Samsung','Telemarketing','Innovation','Investment','Finance','Business','Taxes','Management','Cloud','Collaboration','Services');
$project_content = array('Nike\'s Guerilla Marketing...',
               'Yahoo DFS Picks Week...',
               'Nivdia GeForce Now...',
               'One UI 4 Promo videos...',
               'Telemarketing et dolore...',
               'Innovation et dolore...',
               'Investment et dolore...',
               'Finance et dolore...',
               'Business et dolore...',
               'Taxes et dolore...',
               'Management et dolore...',
               'Cloud et dolore...',
               'Collaboration et dolore...',
               'Services et dolore...');
$project_tab_type = array('Development','Design','Planning','Analysis','Testing','SEO','Manage','Deliver');

set_theme_mod( 'ts_demo_importer_our_projects_tab_box_link_text', 'View More' );

for($i=1; $i<=8; $i++){
  wp_insert_term(
  $project_tab_title[$i-1], // the term
  'projectscategory', // the taxonomy
  array(
  'description'=> 'This is category description',
  'slug' => $project_tab_title[$i-1],
  'term_id'=>23,
  'term_taxonomy_id'=>34,
));

set_theme_mod( 'ts_demo_importer_our_projects_tab_name'.$i,$project_tab_title[$i-1] );
for($j=1; $j<=8; $j++){

  $ts_title = $project_name[$j-1];
  $content = $project_content[$j-1];

  set_theme_mod( 'ts_demo_importer_our_projects_tab_categoryselection_setting'.$j,$project_tab_title[$j-1] );


  // Create post object
  $my_post = array(
  'post_title'    => wp_strip_all_tags( $ts_title ),
  'post_content'  => wp_slash($content),
  'post_status'   => 'publish',
  'post_type'     => 'projects',
  );

  // Insert the post into the database
  $ts_post_id = wp_insert_post( $my_post );

  $ts_term = get_term_by('name', $project_tab_title[$i-1], 'projectscategory');
  wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
  update_post_meta( $ts_post_id,'meta-projects-type',$project_tab_type[$i-1]);
  update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

  $image_url = TS_DEMO_IMPOTER_URL.'assets/images/Homepage/RecentProjects/Project'.$j.'.png';

  $image_name= 'portfolio-image-'.$i.'.png';
  $upload_dir = wp_upload_dir();
  // Set upload folder
  $image_data = file_get_contents($image_url);
  // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
  // Generate unique name
  $filename= basename( $unique_file_name );
  // Create image file name
  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
  } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'projects',
  'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );
  // And finally assign featured image to post
  set_post_thumbnail( $ts_post_id, $attach_id );
  }
}

// ---------------- Our Projects END---------
  // ============ Personalized support START===========
  set_theme_mod( 'ts_demo_importer_personalized_support_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/PersonalizedSupport/design1.png');
  set_theme_mod( 'ts_demo_importer_personalized_support_bgimage1', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/PersonalizedSupport/memphis-circle-shape.png');
  // left column
  set_theme_mod('ts_demo_importer_personalized_support_left_small_heading','Personalized support');
  set_theme_mod('ts_demo_importer_personalized_support_left_main_heading','Experts you Can Rely On For Export Support');
  set_theme_mod('ts_demo_importer_personalized_support_left_para','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore ');
  set_theme_mod( 'ts_demo_importer_personalized_support_button_get_a_guidebook', 'GET A GUIDEBOOK' );
  set_theme_mod( 'ts_demo_importer_personalized_support_button_get_a_guidebook_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_about_us_button_url', '#' );
  // right column
  set_theme_mod( 'ts_demo_importer_personalized_support_records_number', 4 );
  $ps_records_no= array('100','245','24','614');
  $ps_records_title= array('Finished Sessions','Established Bussinesses','Sponsored Partners','Online Instructions');
  for ($i=1; $i <=4 ; $i++) {
  set_theme_mod( 'ts_demo_importer_personalized_support_records_no'.$i, $ps_records_no[$i-1] );
  set_theme_mod( 'ts_demo_importer_personalized_support_records_title'.$i, $ps_records_title[$i-1] );
  set_theme_mod( 'ts_demo_importer_personalized_support_records_para'.$i, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do' );
  }
  // ============ Personalized support END================
  // ============= Best Services Offered To You START========
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_back_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Video/design-elements.png');

  set_theme_mod( 'ts_demo_importer_best_services_offered_small_heading','Video');
  set_theme_mod( 'ts_demo_importer_best_services_offered_main_heading','Best Services Offered To You');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_link','https://www.youtube.com/embed/JH-DAJOyQ3w');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Video/video-section-thumbnail.png');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_icon', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Video/play-button.png');
  // ============= Best Services Offered To You END========
  // ----------- Skills Showcase START -----------
  set_theme_mod( 'ts_demo_importer_skills_showcase_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Skills/skills-background.png');
  set_theme_mod( 'ts_demo_importer_skills_showcase_small_heading', 'Skills' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_main_heading', 'Professional and Reliable Partner' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_section_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.' );

  set_theme_mod( 'ts_demo_importer_skills_showcase_number', 4 );

  $skills_percent_title=array('65','75','60','50');
  for($i=1;$i<=4;$i++)
  {
  set_theme_mod( 'ts_demo_importer_skills_showcase_title'.$i, 'Business Process Name '.$i );
  set_theme_mod( 'ts_demo_importer_skills_showcase_percentage'.$i, $skills_percent_title[$i-1] );

  }
  // ----------- Skills Showcase END -----------
  // --------------- Upcoming events START-------------------
  set_theme_mod( 'ts_demo_importer_upcoming_events_small_heading','Events');
  set_theme_mod( 'ts_demo_importer_upcoming_events_main_heading','Our Upcoming Events To Take Part In');
  set_theme_mod( 'ts_demo_importer_upcoming_events_left_img',TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Events/events-background.png');
  set_theme_mod( 'ts_demo_importer_upcoming_events_tab_number',12);
  // ============================== new code START =========================
  set_theme_mod('ts_demo_importer_upcoming_eventscategory_names', array('March','April','May','June','July'));


  $event_category= array(
    'January' => array(
            'January Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'January ProductCon: The Product Management Conference 2022',
            'January Comprehensive Guide For Software Developers',
    ),
    'February' => array(
            'February Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'February ProductCon: The Product Management Conference 2022',
            'February Comprehensive Guide For Software Developers',
    ),
    'March' => array(
            'March Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'March ProductCon: The Product Management Conference 2022',
            'March Comprehensive Guide For Software Developers',
    ),
    'April'  => array(
            'April Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'April ProductCon: The Product Management Conference 2022',
            'April Comprehensive Guide For Software Developers',
    ),
    'May'    => array(
            'May Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'May ProductCon: The Product Management Conference 2022',
            'May Comprehensive Guide For Software Developers',
    ),
    'June'   => array(
            'June Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'June ProductCon: The Product Management Conference 2022',
            'June Comprehensive Guide For Software Developers',
    ),
    'July'   => array(
            'July Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'July ProductCon: The Product Management Conference 2022',
            'July Comprehensive Guide For Software Developers',
    ),
    'August' => array(
            'August Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'August ProductCon: The Product Management Conference 2022',
            'August Comprehensive Guide For Software Developers',
    ),
    'September'	=> array(
            'September Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'September ProductCon: The Product Management Conference 2022',
            'September Comprehensive Guide For Software Developers',
    ),
    'October' => array(
            'October Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'October ProductCon: The Product Management Conference 2022',
            'October Comprehensive Guide For Software Developers',
    ),
    'November' => array(
            'November Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'November ProductCon: The Product Management Conference 2022',
            'November Comprehensive Guide For Software Developers',
    ),
    'December' => array(
            'December Design Thinking And Innovation Week 2022 For Anyone, Anywhere.',
            'December ProductCon: The Product Management Conference 2022',
            'December Comprehensive Guide For Software Developers',
    ),
  );

  $k = 1;

  foreach ($event_category as $event_name => $event_titles) {
   $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam.';

   $parent_category = wp_insert_term(
      $event_name, // the term
      'eventscategory', // the taxonomy
      array(
        'description'=> $content,
        'slug' => $event_name,
        'post_excerpt' => 'Meh synth Schlitz, tempor duis single-origin coffee ea next level',
      )
   );

  // Insert blog Cats END
  // =========== assign featured category image START =================
  // =========== assign featured category image START =================
  // Image Upload
  $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Events/'.$event_name.'.png';

  $image_name= 'img'.$k.'.png';

  $upload_dir       = wp_upload_dir();

  // Set upload folder
  $image_data       = file_get_contents($image_url);

  // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );

  // Generate unique name
  $filename= basename( $unique_file_name );

  // Create image file name
  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
  $file = $upload_dir['path'] . '/' . $filename;
  } else {
  $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'events',
  'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file ,$post_id);

  $attachment_url = wp_get_attachment_url( $attach_id );

  // Assign Image to the taxonomy
  $term_meta_id = add_term_meta( $parent_category['term_id'], 'eventscategory-image-id', $attach_id, true );
  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $tspost_id );
  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );
  // And finally assign featured image to post
  set_post_thumbnail( $tspost_id, $attach_id );
  // ================= assign featured category image END ====================
  // create Post START
  $l=1;
  foreach ( $event_titles as $key => $event_title ) {
  $content = 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
  $my_post = array(
     'post_title'    => wp_strip_all_tags( ucfirst( $event_title ) ),
     'post_content'  => $content,
     'post_status'   => 'publish',
     'post_type'     => 'events'
  );

  // var_dump($my_post); exit;
  // Insert the post into the database
  $tspost_id = wp_insert_post( $my_post );

  wp_set_object_terms( $tspost_id, $parent_category['term_id'], 'eventscategory');

  //Set the blog page template
  add_post_meta( $tspost_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

  update_post_meta( $tspost_id, 'ts_demo_importer_event_time','7PM - 9PM');
  update_post_meta( $tspost_id, 'ts_demo_importer_event_location','San Diego');

  ++$l;
  }


  ++$k;
  }
  // ============================== new code END ==========================
  // --------------- Upcoming events END-------------------
  // ----------- Latest News START -----------
  set_theme_mod( 'ts_demo_importer_latest_news_small_heading', 'Blogs' );
  set_theme_mod( 'ts_demo_importer_latest_news_main_heading', 'Latest News From Us' );
  set_theme_mod( 'ts_demo_importer_post_excerpt_no', '15' );

  wp_delete_post(1);

  set_theme_mod( 'ts_demo_importer_latest_news_number', 9);

  $blog_category = array(
     'MARKETING' 		=> array(
       'How is rural marketing capturing the uncap',
       'What the IPO financing clampdown means f',
       'How 15 Best Cities for Business in the Worl',
       'Essential Hotel Management Strategies',
       'The True Cost Of Your Handmade Soap'
     ),

     'FINANCE' => array(
       'Creating Ideas and Building Brands',
       'Process Of Creating a Strong, Positive Perce',
       'How is rural marketing capturing the uncap',
       'The New Minimalist Office Spaces in Monte',
       'Apps That Can Help You With Productivity'
     ),

     'BUSINESS' 		=> array(
       'Finding Cleaner Ways To Power The World',
       'Tips On Brand Positioning and Startup',
       'Apps That Can Help You With Productivity',
       'Finding Cleaner Ways To Power The World',
       'Tips On Brand Positioning and Startup'
     )
   );
   $k = 1;

   foreach ($blog_category as $category_name => $blog_titles) {
     $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, magna aliqua.';

     $parent_category = wp_insert_term(
            $category_name, // the term
            'category', // the taxonomy
            array(
              'description'=> $content,
              'slug' => 'post_cat'.$k,
              'post_excerpt' => 'Meh synth Schlitz, tempor duis single-origin coffee ea next level',
            )
           );
  // Insert blog Cats END
  // create Post START
        $image_1 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image7.png';
        $image_2 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image4.png';

        $l=1;
        foreach ( $blog_titles as $key => $blog_title ) {


          $content = '<div class="entry-content"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
          <blockquote class="wp-block-quote"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, </p><cite>Tom Hank</cite></blockquote>
          <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
          <figure class="wp-block-gallery columns-2 is-cropped"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_1.'" alt="" data-id="377" data-link="'.$image_1.'" class="wp-image-377"></figure></li><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_2.'" alt="" data-id="378" data-link="'.$image_2.'" class="wp-image-378"></figure></li></ul></figure>
          <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p></div>';

          $my_post = array(
             'post_title'    => wp_strip_all_tags( $blog_title ),
             'post_content'  => $content,
             'post_status'   => 'publish',
             'post_type'     => 'post',
             'post_category' => [$parent_category['term_id']]
          );
           // Insert the post into the database
          $tcpost_id = wp_insert_post( $my_post );

          //Set the blog page template
          add_post_meta( $tcpost_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

          $image_url = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image'.$key.'.png';

          $image_name= 'blog-list-image'.$key.'.png';
          $upload_dir       = wp_upload_dir();
          // Set upload folder
          $image_data       = file_get_contents($image_url);
          // Get image data
          $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
          // Generate unique name
          $filename= basename( $unique_file_name );
          // Create image file name
          // Check folder permission and define file location
          if( wp_mkdir_p( $upload_dir['path'] ) ) {
             $file = $upload_dir['path'] . '/' . $filename;
          } else {
             $file = $upload_dir['basedir'] . '/' . $filename;
          }
          // Create the image  file on the server
          file_put_contents( $file, $image_data );
          // Check image file type
          $wp_filetype = wp_check_filetype( $filename, null );
          // Set attachment data
          $attachment = array(
             'post_mime_type' => $wp_filetype['type'],
             'post_title'     => sanitize_file_name( $filename ),
             'post_content'   => '',
             'post_type'     => 'post',
             'post_status'    => 'inherit'
          );

          // Create the attachment
          $attach_id = wp_insert_attachment( $attachment, $file, $tcpost_id );
          // Include image.php
          require_once(ABSPATH . 'wp-admin/includes/image.php');
          // Define attachment metadata
          $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
          // Assign metadata to attachment
           wp_update_attachment_metadata( $attach_id, $attach_data );
          // And finally assign featured image to post
          set_post_thumbnail( $tcpost_id, $attach_id );
          ++$l;
         }
        // Create post END

      ++$k;
   }

  set_theme_mod('ts_demo_importer_latest_blog_like_button', '[posts_like_dislike]');
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_text', 'Read More' );
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_icon', 'fas fa-arrow-right');
  // ----------- Latest News END -----------
  // contact form shortcode
  $cf7title = "Contact Map";
  $cf7content = '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]
  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [_site_admin_email]
  Reply-To: [your-email]

  0
  0

  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [your-email]
  Reply-To: [_site_admin_email]

  0
  0
  Thank you for your message. It has been sent.
  There was an error trying to send your message. Please try again later.
  One or more fields have an error. Please check and try again.
  There was an error trying to send your message. Please try again later.
  You must accept the terms and conditions before sending your message.
  The field is required.
  The field is too long.
  The field is too short.
  There was an unknown error uploading the file.
  You are not allowed to upload files of this type.
  The file is too big.
  There was an error uploading the file.';

  $cf7_post = array(
  'post_title'    => wp_strip_all_tags( $cf7title ),
  'post_content'  => wp_slash($cf7content),
  'post_status'   => 'publish',
  'post_type'     => 'wpcf7_contact_form',
  );
  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]' );

  $cf7mail_data  = array(
  'subject' => '[_site_title] "[your-subject]"',
  'sender' => '[_site_title] <supprt@themeshopy.com>',
  'body' => 'From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])',
  'recipient' => '[_site_admin_email]',
  'additional_headers' => 'Reply-To: [your-email]',
  'attachments' => '',
  'use_html' => 0,
  'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);
      // Gets term object from Tree in the database.

  $cf7shortcode3 = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';

  set_theme_mod( 'ts_demo_importer_contact_map_shortcode',$cf7shortcode3 );

  //post setting
  set_theme_mod( 'ts_demo_importer_related_posts_title', 'Related Posts' );
  set_theme_mod( 'ts_demo_importer_related_post_count', 3 );
  set_theme_mod( 'ts_demo_importer_blog_category_prev_title', 'Previous' );
  set_theme_mod( 'ts_demo_importer_blog_category_next_title', 'Next' );

  //================= home page second END ===================
  // ----------- Our Records ----------
  set_theme_mod( 'ts_demo_importer_our_records_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/our-records-image.png');
  set_theme_mod( 'ts_demo_importer_our_records_number',3);
  $records_no=array('12','1729','546','358');
  $records_title=array('Years of Experience','Satisfied Customer','Finished Projects','Employees Worldwide');
  for($i=1;$i<=4;$i++)
  {
    set_theme_mod( 'ts_demo_importer_our_records_no'.$i,$records_no[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_records_title'.$i,$records_title[$i-1] );
  }
  // footer
  set_theme_mod( 'multi_advance_footer_copy','(c) Copyright 2022, Advance Marketing Agency Theme' );

}

public function import_demo_advance_consultancy(){

  // vw_title_banner_image_wp_custom_attachment START
  $image_url 	= TS_DEMO_IMPOTER_URL.'/assets/images/banner.png';
  $upload_dir = wp_upload_dir();
  $image_data = file_get_contents( $image_url );
  $filename = basename( $image_url );
  if ( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
  } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
  }
  file_put_contents( $file, $image_data );
  $wp_filetype = wp_check_filetype( $filename, null );
  $attachment = array(
    'post_mime_type'	=> $wp_filetype['type'],
    'post_title' 			=> sanitize_file_name( $filename ),
    'post_content' 		=> '',
    'post_status' 		=> 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $file );
  require_once( ABSPATH . 'wp-admin/includes/image.php' );
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  wp_update_attachment_metadata( $attach_id, $attach_data );
  $attachment_url = wp_get_attachment_url( $attach_id );
  // vw_title_banner_image_wp_custom_attachment END

  // importing common things
  $this->import_demo_theme_common_section();

  $home_id='';

  // Create a front page and assigned the template

  $home_content = '';

  $home_title = 'Home';
  $home = array(
     'post_type' => 'page',
     'post_title' => $home_title,
     'post_content'  => wp_slash( $home_content),
     'post_status' => 'publish',
     'post_author' => 1,
     'post_slug' => 'home'
   );
  $home_id = wp_insert_post($home);

  //Set the home page template
  add_post_meta( $home_id, '_wp_page_template', 'page-template/home-page.php' );


  //Set the static front page
  $home = get_page_by_title( 'Home' );
  update_option( 'page_on_front', $home->ID );
  update_option( 'show_on_front', 'page' );

  // Create a hiring-sidebar page and assigned the template
  $hiring_title = 'Hiring';
  $hiring = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $hiring_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'hiring'
  );
  $hiring_id = wp_insert_post($hiring);

  //Set the blog with right sidebar template
  add_post_meta( $hiring_id, '_wp_page_template', 'page-template/hiring.php' );
  add_post_meta( $hiring_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a projects page and assigned the template
  $projects_title = 'Portfolio';
  $projects = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $projects_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'projects'
  );
  $projects_id = wp_insert_post($projects);

  //Set the blog with right sidebar template
  add_post_meta( $projects_id, '_wp_page_template', 'page-template/projects.php' );
  add_post_meta( $projects_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a about-us page and assigned the template
  $about_us_title = 'About Us';
  $about_us = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $about_us_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'about-us'
  );
  $about_us_id = wp_insert_post($about_us);

  //Set the blog with right sidebar template
  add_post_meta( $about_us_id, '_wp_page_template', 'page-template/about-us.php' );
  add_post_meta( $about_us_id, 'title_banner_image_wp_custom_attachment', $attachment_url );


  // Create a team page and assigned the template
  $team_title = 'Team';
  $team = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $team_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'team'
  );
  $team_id = wp_insert_post($team);

  //Set the blog with right sidebar template
  add_post_meta( $team_id, '_wp_page_template', 'page-template/team.php' );
  add_post_meta( $team_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

  // -------------- Section Ordering ---------------
  // set_theme_mod( 'custom_logo' ,TS_DEMO_IMPOTER_URL.'/assets/images/Homepage/Header/logo.png' );
  // ------ Topbar -----------------------
  set_theme_mod( 'multi_advance_topbar_text','Revolutionary Products For Business Solutions' );
  set_theme_mod( 'multi_advance_mail_address','contact@business.com' );
  set_theme_mod( 'multi_advance_phoneno','+1 1234 567 890' );

  set_theme_mod( 'multi_advance_facebook_url','https://www.facebook.com/' );
  set_theme_mod( 'multi_advance_twitter_url','https://twitter.com/' );
  set_theme_mod( 'multi_advance_instagram_url','https://www.instagram.com/accounts/login/' );
  set_theme_mod( 'multi_advance_linkedin_url','https://www.linkedin.com/check/manage-account' );
  set_theme_mod( 'multi_advance_youtube_url','https://www.youtube.com/' );

  // header right button
  set_theme_mod( 'multi_advance_header_button_text','REACH US' );
  set_theme_mod( 'multi_advance_header_button_url','#' );

  set_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater', 'about-us,our-skills,our-services,banner,our-projects,personalized-support,best-services-offered,our-brands,skills-showcase,pricing-plan,testimonials,contact-map,content-area,latest-news,interested-banner');

  /*  customizer-part-slide.php  */
  set_theme_mod( 'ts_demo_importer_slide_number', '5' );
  // Slider Images Section
  for($i=1; $i<=5; $i++) {
    set_theme_mod( 'ts_demo_importer_slide_image'.$i,TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Header/header-image/header-image'.$i.'.png' );
    set_theme_mod('ts_demo_importer_slide_image_alt_text'.$i,'Alt Tag for image slider');
    //Slide top title
    set_theme_mod('ts_demo_importer_slide_heading'.$i,'Committed To People Committed To The Future');
    //Slide Text section
    set_theme_mod( 'ts_demo_importer_slide_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis' );
    //Slider Button 1 Text section
    set_theme_mod( 'ts_demo_importer_slide_btn_one_text'.$i, 'START NOW' );
    set_theme_mod( 'ts_demo_importer_slide_btn_one_icon'.$i, 'fas fa-arrow-right' );
  }
  //Slide Delay
  set_theme_mod( 'ts_demo_importer_slide_delay', '10000' );

  // ------------------Slider Template 3 END-----------------
  // ------------- About Us START-------------
  set_theme_mod( 'ts_demo_importer_about_us_small_heading', 'About Us' );
  set_theme_mod( 'ts_demo_importer_about_us_main_heading', 'Work With Tried And True Experts' );
  set_theme_mod( 'ts_demo_importer_about_us_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' );

  set_theme_mod( 'ts_demo_importer_about_us_button_title', 'View More' );
  set_theme_mod( 'ts_demo_importer_about_us_button_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_about_us_button_url', '#' );
  set_theme_mod( 'ts_demo_importer_about_us_heading_image', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/About-Us/about-us-image.png');
  set_theme_mod( 'ts_demo_importer_about_us_heading_image_alt_text', 'About Left Image' );

  set_theme_mod( 'ts_demo_importer_about_us_badge_icon', 'fas fa-quote-left' );
  set_theme_mod( 'ts_demo_importer_about_us_image_badge_text', 'We specialize in UI/UX, web development, digital marketing.' );
  // ------------- About Us END-------------
  // ------------- Business Process start -----------------
  set_theme_mod( 'ts_demo_importer_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/BusinessProcess/business-process.png');
  // ------------- Business Process end -----------------
  // ----------- Our Skills START-----------
  set_theme_mod( 'ts_demo_importer_our_skills_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Skills/skills.png');
  set_theme_mod( 'ts_demo_importer_our_skills_small_heading', 'Our Skills' );
  set_theme_mod( 'ts_demo_importer_our_skills_main_heading', 'Compose The Perfect Business' );

  set_theme_mod( 'ts_demo_importer_our_skills_number', 3);
  $skills_title=array('Expand Your Research','Annualized Growth','Book Your Providers');
  $skills_icon=array('fas fa-search','fas fa-chart-line','fas fa-headphones');
  $skills_percent=array('25','45','75');
  for($i=1; $i<=4; $i++)
    {
  set_theme_mod( 'ts_demo_importer_our_skills_icon'.$i, $skills_icon[$i-1] );
  set_theme_mod( 'ts_demo_importer_our_skills_title'.$i, $skills_title[$i-1] );
  set_theme_mod( 'ts_demo_importer_our_skills_url'.$i, '#' );
  set_theme_mod( 'ts_demo_importer_our_skills_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' );
  set_theme_mod( 'ts_demo_importer_our_skills_percentage'.$i, $skills_percent[$i-1] );
    }
  // ----------- Our Skills END-----------
  // --------------- Our Services START -----------
  set_theme_mod( 'ts_demo_importer_our_services_small_heading', 'What We do' );
  set_theme_mod( 'ts_demo_importer_our_services_main_heading', 'Leading Services In The Industry' );

  set_theme_mod( 'ts_demo_importer_our_services_number', 5 );
  $services_title=array('Business Opportunity','Commercial Approch','Investment Strategy','Business Solutions', 'Business Analyst');
  for($i=1;$i<=5;$i++){
    $ts_title = $services_title[$i-1];
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

    // Create post object
    $my_post = array(
     'post_title'    => wp_strip_all_tags( $ts_title ),
     'post_content'  => wp_slash($content),
     'post_status'   => 'publish',
     'post_type'     => 'services',
    );

     // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id,'meta-short-title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/services/service-image'.$i.'.png';

    $image_name= 'service-image'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
    } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title'     => sanitize_file_name( $filename ),
     'post_content'   => '',
     'post_type'     => 'services',
     'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
     wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }

  set_theme_mod( 'ts_demo_importer_our_services_box_link_text', 'LEARN MORE' );
  set_theme_mod( 'ts_demo_importer_our_services_box_link_icon', 'fas fa-arrow-right' );
  // --------------- Our Services END-----------
  // ------------ Banner START------------
  set_theme_mod( 'ts_demo_importer_banner_head', 'Business Process');
  set_theme_mod( 'ts_demo_importer_banner_head2', 'We Have The Right Solutions For Your Business');
  set_theme_mod( 'ts_demo_importer_banner_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
  set_theme_mod( 'ts_demo_importer_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Business-Process/business-process-img.png');
  set_theme_mod( 'ts_demo_importer_banner_button_read_more', 'WATCH VIDEO');
  set_theme_mod ( 'ts_demo_importer_banner_button_read_more_url','#' );
  set_theme_mod( 'ts_demo_importer_banner_button_read_more_icon', 'fas fa-arrow-right');
  // ------------ Banner END------------
  // ---------------- Our Projects START---------
    set_theme_mod( 'ts_demo_importer_our_projects_small_heading', 'Recent Projects' );
    set_theme_mod( 'ts_demo_importer_our_projects_main_heading', 'Simple Solutions For Complex Connections' );

    set_theme_mod( 'ts_demo_importer_our_projects_number', 6);

    $project_title=array('Nike','yahoo!','Nvidia','Samsung','Marketing','Development');
    $project_type=array('Development','Design','Planning','Analysis','Testing','SEO');

    wp_insert_term(
      'All', // the term
      'projectscategory', // the taxonomy
      array(
        'description'=> 'Category description',
        'slug' => 'All',
        'term_id'=>23,
        'term_taxonomy_id'=>34,
    ));

  set_theme_mod( 'ts_demo_importer_our_projects_categoryselection_setting','All' );

  for($i=1; $i<=6; $i++){

  $ts_title = $project_title[$i-1];
  $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio';

  // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags( $ts_title ),
    'post_content'  => wp_slash($content),
    'post_status'   => 'publish',
    'post_type'     => 'projects',
  );

  // Insert the post into the database
  $ts_post_id = wp_insert_post( $my_post );

  $ts_term = get_term_by('name', 'All', 'projectscategory');
  wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
  update_post_meta( $ts_post_id,'meta-projects-type',$project_type[$i-1]);
  update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

  $image_url = TS_DEMO_IMPOTER_URL.'assets/images/projects/work'.$i.'.png';

  $image_name= 'work'.$i.'.png';
  $upload_dir = wp_upload_dir();
  // Set upload folder
  $image_data = file_get_contents($image_url);
  // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
  // Generate unique name
  $filename= basename( $unique_file_name );
  // Create image file name
  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
   $file = $upload_dir['path'] . '/' . $filename;
  } else {
   $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'projects',
  'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );
  // And finally assign featured image to post
  set_post_thumbnail( $ts_post_id, $attach_id );
  }

  set_theme_mod( 'ts_demo_importer_our_projects_box_link_text', 'LEARN MORE' );
    set_theme_mod( 'ts_demo_importer_our_projects_box_link_icon', 'fas fa-arrow-right' );

  /*--- Features---*/

  set_theme_mod( 'ts_demo_importer_features_number', 4 );
  $icon_array =array('fas fa-briefcase','fas fa-chart-line','fas fa-object-group','fas fa-globe');
  $title1_array =array('Business','Marketing','Finances','Marketing');
  $title2_array =array('opprtunities Full of wide growth','Competitive Sector Of The Industry','Group Productive And Innovative','Campaign and Marketing Analytics');
  for($i=1;$i<=4;$i++){
  set_theme_mod( 'ts_demo_importer_features_icon'.$i, $icon_array[$i-1] );
  set_theme_mod( 'ts_demo_importer_features_title'.$i, $title1_array[$i-1] );
  set_theme_mod( 'ts_demo_importer_features_title2'.$i, $title2_array[$i-1] );
  }

// ------------ Project Tab ----------
set_theme_mod( 'ts_demo_importer_our_projects_tab_small_heading', 'Portfolio' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_main_heading', 'Perfect Partner For Your Success' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.' );
set_theme_mod( 'ts_demo_importer_our_projects_tab_number', 5);

$project_tab_title = array('All','MARKETING','PROJECT','FINANCE','LIGAL','PROFFESSION','ADVISOR','DEDICATION');
$project_name = array('Vans','Yahoo!','Nvidia','Samsung','Telemarketing','Innovation','Investment','Finance','Business','Taxes','Management','Cloud','Collaboration','Services');
$project_content = array('Nike\'s Guerilla Marketing...',
               'Yahoo DFS Picks Week...',
               'Nivdia GeForce Now...',
               'One UI 4 Promo videos...',
               'Telemarketing et dolore...',
               'Innovation et dolore...',
               'Investment et dolore...',
               'Finance et dolore...',
               'Business et dolore...',
               'Taxes et dolore...',
               'Management et dolore...',
               'Cloud et dolore...',
               'Collaboration et dolore...',
               'Services et dolore...');
$project_tab_type = array('Development','Design','Planning','Analysis','Testing','SEO','Manage','Deliver');

set_theme_mod( 'ts_demo_importer_our_projects_tab_box_link_text', 'View More' );

for($i=1; $i<=8; $i++){
  wp_insert_term(
  $project_tab_title[$i-1], // the term
  'projectscategory', // the taxonomy
  array(
  'description'=> 'This is category description',
  'slug' => $project_tab_title[$i-1],
  'term_id'=>23,
  'term_taxonomy_id'=>34,
));

set_theme_mod( 'ts_demo_importer_our_projects_tab_name'.$i,$project_tab_title[$i-1] );
for($j=1; $j<=8; $j++){

  $ts_title = $project_name[$j-1];
  $content = $project_content[$j-1];

  set_theme_mod( 'ts_demo_importer_our_projects_tab_categoryselection_setting'.$j,$project_tab_title[$j-1] );


  // Create post object
  $my_post = array(
  'post_title'    => wp_strip_all_tags( $ts_title ),
  'post_content'  => wp_slash($content),
  'post_status'   => 'publish',
  'post_type'     => 'projects',
  );

  // Insert the post into the database
  $ts_post_id = wp_insert_post( $my_post );

  $ts_term = get_term_by('name', $project_tab_title[$i-1], 'projectscategory');
  wp_set_object_terms($ts_post_id, $ts_term->term_id, 'projectscategory');
  update_post_meta( $ts_post_id,'meta-projects-type',$project_tab_type[$i-1]);
  update_post_meta( $ts_post_id,'meta-projects-sd','This is short description.....');

  $image_url = TS_DEMO_IMPOTER_URL.'assets/images/Homepage/RecentProjects/Project'.$j.'.png';

  $image_name= 'portfolio-image-'.$i.'.png';
  $upload_dir = wp_upload_dir();
  // Set upload folder
  $image_data = file_get_contents($image_url);
  // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
  // Generate unique name
  $filename= basename( $unique_file_name );
  // Create image file name
  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
  } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'projects',
  'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );
  // And finally assign featured image to post
  set_post_thumbnail( $ts_post_id, $attach_id );
  }
}

// ---------------- Our Projects END---------
  // ============ Personalized support START===========
  set_theme_mod( 'ts_demo_importer_personalized_support_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/PersonalizedSupport/design1.png');
  set_theme_mod( 'ts_demo_importer_personalized_support_bgimage1', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/PersonalizedSupport/memphis-circle-shape.png');
  // left column
  set_theme_mod('ts_demo_importer_personalized_support_left_small_heading','Our Records');
  set_theme_mod('ts_demo_importer_personalized_support_left_main_heading','Insights That Drives Change');
  set_theme_mod('ts_demo_importer_personalized_support_left_para','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore ');
  set_theme_mod( 'ts_demo_importer_personalized_support_button_get_a_guidebook', 'GET A GUIDEBOOK' );
  set_theme_mod( 'ts_demo_importer_personalized_support_button_get_a_guidebook_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_personalized_support_button_url', '#' );
  // right column
  set_theme_mod( 'ts_demo_importer_personalized_support_records_number', 4 );
  $ps_records_no= array('100','245','24','614');
  $ps_records_title= array('Private Office','Co-working Desks','Sponsored Partners','Meeting Rooms');
  for ($i=1; $i <=4 ; $i++) {
  set_theme_mod( 'ts_demo_importer_personalized_support_records_no'.$i, $ps_records_no[$i-1] );
  set_theme_mod( 'ts_demo_importer_personalized_support_records_title'.$i, $ps_records_title[$i-1] );
  set_theme_mod( 'ts_demo_importer_personalized_support_records_para'.$i, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do' );
  }
  // ============ Personalized support END================
  // ----------- Pricing Plan ------------
  set_theme_mod( 'ts_demo_importer_pricing_plan_small_heading', 'Pricing Plans' );
  set_theme_mod( 'ts_demo_importer_pricing_plan_main_heading', 'The Right Plan For Your Business' );
  set_theme_mod( 'ts_demo_importer_pricing_plan_number', 3);
  $plan_title=array('Basic','Professional','Enterprise');
  $plan_feature=array('Lorem ipsum dolor','Lorem ipsum dolor','Lorem ipsum dolor');
  $plan_price=array('20','60','100');
  $plan_basic=array('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore',
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore',
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore');
  for($i=1;$i<=3;$i++)
  {
    set_theme_mod( 'ts_demo_importer_pricing_plan_price_currency'.$i, '$');
    set_theme_mod( 'ts_demo_importer_pricing_plan_title'.$i,$plan_title[$i-1]);
    set_theme_mod( 'ts_demo_importer_pricing_plan_price'.$i, $plan_price[$i-1] );
    set_theme_mod( 'ts_demo_importer_pricing_plan_duration'.$i, $plan_basic[$i-1] );
    set_theme_mod( 'ts_demo_importer_pricing_plan_feature_no'.$i, 3);
    for($j=1;$j<=3;$j++)
    {
      set_theme_mod( 'ts_demo_importer_pricing_plan_feature_title'.$i.$j,$plan_feature[$j-1]);
    }
    set_theme_mod( 'ts_demo_importer_pricing_plan_button_title'.$i, 'START NOW' );
    set_theme_mod( 'ts_demo_importer_pricing_plan_button_icon'.$i, 'fas fa-arrow-right');
  }
  set_theme_mod( 'ts_demo_importer_pricing_plan_recommeded_tag', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Pricing-Plans/recommeded-tag.png' );
  // ------------ Testimonial  ------------
  set_theme_mod( 'ts_demo_importer_testimonials_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Testimonials/testimonials-backgorund.png' );
  set_theme_mod( 'ts_demo_importer_testimonials_small_heading', 'Testimonials' );
  set_theme_mod( 'ts_demo_importer_testimonials_main_heading', 'Insights That Drives Change' );
  set_theme_mod( 'ts_demo_importer_testimonial_number', 3 );
  set_theme_mod( 'ts_demo_importer_testimonial_excerpt_no', 25 );
  $testimonials_title=array('Alin Decros','John Fernandez','Alin Decros');
  for($i=1;$i<=3;$i++)
  {
    $ts_title = $testimonials_title[$i-1];
    $content = 'It\'s easy for marketers to brag about how great their product or service is. Writing compelling copy, shooting enticing photos, or even producing glamorous videos are all tactics';
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $ts_title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'testimonials',
    );
    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id,'ts_demo_importer_posttype_testimonial_desigstory','Developers');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Testimonials/testimonial'.$i.'.png';
    $image_name= 'client'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'testimonials',
      'post_status'    => 'inherit'
    );
    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }
  // ============= Best Services Offered To You START========
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_back_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Homepage/Video/design-elements.png');

  set_theme_mod( 'ts_demo_importer_best_services_offered_small_heading','Video');
  set_theme_mod( 'ts_demo_importer_best_services_offered_main_heading','We\'re Awesome Team For Your Business Dream');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_link','https://www.youtube.com/embed/JH-DAJOyQ3w');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Video/video-export.png');
  set_theme_mod( 'ts_demo_importer_best_services_offered_video_icon', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Video/play-button.png');
  // ============= Best Services Offered To You END========
  // ----------- Skills Showcase START -----------
  set_theme_mod( 'ts_demo_importer_skills_showcase_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Professional-Skills/skills2-image.png');
  set_theme_mod( 'ts_demo_importer_skills_showcase_small_heading', 'Skills' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_main_heading', 'Professional and Reliable Partner' );
  set_theme_mod( 'ts_demo_importer_skills_showcase_section_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.' );

  set_theme_mod( 'ts_demo_importer_skills_showcase_number', 4 );

  $skills_percent_title=array('65','75','60','50');
  for($i=1;$i<=4;$i++)
  {
  set_theme_mod( 'ts_demo_importer_skills_showcase_title'.$i, 'Business Process Name '.$i );
  set_theme_mod( 'ts_demo_importer_skills_showcase_percentage'.$i, $skills_percent_title[$i-1] );

  }
  // ----------- Skills Showcase END -----------
  // ----------- interested banner start ----------------
  set_theme_mod( 'ts_demo_importer_interested_banner_left_main_heading','Interested? Do You Have Any Project To Working With?' );
  set_theme_mod( 'ts_demo_importer_interested_banner_button','Get Quote' );
  set_theme_mod( 'ts_demo_importer_interested_banner_button_url','#' );
  set_theme_mod( 'ts_demo_importer_interested_banner_button_icon','fas fa-arrow-right' );

  set_theme_mod( 'ts_demo_importer_interested_banner_right_image', TS_DEMO_IMPOTER_URL.'assets/images/Start-up-Theme-Assets/Quote/get-quote-image.png' );
  set_theme_mod( 'ts_demo_importer_interested_banner_right_image_alt_text','Interested Banner' );
  // ----------- interested banner end----------------
  // ----------- Latest News START -----------
  set_theme_mod( 'ts_demo_importer_latest_news_small_heading', 'Blogs' );
  set_theme_mod( 'ts_demo_importer_latest_news_main_heading', 'Latest News From Us' );
  set_theme_mod( 'ts_demo_importer_post_excerpt_no', '15' );

  wp_delete_post(1);

  set_theme_mod( 'ts_demo_importer_latest_news_number', 9);

  $blog_category = array(
     'MARKETING' 		=> array(
       'How is rural marketing capturing the uncap',
       'What the IPO financing clampdown means f',
       'How 15 Best Cities for Business in the Worl',
       'Essential Hotel Management Strategies',
       'The True Cost Of Your Handmade Soap'
     ),

     'FINANCE' => array(
       'Creating Ideas and Building Brands',
       'Process Of Creating a Strong, Positive Perce',
       'How is rural marketing capturing the uncap',
       'The New Minimalist Office Spaces in Monte',
       'Apps That Can Help You With Productivity'
     ),

     'BUSINESS' 		=> array(
       'Finding Cleaner Ways To Power The World',
       'Tips On Brand Positioning and Startup',
       'Apps That Can Help You With Productivity',
       'Finding Cleaner Ways To Power The World',
       'Tips On Brand Positioning and Startup'
     )
   );
   $k = 1;

   foreach ($blog_category as $category_name => $blog_titles) {
     $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, magna aliqua.';

     $parent_category = wp_insert_term(
            $category_name, // the term
            'category', // the taxonomy
            array(
              'description'=> $content,
              'slug' => 'post_cat'.$k,
              'post_excerpt' => 'Meh synth Schlitz, tempor duis single-origin coffee ea next level',
            )
           );
  // Insert blog Cats END
  // create Post START
        $image_1 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image7.png';
        $image_2 = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image4.png';

        $l=1;
        foreach ( $blog_titles as $key => $blog_title ) {


          $content = '<div class="entry-content"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
          <blockquote class="wp-block-quote"><p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, </p><cite>Tom Hank</cite></blockquote>
          <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p>
          <figure class="wp-block-gallery columns-2 is-cropped"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_1.'" alt="" data-id="377" data-link="'.$image_1.'" class="wp-image-377"></figure></li><li class="blocks-gallery-item"><figure><img loading="lazy" width="476" height="337" src="'.$image_2.'" alt="" data-id="378" data-link="'.$image_2.'" class="wp-image-378"></figure></li></ul></figure>
          <p>Lorem ipsum dolor sit amet, sea ei diam ocurreret. Atqui clita eu eos, in interesset mediocritatem sit. Saperet commune invenire at per, ne consul eirmod scaevola ius, case scripta id vis. Ad cum magna deleniti. Nihil antiopam et mei, an sea facer mnesarchum, sea ne soluta appetere tacimates. Ad soluta ignota corrumpit eos. Has patrioque delicatissimi ut, per veritus alienum te, nec choro soluta fabulas in. Quod sensibus est id, has nullam cetero sadipscing cu, ex duo oratio verear assentior. Dicunt eirmod vituperata sit cu, ei mei liber inermis. At sea erat aperiri offendit, nonumy ignota dolores has ei. Mea an dicunt latine, sit ei veri assueverit deterruisset. Vim idque omnesque consequat an. Facilisis adversarium no qui, case quaerendum duo cu. Eam ut dico audire, agam elitr audire te sed, ex singulis platonem vis. Altera ancillae quo te, ex everti comprehensam sed per decore.</p></div>';

          $my_post = array(
             'post_title'    => wp_strip_all_tags( $blog_title ),
             'post_content'  => $content,
             'post_status'   => 'publish',
             'post_type'     => 'post',
             'post_category' => [$parent_category['term_id']]
          );
           // Insert the post into the database
          $tcpost_id = wp_insert_post( $my_post );

          //Set the blog page template
          add_post_meta( $tcpost_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

          $image_url = TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-list-image'.$i.'.png';

          $image_name= 'blog-list-image'.$i.'.png';
          $upload_dir       = wp_upload_dir();
          // Set upload folder
          $image_data       = file_get_contents($image_url);
          // Get image data
          $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
          // Generate unique name
          $filename= basename( $unique_file_name );
          // Create image file name
          // Check folder permission and define file location
          if( wp_mkdir_p( $upload_dir['path'] ) ) {
             $file = $upload_dir['path'] . '/' . $filename;
          } else {
             $file = $upload_dir['basedir'] . '/' . $filename;
          }
          // Create the image  file on the server
          file_put_contents( $file, $image_data );
          // Check image file type
          $wp_filetype = wp_check_filetype( $filename, null );
          // Set attachment data
          $attachment = array(
             'post_mime_type' => $wp_filetype['type'],
             'post_title'     => sanitize_file_name( $filename ),
             'post_content'   => '',
             'post_type'     => 'post',
             'post_status'    => 'inherit'
          );

          // Create the attachment
          $attach_id = wp_insert_attachment( $attachment, $file, $tcpost_id );
          // Include image.php
          require_once(ABSPATH . 'wp-admin/includes/image.php');
          // Define attachment metadata
          $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
          // Assign metadata to attachment
           wp_update_attachment_metadata( $attach_id, $attach_data );
          // And finally assign featured image to post
          set_post_thumbnail( $tcpost_id, $attach_id );
          ++$l;
         }
        // Create post END

      ++$k;
   }

  set_theme_mod('ts_demo_importer_latest_blog_like_button', '[posts_like_dislike]');
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_text', 'Read More' );
  set_theme_mod( 'ts_demo_importer_latest_news_box_link_icon', 'fas fa-arrow-right');
  // ----------- Latest News END -----------
  // contact form shortcode
  $cf7title = "Contact Map";
  $cf7content = '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]
  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [_site_admin_email]
  Reply-To: [your-email]

  0
  0

  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [your-email]
  Reply-To: [_site_admin_email]

  0
  0
  Thank you for your message. It has been sent.
  There was an error trying to send your message. Please try again later.
  One or more fields have an error. Please check and try again.
  There was an error trying to send your message. Please try again later.
  You must accept the terms and conditions before sending your message.
  The field is required.
  The field is too long.
  The field is too short.
  There was an unknown error uploading the file.
  You are not allowed to upload files of this type.
  The file is too big.
  There was an error uploading the file.';

  $cf7_post = array(
  'post_title'    => wp_strip_all_tags( $cf7title ),
  'post_content'  => wp_slash($cf7content),
  'post_status'   => 'publish',
  'post_type'     => 'wpcf7_contact_form',
  );
  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '[text* your-name placeholder "Full Name *"]
  [email* your-email placeholder "Email address *"]
  [number PhoneNo placeholder "Telephone *"]
  [text Company placeholder "Company *"]
  [submit "Send"]' );

  $cf7mail_data  = array(
  'subject' => '[_site_title] "[your-subject]"',
  'sender' => '[_site_title] <supprt@themeshopy.com>',
  'body' => 'From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])',
  'recipient' => '[_site_admin_email]',
  'additional_headers' => 'Reply-To: [your-email]',
  'attachments' => '',
  'use_html' => 0,
  'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);
      // Gets term object from Tree in the database.

  $cf7shortcode3 = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';

  set_theme_mod( 'ts_demo_importer_contact_map_shortcode',$cf7shortcode3 );

  //post setting
  set_theme_mod( 'ts_demo_importer_related_posts_title', 'Related Posts' );
  set_theme_mod( 'ts_demo_importer_related_post_count', 3 );
  set_theme_mod( 'ts_demo_importer_blog_category_prev_title', 'Previous' );
  set_theme_mod( 'ts_demo_importer_blog_category_next_title', 'Next' );

  //================= home page second END ===================
  // ----------- Our Records ----------
  set_theme_mod( 'ts_demo_importer_our_records_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/our-records-image.png');
  set_theme_mod( 'ts_demo_importer_our_records_number',3);
  $records_no=array('12','1729','546','358');
  $records_title=array('Years of Experience','Satisfied Customer','Finished Projects','Employees Worldwide');
  for($i=1;$i<=4;$i++)
  {
    set_theme_mod( 'ts_demo_importer_our_records_no'.$i,$records_no[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_records_title'.$i,$records_title[$i-1] );
  }
  // footer
  set_theme_mod( 'multi_advance_footer_copy','(c) Copyright 2022, Advance Consultancy Theme' );

}

public function import_demo_advance_training_academy(){

  // Create a front page and assigned the template
  $home_content = '';

  $home_title = 'Home';
  $home = array(
     'post_type' => 'page',
     'post_title' => $home_title,
     'post_content'  => wp_slash( $home_content),
     'post_status' => 'publish',
     'post_author' => 1,
     'post_slug' => 'home'
   );
  $home_id = wp_insert_post($home);

  //Set the home page template
  add_post_meta( $home_id, '_wp_page_template', 'page-template/home-page.php' );

  //Set the static front page
  $home = get_page_by_title( 'Home' );
  update_option( 'page_on_front', $home->ID );
  update_option( 'show_on_front', 'page' );

  // Create a blog page and assigned the template
      $blog_title = 'Blog';
      $blog_check = get_page_by_title($blog_title);
      $blog = array(
         'post_type' => 'page',
         'post_title' => $blog_title,
         'post_status' => 'publish',
         'post_author' => 1,
         'post_slug' => 'blog'
      );
      $blog_id = wp_insert_post($blog);
      //Set the blog page template
      add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-fullwidth-extend.php' );
      add_post_meta( $blog_id, 'title_banner_image_wp_custom_attachment', $attachment_url );
      $blog_title = 'Blog Left Sidebar';
 $blog = array(
   'post_type'  => 'page',
   'post_title'   => $blog_title,
   'post_status' => 'publish',
   'post_author' => 1,
   'post_slug'  => 'blog-left-sidebar'
 );
 $blog_id = wp_insert_post($blog);
     //Set the blog page template
 add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-with-left-sidebar.php' );
 add_post_meta( $blog_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

 $blog_title = 'Blog Right Sidebar';
 $blog = array(
   'post_type'  => 'page',
   'post_title'   => $blog_title,
   'post_status' => 'publish',
   'post_author' => 1,
   'post_slug'  => 'blog-right-sidebar'
 );
 $blog_id = wp_insert_post($blog);


 //Set the blog page template
 add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-with-right-sidebar.php' );
 add_post_meta( $blog_id, 'title_banner_image_wp_custom_attachment', $attachment_url );

  //  creating  the pages and assign the template
  $pages_array = array('About Us', 'All Courses', 'Contact Us' );
  for ($i=0; $i<count($pages_array) ; $i++) {
    $pages = array(
      'post_type' 	=> 'page',
      'post_title' 	=> $pages_array[$i],
      'post_status' => 'publish',
      'post_author' => 1,
      'post_slug' 	=> strtolower(str_replace(' ', '_', $pages_array[$i]))
    );
    $pages_id = wp_insert_post($pages);

    add_post_meta( $pages_id, '_wp_page_template', 'page-template/'.strtolower(str_replace(' ', '-', $pages_array[$i])).'.php' );
    add_post_meta( $pages_id, 'title_banner_image_wp_custom_attachment', $attachment_url );
  }

  // section ordering
  set_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater', 'our-services,about-us,personalized-support,course-programs,all-program,founder,annual-meetup,upcoming-events,video,latest-news');

  // slider
  set_theme_mod('ts_demo_importer_slide_number', '4');
   set_theme_mod('ts_demo_importer_slide_delay', '10000');
  //set_theme_mod('ts_demo_importer_slide_number', '4');
  for ($i=1; $i <=4 ; $i++) {
    set_theme_mod('ts_demo_importer_slide_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/education-theme/slider/slider'.$i.'.png');
    set_theme_mod('ts_demo_importer_slide_image_alt_text'.$i, 'Slider images alternate text'.$i);
    set_theme_mod('ts_demo_importer_slide_heading'.$i, 'The Best University Of The State');
    set_theme_mod('ts_demo_importer_slide_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.');
    set_theme_mod('ts_demo_importer_slide_btn_one_text'.$i, 'Register Now');
    set_theme_mod('ts_demo_importer_slide_btn_one_url'.$i, '#');
  }

  // services section START
  $service_title = array('Why Study at Abituri?', 'Campus Life', 'News and Events');
  for($i=1; $i<=3; $i++){
    $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.';
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $service_title[$i-1] ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'services',
    );
    // Insert the post into the database
    $ts_post_id = wp_insert_post( $my_post );

    update_post_meta( $ts_post_id, 'service-read-more-btn', 'READ MORE');

    $image_url = TS_DEMO_IMPOTER_URL.'assets/images/education-theme/services/service'.$i.'.png';
    $image_name= 'services'.$i.'.png';
    $upload_dir = wp_upload_dir();
    // Set upload folder
    $image_data = file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name
    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // Create the image  file on the server
    file_put_contents( $file, $image_data );
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );
    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'services',
      'post_status'    => 'inherit'
    );
    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $ts_post_id );
    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );
    // And finally assign featured image to post
    set_post_thumbnail( $ts_post_id, $attach_id );
  }
  set_theme_mod('ts_demo_importer_our_services_carousel_nav', 'false');
  set_theme_mod('ts_demo_importer_our_services_carousel_dots', 'false');
  // services section END
  // About us section START
  set_theme_mod('ts_demo_importer_about_us_title', 'About Abituri');
  set_theme_mod('ts_demo_importer_about_us_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla ');
  set_theme_mod('ts_demo_importer_about_us_button_text', 'Learn More');
  set_theme_mod('ts_demo_importer_about_us_button_url', '#');
  set_theme_mod('ts_demo_importer_about_us_right_image', TS_DEMO_IMPOTER_URL.'assets/images/education-theme/about/about-image.png');

  // counter section
  set_theme_mod('ts_demo_importer_counter_main_heading', 'Abituri prepares students with the transformative experience and to be well-rounded leaders who make a positive impact on the world.');
  set_theme_mod('ts_demo_importer_our_records_number', '3');

  $record_title=array('Different Nationalities','Success Rate','Different Majors');
  $record_sufix=array('','%','');
  $record_no=array('28','98','40');

  for($i=1;$i<=3;$i++){
    set_theme_mod( 'ts_demo_importer_our_records_no'.$i, $record_no[$i-1] );
    set_theme_mod( 'ts_demo_importer_our_records_no_suffix'.$i,$record_sufix[$i-1]);
    set_theme_mod( 'ts_demo_importer_our_records_title'.$i, $record_title[$i-1] );
  }

  //  course and programs section
  set_theme_mod('ts_demo_importer_courses_top_heading', 'Courses and Programs');
  set_theme_mod( 'ts_demo_importer_courses_top_paragraph', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod' );

  $course_array = array("Architecture", "Biomedical Science", "Business Studies","Information Technology","Social Science","Law");
  for($i=1;$i<=6;$i++){

    global $wpdb;
    $title = $course_array[$i-1];
    $content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since.';

    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $title ),
      'post_content'  => $content,
      'post_status'   => 'publish',
      'post_type'     => 'lp_course',
    );

    set_theme_mod('ts_demo_importer_course_button', 'Read More');

    // Insert the post into the database
    $post_id = wp_insert_post( $my_post );

    $db_prefix = $wpdb->prefix;

    $learnpress_section_insert = $wpdb->insert( $db_prefix . 'learnpress_sections', array(
      'section_name' => 'My Learnpress Section ',
      'section_course_id' => $post_id,
      'section_description' => 'Lorem ipsum is a dummy text.'
    ));
    $lastid = $wpdb->insert_id;

    update_post_meta( $post_id, '_lp_price', '120');
    update_post_meta( $post_id, '_lp_students', '50');
    update_post_meta( $post_id, '_lp_max_students', '100');
    update_post_meta( $post_id, '_lp_retake_count', '2');
    update_post_meta( $lesson_count, '_lp_preview', 'yes' );


    $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/courses/course'.$i.'.png';

    $image_name= 'course'.$i.'.png';
    $upload_dir       = wp_upload_dir(); // Set upload folder
    $image_data       = file_get_contents($image_url); // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
    $filename         = basename( $unique_file_name ); // Create image file name

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
    } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
    }

    // Create the image  file on the server
    file_put_contents( $file, $image_data );

    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );

    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'lp_course',
      'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );

    // And finally assign featured image to post
    set_post_thumbnail( $post_id, $attach_id );

    for($s=1;$s<=10;$s++){
      $title = 'My Lesson '.$lastid.'-'.$s;
      $content = 'Deprimet perversius debeant hilare philosophari habeatur epulis doctorum coniunctio adridens stare plato mos intellegunt notam potuerit.
               Magos copiosiorem corroborati brute ponimus coronae opinor aliquo salebra mene hominum sequimur neglegi solent percipiet pugnem.
               Cupido stultost fatebuntur privasse progressionis redarguitur vincunt dixissent dolendi tacet';

      // Create post object
      $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'lp_lesson',
      );

     // Insert the post into the database
     $post_id = wp_insert_post( $my_post );

     $learnpress_section_insert_lesson = $wpdb->insert( $db_prefix . 'learnpress_section_items', array(
       'section_id' => $lastid,
       'item_id' => $post_id,
       'item_type' => 'lp_lesson'
     ));

     update_post_meta( $post_id, '_lp_duration', '10');

     $image_name= 'course'.$s.'.png';
     $upload_dir       = wp_upload_dir(); // Set upload folder
     $image_data       = file_get_contents($image_url); // Get image data
     $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
     $filename         = basename( $unique_file_name ); // Create image file name

     // Check folder permission and define file location
     if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
     } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
     }

     // Create the image  file on the server
     file_put_contents( $file, $image_data );

     // Check image file type
     $wp_filetype = wp_check_filetype( $filename, null );

     // Set attachment data
     $attachment = array(
       'post_mime_type' => $wp_filetype['type'],
       'post_title'     => sanitize_file_name( $filename ),
       'post_content'   => '',
       'post_type'     => 'lp_lesson',
       'post_status'    => 'inherit'
     );

     // Create the attachment
     $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

     // Include image.php
     require_once(ABSPATH . 'wp-admin/includes/image.php');

     // Define attachment metadata
     $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

     // Assign metadata to attachment
     wp_update_attachment_metadata( $attach_id, $attach_data );

     // And finally assign featured image to post
     set_post_thumbnail( $post_id, $attach_id );
     }
   }

   // all program section
   set_theme_mod('ts_demo_importer_all_program_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/education-theme/program/program-back-image.png');
   set_theme_mod('ts_demo_importer_all_program_title', 'Explore More Majors and Programs') ;
   set_theme_mod('ts_demo_importer_all_program_paragraph', 'Choose from 40 undergraduate and graduate majors');
   set_theme_mod('ts_demo_importer_all_program_button_text', 'View All Programs');
   set_theme_mod('ts_demo_importer_all_program_button_url', get_permalink(get_page_by_title('All Courses')));

   // section founder
   set_theme_mod( 'ts_demo_importer_founder_small_title', 'Grandmaster\'s Talk' );
   set_theme_mod( 'ts_demo_importer_founder_title', 'Education Is A Progressive Discovery Of Our Own Ignorance' );
   set_theme_mod( 'ts_demo_importer_founder_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' );
   set_theme_mod( 'ts_demo_importer_founder_signature_image', TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/founder/signature.png' );
   set_theme_mod( 'ts_demo_importer_founder_name', 'Andrea Picaquadio' );
   set_theme_mod( 'ts_demo_importer_founder_image', TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/founder/founder-img.png' );
   set_theme_mod( 'ts_demo_importer_founder_designation', 'Founder' );

   // video
   set_theme_mod('ts_demo_importer_video_image', TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/video-image.png' );
   set_theme_mod('ts_demo_importer_video_title','Video Tour of Campus');
   set_theme_mod('ts_demo_importer_video_text','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do');
   set_theme_mod('ts_demo_importer_video_icon','fa-solid fa-play');
   set_theme_mod('ts_demo_importer_video_link','https://www.youtube.com/embed/9xwazD5SyVg');

   /*--- Latest Post---*/
   set_theme_mod('ts_demo_importer_latest_news_heading', 'News and Updates');
   set_theme_mod('ts_demo_importer_latest_news_paragraph', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod');
   set_theme_mod('ts_demo_importer_my_blog_number', '9');
   set_theme_mod( 'ts_demo_importer_post_excerpt_no', '18' );

   wp_delete_post(1);
   $latest_title=array('Life as a distance learning stu...','How to organize your studies...','How can you apply to Abituri...','Most students say that their m...','Students pleased with digital...','Roadmap to sustainable deve...','Most students say that their m...','Students pleased with digital...','Roadmap to sustainable deve...');

   for($i=1;$i<=9;$i++){
     $title = $latest_title[$i-1];
     $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
     // Create post object
     $my_post = array(
       'post_title'    => wp_strip_all_tags( $title ),
       'post_content'  => $content,
       'post_status'   => 'publish',
       'post_type'     => 'post',
     );

     // Insert the post into the database
     $post_id = wp_insert_post( $my_post );

     update_post_meta( $post_id, 'meta-blog-que', 'Why do we use it?');
     update_post_meta( $post_id, 'meta-blog-para', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");
     update_post_meta( $post_id, 'meta-blog-text', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");

     update_post_meta( $post_id,'meta-image1',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/img1.png');
     update_post_meta( $post_id,'meta-image2',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/img2.png');
     update_post_meta( $post_id,'meta-single-banner',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/banner.png');

     $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/post-image'.$i.'.png';

     $image_name       = 'post-image'.$i.'.png';
     $upload_dir       = wp_upload_dir(); // Set upload folder
     $image_data       = file_get_contents($image_url); // Get image data
     $unique_file_name = wp_unique_filename( $upts_demo_importer_about_us_secthree_video_linkload_dir['path'], $image_name ); // Generate unique name
     $filename         = basename( $unique_file_name ); // Create image file name

     // Check folder permission and define file location
     if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
     } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
     }

     // Create the image  file on the server
     file_put_contents( $file, $image_data );

     // Check image file type
     $wp_filetype = wp_check_filetype( $filename, null );

     // Set attachment data
     $attachment = array(
       'post_mime_type' => $wp_filetype['type'],
       'post_title'     => sanitize_file_name( $filename ),
       'post_content'   => '',
       'post_type'     => 'post',
       'post_status'    => 'inherit'
     );

     // Create the attachment
     $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

     // Include image.php
     require_once(ABSPATH . 'wp-admin/includes/image.php');

     // Define attachment metadata
     $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

     // Assign metadata to attachment
     wp_update_attachment_metadata( $attach_id, $attach_data );

     // And finally assign featured image to post
     set_post_thumbnail( $post_id, $attach_id );

     set_theme_mod( 'ts_demo_importer_latest_news_read_more_text', 'READ MORE' );
   }

   //  about us page
   set_theme_mod('ts_demo_importer_about_us_secone_left_img', TS_DEMO_IMPOTER_URL.'assets/images/education-theme/about-us-page/about-left-image.png');
   set_theme_mod('ts_demo_importer_about_us_secone_heading', 'Lorem Ipsum is simply dummy text of the Printing and Typesetting Industry.');
   set_theme_mod('ts_demo_importer_about_us_secone_para_one', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.');
   set_theme_mod('ts_demo_importer_about_us_secone_para_two', 'In reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

   set_theme_mod('ts_demo_importer_about_us_inner_page_shortcode', '[ts-demo-importer-counter]');

   set_theme_mod('ts_demo_importer_about_us_secthree_heading', 'Lorem Ipsum is simply dummy text of the Printing and Typesetting Industry.');
   set_theme_mod('ts_demo_importer_about_us_secthree_para_one', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.');
   set_theme_mod('ts_demo_importer_about_us_secthree_para_two', 'In reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
   set_theme_mod('ts_demo_importer_about_us_secthree_video_image', TS_DEMO_IMPOTER_URL.'assets/images/education-theme/about-us-page/video-thumbnail.png');
   set_theme_mod('ts_demo_importer_about_us_secthree_video_icon', 'fa-solid fa-play');
   set_theme_mod('ts_demo_importer_about_us_secthree_video_link', 'https://www.youtube.com/embed/9xwazD5SyVg');

   // contact us page
   set_theme_mod('ts_demo_importer_contact_page_main_heading', 'Contact Information');
   set_theme_mod('ts_demo_importer_contact_page_main_para', 'Fill up the contact form and our team will get back in touch with you within 24 hours.');
   set_theme_mod('ts_demo_importer_contact_page_phone_number', '+1 123 456 7890');
   set_theme_mod('ts_demo_importer_contact_page_phone_number_icon', 'fa-solid fa-phone');
   set_theme_mod('ts_demo_importer_contact_page_email_address', 'hello@heyreviews.com');
   set_theme_mod('ts_demo_importer_contact_page_email_address_icon', 'fa-solid fa-envelope');
   set_theme_mod('ts_demo_importer_address_latitude', '28.8027594');
   set_theme_mod('ts_demo_importer_address_longitude', '-105.9808615');

   //  contact us page form
   // footer newsletter form shortcode
  $cf7title = "Contact Us";
  $cf7content = '<label> Full Name </label>
[text* name placeholder "Enter Your Name"]

<label> Email Address </label>
[email* name placeholder "Enter Your E-mail"]

<label> Message </label>
[textarea message placeholder "Enter Your Message"]

[submit "Submit"]
  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [_site_admin_email]
  Reply-To: [your-email]

  0
  0

  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [your-email]
  Reply-To: [_site_admin_email]

  0
  0
  Thank you for your message. It has been sent.
  There was an error trying to send your message. Please try again later.
  One or more fields have an error. Please check and try again.
  There was an error trying to send your message. Please try again later.
  You must accept the terms and conditions before sending your message.
  The field is required.
  The field is too long.
  The field is too short.
  There was an unknown error uploading the file.
  You are not allowed to upload files of this type.
  The file is too big.
  There was an error uploading the file.';

  $cf7_post = array(
    'post_title'    => wp_strip_all_tags( $cf7title ),
    'post_content'  => wp_slash($cf7content),
    'post_status'   => 'publish',
    'post_type'     => 'wpcf7_contact_form',
  );
  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '<label> Full Name </label>
[text* name placeholder "Enter Your Name"]

<label> Email Address </label>
[email* name placeholder "Enter Your E-mail"]

<label> Message </label>
[textarea message placeholder "Enter Your Message"]

[submit "Submit"]' );

  $cf7mail_data  = array(
    'subject' => '[_site_title] "[your-subject]"',
    'sender' => '[_site_title] <supprt@themeshopy.com>',
    'body' => 'From: [your-name] <[your-email]>
    Subject: [your-subject]

    Message Body:
    [your-message]

    --
    This e-mail was sent from a contact form on [_site_title] ([_site_url])',
    'recipient' => '[_site_admin_email]',
    'additional_headers' => 'Reply-To: [your-email]',
    'attachments' => '',
    'use_html' => 0,
    'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);
            // Gets term object from Tree in the database.

  $cf7shortcode = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';

  set_theme_mod('ts_demo_importer_contactpage_form_code', $cf7shortcode);

  //  Creating events START
  $events_title=array(
                  'Stories Of Success',
                  'Sustainable Development of Economical Conditions',
                  'Research in Data Science Conference 2022',
                  'Role of Conflict in a Political Account of Common Goods',
                  'Future of Artificial Intelligence in Medical Science',
                );

  for($i=1;$i<=5;$i++){
    $title = $events_title[$i-1];
    $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $title ),
      'post_content'  => $content,
      'post_status'   => 'publish',
      'post_type'     => 'event_listing',
    );

    // Insert the post into the database
    $post_id = wp_insert_post( $my_post );

    update_post_meta( $post_id, 'event_listing', 'no');
    update_post_meta( $post_id, '_event_location', 'Main Auditorium');
    update_post_meta( $post_id, '_registration', 'themesshopy@gmail.com');
    update_post_meta( $post_id, '_event_start_date', '2023-10-3');
    update_post_meta( $post_id, '_event_end_date', '2023-10-3');
    update_post_meta( $post_id, '_event_start_time', '18:00:00');
    update_post_meta( $post_id, '_event_end_time', '22:00:00');
    update_post_meta( $post_id, '_event_registration_deadline', '2023-10-1');
    update_post_meta( $post_id, '_event_banner', TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/events/event'.$i.'.png');

    $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/events/event'.$i.'.png';

    $image_name       = 'events-image'.$i.'.png';
    $upload_dir       = wp_upload_dir(); // Set upload folder
    $image_data       = file_get_contents($image_url); // Get image data
    $unique_file_name = wp_unique_filename( $upts_demo_importer_about_us_secthree_video_linkload_dir['path'], $image_name ); // Generate unique name
    $filename         = basename( $unique_file_name ); // Create image file name

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }

    // Create the image  file on the server
    file_put_contents( $file, $image_data );

    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );

    // Set attachment data
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_type'     => 'event_listing',
      'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );

    // And finally assign featured image to post
    set_post_thumbnail( $post_id, $attach_id );
  }
  //  Creating events END
  set_theme_mod('ts_demo_importer_annual_meetup_bgimage', TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/events/event1.png');
  set_theme_mod('ts_demo_importer_annual_event_title', 'Annual Meetup Event');
  set_theme_mod('ts_demo_importer_annual_event_paragraph', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod');
  set_theme_mod('ts_demo_importer_annual_event_register_btn', 'Register Now');

  // upcoming events
  set_theme_mod('ts_demo_importer_upcoming_events_title', 'More Upcoming Events');
  set_theme_mod('ts_demo_importer_upcoming_events_paragraph', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod');
  set_theme_mod('ts_demo_importer_upcoming_events_view_all_btn', 'View All Events');
  
   set_theme_mod('ts_demo_importer_upcoming_events_view_all_btn_url', '#');
 }

 public function import_demo_ts_conference(){

   // Create a front page and assigned the template
   $home_content = '';
   $home_title = 'Home';
   $home = array(
      'post_type' => 'page',
      'post_title' => 'Home',
      'post_content'  => wp_slash( $home_content),
      'post_status' => 'publish',
      'post_author' => 1,
      'post_slug' => 'home'
    );
   $home_id = wp_insert_post($home);
   //Set the home page template
   add_post_meta( $home_id, '_wp_page_template', 'page-template/home-page.php' );

   //Set the static front page
   $home = get_page_by_title( 'Home' );
   update_option( 'page_on_front', $home->ID );
   update_option( 'show_on_front', 'page' );

   // section ordering
   set_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater', 'about-us,our-services,upcoming-events,conference-schedule,team,pricing-plan,contact-map,our-brands,latest-news,newsletter');

   //  slider
   set_theme_mod('ts_demo_importer_slide_number', '4');
   set_theme_mod('ts_demo_importer_slide_delay', '2000');
   for ($i=1; $i <=4 ; $i++) {
     set_theme_mod('ts_demo_importer_slide_image'.$i, TS_DEMO_IMPOTER_URL.'/assets/images/conference/slider.png');
     set_theme_mod('ts_demo_importer_slide_image_alt_text'.$i, 'Slider Image'.$i );
     set_theme_mod('ts_demo_importer_slide_small_heading'.$i, 'Events For Startups' );
     set_theme_mod('ts_demo_importer_slide_heading'.$i, 'PROMOTE BUSINESS CONFERENCE 2022' );
     set_theme_mod('ts_demo_importer_slide_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
     set_theme_mod('ts_demo_importer_slide_btn_one_text'.$i, 'Register Now' );
     set_theme_mod('ts_demo_importer_slide_btn_one_url'.$i, '#' );
     set_theme_mod('ts_demo_importer_slide_btn_two_text'.$i, 'Learn More' );
     set_theme_mod('ts_demo_importer_slide_btn_two_url'.$i, '#' );
   }
   set_theme_mod('ts_demo_importer_slide_below_heading', 'DISCOVER NEW BUSINESS OPPORTUNITIES');

   // about us  section
   set_theme_mod('ts_demo_importer_about_us_left_image', TS_DEMO_IMPOTER_URL.'/assets/images/conference/about-image.png');
   set_theme_mod('ts_demo_importer_about_us_left_image_alt_text', 'About us image alternate text');
   set_theme_mod('ts_demo_importer_about_us_small_heading', 'ABOUT US');
   set_theme_mod('ts_demo_importer_about_us_main_heading', 'Passion To Create Inspirational Business Meets Solutions');
   set_theme_mod('ts_demo_importer_about_us_para_one', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
   set_theme_mod('ts_demo_importer_about_us_para_two', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
   set_theme_mod('ts_demo_importer_about_us_read_more_button', 'Read More');
   set_theme_mod('ts_demo_importer_about_us_read_more_button_url', '#');

   //  services
   set_theme_mod('ts_demo_importer_our_services_bgimage', TS_DEMO_IMPOTER_URL.'/assets/images/conference/services-background.png');
   set_theme_mod('ts_demo_importer_our_services_small_heading', 'WHAT WE OFFER');
   set_theme_mod('ts_demo_importer_our_services_main_heading', 'Spaces To Work And Room To Grow');
   set_theme_mod('ts_demo_importer_our_services_number', '4');


   $services_tab_titles = array('CARD ACCESS', 'PROJECTOR', 'AUDIO EQUIPMENT', 'AIR CONDITION' );
   $services_titles = array(
                'Connect The Card With Entry Access System',
                'Connect The Card With Project System',
                'Connect The Card With Audio Equipment System',
                'Connect The Card With Air Condition System'
              );
   for( $i=0; $i<count($services_titles); $i++ ){
     $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ";
     // Create post object
     $my_post = array(
       'post_title'    => wp_strip_all_tags( $services_titles[$i] ),
       'post_content'  => $content,
       'post_status'   => 'publish',
       'post_type'     => 'services',
     );

     // Insert the post into the database
     $post_id = wp_insert_post( $my_post );

     update_post_meta( $post_id, 'meta-short-title', $services_tab_titles[$i]);

     $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/conference/services.png';

     $image_name       = $services_tab_titles[$i].'.png';
     $upload_dir       = wp_upload_dir(); // Set upload folder
     $image_data       = file_get_contents($image_url); // Get image data
     $unique_file_name = wp_unique_filename( $upts_demo_importer_about_us_secthree_video_linkload_dir['path'], $image_name ); // Generate unique name
     $filename         = basename( $unique_file_name ); // Create image file name

     // Check folder permission and define file location
     if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
     } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
     }

     // Create the image  file on the server
     file_put_contents( $file, $image_data );
     $wp_filetype = wp_check_filetype( $filename, null );

     // Set attachment data
     $attachment = array(
       'post_mime_type' => $wp_filetype['type'],
       'post_title'     => sanitize_file_name( $filename ),
       'post_content'   => '',
       'post_type'     => '',
       'post_status'    => 'inherit'
     );

     $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
     require_once(ABSPATH . 'wp-admin/includes/image.php');
     $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
     wp_update_attachment_metadata( $attach_id, $attach_data );
     set_post_thumbnail( $post_id, $attach_id );
   }

   //  upcoming event section
   set_theme_mod('ts_demo_importer_upcoming_events_small_heading', 'UPCOMING CONFERENCES');
   set_theme_mod('ts_demo_importer_upcoming_events_main_heading', 'Be A Part Of A Great Event');
   set_theme_mod('ts_demo_importer_upcoming_events_number', '3');
   set_theme_mod('ts_demo_importer_upcoming_events_date_icon', 'fas fa-calendar');
   set_theme_mod('ts_demo_importer_upcoming_events_location_icon', 'fas fa-map-marker-alt');
   set_theme_mod('ts_demo_importer_upcoming_events_read_more_btn', 'READ MORE');


   //  creating venue START
   $venue_ids = array();
   for( $i=0; $i<1; $i++ ){
     $content = "This is the sample venue";
     // Create post object
     $venue_location = array(
       'post_title'    => wp_strip_all_tags( 'Melbourne, AU' ),
       'post_content'  => $content,
       'post_status'   => 'publish',
       'post_type'     => 'tribe_venue',
     );

     // Insert the post into the database
     $venue_location_id = wp_insert_post( $venue_location );

     array_push($venue_ids, $venue_location_id);

     update_post_meta( $venue_location_id, '_VenueAddress', 'Melbourne, AU');
     update_post_meta( $venue_location_id, '_VenueCity', 'Melbourne');
     update_post_meta( $venue_location_id, '_VenueCountry', 'Australia');
     update_post_meta( $venue_location_id, '_EventShowMapLink', '1');
     update_post_meta( $venue_location_id, '_EventShowMap', '1');
     update_post_meta( $venue_location_id, '_VenueShowMapLink', '1');
     update_post_meta( $venue_location_id, '_VenueShowMap', '1');
     update_post_meta( $venue_location_id, '_VenueProvince', 'Victoria');
     update_post_meta( $venue_location_id, '_VenueStateProvince', 'Victoria');
     update_post_meta( $venue_location_id, '_VenueZip', '2030');
     update_post_meta( $venue_location_id, '_VenuePhone', '1234567890');
   }
   //  creating venue END

   //  creating events START
   $events_titles = array(
                      'How immersive is revitalising the cultural sector',
                      'Master The Trade: Master Your Money And Mindset',
                      'CoDesk Meets How COVID Changed WFH'
                    );
   $events_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

   for ($i=1; $i <=count($events_titles) ; $i++) {
     $events_post = array(
       'post_title'    => wp_strip_all_tags( $events_titles[ $i - 1 ] ),
       'post_content'  => $events_content,
       'post_status'   => 'publish',
       'post_type'     => 'tribe_events',
     );

     $events_post_id = wp_insert_post( $events_post );

     update_post_meta( $events_post_id, '_EventStartDate', '2023-10-29 08:00:00');
     update_post_meta( $events_post_id, '_EventEndDate', '2023-10-30 17:00:00');
     update_post_meta( $events_post_id, '_EventStartDateUTC', '2023-10-29 08:00:00');
     update_post_meta( $events_post_id, '_EventEndDateUTC', '2023-10-30 17:00:00');
     update_post_meta( $events_post_id, '_EventCurrencySymbol', '$');
     update_post_meta( $events_post_id, '_EventCurrencyCode', 'AUD');
     update_post_meta( $events_post_id, '_EventVenueID', $venue_ids[0]);
     update_post_meta( $events_post_id, '_EventCost', '50');
     update_post_meta( $events_post_id, '_edit_last', '1');
     update_post_meta( $events_post_id, '_EventShowMapLink', '');
     update_post_meta( $events_post_id, '_EventDuration', '118800');
     update_post_meta( $events_post_id, '_EventURL', '');
     update_post_meta( $events_post_id, '_EventTimezone', 'UTC+0');
     update_post_meta( $events_post_id, '_EventTimezoneAbbr', 'UTC+0');

     $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/conference/upcoming-conference'.$i.'.png';

     $image_name       = 'upcoming-conference'.$i.'.png';
     $upload_dir       = wp_upload_dir(); // Set upload folder
     $image_data       = file_get_contents($image_url); // Get image data
     $unique_file_name = wp_unique_filename( $upts_demo_importer_about_us_secthree_video_linkload_dir['path'], $image_name ); // Generate unique name
     $filename         = basename( $unique_file_name ); // Create image file name

     // Check folder permission and define file location
     if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
     } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
     }

     // Create the image  file on the server
     file_put_contents( $file, $image_data );

     // Check image file type
     $wp_filetype = wp_check_filetype( $filename, null );

     // Set attachment data
     $attachment = array(
       'post_mime_type' => $wp_filetype['type'],
       'post_title'     => sanitize_file_name( $filename ),
       'post_content'   => '',
       'post_type'     => '',
       'post_status'    => 'inherit'
     );

     // Create the attachment
     $attach_id = wp_insert_attachment( $attachment, $file, $events_post_id );
     require_once(ABSPATH . 'wp-admin/includes/image.php');
     $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
     wp_update_attachment_metadata( $attach_id, $attach_data );
     set_post_thumbnail( $events_post_id, $attach_id );
   }
   //  creating events END
   set_theme_mod('ts_demo_importer_upcoming_events_register_space_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/conference/booking-backgorund.png');
   set_theme_mod('ts_demo_importer_upcoming_events_register_space_heading', 'Register Your Space Now');
   set_theme_mod('ts_demo_importer_upcoming_events_register_space_para', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
   set_theme_mod('ts_demo_importer_upcoming_events_book_now_btn', 'Book Now');
   set_theme_mod('ts_demo_importer_upcoming_events_book_now_btn_url', '#');

   //  conference schedule
   set_theme_mod('ts_demo_importer_conferernce_schedule_small_heading', 'CONFERENCE TIMELINE');
   set_theme_mod('ts_demo_importer_conferernce_schedule_main_heading', 'Conference Schedule');
   set_theme_mod('ts_demo_importer_conferernce_schedule_venue_text', 'Venue');
   set_theme_mod('ts_demo_importer_conferernce_schedule_note_text', 'Please follow conference event agenda as mentioned below');
   set_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_no', '4');

   $schedule_time = array('9:30 AM - 10:30 AM', '10:30 - 13:00', '13:30 - 17:30', '17:30 - 19:00' );
   $schedule_heading = array('Gathering and Signing up', 'Next Generation Leadership', 'Purpose & Passion: The Pathway to Success', 'Switch It On' );
   for ($i=1; $i <=4 ; $i++) {
     set_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_time'.$i, $schedule_time[$i -1]);
     set_theme_mod('ts_demo_importer_conferernce_schedule_propogenda_heading'.$i, $schedule_heading[$i -1]);
   }

   //  team
   set_theme_mod('ts_demo_importer_team_bgcolor', '#f3f3f3');
   set_theme_mod('ts_demo_importer_our_team_small_heading', 'OUR SPEAKERS');
   set_theme_mod('ts_demo_importer_our_team_main_heading', 'Spaces To Work And Room To Grow');
   set_theme_mod('ts_demo_importer_our_team_see_all_speaker_btn', 'See All Speakers');
   set_theme_mod('ts_demo_importer_our_team_see_all_speaker_btn_url', '#');

   $team_names = array('Zack Simmons','Rachael Rine','Louis Benjamin Falgoust II');
   $team_designation = array('Senior Developer','UX Researcher','Tech Expert');
     for($i=1;$i<=3;$i++){
       $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin fermentum eget augue imperdiet luctus. Pellentesque et lacinia mi. Suspendisse interdum urna dolor, ac blandit magna congue sit amet. Aenean lobortis, ex sit amet lobortis ultrices, libero magna maximus orci, a finibus libero turpis nec tellus. Fusce mattis quam mauris. Phasellus tristique eleifend odio, vitae suscipit dui ornare sit amet. Phasellus vestibulum dui sit amet sapien efficitur';
       // Create post object
       $my_post = array(
       'post_title'    => wp_strip_all_tags( $team_names[$i -1] ),
       'post_content'  => wp_slash($content),
       'post_status'   => 'publish',
       'post_type'     => 'team',
     );
   // Insert the post into the database
   $post_id = wp_insert_post( $my_post );
   // Now replafile_urice meta w/ new updated value array
   update_post_meta( $post_id, 'meta-designation', $team_designation[$i -1]);
   update_post_meta( $post_id, 'meta-tfacebookurl','https://www.facebook.com/');
   update_post_meta( $post_id, 'meta-ttwitterurl','https://twitter.com/');
   update_post_meta( $post_id, 'meta-tinstagram','https://instagram.com/');

   $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/conference/speaker'.$i.'.png';

   $image_name       = 'speaker'.$i.'.png';
   $upload_dir       = wp_upload_dir(); // Set upload folder
   $image_data       = file_get_contents($image_url); // Get image data
   $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
   $filename         = basename( $unique_file_name ); // Create image file name

   // Check folder permission and define file location
   if( wp_mkdir_p( $upload_dir['path'] ) ) {
   $file = $upload_dir['path'] . '/' . $filename;
   } else {
   $file = $upload_dir['basedir'] . '/' . $filename;
   }
   // Create the image  file on the server
   file_put_contents( $file, $image_data );
   // Check image file type
   $wp_filetype = wp_check_filetype( $filename, null );
   // Set attachment data
   $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title'     => sanitize_file_name( $filename ),
     'post_content'   => '',
     'post_type'     => 'team',
     'post_status'    => 'inherit'
   );
   // Create the attachment
   $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

   // Include image.php
   require_once(ABSPATH . 'wp-admin/includes/image.php');
   $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
   wp_update_attachment_metadata( $attach_id, $attach_data );
   set_post_thumbnail( $post_id, $attach_id );
   }

   //  pricing plan
   set_theme_mod('ts_demo_importer_pricing_plan_small_heading', 'PRICING AND PLANS');
   set_theme_mod('ts_demo_importer_pricing_plan_main_heading', 'Plans Customized For Your Needs');
   set_theme_mod('ts_demo_importer_pricing_plan_number', '3');
   $pricing_feature_head = array('PREMIUM', 'BUSINESS', 'ENTERPRISE' );
   $pricing_rate = array('10', '20', '40' );
   $pricing_description = array('Ideal for small teams and startup', 'Growing teams up to 25 users', 'Large team with unlimited users' );
   for ($i=1; $i <=3 ; $i++) {
     set_theme_mod('ts_demo_importer_pricing_plan_feature_heading'.$i, $pricing_feature_head[$i -1]);
     set_theme_mod('ts_demo_importer_pricing_plan_price'.$i, $pricing_rate[$i -1]);
     set_theme_mod('ts_demo_importer_pricing_plan_per_user'.$i, 'user');
     set_theme_mod('ts_demo_importer_pricing_plan_short_description'.$i, $pricing_description[$i -1]);
     set_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i, '4');
     set_theme_mod('ts_demo_importer_pricing_plan_get_started_btn'.$i, 'Get Started');
     set_theme_mod('ts_demo_importer_pricing_plan_get_started_btn_url'.$i, '#');

     if ($i == 1) {
       $feature_text = array('Access to Basic Features', 'Up to 10 Individual Users', 'Limited Space Usage', 'Basic Chat and Email support' );
     }elseif ($i==2) {
       $feature_text = array('Access to Premium Features', 'Up to 25 Individual Users', 'Extended Space Usage', 'Priority Chat and Email support' );
     }else {
       $feature_text = array('Access to Enterprise Features', 'Audit log and data history', 'Unlimited Space Usage', 'Personalized + Priority Support' );
     }
     for ($j=1; $j <=4 ; $j++) {
       set_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j, $feature_text[$j-1]);
     }
   }
   set_theme_mod('ts_demo_importer_pricing_plan_feature_title_icon', 'fa-solid fa-check');

   //  contact us map
   set_theme_mod( 'ts_demo_importer_contact_map_latitude', '46.962916' );
   set_theme_mod( 'ts_demo_importer_contact_map_longitude', '32.020660' );
   set_theme_mod( 'ts_demo_importer_contact_map_main_heading', 'Book A Visit' );
   set_theme_mod( 'ts_demo_importer_contact_map_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod' );

   //  contact form
  $contact_form_title = array('Book Visit', 'Footer Newsletter' );
  $contact_form_content = array('[text name placeholder "Your Name &#xf007;"]
                                 [email* your-email placeholder "Your Email &#xf0e0;"]
                                 [textarea* textarea-content placeholder "Your Message &#xf27a;"]
                                 [submit "Submit Request"]',

                                 '[email* your-email placeholder "Enter Your Email"][submit "&#xf2b6;"]'
                               );

  for ($i=0; $i <count($contact_form_title) ; $i++) {

   $cf7title = $contact_form_title[$i];
   $cf7content = $contact_form_content[$i].'
     [_site_title] "[your-subject]"
     [_site_title] <supprt@themeshopy.com>
     From: [your-name] <[your-email]>
     Subject: [your-subject]

     Message Body:
     [your-message]

     --
     This e-mail was sent from a contact form on [_site_title] ([_site_url])
     [_site_admin_email]
     Reply-To: [your-email]

     0
     0

     [_site_title] "[your-subject]"
     [_site_title] <supprt@themeshopy.com>
     Message Body:
     [your-message]

     --
     This e-mail was sent from a contact form on [_site_title] ([_site_url])
     [your-email]
     Reply-To: [_site_admin_email]

     0
     0
     Thank you for your message. It has been sent.
     There was an error trying to send your message. Please try again later.
     One or more fields have an error. Please check and try again.
     There was an error trying to send your message. Please try again later.
     You must accept the terms and conditions before sending your message.
     The field is required.
     The field is too long.
     The field is too short.
     There was an unknown error uploading the file.
     You are not allowed to upload files of this type.
     The file is too big.
     There was an error uploading the file.';

   $cf7_post = array(
   'post_title'    => wp_strip_all_tags( $cf7title ),
   'post_content'  => wp_slash($cf7content),
   'post_status'   => 'publish',
   'post_type'     => 'wpcf7_contact_form',
   );

   // Insert the post into the database
   $cf7post_id = wp_insert_post( $cf7_post );

   add_post_meta( $cf7post_id, "_form", $contact_form_content[$i] );

   $cf7mail_data  = array(
     'subject' => '[_site_title] "[your-subject]"',
     'sender' => '[_site_title] <supprt@themeshopy.com>',
     'body' => 'From: [your-name] <[your-email]>
     Subject: [your-subject]

     Message Body:
     [your-message]

     --
     This e-mail was sent from a contact form on [_site_title] ([_site_url])',
     'recipient' => '[_site_admin_email]',
     'additional_headers' => 'Reply-To: [your-email]',
     'attachments' => '',
     'use_html' => 0,
     'exclude_blank' => 0
   );

   add_post_meta($cf7post_id, "_mail", $cf7mail_data);

   // Gets term object from Tree in the database.
   $cf7shortcode = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';
   if ($i == 0) {
     set_theme_mod( 'ts_demo_importer_contact_map_shortcode', $cf7shortcode );
   }elseif ($i==1) {
     set_theme_mod( 'ts_demo_importer_footer_newsletter_form_shortcode', $cf7shortcode);
   }
  }

   //  our brands
   set_theme_mod('ts_demo_importer_our_brand_bgcolor', '#202020');
   set_theme_mod('ts_demo_importer_our_brand_small_heading', 'Our Brands');
   set_theme_mod('ts_demo_importer_our_brand_main_heading', 'Names That Trusted Us');
   set_theme_mod('ts_demo_importer_our_brand_number', '4');
   for ($i=1; $i <=4 ; $i++) {
     set_theme_mod('ts_demo_importer_our_brand_url'.$i, '#');
     set_theme_mod('ts_demo_importer_our_brand_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/conference/brand'.$i.'.png');
   }

   //  latest news
   set_theme_mod('ts_demo_importer_latest_news_small_heading', 'NEW ARTICLES');
   set_theme_mod('ts_demo_importer_latest_news_main_heading', 'Explore Latest From Blog');
   set_theme_mod('ts_demo_importer_my_blog_number', '3');
   set_theme_mod('ts_demo_importer_latest_news_posted_by_text', 'Posted By:');
   set_theme_mod('ts_demo_importer_latest_news_read_more_text', 'READ MORE');
   set_theme_mod('ts_demo_importer_post_excerpt_no', '20');

   wp_delete_post(1);
   $latest_title=array('Finding a way to separate Work Business','How Developers are Taking the Guesswork','Met Planner to oversee inauguration events');

   for($i=1;$i<=count($latest_title);$i++){
     $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
     // Create post object
     $my_post = array(
       'post_title'    => wp_strip_all_tags( $latest_title[$i-1] ),
       'post_content'  => $content,
       'post_status'   => 'publish',
       'post_type'     => 'post',
     );

     // Insert the post into the database
     $post_id = wp_insert_post( $my_post );

     update_post_meta( $post_id, 'meta-blog-que', 'Why do we use it?');
     update_post_meta( $post_id, 'meta-blog-para', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");
     update_post_meta( $post_id, 'meta-blog-text', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");

     update_post_meta( $post_id,'meta-image1',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/img1.png');
     update_post_meta( $post_id,'meta-image2',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/img2.png');
     update_post_meta( $post_id,'meta-single-banner',TS_DEMO_IMPOTER_URL.'/assets/images/education-theme/latest-news/banner.png');

     $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/conference/blog'.$i.'.png';

     $image_name       = 'post-image'.$i.'.png';
     $upload_dir       = wp_upload_dir(); // Set upload folder
     $image_data       = file_get_contents($image_url); // Get image data
     $unique_file_name = wp_unique_filename( $upts_demo_importer_about_us_secthree_video_linkload_dir['path'], $image_name ); // Generate unique name
     $filename         = basename( $unique_file_name ); // Create image file name

     // Check folder permission and define file location
     if( wp_mkdir_p( $upload_dir['path'] ) ) {
       $file = $upload_dir['path'] . '/' . $filename;
     } else {
       $file = $upload_dir['basedir'] . '/' . $filename;
     }

     // Create the image  file on the server
     file_put_contents( $file, $image_data );

     // Check image file type
     $wp_filetype = wp_check_filetype( $filename, null );

     // Set attachment data
     $attachment = array(
       'post_mime_type' => $wp_filetype['type'],
       'post_title'     => sanitize_file_name( $filename ),
       'post_content'   => '',
       'post_type'     => '',
       'post_status'    => 'inherit'
     );

     // Create the attachment
     $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

     // Include image.php
     require_once(ABSPATH . 'wp-admin/includes/image.php');

     // Define attachment metadata
     $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

     // Assign metadata to attachment
     wp_update_attachment_metadata( $attach_id, $attach_data );

     // And finally assign featured image to post
     set_post_thumbnail( $post_id, $attach_id );
   }

   //  footer newsleter
   set_theme_mod('ts_demo_importer_footer_newsletter_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/conference/newsletter-background.png');
   set_theme_mod('ts_demo_importer_footer_newsletter_paragraph', 'Don\'t Miss Our Future Updates!');
   set_theme_mod('ts_demo_importer_footer_newsletter_heading', 'Get Subscribed Today!');



 }

  public function import_demo_theme_common_section() {

  // ------------ Achievements Section----------
  set_theme_mod('ts_demo_importer_achievements_number', '6');
  $years = array('2002','2005','2008','2012','2017','2021' );
  for($i=1;$i<=6;$i++){
    set_theme_mod( 'ts_demo_importer_achievements_heading_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/about-page/throughout-the-years-image'.$i.'.png');
    set_theme_mod( 'ts_demo_importer_achievements_small_heading'.$i, 'Throughout The Years' );
    set_theme_mod( 'ts_demo_importer_achievements_main_heading'.$i, 'Helping Clients Achieve A Competitive Advantage' );
    set_theme_mod( 'ts_demo_importer_achievements_text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.' );
    set_theme_mod( 'ts_demo_importer_achievements_years'.$i, $years[$i-1] );
  }
  set_theme_mod( 'ts_demo_importer_achievements_bgquote_icon', 'fas fa-quote-right' );
  set_theme_mod( 'ts_demo_importer_achievements_quote_icon', 'fas fa-quote-left' );

  // ----------- Our Brands START ----------
  set_theme_mod( 'ts_demo_importer_our_brand_number', 5 );
  for($i=1;$i<=5;$i++)
  {
  set_theme_mod( 'ts_demo_importer_our_brand_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/brands/brand'.$i.'.png');
  set_theme_mod( 'ts_demo_importer_our_brand_image_alt_text'.$i, 'Alt tab for Our Brand img '.$i );
  }

  // ------------ Our Vision Section----------
  set_theme_mod( 'ts_demo_importer_our_vision_heading_image', TS_DEMO_IMPOTER_URL.'assets/images/about-page/our-client-image.png');
  set_theme_mod( 'ts_demo_importer_our_vision_small_heading', 'Our Vision' );
  set_theme_mod( 'ts_demo_importer_our_vision_main_heading', 'Built on Passion and Ingenuity' );
  set_theme_mod( 'ts_demo_importer_our_vision_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.' );
  set_theme_mod( 'ts_demo_importer_our_vision_button_title', 'View More' );
  set_theme_mod( 'ts_demo_importer_our_vision_button_icon', 'fas fa-arrow-right' );
  set_theme_mod( 'ts_demo_importer_our_vision_video_icon', 'fas fa-play' );
  set_theme_mod( 'ts_demo_importer_our_vision_video_url', 'https://www.youtube.com/embed/dYcZUKoCOg0' );

  // ------------ Hiring Banner----------
  set_theme_mod( 'ts_demo_importer_hiring_banner_bgimage', TS_DEMO_IMPOTER_URL.'assets/images/about-page/hiring-image.png');
  set_theme_mod( 'ts_demo_importer_hiring_banner_head', 'Hiring' );
  set_theme_mod( 'ts_demo_importer_hiring_banner_head2', 'We\'re Always Looking For New Talent' );
  set_theme_mod( 'ts_demo_importer_hiring_banner_button_read_more', 'Join Us Now' );
  set_theme_mod( 'ts_demo_importer_hiring_banner_button_read_more_icon', 'fas fa-arrow-right' );

  // ------------ Business Skills----------
  set_theme_mod( 'ts_demo_importer_business_skills_small_heading', 'Our Skills' );
  set_theme_mod( 'ts_demo_importer_business_skills_main_heading', 'Compose The Perfect Business' );
  set_theme_mod('ts_demo_importer_business_skills_number', '4');
  $skills_percentage = array('75','65','80','70');
  $skills_icon = array('fas fa-mobile','fas fa-briefcase','fas fa-desktop','fas fa-code');
  $skills_title = array('App Development','Business Development','Front-End Development','Back-End Development');
  for($i=1;$i<=4;$i++){
    set_theme_mod( 'ts_demo_importer_business_skills_percentage'.$i, $skills_percentage[$i-1] );
    set_theme_mod( 'ts_demo_importer_business_skills_icon'.$i, $skills_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_business_skills_title'.$i, $skills_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_business_skills_desc'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
  }

  // ------------ Contact Map ------------
  set_theme_mod( 'ts_demo_importer_contact_map_latitude', '46.962916' );
  set_theme_mod( 'ts_demo_importer_contact_map_longitude', '32.020660' );
  set_theme_mod( 'ts_demo_importer_contact_map_small_heading', 'Contact Us' );
  set_theme_mod( 'ts_demo_importer_contact_map_main_heading', 'Request A Call-Back' );

  /*--- Team---*/
  set_theme_mod( 'ts_demo_importer_team_sec_title', 'Our Team' );
  set_theme_mod( 'ts_demo_importer_team_sec_main_title', 'Thriving the Business with True Proffessional' );
  set_theme_mod( 'ts_demo_importer_team_sec_subtitle', 'Maecenas vel urna libero. Integer eu quam vel nibh gravida pellentesque. In vel egestas justo. Fusce dui metus, mollis id tristique sed, euismod quis diam.' );
  $team_array =array('Sonya Wan','Anne Ried','Suzy Jhon','Raid Yon', 'Musa yaron', 'Sharon roy');
    for($i=1;$i<=6;$i++){
      $title = $team_array[$i-1];
      $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin fermentum eget augue imperdiet luctus. Pellentesque et lacinia mi. Suspendisse interdum urna dolor, ac blandit magna congue sit amet. Aenean lobortis, ex sit amet lobortis ultrices, libero magna maximus orci, a finibus libero turpis nec tellus. Fusce mattis quam mauris. Phasellus tristique eleifend odio, vitae suscipit dui ornare sit amet. Phasellus vestibulum dui sit amet sapien efficitur';
      // Create post object
      $my_post = array(
      'post_title'    => wp_strip_all_tags( $title ),
      'post_content'  => wp_slash($content),
      'post_status'   => 'publish',
      'post_type'     => 'team',
    );
  // Insert the post into the database
  $post_id = wp_insert_post( $my_post );
  // Now replafile_urice meta w/ new updated value array
  update_post_meta( $post_id, 'meta-designation', 'Developer');
  update_post_meta( $post_id,'meta-tfacebookurl','https://www.facebook.com/');
  update_post_meta( $post_id,'meta-ttwitterurl','https://twitter.com/');
  update_post_meta( $post_id,'meta-tlinkdenurl','https://www.linkedin.com');
  update_post_meta( $post_id,'meta-tinstagram','https://instagram.com/');
  update_post_meta( $post_id,'meta-pinterest','https://pinterest.com/');

  $image_url = TS_DEMO_IMPOTER_URL.'/assets/images/team/our-team'.$i.'.png';

  $image_name       = 'our-team'.$i.'.png';
  $upload_dir       = wp_upload_dir(); // Set upload folder
  $image_data       = file_get_contents($image_url); // Get image data
  $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
  $filename         = basename( $unique_file_name ); // Create image file name

  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
  $file = $upload_dir['path'] . '/' . $filename;
  } else {
  $file = $upload_dir['basedir'] . '/' . $filename;
  }
  // Create the image  file on the server
  file_put_contents( $file, $image_data );
  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );
  // Set attachment data
  $attachment = array(
  'post_mime_type' => $wp_filetype['type'],
  'post_title'     => sanitize_file_name( $filename ),
  'post_content'   => '',
  'post_type'     => 'team',
  'post_status'    => 'inherit'
  );
  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');

  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );

  // And finally assign featured image to post
  set_post_thumbnail( $post_id, $attach_id );
  }
  set_theme_mod( 'ts_demo_importer_team_sec_button_read_more', 'View More');
  set_theme_mod( 'ts_demo_importer_team_sec_button_read_more_icon', 'fas fa-arrow-right');

  // ------------ Team Video ----------
  set_theme_mod( 'ts_demo_importer_team_video_heading_image', TS_DEMO_IMPOTER_URL.'assets/images/team-page/our-team-video.png');
  set_theme_mod( 'ts_demo_importer_team_video_small_heading', 'Our Team' );
  set_theme_mod( 'ts_demo_importer_team_video_main_heading', 'Our Lovely Team Of Hard Workers. They Makes This Company Proud.' );
  set_theme_mod( 'ts_demo_importer_team_video_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' );
  set_theme_mod( 'ts_demo_importer_team_video_video_icon', 'fas fa-play' );
  set_theme_mod( 'ts_demo_importer_team_video_video_url', 'https://www.youtube.com/embed/dYcZUKoCOg0' );

  // ------------ Team Block ----------
  set_theme_mod( 'ts_demo_importer_team_block_sec_main_title', 'Our Lovely Team Of Hard Workers. They Makes This Company Proud.' );
  set_theme_mod( 'ts_demo_importer_team_block_quote_icon', 'fas fa-quote-right' );

  // ------------ Single Team ----------
  set_theme_mod( 'ts_demo_importer_single_team_image', TS_DEMO_IMPOTER_URL.'assets/images/team-page/our-team-members.png');
  set_theme_mod( 'ts_demo_importer_single_team_image_alt_text', 'Team member Image' );
  set_theme_mod( 'ts_demo_importer_single_team_small_heading', 'Our Team Member' );
  set_theme_mod( 'ts_demo_importer_single_team_main_heading', 'Thriving The Business With True Professionals' );
  set_theme_mod( 'ts_demo_importer_single_team_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure.' );
  set_theme_mod( 'ts_demo_importer_single_team_member_name', 'Rob Mansion' );
  set_theme_mod( 'ts_demo_importer_single_team_member_desig', 'Front-End Developer' );
  set_theme_mod('ts_demo_importer_single_team_number', 4);
  $member_icon = array('fab fa-facebook-f','fab fa-twitter','fab fa-instagram','fab fa-linkedin-in');
  $member_icon_url = array('http://facebook.com/','http://twitter.com/','http://instagram.com/','http://linkedin.com/');
  for($i=1;$i<=4;$i++)
    {
    set_theme_mod( 'ts_demo_importer_single_team_social_icon'.$i, $member_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_single_team_social_icon_url'.$i, $member_icon_url[$i-1] );
    }

  // ------------ Hiring Features ----------
  set_theme_mod('ts_demo_importer_hiring_features_number', 6);
  $hiring_icon = array('fas fa-chart-line','fas fa-file-alt','fas fa-briefcase','fas fa-book','fas fa-chart-area','fas fa-file');
  $hiring_title = array('Career Growth','Yearly Bonus','Healthy Program','Ongoing Learning','Highest Facilities','Unlimited Vacation');
  for($i=1;$i<=6;$i++)
    {
    set_theme_mod( 'ts_demo_importer_hiring_features_icon'.$i, $hiring_icon[$i-1] );
    set_theme_mod( 'ts_demo_importer_hiring_features_title'.$i, $hiring_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_hiring_features_url'.$i, '#' );
    set_theme_mod( 'ts_demo_importer_hiring_features_desc'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna' );
    }

  // ------------ Hiring Roles ----------
  set_theme_mod( 'ts_demo_importer_hiring_roles_small_heading', 'Roles Available');
  set_theme_mod( 'ts_demo_importer_hiring_roles_main_heading', 'Start Your Career With Us!' );
  set_theme_mod('ts_demo_importer_hiring_roles_number', 6);

  $hiring_role_title = array('Content Writer','Finance','Business Associate','UX Design','Business Associate','Finance');
  $hiring_role_type = array('Business','Design','Creative','Finance','Business','Creative');
  for($i=1;$i<=6;$i++)
    {
    set_theme_mod( 'ts_demo_importer_hiring_roles_title'.$i, $hiring_role_title[$i-1] );
    set_theme_mod( 'ts_demo_importer_hiring_roles_type'.$i, $hiring_role_type[$i-1] );
    set_theme_mod( 'ts_demo_importer_hiring_roles_sub_title'.$i, 'Hiring Business Developer' );
    set_theme_mod( 'ts_demo_importer_hiring_roles_image'.$i, TS_DEMO_IMPOTER_URL.'assets/images/hiring-page/hiring-role'.$i.'.png');
    set_theme_mod( 'ts_demo_importer_hiring_roles_box_link'.$i, 'LEARN MORE' );
    set_theme_mod( 'ts_demo_importer_hiring_roles_box_link_icon'.$i, 'fas fa-arrow-right');
    }

  // ------------ Hiring Contact ----------
  set_theme_mod( 'ts_demo_importer_hiring_contact_small_heading', 'We\'re Hiring');
  set_theme_mod( 'ts_demo_importer_hiring_contact_main_heading', 'Send Us Your Application' );
  set_theme_mod( 'ts_demo_importer_hiring_contact_text', 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum.' );

  // contact form shortcode
  $cf7title = "Hiring Contact";
  $cf7content = '<div class="row">
    <div class="col-md-6">
    [text* your-name placeholder "Full Name"]
    [textarea Address placeholder "Enter Your Address"]
    [textarea Message placeholder "Message"]
    </div>
    <div class="col-md-6">
    [email* your-email placeholder "Email address"]
    [file UploadYourResume placeholder "Upload Your Resume"]
    [file UploadCoverLetter placeholder "Upload Cover Letter"]
    [text portfolioLink placeholder "Portfolio Link"]
    [submit "Submit Application"]
    </div>
    </div>
    [_site_title] "[your-subject]"
    [_site_title] <supprt@themeshopy.com>
    From: [your-name] <[your-email]>
    Subject: [your-subject]

    Message Body:
    [your-message]

    --
    This e-mail was sent from a contact form on [_site_title] ([_site_url])
    [_site_admin_email]
    Reply-To: [your-email]

    0
    0

    [_site_title] "[your-subject]"
    [_site_title] <supprt@themeshopy.com>
    Message Body:
    [your-message]

    --
    This e-mail was sent from a contact form on [_site_title] ([_site_url])
    [your-email]
    Reply-To: [_site_admin_email]

    0
    0
    Thank you for your message. It has been sent.
    There was an error trying to send your message. Please try again later.
    One or more fields have an error. Please check and try again.
    There was an error trying to send your message. Please try again later.
    You must accept the terms and conditions before sending your message.
    The field is required.
    The field is too long.
    The field is too short.
    There was an unknown error uploading the file.
    You are not allowed to upload files of this type.
    The file is too big.
    There was an error uploading the file.';

  $cf7_post = array(
  'post_title'    => wp_strip_all_tags( $cf7title ),
  'post_content'  => wp_slash($cf7content),
  'post_status'   => 'publish',
  'post_type'     => 'wpcf7_contact_form',
  );

  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '<div class="row">
    <div class="col-md-6">
    [text* your-name placeholder "Full Name"]
    [textarea Address placeholder "Enter Your Address"]
    [textarea Message placeholder "Message"]
    </div>
    <div class="col-md-6">
    [email* your-email placeholder "Email address"]
    [file UploadYourResume placeholder "Upload Your Resume"]
    [file UploadCoverLetter placeholder "Upload Cover Letter"]
    [text portfolioLink placeholder "Portfolio Link"]
    [submit "Submit Application"]
    </div>
    </div>' );

  $cf7mail_data  = array(
    'subject' => '[_site_title] "[your-subject]"',
    'sender' => '[_site_title] <supprt@themeshopy.com>',
    'body' => 'From: [your-name] <[your-email]>
    Subject: [your-subject]

    Message Body:
    [your-message]

    --
    This e-mail was sent from a contact form on [_site_title] ([_site_url])',
    'recipient' => '[_site_admin_email]',
    'additional_headers' => 'Reply-To: [your-email]',
    'attachments' => '',
    'use_html' => 0,
    'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);

  // Gets term object from Tree in the database.

  $cf7shortcode3 = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';
  set_theme_mod( 'ts_demo_importer_hiring_contact_shortcode',$cf7shortcode3 );

  /*About Page*/
  $about_shortcode = array('[ts-demo-importer-achievements]', '[ts-demo-importer-record]', '[ts-demo-importer-brands]', '[ts-demo-importer-our-vision]','[ts-demo-importer-hiring-banner]','[ts-demo-importer-business-skills]','[ts-demo-importer-contact-map]');
  set_theme_mod( 'ts_demo_importer_shortcodes_number', 7 );
  for($i=1;$i<=7;$i++)
  {
    set_theme_mod( 'ts_demo_importer_about_us_inner_page_shortcode'.$i, $about_shortcode[$i-1] );
  }

  /*Team Page*/
  $team_shortcode = array('[ts-demo-importer-team-video]', '[ts-demo-importer-team]', '[ts-demo-importer-team-block]', '[ts-demo-importer-single-team]','[ts-demo-importer-hiring-banner]','[ts-demo-importer-business-skills]','[ts-demo-importer-contact-map]');
  set_theme_mod( 'ts_demo_importer_shortcodes_team_number', 5 );
  for($i=1;$i<=5;$i++)
  {
    set_theme_mod( 'ts_demo_importer_team_inner_page_shortcode'.$i, $team_shortcode[$i-1] );
  }

  /*Project Page*/
  $project_shortcode = array('[ts-demo-importer-our-projects-tab]', '[ts-demo-importer-hiring-banner]');
  set_theme_mod( 'ts_demo_importer_project_shortcodes_number', 2 );
  for($i=1;$i<=2;$i++)
  {
    set_theme_mod( 'ts_demo_importer_project_inner_page_shortcode'.$i, $project_shortcode[$i-1] );
  }

  /*Hiring Page*/
  $hiring_shortcode = array('[ts-demo-importer-hiring-features]', '[ts-demo-importer-hiring-roles]', '[ts-demo-importer-hiring-contact]');
  set_theme_mod( 'ts_demo_importer_hiring_shortcodes_number', 3 );
  for($i=1;$i<=3;$i++)
  {
    set_theme_mod( 'ts_demo_importer_hiring_inner_page_shortcode'.$i, $hiring_shortcode[$i-1] );
  }

  /*Blog Page*/
  $blog_shortcode = array('[ts-demo-importer-latest-news]', '[ts-demo-importer-hiring-banner]');
  set_theme_mod( 'ts_demo_importer_blog_page_number', 2);
  for($i=1;$i<=2;$i++)
  {
    set_theme_mod( 'ts_demo_importer_blog_page_inner_page_shortcode'.$i, $blog_shortcode[$i-1] );
  }


  // Create a blog page and assigned the template
  $blog_title = 'Blog';
  $blog = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $blog_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'blog'
  );
  $blog_id = wp_insert_post($blog);

  //Set the blog page template
  add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-page.php' );
  update_post_meta( $blog_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $blog_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
  update_post_meta( $blog_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $blog_id,'title_banner_image_title_below_on_off', false);

  $blog_title = 'Blog Left Sidebar';
  $blog = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $blog_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'blog-left-sidebar'
  );
  $blog_id = wp_insert_post($blog);

  //Set the blog page template
  add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-with-left-sidebar.php' );
  update_post_meta( $blog_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $blog_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
  update_post_meta( $blog_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $blog_id,'title_banner_image_title_below_on_off', false);

  $blog_title = 'Blog Right Sidebar';
  $blog = array(
    'post_type' 	=> 'page',
    'post_title' 	=> $blog_title,
    'post_status' => 'publish',
    'post_author' => 1,
    'post_slug' 	=> 'blog-right-sidebar'
  );
  $blog_id = wp_insert_post($blog);

  //Set the blog page template
  add_post_meta( $blog_id, '_wp_page_template', 'page-template/blog-with-right-sidebar.php' );
  update_post_meta( $blog_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $blog_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
  update_post_meta( $blog_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $blog_id,'title_banner_image_title_below_on_off', false);

  // Create a Page
  if( get_page_by_title( 'Page' ) == NULL ) {
    $page_title = 'Page';
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

    $page_check = get_page_by_title($page_title);
    $ts_page = array(
      'post_type' 		=> 'page',
      'post_title' 		=> $page_title,
      'post_content'	=> wp_slash($content),
      'post_status' 	=> 'publish',
      'post_author' 	=> 1,
      'post_slug' 		=> 'page'
    );
    $page_id = wp_insert_post($ts_page);
    update_post_meta( $page_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
    update_post_meta( $page_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
    update_post_meta( $page_id,'title_banner_image_title_on_banner_on_off', true);
    update_post_meta( $page_id,'title_banner_image_title_below_on_off', false);

    $page_title = 'Page Left Sidebar';
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

    $page_check = get_page_by_title($page_title);
    $ts_page = array(
      'post_type' => 'page',
      'post_title' => $page_title,
      'post_status' 	=> 'publish',
      'post_content'	=> wp_slash($content),
      'post_author' 	=> 1,
      'post_slug' 		=> 'page-left'
    );
    $page_id = wp_insert_post($ts_page);
    update_post_meta( $page_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
    update_post_meta( $page_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
    update_post_meta( $page_id,'title_banner_image_title_on_banner_on_off', true);
    update_post_meta( $page_id,'title_banner_image_title_below_on_off', false);

    //Set the blog page template
    add_post_meta( $page_id, '_wp_page_template', 'page-template/page-with-left-sidebar.php' );

    $page_title = 'Page Right Sidebar';
    $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

    $page_check = get_page_by_title($page_title);
    $ts_page = array(
      'post_type' 		=> 'page',
      'post_title' 		=> $page_title,
      'post_content'	=> wp_slash($content),
      'post_status' 	=> 'publish',
      'post_author' 	=> 1,
      'post_slug' 		=> 'page-right'
    );
    $page_id = wp_insert_post($ts_page);

    //Set the page with right sidebar template
    add_post_meta( $page_id, '_wp_page_template', 'page-template/page-with-right-sidebar.php' );
    update_post_meta( $page_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
    update_post_meta( $page_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
    update_post_meta( $page_id,'title_banner_image_title_on_banner_on_off', true);
    update_post_meta( $page_id,'title_banner_image_title_below_on_off', false);

    // page with no sidebar
  $page_title = 'Page With No Sidebar';
  $content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

  $page_check = get_page_by_title($page_title);
  $ts_page = array(
    'post_type' 		=> 'page',
    'post_title' 		=> $page_title,
    'post_content'	=> wp_slash($content),
    'post_status' 	=> 'publish',
    'post_author' 	=> 1,
    'post_slug' 		=> 'page-with-no-sidebar'
  );
  $page_id = wp_insert_post($ts_page);

  //Set the page with right sidebar template
  add_post_meta( $page_id, '_wp_page_template', 'page-template/page-with-no-sidebar.php' );
  update_post_meta( $page_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
  update_post_meta( $page_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
  update_post_meta( $page_id,'title_banner_image_title_on_banner_on_off', true);
  update_post_meta( $page_id,'title_banner_image_title_below_on_off', false);

  // Page Left / Right Sidebar
$page_title = 'Page Left / Right Sidebar';
$content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

$page_check = get_page_by_title($page_title);
$ts_page = array(
  'post_type' 		=> 'page',
  'post_title' 		=> $page_title,
  'post_content'	=> wp_slash($content),
  'post_status' 	=> 'publish',
  'post_author' 	=> 1,
  'post_slug' 		=> 'page-with-left-right-sidebar'
);
$page_id = wp_insert_post($ts_page);

//Set the page with right sidebar template
add_post_meta( $page_id, '_wp_page_template', 'page-template/page-with-left-right-sidebar.php' );
update_post_meta( $page_id,'title_banner_image_title_short', 'Simple and Effective Solutions');
update_post_meta( $page_id,'title_banner_image_wp_custom_attachment', TS_DEMO_IMPOTER_URL.'assets/images/blogs/blog-header-image.png');
update_post_meta( $page_id,'title_banner_image_title_on_banner_on_off', true);
update_post_meta( $page_id,'title_banner_image_title_below_on_off', false);

  }
  // footer newsletter form shortcode
  $cf7title = "Footer Newsletter";
  $cf7content = '[email* email placeholder "Your Email Address"]
  [submit "&#xf1d8;"]
  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  From: [your-name] <[your-email]>
  Subject: [your-subject]

  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [_site_admin_email]
  Reply-To: [your-email]

  0
  0

  [_site_title] "[your-subject]"
  [_site_title] <supprt@themeshopy.com>
  Message Body:
  [your-message]

  --
  This e-mail was sent from a contact form on [_site_title] ([_site_url])
  [your-email]
  Reply-To: [_site_admin_email]

  0
  0
  Thank you for your message. It has been sent.
  There was an error trying to send your message. Please try again later.
  One or more fields have an error. Please check and try again.
  There was an error trying to send your message. Please try again later.
  You must accept the terms and conditions before sending your message.
  The field is required.
  The field is too long.
  The field is too short.
  There was an unknown error uploading the file.
  You are not allowed to upload files of this type.
  The file is too big.
  There was an error uploading the file.';

  $cf7_post = array(
    'post_title'    => wp_strip_all_tags( $cf7title ),
    'post_content'  => wp_slash($cf7content),
    'post_status'   => 'publish',
    'post_type'     => 'wpcf7_contact_form',
  );
  // Insert the post into the database
  $cf7post_id = wp_insert_post( $cf7_post );

  add_post_meta( $cf7post_id, "_form", '[email* email placeholder "Your Email Address"]
                                        [submit "&#xf1d8;"]' );

  $cf7mail_data  = array(
    'subject' => '[_site_title] "[your-subject]"',
    'sender' => '[_site_title] <supprt@themeshopy.com>',
    'body' => 'From: [your-name] <[your-email]>
    Subject: [your-subject]

    Message Body:
    [your-message]

    --
    This e-mail was sent from a contact form on [_site_title] ([_site_url])',
    'recipient' => '[_site_admin_email]',
    'additional_headers' => 'Reply-To: [your-email]',
    'attachments' => '',
    'use_html' => 0,
    'exclude_blank' => 0
  );

  add_post_meta($cf7post_id, "_mail", $cf7mail_data);
            // Gets term object from Tree in the database.

  $cf7shortcode3 = '[contact-form-7 id="'.$cf7post_id.'" title="'.$cf7title.'"]';


  }

  /**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function setup_widgets() {

    $function_name = 'import_demo_' . str_replace( "-", "_", wp_get_theme()->get( 'TextDomain' ) );
    $this->$function_name();
  

    //Nav Menu and footer widget
    $this->theme_create_customizer_primary_nav_menu();
    $this->theme_create_customizer_footer_nav_menu_1();

    $TS_Widget_Importer = new TS_Widget_Importer;
    $TS_Widget_Importer->import_widgets( $this->widget_file_url );


    exit;
	}
}
