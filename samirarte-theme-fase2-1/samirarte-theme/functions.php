<?php
/**
 * Theme setup and assets.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'SAMIRARTE_THEME_VERSION' ) ) {
	define( 'SAMIRARTE_THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'samirarte_theme_setup' ) ) {
	/**
	 * Register theme supports and navigation areas.
	 */
	function samirarte_theme_setup() {
		load_theme_textdomain( 'samirarte-theme', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 360,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'menus' );
		add_theme_support( 'woocommerce' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Menú principal', 'samirarte-theme' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'samirarte_theme_setup' );

if ( ! function_exists( 'samirarte_theme_assets' ) ) {
	/**
	 * Enqueue public theme assets.
	 */
	function samirarte_theme_assets() {
		wp_enqueue_style(
			'samirarte-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array(),
			SAMIRARTE_THEME_VERSION
		);

		wp_enqueue_script(
			'samirarte-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			SAMIRARTE_THEME_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'samirarte_theme_assets' );
