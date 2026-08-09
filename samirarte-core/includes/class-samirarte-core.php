<?php
/**
 * Main plugin class.
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Bootstrap plugin components.
 */
if ( ! class_exists( 'Samirarte_Core' ) ) {
	final class Samirarte_Core {
	/**
	 * Singleton instance.
	 *
	 * @var Samirarte_Core|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return Samirarte_Core
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->hooks();
	}

	/**
	 * Register hooks.
	 */
	private function hooks() {
		if (
			class_exists( 'Samirarte_Order_Statuses' )
			&& method_exists( 'Samirarte_Order_Statuses', 'register' )
			&& method_exists( 'Samirarte_Order_Statuses', 'add_to_woocommerce_statuses' )
		) {
			add_action( 'init', array( 'Samirarte_Order_Statuses', 'register' ) );
			add_filter( 'wc_order_statuses', array( 'Samirarte_Order_Statuses', 'add_to_woocommerce_statuses' ) );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );

		if ( class_exists( 'Samirarte_WooCommerce_Adjustments' ) && method_exists( 'Samirarte_WooCommerce_Adjustments', 'hooks' ) ) {
			Samirarte_WooCommerce_Adjustments::hooks();
		}

		if ( class_exists( 'Samirarte_Order_Emails' ) && method_exists( 'Samirarte_Order_Emails', 'hooks' ) ) {
			Samirarte_Order_Emails::hooks();
		}

		if ( class_exists( 'Samirarte_Shortcodes' ) && method_exists( 'Samirarte_Shortcodes', 'hooks' ) ) {
			Samirarte_Shortcodes::hooks();
		}
	}

	/**
	 * Enqueue plugin admin assets.
	 *
	 * @param string $hook_suffix Current admin page hook.
	 */
	public function admin_assets( $hook_suffix ) {
		$hook_suffix = sanitize_key( $hook_suffix );

		wp_enqueue_style(
			'samirarte-core-admin',
			SAMIRARTE_CORE_URL . 'assets/css/admin.css',
			array(),
			SAMIRARTE_CORE_VERSION
		);

		wp_enqueue_script(
			'samirarte-core-admin',
			SAMIRARTE_CORE_URL . 'assets/js/admin.js',
			array(),
			SAMIRARTE_CORE_VERSION,
			true
		);
	}
	}
}
