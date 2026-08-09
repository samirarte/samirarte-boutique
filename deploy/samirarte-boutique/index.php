<?php
/**
 * Main index template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

if ( is_front_page() || ( is_home() && 'posts' === get_option( 'show_on_front' ) ) ) {
	require get_template_directory() . '/front-page.php';
	return;
}

get_header();
?>

<section class="sam-page-hero">
	<div class="sam-container">
		<p class="sam-eyebrow"><?php echo esc_html__( 'Diario', 'samirarte-boutique' ); ?></p>
		<h1><?php echo esc_html__( 'Historias, ingredientes y rituales', 'samirarte-boutique' ); ?></h1>
		<p><?php echo esc_html__( 'Notas, historias e inspiración alrededor de la cocina árabe, la cultura del té, los ingredientes singulares y el arte de regalar experiencias gourmet.', 'samirarte-boutique' ); ?></p>
		<ul class="sam-diary-topics" aria-label="<?php echo esc_attr__( 'Categorías del Diario', 'samirarte-boutique' ); ?>">
			<li><?php echo esc_html__( 'Cocina árabe', 'samirarte-boutique' ); ?></li>
			<li><?php echo esc_html__( 'Ingredientes', 'samirarte-boutique' ); ?></li>
			<li><?php echo esc_html__( 'Té y rituales', 'samirarte-boutique' ); ?></li>
			<li><?php echo esc_html__( 'Historias de bocados', 'samirarte-boutique' ); ?></li>
			<li><?php echo esc_html__( 'Celebraciones', 'samirarte-boutique' ); ?></li>
			<li><?php echo esc_html__( 'Procesos artesanales', 'samirarte-boutique' ); ?></li>
		</ul>
	</div>
</section>

<div class="sam-container sam-post-list">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'sam-post-card' ); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="sam-post-card__excerpt"><?php the_excerpt(); ?></div>
			</article>
		<?php endwhile; ?>
		<div class="sam-pagination"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php echo esc_html__( 'No hay contenido publicado todavía.', 'samirarte-boutique' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
