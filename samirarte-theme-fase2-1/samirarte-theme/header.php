<?php
/**
 * Site header.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$contact_phone = '+34676679064';
$whatsapp_url  = 'https://wa.me/34676679064';
?>

<header class="site-header">
	<div class="samirarte-container header-inner">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo esc_html__( 'Samirarte', 'samirarte-theme' ); ?>
				</a>
			<?php endif; ?>
			<span class="site-subtitle"><?php esc_html_e( 'Artesanía Gourmet', 'samirarte-theme' ); ?></span>
		</div>

		<nav class="primary-navigation" aria-label="<?php echo esc_attr__( 'Menú principal', 'samirarte-theme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-menu',
					'fallback_cb'    => false,
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="header-actions">
			<a class="header-link" href="<?php echo esc_url( 'tel:' . $contact_phone ); ?>">
				<?php echo esc_html( $contact_phone ); ?>
			</a>
			<a class="header-link" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'WhatsApp', 'samirarte-theme' ); ?>
			</a>
			<a class="header-link" href="<?php echo esc_url( home_url( '/mi-cuenta/' ) ); ?>">
				<?php esc_html_e( 'Acceso cliente', 'samirarte-theme' ); ?>
			</a>
			<a class="header-cta" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
				<?php esc_html_e( 'Solicitar propuesta', 'samirarte-theme' ); ?>
			</a>
		</div>
	</div>
</header>
