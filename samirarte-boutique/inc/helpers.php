<?php
/**
 * Helper utilities extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_account_url' ) ) {
	function samirarte_boutique_account_url() {
		$account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : '';

		return $account_url ? $account_url : home_url( '/mi-cuenta/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_account_label' ) ) {
	function samirarte_boutique_account_label() {
		return is_user_logged_in()
			? esc_html__( 'Mi cuenta', 'samirarte-boutique' )
			: esc_html__( 'Entrar / Registrarme', 'samirarte-boutique' );
	}
}

if ( ! function_exists( 'samirarte_boutique_cart_url' ) ) {
	function samirarte_boutique_cart_url() {
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '';

		return $cart_url ? $cart_url : home_url( '/carrito/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_cart_count' ) ) {
	function samirarte_boutique_cart_count() {
		return function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
	}
}

if ( ! function_exists( 'samirarte_boutique_boxes_url' ) ) {
	function samirarte_boutique_boxes_url() {
		return home_url( '/cajas-gourmet/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_diary_url' ) ) {
	function samirarte_boutique_diary_url() {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$posts_url     = $posts_page_id ? get_permalink( $posts_page_id ) : '';

		return $posts_url ? $posts_url : home_url( '/diario/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_image_url' ) ) {
	function samirarte_boutique_image_url( $filename ) {
		static $cache = array();
		static $allowed_extensions = array( 'webp', 'png', 'jpg', 'jpeg', 'svg', 'gif' );

		$filename = wp_basename( (string) $filename );
		$ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
		if ( ! in_array( $ext, $allowed_extensions, true ) ) {
			return '';
		}

		if ( array_key_exists( $filename, $cache ) ) {
			return $cache[ $filename ];
		}

		$candidates = array_unique(
			array_filter(
				array(
					$filename,
					sanitize_file_name( $filename ),
				)
			)
		);

		foreach ( $candidates as $candidate ) {
			$file = get_template_directory() . '/assets/img/' . $candidate;

			if ( file_exists( $file ) ) {
				$url            = get_template_directory_uri() . '/assets/img/' . rawurlencode( $candidate ) . '?ver=' . filemtime( $file );
				$cache[ $filename ] = $url;
				return $url;
			}
		}

		$cache[ $filename ] = '';
		return '';
	}
}

if ( ! function_exists( 'samirarte_boutique_video_url' ) ) {
	function samirarte_boutique_video_url( $filename ) {
		static $cache = array();
		static $allowed_extensions = array( 'mp4', 'webm', 'ogv' );

		$filename = wp_basename( (string) $filename );
		$ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
		if ( ! in_array( $ext, $allowed_extensions, true ) ) {
			return '';
		}

		if ( array_key_exists( $filename, $cache ) ) {
			return $cache[ $filename ];
		}

		$candidates = array_unique(
			array_filter(
				array(
					$filename,
					sanitize_file_name( $filename ),
				)
			)
		);

		foreach ( $candidates as $candidate ) {
			$file = get_template_directory() . '/assets/video/' . $candidate;

			if ( file_exists( $file ) ) {
				$url              = get_template_directory_uri() . '/assets/video/' . rawurlencode( $candidate ) . '?ver=' . filemtime( $file );
				$cache[ $filename ] = $url;
				return $url;
			}
		}

		$cache[ $filename ] = '';
		return '';
	}
}
