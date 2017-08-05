<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
		<?php
		if ( have_posts() ) : ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				echo '<div class="main_container">';
				get_template_part( 'template-parts/content', 'search' );
				echo '</div>';
			endwhile;

			the_posts_pagination( array(
					'format' => '/page/%#%',
					'type' => 'list',
					'mid_size' => 2,
					'prev_text' => __( 'Previous', 'newsreader' ),
					'next_text' => __( 'Next', 'newsreader' ),
					'screen_reader_text' => __( '&nbsp;', 'newsreader' ),
				) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

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
