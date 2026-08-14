<?php
/**
 * Site footer.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

$sam_logo_path = get_template_directory() . '/assets/img/logo-samirarte.png';
$sam_logo_url  = get_template_directory_uri() . '/assets/img/logo-samirarte.png';
?>

<footer class="sam-site-footer">
	<div class="sam-site-footer__inner">
		<div class="sam-site-footer__brand">
			<?php if ( file_exists( $sam_logo_path ) ) : ?>
				<img class="sam-footer-logo" src="<?php echo esc_url( $sam_logo_url ); ?>" alt="<?php echo esc_attr__( 'Samirarte', 'samirarte-theme' ); ?>">
			<?php endif; ?>
			<h2><?php esc_html_e( 'Samirarte', 'samirarte-theme' ); ?></h2>
			<p class="sam-site-footer__subtitle"><?php esc_html_e( 'Artesanía Gourmet', 'samirarte-theme' ); ?></p>
			<p><?php esc_html_e( 'Tradición que se saborea, arte que se comparte.', 'samirarte-theme' ); ?></p>
		</div>

		<nav class="sam-site-footer__nav" aria-label="<?php echo esc_attr__( 'Navegación', 'samirarte-theme' ); ?>">
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

		<nav class="sam-site-footer__nav" aria-label="<?php echo esc_attr__( 'Cliente', 'samirarte-theme' ); ?>">
			<h3><?php esc_html_e( 'Cliente', 'samirarte-theme' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/mi-cuenta/' ) ); ?>"><?php esc_html_e( 'Mi cuenta', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/condiciones-de-compra/' ) ); ?>"><?php esc_html_e( 'Condiciones de compra', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>"><?php esc_html_e( 'Política de privacidad', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-cookies/' ) ); ?>"><?php esc_html_e( 'Política de cookies', 'samirarte-theme' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>"><?php esc_html_e( 'Aviso legal', 'samirarte-theme' ); ?></a></li>
			</ul>
		</nav>

		<div class="sam-site-footer__contact">
			<h3><?php esc_html_e( 'Contacto', 'samirarte-theme' ); ?></h3>
			<p><?php echo esc_html( 'samira.raysse@samirarte.com' ); ?></p>
			<p><a href="<?php echo esc_url( 'tel:+34676679064' ); ?>"><?php echo esc_html( '+34676679064' ); ?></a></p>
			<p><a href="<?php echo esc_url( 'https://wa.me/34676679064' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WhatsApp', 'samirarte-theme' ); ?></a></p>
			<p><a class="sam-site-footer__form-link" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Formulario de contacto', 'samirarte-theme' ); ?></a></p>
		</div>
	</div>

	<div class="sam-site-footer__bottom">
		<p>
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
			<?php esc_html_e( 'Samirarte. Todos los derechos reservados.', 'samirarte-theme' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
