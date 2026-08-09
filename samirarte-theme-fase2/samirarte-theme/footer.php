<?php
/**
 * Site footer.
 *
 * @package Samirarte_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">
	<div class="samirarte-container footer-inner">
		<p>
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
			<?php esc_html_e( 'Artesanía gourmet y experiencias personalizadas.', 'samirarte-theme' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
