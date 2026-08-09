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

// Opening gift and related small templates are handled via template-parts so that
// markup is easy to override. The functions below provide the public API and
// include the corresponding template parts.

if ( ! function_exists( 'samirarte_boutique_opening_gift_markup' ) ) {
	function samirarte_boutique_opening_gift_markup( $modifier = '' ) {
		$template = locate_template( 'template-parts/shop/opening-gift.php' );
		if ( ! $template ) {
			return '';
		}

		$modifier = (string) $modifier;
		ob_start();
		include $template; // template expects $modifier in scope
		return trim( ob_get_clean() );
	}
}

if ( ! function_exists( 'samirarte_boutique_render_opening_gift' ) ) {
	function samirarte_boutique_render_opening_gift( $modifier = '' ) {
		echo samirarte_boutique_opening_gift_markup( $modifier ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_compact_opening_gift_markup' ) ) {
	function samirarte_boutique_shop_compact_opening_gift_markup() {
		$template = locate_template( 'template-parts/shop/opening-gift-compact.php' );
		if ( ! $template ) {
			return '';
		}

		ob_start();
		include $template;
		return trim( ob_get_clean() );
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_opening_gift_notice' ) ) {
	function samirarte_boutique_shop_opening_gift_notice() {
		echo samirarte_boutique_shop_compact_opening_gift_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'samirarte_boutique_account_opening_gift_notice' ) ) {
	function samirarte_boutique_account_opening_gift_notice() {
		if ( is_user_logged_in() ) {
			return;
		}

		$template = locate_template( 'template-parts/shop/account-opening-gift.php' );
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
