<?php
// Template part: compact opening gift for shop lists.
defined( 'ABSPATH' ) || exit;
?>
<section class="sam-opening-gift sam-opening-gift--shop-compact" aria-label="<?php echo esc_attr__( 'Área cliente Samirarte', 'samirarte-boutique' ); ?>">
	<div class="sam-opening-gift__content">
		<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'ÁREA CLIENTE', 'samirarte-boutique' ); ?></p>
		<p class="sam-opening-gift__text"><?php echo esc_html__( 'Accede para consultar tus pedidos, guardar tus datos y hacer seguimiento de nuevas propuestas.', 'samirarte-boutique' ); ?></p>
	</div>
	<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
		<?php echo esc_html__( 'Entrar', 'samirarte-boutique' ); ?>
	</a>
</section>
