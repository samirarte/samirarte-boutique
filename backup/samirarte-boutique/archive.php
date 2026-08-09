<?php
/**
 * Archive template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="sam-page-hero">
	<div class="sam-container">
		<p class="sam-eyebrow"><?php echo esc_html__( 'Archivo', 'samirarte-boutique' ); ?></p>
		<h1><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<p>', '</p>' ); ?>
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
	<?php endif; ?>
</div>

<?php
get_footer();
