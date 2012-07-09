<?php
/** image.php
 *
 * The template for displaying image attachments.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header();

$the_bootstrap_attachments = array_values( get_children( array(
	'post_parent'		=>	$post->post_parent,
	'post_status'		=>	'inherit',
	'post_type'			=>	'attachment',
	'post_mime_type'	=>	'image',
	'order'				=>	'ASC',
	'orderby'			=>	'menu_order ID'
)));

$the_bootstrap_total_images = count( $the_bootstrap_attachments );

//Get position of current pic
foreach ( $the_bootstrap_attachments as $the_bootstrap_k => $the_bootstrap_attachment ) {
	if ( $the_bootstrap_attachment->ID == $post->ID )
		break;
}

the_post();
?>

<section id="primary" class="image-attachment span12">

	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top(); ?>

		<nav id="nav-single" class="well clearfix">
			<span class="gallery-link pull-left">
				<a href="<?php echo get_permalink( $post->post_parent ); ?>">
				<?php printf(
					'&laquo; %1$s (%2$s)',
					get_the_title( $post->post_parent ),
					sprintf(
						'%d %s',
						$the_bootstrap_total_images,
						_n( 'image', 'images', $the_bootstrap_total_images, 'the-bootstrap' )
					)
				); ?>
				</a>
			</span>
			<span class="nav-links pull-right">
				<?php
				edit_post_link( __( 'Edit', 'the-bootstrap' ), ' <span class="edit-link label">', '</span><span class="sep">&nbsp;</span>' );
				$reply	=	__( 'Leave a comment', 'the-bootstrap' );
				comments_popup_link( $reply, $reply );
				if ( isset($the_bootstrap_attachments[$the_bootstrap_k-1]) )
					echo ' &mdash; <a href="' . get_permalink( $the_bootstrap_attachments[$the_bootstrap_k-1]->ID ) . '">' . __( '&laquo; Previous Photo', 'the-bootstrap' ) . '</a>';
				if ( isset($the_bootstrap_attachments[$the_bootstrap_k+1]) )
					echo ' &mdash; <a href="' . get_permalink( $the_bootstrap_attachments[$the_bootstrap_k+1]->ID ) . '">' . __( 'Next Photo &raquo;', 'the-bootstrap' ) . '</a>';
				?>
			</span>
		</nav><!-- #nav-single -->

		<?php tha_entry_before(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php tha_entry_top(); ?>
			<div class="entry-content entry-attachment">
				<figure class="attachment">
					<?php
						// If there is more than 1 attachment in a gallery
						if ( $the_bootstrap_total_images > 1 ) {
							if ( isset( $the_bootstrap_attachments[ ++$the_bootstrap_k ] ) ) {
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $the_bootstrap_attachments[ $the_bootstrap_k ]->ID );
							}
							else {
								// or get the URL of the first image attachment
								$the_bootstrap_next_attachment_url = get_attachment_link( $the_bootstrap_attachments[ 0 ]->ID );
							}
						} else {
							// or, if there's only 1 image, get the URL of the image
							$the_bootstrap_next_attachment_url = wp_get_attachment_url();
						}
					?>
					<a href="<?php echo $the_bootstrap_next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment" class="thumbnail">
						<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
					</a>

					<?php if ( $post->post_excerpt ) : ?>
					<figcaption class="entry-caption">
						<?php the_excerpt(); ?>
					</figcaption>
					<?php endif; ?>
				</figure><!-- .attachment -->
			</div><!-- .entry-content -->
			<?php tha_entry_bottom(); ?>
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php tha_entry_after(); ?>
		
		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->
<div id="attachment-comment" class="span8"><?php comments_template(); ?></div>
<?php
get_sidebar( 'image' );
get_footer();


/* End of file image.php */
/* Location: ./wp-content/themes/the-bootstrap/image.php */