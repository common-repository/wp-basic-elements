<?php
/**
 * Plugin Name: WP Basic Elements
 * Plugin URI: https://wordpress.org/plugins/wp-basic-elements/
 * Description: Disable unnecessary features and speed up your site. Make the WP Admin simple and clean.
 * Version: 5.4.3
 * Author: Damir Calusic
 * Author URI: https://www.damircalusic.com/
 * Text Domain: wp-basic-elements
 * Domain Path: /languages/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPBE_Functions' ) ) {

	/**
	 * The WPBE_Functions class.
	 *
	 * Disable unnecessary features and speed up your site. Make the WP Admin simple and clean.
	 */
	class WPBE_Functions {
		/**
		 * The plugin version number.
		 *
		 * @var string $version The version number.
		 * @since 5.4.2
		 */
		public $version = '5.4.3';

		/**
		 * The reference to the settings page URL.
		 *
		 * @var string $settings_page_endpoint The endpoint for the settings page.
		 * @since 5.4.0
		 */
		public $settings_page_endpoint = 'wpbe_settings_page';

		/**
		 * The name of the plugin settings.
		 *
		 * @var string $wpbe_settings The name of the plugin settings.
		 * @since 5.4.0
		 */
		public $wpbe_settings = 'wpbe_settings';

		/**
		 * Donate links
		 *
		 * @var string $donate_link_paypal
		 * @var string $donate_link_patreon
		 * @since 5.4.0
		 */
		public $donate_link_paypal  = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AJABLMWDF4RR8&source=url';
		public $donate_link_patreon = 'https://www.patreon.com/webkreativ';

		/**
		 * Constructor.
		 * Initializes the plugin by adding filters, actions and enqueues scripts.
		 *
		 * @since 5.4.0
		 */
		protected function __construct() {
			// Create plugin links in the plugins area in admin and call the localization for the plugin
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'wpbe_add_plugin_links' ) );
			add_action( 'plugins_loaded', array( $this, 'wpbe_plugins_loaded' ) );

			// Add options page under Settings page in admin
			add_action( 'admin_menu', array( $this, 'wpbe_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'wpbe_admin_init' ) );

			// Add init action that will run and render all settings
			add_action( 'init', array( $this, 'wpbe_init' ) );

			// Enqueue admin scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'wpbe_enqueue_admin_scripts' ) );
		}

		/**
		 * Adds custom links to the plugin action links in the WordPress admin.
		 *
		 * @param array $links An array of plugin action links.
		 * @return array The modified array of plugin action links.
		 * @since 5.4.0
		 */
		public function wpbe_add_plugin_links( $links ) {
			// Setup links
			$settings_link = '<a href="/wp-admin/options-general.php?page=' . $this->settings_page_endpoint . '">' . __( 'Settings', 'wp-basic-elements' ) . '</a>';
			$paypal_link   = '<a href="' . $this->donate_link_paypal . '" target="_blank">' . __( 'Donate (Paypal)', 'wp-basic-elements' ) . '</a>';
			$patreon_link  = '<a href="' . $this->donate_link_patreon . '" target="_blank">' . __( 'Donate (Patreon)', 'wp-basic-elements' ) . '</a>';

			// Merge links
			$plugin_links = array( $settings_link, $paypal_link, $patreon_link );

			// Return links
			return array_merge( $plugin_links, $links );
		}

		/**
		 * Load the plugin's text domain for localization
		 *
		 * @since 5.4.0
		 */
		public function wpbe_plugins_loaded() {
			// Set the variables
			$text_domain = 'wp-basic-elements';
			$language_path = false;
			$language_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages';

			// Load the text domain
			load_plugin_textdomain( $text_domain, $language_path, $language_dir );
		}

		/**
		 * Registers WPB Elements options page in the WordPress admin menu
		 *
		 * @since 5.4.0
		 */
		public function wpbe_admin_menu() {
			add_options_page( __( 'WPB Elements', 'wp-basic-elements' ), __( 'WPB Elements', 'wp-basic-elements' ), 'manage_options', $this->settings_page_endpoint, array( $this, 'wpbe_render_options_page' ) );
		}

		/**
		 * Render the options page for WP Basic Elements plugin.
		 *
		 * @return void
		 * @since 5.4.0
		 */
		public function wpbe_render_options_page() {
			?>
			<div class="wrap">
				<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
				<form method="post" action="options.php">
					<p id="wpbe-donate-links">
						<a href="<?php echo $this->donate_link_paypal; ?>" target="_blank"><?php _e( 'Donate (Paypal)', 'wp-basic-elements' ); ?></a> |
				   	<a href="<?php echo $this->donate_link_patreon; ?>" target="_blank"><?php _e( 'Donate (Patreon)', 'wp-basic-elements' ); ?></a>
						<span id="version">v.<?php echo $this->version; ?></span>
					</p>
					<div id="wpbe-info-notice" class="notice notice-info inline">
						<p><?php _e( 'With WP Basic Elements you can disable unnecessary features and speed up your site. Make the WP Admin simple and clean. You can change admin footers in backend, activate shortcodes in widgets, remove admin toolbar options and you can clean the code markup from unnecessary code snippets like WordPress generator meta tag and a bunch of other non important code snippets in the code. Cleaning the code markup will speed up your sites loadtime and increase the overall performance.', 'wp-basic-elements' ); ?></p>
					</div>
					<?php
						settings_fields( $this->wpbe_settings );                        // Output the settings fields for the WPBE settings section
						do_settings_sections( $this->wpbe_settings );                   // Output the settings sections for the WPBE settings page
						submit_button( __( 'Save settings', 'wp-basic-elements' ) );    // Output the submit button for the form
					?>
				</form>
			</div>
			<?php
		}

		/**
		 * Register settings for the plugin page
		 * Include the necessary classes to create the plugin options sections and fields
		 *
		 * @since 5.4.0
		 */
		public function wpbe_admin_init() {
			// Register settings for the plugin page
			register_setting( $this->wpbe_settings, $this->wpbe_settings );

			// Include the necessary classes to create the plugin options sections and fields
			require_once plugin_dir_path( __FILE__ ) . 'inc/class-wpbe-settings-sections-fields.php';
		}

		/**
		 * Render the settings fields and options
		 * Include the necessary classes that will render the settings fields
		 *
		 * @since 5.4.0
		 */
		public function wpbe_init(){
			// Include the necessary classes that will render the settings fields
			require_once plugin_dir_path( __FILE__ ) . 'inc/class-wpbe-render-settings-fields.php';
		}

		/**
		 * Enqueue admin scripts and styles for WPB Elements.
		 *
		 * @since 5.4.0
		 */
		public function wpbe_enqueue_admin_scripts() {
			wp_enqueue_style( 'wpbe-admin-style', plugin_dir_url( __FILE__ ) . 'assets/css/wpbe-styles.css', array(), $this->version, false );
			wp_enqueue_script( 'wpbe-admin-script', plugin_dir_url( __FILE__ ) . 'assets/js/wpbe-scripts.js', array(), $this->version, true );
		}

		/**
		 * Initialize the WPBE_Functions class.
		 *
		 * @return object|bool The instantiated WPBE_Functions object, or false on failure.
		 *
		 * @since 5.4.0
		 */
		public static function wpbe_plugin_init() {
			$self = new self();
			return ( $self instanceof self ) ? $self : false;
		}
	}

	// Instantiate the WPBE_Functions class.
	$wpbe_functions = WPBE_Functions::wpbe_plugin_init();
}