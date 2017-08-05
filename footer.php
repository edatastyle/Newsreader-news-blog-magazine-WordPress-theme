<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Green
 */

?>

	   
<?php 
/**
* Hook - newsreader_footer_container.
*
* @hooked newsreader_footer_container_before - 10
* @hooked newsreader_footer_container - 11
* @hooked newsreader_footer_container_copy_right - 12
* @hooked newsreader_footer_container_after - 13
*/
do_action('newsreader_footer_container');?>

<?php wp_footer(); ?>
</body>
</html>
