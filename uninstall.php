<?php 
/**
 * Plugin uninstallation file.
 *
 * This file is called when the plugin is deleted from the WordPress dashboard.
 * It deletes the 'wpbe_settings' option from the WordPress database.
 *
 * @package WPBE
 * @since 5.4.0
 */

// Check that the WordPress environment is available.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Delete the plugin options from the database.
delete_option( 'wpbe_settings' );