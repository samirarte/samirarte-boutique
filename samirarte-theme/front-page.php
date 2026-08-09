<?php
/**
 * Premium home page.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

$sam_logo_path = get_template_directory() . '/assets/img/logo-samirarte.png';
$sam_logo_url  = get_template_directory_uri() . '/assets/img/logo-samirarte.png';

get_header();
?>

<main id="primary" class="site-main home-main">
	<section class="home-hero">
		<div class="samirarte-container hero-grid">
			<div class="hero-copy">
				<p class="section-kicker"><?php esc_html_e( 'Artesanía gourmet', 'samirarte-theme' ); ?></p>
				<h1><?php esc_html_e( 'Samirarte', 'samirarte-theme' ); ?></h1>
				<p class="hero-lead"><?php esc_html_e( 'Tradición que se saborea, arte que se comparte.', 'samirarte-theme' ); ?></p>
				<p class="hero-text">
					<?php esc_html_e( 'Cajas gourmet, experiencias privadas y cuentos personalizados en pergamino, creados para transformar un detalle en una memoria.', 'samirarte-theme' ); ?>
				</p>
				<div class="hero-actions">
					<a class="button button-primary" href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>">
						<?php esc_html_e( 'Descubrir cajas', 'samirarte-theme' ); ?>
					</a>
					<a class="button button-secondary" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
						<?php esc_html_e( 'Solicitar propuesta', 'samirarte-theme' ); ?>
					</a>
				</div>
			</div>

			<div class="hero-still-life" aria-hidden="true">
				<div class="hero-frame">
					<?php if ( file_exists( $sam_logo_path ) ) : ?>
						<img class="sam-hero-logo-mark" src="<?php echo esc_url( $sam_logo_url ); ?>" alt="">
					<?php else : ?>
						<span class="hero-emblem"><?php esc_html_e( 'S', 'samirarte-theme' ); ?></span>
					<?php endif; ?>
					<span class="hero-line"></span>
					<span class="hero-caption"><?php esc_html_e( 'cajas · relatos · experiencias', 'samirarte-theme' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<section class="values-band" aria-label="<?php echo esc_attr__( 'Valores Samirarte', 'samirarte-theme' ); ?>">
		<div class="samirarte-container values-grid">
			<div class="value-item">
				<span><?php esc_html_e( '01', 'samirarte-theme' ); ?></span>
				<p><?php esc_html_e( 'Elaboración bajo encargo', 'samirarte-theme' ); ?></p>
			</div>
			<div class="value-item">
				<span><?php esc_html_e( '02', 'samirarte-theme' ); ?></span>
				<p><?php esc_html_e( 'Presentación cuidada', 'samirarte-theme' ); ?></p>
			</div>
			<div class="value-item">
				<span><?php esc_html_e( '03', 'samirarte-theme' ); ?></span>
				<p><?php esc_html_e( 'Relato personalizado', 'samirarte-theme' ); ?></p>
			</div>
		</div>
	</section>

	<section class="feature-section feature-cajas">
		<div class="samirarte-container feature-grid">
			<div class="feature-art" aria-hidden="true">
				<div class="box-visual box-visual-large"></div>
				<div class="box-visual box-visual-small"></div>
			</div>
			<div class="feature-copy">
				<p class="section-kicker"><?php esc_html_e( 'Cajas gourmet', 'samirarte-theme' ); ?></p>
				<h2><?php esc_html_e( 'Cajas gourmet para regalar y compartir', 'samirarte-theme' ); ?></h2>
				<p><?php esc_html_e( 'Selecciones dulces, dátiles escogidos y pastas finas para té, preparadas con una estética cálida, elegante y artesanal.', 'samirarte-theme' ); ?></p>
				<a class="text-link" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
					<?php esc_html_e( 'Solicitar información', 'samirarte-theme' ); ?>
				</a>
			</div>
		</div>
	</section>

	<section class="feature-section feature-experiencias">
		<div class="samirarte-container feature-grid feature-grid-reverse">
			<div class="feature-copy">
				<p class="section-kicker"><?php esc_html_e( 'Experiencias privadas', 'samirarte-theme' ); ?></p>
				<h2><?php esc_html_e( 'Experiencias privadas a domicilio', 'samirarte-theme' ); ?></h2>
				<p><?php esc_html_e( 'Mesas íntimas, celebraciones y propuestas personalizadas donde la gastronomía se acompaña de detalle, atmósfera y presencia visual.', 'samirarte-theme' ); ?></p>
				<a class="text-link" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
					<?php esc_html_e( 'Consultar experiencia', 'samirarte-theme' ); ?>
				</a>
			</div>
			<div class="experience-visual" aria-hidden="true">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</section>

	<section class="story-section">
		<div class="samirarte-container story-panel">
			<div class="story-copy">
				<p class="section-kicker"><?php esc_html_e( 'Cuentos en pergamino', 'samirarte-theme' ); ?></p>
				<h2><?php esc_html_e( 'Una caja también puede guardar una historia', 'samirarte-theme' ); ?></h2>
				<p><?php esc_html_e( 'Algunos pedidos pueden incluir un cuento personalizado en pergamino, creado para la persona destinataria y publicado solo si existe consentimiento.', 'samirarte-theme' ); ?></p>
				<a class="button button-dark" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
					<?php esc_html_e( 'Preparar un regalo', 'samirarte-theme' ); ?>
				</a>
			</div>
			<div class="parchment-visual" aria-hidden="true">
				<div></div>
			</div>
		</div>
	</section>

	<section class="process-section">
		<div class="samirarte-container">
			<div class="section-heading">
				<p class="section-kicker"><?php esc_html_e( 'Proceso', 'samirarte-theme' ); ?></p>
				<h2><?php esc_html_e( 'Del pedido a la entrega', 'samirarte-theme' ); ?></h2>
			</div>

			<div class="process-card">
				<?php if ( shortcode_exists( 'samirarte_proceso_pedido' ) ) : ?>
					<?php echo wp_kses_post( do_shortcode( '[samirarte_proceso_pedido]' ) ); ?>
				<?php else : ?>
					<ol class="samirarte-order-process">
						<li><?php esc_html_e( 'Pendiente de pago', 'samirarte-theme' ); ?></li>
						<li><?php esc_html_e( 'Pago recibido', 'samirarte-theme' ); ?></li>
						<li><?php esc_html_e( 'En preparación', 'samirarte-theme' ); ?></li>
						<li><?php esc_html_e( 'Enviado', 'samirarte-theme' ); ?></li>
						<li><?php esc_html_e( 'Completado', 'samirarte-theme' ); ?></li>
					</ol>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="closing-section">
		<div class="samirarte-container closing-inner">
			<p class="section-kicker"><?php esc_html_e( 'Crear un recuerdo', 'samirarte-theme' ); ?></p>
			<h2><?php esc_html_e( 'Empieza con una caja. Termina con una historia.', 'samirarte-theme' ); ?></h2>
			<div class="hero-actions">
				<a class="button button-primary" href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>">
					<?php esc_html_e( 'Entrar en tienda', 'samirarte-theme' ); ?>
				</a>
				<a class="button button-secondary" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
					<?php esc_html_e( 'Completar formulario', 'samirarte-theme' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
