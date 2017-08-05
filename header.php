<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Green
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
/**
* Hook - news_green_header_container.
*
* @hooked news_green_header_before - 10
* @hooked news_green_header_top_bar - 11
* @hooked newgreen_header_container - 12
* @hooked news_green_add_primary_navigation - 13
* @hooked news_green_header_after - 14
*/
do_action( 'newgreen_header_container' );
?>
