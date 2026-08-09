<?php
/**
 * Public shortcodes.
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers Samirarte shortcodes.
 */
if ( ! class_exists( 'Samirarte_Shortcodes' ) ) {
	final class Samirarte_Shortcodes {
	/**
	 * Register shortcode hooks.
	 */
	public static function hooks() {
		add_shortcode( 'samirarte_proceso_pedido', array( __CLASS__, 'order_process' ) );
	}

	/**
	 * Render order process shortcode.
	 *
	 * @param array<string, mixed> $atts Shortcode attributes.
	 * @return string
	 */
	public static function order_process( $atts ) {
		$atts = shortcode_atts( array(), (array) $atts, 'samirarte_proceso_pedido' );
		$atts = array_map( 'sanitize_text_field', $atts );

		$steps = array(
			__( 'Pendiente de pago', 'samirarte-core' ),
			__( 'Pago recibido', 'samirarte-core' ),
			__( 'En preparación', 'samirarte-core' ),
			__( 'Enviado', 'samirarte-core' ),
			__( 'Completado', 'samirarte-core' ),
		);

		ob_start();
		?>
		<ol class="samirarte-order-process">
			<?php foreach ( $steps as $step ) : ?>
				<li><?php echo esc_html( $step ); ?></li>
			<?php endforeach; ?>
		</ol>
		<?php

		return ob_get_clean();
	}
	}
}
