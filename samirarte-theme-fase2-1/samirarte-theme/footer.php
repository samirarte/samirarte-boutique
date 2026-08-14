<?php
/**
 * Site footer.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">
	<div class="samirarte-container footer-grid">
		<div class="footer-brand">
			<h2><?php esc_html_e( 'Samirarte', 'samirarte-theme' ); ?></h2>
			<p class="footer-subtitle"><?php esc_html_e( 'Artesanía Gourmet', 'samirarte-theme' ); ?></p>
			<p><?php esc_html_e( 'Tradición que se saborea, arte que se comparte.', 'samirarte-theme' ); ?></p>
		</div>

		<nav class="footer-nav" aria-label="<?php echo esc_attr__( 'Navegación', 'samirarte-theme' ); ?>">
			<h3><?php esc_html_e( 'Navegación', 'samirarte-theme' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/artesania-gourmet/' ) ); ?>"><?php esc_html_e( 'Artesanía Gourmet', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/experiencias/' ) ); ?>"><?php esc_html_e( 'Experiencias', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/cuentos/' ) ); ?>"><?php esc_html_e( 'Cuentos', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>"><?php esc_html_e( 'Tienda', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Contacto', 'samirarte-theme' ); ?></a></li>
			</ul>
		</nav>

		<nav class="footer-nav" aria-label="<?php echo esc_attr__( 'Cliente', 'samirarte-theme' ); ?>">
			<h3><?php esc_html_e( 'Cliente', 'samirarte-theme' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/mi-cuenta/' ) ); ?>"><?php esc_html_e( 'Mi cuenta', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/condiciones-de-compra/' ) ); ?>"><?php esc_html_e( 'Condiciones de compra', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>"><?php esc_html_e( 'Política de privacidad', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-cookies/' ) ); ?>"><?php esc_html_e( 'Política de cookies', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>"><?php esc_html_e( 'Aviso legal', 'samirarte-theme' ); ?></a></li>
			</ul>
		</nav>

		<div class="footer-contact">
			<h3><?php esc_html_e( 'Contacto', 'samirarte-theme' ); ?></h3>
			<p><a href="<?php echo esc_url( 'mailto:samira.raysse@samirarte.com' ); ?>"><?php echo esc_html( 'samira.raysse@samirarte.com' ); ?></a></p>
			<p><a class="sam-site-footer__form-link" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Formulario de contacto', 'samirarte-theme' ); ?></a></p>
		</div>

		<section class="sam-site-footer__social" aria-label="<?php echo esc_attr__( 'Redes sociales', 'samirarte-theme' ); ?>">
			<h3><?php echo esc_html__( 'Síguenos', 'samirarte-theme' ); ?></h3>
			<ul class="sam-site-footer__social-list">
				<li>
				<a class="sam-site-footer__social-link" href="https://wa.me/34676679064?text=Hola%20Samirarte%2C%20quiero%20informaci%C3%B3n." target="_blank" rel="noopener noreferrer">
					<svg class="sam-site-footer__social-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M20.52 3.48A11.94 11.94 0 1 0 12.06 24l-1.63-5.94A11.95 11.95 0 0 0 20.52 3.48zM12 2a10 10 0 0 1 8.24 15.74l-.59.86L21 22l-4.4-1.3-.82.59A10 10 0 1 1 12 2z" />
					</svg>
					<span class="sam-site-footer__social-text"><?php echo esc_html__( 'WhatsApp', 'samirarte-theme' ); ?></span>
				</a>
				</li>
				</ul>
		</section>

	</div>

	<div class="samirarte-container footer-bottom">
		<p>
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
			<?php esc_html_e( 'Samirarte. Todos los derechos reservados.', 'samirarte-theme' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
