<?php
/** content.php
 *
 * The default template for displaying content
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<header class="page-header">
	<?php if ( is_sticky() AND is_home() ) : ?>
		<hgroup>
			<?php the_title( '<h1 class="entry-title"><a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<h3 class="entry-format"><?php _e( 'Featured', 'the-bootstrap' ); ?></h3>
		</hgroup>
	<?php
		else :
			the_title( '<h1 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h1>' );
		endif;
		
		if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_bootstrap_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary clearfix">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content clearfix">
		<?php if ( has_post_thumbnail() ) : ?>
		<a class="thumbnail post-thumbnail span2" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</a>
		<?php endif;
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) );
		the_bootstrap_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php
		$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'the-bootstrap' ) );

		if ( 'post' == get_post_type() AND $categories_list ) // Hide category text for pages on Search
			printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'the-bootstrap' ) . '</span>', $categories_list );
		?>
	</footer><!-- #entry-meta -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content.php */