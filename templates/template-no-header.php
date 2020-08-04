<?php
/**
 * Template Name: No header no footer
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage MCStarter
 * @since MCStarter 1.0
 */

get_header();
?>
<main id="main" class="main-content" role="main">
	<div id="content-wrapper" class="wrapper content-wrapper">

	<?php while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; ?>

	</div><!-- .content-wrapper -->
</main><!-- #main -->
<?php
get_footer();