<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package News_Green
 */

get_header(); ?>
	<?php 
    if( function_exists( 'news_green_featured_news_block' ) ){
        echo news_green_featured_news_block();	
    }
    ?>
	<?php
    /**
    * Hook - newsreader_output_content_wrapper_before.
    *
    * @hooked newsreader_output_content_wrapper_before - 10
    */
    do_action('newsreader_output_content_wrapper_before');
    ?>
    	<div class="col-md-9 main_container">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

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
