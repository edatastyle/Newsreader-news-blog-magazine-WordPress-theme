<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package News_Green
 */

get_header(); ?>
	<?php
	/**
    * Hook - newsreader_page_post_header_block.
    *
    * @hooked newsreader_page_post_header_block - 10
    */
	do_action('newsreader_page_post_header_block');
    /**
    * Hook - newsreader_output_content_wrapper_before.
    *
    * @hooked newsreader_output_content_wrapper_before - 10
    */
    do_action('newsreader_output_content_wrapper_before');
    ?>
	<div class="col-md-9 main_container">	
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
 		</div>
        
        <div class="col-md-3">
        	<?php get_sidebar(); ?>
        </div>

	<?php
    /**
    * Hook - newsreader_output_content_wrapper_after.
    *
    * @hooked newsreader_output_content_wrapper_after - 10
    */
    do_action('newsreader_output_content_wrapper_after');
    ?>

<?php

get_footer();
