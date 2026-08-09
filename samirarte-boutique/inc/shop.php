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
			<div class="sam-personalized-box__media">
				<img src="<?php echo esc_url( samirarte_boutique_image_url( 'galeria-caja-personalizada.webp' ) ); ?>" alt="<?php echo esc_attr__( 'Caja gourmet personalizada Samirarte', 'samirarte-boutique' ); ?>" loading="lazy">
			</div>
			<div class="sam-personalized-box__copy">
				<p class="sam-eyebrow"><?php echo esc_html__( 'POR ENCARGO', 'samirarte-boutique' ); ?></p>
				<h2 id="sam-personalized-box-title"><?php echo esc_html__( 'Caja gourmet personalizada', 'samirarte-boutique' ); ?></h2>
				<p class="sam-personalized-box__lead"><?php echo esc_html__( 'Elige la imagen, los sabores, la ocasión y los detalles que quieres transmitir. Prepararemos una caja gourmet a medida, cuidada y con historia.', 'samirarte-boutique' ); ?></p>
				<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/#contacto' ) ); ?>"><?php echo esc_html__( 'Solicitar personalización', 'samirarte-boutique' ); ?></a>
			</div>
		</section>

		<?php echo samirarte_boutique_shop_compact_opening_gift_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php
	}
}
