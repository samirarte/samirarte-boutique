<?php
/**
 * Theme functions for Samirarte Boutique.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

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

		register_nav_menus(
			array(
				'primary_menu' => esc_html__( 'Menú principal', 'samirarte-boutique' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'samirarte_boutique_setup' );

if ( ! function_exists( 'samirarte_boutique_asset_version' ) ) {
	/**
	 * Return filemtime version when the asset exists.
	 *
	 * @param string $relative_path Asset path relative to the theme directory.
	 * @return string
	 */
	function samirarte_boutique_asset_version( $relative_path ) {
		$file = get_template_directory() . $relative_path;

		if ( file_exists( $file ) ) {
			return (string) filemtime( $file );
		}

		return '1.0.0';
	}
}

if ( ! function_exists( 'samirarte_boutique_enqueue_assets' ) ) {
	/**
	 * Enqueue theme assets.
	 */
	function samirarte_boutique_enqueue_assets() {
		wp_enqueue_style(
			'samirarte-boutique-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array(),
			samirarte_boutique_asset_version( '/assets/css/main.css' )
		);

		wp_enqueue_script(
			'samirarte-boutique-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			samirarte_boutique_asset_version( '/assets/js/main.js' ),
			true
		);

		wp_localize_script(
			'samirarte-boutique-main',
			'SamirarteBoutique',
			array(
				'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'samirarte_boutique_enqueue_assets' );

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
	 * Return the WooCommerce shop URL used as the Cajas Gourmet destination.
	 *
	 * @return string
	 */
	function samirarte_boutique_boxes_url() {
		$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '';

		return $shop_url ? $shop_url : home_url( '/cajas-gourmet/' );
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

if ( ! function_exists( 'samirarte_boutique_primary_links' ) ) {
	/**
	 * Return the curated commercial navigation.
	 *
	 * @return array
	 */
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
	/**
	 * Render the fixed public navigation without inheriting obsolete admin links.
	 *
	 * @param string $menu_class CSS class for the list.
	 */
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

if ( ! function_exists( 'samirarte_boutique_seo_data' ) ) {
	/**
	 * Return basic SEO title and description for curated public pages.
	 *
	 * @return array
	 */
	function samirarte_boutique_seo_data() {
		$data = array();

		if ( is_front_page() ) {
			$data = array(
				'title'       => esc_html__( 'Samirarte | Artesanía gourmet, cajas regalo y experiencias privadas', 'samirarte-boutique' ),
				'description' => esc_html__( 'Samirarte crea cajas gourmet, detalles artesanales y experiencias privadas bajo encargo, con presentaciones cuidadas y cuentos personalizados para ocasiones especiales.', 'samirarte-boutique' ),
			);
		} elseif ( is_page( array( 'artesania-gourmet', 'cajas-gourmet' ) ) || ( function_exists( 'is_shop' ) && is_shop() ) ) {
			$data = array(
				'title'       => esc_html__( 'Cajas Gourmet configurables | Samirarte', 'samirarte-boutique' ),
				'description' => esc_html__( 'Configura una caja regalo de 3, 6, 9 o 12 piezas gourmet de autor, presentada como regalo premium y con cuento en pergamino incluido.', 'samirarte-boutique' ),
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
	/**
	 * Customize document title for key pages without touching SEO plugins.
	 *
	 * @param array $parts Title parts.
	 * @return array
	 */
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
	/**
	 * Print a simple meta description when no advanced SEO layer is handled here.
	 */
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

if ( ! function_exists( 'samirarte_boutique_image_url' ) ) {
	/**
	 * Return a theme image URL only if the file exists.
	 *
	 * @param string $filename Image filename inside assets/img.
	 * @return string
	 */
	function samirarte_boutique_image_url( $filename ) {
		$filename   = wp_basename( (string) $filename );
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
				return get_template_directory_uri() . '/assets/img/' . rawurlencode( $candidate ) . '?ver=' . filemtime( $file );
			}
		}

		return '';
	}
}

if ( ! function_exists( 'samirarte_boutique_fallback_menu' ) ) {
	/**
	 * Print a clean fallback menu when no WordPress menu is assigned.
	 */
	function samirarte_boutique_fallback_menu( $args = array() ) {
		$menu_class = 'sam-site-menu';

		if ( is_object( $args ) && ! empty( $args->menu_class ) ) {
			$menu_class = $args->menu_class;
		} elseif ( is_array( $args ) && ! empty( $args['menu_class'] ) ) {
			$menu_class = $args['menu_class'];
		}

		samirarte_boutique_primary_menu( $menu_class );
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_intro' ) ) {
	/**
	 * Present the box configurator concept before the WooCommerce product loop.
	 */
	function samirarte_boutique_shop_intro() {
		if ( ! function_exists( 'is_shop' ) || ! is_shop() ) {
			return;
		}

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
		?>
		<section class="sam-shop-intro" aria-labelledby="sam-shop-intro-title">
			<div class="sam-shop-intro__copy">
				<p class="sam-eyebrow"><?php echo esc_html__( 'CAJAS GOURMET', 'samirarte-boutique' ); ?></p>
				<h1 id="sam-shop-intro-title"><?php echo esc_html__( 'Configura una caja regalo', 'samirarte-boutique' ); ?></h1>
				<p class="sam-shop-intro__lead"><?php echo esc_html__( 'Elige una caja de 3, 6, 9 o 12 piezas y combínala con minipastelas, dátiles gourmet y pastas finas. Cada composición se prepara como una pequeña colección de joyas comestibles e incluye un cuento en pergamino creado para acompañar la experiencia.', 'samirarte-boutique' ); ?></p>
				<ol class="sam-shop-steps">
					<li><span>1</span><strong><?php echo esc_html__( 'Elige el tamaño', 'samirarte-boutique' ); ?></strong></li>
					<li><span>2</span><strong><?php echo esc_html__( 'Selecciona tus piezas', 'samirarte-boutique' ); ?></strong></li>
					<li><span>3</span><strong><?php echo esc_html__( 'Recibe tu cuento', 'samirarte-boutique' ); ?></strong></li>
				</ol>
			</div>

			<div class="sam-box-size-selector" aria-labelledby="sam-box-size-title">
				<div class="sam-box-size-selector__heading">
					<p class="sam-eyebrow"><?php echo esc_html__( 'Primer paso', 'samirarte-boutique' ); ?></p>
					<h2 id="sam-box-size-title"><?php echo esc_html__( 'Elige el tamaño de tu caja', 'samirarte-boutique' ); ?></h2>
				</div>
				<div class="sam-box-size-grid" role="list">
					<a class="sam-box-size-card is-featured" href="#catalogo-piezas" role="listitem"><strong>3</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
					<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>6</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
					<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>9</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
					<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>12</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
				</div>
				<div class="sam-actions">
					<a class="sam-button" href="#caja-gourmet-personalizada"><?php echo esc_html__( 'Personaliza tu caja', 'samirarte-boutique' ); ?></a>
					<a class="sam-button sam-button--ghost" href="#catalogo-piezas"><?php echo esc_html__( 'Ver catálogo de piezas', 'samirarte-boutique' ); ?></a>
				</div>
			</div>
		</section>

		<section id="catalogo-piezas" class="sam-piece-catalog" aria-labelledby="sam-piece-catalog-title">
			<div class="sam-piece-catalog__heading">
				<div>
					<p class="sam-eyebrow"><?php echo esc_html__( 'Catálogo de piezas', 'samirarte-boutique' ); ?></p>
					<h2 id="sam-piece-catalog-title"><?php echo esc_html__( 'Joyas Gourmet', 'samirarte-boutique' ); ?></h2>
				</div>
				<p><?php echo esc_html__( 'Combina sabores, texturas y tamaños para crear una caja pensada para regalar, compartir o guardar como recuerdo.', 'samirarte-boutique' ); ?></p>
			</div>
			<div class="sam-piece-catalog__grid">
				<?php foreach ( $piece_categories as $category ) : ?>
					<article class="sam-piece-category">
						<?php if ( ! empty( $category['image'] ) ) : ?>
							<img src="<?php echo esc_url( $category['image'] ); ?>" alt="<?php echo esc_attr( ! empty( $category['alt'] ) ? $category['alt'] : $category['title'] ); ?>" loading="lazy">
						<?php else : ?>
							<span class="sam-image-placeholder sam-image-placeholder--small" aria-hidden="true"></span>
						<?php endif; ?>
						<div>
							<h3><?php echo esc_html( $category['title'] ); ?></h3>
							<p><?php echo esc_html( $category['text'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<aside class="sam-parchment-feature" aria-label="<?php echo esc_attr__( 'Cuento en pergamino incluido', 'samirarte-boutique' ); ?>">
			<span class="sam-parchment-feature__mark" aria-hidden="true"></span>
			<div>
				<p class="sam-eyebrow"><?php echo esc_html__( 'Relato incluido', 'samirarte-boutique' ); ?></p>
				<h2><?php echo esc_html__( 'Un cuento en pergamino para acompañar la caja', 'samirarte-boutique' ); ?></h2>
				<p><?php echo esc_html__( 'Cada caja puede viajar con un relato breve creado para la persona destinataria, la ocasión o el gesto que quieras transmitir.', 'samirarte-boutique' ); ?></p>
			</div>
		</aside>

		<section id="caja-gourmet-personalizada" class="sam-personalized-box" aria-labelledby="sam-personalized-box-title">
			<div class="sam-personalized-box__copy">
				<p class="sam-eyebrow"><?php echo esc_html__( 'POR ENCARGO', 'samirarte-boutique' ); ?></p>
				<h2 id="sam-personalized-box-title"><?php echo esc_html__( 'Caja gourmet personalizada', 'samirarte-boutique' ); ?></h2>
				<p class="sam-personalized-box__lead"><?php echo esc_html__( 'Crea una caja a medida para una ocasión especial. Cuéntanos qué quieres transmitir, para cuántas personas es, qué sabores prefieres y qué estilo de regalo buscas. Prepararemos una propuesta cuidada, artesanal y con historia.', 'samirarte-boutique' ); ?></p>
			</div>
			<div class="sam-personalized-box__request">
				<p><?php echo esc_html__( 'Cuéntanos brevemente tu solicitud y nosotros te prepararemos una propuesta detallada.', 'samirarte-boutique' ); ?></p>
				<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/#contacto' ) ); ?>"><?php echo esc_html__( 'Personaliza tu caja', 'samirarte-boutique' ); ?></a>
				<?php /* Espacio preparado para insertar un shortcode de formulario si se decide integrarlo aquí. */ ?>
			</div>
		</section>

		<div id="productos" class="sam-shop-products-anchor" aria-hidden="true"></div>
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'samirarte_boutique_shop_intro', 2 );

if ( ! function_exists( 'samirarte_boutique_shop_products_heading' ) ) {
	/**
	 * Print a boutique heading before the WooCommerce product loop.
	 */
	function samirarte_boutique_shop_products_heading() {
		if ( ! function_exists( 'is_shop' ) || ! is_shop() ) {
			return;
		}
		?>
		<div class="sam-shop-products-heading" aria-labelledby="sam-shop-products-title">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Selección disponible', 'samirarte-boutique' ); ?></p>
			<h2 id="sam-shop-products-title"><?php echo esc_html__( 'Cajas disponibles', 'samirarte-boutique' ); ?></h2>
		</div>
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'samirarte_boutique_shop_products_heading', 6 );

if ( ! function_exists( 'samirarte_boutique_shop_page_title' ) ) {
	/**
	 * Replace the generic WooCommerce shop title.
	 *
	 * @param string $title Archive title.
	 * @return string
	 */
	function samirarte_boutique_shop_page_title( $title ) {
		return function_exists( 'is_shop' ) && is_shop()
			? esc_html__( 'Cajas Gourmet', 'samirarte-boutique' )
			: $title;
	}
}
add_filter( 'woocommerce_page_title', 'samirarte_boutique_shop_page_title' );

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

if ( ! function_exists( 'samirarte_boutique_site_icon' ) ) {
	/**
	 * Provide the theme icon when WordPress has no configured site icon.
	 */
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
	/**
	 * Render the WordPress Site Identity logo with theme wrappers.
	 *
	 * @param string $wrapper_class Wrapper class for sizing context.
	 * @return string
	 */
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
	/**
	 * Render the editable Site Identity brand: logo, site title and tagline.
	 *
	 * @param string $wrapper_class Extra class for the branding wrapper.
	 * @return string
	 */
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

if ( ! function_exists( 'samirarte_boutique_opening_gift_markup' ) ) {
	/**
	 * Return the pre-opening registration gift promotion markup.
	 *
	 * @param string $modifier Optional modifier class.
	 * @return string
	 */
	function samirarte_boutique_opening_gift_markup( $modifier = '' ) {
		$classes = 'sam-opening-gift';

		if ( $modifier ) {
			$classes .= ' ' . sanitize_html_class( $modifier );
		}

		ob_start();
		?>
		<section class="<?php echo esc_attr( $classes ); ?>" aria-labelledby="sam-opening-gift-title">
			<span class="sam-opening-gift__seal" aria-hidden="true"></span>
			<div class="sam-opening-gift__content">
				<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'Lista privada de preapertura', 'samirarte-boutique' ); ?></p>
				<h2 id="sam-opening-gift-title" class="sam-opening-gift__title"><?php echo esc_html__( 'Detalle exclusivo de apertura', 'samirarte-boutique' ); ?></h2>
				<p class="sam-opening-gift__banner"><?php echo esc_html__( 'Regístrate antes de la apertura y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
				<div class="sam-opening-gift__text">
					<p><?php echo esc_html__( 'Regístrate como cliente antes de la apertura de Samirarte y formarás parte de nuestra primera lista privada.', 'samirarte-boutique' ); ?></p>
					<p><?php echo esc_html__( 'Cuando la tienda abra, recibirás un detalle exclusivo con tu primer pedido, preparado solo para quienes acompañen el inicio de esta historia.', 'samirarte-boutique' ); ?></p>
					<p><?php echo esc_html__( 'Muy pronto podrás elegir tu caja gourmet, completarla con tus piezas favoritas y descubrir una forma distinta de regalar.', 'samirarte-boutique' ); ?></p>
				</div>
				<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
					<?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?>
				</a>
				<p class="sam-opening-gift__terms"><?php echo esc_html__( 'Promoción válida para clientes registrados antes de la apertura. El regalo se incluirá en el primer pedido realizado tras la apertura, sujeto a disponibilidad.', 'samirarte-boutique' ); ?></p>
			</div>
		</section>
		<?php

		return trim( ob_get_clean() );
	}
}

if ( ! function_exists( 'samirarte_boutique_render_opening_gift' ) ) {
	/**
	 * Print the pre-opening registration gift promotion.
	 *
	 * @param string $modifier Optional modifier class.
	 */
	function samirarte_boutique_render_opening_gift( $modifier = '' ) {
		echo samirarte_boutique_opening_gift_markup( $modifier ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_compact_opening_gift_markup' ) ) {
	/**
	 * Return the compact shop pre-opening registration gift notice.
	 *
	 * @return string
	 */
	function samirarte_boutique_shop_compact_opening_gift_markup() {
		ob_start();
		?>
		<section class="sam-opening-gift sam-opening-gift--shop-compact" aria-label="<?php echo esc_attr__( 'Aviso de preapertura', 'samirarte-boutique' ); ?>">
			<div class="sam-opening-gift__content">
				<p class="sam-opening-gift__eyebrow"><?php echo esc_html__( 'PREAPERTURA', 'samirarte-boutique' ); ?></p>
				<p class="sam-opening-gift__text"><?php echo esc_html__( 'Regístrate antes de la apertura y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
			</div>
			<a class="sam-opening-gift__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>">
				<?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?>
			</a>
		</section>
		<?php

		return trim( ob_get_clean() );
	}
}

if ( ! function_exists( 'samirarte_boutique_shop_opening_gift_notice' ) ) {
	/**
	 * Print the opening gift notice above the public shop loop.
	 */
	function samirarte_boutique_shop_opening_gift_notice() {
		echo samirarte_boutique_shop_compact_opening_gift_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'woocommerce_before_shop_loop', 'samirarte_boutique_shop_opening_gift_notice', 4 );

if ( ! function_exists( 'samirarte_boutique_account_opening_gift_notice' ) ) {
	/**
	 * Print a secondary opening gift notice after the account forms.
	 */
	function samirarte_boutique_account_opening_gift_notice() {
		if ( is_user_logged_in() ) {
			return;
		}
		?>
		<aside class="sam-account-gift" aria-label="<?php echo esc_attr__( 'Regalo de apertura', 'samirarte-boutique' ); ?>">
			<div class="sam-account-gift__message">
				<svg class="sam-account-gift__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 10h16v10H4V10Zm-1-4h18v4H3V6Zm9 0v14M12 6H8.8a2.3 2.3 0 1 1 2.3-2.3L12 6Zm0 0h3.2a2.3 2.3 0 1 0-2.3-2.3L12 6Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<p class="sam-account-gift__text"><?php echo esc_html__( 'Regístrate antes del lanzamiento y recibe un detalle exclusivo con tu primer pedido.', 'samirarte-boutique' ); ?></p>
			</div>
			<a class="sam-button sam-account-gift__cta" href="#registro" data-sam-account-register>
				<?php echo esc_html__( 'Quiero mi regalo', 'samirarte-boutique' ); ?>
			</a>
		</aside>
		<?php
	}
}

if ( ! function_exists( 'samirarte_boutique_google_login_markup' ) ) {
	/**
	 * Return real Google login markup only when a supported provider is present.
	 *
	 * Plugins that render through WooCommerce login hooks keep working because the
	 * form-login override preserves all native hooks. Additional providers can use
	 * the samirarte_google_login_markup filter without adding credentials here.
	 *
	 * @param bool   $already_rendered Whether a WooCommerce hook already printed Nextend.
	 * @param string $label            Visible Nextend button label.
	 * @return string
	 */
	function samirarte_boutique_google_login_markup( $already_rendered = false, $label = '' ) {
		$markup = '';

		if ( is_user_logged_in() || $already_rendered ) {
			return '';
		}

		/*
		 * Prefer Nextend's public shortcode API. The PHP renderer remains a
		 * fallback for installations where the class is loaded but the shortcode
		 * has not been registered yet.
		 */
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

if ( ! function_exists( 'samirarte_boutique_coming_soon_price_html' ) ) {
	/**
	 * Return the public pre-opening price label.
	 *
	 * @return string
	 */
	function samirarte_boutique_coming_soon_price_html() {
		return '<span class="sam-coming-soon-price">' . esc_html__( 'Próximamente', 'samirarte-boutique' ) . '</span>';
	}
}

if ( ! function_exists( 'samirarte_boutique_preopening_price' ) ) {
	/**
	 * Replace public WooCommerce prices during pre-opening.
	 *
	 * @param string $price_html Original price HTML.
	 * @return string
	 */
	function samirarte_boutique_preopening_price( $price_html ) {
		if ( is_admin() && ! wp_doing_ajax() ) {
			return $price_html;
		}

		return samirarte_boutique_coming_soon_price_html();
	}
}
add_filter( 'woocommerce_get_price_html', 'samirarte_boutique_preopening_price', 20 );

if ( ! function_exists( 'samirarte_boutique_preopening_public_price_label' ) ) {
	/**
	 * Replace public cart and checkout price fragments without changing WooCommerce totals.
	 *
	 * @param string $html Original public price fragment.
	 * @return string
	 */
	function samirarte_boutique_preopening_public_price_label( $html ) {
		if ( is_admin() && ! wp_doing_ajax() ) {
			return $html;
		}

		return samirarte_boutique_coming_soon_price_html();
	}
}
add_filter( 'woocommerce_cart_item_price', 'samirarte_boutique_preopening_public_price_label', 20 );
add_filter( 'woocommerce_cart_item_subtotal', 'samirarte_boutique_preopening_public_price_label', 20 );
add_filter( 'woocommerce_cart_subtotal', 'samirarte_boutique_preopening_public_price_label', 20 );
add_filter( 'woocommerce_cart_totals_order_total_html', 'samirarte_boutique_preopening_public_price_label', 20 );

if ( ! function_exists( 'samirarte_boutique_preopening_loop_cta' ) ) {
	/**
	 * Replace public loop add-to-cart actions with an information CTA.
	 *
	 * @param string     $link    Original add-to-cart link.
	 * @param WC_Product $product Product object.
	 * @return string
	 */
	function samirarte_boutique_preopening_loop_cta( $link, $product ) {
		if ( is_admin() && ! wp_doing_ajax() ) {
			return $link;
		}

		$product_name = is_object( $product ) && method_exists( $product, 'get_name' ) ? $product->get_name() : '';

		return sprintf(
			'<a class="button sam-preopening-product-cta" href="%1$s" aria-label="%2$s">%3$s</a>',
			esc_url( home_url( '/contacto/' ) ),
			esc_attr( sprintf( __( 'Solicitar información sobre %s', 'samirarte-boutique' ), $product_name ) ),
			esc_html__( 'Solicitar información', 'samirarte-boutique' )
		);
	}
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'samirarte_boutique_preopening_loop_cta', 20, 2 );

if ( ! function_exists( 'samirarte_boutique_preopening_add_to_cart_text' ) ) {
	/**
	 * Keep WooCommerce button wording aligned with pre-opening mode.
	 *
	 * @return string
	 */
	function samirarte_boutique_preopening_add_to_cart_text() {
		return esc_html__( 'Solicitar información', 'samirarte-boutique' );
	}
}
add_filter( 'woocommerce_product_add_to_cart_text', 'samirarte_boutique_preopening_add_to_cart_text', 20 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'samirarte_boutique_preopening_add_to_cart_text', 20 );

if ( ! function_exists( 'samirarte_boutique_preopening_is_purchasable' ) ) {
	/**
	 * Prevent direct public purchases while preserving cart and checkout internals.
	 *
	 * @param bool $is_purchasable Current purchasable state.
	 * @return bool
	 */
	function samirarte_boutique_preopening_is_purchasable( $is_purchasable ) {
		if ( is_admin() && ! wp_doing_ajax() ) {
			return $is_purchasable;
		}

		return false;
	}
}
add_filter( 'woocommerce_is_purchasable', 'samirarte_boutique_preopening_is_purchasable', 20 );

if ( ! function_exists( 'samirarte_boutique_preopening_single_cta' ) ) {
	/**
	 * Add a public product information CTA when direct purchase is disabled.
	 */
	function samirarte_boutique_preopening_single_cta() {
		if ( ! function_exists( 'is_product' ) || ! is_product() ) {
			return;
		}

		echo '<div class="sam-preopening-product-note">';
		echo '<p>' . esc_html__( 'Esta pieza forma parte del catálogo de preapertura. Las cajas se prepararán bajo encargo y los precios se anunciarán próximamente.', 'samirarte-boutique' ) . '</p>';
		echo '<a class="button sam-preopening-product-cta" href="' . esc_url( home_url( '/contacto/' ) ) . '">' . esc_html__( 'Solicitar información', 'samirarte-boutique' ) . '</a>';
		echo '</div>';
	}
}
add_action( 'woocommerce_single_product_summary', 'samirarte_boutique_preopening_single_cta', 31 );

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
