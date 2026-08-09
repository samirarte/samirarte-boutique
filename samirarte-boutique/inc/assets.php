<?php
/**
 * Theme asset enqueues extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_asset_version' ) ) {
	function samirarte_boutique_asset_version( $relative_path ) {
		$file = get_template_directory() . $relative_path;

		if ( file_exists( $file ) ) {
			return (string) filemtime( $file );
		}

		return '1.0.0';
	}
}

if ( ! function_exists( 'samirarte_boutique_enqueue_assets' ) ) {
	function samirarte_boutique_enqueue_assets() {
		wp_enqueue_style(
			'samirarte-boutique-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array(),
			samirarte_boutique_asset_version( '/assets/css/main.css' )
		);

		wp_enqueue_script(
			'samirarte-boutique-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			samirarte_boutique_asset_version( '/assets/js/main.js' ),
			true
		);

		wp_script_add_data( 'samirarte-boutique-main', 'strategy', 'defer' );

		wp_localize_script(
			'samirarte-boutique-main',
			'SamirarteBoutique',
			array(
				'debug'       => defined( 'SAMIRARTE_DEBUG' ) && SAMIRARTE_DEBUG,
				'isFrontPage' => is_front_page(),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'samirarte_boutique_enqueue_assets' );

// Enqueue styles specific to the Samirarte Digital template only
if ( ! function_exists( 'samirarte_boutique_enqueue_digital_assets' ) ) {
	function samirarte_boutique_enqueue_digital_assets() {
		// Only enqueue on pages using the page-digital.php template
		if ( function_exists( 'is_page_template' ) && is_page_template( 'page-digital.php' ) ) {
			wp_enqueue_style(
				'samirarte-boutique-digital',
				get_template_directory_uri() . '/assets/css/digital.css',
				array( 'samirarte-boutique-main' ),
				samirarte_boutique_asset_version( '/assets/css/digital.css' )
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'samirarte_boutique_enqueue_digital_assets', 25 );
