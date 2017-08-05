<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package News_Green
 */

get_header(); ?>

<!-- Main -->
<main class="main-container">
    <div class="container">

        <div class="row">
            <div class="full-wh">

                <div class="text-center page-404">

                    <h1 class="bounceIn wow" data-wow-duration="1.5s"><?php esc_html_e( 'Oooops!', 'newsreader' ); ?></h1>
                    <h2><?php esc_html_e( '404 Not Found', 'newsreader' ); ?></h2>
                    <h3><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'newsreader' ); ?> </h3>

                    <div class="col-md-6">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-theme"><?php esc_html_e( 'Back to home', 'newsreader' ); ?></a>
                    </div>
                     <div class="col-md-6">
					<?php get_search_form();?>
 					</div>
					

                </div>

            </div>
        </div>
    </div>
</main>
<!-- /Main -->

<?php
get_footer();
