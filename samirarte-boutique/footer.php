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
			<h2><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
			<?php if ( get_bloginfo( 'description' ) || is_customize_preview() ) : ?>
				<p class="sam-footer__claim"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			<?php endif; ?>
		</section>

		<section class="sam-footer__column">
			<?php
			// Prefer a footer menu if configured; otherwise fall back to a widget area or curated links.
			if ( has_nav_menu( 'footer' ) ) :
				wp_nav_menu( array( 'theme_location' => 'footer', 'container' => '', 'menu_class' => 'sam-footer-menu' ) );
			elseif ( is_active_sidebar( 'footer-1' ) ) :
				dynamic_sidebar( 'footer-1' );
			else :
				?>
				<h2><?php echo esc_html__( 'Catálogo', 'samirarte-boutique' ); ?></h2>
				<ul>
					<li><a href="<?php echo esc_url( samirarte_boutique_boxes_url() ); ?>"><?php echo esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>"><?php echo esc_html__( 'Galería', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/experiencias/' ) ); ?>"><?php echo esc_html__( 'Experiencias', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/cuentos/' ) ); ?>"><?php echo esc_html__( 'Cuentos', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( samirarte_boutique_diary_url() ); ?>"><?php echo esc_html__( 'Diario', 'samirarte-boutique' ); ?></a></li>
				</ul>
				<?php
			endif;
			?>
		</section>

		<section class="sam-footer__column">
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<?php dynamic_sidebar( 'footer-2' ); ?>
			<?php else : ?>
				<h2><?php echo esc_html__( 'Cliente', 'samirarte-boutique' ); ?></h2>
				<ul>
					<li><a href="<?php echo esc_url( $account_url ); ?>"><?php echo esc_html( $account_label ); ?></a></li>
					<li><a href="<?php echo esc_url( $cart_url ); ?>"><?php echo esc_html__( 'Cesta', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contacto/#contacto' ) ); ?>"><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></a></li>
				</ul>
			<?php endif; ?>
		</section>

		<section class="sam-footer__column">
			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<?php dynamic_sidebar( 'footer-3' ); ?>
			<?php else : ?>
				<h2><?php echo esc_html__( 'Legal', 'samirarte-boutique' ); ?></h2>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/condiciones-de-compra/' ) ); ?>"><?php echo esc_html__( 'Condiciones de compra', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>"><?php echo esc_html__( 'Política de privacidad', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/politica-de-cookies/' ) ); ?>"><?php echo esc_html__( 'Política de cookies', 'samirarte-boutique' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>"><?php echo esc_html__( 'Aviso legal', 'samirarte-boutique' ); ?></a></li>
				</ul>
			<?php endif; ?>
		</section>
		<section class="sam-footer__column sam-footer__social" aria-label="<?php echo esc_attr__( 'Redes sociales', 'samirarte-boutique' ); ?>">
			<h2><?php echo esc_html__( 'Síguenos', 'samirarte-boutique' ); ?></h2>
			<ul class="sam-footer__social-list">
				<li>
					<a class="sam-footer__social-link" href="https://www.instagram.com/samirarte.es/" target="_blank" rel="noopener noreferrer">
						<svg class="sam-footer__social-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2Zm0 1.8A3.96 3.96 0 0 0 3.8 7.75v8.5a3.96 3.96 0 0 0 3.95 3.95h8.5a3.96 3.96 0 0 0 3.95-3.95v-8.5a3.96 3.96 0 0 0-3.95-3.95h-8.5Zm4.25 3.1a5.1 5.1 0 1 1 0 10.2 5.1 5.1 0 0 1 0-10.2Zm0 1.8a3.3 3.3 0 1 0 0 6.6 3.3 3.3 0 0 0 0-6.6Zm5.35-2.15a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z" />
						</svg>
						<span class="sam-footer__social-text"><?php echo esc_html__( 'Instagram Samirarte', 'samirarte-boutique' ); ?></span>
					</a>
				</li>
				<li>
					<a class="sam-footer__social-link" href="https://instagram.com/sambirsousou/" target="_blank" rel="noopener noreferrer">
						<svg class="sam-footer__social-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2Zm0 1.8A3.96 3.96 0 0 0 3.8 7.75v8.5a3.96 3.96 0 0 0 3.95 3.95h8.5a3.96 3.96 0 0 0 3.95-3.95v-8.5a3.96 3.96 0 0 0-3.95-3.95h-8.5Zm4.25 3.1a5.1 5.1 0 1 1 0 10.2 5.1 5.1 0 0 1 0-10.2Zm0 1.8a3.3 3.3 0 1 0 0 6.6 3.3 3.3 0 0 0 0-6.6Zm5.35-2.15a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z" />
						</svg>
						<span class="sam-footer__social-text"><?php echo esc_html__( 'Instagram Handmade', 'samirarte-boutique' ); ?></span>
					</a>
				</li>
				<li>
					<a class="sam-footer__social-link" href="https://www.tiktok.com/@simsi901?is_from_webapp=1&amp;sender_device=pc" target="_blank" rel="noopener noreferrer">
						<svg class="sam-footer__social-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M15.25 2.8c.3 2.15 1.56 3.68 3.95 3.82v3.08a7.1 7.1 0 0 1-3.9-1.22v5.98c0 3.02-2.06 5.42-5.16 5.42-2.9 0-5.34-2.16-5.34-5.08 0-3.36 3.25-5.88 6.48-4.96v3.18c-1.31-.48-3.25.15-3.25 1.75 0 1.09.94 1.9 2.06 1.9 1.29 0 2.06-.86 2.06-2.27V2.8h3.1Z" />
						</svg>
						<span class="sam-footer__social-text"><?php echo esc_html__( 'TikTok', 'samirarte-boutique' ); ?></span>
					</a>
				</li>
			</ul>
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
		<p class="sam-footer__legal-links">
			<a href="<?php echo esc_url( home_url( '/samirarte-digital/' ) ); ?>"><?php echo esc_html__( 'Desarrollo Web & Apps — Samirarte Digital', 'samirarte-boutique' ); ?></a>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
