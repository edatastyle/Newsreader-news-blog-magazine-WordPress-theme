<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package News_Green
 */

?>

<!-- Posts List -->
<div class="posts-list">

<!-- Single Post With Image -->
<article class="blog-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
    <?php
    /**
    * Hook - newgreen_posts_formats_header.
    *
    * @hooked newgreen_posts_formats_header - 10
    */
    do_action('newgreen_posts_formats_header');
    ?>
    
<div class="box_container">    
    <?php
	
    if ( is_singular() ) :
        the_title( '<h2 class="title entry-title">', '</h2>' );
    else :
        the_title( '<h2 class="entry-title title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    
    if ( 'post' === get_post_type() ) : ?>
    <div class="entry-meta">
        <?php do_action('newsreader_posted_on'); ?>
    </div><!-- .entry-meta -->
    <?php
    endif; ?>
	

	<div class="entry-content">
	<?php
		/* translators: %s: Name of current post */
		  if( get_theme_mod( 'newsreader_theme_options_blog_list_content','excerpt' ) == 'excerpt' ):
   			the_excerpt();
		  else:
		  	the_content();
		  endif;	
	
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'newsreader' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

    <!-- Read More Button -->
    <div>
    <a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-theme"><?php esc_html_e('Continue Reading', 'newsreader'); ?> <i class="fa fa-fw fa-angle-double-right"></i></a>
    </div>
    <!-- /Read More Button -->
</div>

</article><!-- #post-<?php the_ID(); ?> -->

</div>
