<?php 
/**
 * Class WPBE_Core_Render
 *
 * This class is responsible for adding and rendering the core settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Core_Render extends WPBE_Render_Settings_Fields {
	/**
	 * The name of the plugin settings.
	 *
	 * @var string $wpbe_settings The name of the plugin settings.
	 *
	 * @since 5.4.0
	 */
	public $wpbe_settings;

	/**
	 * The plugin options.
	 *
	 * @var array $options An array of options for the plugin.
	 * @since 5.4.0
	 */
	public $options;

	/**
	 * Constructor.
	 *
	 * @param string $wpbe_settings The name of the plugin settings.
	 * @param array $options An array of options for the plugin.
	 * @since 5.4.0
	 */
	public function __construct( $wpbe_settings, $wpbe_options ) {
		// Set global options
		$this->wpbe_settings = $wpbe_settings;
		$this->options       = $wpbe_options;

		// Render the Head
		$this->wpbe_core_render();
	}

	/**
	 * Render the Core settings and enable/disable core features
	 *
	 * @since 5.4.0
	 */
	public function wpbe_core_render() {
		// Enable GZIP compression
		if ( parent::wpbe_validate_checkbox( 'wpbe_enable_gzip' ) ) {
			if ( ! headers_sent() && extension_loaded( 'zlib' ) && ! ini_get( 'zlib.output_compression' ) && ! $this->wpbe_is_gzip_enabled() ) {
				add_filter( 'wp_headers', function( $headers ) {
					$headers['Content-Encoding'] = 'gzip';
					return $headers;
				} );
				ob_start( 'ob_gzhandler' );
		  }
		}

		// Disable WP Cron
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_cron' ) ) {
			if ( ! defined( 'DISABLE_WP_CRON' ) ) {
				define( 'DISABLE_WP_CRON', true );
			}
		}

		// Enable so edits of images are removed to save space on server
		if ( parent::wpbe_validate_checkbox( 'wpbe_enable_img_edit_overwrite' ) ) {
			if ( ! defined( 'IMAGE_EDIT_OVERWRITE' ) ) {
				define( 'IMAGE_EDIT_OVERWRITE', true );
			}
		}

		// Disable File editing in admin
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_file_edit' ) ) {
			if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
				 define( 'DISALLOW_FILE_EDIT', true );
			}
		}

		// Disable the ability to update both core, plugins and themes in the WordPress Admin
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_file_mods' ) ) {
			if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
				define( 'DISALLOW_FILE_MODS', true );
			}
		}

		// Disable automatic updating of WordPress, Themes and Plugins
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_auto_updates' ) ) {
			if ( ! defined( 'AUTOMATIC_UPDATER_DISABLED' ) ) {
				define( 'AUTOMATIC_UPDATER_DISABLED', true );
			}
		}

		// Disable automatic update of Themes
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_themes_auto_updates' ) ) {
			add_filter( 'themes_auto_update_enabled', '__return_false' );
		}

		// Disable automatic update of Plugins
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_plugins_auto_updates' ) ) {
			add_filter( 'plugins_auto_update_enabled', '__return_false' );
		}

		// Disable REST API and prevent sensitve data to be hacked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_rest_api' ) ) {
			add_filter( 'rest_authentication_errors', array( $this, 'wpbe_disable_wp_rest_api' ) );
		}

		// Disable non used embed scripts on frontend
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_embed_scripts' ) ) {
			wp_deregister_script( 'wp-embed' );
		}

		// Prevent users from accessing comments page in admin and remove support for all post types and clean frontend
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_commenting' ) ) {
			global $pagenow;

			// Remove comment page menu link in admin
			add_action( 'admin_init', array( $this, 'wpbe_disable_commenting_admin_page' ) );

			// Remove comments stylesheet from WP Head
			add_action( 'widgets_init', array( $this, 'wpbe_widgets_init' ) );

			// Close comments on the front-end
			add_filter( 'comments_open', '__return_false', 20, 2 );

			// Hide existing comments
			add_filter( 'comments_array', '__return_empty_array', 10, 2 );

			// Redirect users in admin trying to acces the comment page
			if ( $pagenow === 'edit-comments.php' ) {
				wp_redirect( admin_url() );
				exit;
			}

			// Rmeove support for comments for all post types
			foreach ( get_post_types() as $post_type ) {
				if ( post_type_supports( $post_type, 'comments' ) ) {
					remove_post_type_support( $post_type, 'comments' );
				}
			}
		}

		// Make shortcodes available for use in excerpts
		if ( parent::wpbe_validate_checkbox( 'wpbe_enable_shortcode_excerpts' ) ) {
			add_filter( 'get_the_excerpt', 'do_shortcode' );
		}
	}

	/**
	 * Checks if GZIP Compression is enabled on the server.
	 *
	 * @since 5.4.0
	 *
	 * @return boolean True if gzip compression is enabled, false otherwise.
	 */
	function wpbe_is_gzip_enabled(){
		$content_encoding = isset( $_SERVER['HTTP_ACCEPT_ENCODING'] ) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
		return ( strpos( $content_encoding, 'gzip' ) !== false );
	}

	/**
	 * Disable WordPress REST API access for non-logged-in users and whitelist specific routes.
	 *
	 * @since 5.4.2
	 *
	 * @param $access the current access level
	 * @return $access the updated access level
	 */
	public function wpbe_disable_wp_rest_api( $access ) {
		// Get the namespace of the current REST API request
		$nspace = isset( $GLOBALS['wp']->query_vars['rest_route'] ) ? $GLOBALS['wp']->query_vars['rest_route'] : '';
		$whitelisted = $this->wpbe_wp_rest_api_whitelist( $nspace );

		// Check if the current user is logged in and if the current namespace is whitelisted
		// If the user is not logged in, return a WP_Error object with a message indicating that REST API access is restricted to authenticated users
		// and a status code indicating that authorization is required
		if ( ! is_user_logged_in() && ! $whitelisted ) {
			$message = apply_filters( 'disable_wp_rest_api_error', __( 'REST API restricted to authenticated users.', 'wp-basic-elements' ) );
			return new WP_Error( 'rest_login_required', $message, array( 'status' => rest_authorization_required_code() ) );
		}

		// Return the current access level
		return $access;
	}

	/**
	 * Check if a REST API namespace is whitelisted.
	 *
	 * @since 5.4.2
	 *
	 * @param $nspace the namespace to check
	 * @return true if the namespace is whitelisted, false otherwise
	 */
	public function wpbe_wp_rest_api_whitelist( $nspace ) {
		// Get the list of whitelisted namespaces
		$whitelist = parent::wpbe_validate_text_field( 'wpbe_wp_rest_api_whitelist' );

		// If there are any whitelisted namespaces, loop through them and check if the current namespace matches any of them
		if ( $whitelist ) {
			$namespaces = explode( ',', $whitelist );

			if ( is_array( $namespaces ) ) {
				foreach ( $namespaces as $namespace ) {
					if ( stristr( $nspace, $namespace ) !== false ) {
						return true;
					}
				}
			}
		}

		// If the namespace is not whitelisted, return false
		return false;
	}

	/**
	 * Disable commenting on admin pages.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_commenting_admin_page() {
		// Remove the comments menu page from the admin panel.
		remove_menu_page( 'edit-comments.php' );
	}

	/**
	 * Initialize custom widgets.
	 *
	 * @since 5.4.0
	 *
	 * @global WP_Widget_Factory $wp_widget_factory
	 */
	public function wpbe_widgets_init() {
		global $wp_widget_factory;

		// Check if the "Recent Comments" widget is registered.
		if ( array_key_exists( 'WP_Widget_Recent_Comments', $wp_widget_factory->widgets ) ) {
			// Check if the "Recent Comments" widget is registered.
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
}
