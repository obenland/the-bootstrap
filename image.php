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

$attachments = array_values( get_children( array(
	'post_parent'		=>	$post->post_parent,
	'post_status'		=>	'inherit',
	'post_type'			=>	'attachment',
	'post_mime_type'	=>	'image',
	'order'				=>	'ASC',
	'orderby'			=>	'menu_order ID'
)));

$total_images = count($attachments);

//Get position of current pic
foreach ( $attachments as $k => $attachment ) {
	if ( $attachment->ID == $post->ID )
		break;
}

the_post();
?>

<section id="primary" class="image-attachment span12">
	<div id="content" role="main">

		<nav id="nav-single" class="well clearfix">
			<span class="gallery-link pull-left">
				<a href="<?php echo get_permalink( $post->post_parent ); ?>">
				<?php printf(
					'&laquo; %1$s (%2$s)',
					get_the_title($post->post_parent),
					sprintf(
						'%d %s',
						$total_images,
						_n('image', 'images', $total_images, 'the-bootstrap')
					)
				); ?>
				</a>
			</span>
			<span class="nav-links pull-right">
				<?php
				edit_post_link( __( 'Edit', 'the-bootstrap' ), ' <span class="edit-link label">', '</span><span class="sep">&nbsp;</span>' );
				$reply	=	__( 'Leave a comment', 'the-bootstrap' );
				comments_popup_link( $reply, $reply );
				if ( isset($attachments[$k-1]) )
					echo ' &mdash; <a href="' . get_permalink( $attachments[$k-1]->ID ) . '">' . __( '&laquo; Previous Photo', 'the-bootstrap' ) . '</a>';
				if ( isset($attachments[$k+1]) )
					echo ' &mdash; <a href="' . get_permalink( $attachments[$k+1]->ID ) . '">' . __( 'Next Photo &raquo;', 'the-bootstrap' ) . '</a>';
				?>
			</span>
		</nav><!-- #nav-single -->

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content entry-attachment">
				<figure class="attachment">
					<?php
						// If there is more than 1 attachment in a gallery
						if ( $total_images > 1 ) {
							if ( isset( $attachments[ ++$k ] ) ) {
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							}
							else {
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							}
						} else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
					?>
					<a href="<?php echo $next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment" class="thumbnail">
						<?php echo wp_get_attachment_image( $post->ID, 'full', false, array( 'class' => '' ) ); ?>
					</a>

					<?php if ( $post->post_excerpt ) : ?>
					<figcaption class="entry-caption">
						<?php the_excerpt(); ?>
					</figcaption>
					<?php endif; ?>
				</figure><!-- .attachment -->
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- #content -->
</section><!-- #primary -->
<div class="span8"><?php comments_template( '', true ); ?></div>
<?php
get_sidebar( 'image' );
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */