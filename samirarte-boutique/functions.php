<?php
/**
 * Theme functions for Samirarte Boutique.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

// Load modularized theme functions extracted into inc/
// These are loaded early so the original guarded definitions in
// functions.php are skipped in favor of the modular files when present.
require_once get_template_directory() . '/inc/assets.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/menus.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/branding.php';
require_once get_template_directory() . '/inc/shop.php';
require_once get_template_directory() . '/inc/portfolio.php';

if ( ! function_exists( 'samirarte_boutique_setup' ) ) {
	/**
	 * Register theme supports and menus.
	 */
	function samirarte_boutique_setup() {
		load_theme_textdomain( 'samirarte-boutique', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 220,
				'width'       => 420,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Menú principal', 'samirarte-boutique' ),
				'footer'  => esc_html__( 'Footer menu', 'samirarte-boutique' ),
				'primary_menu' => esc_html__( 'Menú principal (legacy)', 'samirarte-boutique' ),
			)
		);

			// Register footer widget areas (three columns) so editors can manage footer content from WP admin.
			register_sidebar( array(
				'name'          => esc_html__( 'Footer column 1', 'samirarte-boutique' ),
				'id'            => 'footer-1',
				'before_widget' => '<div class="footer-widget footer-widget-1">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer column 2', 'samirarte-boutique' ),
				'id'            => 'footer-2',
				'before_widget' => '<div class="footer-widget footer-widget-2">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer column 3', 'samirarte-boutique' ),
				'id'            => 'footer-3',
				'before_widget' => '<div class="footer-widget footer-widget-3">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			) );
	}
}
add_action( 'after_setup_theme', 'samirarte_boutique_setup' );

