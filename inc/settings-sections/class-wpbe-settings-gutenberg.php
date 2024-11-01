<?php 
/**
 * Class WPBE_Gutenberg_Settings
 *
 * This class is responsible for adding and rendering the gutenberg settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Gutenberg_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'Gutenberg', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_gutenberg', $section_title, array( $this, 'wpbe_option_section_gutenberg' ), $this->wpbe_settings );
	}

	/**
	 * Renders the gutenberg settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_gutenberg() {
		$section = 'wpbe_option_section_gutenberg';

		// Add fields to section
		add_settings_field( 'wpbe_disable_gtb_welcome', __('Disable Welcome Guide','wp-basic-elements'), array( $this, 'wpbe_disable_gtb_welcome' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_gtb_toolbar', __('Disable Top toolbar mode','wp-basic-elements'), array( $this, 'wpbe_disable_gtb_toolbar' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_gtb_spotlight', __('Disable Spotlight mode','wp-basic-elements'), array( $this, 'wpbe_disable_gtb_spotlight' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_gtb_fullscreen', __('Disable Fullscreen mode','wp-basic-elements'), array( $this, 'wpbe_disable_gtb_fullscreen' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_gtb_distraction', __('Disable Distraction free mode','wp-basic-elements'), array( $this, 'wpbe_disable_gtb_distraction' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render checkbox for disabling/enabling Gutenberg Welcome guide.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_gtb_welcome() {
		parent::wpbe_render_checkbox( 'wpbe_disable_gtb_welcome' );
	}

	/**
	 * Render checkbox for disabling/enabling Gutenberg Top toolbar mode.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_gtb_toolbar() {
		parent::wpbe_render_checkbox( 'wpbe_disable_gtb_toolbar' );
	}

	/**
	 * Render checkbox for disabling/enabling Gutenberg Spotlight mode.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_gtb_spotlight() {
		parent::wpbe_render_checkbox( 'wpbe_disable_gtb_spotlight' );
	}

	/**
	 * Render checkbox for disabling/enabling Gutenberg Fullscreen mode.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_gtb_fullscreen() {
		parent::wpbe_render_checkbox( 'wpbe_disable_gtb_fullscreen' );
	}

	/**
	 * Render checkbox for disabling/enabling Gutenberg Distraction free mode.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_gtb_distraction() {
		parent::wpbe_render_checkbox( 'wpbe_disable_gtb_distraction' );
	}
}