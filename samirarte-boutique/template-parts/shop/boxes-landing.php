<?php
// Template part: boxes landing. Expects $piece_categories defined in scope.
defined( 'ABSPATH' ) || exit;
?>
<section class="sam-shop-intro" aria-labelledby="sam-shop-intro-title">
	<div class="sam-shop-intro__copy">
		<p class="sam-eyebrow"><?php echo esc_html__( 'CAJAS GOURMET', 'samirarte-boutique' ); ?></p>
		<h1 id="sam-shop-intro-title"><?php echo esc_html__( 'Cajas gourmet listas para pedir', 'samirarte-boutique' ); ?></h1>
		<p class="sam-shop-intro__lead"><?php echo esc_html__( 'En la tienda encontrarás cajas ya definidas y encargos realizados con su precio visible, preparados para repetir, regalar o adaptar de forma sencilla. Las composiciones complejas, eventos y peticiones muy personalizadas se trabajan siempre bajo solicitud y propuesta previa.', 'samirarte-boutique' ); ?></p>
		<ol class="sam-shop-steps">
			<li><span>1</span><strong><?php echo esc_html__( 'Elige una caja definida', 'samirarte-boutique' ); ?></strong></li>
			<li><span>2</span><strong><?php echo esc_html__( 'Consulta su precio', 'samirarte-boutique' ); ?></strong></li>
			<li><span>3</span><strong><?php echo esc_html__( 'Pide o solicita propuesta', 'samirarte-boutique' ); ?></strong></li>
		</ol>
	</div>

	<div class="sam-box-size-selector" aria-labelledby="sam-box-size-title">
		<div class="sam-box-size-selector__heading">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Compra directa', 'samirarte-boutique' ); ?></p>
			<h2 id="sam-box-size-title"><?php echo esc_html__( 'Cajas definidas con precio', 'samirarte-boutique' ); ?></h2>
		</div>
		<div class="sam-box-size-grid" role="list">
			<a class="sam-box-size-card is-featured" href="#catalogo-piezas" role="listitem"><strong>3</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
			<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>6</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
			<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>9</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
			<a class="sam-box-size-card" href="#catalogo-piezas" role="listitem"><strong>12</strong><span><?php echo esc_html__( 'piezas', 'samirarte-boutique' ); ?></span></a>
		</div>
		<div class="sam-actions">
			<a class="sam-button" href="#catalogo-piezas"><?php echo esc_html__( 'Ver cajas y encargos', 'samirarte-boutique' ); ?></a>
			<a class="sam-button sam-button--ghost" href="#pedido-complejo"><?php echo esc_html__( 'Pedido complejo', 'samirarte-boutique' ); ?></a>
		</div>
	</div>
</section>

<section id="catalogo-piezas" class="sam-piece-catalog" aria-labelledby="sam-piece-catalog-title">
	<div class="sam-piece-catalog__heading">
		<div>
			<p class="sam-eyebrow"><?php echo esc_html__( 'WooCommerce', 'samirarte-boutique' ); ?></p>
			<h2 id="sam-piece-catalog-title"><?php echo esc_html__( 'Encargos y cajas disponibles', 'samirarte-boutique' ); ?></h2>
		</div>
		<p><?php echo esc_html__( 'Esta zona funciona como escaparate de pedidos ya realizados y cajas cerradas: cada producto puede mostrar su precio, descripción y disponibilidad desde WooCommerce.', 'samirarte-boutique' ); ?></p>
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

<section id="pedido-complejo" class="sam-personalized-box" aria-labelledby="sam-personalized-box-title">
	<div class="sam-personalized-box__media">
		<img src="<?php echo esc_url( samirarte_boutique_image_url( 'galeria-caja-personalizada.webp' ) ); ?>" alt="<?php echo esc_attr__( 'Caja gourmet personalizada Samirarte', 'samirarte-boutique' ); ?>" loading="lazy">
	</div>
	<div class="sam-personalized-box__copy">
		<p class="sam-eyebrow"><?php echo esc_html__( 'BAJO PETICIÓN', 'samirarte-boutique' ); ?></p>
		<h2 id="sam-personalized-box-title"><?php echo esc_html__( 'Pedidos complejos con propuesta previa', 'samirarte-boutique' ); ?></h2>
		<p class="sam-personalized-box__lead"><?php echo esc_html__( 'Cuando el encargo requiere diseño especial, muchas unidades, una experiencia completa, montaje o una narrativa muy personalizada, lo trabajamos contigo antes de confirmar precio, tiempos y alcance.', 'samirarte-boutique' ); ?></p>
		<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/#contacto' ) ); ?>"><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></a>
	</div>
</section>
