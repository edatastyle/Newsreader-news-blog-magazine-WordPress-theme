<?php
/**
* Functions hooked to post page.
*
* @package News Green
*
*/
 
if ( ! function_exists( 'newsreader_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function newsreader_customize_search_form() {

		$form = '<div class="search">
		<form role="search" method="post" class="search-form widget-search form-inline" action="' . esc_url( home_url( '/' ) ) . '">
		
			<div class="pull-left">
				<input type="search" class="search-field form-control" placeholder="' . esc_attr_x( 'Search&hellip;', 'placeholder', 'newsreader' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'newsreader' ) . '" />
			</div>
			<div class="pull-left">
				<button class="btn btn-theme" type="submit"><i class="fa fa-fw fa-search"></i></button>
			
			</div>
			<div class="clearfix"></div>
		</form>
		</div>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'newsreader_customize_search_form', 15 ); 


if( ! function_exists( 'newsreader_spirit' ) ) {
	function newsreader_spirit( $text ){
		$text = trim( $text );
		$array = explode( ' ' , $text );
		$counter = count( $array );
		if($counter > 1){
		$last_word = array_pop( $array );
		unset( $array[ $counter ] );
		return implode(' ', $array) . ' <span class="text-theme">'. $last_word. '</span>';
		}else{
			return $text;
		}
	}
	function newsreader_widget_title($title, $instance, $id_base) {
        return newsreader_spirit( $title );
    }
 
	add_filter ( 'widget_title' , 'newsreader_widget_title', 10, 3); //we use the default priority and 3 arguments in the callback function
}