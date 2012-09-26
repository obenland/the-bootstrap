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

<section id="primary" class="span8">
	
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();

		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', 'single' );
			comments_template();
		} ?>
		
		<nav id="nav-single" class="pager">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'the-bootstrap' ); ?></h3>
			<?php 
				$prev_post = get_previous_post();
				if (!empty($prev_post)) {
			?>
					<a class="pull-left" href="<?php echo get_permalink( $prev_post->ID ); ?>" rel="prev">
						<span class="meta-nav">&larr;</span>
						<?php echo __( 'Previous Post', 'the-bootstrap' ) ?>
					</a>
				<?php } ?>
			<?php 
				$next_post = get_next_post();
				if (!empty($next_post)) {
			?>
					<a class="pull-right" href="<?php echo get_permalink( $next_post->ID ); ?>" rel="next">
						<?php echo __( 'Next Post', 'the-bootstrap' ) ?>
						<span class="meta-nav">&rarr;</span>
					</a>
				<?php } ?>	
		</nav><!-- #nav-single -->
		
		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */