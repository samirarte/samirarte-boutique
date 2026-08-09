<?php
/**
 * Branding and logo helpers extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_site_icon' ) ) {
	function samirarte_boutique_site_icon() {
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			return;
		}

		$custom_logo_id = (int) get_theme_mod( 'custom_logo' );
		$icon_url       = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';

		if ( ! $icon_url ) {
			$icon_url = samirarte_boutique_image_url( 'logo_3.png' );
		}

		if ( ! $icon_url ) {
			return;
		}

		printf( '<link rel="icon" href="%s" sizes="any">' . "\n", esc_url( $icon_url ) );
		printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $icon_url ) );
	}
}
add_action( 'wp_head', 'samirarte_boutique_site_icon', 3 );

if ( ! function_exists( 'samirarte_boutique_logo_markup' ) ) {
	function samirarte_boutique_logo_markup( $wrapper_class ) {
		$wrapper_class  = sanitize_html_class( $wrapper_class );
		$logo_markup    = '';

		if ( function_exists( 'the_custom_logo' ) ) {
			ob_start();
			the_custom_logo();
			$logo_markup = trim( ob_get_clean() );
		}

		if ( $logo_markup && $wrapper_class ) {
			$logo_markup = str_replace( 'class="custom-logo-link', 'class="custom-logo-link ' . esc_attr( $wrapper_class ), $logo_markup );
		}

		if ( ! $logo_markup ) {
			$fallback_logo = samirarte_boutique_image_url( 'logo_3.png' );

			if ( $fallback_logo ) {
				$logo_markup = sprintf(
					'<a class="custom-logo-link %1$s" href="%2$s" rel="home" aria-label="%3$s"><img class="custom-logo" src="%4$s" alt="%5$s" decoding="async"></a>',
					esc_attr( $wrapper_class ),
					esc_url( home_url( '/' ) ),
					esc_attr__( 'Ir al inicio de Samirarte', 'samirarte-boutique' ),
					esc_url( $fallback_logo ),
					esc_attr( get_bloginfo( 'name' ) )
				);
			}
		}

		if ( ! $logo_markup ) {
			return '';
		}

		return $logo_markup;
	}
}

if ( ! function_exists( 'samirarte_boutique_site_branding_markup' ) ) {
	function samirarte_boutique_site_branding_markup( $wrapper_class ) {
		$wrapper_class = sanitize_html_class( $wrapper_class );
		$description   = get_bloginfo( 'description', 'display' );
		$logo_markup   = samirarte_boutique_logo_markup( 'site-logo-link' );

		ob_start();
		?>
		<div class="site-branding site-branding-compact <?php echo esc_attr( $wrapper_class ); ?>">
			<?php echo $logo_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<div class="site-branding-text">
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>

				<?php if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php

		return trim( ob_get_clean() );
	}
}
