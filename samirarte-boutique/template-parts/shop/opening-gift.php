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
		<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'Lista privada de preapertura', 'samirarte-boutique' ); ?></p>
		<h2 id="sam-opening-gift-title" class="sam-opening-gift__title"><?php echo esc_html__( 'Detalle exclusivo de apertura', 'samirarte-boutique' ); ?></h2>
		<p class="sam-opening-gift__banner"><?php echo esc_html__( 'Regístrate antes de la apertura y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
		<div class="sam-opening-gift__text">
			<p><?php echo esc_html__( 'Regístrate como cliente antes de la apertura de Samirarte y formarás parte de nuestra primera lista privada.', 'samirarte-boutique' ); ?></p>
			<p><?php echo esc_html__( 'Cuando la tienda abra, recibirás un detalle exclusivo con tu primer pedido, preparado solo para quienes acompañen el inicio de esta historia.', 'samirarte-boutique' ); ?></p>
			<p><?php echo esc_html__( 'Muy pronto podrás elegir tu caja gourmet, completarla con tus piezas favoritas y descubrir una forma distinta de regalar.', 'samirarte-boutique' ); ?></p>
		</div>
		<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
			<?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?>
		</a>
		<p class="sam-opening-gift__terms"><?php echo esc_html__( 'Promoción válida para clientes registrados antes de la apertura. El regalo se incluirá en el primer pedido realizado tras la apertura, sujeto a disponibilidad.', 'samirarte-boutique' ); ?></p>
	</div>
</section>
