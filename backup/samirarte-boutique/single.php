<?php
/**
 * Single post template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sam-page sam-single' ); ?>>
		<header class="sam-page-hero">
			<div class="sam-container">
				<p class="sam-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
				<h1><?php the_title(); ?></h1>
			</div>
		</header>
		<div class="sam-container sam-page__content">
			<div class="sam-content-card">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="sam-single__image"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
