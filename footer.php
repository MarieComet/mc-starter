<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MCStarter
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper footer-wrapper">
			<nav class="footer-menu-section" role="navigation" aria-label="<?php esc_attr_e( 'Footer navigation', 'mcstarter' ); ?>">
				<?php
					if ( has_nav_menu( 'footer-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer-menu',
							'menu_id'        => 'footer-menu',
							'menu_class'     => 'menu footer-menu',
							'container'      => 'ul',
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							) );
						}
						
					if ( has_nav_menu( 'footer-social-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer-social-menu',
							'menu_id'        => 'footer-social-menu',
							'menu_class'     => 'menu social-menu footer-social-menu',
							'container'      => 'ul',
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
						) );
					}
				?>
			</nav>
		</div><!-- .footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
