<?php
/**
 * The template for the default page header section, at the top of every page
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MCStarter
 */
?>

<div class="page-header">
    <?php $data = mcstarter_get_page_header_data(); ?>
    <div class="main-info">
        <h1 class="main-title"><?php echo wp_kses_post( $data['title'] ); ?></h1>
        <?php if ( $data['meta'] ) : ?>
            <p class="main-meta caps"><?php echo $data['meta']; ?></p>
        <?php endif; ?>
    </div>
</div>