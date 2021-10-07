<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Superpress
 */
 ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	$show_title = get_theme_mod('superpress_page_title_switch',false);
	$show_image = get_theme_mod('superpress_page_fimage_switch',true);
	if($show_image){
		the_post_thumbnail( 'post-thumbnail', '' );
	}
	
    if($show_title){
    	?>
		<div class="page-single-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
		<?php
	}
	?>
	<div class="page-single-content">
		<?php
		the_content();
			wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'superpress' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
 	<?php if ( get_edit_post_link() ) : ?>
		<div class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'superpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
</div><!-- #post-<?php the_ID(); ?> -->