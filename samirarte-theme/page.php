<?php
/**
 * Page template.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main sam-page">
	<?php
	while ( have_posts() ) :
		the_post();

		$page_slug = sanitize_title( get_post_field( 'post_name', get_the_ID() ) );
		$page_data = array(
			'artesania-gourmet' => array(
				'visual_title' => __( 'Artesanía Gourmet', 'samirarte-theme' ),
				'intro'        => __( 'Cajas y detalles preparados con una mirada cálida, elegante y artesanal.', 'samirarte-theme' ),
				'items'        => array(
					__( 'Cajas preparadas bajo encargo.', 'samirarte-theme' ),
					__( 'Dátiles seleccionados y pastas finas.', 'samirarte-theme' ),
					__( 'Regalos con presentación cuidada.', 'samirarte-theme' ),
					__( 'Detalles personalizados.', 'samirarte-theme' ),
				),
				'cta_label'    => __( 'Solicitar propuesta', 'samirarte-theme' ),
				'cta_url'      => home_url( '/contacto/' ),
			),
			'experiencias'       => array(
				'visual_title' => __( 'Experiencias privadas', 'samirarte-theme' ),
				'intro'        => __( 'Propuestas íntimas donde el detalle, la mesa y la atmósfera construyen un momento propio.', 'samirarte-theme' ),
				'items'        => array(
					__( 'Mesas íntimas.', 'samirarte-theme' ),
					__( 'Celebraciones.', 'samirarte-theme' ),
					__( 'Propuestas a domicilio.', 'samirarte-theme' ),
					__( 'Presentación y atmósfera.', 'samirarte-theme' ),
				),
				'cta_label'    => __( 'Solicitar propuesta', 'samirarte-theme' ),
				'cta_url'      => home_url( '/contacto/' ),
			),
			'cuentos'            => array(
				'visual_title' => __( 'Cuentos en pergamino', 'samirarte-theme' ),
				'intro'        => __( 'Relatos creados para acompañar regalos y convertirlos en una memoria más personal.', 'samirarte-theme' ),
				'items'        => array(
					__( 'Relatos personalizados.', 'samirarte-theme' ),
					__( 'Inspiración gastronómica y simbólica.', 'samirarte-theme' ),
					__( 'Publicación solo con consentimiento.', 'samirarte-theme' ),
					__( 'Formato privado o compartido.', 'samirarte-theme' ),
				),
				'cta_label'    => __( 'Solicitar regalo personalizado', 'samirarte-theme' ),
				'cta_url'      => home_url( '/contacto/' ),
			),
			'contacto'           => array(
				'visual_title' => __( 'Hablemos de tu propuesta', 'samirarte-theme' ),
				'intro'        => __( 'Cuéntanos qué quieres preparar y te responderemos con una propuesta cuidada.', 'samirarte-theme' ),
				'items'        => array(
					__( 'Teléfono: +34 646 14 38 95', 'samirarte-theme' ),
					__( 'Solicitudes para cajas gourmet, experiencias privadas, regalos personalizados o cuentos en pergamino.', 'samirarte-theme' ),
					__( 'Cuéntanos qué quieres preparar y te responderemos con una propuesta cuidada.', 'samirarte-theme' ),
				),
				'cta_label'    => '',
				'cta_url'      => '',
			),
		);

		$current_page = isset( $page_data[ $page_slug ] ) ? $page_data[ $page_slug ] : array(
			'visual_title' => get_the_title(),
			'intro'        => __( 'Un espacio para conocer mejor el universo Samirarte.', 'samirarte-theme' ),
			'items'        => array(
				__( 'Cuidado en cada detalle.', 'samirarte-theme' ),
				__( 'Presentación cálida y elegante.', 'samirarte-theme' ),
				__( 'Propuestas hechas con intención.', 'samirarte-theme' ),
			),
			'cta_label'    => __( 'Completar formulario', 'samirarte-theme' ),
			'cta_url'      => home_url( '/contacto/' ),
		);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'sam-page__article sam-page--' . esc_attr( $page_slug ) ); ?>>
			<section class="sam-page-hero">
				<div class="sam-page-hero__inner">
					<div class="sam-page-hero__copy">
						<p class="sam-page__kicker"><?php esc_html_e( 'Samirarte', 'samirarte-theme' ); ?></p>
						<h1><?php echo esc_html( $current_page['visual_title'] ); ?></h1>
						<p><?php echo esc_html( $current_page['intro'] ); ?></p>
						<?php if ( ! empty( $current_page['cta_label'] ) && ! empty( $current_page['cta_url'] ) ) : ?>
							<a class="sam-page__button" href="<?php echo esc_url( $current_page['cta_url'] ); ?>">
								<?php echo esc_html( $current_page['cta_label'] ); ?>
							</a>
						<?php endif; ?>
					</div>
					<div class="sam-page-hero__visual" aria-hidden="true">
						<span></span>
						<span></span>
					</div>
				</div>
			</section>

			<div class="sam-page__body">
				<?php if ( 'contacto' === $page_slug ) : ?>
					<section class="sam-contact-form-panel" aria-label="<?php echo esc_attr__( 'Formulario de contacto', 'samirarte-theme' ); ?>">
						<div class="sam-contact-form-panel__intro">
							<p class="sam-page__kicker"><?php esc_html_e( 'Formulario', 'samirarte-theme' ); ?></p>
							<h2><?php esc_html_e( 'Completa el formulario y prepararemos una propuesta cuidada.', 'samirarte-theme' ); ?></h2>
							<p><?php esc_html_e( 'Solicitudes para cajas gourmet, experiencias privadas, regalos personalizados o cuentos en pergamino.', 'samirarte-theme' ); ?></p>
						</div>
						<div class="sam-contact-form-panel__form entry-content">
							<?php the_content(); ?>
						</div>
					</section>

					<section class="sam-page-grid sam-page-grid--contact" aria-label="<?php echo esc_attr__( 'Datos de contacto', 'samirarte-theme' ); ?>">
						<div class="sam-contact-card">
							<h2><?php esc_html_e( 'Contacto', 'samirarte-theme' ); ?></h2>
							<p><a href="<?php echo esc_url( 'tel:+34646143895' ); ?>"><?php echo esc_html( '+34 646 14 38 95' ); ?></a></p>
						</div>
						<div class="sam-contact-card sam-contact-card--note">
							<h2><?php esc_html_e( 'Propuesta cuidada', 'samirarte-theme' ); ?></h2>
							<p><?php esc_html_e( 'Cuéntanos qué quieres preparar y te responderemos con una propuesta cuidada.', 'samirarte-theme' ); ?></p>
						</div>
					</section>
				<?php else : ?>
					<div class="sam-page__content entry-content">
						<?php the_content(); ?>
					</div>

					<section class="sam-page-grid" aria-label="<?php echo esc_attr__( 'Detalles destacados', 'samirarte-theme' ); ?>">
						<?php foreach ( $current_page['items'] as $index => $item ) : ?>
							<div class="sam-feature-card">
								<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<p><?php echo esc_html( $item ); ?></p>
							</div>
						<?php endforeach; ?>
					</section>
				<?php endif; ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
