<?php
/**
 * Plugin Name: WooCommerce Shortcode
 * Plugin URI: https://github.com/skshami/woocommerce-shortcode/
 * Description: A plugin that adds a shortcode to display WooCommerce products.
 * Version: 1.0.0
 * Author: Shamim Khan
 * Author URI: https://github.com/skshami
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woocommerce-shortcode
 * Domain Path: /languages
 */

// Define constants for plugin directory and URL
define( 'WCS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WCS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
include_once( WCS_PLUGIN_DIR . 'includes/woocommerce-shortcode-functions.php' );

// Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'wcs_enqueue_styles', 999 );
function wcs_enqueue_styles() {
    wp_enqueue_style( 'wcs-plugin-style', WCS_PLUGIN_URL . 'css/wcs-plugin-style.css', array(), '1.0.0', 'all' );
}

// Register activation hook
register_activation_hook( __FILE__, 'wcs_activate' );

// Define activation function
function wcs_activate() {
    // Add necessary activation tasks here
}

// Register deactivation hook
register_deactivation_hook( __FILE__, 'wcs_deactivate' );

// Define deactivation function
function wcs_deactivate() {
    // Add necessary deactivation tasks here
}

// Register uninstall hook
register_uninstall_hook( __FILE__, 'wcs_uninstall' );

// Define uninstall function
function wcs_uninstall() {
    // Add necessary uninstall tasks here
}

?>