<?php
/**
 * Shop-specific markup extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_render_boxes_landing' ) ) {
	function samirarte_boutique_render_boxes_landing() {
		$piece_categories = array(
			array(
				'title' => esc_html__( 'Minipastelas', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Capas crujientes, rellenos especiados y acabados delicados.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'pastelas.webp' ),
				'alt'   => esc_attr__( 'Minipastelas artesanas Samirarte con té', 'samirarte-boutique' ),
			),
			array(
				'title' => esc_html__( 'Dátiles gourmet', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Dátiles rellenos y vestidos como pequeñas joyas de sobremesa.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'datiles.webp' ),
				'alt'   => esc_attr__( 'Dátiles gourmet Samirarte con frutos secos y té', 'samirarte-boutique' ),
			),
			array(
				'title' => esc_html__( 'Pastas finas', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Bocados delicados para té, regalo y celebraciones especiales.', 'samirarte-boutique' ),
				'image' => samirarte_boutique_image_url( 'pastas_finas.webp' ),
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
