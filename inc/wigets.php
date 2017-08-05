<?php
/**
 * Custom theme widgets.
 *
 * @package News_Green
 */

// Load widget helper.
if( file_exists( get_template_directory() . '/vendors/widget-helper/widget-helper.php' ) ){
	require_once get_template_directory() . '/vendors/widget-helper/widget-helper.php';

}

if ( ! function_exists( 'newsreader_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function newsreader_register_widgets() {

		// Recent Posts extended widget.
		register_widget( 'News_Green_Recent_Posts_Extended_Widget' );
		
		// News block widget.
		register_widget( 'News_Green_Featured_News_Block_Widget' );

	}

endif;

add_action( 'widgets_init', 'newsreader_register_widgets' );


if ( ! class_exists( 'News_Green_Recent_Posts_Extended_Widget' ) ) :

	/**
	 * Recent posts extended widget class.
	 *
	 * @since 1.0.0
	 */
	class News_Green_Recent_Posts_Extended_Widget extends NewsGreen_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'newsreader-recent-posts-extended';
			$args['label'] = esc_html__( 'NG: Recent Posts Extended', 'newsreader' );

			$args['widget'] = array(
				'classname'                   => 'newsreader_widget_recent_posts_extended',
				'description'                 => esc_html__( 'Recent posts extended widget', 'newsreader' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'newsreader' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'newsreader' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'newsreader' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'newsreader' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 100,
					),
				'image_width' => array(
					'label'       => esc_html__( 'Image Width:', 'newsreader' ),
					'type'        => 'number',
					'description' => esc_html__( 'px', 'newsreader' ),
					'default'     => 90,
					'min'         => 1,
					'max'         => 80,
					),
				'disable_thumbnail' => array(
					'label'   => esc_html__( 'Disable Thumbnail', 'newsreader' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			wp_reset_postdata();
			wp_reset_query();
			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . $values['title']  . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => absint( $values['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				);

			if ( absint( $values['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $values['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>

				<div class="recent-posts-extended-widget">

					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						 <div class="media post">

							<?php if ( false === $values['disable_thumbnail'] && has_post_thumbnail() ) : ?>
								 <div class="media-left">
                      			  <div class="image">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . absint( $values['image_width'] ) . 'px; height:auto;',
											);
										the_post_thumbnail( 'thumbnail', $img_attributes );
										?>
									</a>
                                    </div>
								  </div>
							<?php endif; ?>
							 <div class="media-body">
                        		<p class="text">
									<?php the_title(); ?>
								</p>
								<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More ', 'newsreader' );?></a>
							 </div><!-- .recent-posts-extended-text-wrap -->

						</div><!-- .recent-posts-extended-item -->
					<?php endwhile; ?>

				</div><!-- .recent-posts-extended-widget -->

				<?php
					wp_reset_postdata();
					wp_reset_query();
                ?>

			<?php endif; ?>

			<?php

			echo $args['after_widget'];

		}

	}

endif;



if ( ! class_exists( 'News_Green_Featured_News_Block_Widget' ) ) :

	/**
	 * News block widget class.
	 *
	 * @since 1.0.0
	 */
	class News_Green_Featured_News_Block_Widget extends NewsGreen_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'newsreader-news-block';
			$args['label'] = esc_html__( 'NG: Featured News Block', 'newsreader' );
			$args['widget'] = array(
				'classname'                   => 'newsreader_widget_recent_posts_extended',
				'description'                 => esc_html__( 'News Featured News Widget', 'newsreader' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
					'news_category' => array(
					'label'           => esc_html__( 'Select Category:', 'newsreader' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'newsreader' ),
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			wp_reset_postdata();
			wp_reset_query();
			$values = $this->get_field_values( $instance );
			
			echo $args['before_widget'];
			echo news_green_featured_news_block( 5, absint( $values['news_category'] ) );
			echo $args['after_widget'];

		}

	}

endif;