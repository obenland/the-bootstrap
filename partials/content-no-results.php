<?php
/** content-no-results.php
 *
 * The template for displaying a 'Noting found' message.
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */
?>
<article id="post-0" class="post no-results not-found">
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
</article><!-- #post-0 -->
<?php


/* End of file no-results.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-no-results.php */