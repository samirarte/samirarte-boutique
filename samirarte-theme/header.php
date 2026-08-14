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
$sam_logo_path = get_template_directory() . '/assets/img/logo-samirarte.png';
$sam_logo_url  = get_template_directory_uri() . '/assets/img/logo-samirarte.png';
?>

<header class="sam-site-header">
	<div class="sam-site-header__inner">
		<?php
		$contact_phone = '+34676679064';
		$whatsapp_url  = 'https://wa.me/34676679064';
		?>
		<div class="sam-site-header__brand">
			<?php if ( file_exists( $sam_logo_path ) ) : ?>
				<a class="sam-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="sam-logo-img" src="<?php echo esc_url( $sam_logo_url ); ?>" alt="<?php echo esc_attr__( 'Samirarte', 'samirarte-theme' ); ?>">
				</a>
			<?php endif; ?>
			<div class="sam-site-header__brand-text">
				<a class="sam-site-header__title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo esc_html__( 'Samirarte', 'samirarte-theme' ); ?>
				</a>
				<span class="sam-site-header__subtitle"><?php esc_html_e( 'Artesanía Gourmet', 'samirarte-theme' ); ?></span>
			</div>
		</div>

		<nav class="sam-site-header__nav" aria-label="<?php echo esc_attr__( 'Menú principal', 'samirarte-theme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'sam-site-menu',
					'fallback_cb'    => false,
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="sam-site-header__actions">
			<a class="sam-site-header__account" href="<?php echo esc_url( 'tel:' . $contact_phone ); ?>">
				<?php echo esc_html( $contact_phone ); ?>
			</a>
			<a class="sam-site-header__account" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'WhatsApp', 'samirarte-theme' ); ?>
			</a>
			<a class="sam-site-header__account" href="<?php echo esc_url( home_url( '/mi-cuenta/' ) ); ?>">
				<?php esc_html_e( 'Acceso cliente', 'samirarte-theme' ); ?>
			</a>
			<a class="sam-site-header__proposal" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
				<?php esc_html_e( 'Solicitar propuesta', 'samirarte-theme' ); ?>
			</a>
		</div>
	</div>
</header>
