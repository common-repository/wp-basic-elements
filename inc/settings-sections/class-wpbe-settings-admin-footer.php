<?php 
/**
 * Class WPBE_Admin_Footer_Settings
 *
 * This class is responsible for adding and rendering the footer admin settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Footer_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'Admin Footer', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_footer_admin', $section_title, array( $this, 'wpbe_option_section_footer_admin' ), $this->wpbe_settings );
	}

	/**
	 * Renders the admin footer settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_footer_admin() {
		$section = 'wpbe_option_section_footer_admin';

		// Add fields to section
		add_settings_field( 'wpbe_admin_footer_left', __('Change the default left footer text to what you want.','wp-basic-elements'), array( $this, 'wpbe_admin_footer_left' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_admin_footer_right', __('Change the default right footer text to what you want.','wp-basic-elements'), array( $this, 'wpbe_admin_footer_right' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render wp_editor for adding text to the left footer side in admin.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_admin_footer_left() {
		parent::wpbe_render_editor( 'wpbe_admin_footer_left' );
	}

	/**
	 * Render wp_editor for adding text to the right footer side in admin.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_admin_footer_right() {
		parent::wpbe_render_editor( 'wpbe_admin_footer_right' );
	}
}