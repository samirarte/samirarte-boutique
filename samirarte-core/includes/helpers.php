<?php
/**
 * Shared plugin helpers.
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_core_is_woocommerce_active' ) ) {
	/**
	 * Check whether WooCommerce is active.
	 *
	 * @return bool
	 */
	function samirarte_core_is_woocommerce_active() {
		return class_exists( 'WooCommerce' );
	}
}
