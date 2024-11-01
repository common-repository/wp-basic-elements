<?php 
/**
 * Class WPBE_Profile_Render
 *
 * This class is responsible for adding and rendering the toolbar settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Profile_Render extends WPBE_Render_Settings_Fields {
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

		// Add Profie actions
		add_action( 'admin_head-profile.php', array( $this, 'wpbe_user_contactmethods_other' ) );
		add_action( 'admin_footer-user-edit.php', array( $this, 'wpbe_user_contactmethods_other' ) );

		// Add Profile filter
		add_filter( 'user_contactmethods', array( $this, 'wpbe_user_contactmethods' ), 100, 1 );
	}

	/**
	 * Removes user contact methods based on user settings with Javascript unset
	 *
	 * @return void
	 * @since 5.4.0
	 */
	public function wpbe_user_contactmethods_other() {
		$unset = array();

		// Check if rich editing is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_user_rich_editing_wrap' ) ) {
			array_push( $unset, '.user-rich-editing-wrap' );
		}

		// Check if syntax highlighting is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_user_syntax_highlighting_wrap' ) ) {
			array_push( $unset, '.user-syntax-highlighting-wrap' );
		}

		// Check if comment shortcuts are disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_user_comment_shortcuts_wrap' ) ) {
			array_push( $unset, '.user-comment-shortcuts-wrap' );
		}

		// Check if admin bar is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_user_admin_bar_front_wrap' ) ) {
			array_push( $unset, '.user-admin-bar-front-wrap' );
		}

		// Check if admin color scheme is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_contact_colors' ) ) {
			array_push( $unset, '.user-admin-color-wrap' );
		}

		// Check if language is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_contact_lang' ) ) {
			array_push( $unset, '.user-language-wrap' );
		}

		// Check if website URL is disabled
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_contact_website' ) ) {
			array_push( $unset, '.user-url-wrap' );
		}
		?>
		<script>
			// Remove user contact methods based on the user settings
			document.addEventListener("DOMContentLoaded", function() {
				const ids = <?php echo json_encode( $unset ); ?>;

				// We have unset elements
				if(ids) {
					for(let i = 0; i < ids.length; i++) {
						const element = document.querySelector(ids[i]);
						
						if(element) {
							element.closest('tr').remove();
						}
					}
				}
			});
		</script>
		<?php
	}

	/**
	 * Modify user contact methods.
	 *
	 * @param array $contactmethods Array of user contact methods and their labels.
	 * @return array Modified array of user contact methods and their labels.
	 * @since 5.4.0
	 */
	public function wpbe_user_contactmethods( $contactmethods ) {
		// Check if the "Disable Facebook Contact" checkbox is checked, and remove the "Facebook" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_contact_facebook' ) ) {
			unset( $contactmethods['facebook'] );
		}

		// Check if the "Disable Instagram Contact" checkbox is checked, and remove the "Instagram" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_instagram_contact' ) ) {
			unset( $contactmethods['instagram'] );
		}

		// Check if the "Disable LinkedIn Contact" checkbox is checked, and remove the "LinkedIn" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_linkedin_contact' ) ) {
			unset( $contactmethods['linkedin'] );
		}

		// Check if the "Disable Myspace Contact" checkbox is checked, and remove the "Myspace" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_myspace_contact' ) ) {
			unset( $contactmethods['myspace'] );
		}

		// Check if the "Disable Pinterest Contact" checkbox is checked, and remove the "Pinterest" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_pinterest_contact' ) ) {
			unset( $contactmethods['pinterest'] );
		}

		// Check if the "Disable SoundCloud Contact" checkbox is checked, and remove the "SoundCloud" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_soundcloud_contact' ) ) {
			unset( $contactmethods['soundcloud'] );
		}

		// Check if the "Disable Tumblr Contact" checkbox is checked, and remove the "Tumblr" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_tumblr_contact' ) ) {
			unset( $contactmethods['tumblr'] );
		}

		// Check if the "Disable Twitter Contact" checkbox is checked, and remove the "Twitter" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_twitter_contact' ) ) {
			unset( $contactmethods['twitter'] );
		}

		// Check if the "Disable YouTube Contact" checkbox is checked, and remove the "YouTube" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_youtube_contact' ) ) {
			unset( $contactmethods['youtube'] );
		}

		// Check if the "Disable Wikipedia Contact" checkbox is checked, and remove the "Wikipedia" contact method if true.
		if ( parent::wpbe_validate_checkbox( 'wpbe_disable_wikipedia_contact' ) ) {
			unset( $contactmethods['wikipedia'] );
		}

		// Return the modified contact methods.
		return $contactmethods;
	}
}
