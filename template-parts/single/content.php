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
<article class="blog-post padding_none" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
    echo strip_shortcodes( get_the_content() )
    ?>
	</div><!-- .entry-content -->

   
</div>

	<div class="col-md-6">
        <div class="tags">
        <?php 
            
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'newsreader' ) );
            if ( $tags_list ) {
                /* translators: used between list items, there is a space after the comma */
                printf( esc_html__( ' %1$s', 'newsreader' ) , $tags_list ); // WPCS: XSS OK.
            }
        
         ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="single-prev-next">
            <?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> '.__('Prev Article','newsreader')); ?>
            <?php next_post_link('%link', __('Next Article','newsreader').' <i class="fa fa-long-arrow-right"></i>'); ?>
        </div>
    </div>


    <div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> -->

</div>
