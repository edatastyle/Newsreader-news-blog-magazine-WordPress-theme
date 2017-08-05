<?php
/**
 * Functions hooked to custom hook.
 *
 * @package news Green
 */
 
if( !function_exists('news_green_header_before') ){
	/**
	* Add top header before.
	*
	* @since 1.0.0
	*/
	function news_green_header_before(){
	?>
    <header id="home" class="header">
    <?php
	}
}
add_action( 'newgreen_header_container', 'news_green_header_before',10 );


if( !function_exists('news_green_header_top_bar') ){
	/**
	* Add Header Top Bar.
	*
	* @since 1.0.0
	*/
	function news_green_header_top_bar(){
		 if( get_theme_mod( 'newsreader_theme_options_socialheader','1') != 1 ):
		 return false;
		 endif;
	?>
   	 <div class="top_bar_container hidden-sm hidden-xs">
            <div class="container">
              <div class="row"> 
                
                <!-- Feedback -->
                <div class="col-md-7 breaking_news">
                	
                </div>
                <!-- /Feedback --> 
                
                <!-- Social -->
                <div class="col-md-5">
                  <?php
                    /**
                     * Hook - news_green_social_profile.
                     *
                     * @hooked news_green_social_profile - 10
                     */
					 if( get_theme_mod( 'newsreader_theme_options_socialheader','1') == 1 ):
                    	 do_action( 'news_green_social_profile' );
					 endif;
                    ?> 
                  
                </div>
                <!-- /Social --> 
                
              </div>
            </div>
          </div>
    <?php
	}
}
add_action( 'newgreen_header_container', 'news_green_header_top_bar',11 );


if( !function_exists('newgreen_header_container') ){
	/**
	* Add top header.
	*
	* @since 1.0.0
	*/
	function newgreen_header_container(){
	?>
    	  <div class="container">
            <div class="row navbar-header">
              <div class="col-md-4"> 
                
               
                  
                  <!-- Toggle Button -->
                  <button type="button"
                                class="navbar-toggle collapsed"
                                data-toggle="collapse"
                                data-target="#main-menu"
                                aria-expanded="false"
                                aria-controls="main-menu"> 
                  
                  <!--<span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>--> 
                  <i class="fa fa-bars"></i> </button>
                  <!-- /Toggle Button --> 
                  
					<?php
                    /**
                     * Hook - news_green_site_branding.
                     *
                     * @hooked news_green_site_branding - 10
                     */
                    do_action( 'news_green_site_branding' );
                    ?> 
                  
                
                
                <!-- /Navigation Header -->
               
              </div>
               
               <div class="clearfix"></div>
            </div>
          </div>
       

    <?php	
	}
}
add_action( 'newgreen_header_container', 'newgreen_header_container',12 );

if ( ! function_exists( 'news_green_add_primary_navigation' ) ) :

	/**
	 * Primary navigation.
	 *
	 * @since 1.0.0
	 */
	function news_green_add_primary_navigation() {
		?>
		 <nav id="navigation" class="navbar affix">
            <div class="container" role="navigation" itemscope="" itemtype="http://schema.org/SiteNavigationElement"> 
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 3,
                    'container'         => 'div',
                    'container_class'   => 'navbar-collapse collapse',
                    'container_id'      => 'main-menu',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'newsreader_bootstrap_navwalker::fallback',
                    'walker'            => new newsreader_bootstrap_navwalker())
                );
                ?>
           </div>         
         </nav>       
		<?php
	}

endif;

add_action( 'newgreen_header_container', 'news_green_add_primary_navigation',13 );


if( !function_exists('news_green_header_after') ){
	/**
	* Add top header before.
	*
	* @since 1.0.0
	*/
	function news_green_header_after(){
	?>
    <div class="clearfix"></div>
        </header>
    <?php
	}
}
add_action( 'newgreen_header_container', 'news_green_header_after',14 );


if ( ! function_exists( 'news_green_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function news_green_site_branding() {
	?>
	 <?php
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			
			the_custom_logo();
		
		}else{
		?>
        	<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
			<?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo esc_attr($description); ?></p>
            <?php endif; ?>
		
		<?php }?>   
	<?php
	}

endif;

add_action( 'news_green_site_branding', 'news_green_site_branding' );


