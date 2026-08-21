<?php
/**
 * Front page template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();

// If a static page is set as the front page and it contains blocks or content,
// render its content so editors can fully manage the front page from WP admin.
$front_id = (int) get_option( 'page_on_front' );
if ( $front_id ) {
	$front = get_post( $front_id );
	if ( $front && ( has_blocks( $front->ID ) || trim( $front->post_content ) !== '' ) ) {
		// Render the front page content (allows Gutenberg blocks / editable content)
		setup_postdata( $front );
		?>
		<main class="sam-page-content">
			<?php echo apply_filters( 'the_content', $front->post_content ); ?>
		</main>
		<?php
		wp_reset_postdata();
		get_footer();
		return;
	}
}

$box_image        = samirarte_boutique_image_url( 'caja-gourmet-samirarte.webp' );
$dates_image      = samirarte_boutique_image_url( 'datiles.webp' );
$pastries_image   = samirarte_boutique_image_url( 'pastas_finas.webp' );
$story_image      = samirarte_boutique_image_url( 'cuento-pergamino-samirarte.webp' );
$experience_image = samirarte_boutique_image_url( 'experiencia-privada-samirarte.webp' );
$table_image      = samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' );
$contact_image    = samirarte_boutique_image_url( 'contacto-propuesta-samirarte.webp' );
$opening_video    = samirarte_boutique_video_url( 'intro-samirarte-apertura.mp4' );
$custom_box_url   = samirarte_boutique_boxes_url() . '#catalogo-piezas';
$proposal_url     = samirarte_boutique_boxes_url() . '#pedido-complejo';
$shop_price_label = esc_html__( 'Precio en tienda', 'samirarte-boutique' );
$featured_products = array(
	array(
		'title' => esc_html__( 'Caja Gourmet 3 piezas', 'samirarte-boutique' ),
		'price' => $shop_price_label,
		'text'  => esc_html__( 'Un detalle pequeño y precioso para abrir boca con tus piezas favoritas.', 'samirarte-boutique' ),
		'image' => samirarte_boutique_image_url( 'caja_3.png' ),
		'url'   => $custom_box_url,
	),
	array(
		'title' => esc_html__( 'Caja Gourmet 6 piezas', 'samirarte-boutique' ),
		'price' => $shop_price_label,
		'text'  => esc_html__( 'La combinación equilibrada para regalar, compartir o acompañar un té.', 'samirarte-boutique' ),
		'image' => samirarte_boutique_image_url( 'caja_6.png' ),
		'url'   => $custom_box_url,
	),
	array(
		'title' => esc_html__( 'Caja Gourmet 9 piezas', 'samirarte-boutique' ),
		'price' => $shop_price_label,
		'text'  => esc_html__( 'Una colección generosa para descubrir distintas texturas y sabores.', 'samirarte-boutique' ),
		'image' => samirarte_boutique_image_url( 'caja_9.png' ),
		'url'   => $custom_box_url,
	),
	array(
		'title' => esc_html__( 'Caja Gourmet 12 piezas', 'samirarte-boutique' ),
		'price' => $shop_price_label,
		'text'  => esc_html__( 'La composición completa para celebraciones, empresas y regalos especiales.', 'samirarte-boutique' ),
		'image' => samirarte_boutique_image_url( 'caja_12.png' ),
		'url'   => $custom_box_url,
	),
);
?>

<section class="sam-opening-intro is-hidden" data-theme-url="<?php echo esc_url( get_template_directory_uri() ); ?>" aria-label="<?php echo esc_attr__( 'Vídeo introductorio de Samirarte', 'samirarte-boutique' ); ?>">
	<?php if ( $opening_video ) : ?>
	<div class="sam-opening-intro__frame">
		<div class="sam-opening-intro__backdrop" aria-hidden="true">
			<video muted playsinline preload="auto">
				<source src="<?php echo esc_url( $opening_video ); ?>" type="video/mp4">
			</video>
		</div>
		<div class="sam-opening-intro__stage">
			<video class="sam-opening-intro__video sam-opening-intro__video--a is-active" muted playsinline preload="auto" title="<?php echo esc_attr__( 'Vídeo introductorio de Samirarte', 'samirarte-boutique' ); ?>">
				<source src="<?php echo esc_url( $opening_video ); ?>" type="video/mp4">
			</video>
			<video class="sam-opening-intro__video sam-opening-intro__video--b" muted playsinline preload="auto" title="<?php echo esc_attr__( 'Vídeo introductorio de Samirarte', 'samirarte-boutique' ); ?>">
				<source src="<?php echo esc_url( $opening_video ); ?>" type="video/mp4">
			</video>
		</div>
		<button class="sam-opening-intro__sound" type="button" aria-pressed="false" aria-label="<?php echo esc_attr__( 'Activar sonido del vídeo', 'samirarte-boutique' ); ?>">
			<?php echo esc_html__( 'Activar sonido', 'samirarte-boutique' ); ?>
		</button>
	</div>
	<?php endif; ?>
</section>

<div class="sam-opening-gift-modal is-hidden" role="dialog" aria-modal="true" aria-labelledby="sam-opening-gift-title" aria-describedby="sam-opening-gift-desc" hidden>
	<div class="sam-opening-gift-modal__backdrop" data-sam-gift-modal-close></div>
	<div class="sam-opening-gift-modal__card" role="document">
		<button class="sam-opening-gift-modal__close" type="button" aria-label="<?php echo esc_attr__( 'Cerrar promoción', 'samirarte-boutique' ); ?>" data-sam-gift-modal-close>
			<span aria-hidden="true">&times;</span>
		</button>
		<span class="sam-opening-gift-modal__seal" aria-hidden="true"></span>
		<p class="sam-opening-gift-modal__eyebrow"><?php echo esc_html__( 'ÁREA CLIENTE', 'samirarte-boutique' ); ?></p>
		<h2 id="sam-opening-gift-title" class="sam-opening-gift-modal__title" tabindex="-1"><?php echo esc_html__( 'Pedidos y propuestas en un solo lugar', 'samirarte-boutique' ); ?></h2>
		<p id="sam-opening-gift-desc" class="sam-opening-gift-modal__text"><?php echo esc_html__( 'Crea tu cuenta para consultar pedidos, guardar tus datos y hacer seguimiento de encargos o propuestas personalizadas.', 'samirarte-boutique' ); ?></p>
		<p class="sam-opening-gift-modal__subtext"><?php echo esc_html__( 'Una forma más cómoda de repetir cajas, revisar detalles y preparar nuevos encargos.', 'samirarte-boutique' ); ?></p>
		<div class="sam-opening-gift-modal__actions">
			<a class="sam-opening-gift-modal__cta" href="<?php echo esc_url( samirarte_boutique_account_url() ); ?>"><?php echo esc_html__( 'Crear cuenta', 'samirarte-boutique' ); ?></a>
			<button class="sam-opening-gift-modal__secondary" type="button" data-sam-gift-modal-close><?php echo esc_html__( 'Ahora no', 'samirarte-boutique' ); ?></button>
		</div>
		<p class="sam-opening-gift-modal__legal"><?php echo esc_html__( 'Los pedidos complejos se confirman siempre después de revisar disponibilidad, alcance, tiempos y propuesta final.', 'samirarte-boutique' ); ?></p>
	</div>
</div>

<section id="sam-main-hero" class="sam-hero sam-section">
	<div class="sam-container sam-hero__grid">
		<div class="sam-hero__content">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Boutique gourmet artesanal', 'samirarte-boutique' ); ?></p>
			<h1><?php echo esc_html__( 'Sabores que cuentan historias. Detalles que dejan huella.', 'samirarte-boutique' ); ?></h1>
			<p class="sam-hero__text"><?php echo esc_html__( 'Cajas gourmet definidas con precio visible en tienda, encargos realizados que puedes repetir y propuestas a medida para pedidos complejos.', 'samirarte-boutique' ); ?></p>
			<div class="sam-actions">
				<a class="sam-button" href="<?php echo esc_url( $custom_box_url ); ?>"><?php echo esc_html__( 'Ver cajas con precio', 'samirarte-boutique' ); ?></a>
				<a class="sam-button sam-button--ghost" href="<?php echo esc_url( $proposal_url ); ?>"><?php echo esc_html__( 'Pedido complejo', 'samirarte-boutique' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="sam-featured-carousel-section sam-box-builder" aria-labelledby="sam-featured-carousel-title">
	<div class="sam-container sam-featured-carousel-heading">
		<h2 id="sam-featured-carousel-title"><?php echo esc_html__( 'Elige tu caja', 'samirarte-boutique' ); ?></h2>
		<p><?php echo esc_html__( 'Formatos cerrados para compra directa y encargos ya realizados que pueden repetirse con precio visible desde WooCommerce.', 'samirarte-boutique' ); ?></p>
	</div>
	<div class="sam-featured-carousel sam-box-builder__formats" tabindex="0" aria-label="<?php echo esc_attr__( 'Cajas Gourmet Samirarte', 'samirarte-boutique' ); ?>">
		<?php foreach ( $featured_products as $product ) : ?>
			<a class="sam-featured-card" href="<?php echo esc_url( $product['url'] ); ?>" aria-label="<?php echo esc_attr( $product['title'] ); ?>">
				<span class="sam-featured-card__image">
					<?php if ( $product['image'] ) : ?>
						<img src="<?php echo esc_url( $product['image'] ); ?>" alt="<?php echo esc_attr( $product['title'] ); ?>" loading="lazy">
					<?php else : ?>
						<span class="sam-image-placeholder sam-image-placeholder--small" aria-hidden="true"></span>
					<?php endif; ?>
				</span>
				<span class="sam-featured-card__body">
					<strong><?php echo esc_html( $product['title'] ); ?></strong>
					<span class="sam-coming-soon-price"><?php echo esc_html( $product['price'] ); ?></span>
					<span class="sam-featured-card__description"><?php echo esc_html( $product['text'] ); ?></span>
					<em><?php echo esc_html__( 'Ver en tienda', 'samirarte-boutique' ); ?></em>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
	<div class="sam-container sam-box-builder__summary" aria-hidden="true">
		<span class="sam-box-builder__count">0</span>
	</div>
</section>

<section class="sam-values" aria-labelledby="sam-values-title">
	<div class="sam-container">
		<div class="sam-section-heading sam-section-heading--light">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Selección gourmet Samirarte', 'samirarte-boutique' ); ?></p>
			<h2 id="sam-values-title"><?php echo esc_html__( 'Detalles pensados para regalar con intención', 'samirarte-boutique' ); ?></h2>
		</div>
		<div class="sam-values__grid">
			<article class="sam-value-card">
				<span class="sam-mini-icon sam-mini-icon--box" aria-hidden="true"></span>
				<h3><?php echo esc_html__( 'Compra clara', 'samirarte-boutique' ); ?></h3>
				<p><?php echo esc_html__( 'Las cajas definidas muestran precio, descripción y disponibilidad antes de pedir.', 'samirarte-boutique' ); ?></p>
			</article>
			<article class="sam-value-card">
				<span class="sam-mini-icon sam-mini-icon--ribbon" aria-hidden="true"></span>
				<h3><?php echo esc_html__( 'Presentación cuidada', 'samirarte-boutique' ); ?></h3>
				<p><?php echo esc_html__( 'Cajas, acabados y detalles pensados para regalar con intención.', 'samirarte-boutique' ); ?></p>
			</article>
			<article class="sam-value-card">
				<span class="sam-mini-icon sam-mini-icon--scroll" aria-hidden="true"></span>
				<h3><?php echo esc_html__( 'Relato personalizado', 'samirarte-boutique' ); ?></h3>
				<p><?php echo esc_html__( 'Algunas creaciones pueden incorporar un cuento breve vinculado a la persona destinataria.', 'samirarte-boutique' ); ?></p>
			</article>
			<article class="sam-value-card">
				<span class="sam-mini-icon sam-mini-icon--table" aria-hidden="true"></span>
				<h3><?php echo esc_html__( 'Experiencias privadas', 'samirarte-boutique' ); ?></h3>
				<p><?php echo esc_html__( 'Propuestas gastronómicas íntimas para hogares, celebraciones y encuentros especiales.', 'samirarte-boutique' ); ?></p>
			</article>
		</div>
	</div>
</section>

<section class="sam-section">
	<div class="sam-container">
		<div class="sam-section-heading">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Nuestra selección boutique', 'samirarte-boutique' ); ?></p>
			<h2><?php echo esc_html__( 'Un catálogo cuidado para regalar, compartir y convertir una ocasión en recuerdo.', 'samirarte-boutique' ); ?></h2>
		</div>
		<div class="sam-selection-grid">
			<?php
			$cards = array(
				array(
					'title' => esc_html__( 'Dátiles gourmet', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Dátiles seleccionados y presentados como pequeños bocados de celebración, ideales para regalos, mesas dulces y pausas compartidas.', 'samirarte-boutique' ),
					'image' => $dates_image,
				),
				array(
					'title' => esc_html__( 'Pastas finas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Pastas delicadas de inspiración artesanal, pensadas para acompañar el té, cerrar una comida o vestir una mesa especial.', 'samirarte-boutique' ),
					'image' => $pastries_image,
				),
				array(
					'title' => esc_html__( 'Cajas regalo', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Cajas cerradas con precio visible y opciones especiales bajo propuesta cuando el encargo necesita más diseño.', 'samirarte-boutique' ),
					'image' => $box_image,
				),
			);

			foreach ( $cards as $card ) :
				?>
				<a class="sam-product-card" href="<?php echo esc_url( $custom_box_url ); ?>">
					<span class="sam-product-card__image">
						<?php if ( $card['image'] ) : ?>
							<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy">
						<?php else : ?>
							<span class="sam-image-placeholder sam-image-placeholder--small"></span>
						<?php endif; ?>
					</span>
					<span class="sam-product-card__body">
						<strong><?php echo esc_html( $card['title'] ); ?></strong>
						<span><?php echo esc_html( $card['text'] ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sam-section sam-atelier">
	<div class="sam-container sam-editorial-split">
		<div class="sam-editorial-split__media">
			<?php if ( $experience_image ) : ?>
				<img src="<?php echo esc_url( $experience_image ); ?>" alt="<?php echo esc_attr__( 'Experiencia privada Samirarte', 'samirarte-boutique' ); ?>" loading="lazy">
			<?php elseif ( $table_image ) : ?>
				<img src="<?php echo esc_url( $table_image ); ?>" alt="<?php echo esc_attr__( 'Mesa gourmet Samirarte', 'samirarte-boutique' ); ?>" loading="lazy">
			<?php else : ?>
				<div class="sam-image-placeholder"></div>
			<?php endif; ?>
		</div>
		<div class="sam-editorial-split__content">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Experiencia privada Samirarte', 'samirarte-boutique' ); ?></p>
			<h2><?php echo esc_html__( 'Atelier', 'samirarte-boutique' ); ?></h2>
			<p><?php echo esc_html__( 'Un espacio de creación para pedidos complejos: cajas corporativas, muchas unidades, mesas dulces o experiencias privadas que necesitan propuesta antes de confirmar precio y alcance.', 'samirarte-boutique' ); ?></p>
			<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php echo esc_html__( 'Diseñar una experiencia', 'samirarte-boutique' ); ?></a>
		</div>
	</div>
</section>

<section class="sam-section">
	<div class="sam-container sam-editorial-split sam-editorial-split--reverse">
		<div class="sam-editorial-split__media">
			<?php if ( $story_image ) : ?>
				<img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr__( 'Cuento personalizado en pergamino', 'samirarte-boutique' ); ?>" loading="lazy">
			<?php else : ?>
				<div class="sam-image-placeholder"></div>
			<?php endif; ?>
		</div>
		<div class="sam-editorial-split__content">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Cuento personalizado en pergamino', 'samirarte-boutique' ); ?></p>
			<h2><?php echo esc_html__( 'Cuentos en pergamino', 'samirarte-boutique' ); ?></h2>
			<p><?php echo esc_html__( 'Cada caja puede incluir un pequeño cuento impreso en pergamino: una historia breve inspirada en la ocasión, la persona destinataria o el sentido del regalo. Solo se publica en la web si existe consentimiento expreso.', 'samirarte-boutique' ); ?></p>
			<a class="sam-button sam-button--ghost" href="<?php echo esc_url( home_url( '/cuentos/' ) ); ?>"><?php echo esc_html__( 'Conocer cuentos', 'samirarte-boutique' ); ?></a>
		</div>
	</div>
</section>

<section class="sam-section sam-contact-band">
	<div class="sam-container sam-contact-band__inner">
		<div>
			<p class="sam-eyebrow"><?php echo esc_html__( 'Diseñemos tu propuesta', 'samirarte-boutique' ); ?></p>
			<h2><?php echo esc_html__( 'Para pedidos complejos, cuéntanos la ocasión, unidades y tipo de detalle.', 'samirarte-boutique' ); ?></h2>
			<p><?php echo esc_html__( 'Te responderemos con una propuesta personalizada, cuidada en presentación, sabores, tiempos y precio.', 'samirarte-boutique' ); ?></p>
		</div>
		<?php if ( $contact_image ) : ?>
			<img src="<?php echo esc_url( $contact_image ); ?>" alt="<?php echo esc_attr__( 'Propuesta personalizada Samirarte', 'samirarte-boutique' ); ?>" loading="lazy">
		<?php endif; ?>
		<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></a>
	</div>
</section>

<?php
get_footer();
