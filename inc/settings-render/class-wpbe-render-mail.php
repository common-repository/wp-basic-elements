<?php 
/**
 * Class WPBE_Mail_Render
 *
 * This class is responsible for adding and rendering the mail settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Mail_Render extends WPBE_Render_Settings_Fields {
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

		// Add Mail filters
		add_filter( 'wp_mail_from_name', array( $this, 'wpbe_wp_mail_from_name' ) );
		add_filter( 'wp_mail_from', array( $this, 'wpbe_wp_mail_from_adress' ) );
	}

	/**
	 * Returns the value of the "wpbe_wp_mail_from_name" field, sanitized and validated.
	 *
	 * @return string|null The sanitized value of the field, or null if it is not set.
	 * @since 5.4.0
	 */
	public function wpbe_wp_mail_from_name() {
		$content = parent::wpbe_validate_text_field( 'wpbe_wp_mail_from_name' );

		if ( $content ) {
			return $content;
		}
	}

	/**
	 * Returns the value of the "wpbe_wp_mail_from_adress" field, sanitized and validated.
	 *
	 * @return string|null The sanitized value of the field, or null if it is not set.
	 * @since 5.4.0
	 */
	public function wpbe_wp_mail_from_adress() {
		$content = parent::wpbe_validate_text_field( 'wpbe_wp_mail_from_adress' );

		if ( $content ) {
			return $content;
		}
	}
}