if ( ! function_exists( 'news_green_social_profile' ) ) :

	/**
	 * Site Social Profile.
	 *
	 * @since 1.0.0
	 */
	function news_green_social_profile() {
	?>
        <ul class="social-inline social">
            <?php $social_link = get_theme_mod( 'newsreader_theme_options' ); if($social_link != ""):?>
            <?php foreach ($social_link['social'] as $key => $link):?>
                <li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_html($key);?>" target="_blank"></a></li>
            <?php endforeach; endif;?>
        </ul>
	<?php
	}

endif;

add_action( 'news_green_social_profile', 'news_green_social_profile' );


if ( ! function_exists( 'newsreader_output_content_wrapper_before' ) ) :

	/**
	 * Site Content Wrapper Before.
	 *
	 * @since 1.0.0
	 */
	function newsreader_output_content_wrapper_before() {
	?>
     <main class="main-container">
        <div class="container">
            <div class="row">      
	<?php
	}

endif;

add_action( 'newsreader_output_content_wrapper_before', 'newsreader_output_content_wrapper_before' );


if ( ! function_exists( 'newsreader_output_content_wrapper_after' ) ) :

	/**
	 * Site Content Wrapper After.
	 *
	 * @since 1.0.0
	 */
	function newsreader_output_content_wrapper_after() {
	?>
  
    		</div>
    	</div>      
    </main>
	<?php
	}

endif;

add_action( 'newsreader_output_content_wrapper_after', 'newsreader_output_content_wrapper_after' );


if ( ! function_exists( 'newsreader_footer_container_before' ) ) :

	/**
	 * Site Footer Container Before.
	 *
	 * @since 1.0.0
	 */
	function newsreader_footer_container_before() {
	?>
  	 <footer class="footer section-small">
        <div class="container">
            <div class="row">
	<?php
	}

endif;

add_action( 'newsreader_footer_container', 'newsreader_footer_container_before',10 );

if ( ! function_exists( 'newsreader_footer_container' ) ) :

	/**
	 * Site Footer Container.
	 *
	 * @since 1.0.0
	 */
	function newsreader_footer_container() {
		if ( is_active_sidebar( 'footer' ) ) {
			dynamic_sidebar( 'footer' );
		}
	}

endif;

add_action( 'newsreader_footer_container', 'newsreader_footer_container',11 );


if ( ! function_exists( 'newsreader_footer_container_copy_right' ) ) :

	/**
	 * Site Footer Container After.
	 *
	 * @since 1.0.0
	 */
	function newsreader_footer_container_copy_right() {
		$newgreen_options = get_theme_mod( 'newsreader_theme_options' );
	?>
    	<div class="clearfix"></div>
        <hr>
        
        <!-- Copyright -->
        <p class="copyright">
        	<?php echo esc_html( $newgreen_options['footer']['copyright'] );?> <br/>
        
       	 <a href="<?php /* translators:straing */ echo esc_url( esc_html__( 'https://wordpress.org/', 'newsreader' ) ); ?>"><?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s', 'newsreader' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <?php
        printf( /* translators:straing */  esc_html__( 'Theme: %1$s by %2$s.', 'newsreader' ), 'News Green', '<a href="' . esc_url( __( 'https://edatastyle.com', 'newsreader' ) ) . '" target="_blank">' . esc_html__( 'eDataStyle', 'newsreader' ) . '</a>' ); ?>
        </p>
        
		<?php
        /**
         * Hook - news_green_social_profile.
         *
         * @hooked news_green_social_profile - 10
         */
         if( get_theme_mod( 'newsreader_theme_options_socialfooter','1') == 1 ):
             do_action( 'news_green_social_profile' );
         endif;
        ?> 
  
	<?php
	}

endif;

add_action( 'newsreader_footer_container', 'newsreader_footer_container_copy_right',12 );


if ( ! function_exists( 'newsreader_footer_container_after' ) ) :

	/**
	 * Site Footer Container After.
	 *
	 * @since 1.0.0
	 */
	function newsreader_footer_container_after() {
	?>
  
            </div>
        </div>
    </footer>
    <!-- /Footer -->

    <!-- Scroll To Top -->
    <div id="scroll-to-top" class="scroll-to-top">
        <i class="icon fa fa-angle-up"></i>
    </div>
    <!-- /Scroll To Top -->		
	<?php
	}

