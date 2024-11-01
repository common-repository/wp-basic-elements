<?php
/**
 * WPBE_Settings_Sections_Fields class.
 *
 * @since 5.4.0
 */
class WPBE_Settings_Sections_Fields {
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

		// Load settings section classes dynamically
		$settings_sections = array(
			'core'            => 'Core_Settings',
			'head'            => 'Head_Settings',
			'admin-toolbar'   => 'Admin_Toolbar_Settings',
			'admin-footer'    => 'Admin_Footer_Settings',
			'admin-dashboard' => 'Admin_Dashboard_Settings',
			'profile'         => 'Profile_Settings',
			'gutenberg'       => 'Gutenberg_Settings',
			'mail'            => 'Mail_Settings',
		);

		// Loop through the settings sections and load their classes.
		foreach ( $settings_sections as $section => $class ) {
			// Determine the path to the class file.
			$class_file = dirname( __FILE__ ) . '/settings-sections/class-wpbe-settings-' . $section . '.php';

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
	 * Render a checkbox input with the given ID.
	 *
	 * @param string $id The ID attribute for the checkbox input.
	 * @since 5.4.0
	 */
	public function wpbe_render_checkbox( $id ) {
		// Check if the checkbox is already checked in the options.
		$checked = ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';

		// Render the checkbox input with the given ID and checked status.
		?>
		<label for="<?php echo $id; ?>" class="switch">
			<input type="checkbox" id="<?php echo $id; ?>" name="wpbe_settings[<?php echo $id; ?>]" value="1" <?php checked( $checked, 1 ); ?> class="toggle-button">
			<span class="slider"></span>
		</label>
		<?php
	}

	/**
	  * Render a text field with the given ID.
	  *
	  * @param string $id The ID attribute for the text field.
	  * @since 5.4.0
	  */
	public function wpbe_render_text_field( $id ) {
		// Check if the text field already has content in the options.
		$value = ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';

		// Render the checkbox input with the given ID and checked status.
		?>
	  <input type="text" id="<?php echo $id; ?>" name="wpbe_settings[<?php echo $id; ?>]" value="<?php echo $value; ?>">
		<?php
	}

	/**
	 * Renders a wp_editor field with specified options.
	 *
	 * @param string $id The ID of the editor field.
	 * @since 5.4.0
	 */
	public function wpbe_render_editor( $id ) {
		// Check if the editor already has content in the options.
		$content = ( isset( $this->options ) && isset( $this->options[ $id ] ) ) ? $this->options[ $id ] : '';

		// Output the wp_editor field
		wp_editor(
			$content,
			$id,
			array(
				'textarea_name' => "wpbe_settings[{$id}]",
				'textarea_rows' => 2,
				'media_buttons' => false,
				'quicktags'     => false,
				'tinymce'       => array(
					'toolbar1' => 'bold,italic,underline,link,unlink',
					'toolbar2' => '',
					'toolbar3' => '',
				),
			)
		);
	}
}

new WPBE_Settings_Sections_Fields();
