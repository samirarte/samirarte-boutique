<?php
/**
 * Site header.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

$account_url   = samirarte_boutique_account_url();
$account_label = samirarte_boutique_account_label();
$cart_url      = samirarte_boutique_cart_url();
$cart_count    = samirarte_boutique_cart_count();
$account_current_class = function_exists( 'is_account_page' ) && is_account_page() ? ' current_page_item' : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="sam-header">
	<div class="sam-header__inner">
		<div class="sam-mobile-shell" aria-label="<?php echo esc_attr__( 'Cabecera móvil Samirarte', 'samirarte-boutique' ); ?>">
			<div class="sam-mobile-topline">
				<div class="sam-mobile-brand">
					<?php echo samirarte_boutique_site_branding_markup( 'sam-mobile-site-branding' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<div class="samirarte-header-icons">
					<a class="samirarte-cart-icon sam-mobile-cart-link" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php echo esc_attr__( 'Ver cesta', 'samirarte-boutique' ); ?>">
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 4h2l2.1 10.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L20 8H7M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<?php if ( $cart_count > 0 ) : ?>
							<span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
						<?php endif; ?>
					</a>
					<button class="sam-mobile-menu-toggle" type="button" aria-expanded="false" aria-controls="sam-mobile-menu">
						<span class="screen-reader-text"><?php echo esc_html__( 'Abrir menú', 'samirarte-boutique' ); ?></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
					</button>
				</div>
			</div>

			<div id="sam-mobile-menu" class="sam-mobile-menu" hidden>
				<nav aria-label="<?php echo esc_attr__( 'Navegación principal móvil', 'samirarte-boutique' ); ?>">
					<?php samirarte_boutique_nav( array( 'menu_class' => 'sam-mobile-menu__list' ) ); ?>
				</nav>
				<div class="sam-mobile-menu__utilities">
					<a class="sam-mobile-account-link<?php echo esc_attr( $account_current_class ); ?>" href="<?php echo esc_url( $account_url ); ?>"<?php echo $account_current_class ? ' aria-current="' . esc_attr( 'page' ) . '"' : ''; ?>>
						<?php echo esc_html__( 'Mi cuenta', 'samirarte-boutique' ); ?>
					</a>
					<a href="<?php echo esc_url( $cart_url ); ?>"><?php echo esc_html__( 'Carrito', 'samirarte-boutique' ); ?></a>
					<a class="sam-button sam-mobile-menu__cta" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
						<?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?>
					</a>
				</div>
			</div>
		</div>

		<div class="sam-brand">
			<?php echo samirarte_boutique_site_branding_markup( 'sam-desktop-site-branding' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<nav class="sam-navigation" aria-label="<?php echo esc_attr__( 'Menú principal', 'samirarte-boutique' ); ?>">
			<?php samirarte_boutique_nav(); ?>
		</nav>

		<div class="sam-header-actions">
			<a class="sam-button sam-button--account<?php echo esc_attr( $account_current_class ); ?>" href="<?php echo esc_url( $account_url ); ?>"<?php echo $account_current_class ? ' aria-current="' . esc_attr( 'page' ) . '"' : ''; ?>>
				<?php echo esc_html( $account_label ); ?>
			</a>
			<a class="samirarte-cart-icon" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php echo esc_attr__( 'Ver cesta', 'samirarte-boutique' ); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 4h2l2.1 10.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L20 8H7M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<?php if ( $cart_count > 0 ) : ?>
					<span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
				<?php endif; ?>
			</a>
			<a class="sam-button sam-button--outline" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
				<?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?>
			</a>
		</div>
	</div>
</header>

<main id="primary" class="sam-main">
