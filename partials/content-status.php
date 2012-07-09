<?php
/** content-status.php
 *
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'well' ); ?>>
	<?php tha_entry_top(); ?>
	
	<div class="entry-content row">
		<div class="thumbnail avatar span1"><?php echo get_avatar( get_the_author_meta( 'email' ), apply_filters( 'the-bootstrap_status_avatar', 70 ) ); ?></div>
		<div class="offset1">
			<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) );
			the_bootstrap_link_pages(); ?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php the_bootstrap_posted_on(); ?>
	</footer><!-- .entry-footer -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-status.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-status.php */