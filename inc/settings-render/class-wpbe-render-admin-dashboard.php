<?php 
/**
 * Class WPBE_Admin_Dashboard_Render
 *
 * This class is responsible for adding and rendering the dashboard settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Dashboard_Render extends WPBE_Render_Settings_Fields {
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

		// Add Admin Dashboard action
		add_action( 'wp_dashboard_setup', array( $this, 'wpbe_wp_dashboard_setup' ) );
	}

	/**
	 * Removes certain dashboard widgets based on dashboard settings.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_wp_dashboard_setup() {
		// Remove the Welcome Panel widget if the "wpbe_disable_welcome_panel" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_welcome_panel' ) ) {
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
		}

		// Remove the "At a Glance" widget if the "wpbe_disable_dashboard_glance" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_dashboard_glance' ) ) {
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		}

		// Remove the "Activity" widget if the "wpbe_disable_dashboard_activity" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_dashboard_activity' ) ) {
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		}

		// Remove the "Quick Press" widget if the "wpbe_disable_dashboard_press" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_dashboard_press' ) ) {
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		}

		// Remove the "WordPress News" widget if the "wpbe_disable_dashboard_wpnews" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_dashboard_wpnews' ) ) {
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		}

		// Remove the "Yoast SEO" widget if the "wpbe_disable_yseo_dashboard" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_yseo_dashboard' ) ) {
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
		}

		// Remove the "WooCommerce Recent Reviews" widget if the "wpbe_disable_wc_reviews" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wc_reviews' ) ) {
			remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
		}

		// Remove the "WooCommerce Status" widget if the "wpbe_disable_wc_status" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wc_status' ) ) {
			remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );
		}

		// Remove the "bbPress Right Now" widget if the "wpbe_disable_bbpress_right_now" checkbox is checked.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_bbpress_right_now' ) ) {
			remove_meta_box( 'bbp-dashboard-right-now', 'dashboard', 'normal' );
		}
	}
}