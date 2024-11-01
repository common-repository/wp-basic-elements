<?php 
/**
 * Class WPBE_Admin_Dashboard_Settings
 *
 * This class is responsible for adding and rendering the dashboard settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Dashboard_Settings extends WPBE_Settings_Sections_Fields {
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

		// Set local variables
		$section_title = '<span>'.__( 'Admin Dashboard', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_dashboard', $section_title, array( $this, 'wpbe_option_section_dashboard' ), $this->wpbe_settings );
	}

	/**
	 * Renders the admin dashboard settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_dashboard() {
		$section = 'wpbe_option_section_dashboard';

		// Add fields to section
		add_settings_field( 'wpbe_disable_welcome_panel', __('Disable Welcome to WordPress','wp-basic-elements'), array( $this, 'wpbe_disable_welcome_panel' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_dashboard_glance', __('Disable At a Glance','wp-basic-elements'), array( $this, 'wpbe_disable_dashboard_glance' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_dashboard_activity', __('Disable Activity','wp-basic-elements'), array( $this, 'wpbe_disable_dashboard_activity' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_dashboard_press', __('Disable Quick Draft','wp-basic-elements'), array( $this, 'wpbe_disable_dashboard_press' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_dashboard_wpnews', __('Disable WordPress Events and News','wp-basic-elements'), array( $this, 'wpbe_disable_dashboard_wpnews' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_yseo_dashboard', __('Disable Yoast SEO Posts Overview','wp-basic-elements'), array( $this, 'wpbe_disable_yseo_dashboard' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wc_reviews', __('Disable WooCommerce recent reviews','wp-basic-elements'), array( $this, 'wpbe_disable_wc_reviews' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wc_status', __('Disable WooCommerce status','wp-basic-elements'), array( $this, 'wpbe_disable_wc_status' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_bbpress_right_now', __('Disable bbPress right now','wp-basic-elements'), array( $this, 'wpbe_disable_bbpress_right_now' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render checkbox for disabling/enabling Welcome Panel.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_welcome_panel() {
		parent::wpbe_render_checkbox( 'wpbe_disable_welcome_panel' );
	}

	/**
	 * Render checkbox for disabling/enabling Dashboard At a Glance.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_dashboard_glance() {
		parent::wpbe_render_checkbox( 'wpbe_disable_dashboard_glance' );
	}

	/**
	 * Render checkbox for disabling/enabling Dashboard Activity.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_dashboard_activity() {
		parent::wpbe_render_checkbox( 'wpbe_disable_dashboard_activity' );
	}

	/**
	 * Render checkbox for disabling/enabling Dashboard Press This.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_dashboard_press() {
		parent::wpbe_render_checkbox( 'wpbe_disable_dashboard_press' );
	}

	/**
	 * Render checkbox for disabling/enabling Dashboard WordPress News.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_dashboard_wpnews() {
		parent::wpbe_render_checkbox( 'wpbe_disable_dashboard_wpnews' );
	}

	/**
	 * Render checkbox for disabling/enabling Yoast SEO dashboard
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_yseo_dashboard() {
		parent::wpbe_render_checkbox( 'wpbe_disable_yseo_dashboard' );
	}

	/**
	 * Render checkbox for disabling/enabling WooCommerce reviews
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_wc_reviews() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wc_reviews' );
	}

	/**
	 * Render checkbox for disabling/enabling WooCommerce status dashboard widget
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_wc_status() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wc_status' );
	}

	/**
	 * Render checkbox for disabling/enabling bbPress Right Now dashboard widget
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_bbpress_right_now() {
		parent::wpbe_render_checkbox( 'wpbe_disable_bbpress_right_now' );
	}
}