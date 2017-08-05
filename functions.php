<?php
/**
 * Load customizer
 */
require get_template_directory() . '/inc/customizer/class-customize.php';


/**
 * Implement the theme Core function
 */
require get_template_directory() . '/inc/core.php';

/**
 * Load Theme Hooks
 */
require get_template_directory() . '/inc/post_hooks.php';

/**
 * Load override Hooks
 */
require get_template_directory() . '/inc/override.php';

/**
 * Load Widgets 
 */
require get_template_directory() . '/inc/wigets.php';

/**
 * Load Comment helper
 */
require get_template_directory() . '/inc/comment-helper.php';


/**
 * Load Walker Menu
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Theme Hooks
 */
require get_template_directory() . '/inc/theme-hooks.php';

/**
 * Load Theme Hooks
 */
require get_template_directory() . '/inc/pro.php';

/**
 * Load Theme Hooks
 */
require get_template_directory() . '/vendors/breadcrumbs/breadcrumbs.php';

