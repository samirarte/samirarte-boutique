<?php
/**
 * SEO helpers extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_seo_data' ) ) {
	function samirarte_boutique_seo_data() {
		$data = array();

		if ( is_front_page() ) {
			$data = array(
				'title'       => esc_html__( 'Samirarte | Artesanía gourmet, cajas regalo y experiencias privadas', 'samirarte-boutique' ),
				'description' => esc_html__( 'Samirarte ofrece cajas gourmet por tipo de producto, cada una con precio visible, y propuestas a medida para pedidos complejos.', 'samirarte-boutique' ),
			);
		} elseif ( is_page( array( 'artesania-gourmet', 'cajas-gourmet' ) ) || ( function_exists( 'is_shop' ) && is_shop() ) ) {
			$data = array(
				'title'       => esc_html__( 'Cajas Gourmet con precio | Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Compra cajas gourmet de productos diferentes, cada una con su precio visible, o solicita una propuesta para pedidos complejos.', 'samirarte-boutique' ),
			);
		} elseif ( is_page( 'experiencias' ) ) {
			$data = array(
				'title'       => esc_html__( 'Experiencias Samirarte a medida | Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Mesas, rituales, degustaciones y momentos gourmet diseñados a medida para celebraciones privadas, empresas y eventos especiales.', 'samirarte-boutique' ),
			);
		} elseif ( is_page( 'cuentos' ) ) {
			$data = array(
				'title'       => esc_html__( 'Cuentos enviados con cajas Samirarte | Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Archivo íntimo de cuentos enviados junto a cajas Samirarte, compartidos con nombre de pila y destino para preservar la privacidad de cada cliente.', 'samirarte-boutique' ),
			);
		} elseif ( is_page( 'galeria' ) ) {
			$data = array(
				'title'       => esc_html__( 'Galería de creaciones y experiencias | Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Cajas, bocados, procesos artesanales, experiencias y detalles del universo visual Samirarte.', 'samirarte-boutique' ),
			);
		} elseif ( is_home() || is_page( 'diario' ) ) {
			$data = array(
				'title'       => esc_html__( 'Diario | Historias e inspiración gourmet Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Notas sobre cocina árabe, cultura del té, ingredientes singulares, celebraciones, procesos artesanales y el arte de regalar.', 'samirarte-boutique' ),
			);
		}

		return $data;
	}
}

if ( ! function_exists( 'samirarte_boutique_document_title' ) ) {
	function samirarte_boutique_document_title( $parts ) {
		$seo = samirarte_boutique_seo_data();

		if ( ! empty( $seo['title'] ) ) {
			$parts['title'] = $seo['title'];
			unset( $parts['site'] );
		}

		return $parts;
	}
}
add_filter( 'document_title_parts', 'samirarte_boutique_document_title' );

if ( ! function_exists( 'samirarte_boutique_meta_description' ) ) {
	function samirarte_boutique_meta_description() {
		$seo = samirarte_boutique_seo_data();

		if ( empty( $seo['description'] ) ) {
			return;
		}

		printf(
			'<meta name="description" content="%s">' . "\n",
			esc_attr( $seo['description'] )
		);
	}
}
add_action( 'wp_head', 'samirarte_boutique_meta_description', 2 );
