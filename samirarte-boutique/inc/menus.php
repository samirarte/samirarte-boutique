<?php
/**
 * Menu helpers extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_primary_links' ) ) {
	function samirarte_boutique_primary_links() {
		return array(
			array( esc_html__( 'Inicio', 'samirarte-boutique' ), home_url( '/' ) ),
			array( esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ), samirarte_boutique_boxes_url() ),
			array( esc_html__( 'Experiencias', 'samirarte-boutique' ), home_url( '/experiencias/' ) ),
			array( esc_html__( 'Galería', 'samirarte-boutique' ), home_url( '/galeria/' ) ),
			array( esc_html__( 'Cuentos', 'samirarte-boutique' ), home_url( '/cuentos/' ) ),
			array( esc_html__( 'Diario', 'samirarte-boutique' ), samirarte_boutique_diary_url() ),
		);
	}
}

if ( ! function_exists( 'samirarte_boutique_primary_menu' ) ) {
	function samirarte_boutique_primary_menu( $menu_class = 'sam-site-menu' ) {
		echo '<ul class="' . esc_attr( $menu_class ) . '">';
		foreach ( samirarte_boutique_primary_links() as $item ) {
			printf(
				'<li><a href="%1$s">%2$s</a></li>',
				esc_url( $item[1] ),
				esc_html( $item[0] )
			);
		}
		echo '</ul>';
	}
}

// New helper: render a dynamic nav using the 'primary' theme location when available
if ( ! function_exists( 'samirarte_boutique_nav' ) ) {
	function samirarte_boutique_nav( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => '',
			'menu_class'      => isset( $args['menu_class'] ) ? $args['menu_class'] : 'sam-site-menu',
			'fallback_cb'     => 'samirarte_boutique_fallback_menu',
		);

		$nav_args = wp_parse_args( $args, $defaults );
		wp_nav_menu( $nav_args );
	}
}
