<?php
/**
 * Fallback template.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main samirarte-section">
	<div class="samirarte-container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-panel' ); ?>>
					<h1><?php echo esc_html( get_the_title() ); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<section class="content-panel">
				<h1><?php esc_html_e( 'Contenido no encontrado', 'samirarte-theme' ); ?></h1>
				<p><?php esc_html_e( 'No hay contenido disponible en este momento.', 'samirarte-theme' ); ?></p>
			</section>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
