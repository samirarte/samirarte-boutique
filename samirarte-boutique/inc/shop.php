<?php
/**
 * Shop-specific markup extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_render_boxes_landing' ) ) {
	function samirarte_boutique_render_boxes_landing() {
		$piece_categories = array(
			array(
				'title' => esc_html__( 'Caja de dátiles gourmet', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Dátiles rellenos y vestidos como pequeñas joyas de sobremesa, con precio propio en tienda.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'producto-caja-datiles-samirarte.webp' ),
				'alt'   => esc_attr__( 'Caja de dátiles gourmet Samirarte', 'samirarte-boutique' ),
			),
			array(
				'title' => esc_html__( 'Caja de pastas finas', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Bocados delicados para té, regalo y celebraciones especiales, configurados como producto cerrado.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'pastas_finas.webp' ),
				'alt'   => esc_attr__( 'Caja de pastas finas Samirarte', 'samirarte-boutique' ),
			),
			array(
				'title' => esc_html__( 'Caja surtida Samirarte', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Una selección combinada de productos gourmet con descripción, disponibilidad y precio propios.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'producto-caja-surtida-samirarte.webp' ),
				'alt'   => esc_attr__( 'Caja surtida Samirarte', 'samirarte-boutique' ),
			),
		);

		// Include the template part so designers can edit markup without changing PHP logic.
		$template = locate_template( 'template-parts/shop/boxes-landing.php' );
		if ( $template ) {
			include $template;
		}
	}
}

if ( ! function_exists( 'samirarte_boutique_google_login_markup' ) ) {
	function samirarte_boutique_google_login_markup( $already_rendered = false, $label = '' ) {
		$markup = '';

		if ( is_user_logged_in() || $already_rendered ) {
			return '';
		}

		if ( shortcode_exists( 'nextend_social_login' ) ) {
			$shortcode = sprintf(
				'[nextend_social_login provider="google" customlabel="%s"]',
				esc_attr( $label ? $label : esc_html__( 'Continuar con Google', 'samirarte-boutique' ) )
			);
			$markup = do_shortcode( $shortcode );
		} elseif ( class_exists( 'NextendSocialLogin', false ) && is_callable( array( 'NextendSocialLogin', 'renderButtonsWithContainer' ) ) ) {
			ob_start();
			$returned_markup = NextendSocialLogin::renderButtonsWithContainer();
			$echoed_markup   = ob_get_clean();
			$markup          = is_string( $returned_markup ) && trim( $returned_markup ) ? $returned_markup : $echoed_markup;
		}

		return trim( (string) apply_filters( 'samirarte_google_login_markup', $markup ) );
	}
}

if ( ! function_exists( 'samirarte_boutique_disable_woocommerce_sidebar' ) ) {
	/**
	 * Keep WooCommerce layouts clean by removing the default sidebar output.
	 */
	function samirarte_boutique_disable_woocommerce_sidebar() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'after_setup_theme', 'samirarte_boutique_disable_woocommerce_sidebar', 99 );
