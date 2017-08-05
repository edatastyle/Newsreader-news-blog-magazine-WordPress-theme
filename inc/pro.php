<?php

/*Add theme menu page*/
 
add_action('admin_menu', 'newsreader_admin_menu');

function newsreader_admin_menu() {
	
	$newsreader_page_title = esc_html__("NewsGreen Premium",'newsreader');
	
	$newsreader_menu_title = esc_html__("NewsGreen Premium",'newsreader');
	
	add_theme_page($newsreader_page_title, $newsreader_menu_title, 'edit_theme_options', 'newsreader_pro', 'newsreader_pro_page');
	
}

/*
**
** Premium Theme Feature Page
**
*/

function newsreader_pro_page(){
	if ( is_admin() ) {
		get_template_part('/inc/premium-screen/index');
		
	} 
}

function newsreader_admin_script($newsreader_hook){
	
	if($newsreader_hook != 'appearance_page_newsreader_pro') {
		return;
	} 
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
	wp_enqueue_style( 'newsreader-pro-custom-css', get_template_directory_uri() .'/inc/premium-screen/pro-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'newsreader_admin_script' );



