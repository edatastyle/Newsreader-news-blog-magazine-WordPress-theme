<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package News_Green
 */

if ( ! function_exists( 'news_green_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable    True for adding No Image option.
	 * @param array $allowed        Allowed image size options.
	 * @param bool  $show_dimension True for showing dimension.
	 * @return array Image size options.
	 */
	function news_green_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;

		$choices = array();

		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'newsreader' );
		}

		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'newsreader' );
		$choices['medium']    = esc_html__( 'Medium', 'newsreader' );
		$choices['large']     = esc_html__( 'Large', 'newsreader' );
		$choices['full']      = esc_html__( 'Full (original)', 'newsreader' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed, true ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;



if ( ! function_exists( 'news_green_get_single_post_category' ) ) :

	/**
	 * Get single post category.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id Post ID.
	 * @return array Category detail.
	 */
	function news_green_get_single_post_category( $id ) {
		$output = array();

		$cats = get_the_category( $id );

		if ( ! empty( $cats ) ) {
			$cat  = array_shift( $cats );
			$output['name'] = $cat->name;
			$output['slug'] = $cat->name;
			$output['url']  = get_term_link( $cat );
		}

		return $output;
	}

endif;



if ( ! function_exists( 'news_green_featured_news_block' ) ) :

	/**
	 * Get Featured News Block.
	 *
	 * @since 1.0.0
	 *
	 * @param int $posts_per_page, int $news_category 
	 * @return array html.
	 */
	function news_green_featured_news_block( $posts_per_page = 5, $news_category = 0  ) {
		$qargs = array(
				'posts_per_page'      => $posts_per_page,
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);
			$html ='';
		if ( absint( $news_category ) > 0 ) {
				$qargs['cat'] = absint( $news_category );
			}

			$the_query = new WP_Query( $qargs );
			if ( $the_query->have_posts() ) :

           $html .= '<div id="featured-news">
		   	<div class="container">
             <div class="row">';
				$i=0; while ( $the_query->have_posts() ) : $the_query->the_post(); $i++; 
                $html .='<div class="col-md-'; if( $i == 1): $html .='6';  else: $html .='3'; endif; $html .='">';
				
               		$html .=' <div class="featured-news-wrapper">';
								if ( has_post_thumbnail() ) :
								
									$html .='<div class="featured-news-thumb">
										<a href="'.get_the_permalink().'">';
											$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
											if( $i == 1 ){
												$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'full');
											}else{
												$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'ng_news_block_size');
											}
											//$html .= get_the_post_thumbnail( 'newsreader-featured', $img_attributes );
										$html .= '<img src="'.esc_url( $post_thumbnail_url[0] ).'" alt="'.get_the_title().'" />';
										$html .='</a>
									</div>';
								else :
									$html .='<div class="featured-news-thumb">
										<img src="'.esc_url ( get_template_directory_uri().'/assets/img/no-image.png' ).'" alt="" />
									</div>';
								endif; 

								$html .='<div class="featured-news-text-content">';
									 $cat_detail = news_green_get_single_post_category( get_the_ID() );
									if ( ! empty( $cat_detail ) ) :
										$html .='<span class="featured-post-category color_'.$i.'"> <a href="'.esc_url( $cat_detail['url'] ).'">'.esc_html( $cat_detail['name'] ).'</a></span>';
									endif;
					
									 if( $i == 1):
                                   $html .=' <h2 class="featured-news-title">
										<a href="'.get_the_permalink().'"> '.get_the_title().' </a>
									</h2>';
                                    $html .='<div class="featured-news-meta entry-meta">
                                        <span class="posted-on"><i class="fa fa-clock-o"></i>'.get_the_time( get_option( 'date_format' ) ).'</span>';
                                       
                                       /* if ( comments_open( get_the_ID() ) ) {
                                            $html .=' <span class="comments-link"><i class="fa fa-comment-o"></i>';
                                            $html .= get_comments_link( get_the_ID() );
                                            $html .='</span>';
                                        }*/
                                        
                                    $html .= '</div>';
                                       else:
                                    
                                    $html .= '<h4 class="featured-news-title">
										<a href="'.get_the_permalink().'">'.get_the_title().'</a>
									</h4>';
                                    endif;
								 $html .= '</div>
							</div>
                </div>';
                endwhile; 
            
            wp_reset_postdata();
            wp_reset_query(); 
             $html .= ' </div></div>
            </div>';

				
			endif; 
  
   return $html;
	}

endif;


if ( !function_exists( 'newsreader_categorized_blog' ) ){
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function newsreader_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'newgreen_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'newgreen_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so newgreen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so newgreen_categorized_blog should return false.
		return false;
	}
}
}