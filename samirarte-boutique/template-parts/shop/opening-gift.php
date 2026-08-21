<?php
// Template part: full opening gift markup. Expects optional $modifier in scope.
defined( 'ABSPATH' ) || exit;
$modifier = isset( $modifier ) ? (string) $modifier : '';
$classes = 'sam-opening-gift';
if ( $modifier ) {
	$classes .= ' ' . sanitize_html_class( $modifier );
}
?>
<section class="<?php echo esc_attr( $classes ); ?>" aria-labelledby="sam-opening-gift-title">
	<span class="sam-opening-gift__seal" aria-hidden="true"></span>
	<div class="sam-opening-gift__content">
		<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'Área cliente Samirarte', 'samirarte-boutique' ); ?></p>
		<h2 id="sam-opening-gift-title" class="sam-opening-gift__title"><?php echo esc_html__( 'Pedidos y propuestas en un solo lugar', 'samirarte-boutique' ); ?></h2>
		<p class="sam-opening-gift__banner"><?php echo esc_html__( 'Crea tu cuenta para consultar pedidos, guardar tus datos y hacer seguimiento de propuestas personalizadas.', 'samirarte-boutique' ); ?></p>
		<div class="sam-opening-gift__text">
			<p><?php echo esc_html__( 'Las cajas definidas muestran su precio directamente en WooCommerce para que puedas pedirlas con claridad.', 'samirarte-boutique' ); ?></p>
			<p><?php echo esc_html__( 'Los pedidos complejos se gestionan bajo petición para revisar alcance, unidades, tiempos y propuesta final.', 'samirarte-boutique' ); ?></p>
			<p><?php echo esc_html__( 'Desde tu cuenta podrás repetir encargos, actualizar tus datos y seguir nuevas solicitudes.', 'samirarte-boutique' ); ?></p>
		</div>
		<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
			<?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?>
		</a>
		<p class="sam-opening-gift__terms"><?php echo esc_html__( 'La confirmación de pedidos especiales depende de disponibilidad, calendario y aceptación de la propuesta.', 'samirarte-boutique' ); ?></p>
	</div>
</section>
