<?php
/**
 * Template Name: Samirarte Digital
 * Description: Página de portfolio minimalista para Samirarte Digital — desarrollo web y apps.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="sam-page sam-digital-page">
	<div class="sam-container">
		<section class="sam-digital-hero">
			<p class="sam-eyebrow"><?php echo esc_html__( 'Samirarte Digital', 'samirarte-boutique' ); ?></p>
			<h1><?php echo esc_html__( 'Samirarte Digital — Diseño web y aplicaciones a medida para proyectos con alma', 'samirarte-boutique' ); ?></h1>
			<p class="sam-digital-lead"><?php echo esc_html__( 'Páginas web ligeras, tiendas y apps sencillas pensadas para marcas con identidad. Entregas claras, mantenibilidad y enfoque en la experiencia.', 'samirarte-boutique' ); ?></p>
		</section>

		<?php
		// If the page contains blocks or classic content, render it so editors can manage the page fully.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				if ( has_blocks( get_the_ID() ) || trim( get_the_content() ) !== '' ) {
					echo '<section class="sam-digital-content">';
					the_content();
					echo '</section>';
				}
			endwhile;
		endif;
		?>

		<section class="sam-digital-portfolio" aria-labelledby="sam-digital-portfolio-title">
			<h2 id="sam-digital-portfolio-title"><?php echo esc_html__( 'Proyectos realizados', 'samirarte-boutique' ); ?></h2>
			<p class="sam-digital-portfolio-intro"><?php echo esc_html__( 'Algunos trabajos recientes: páginas, tiendas y pequeñas aplicaciones entregadas a clientes.', 'samirarte-boutique' ); ?></p>

			<div class="sam-digital-grid">
				<?php
				// Use child pages of this page as portfolio items so the client can create/manage projects in WP admin.
				$children = new WP_Query(
					array(
						'post_type'      => 'page',
						'post_parent'    => get_the_ID(),
						'posts_per_page' => 12,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
					)
				);

				if ( $children->have_posts() ) :
					while ( $children->have_posts() ) : $children->the_post();
						$project_url = get_post_meta( get_the_ID(), 'project_url', true );
						$project_link = $project_url ? esc_url( $project_url ) : esc_url( get_permalink() );
						?>
						<article class="sam-digital-card">
							<a class="sam-digital-card-link" href="<?php echo $project_link; ?>" target="_blank" rel="noopener noreferrer">
								<div class="sam-digital-card-media">
									<?php if ( has_post_thumbnail() ) : ?>
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
									<?php else : ?>
										<div class="sam-image-placeholder"></div>
									<?php endif; ?>
								</div>
								<div class="sam-digital-card-body">
									<h3><?php the_title(); ?></h3>
									<p class="sam-digital-tag"><?php echo esc_html( get_post_meta( get_the_ID(), 'project_tag', true ) ); ?></p>
									<p class="sam-digital-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
									<span class="sam-digital-cta"><?php echo esc_html__( 'Ver proyecto', 'samirarte-boutique' ); ?></span>
								</div>
							</a>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					// Fallback curated projects if no child pages exist
					$fallback = array(
						array( 'title' => 'Proyecto A', 'tag' => 'Página corporativa', 'excerpt' => 'Desarrollo de web corporativa ligera', 'url' => home_url( '/' ) ),
						array( 'title' => 'Proyecto B', 'tag' => 'Tienda sencilla', 'excerpt' => 'Catálogo y checkout básico', 'url' => home_url( '/' ) ),
						array( 'title' => 'Proyecto C', 'tag' => 'Web-app', 'excerpt' => 'Aplicación de reservas y gestión simple', 'url' => home_url( '/' ) ),
					);

					foreach ( $fallback as $p ) : ?>
						<article class="sam-digital-card">
							<a class="sam-digital-card-link" href="<?php echo esc_url( $p['url'] ); ?>" target="_blank" rel="noopener noreferrer">
								<div class="sam-digital-card-media"><div class="sam-image-placeholder"></div></div>
								<div class="sam-digital-card-body">
									<h3><?php echo esc_html( $p['title'] ); ?></h3>
									<p class="sam-digital-tag"><?php echo esc_html( $p['tag'] ); ?></p>
									<p class="sam-digital-excerpt"><?php echo esc_html( $p['excerpt'] ); ?></p>
									<span class="sam-digital-cta"><?php echo esc_html__( 'Ver proyecto', 'samirarte-boutique' ); ?></span>
								</div>
							</a>
						</article>
					<?php endforeach;
				endif;
				?>
			</div>
		</section>

		<section class="sam-digital-cta">
			<h3><?php echo esc_html__( 'Necesitas una web o una app sencilla?', 'samirarte-boutique' ); ?></h3>
			<p><?php echo esc_html__( 'Escríbenos o solicita un presupuesto: entregas claras, precios justos y mantenimiento opcional.', 'samirarte-boutique' ); ?></p>
			<a class="sam-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php echo esc_html__( 'Solicitar presupuesto', 'samirarte-boutique' ); ?></a>
		</section>
	</div>
</main>
<?php
get_footer();
