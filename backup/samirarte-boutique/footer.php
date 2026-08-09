<?php
/**
 * Site footer.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

$account_url   = samirarte_boutique_account_url();
$account_label = samirarte_boutique_account_label();
$cart_url      = samirarte_boutique_cart_url();
?>
</main>

<footer class="sam-footer">
	<div class="sam-footer__inner">
		<section class="sam-footer__brand" aria-label="<?php echo esc_attr__( 'Samirarte', 'samirarte-boutique' ); ?>">
			<?php echo samirarte_boutique_logo_markup( 'sam-footer__logo' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2><?php echo esc_html__( 'Samirarte', 'samirarte-boutique' ); ?></h2>
			<p><?php echo esc_html__( 'Artesanía Gourmet', 'samirarte-boutique' ); ?></p>
			<p><?php echo esc_html__( 'Tradición que se saborea, arte que se comparte.', 'samirarte-boutique' ); ?></p>
		</section>

		<section class="sam-footer__column">
			<h2><?php echo esc_html__( 'Catálogo', 'samirarte-boutique' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( samirarte_boutique_boxes_url() ); ?>"><?php echo esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>"><?php echo esc_html__( 'Galería', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/experiencias/' ) ); ?>"><?php echo esc_html__( 'Experiencias', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/cuentos/' ) ); ?>"><?php echo esc_html__( 'Cuentos', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( samirarte_boutique_diary_url() ); ?>"><?php echo esc_html__( 'Diario', 'samirarte-boutique' ); ?></a></li>
			</ul>
		</section>

		<section class="sam-footer__column">
			<h2><?php echo esc_html__( 'Cliente', 'samirarte-boutique' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( $account_url ); ?>"><?php echo esc_html( $account_label ); ?></a></li>
				<li><a href="<?php echo esc_url( $cart_url ); ?>"><?php echo esc_html__( 'Carrito', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></a></li>
			</ul>
		</section>

		<section class="sam-footer__column sam-footer__contact">
			<h2><?php echo esc_html__( 'Legal', 'samirarte-boutique' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/condiciones-de-compra/' ) ); ?>"><?php echo esc_html__( 'Condiciones de compra', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>"><?php echo esc_html__( 'Política de privacidad', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-cookies/' ) ); ?>"><?php echo esc_html__( 'Política de cookies', 'samirarte-boutique' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>"><?php echo esc_html__( 'Aviso legal', 'samirarte-boutique' ); ?></a></li>
			</ul>
			<a class="sam-button sam-button--light" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
				<?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?>
			</a>
			<p class="sam-footer__legal"><?php echo esc_html__( 'samira.raysse@samirarte.com', 'samirarte-boutique' ); ?></p>
		</section>
	</div>

	<div class="sam-footer__bottom">
		<p>
			<?php
			printf(
				esc_html__( '%1$s %2$s Samirarte. Todos los derechos reservados.', 'samirarte-boutique' ),
				'&copy;',
				esc_html( date_i18n( 'Y' ) )
			);
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
