<?php
/**
 * Widget helper.
 *
 * @package Magazine_Point
 */

// Load widget helper class.
require_once get_template_directory() . '/vendors/widget-helper/class-widget-helper.php';

/**
 * Enqueue widget scripts and styles.
 */
function magazine_point_widget_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( 'widgets.php' === $hook ) {

		// Color.
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );

		// Media.
		wp_enqueue_media();

		// Custom.
		wp_enqueue_style( 'newsreader-widget-helper', get_template_directory_uri() . '/vendors/widget-helper/widget-helper' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'newsreader-widget-helper', get_template_directory_uri() . '/vendors/widget-helper/widget-helper' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

}

add_action( 'admin_enqueue_scripts', 'magazine_point_widget_scripts' );
