<?php 
/**
 * Class WPBE_Mail_Settings
 *
 * This class is responsible for adding and rendering the footer admin settings for the plugin.

 * @since 5.4.0
 */
class WPBE_Mail_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'Mail', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_mail', $section_title, array( $this, 'wpbe_option_section_mail' ), $this->wpbe_settings );
	}

	/**
	 * Renders the mail settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_mail() {
		$section = 'wpbe_option_section_mail';

		// Add fields to section
		add_settings_field( 'wpbe_wp_mail_from_name', __('Change mail name <strong>(WordPress)</strong> sent to users to your own','wp-basic-elements'), array( $this, 'wpbe_wp_mail_from_name' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_wp_mail_from_adress', __('Change mail adress <strong>(wordpress@mysite.com)</strong> sent to users','wp-basic-elements'), array( $this, 'wpbe_wp_mail_from_adress' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render wp_editor for adding text to the left footer side in admin.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_wp_mail_from_name() {
		parent::wpbe_render_text_field( 'wpbe_wp_mail_from_name' );
	}

	/**
	 * Render wp_editor for adding text to the right footer side in admin.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_wp_mail_from_adress() {
		parent::wpbe_render_text_field( 'wpbe_wp_mail_from_adress' );
	}
}