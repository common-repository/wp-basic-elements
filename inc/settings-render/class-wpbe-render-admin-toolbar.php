<?php 
/**
 * Class WPBE_Admin_Toolbar_Render
 *
 * This class is responsible for adding and rendering the toolbar settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Toolbar_Render extends WPBE_Render_Settings_Fields {
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

		// Add Admin Toolbar action
		add_action( 'wp_before_admin_bar_render', array( $this, 'wpbe_wp_before_admin_bar_render' ) );
	}

	/**
	 * This function is called before rendering the admin bar.
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_wp_before_admin_bar_render() {
		global $wp_admin_bar;

		// Remove WP logo if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_logo' ) ) {
			$wp_admin_bar->remove_menu( 'wp-logo' );
		}

		// Remove "New Content" menu if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_new_content' ) ) {
			$wp_admin_bar->remove_menu( 'new-content' );
		}

		// Remove site name if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_sitename' ) ) {
			$wp_admin_bar->remove_menu( 'site-name' );
		}

		// Remove Customize link if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_customize' ) ) {
			$wp_admin_bar->remove_menu( 'customize' );
		}

		// Remove Edit link if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_edit' ) ) {
			$wp_admin_bar->remove_menu( 'edit' );
		}

		// Remove Updates link if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_updates' ) ) {
			$wp_admin_bar->remove_menu( 'updates' );
		}

		// Remove Search box if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_search' ) ) {
			$wp_admin_bar->remove_menu( 'search' );
		}

		// Remove Comments link if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wp_comments' ) ) {
			$wp_admin_bar->remove_menu( 'comments' );
		}

		// Remove Yoast SEO menu if the corresponding checkbox is checked
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_yseo_menu' ) ) {
			$wp_admin_bar->remove_menu( 'wpseo-menu' );
		}
	}
}