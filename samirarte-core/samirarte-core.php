<?php
/**
 * Plugin Name: Samirarte Core
 * Plugin URI: https://samirarte.com/
 * Description: Funcionalidad base para Samirarte: estados de pedido y shortcodes.
 * Version: 1.0.0
 * Author: Samirarte
 * Author URI: https://samirarte.com/
 * Text Domain: samirarte-core
 * Requires at least: 6.0
 * Requires PHP: 7.4
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'SAMIRARTE_CORE_VERSION' ) ) {
	define( 'SAMIRARTE_CORE_VERSION', '1.0.0' );
}

if ( ! defined( 'SAMIRARTE_CORE_FILE' ) ) {
	define( 'SAMIRARTE_CORE_FILE', __FILE__ );
}

if ( ! defined( 'SAMIRARTE_CORE_PATH' ) ) {
	define( 'SAMIRARTE_CORE_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SAMIRARTE_CORE_URL' ) ) {
	define( 'SAMIRARTE_CORE_URL', plugin_dir_url( __FILE__ ) );
}

$samirarte_core_includes = array(
	'includes/helpers.php',
	'includes/class-order-statuses.php',
	'includes/class-order-emails.php',
	'includes/class-woocommerce-adjustments.php',
	'includes/class-shortcodes.php',
	'includes/class-samirarte-core.php',
);

foreach ( $samirarte_core_includes as $samirarte_core_include ) {
	$samirarte_core_file = SAMIRARTE_CORE_PATH . $samirarte_core_include;

	if ( file_exists( $samirarte_core_file ) ) {
		require_once $samirarte_core_file;
	}
}

unset( $samirarte_core_file, $samirarte_core_include, $samirarte_core_includes );

add_action(
	'plugins_loaded',
	static function () {
		if ( class_exists( 'Samirarte_Core' ) && method_exists( 'Samirarte_Core', 'instance' ) ) {
			Samirarte_Core::instance();
		}
	}
);
