<?php
/**
 * Custom WooCommerce order statuses.
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers Samirarte order statuses.
 */
if ( ! class_exists( 'Samirarte_Order_Statuses' ) ) {
	final class Samirarte_Order_Statuses {
	/**
	 * Custom statuses.
	 *
	 * @return array<string, string>
	 */
	public static function get_statuses() {
		return array(
			'wc-sam-pago-recibido' => __( 'Pago recibido', 'samirarte-core' ),
			'wc-sam-preparacion'   => __( 'En preparación', 'samirarte-core' ),
			'wc-sam-enviado'       => __( 'Enviado', 'samirarte-core' ),
		);
	}

	/**
	 * Register statuses with WordPress.
	 */
	public static function register() {
		foreach ( self::get_statuses() as $status_key => $label ) {
			register_post_status(
				$status_key,
				array(
					'label'                     => esc_html( $label ),
					'public'                    => true,
					'exclude_from_search'       => false,
					'show_in_admin_all_list'    => true,
					'show_in_admin_status_list' => true,
					/* translators: %s: order count. */
					'label_count'               => _n_noop(
						esc_html( $label ) . ' <span class="count">(%s)</span>',
						esc_html( $label ) . ' <span class="count">(%s)</span>',
						'samirarte-core'
					),
				)
			);
		}
	}

	/**
	 * Add statuses to WooCommerce order status list.
	 *
	 * @param array<string, string> $order_statuses Existing WooCommerce statuses.
	 * @return array<string, string>
	 */
	public static function add_to_woocommerce_statuses( $order_statuses ) {
		if ( ! is_array( $order_statuses ) ) {
			$order_statuses = array();
		}

		$custom_statuses = self::get_statuses();
		$new_statuses    = array();

		foreach ( $order_statuses as $status_key => $status_label ) {
			$new_statuses[ $status_key ] = esc_html( $status_label );

			if ( 'wc-processing' === $status_key ) {
				foreach ( $custom_statuses as $custom_key => $custom_label ) {
					$new_statuses[ $custom_key ] = esc_html( $custom_label );
				}
			}
		}

		if ( empty( $order_statuses ) ) {
			foreach ( $custom_statuses as $custom_key => $custom_label ) {
				$new_statuses[ $custom_key ] = esc_html( $custom_label );
			}
		}

		return $new_statuses;
	}
	}
}
