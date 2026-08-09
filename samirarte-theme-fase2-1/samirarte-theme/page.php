<?php
/**
 * Page template.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main samirarte-section">
	<div class="samirarte-container">
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
	</div>
</main>

<?php
get_footer();
