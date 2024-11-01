<?php 
/**
 * Class WPBE_Gutenberg_Render
 *
 * This class is responsible for adding and rendering the gutenberg settings for the plugin.
 *
 * @since 5.4.0
 */
class WPBE_Gutenberg_Render extends WPBE_Render_Settings_Fields {
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

		// Add Gutenberg actions
		add_action('enqueue_block_editor_assets', array($this, 'wpbe_enqueue_block_editor_assets'), 100);
	}

	public function wpbe_enqueue_block_editor_assets() {
		$gutenberg = false;

		// Initiate Window onload
		$scripts = "window.onload = function() {";

		// Disable Welcome guide
		if(parent::wpbe_validate_checkbox('wpbe_disable_gtb_welcome')){
			$gutenberg = true;

			// Create the script for disabling Welcome guide
			$scripts .= " 
								const welcomeGuide = wp.data.select( 'core/edit-post' ).isFeatureActive( 'welcomeGuide' ); 
								if ( welcomeGuide ) { 
									wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'welcomeGuide' ); 
								} 
								wp.data.dispatch( 'core/edit-post' ).removeEditorPanel( 'welcomeGuide' ); 
							";
		}

		// Disable Top toolbar mode
		if(parent::wpbe_validate_checkbox('wpbe_disable_gtb_toolbar')){
			$gutenberg = true;

			// Create the script for disabling Top toolbar
			$scripts .= " 
								const fixedToolbar = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fixedToolbar' ); 
								if ( fixedToolbar ) { 
									wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fixedToolbar' ); 
								} 
								wp.data.dispatch( 'core/edit-post' ).removeEditorPanel( 'fixedToolbar' ); 
							";
		}

		// Disable Spotlight mode
		if(parent::wpbe_validate_checkbox('wpbe_disable_gtb_spotlight')){
			$gutenberg = true;

			// Create the script for disabling Top toolbar
			$scripts .= " 
								const focusMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'focusMode' ); 
								if ( focusMode ) { 
									wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'focusMode' ); 
								} 
								wp.data.dispatch( 'core/edit-post' ).removeEditorPanel( 'focusMode' ); 
							";
		}

		// Disable Fullscreen mode
		if(parent::wpbe_validate_checkbox('wpbe_disable_gtb_fullscreen')){
			$gutenberg = true;

			// Create the script for disabling Fullscreen
			$scripts .= " 
								const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); 
								if ( isFullscreenMode ) { 
									wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); 
								} 
								wp.data.dispatch( 'core/edit-post' ).removeEditorPanel( 'fullscreenMode' ); 
							";
		}

		// Disable Distraction free mode
		if(parent::wpbe_validate_checkbox('wpbe_disable_gtb_distraction')){
			$gutenberg = true;

			// Create the script for disabling Distraction free
			$scripts .= " 
								const distractionFree = wp.data.select( 'core/edit-post' ).isFeatureActive( 'distractionFree' ); 
								if ( distractionFree ) { 
									wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'distractionFree' ); 
								} 
								wp.data.dispatch( 'core/edit-post' ).removeEditorPanel( 'distractionFree' ); 
							";
		}
		
		// Close Window onload
		$scripts .= "}";

		// Add the scripts inlined
		if($gutenberg){
			wp_add_inline_script('wp-blocks', $scripts);
		}
	}
}