if ( ! function_exists( 'samirarte_boutique_account_url' ) ) {
	/**
	 * Return the configured WooCommerce account URL with a safe fallback.
	 *
	 * @return string
	 */
	function samirarte_boutique_account_url() {
		$account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : '';

		return $account_url ? $account_url : home_url( '/mi-cuenta/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_account_label' ) ) {
	/**
	 * Return the account call-to-action for the current visitor.
	 *
	 * @return string
	 */
	function samirarte_boutique_account_label() {
		return is_user_logged_in()
			? esc_html__( 'Mi cuenta', 'samirarte-boutique' )
			: esc_html__( 'Entrar / Registrarme', 'samirarte-boutique' );
	}
}

if ( ! function_exists( 'samirarte_boutique_cart_url' ) ) {
	/**
	 * Return the WooCommerce cart URL with a safe fallback.
	 *
	 * @return string
	 */
	function samirarte_boutique_cart_url() {
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '';

		return $cart_url ? $cart_url : home_url( '/carrito/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_cart_count' ) ) {
	/**
	 * Return the current cart count without requiring WooCommerce.
	 *
	 * @return int
	 */
	function samirarte_boutique_cart_count() {
		return function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
	}
}

if ( ! function_exists( 'samirarte_boutique_boxes_url' ) ) {
	/**
	 * Return the commercial Cajas Gourmet landing URL.
	 *
	 * @return string
	 */
	function samirarte_boutique_boxes_url() {
		return home_url( '/cajas-gourmet/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_url' ) ) {
	/**
	 * Return the WooCommerce shop URL with a stable fallback.
	 *
	 * @return string
	 */
	function samirarte_boutique_shop_url() {
		$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '';

		return $shop_url ? $shop_url : home_url( '/tienda/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_diary_url' ) ) {
	/**
	 * Return the WordPress posts page URL with a stable fallback.
	 *
	 * @return string
	 */
	function samirarte_boutique_diary_url() {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$posts_url     = $posts_page_id ? get_permalink( $posts_page_id ) : '';

		return $posts_url ? $posts_url : home_url( '/diario/' );
	}
}

if ( ! function_exists( 'samirarte_boutique_get_update_badge_context' ) ) {
	/**
	 * Resolve the content context used by the public update badge.
	 *
	 * @return array
	 */
	function samirarte_boutique_get_update_badge_context() {
		$context = array(
			'type'      => esc_html__( 'archivo', 'samirarte-boutique' ),
			'slug'      => sanitize_title( wp_get_document_title() ),
			'id'        => 0,
			'timestamp' => current_time( 'timestamp' ),
		);

		if ( is_front_page() ) {
			$front_page_id = (int) get_option( 'page_on_front' );

			if ( $front_page_id ) {
				$front_page = get_post( $front_page_id );

				if ( $front_page instanceof WP_Post ) {
					$context['type']      = esc_html__( 'página', 'samirarte-boutique' );
					$context['slug']      = $front_page->post_name ? $front_page->post_name : 'inicio';
					$context['id']        = $front_page_id;
					$context['timestamp'] = get_post_modified_time( 'U', true, $front_page );
					return $context;
				}
			}
		}

		if ( function_exists( 'is_shop' ) && is_shop() && function_exists( 'wc_get_page_id' ) ) {
			$shop_id = (int) wc_get_page_id( 'shop' );

			if ( $shop_id > 0 ) {
				$context['type']      = esc_html__( 'tienda', 'samirarte-boutique' );
				$context['slug']      = 'tienda';
				$context['id']        = $shop_id;
				$context['timestamp'] = get_post_modified_time( 'U', true, $shop_id );
				return $context;
			}
		}

		if ( function_exists( 'is_cart' ) && is_cart() && function_exists( 'wc_get_page_id' ) ) {
			$cart_id = (int) wc_get_page_id( 'cart' );

			if ( $cart_id > 0 ) {
				$context['type']      = esc_html__( 'cesta', 'samirarte-boutique' );
				$context['slug']      = get_post_field( 'post_name', $cart_id );
				$context['id']        = $cart_id;
				$context['timestamp'] = get_post_modified_time( 'U', true, $cart_id );
				return $context;
			}
		}

		if ( function_exists( 'is_checkout' ) && is_checkout() && function_exists( 'wc_get_page_id' ) ) {
			$checkout_id = (int) wc_get_page_id( 'checkout' );

			if ( $checkout_id > 0 ) {
				$context['type']      = esc_html__( 'checkout', 'samirarte-boutique' );
				$context['slug']      = get_post_field( 'post_name', $checkout_id );
				$context['id']        = $checkout_id;
				$context['timestamp'] = get_post_modified_time( 'U', true, $checkout_id );
				return $context;
			}
		}

		if ( function_exists( 'is_account_page' ) && is_account_page() && function_exists( 'wc_get_page_id' ) ) {
			$account_id = (int) wc_get_page_id( 'myaccount' );

			if ( $account_id > 0 ) {
				$context['type']      = esc_html__( 'área cliente', 'samirarte-boutique' );
				$context['slug']      = get_post_field( 'post_name', $account_id );
				$context['id']        = $account_id;
				$context['timestamp'] = get_post_modified_time( 'U', true, $account_id );
				return $context;
			}
		}

		if ( is_singular() ) {
			$post = get_queried_object();

			if ( $post instanceof WP_Post ) {
				$post_type = get_post_type( $post );

				$context['type']      = 'product' === $post_type ? esc_html__( 'producto', 'samirarte-boutique' ) : esc_html( $post_type );
				$context['slug']      = $post->post_name;
				$context['id']        = (int) $post->ID;
				$context['timestamp'] = get_post_modified_time( 'U', true, $post );
			}
		}

		return $context;
	}
}

if ( ! function_exists( 'samirarte_render_update_badge' ) ) {
	/**
	 * Render a public update-control badge for deployment and cache checks.
	 */
	function samirarte_render_update_badge() {
		$show_badge = defined( 'SAMIRARTE_SHOW_UPDATE_BADGE' ) && true === SAMIRARTE_SHOW_UPDATE_BADGE;
		$show_badge = (bool) apply_filters( 'samirarte_show_update_badge', $show_badge );

		if ( ! $show_badge ) {
			return;
		}

		$context     = samirarte_boutique_get_update_badge_context();
		$environment = defined( 'SAMIRARTE_UPDATE_BADGE_ENV' ) ? SAMIRARTE_UPDATE_BADGE_ENV : 'DEV';
		$date        = ! empty( $context['timestamp'] ) ? wp_date( 'd/m/Y H:i:s', (int) $context['timestamp'] ) : esc_html__( 'sin fecha', 'samirarte-boutique' );
		$content     = trim( $context['type'] . ': ' . $context['slug'] );

		if ( ! empty( $context['id'] ) ) {
			$content .= ' #' . (int) $context['id'];
		}
		?>
		<div class="samirarte-update-badge" aria-hidden="true">
			<strong><?php echo esc_html( $environment ); ?></strong><br>
			<?php echo esc_html__( 'Samirarte Boutique', 'samirarte-boutique' ); ?><br>
			<?php echo esc_html( $content ); ?><br>
			<?php echo esc_html__( 'Actualizado:', 'samirarte-boutique' ); ?> <?php echo esc_html( $date ); ?>
		</div>
		<?php
	}
}
add_action( 'wp_footer', 'samirarte_render_update_badge' );

if ( ! function_exists( 'samirarte_boutique_preload_hero_image' ) ) {
	/**
	 * Preload the home hero background image because it is above the fold.
	 */
	function samirarte_boutique_preload_hero_image() {
		if ( ! is_front_page() ) {
			return;
		}

		$hero_url = samirarte_boutique_image_url( 'hero.webp' );

		if ( ! $hero_url ) {
			return;
		}

		printf(
			'<link rel="preload" as="image" href="%s" fetchpriority="high">' . "\n",
			esc_url( $hero_url )
		);
	}
}
add_action( 'wp_head', 'samirarte_boutique_preload_hero_image', 1 );

if ( ! function_exists( 'samirarte_boutique_ui_text_replacements' ) ) {
	/**
	 * Keep WooCommerce-facing labels aligned with Samirarte wording.
	 *
	 * @param string $translated_text Translated text.
	 * @param string $text Original text.
	 * @return string
	 */
	function samirarte_boutique_ui_text_replacements( $translated_text, $text ) {
		$replacements = array(
			'Carrito'        => 'Cesta',
			'Ver carrito'    => 'Ver cesta',
			'Mi cuenta'      => 'Área cliente',
			'Acceso cliente' => 'Área cliente',
		);

		return isset( $replacements[ $text ] ) ? $replacements[ $text ] : $translated_text;
	}
}
add_filter( 'gettext', 'samirarte_boutique_ui_text_replacements', 20, 2 );

// Google login helpers moved to inc/shop.php; keep functions.php lean.
// WooCommerce now shows the prices and purchase actions configured on each product.

if ( ! function_exists( 'samirarte_boutique_checkout_account_note' ) ) {
	/**
	 * Add a soft account note before checkout without altering checkout logic.
	 */
	function samirarte_boutique_checkout_account_note() {
		if ( is_user_logged_in() ) {
			return;
		}

		echo '<div class="sam-checkout-account-note">';
		echo esc_html__( 'Para cuidar cada encargo y hacer seguimiento de tu propuesta, los pedidos se gestionan desde el área cliente.', 'samirarte-boutique' );
		echo '</div>';
	}
}
add_action( 'woocommerce_before_checkout_form', 'samirarte_boutique_checkout_account_note', 4 );

if ( ! function_exists( 'samirarte_optimize_hero_lcp_image' ) ) {
	/**
	 * Optimize the above-the-fold hero image for LCP.
	 *
	 * @param array        $attr       Image attributes.
	 * @param WP_Post      $attachment Attachment post object.
	 * @param string|array $size       Requested image size.
	 * @return array
	 */
	function samirarte_optimize_hero_lcp_image( $attr, $attachment, $size ) {
		if ( empty( $attr['src'] ) ) {
			return $attr;
		}

		$src = (string) $attr['src'];

		if ( false === strpos( $src, 'imagen_hero_gourmet' ) && false === strpos( $src, 'hero-samirarte' ) ) {
			return $attr;
		}

		unset( $attr['loading'] );

		$attr['fetchpriority'] = 'high';
		$attr['decoding']      = 'async';

		return $attr;
	}
}
add_filter( 'wp_get_attachment_image_attributes', 'samirarte_optimize_hero_lcp_image', 10, 3 );
