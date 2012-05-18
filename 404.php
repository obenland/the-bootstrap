<?php
/** 404.php
 *
 * The template for displaying 404 pages (Not Found).
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<div id="primary" class="span8">
	<div id="content" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="page-header">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'the-bootstrap' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'the-bootstrap' ); ?></p>

				<?php
				get_search_form();
				
				the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) );
				
				the_widget( 'WP_Widget_Categories', array(
					'title'	=>	__( 'Most Used Categories', 'the-bootstrap' ),
				) );
				
				$archive_content = sprintf( _x( 'Try looking in the monthly archives. %1$s', '%1$s: smilie', 'the-bootstrap' ), convert_smilies( ':)' ) );
				the_widget( 'WP_Widget_Archives', array(
					'count'		=>	0,
					'dropdown'	=>	1
				), array(
					'after_title'	=>	"</h2><p>{$archive_content}</p>"
				) );
				
				the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	</div><!-- #content -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file 404.php */
/* Location: ./wp-content/themes/the-bootstrap/404.php */