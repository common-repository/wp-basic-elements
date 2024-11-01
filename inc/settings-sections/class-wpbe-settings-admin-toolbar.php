<?php 
/**
 * Class WPBE_Admin_Toolbar_Settings
 *
 * This class is responsible for adding and rendering the admin toolbar settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Admin_Toolbar_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'Admin Toolbar', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_toolbar', $section_title, array( $this, 'wpbe_option_section_toolbar' ), $this->wpbe_settings );
	}

	/**
	 * Renders the admin toolbar settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_toolbar() {
		$section = 'wpbe_option_section_toolbar';

		// Add fields to section
		add_settings_field( 'wpbe_disable_wp_logo', __('Disable WP Logo','wp-basic-elements'), array( $this, 'wpbe_disable_wp_logo' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_customize', __('Disable WP Customize','wp-basic-elements'), array( $this, 'wpbe_disable_wp_customize' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_updates', __('Disable WP Updates','wp-basic-elements'), array( $this, 'wpbe_disable_wp_updates' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_comments', __('Disable WP Comments','wp-basic-elements'), array( $this, 'wpbe_disable_wp_comments' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_search', __('Disable WP Search','wp-basic-elements'), array( $this, 'wpbe_disable_wp_search' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_sitename', __('Disable WP Sitename','wp-basic-elements'), array( $this, 'wpbe_disable_wp_sitename' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_edit', __('Disable WP Edit','wp-basic-elements'), array( $this, 'wpbe_disable_wp_edit' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wp_new_content', __('Disable WP New Content','wp-basic-elements'), array( $this, 'wpbe_disable_wp_new_content' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_yseo_menu', __('Disable Yoast SEO in toolbar menu','wp-basic-elements'), array( $this, 'wpbe_disable_yseo_menu' ), $this->wpbe_settings, $section );
	}

  	/**
	 * Render checkbox for disabling/enabling "Disable WordPress logo" checkbox setting.
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_logo() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_logo' );
	}

	/**
	 * Render checkbox for disabling/enabling "Disable Customize link" checkbox setting.
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_customize() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_customize' );
	}

  /**
	* Render checkbox for disabling/enabling "Disable WordPress updates" checkbox setting.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_updates() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_updates' );
	}

  /**
	* Render checkbox for disabling/enabling "Disable WordPress comments" checkbox setting.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_comments() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_comments' );
	}

  /**
	* Render checkbox for disabling/enabling "Disable WordPress search" checkbox setting.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_search() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_search' );
	}

  /**
	* Render checkbox for disabling/enabling "Disable site name" checkbox setting.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_sitename() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_sitename' );
	}

  /**
	* Render checkbox for disabling/enabling "Disable post/page editor" checkbox setting.
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_wp_edit() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_edit' );
	}

	/**
	 * Render checkbox for disabling/enabling "Disable new content notification" checkbox setting.
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_wp_new_content() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wp_new_content' );
	}

	/**
	 * Render checkbox for disabling/enabling Yoast SEO menu
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_yseo_menu() {
		parent::wpbe_render_checkbox( 'wpbe_disable_yseo_menu' );
	}
}