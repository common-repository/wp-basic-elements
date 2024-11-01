<?php 
/**
 * Class WPBE_Head_Render
 *
 * This class is responsible for adding and rendering the head settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Head_Render extends WPBE_Render_Settings_Fields {
	/**
	 * The name of the plugin settings.
	 *
	 * @var string $wpbe_settings The name of the plugin settings.
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

		// Render the head
		$this->wpbe_head_render();
	}

	/**
	 * Renders the head section of the website and disables certain features based on checkbox settings.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_head_render() {
		// Disable REST API links and functionality if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_rest' ) ) {
			remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
			remove_action( 'template_redirect', 'rest_output_link_header', 11 );
			remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
		}

		// Disable oEmbed discovery links if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_oembed' ) ) {
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		}

		// Disable shortlink functionality if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_short' ) ) {
			remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
		}

		// Disable pinging/trackback functionality if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_pings' ) ) {
			add_action( 'pre_ping', array( $this, 'wpbe_pre_ping' ), 10, 3 );
			add_filter( 'wp_headers', array( $this, 'wpbe_wp_headers' ) );
			add_filter( 'pings_open', '__return_false', 20, 2 );

			// Disable all support of trackbacks/pings on all post types
			foreach ( get_post_types() as $post_type ) {
				if ( post_type_supports( $post_type, 'trackbacks' ) ) {
					remove_post_type_support( $post_type, 'trackbacks' );
				}
			}
		}

		// Disable emoji functionality if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_emojis' ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			add_filter( 'tiny_mce_plugins', array( $this, 'wpbe_tiny_mce_plugins' ) );
			add_filter( 'emoji_svg_url', '__return_false' );
		}

		// Disable RSS feed links if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_rss' ) ) {
			remove_action( 'wp_head', 'feed_links', 2 );
			remove_action( 'wp_head', 'feed_links_extra', 3 );
		}

		// Disable Really Simple Discovery (RSD) link if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_rsd' ) ) {
			remove_action( 'wp_head', 'rsd_link' );
		}

		// Disable Windows Live Writer manifest link if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_manifest' ) ) {
			remove_action( 'wp_head', 'wlwmanifest_link' );
		}

		// Disable index links if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_index' ) ) {
			remove_action( 'wp_head', 'index_rel_link' );
		}

		// Disable adjacent posts links if checkbox is selected.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_adjacent' ) ) {
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
		}

		// Disable CSS and scripts related to blocks
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_block_css' ) ) {
			if ( ! is_admin() ) {
				wp_deregister_style( 'wp-block-library' );    // WordPress
				wp_dequeue_style( 'wp-block-library' );       // WordPress
				wp_dequeue_style( 'wp-block-library-theme' ); // WordPress
				wp_dequeue_style( 'wc-block-style' );         // WooCommerce
			}
		}

		// Disable the WordPress generator meta tag, themees, plugins and WPML generator tag
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_generator' ) ) {
			remove_action( 'wp_head', 'wp_generator' );
			remove_action( 'wp_head', 'mnthemes_add_meta_information_action', 99 );

			// Check for WPML
			if ( function_exists( 'icl_object_id' ) ) {
				global $sitepress;
				remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );
			}
		}

		// Disable the rel=canonical link tag
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_canonical' ) ) {
			remove_action( 'wp_head', 'rel_canonical' );
		}
	}

	/**
	 * Modifies the list of pinged links for a post before they are displayed.
	 *
	 * @param array $post_links The list of links to be pinged.
	 * @param array $pung      An array of URLs already pinged for the given post.
	 * @param int   $post_ID   The ID of the post being pinged.
	 * @since 5.4.0
	 */
	public function wpbe_pre_ping( &$post_links, &$pung, int $post_ID ) {
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_pings' ) ) {
			// Remove any links that belong to the current site.
			foreach ( $post_links as $key => $link ) {
				if ( 0 === strpos( $link, home_url() ) ) {
					unset( $post_links[ $key ] );
				}
			}
		}
	}

	/**
	 * Modifies the headers sent with an HTTP response from WordPress.
	 *
	 * @param array $headers An array of headers to be sent with the HTTP response.
	 * @return array The modified array of headers.
	 * @since 5.4.0
	 */
	public function wpbe_wp_headers( $headers ) {
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_pings' ) ) {
			// Remove the X-Pingback header from the response.
			unset( $headers['X-Pingback'] );
		}
		return $headers;
	}

	/**
	 * Filters the list of TinyMCE plugins that are loaded by default in WordPress.
	 *
	 * @param array $plugins An array of plugin names to be loaded.
	 * @return array The modified array of plugin names.
	 * @since 5.4.0
	 */
	function wpbe_tiny_mce_plugins( $plugins ) {
		if ( is_array( $plugins ) ) {
			// Remove the 'wpemoji' plugin from the list.
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}