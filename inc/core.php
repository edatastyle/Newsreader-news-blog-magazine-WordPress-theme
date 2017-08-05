<?php
/**
 * News Green functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News_Green
 */

if ( ! function_exists( 'newsreader_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newsreader_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on News Green, use a find and replace
	 * to change 'newsreader' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'newsreader', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'newsreader' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'video',
		'quote',
		'gallery',
		'audio',
	) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'newsreader_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => get_theme_file_uri( '/assets/img/brushed_alu.png' ),
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	
	// Enable support for custom logo.
	add_theme_support( 'custom-logo' );
	
	// Declare WooCommerce support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	
	add_image_size( 'ng_news_block_size', 400, 400, array( 'left', 'top' ) ); // Hard crop left top
	
}
endif;
add_action( 'after_setup_theme', 'newsreader_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsreader_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newsreader_content_width', 640 );
}
add_action( 'after_setup_theme', 'newsreader_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsreader_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newsreader' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'newsreader' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'newsreader' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'newsreader' ),
		'before_widget' => '<div class="col-md-3 col-xs-6 footer-col widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'newsreader_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newsreader_scripts() {
	/* FONTS*/
	
	wp_enqueue_style( 'Raleway', 'https://fonts.googleapis.com/css?family=Raleway:400,300,600,500');
	
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.css' ), '4.7.0' );
	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap.css' ), '3.3.7' );
	wp_enqueue_style( 'bootstrap-theme', get_theme_file_uri( '/assets/libs/bootstrap-theme.css' ), '3.3.7' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.css' ), '3.3.7' );	
	
	wp_enqueue_style( 'owl.carousel', get_theme_file_uri( '/assets/css/owl.carousel.css' ), '3.3.7' );
	wp_enqueue_style( 'owl.theme', get_theme_file_uri( '/assets/css/owl.theme.css' ), '3.3.7' );
	wp_enqueue_style( 'owl.transitions', get_theme_file_uri( '/assets/css/owl.transitions.css' ), '3.3.7' );
		
	/* MAIN CSS */
	
	wp_enqueue_style( 'newsreader-style', get_stylesheet_uri() );

	//bootstrap.js
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/libs/bootstrap.js' ), array('jquery'), '3.3.4', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri().'/assets/js/jquery.magnific-popup.js', 0, 0,true );
	wp_enqueue_script( 'owl.carousel', get_theme_file_uri( '/assets/js/owl.carousel.js' ),0,0,true );
	wp_enqueue_script( 'newsreader', get_template_directory_uri().'/assets/js/newsreader.js', 0, 0,true );
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsreader_scripts' );


/**
 * Set up the WordPress core custom header feature.
 *
 * @uses newsreader_header_style()
 */
function newsreader_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'newsreader_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'newsreader_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'newsreader_custom_header_setup' );




if ( ! function_exists( 'newsreader_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see newsreader_custom_header_setup().
 */
function newsreader_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();
	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	
	<?php if ( ! empty( $header_image ) ) : ?>
		.header {
	
				/*
				 * No shorthand so the Customizer can override individual properties.
				 * @see https://core.trac.wordpress.org/ticket/31460
				 */
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 50% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
			}
	<?php endif;?>
	</style>
	<?php
}
endif;


add_filter( 'default_option_embed_autourls', '__return_true' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newsreader_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'newsreader_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsreader_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'newsreader_pingback_header' );


/**
 * Flush out the transients used in newgreen_categorized_blog.
 */
function newsreader_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'newsreader_categories' );
}
add_action( 'edit_category', 'newsreader_category_transient_flusher' );
add_action( 'save_post',     'newsreader_category_transient_flusher' );
