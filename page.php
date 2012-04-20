<?php
/** page.php
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

		<div id="primary" class="span8">
			<div id="content" role="main">

				<?php
				the_post();
				get_template_part( '/partials/content', 'page' );
				comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */