<?php
/**
 * Customer emails for commercial order statuses.
 *
 * @package Samirarte_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sends Samirarte customer emails when an order changes commercial status.
 */
if ( ! class_exists( 'Samirarte_Order_Emails' ) ) {
	final class Samirarte_Order_Emails {
		/**
		 * Register WooCommerce hooks.
		 */
		public static function hooks() {
			add_action( 'woocommerce_order_status_changed', array( __CLASS__, 'maybe_send_status_email' ), 20, 4 );
		}

		/**
		 * Send a customer email for supported order status changes.
		 *
		 * @param int      $order_id   Order ID.
		 * @param string   $old_status Previous order status without wc- prefix.
		 * @param string   $new_status New order status without wc- prefix.
		 * @param WC_Order $order      WooCommerce order object.
		 */
		public static function maybe_send_status_email( $order_id, $old_status, $new_status, $order ) {
			$order_id   = absint( $order_id );
			$new_status = sanitize_key( $new_status );

			if ( ! self::is_woocommerce_available() ) {
				return;
			}

			if ( ! is_a( $order, 'WC_Order' ) && function_exists( 'wc_get_order' ) ) {
				$order = wc_get_order( $order_id );
			}

			if ( ! is_a( $order, 'WC_Order' ) ) {
				return;
			}

			$email_data = self::get_email_data( $new_status, $order );

			if ( empty( $email_data ) ) {
				return;
			}

			$billing_email = sanitize_email( $order->get_billing_email() );

			if ( empty( $billing_email ) || ! is_email( $billing_email ) ) {
				$order->add_order_note(
					esc_html__( 'Samirarte Core: email de estado no enviado porque el pedido no tiene email de facturación válido.', 'samirarte-core' ),
					false,
					false
				);
				return;
			}

			$order->add_order_note(
				sprintf(
					/* translators: %s: customer email. */
					esc_html__( 'Samirarte Core: intentando enviar email de estado al cliente: %s', 'samirarte-core' ),
					esc_html( $billing_email )
				),
				false,
				false
			);

			$sent = self::send_email(
				$billing_email,
				$email_data['subject'],
				$email_data['message']
			);

			if ( $sent ) {
				$order->add_order_note(
					sprintf(
						/* translators: %s: customer email. */
						esc_html__( 'Samirarte Core: email de estado enviado correctamente a %s.', 'samirarte-core' ),
						esc_html( $billing_email )
					),
					false,
					false
				);
				return;
			}

			$order->add_order_note(
				sprintf(
					/* translators: %s: customer email. */
					esc_html__( 'Samirarte Core: fallo al enviar el email de estado a %s.', 'samirarte-core' ),
					esc_html( $billing_email )
				),
				false,
				false
			);
		}

		/**
		 * Check whether WooCommerce functions/classes are available.
		 *
		 * @return bool
		 */
		private static function is_woocommerce_available() {
			return class_exists( 'WooCommerce' ) && function_exists( 'wc_get_order' );
		}

		/**
		 * Get subject and message for a commercial status.
		 *
		 * @param string   $status Order status without wc- prefix.
		 * @param WC_Order $order  WooCommerce order object.
		 * @return array<string, string>
		 */
		private static function get_email_data( $status, $order ) {
			$order_number = esc_html( $order->get_order_number() );

			$emails = array(
				'pending'           => array(
					'subject' => __( 'Samirarte · Pedido recibido, pendiente de pago', 'samirarte-core' ),
					'message' => sprintf(
						/* translators: %s: order number. */
						__( 'Hemos recibido tu pedido #%s.<br>Para confirmarlo, realiza el Bizum al +34 676 67 90 64 indicando la referencia del pedido.', 'samirarte-core' ),
						$order_number
					),
				),
				'sam-pago-recibido' => array(
					'subject' => __( 'Samirarte · Pago recibido', 'samirarte-core' ),
					'message' => sprintf(
						/* translators: %s: order number. */
						__( 'Hemos confirmado la recepción del pago de tu pedido #%s.<br>A partir de ahora prepararemos tu encargo con el cuidado que merece.', 'samirarte-core' ),
						$order_number
					),
				),
				'sam-preparacion'   => array(
					'subject' => __( 'Samirarte · Tu pedido está en preparación', 'samirarte-core' ),
					'message' => sprintf(
						/* translators: %s: order number. */
						__( 'Tu pedido #%s ya está en preparación.<br>Estamos cuidando cada detalle antes de su entrega.', 'samirarte-core' ),
						$order_number
					),
				),
				'sam-enviado'       => array(
					'subject' => __( 'Samirarte · Pedido enviado o listo para entrega acordada', 'samirarte-core' ),
					'message' => sprintf(
						/* translators: %s: order number. */
						__( 'Tu pedido #%s ha sido enviado o está listo para la entrega acordada.<br>Si necesitamos concretar algún detalle, contactaremos contigo.', 'samirarte-core' ),
						$order_number
					),
				),
			);

			if ( ! isset( $emails[ $status ] ) ) {
				return array();
			}

			return array(
				'subject' => sanitize_text_field( $emails[ $status ]['subject'] ),
				'message' => wp_kses_post( $emails[ $status ]['message'] ),
			);
		}

		/**
		 * Send a HTML email.
		 *
		 * @param string $to      Recipient email.
		 * @param string $subject Email subject.
		 * @param string $message Email body content.
		 * @return bool
		 */
		private static function send_email( $to, $subject, $message ) {
			$html = self::get_email_html( $message );

			if ( function_exists( 'WC' ) && WC() && is_callable( array( WC(), 'mailer' ) ) ) {
				$mailer = WC()->mailer();

				if ( is_object( $mailer ) && is_callable( array( $mailer, 'send' ) ) ) {
					return (bool) $mailer->send(
						$to,
						$subject,
						$html,
						array( 'Content-Type: text/html; charset=UTF-8' )
					);
				}
			}

			return (bool) wp_mail(
				$to,
				$subject,
				$html,
				array( 'Content-Type: text/html; charset=UTF-8' )
			);
		}

		/**
		 * Build simple HTML email.
		 *
		 * @param string $message Email message.
		 * @return string
		 */
		private static function get_email_html( $message ) {
			ob_start();
			?>
			<!doctype html>
			<html>
			<head>
				<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
				<title><?php echo esc_html__( 'Samirarte', 'samirarte-core' ); ?></title>
			</head>
			<body style="margin:0;padding:0;background:#fff7ea;color:#2b211b;font-family:Arial,Helvetica,sans-serif;">
				<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#fff7ea;padding:28px 12px;">
					<tr>
						<td align="center">
							<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;background:#ffffff;border:1px solid #f4e6cf;">
								<tr>
									<td style="padding:28px 30px;background:#24130d;color:#fff7ea;">
										<h1 style="margin:0;font-family:Georgia,serif;font-size:30px;line-height:1.1;"><?php echo esc_html__( 'Samirarte', 'samirarte-core' ); ?></h1>
									</td>
								</tr>
								<tr>
									<td style="padding:30px;color:#2b211b;font-size:16px;line-height:1.6;">
										<?php echo wp_kses_post( wpautop( $message ) ); ?>
									</td>
								</tr>
								<tr>
									<td style="padding:22px 30px;background:#f4e6cf;color:#4b2e22;font-size:14px;line-height:1.6;">
										<p style="margin:0;"><?php echo esc_html( 'samira.raysse@samirarte.com' ); ?></p>
										<p style="margin:0"><?php echo esc_html( '+34 676 67 90 64' ); ?></p>
										<p style="margin:0;"><a href="https://wa.me/34676679064?text=<?php echo rawurlencode( 'Hola Samirarte, quiero información.' ); ?>" style="color:#4b2e22;text-decoration:none;">WhatsApp</a></p>									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>
			</html>
			<?php

			return (string) ob_get_clean();
		}
	}
}
