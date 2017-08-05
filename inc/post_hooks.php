<?php
/**
 * Functions hooked to post page.
 *
 * @package News Green
 *
 */
 
 if ( ! function_exists( 'newgreen_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function newgreen_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
		?>
           <div class="image">
           		<?php if ( is_singular() ) :?>
               		 <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
                <?php else: ?>
                	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
                <?php endif;?>
                <div class="gallery-image <?php echo esc_attr( $formats );?>">
                 	<?php the_post_thumbnail('full');?>
                </div>
                </a>
            </div>
         <?php else:?>
         <div class="image">&nbsp;</div> 
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'newgreen_posts_formats_thumbnail', 'newgreen_posts_formats_thumbnail' );


if ( ! function_exists( 'newgreen_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function newgreen_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="image"><div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div></div>';
				}
			else: 
				do_action('newgreen_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'newgreen_posts_formats_video', 'newgreen_posts_formats_video' ); 


if ( ! function_exists( 'newgreen_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function newgreen_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo '<div class="image">';
					echo $audio_html;
				echo '</div>';
			}
		else: 
			do_action('newgreen_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'newgreen_posts_formats_audio', 'newgreen_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'newgreen_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function newgreen_posts_formats_gallery() {
		if ( get_post_gallery() ) :
			echo '<div class="image">';
				echo get_post_gallery();
			echo '</div>';
		else: 
			do_action('newgreen_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'newgreen_posts_formats_gallery', 'newgreen_posts_formats_gallery' ); 




if ( ! function_exists( 'newgreen_posts_formats_header' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function newgreen_posts_formats_header() {
		$formats = get_post_format(get_the_ID());
		
		switch ($formats) {
			default:
				do_action('newgreen_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('newgreen_posts_formats_gallery');
			break;
			case 'audio':
				do_action('newgreen_posts_formats_audio');
			break;
			case 'video':
				do_action('newgreen_posts_formats_video');
			break;
		
		} 
		
	 }

endif;
add_action( 'newgreen_posts_formats_header', 'newgreen_posts_formats_header' ); 

