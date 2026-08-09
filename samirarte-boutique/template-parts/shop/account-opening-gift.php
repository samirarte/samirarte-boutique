<?php
// Template part: account page opening gift notice.
defined( 'ABSPATH' ) || exit;
?>
<aside class="sam-account-gift" aria-label="<?php echo esc_attr__( 'Regalo de apertura', 'samirarte-boutique' ); ?>">
	<div class="sam-account-gift__message">
		<svg class="sam-account-gift__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 10h16v10H4V10Zm-1-4h18v4H3V6Zm9 0v14M12 6H8.8a2.3 2.3 0 1 1 2.3-2.3L12 6Zm0 0h3.2a2.3 2.3 0 1 0-2.3-2.3L12 6Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
		<p class="sam-account-gift__text"><?php echo esc_html__( 'Regístrate antes del lanzamiento y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
	</div>
	<a class="sam-button sam-account-gift__cta" href="#registro" data-sam-account-register>
		<?php echo esc_html__( 'Quiero mi regalo', 'samirarte-boutique' ); ?>
	</a>
</aside>
