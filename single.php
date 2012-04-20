<?php
/** single.php
 *
 * The Template for displaying all single posts.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>

		<div id="primary" class="span8">
			<div id="content" role="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( '/partials/content', 'single' );
					comments_template( '', true );
				} ?>
				
				<nav id="nav-single" class="pager">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'the-bootstrap' ); ?></h3>
					<span class="previous"><?php next_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Next Post', 'the-bootstrap' ) ); ?></span>
					<span class="next"><?php previous_post_link( '%link', __( 'Previous Post <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) ); ?></span>
				</nav><!-- #nav-single -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */