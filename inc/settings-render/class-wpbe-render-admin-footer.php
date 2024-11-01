<?php 
/**
 * Class WPBE_Admin_Footer_Render
 *
 * This class is responsible for adding and rendering the footer admin settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Footer_Render extends WPBE_Render_Settings_Fields {
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

		// Add Admin Footer filters
		add_filter( 'admin_footer_text', array( $this, 'wpbe_admin_footer_left' ) );
		add_filter( 'update_footer', array( $this, 'wpbe_admin_footer_right' ), 11 );
	}

	/**
	 * Returns the content of the left part of the footer in the admin panel
	 *
	 * @since 5.4.0
	 * @return string|null The content of the left part of the footer in the admin panel, or null if the content is empty or not set
	 */
	public function wpbe_admin_footer_left() {
		// Retrieve the content of the left part of the footer in the admin panel
		$content = parent::wpbe_validate_editor( 'wpbe_admin_footer_left' );

		// If the content is not empty or not set, return it
		if ( $content ) {
			return $content;
		}
	}

	/**
	 * Returns the content of the right part of the footer in the admin panel
	 *
	 * @since 5.4.0
	 * @return string|null The content of the right part of the footer in the admin panel, or null if the content is empty or not set
	 */
	public function wpbe_admin_footer_right() {
		// Retrieve the content of the right part of the footer in the admin panel
		$content = parent::wpbe_validate_editor( 'wpbe_admin_footer_right' );

		// If the content is not empty or not set, return it
		if ( $content ) {
			return $content;
		}
	}
}