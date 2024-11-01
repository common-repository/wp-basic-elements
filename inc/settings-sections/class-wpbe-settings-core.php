<?php 
/**
 * Class WPBE_Core_Settings
 *
 * This class is responsible for adding and rendering the core settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Core_Settings extends WPBE_Settings_Sections_Fields {
	/**
	 * The name of the plugin settings.
	 *
	 * @var string $wpbe_settings The name of the plugin settings.
	 * 
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
		$section_title = '<span>'.__( 'Core', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_core', $section_title, array( $this, 'wpbe_option_section_core' ), $this->wpbe_settings );
	}

	/**
	 * Renders the core settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_core() {
		$section = 'wpbe_option_section_core';

		// Add fields to section
		add_settings_field( 'wpbe_enable_gzip', __( 'Enable GZIP Compression', 'wp-basic-elements' ), array( $this, 'wpbe_enable_gzip' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_cron', __( 'Disable WP Cron', 'wp-basic-elements' ), array( $this, 'wpbe_disable_wp_cron' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_enable_img_edit_overwrite', __( 'Enable removal of saved edits of images to save space on server', 'wp-basic-elements' ), array( $this, 'wpbe_enable_img_edit_overwrite' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_file_edit', __( 'Disable plugin and theme file edit permission in admin for users', 'wp-basic-elements' ), array( $this, 'wpbe_disable_wp_file_edit' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_file_mods', __( 'Disable WordPress, plugin and themes from updates in admin.', 'wp-basic-elements' ), array( $this, 'wpbe_disable_wp_file_mods' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_auto_updates', __( 'Disable automatic updates of WordPress, Themes and Plugins', 'wp-basic-elements' ), array( $this, 'wpbe_disable_wp_auto_updates' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_themes_auto_updates', __( 'Disable automatic updates of Themes', 'wp-basic-elements' ), array( $this, 'wpbe_disable_themes_auto_updates' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_plugins_auto_updates', __( 'Disable automatic updates of Plugins', 'wp-basic-elements' ), array( $this, 'wpbe_disable_plugins_auto_updates' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_rest_api', __( 'Disable WP Rest API for non loggedin users', 'wp-basic-elements' ) . '<span>' . __( 'Whitelist namespaces by comma separation in the text field so they can access WP Rest API', 'wp-basic-elements').'</span>', array( $this, 'wpbe_disable_wp_rest_api' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_embed_scripts', __( 'Disable WP Embed scripts', 'wp-basic-elements' ), array( $this, 'wpbe_disable_wp_embed_scripts' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_commenting', __( 'Disable the comments system', 'wp-basic-elements' ), array( $this, 'wpbe_disable_commenting' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_enable_shortcode_excerpts', __( 'Enable shortcode in manual excerpts', 'wp-basic-elements' ), array( $this, 'wpbe_enable_shortcode_excerpts' ), $this->wpbe_settings, $section );
	}

	/**
	* Render checkbox for enabling/disabling GZIP Compression.
	*
	* @since 5.4.2
	*/
	public function wpbe_enable_gzip() {
		parent::wpbe_render_checkbox( 'wpbe_enable_gzip' );
	}

	/**
	* Render checkbox for enabling/disabling image editing overwrite.
	*
	* @since 5.4.0
	*/
	public function wpbe_enable_img_edit_overwrite() {
		parent::wpbe_render_checkbox( 'wpbe_enable_img_edit_overwrite' );
	}

	/**
	 * Render checkbox for enabling/disabling shortcode excerpts.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_enable_shortcode_excerpts() {
		parent::wpbe_render_checkbox( 'wpbe_enable_shortcode_excerpts' );
	}

	/**
	 * Render checkbox for disabling/enabling WordPress cron.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_cron() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_cron' );
	}

	/**
	 * Render checkbox for disabling/enabling WordPress REST API.
	 * Render text field for whitelisting namespaces from blocking.
	 *
	 * @since 5.4.2
	 */
	public function wpbe_disable_wp_rest_api() {
		// Checkbox for disable/enable option
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_rest_api' );

		// Whitelist text field
		parent::wpbe_render_text_field( 'wpbe_wp_rest_api_whitelist' );
	}

	/**
	 * Render checkbox for disabling/enabling WordPress embed scripts.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_embed_scripts() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_embed_scripts' );
	}

	/**
	* Render checkbox for disabling/enabling WordPress auto-updates.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_auto_updates() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_auto_updates' );
	}

	/**
	* Render checkbox for disabling/enabling WordPress, Plugins and Themes update possibility through Admin.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_file_mods() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_file_mods' );
	}

	/**
	 * Render checkbox for disabling/enabling theme auto-updates.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_themes_auto_updates() {
		parent::wpbe_render_checkbox( 'wpbe_disable_themes_auto_updates' );
	}

	/**
	 * Render checkbox for disabling/enabling plugin auto-updates.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_plugins_auto_updates() {
		parent::wpbe_render_checkbox( 'wpbe_disable_plugins_auto_updates' );
	}

	/**
	 * Render checkbox for disabling/enabling commenting.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_commenting() {
		parent::wpbe_render_checkbox( 'wpbe_disable_commenting' );
	}

	/**
	 * Render checkbox for disabling/enabling file editing.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_file_edit() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_file_edit' );
	}
}