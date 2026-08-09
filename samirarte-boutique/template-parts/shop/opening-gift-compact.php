<?php
// Template part: compact opening gift for shop lists.
defined( 'ABSPATH' ) || exit;
?>
<section class="sam-opening-gift sam-opening-gift--shop-compact" aria-label="<?php echo esc_attr__( 'Aviso de preapertura', 'samirarte-boutique' ); ?>">
	<div class="sam-opening-gift__content">
		<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'PREAPERTURA', 'samirarte-boutique' ); ?></p>
		<p class="sam-opening-gift__text"><?php echo esc_html__( 'Regístrate antes de la apertura y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
	</div>
	<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
		<?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?>
	</a>
</section>
