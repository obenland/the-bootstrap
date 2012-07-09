<?php
/** content-not-found.php
 *
 * The template for displaying a 'Nothing found' message.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-0" class="post no-results not-found">
	<?php tha_entry_top(); ?>
	
	<header class="page-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'the-bootstrap' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_search() ): ?>
		<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'the-bootstrap' ); ?></p>
		<?php else: ?>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'the-bootstrap' ); ?></p>
		<?php get_search_form();
		endif;?>
	</div><!-- .entry-content -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-0 -->
<?php tha_entry_after();


/* End of file content-not-found.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-not-found.php */