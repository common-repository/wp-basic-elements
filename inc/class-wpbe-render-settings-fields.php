<?php
/**
 * WPBE_Settings_Sections_Fields_Render class.
 *
 * @since 5.4.0
 */
class WPBE_Render_Settings_Fields {
	/**
	 * The name of the plugin settings.
	 *
	 * @var string $wpbe_settings The name of the plugin settings.
	 * @since 5.4.0
	 */
	public $wpbe_settings = 'wpbe_settings';

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
	 * Loads the settings section classes dynamically.
	 *
	 * @since 5.4.0
	 */
	public function __construct() {
		// Set global options
		$this->options = get_option( $this->wpbe_settings );

		// Load render settings classes dynamically
		$render_settings = array(
			'core'            => 'Core_Render',
			'head'            => 'Head_Render',
			'admin-toolbar'   => 'Admin_Toolbar_Render',
			'admin-footer'    => 'Admin_Footer_Render',
			'admin-dashboard' => 'Admin_Dashboard_Render',
			'profile'         => 'Profile_Render',
			'gutenberg'       => 'Gutenberg_Render',
			'mail'            => 'Mail_Render',
		);

		// Loop through the render settings and load their classes.
		foreach ( $render_settings as $section => $class ) {
			// Determine the path to the class file.
			$class_file = dirname( __FILE__ ) . '/settings-render/class-wpbe-render-' . $section . '.php';

			// Load the class if the file exists.
			if ( file_exists( $class_file ) ) {
				require_once( $class_file );

				// Instantiate the settings section class.
				$section_class = 'WPBE_' . $class;
				new $section_class( $this->wpbe_settings, $this->options );
			}
		}
	}

	/**
	 * Validates a checkbox based on the given ID.
	 *
	 * @param string $id The ID of the checkbox to validate.
	 * @return mixed The value of the checkbox (true or false).
	 * @since 5.4.0
	 */
	public function wpbe_validate_checkbox( $id ) {
		// Check if the checkbox is already checked in the options and return data
		return ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';
	}

	/**
	 * Validates a text field with the given ID.
	 *
	 * @param string $id The ID attribute for the text field.
	 * @since 5.4.0
	 */
	public function wpbe_validate_text_field( $id ) {
		// Check if the text field already has content in the options.
		$content = ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';

		// Replace the <p> tags
		if ( $content ) {
			$content = str_replace( '<p>', '', $content );
			$content = str_replace( '</p>', '', $content );
		}

		return $content;
	}

	/**
	 * Validates a wp_editor field with specified options.
	 *
	 * @param string $id The ID of the editor field.
	 * @since 5.4.0
	 */
	public function wpbe_validate_editor( $id ) {
		// Check if the editor already has content in the options.
		$content = ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';

		// Replace the <p> tags with <br> tags
		if ( $content ) {
			$content = str_replace( '<p>', '', $content );
			$content = str_replace( '</p>', '<br>', $content );
		}

		return $content;
	}
}

new WPBE_Render_Settings_Fields();
