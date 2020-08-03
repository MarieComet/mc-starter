<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MCStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-wrapper">

		<header class="post-header">
			<?php mcstarter_post_thumbnail(); ?>
			<div class="post-details">
				<?php if ( 'post' === get_post_type() && ( '' !== get_theme_mod( 'mcstarter_post_meta_display', 'date' ) ) ) : ?>
					<div class="post-meta">
						<?php mcstarter_post_meta(); ?>
					</div><!-- .post-meta -->
				<?php endif; ?>
				<?php the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</div>
		</header><!-- .post-header -->

		<div class="post-content">
			<?php 
				the_excerpt(); 
				mcstarter_read_more_link();
			?>
		</div><!-- .post-content -->

		<footer class="post-footer">
			<?php mcstarter_post_footer(); ?>
		</footer><!-- .post-footer -->

	</div><!-- .post-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
