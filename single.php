<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MCStarter
 */

get_header();
?>

	<main id="main" class="main-content" role="main">
		<div id="content-wrapper" class="wrapper content-wrapper">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content/content', get_post_type() );

			the_post_navigation( array(
				'prev_text' => mcstarter_ui_icon( 'previous', false ) . '<span class="link-text">%title</span>',
				'next_text' => '<span class="link-text">%title</span>' . mcstarter_ui_icon( 'next', false ),
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; ?>

		</div><!-- .content-wrapper -->
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
