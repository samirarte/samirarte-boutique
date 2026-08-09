<?php
/**
 * 404 template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="sam-page-hero sam-page-hero--center">
	<div class="sam-container">
		<p class="sam-eyebrow"><?php echo esc_html__( 'Página no encontrada', 'samirarte-boutique' ); ?></p>
		<h1><?php echo esc_html__( 'Esta página ya no está disponible.', 'samirarte-boutique' ); ?></h1>
		<p><?php echo esc_html__( 'Puedes volver al inicio o descubrir la coleccion gourmet.', 'samirarte-boutique' ); ?></p>
		<div class="sam-actions sam-actions--center">
			<a class="sam-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Volver al inicio', 'samirarte-boutique' ); ?></a>
			<a class="sam-button sam-button--ghost" href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>"><?php echo esc_html__( 'Ir a tienda', 'samirarte-boutique' ); ?></a>
		</div>
	</div>
</section>

<?php
get_footer();