endif;

add_action( 'newsreader_footer_container', 'newsreader_footer_container_after',13 );



if ( ! function_exists( 'newsreader_posted_on' ) ) :

	/**
	 * Site Footer Container After.
	 *
	 * @since 1.0.0
	 */
	function newsreader_posted_on() {
	?>
        <ul class="list-inline meta">
		<?php
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
       	 $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
        
        $time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
        );
        ?>
        <li> <?php echo $time_string;?></li>
        <?php $byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s','newsreader' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	); ?>
        <li><?php echo $byline;?></li>
        <?php
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'newsreader' ) );
			if ( $categories_list && newsreader_categorized_blog() ) {
				printf( '<li class="cat-links">%1$s</li>', $categories_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'newsreader' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</li>';
		}
		?>
        </ul>
	<?php
	}

endif;
add_action( 'newsreader_posted_on', 'newsreader_posted_on');



if ( ! function_exists( 'newsreader_page_post_header_block' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsreader_page_post_header_block() {
		
	?>	
    <section class="section-page-header ">
    <div class="set__page__position">
    <div class="container">
        <div class="row">
			
            <!-- Page Title -->
            <div class="col-md-7">
               <?php do_action('newsreader_page_post_title_render');?>
            </div>
			
            <!-- /Page Title -->
            <!-- Breadcrumbs -->
            <div class="col-md-5">
                  <?php do_action('newsreader_breadcrumb');?>
            </div>
            <!-- /Breadcrumbs -->
    
        </div>
    </div>
    </div>
    </section>
	<?php
	}

endif;
add_action( 'newsreader_page_post_header_block', 'newsreader_page_post_header_block',10 );


if ( ! function_exists( 'newsreader_page_post_title_render' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsreader_page_post_title_render() {
		
		if ( is_home() ) {
			if( get_option( 'page_for_posts' ) ){
				echo '<h1 class="title">';
				echo get_the_title( get_option( 'page_for_posts' ) );
				echo '</h1>';
			}else {
				
			?>
             <h1 class="title"><?php echo ( cs_get_option( 'eds_blog_list_title' )!="" ) ? cs_get_option( 'eds_blog_list_title' ) :'';?></h1>
              <div class="subtitle"><?php echo ( cs_get_option( 'eds_blog_list_sub_title' ) != "" ) ? cs_get_option( 'eds_blog_list_sub_title' ) : '';?></div>
            <?php
				
			}
		}else if ( function_exists('is_shop') && apply_filters( 'woocommerce_show_page_title', true ) && is_shop() ){
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				echo '<h1 class="title">';
				echo woocommerce_page_title();
				echo '</h1>';
			}
		} elseif ( is_singular() ) {
			echo '<h1 class="title">';
			echo single_post_title( '', false );
			echo '</h1>';
		} elseif ( is_archive() ) {
			echo '<h1 class="title">';
			the_archive_title();
			echo '</h1>';
			
		} elseif ( is_search() ) {
			echo '<h1 class="title">';
			printf( esc_html__( 'Search Results for: %s', 'newsreader' ),  get_search_query() );
			echo '</h1>';
		} elseif ( is_404() ) {
			echo '<h1 class="title">';
			esc_html_e( '404 Error', 'newsreader' );
			echo '</h1>';
		}elseif( is_shop() ){
			
		}

		

	}

endif;
add_action( 'newsreader_page_post_title_render', 'newsreader_page_post_title_render',10 );



if ( ! function_exists( 'newsreader_page_post_sub_title_render' ) ) :

	/**
	 * Add Sub Title title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsreader_page_post_sub_title_render() {
		
		echo '<div class="subtitle">';

		if ( is_archive() ) {
            the_archive_description( );
		}
		echo '</div>';

	}

endif;
add_action( 'newsreader_page_post_title_render', 'newsreader_page_post_sub_title_render',11 );



if ( ! function_exists( 'newsreader_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function newsreader_breadcrumb() {
		
			
		
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			get_template_part( 'vendors/breadcrumbs/breadcrumbs' );
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		echo '<div id="breadcrumb">';
		breadcrumb_trail( $breadcrumb_args );
		echo '</div><!-- #breadcrumb -->';
		
		
	}

endif;
add_action( 'newsreader_breadcrumb', 'newsreader_breadcrumb',10 );