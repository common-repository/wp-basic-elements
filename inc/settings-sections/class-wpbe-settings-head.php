<?php 
/**
 * Class WPBE_Head_Settings
 *
 * This class is responsible for adding and rendering the head settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Head_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'Head', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_head', $section_title, array( $this, 'wpbe_option_section_head' ), $this->wpbe_settings );
	}

	/**
	 * Renders the head settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_head() {
		$section = 'wpbe_option_section_head';

		// Add fields to section
		add_settings_field( 'wpbe_disable_rest', __('Disable WP Rest API links','wp-basic-elements'), array( $this, 'wpbe_disable_rest' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_oembed', __('Disable WP Oembed discovery links','wp-basic-elements'), array( $this, 'wpbe_disable_oembed' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_short', __('Disable WP shortlink','wp-basic-elements'), array( $this, 'wpbe_disable_short' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_pings', __('Disable WP Pingbacks / Trackbacks','wp-basic-elements'), array( $this, 'wpbe_disable_pings' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_emojis', __('Disable Emoji icons if not in use.','wp-basic-elements'), array( $this, 'wpbe_disable_emojis' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_rss', __('Disable Post, Comment and Category feeds','wp-basic-elements'), array( $this, 'wpbe_disable_rss' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_rsd', __('Disable EditURI link','wp-basic-elements'), array( $this, 'wpbe_disable_rsd' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_manifest', __('Disable Windows Live Writer Manifest File','wp-basic-elements'), array( $this, 'wpbe_disable_manifest' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_index', __('Disable Index link','wp-basic-elements'), array( $this, 'wpbe_disable_index' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_adjacent', __('Disable Relational links for the Posts','wp-basic-elements'), array( $this, 'wpbe_disable_adjacent' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_block_css', __('Disable Block styling','wp-basic-elements'), array( $this, 'wpbe_disable_block_css' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_generator', __('Disable meta generator tags','wp-basic-elements'), array( $this, 'wpbe_disable_generator' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_canonical', __('Disable Canonical link','wp-basic-elements'), array( $this, 'wpbe_disable_canonical' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render checkbox for disabling/enabling REST API.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_rest() {
		parent::wpbe_render_checkbox( 'wpbe_disable_rest' );
	}

	/**
	 * Render checkbox for disabling/enabling oEmbed.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_oembed() {
		parent::wpbe_render_checkbox( 'wpbe_disable_oembed' );
	}

	/**
	 * Render checkbox for disabling/enabling shortlinks.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_short() {
		parent::wpbe_render_checkbox( 'wpbe_disable_short' );
	}

	/**
	 * Render checkbox for disabling/enabling pings.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_pings() {
		parent::wpbe_render_checkbox( 'wpbe_disable_pings' );
	}

	/**
	 * Render checkbox for disabling/enabling emojis.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_emojis() {
		parent::wpbe_render_checkbox( 'wpbe_disable_emojis' );
	}

	/**
	 * Render checkbox for disabling/enabling RSS feeds.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_rss() {
		parent::wpbe_render_checkbox( 'wpbe_disable_rss' );
	}

	/**
	 * Render checkbox for disabling/enabling RSD (Really Simple Discovery) endpoint.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_rsd() {
		parent::wpbe_render_checkbox( 'wpbe_disable_rsd' );
	}

	/**
	 * Render checkbox for disabling/enabling web app manifest.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_manifest() {
		parent::wpbe_render_checkbox( 'wpbe_disable_manifest' );
	}

	/**
	 * Render checkbox for disabling/enabling indexing.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_index() {
		parent::wpbe_render_checkbox( 'wpbe_disable_index' );
	}

	/**
	 * Render checkbox for disabling/enabling adjacent posts links.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_adjacent() {
		parent::wpbe_render_checkbox( 'wpbe_disable_adjacent' );
	}

	/**
	 * Render checkbox for disabling/enabling block styles.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_block_css() {
		parent::wpbe_render_checkbox( 'wpbe_disable_block_css' );
	}

	/**
	 * Render checkbox for disabling/enabling the generator tag.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_generator() {
		parent::wpbe_render_checkbox( 'wpbe_disable_generator' );
	}

	/**
	 * Render checkbox for disabling/enabling the canonical link tag.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_disable_canonical() {
		parent::wpbe_render_checkbox( 'wpbe_disable_canonical' );
	}
}