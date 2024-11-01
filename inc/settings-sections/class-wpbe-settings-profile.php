<?php 
/**
 * Class WPBE_Profile_Settings
 *
 * This class is responsible for adding and rendering the profile settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Profile_Settings extends WPBE_Settings_Sections_Fields {
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
		$section_title = '<span>'.__( 'User profile', 'wp-basic-elements' ) . '</span> <em class="dashicons dashicons-plus-alt2 section-head-icon"></em>';

		// Add the section
		add_settings_section( 'wpbe_option_section_profile', $section_title, array( $this, 'wpbe_option_section_profile' ), $this->wpbe_settings );
	}

	/**
	 * Renders the user profile settings section.
	 *
	 * @since 5.4.0
	 */
	public function wpbe_option_section_profile() {
		$section = 'wpbe_option_section_profile';

		// Add fields to section
		add_settings_field( 'wpbe_user_rich_editing_wrap', __('Disable the visual editor selector when writing','wp-basic-elements'), array( $this, 'wpbe_user_rich_editing_wrap' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_user_syntax_highlighting_wrap', __('Disable syntax highlighting selector when editing code','wp-basic-elements'), array( $this, 'wpbe_user_syntax_highlighting_wrap' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_user_comment_shortcuts_wrap', __('Disable keyboard shortcuts selector for comment moderation','wp-basic-elements'), array( $this, 'wpbe_user_comment_shortcuts_wrap' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_user_admin_bar_front_wrap', __('Disable toolbar selector when viewing site','wp-basic-elements'), array( $this, 'wpbe_user_admin_bar_front_wrap' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_contact_lang', __('Disable language chooser for users','wp-basic-elements'), array( $this, 'wpbe_disable_contact_lang' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_contact_colors', __('Disable Color Scheme selector for users','wp-basic-elements'), array( $this, 'wpbe_disable_contact_colors' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_contact_facebook', __('Disable Facebook field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_contact_facebook' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_instagram_contact', __('Disable Instagram field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_instagram_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_linkedin_contact', __('Disable LinkedIn field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_linkedin_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_myspace_contact', __('Disable MySpace field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_myspace_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_pinterest_contact', __('Disable Pinterest field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_pinterest_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_soundcloud_contact', __('Disable SoundCloud field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_soundcloud_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_tumblr_contact', __('Disable Tumblr field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_tumblr_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_twitter_contact', __('Disable Twitter field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_twitter_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_youtube_contact', __('Disable YouTube field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_youtube_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_wikipedia_contact', __('Disable WikiPedia field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_wikipedia_contact' ), $this->wpbe_settings, $section );
		add_settings_field( 'wpbe_disable_contact_website', __('Disable Website field from users contact field','wp-basic-elements'), array( $this, 'wpbe_disable_contact_website' ), $this->wpbe_settings, $section );
	}

	/**
	 * Render checkbox for disabling/enabling contact user rich editing option
	 *
	 * @since 5.4.0
	 */
	public function wpbe_user_rich_editing_wrap() {
		parent::wpbe_render_checkbox( 'wpbe_user_rich_editing_wrap' );
	}

	/**
	* Render checkbox for disabling/enabling contact user syntax highlighting option
	*
	* @since 5.4.0
	*/
	public function wpbe_user_syntax_highlighting_wrap() {
		parent::wpbe_render_checkbox( 'wpbe_user_syntax_highlighting_wrap' );
	}

	/**
	* Render checkbox for disabling/enabling contact user comment shortcuts option
	*
	* @since 5.4.0
	*/
	public function wpbe_user_comment_shortcuts_wrap() {
		parent::wpbe_render_checkbox( 'wpbe_user_comment_shortcuts_wrap' );
	}

	/**
	* Render checkbox for disabling/enabling contact user admin bar front option
	*
	* @since 5.4.0
	*/
	public function wpbe_user_admin_bar_front_wrap() {
		parent::wpbe_render_checkbox( 'wpbe_user_admin_bar_front_wrap' );
	}

	/**
	* Render checkbox for disabling/enabling contact language option
	*
	* @since 5.4.0
	*/
	public function wpbe_disable_contact_lang() {
		parent::wpbe_render_checkbox( 'wpbe_disable_contact_lang' );
	}

	/**
	 * Rendercheckbox for disabling/enabling contact colors option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_contact_colors() {
		parent::wpbe_render_checkbox( 'wpbe_disable_contact_colors' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Facebook option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_contact_facebook() {
		parent::wpbe_render_checkbox( 'wpbe_disable_contact_facebook' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Instagram option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_instagram_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_instagram_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact LinkedIn option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_linkedin_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_linkedin_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact MySpace option
	 * @since 5.4.0
	 */
	public function wpbe_disable_myspace_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_myspace_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Pinterest option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_pinterest_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_pinterest_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact SoundCloud option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_soundcloud_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_soundcloud_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Tumblr option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_tumblr_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_tumblr_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Twitter option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_twitter_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_twitter_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact YouTube option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_youtube_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_youtube_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact Wikipedia option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_wikipedia_contact() {
		parent::wpbe_render_checkbox( 'wpbe_disable_wikipedia_contact' );
	}

	/**
	 * Render checkbox for disabling/enabling contact website option
	 * 
	 * @since 5.4.0
	 */
	public function wpbe_disable_contact_website() {
		parent::wpbe_render_checkbox( 'wpbe_disable_contact_website' );
	}
}