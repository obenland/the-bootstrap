<?php
/** content-gallery.php
 *
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<hgroup>
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() .'" title="<' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<h3 class="entry-format"><?php echo get_post_format_string(get_post_format()); ?></h3>
		</hgroup>

		<div class="entry-meta">
			<?php the_bootstrap_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	
	<div class="entry-content clearfix">
		<?php
			$images = get_children( array(
				'post_parent'		=>	$post->ID,
				'post_type'			=>	'attachment',
				'post_mime_type'	=>	'image',
				'orderby'			=>	'menu_order',
				'order'				=>	'ASC',
				'numberposts'		=>	999
			) );
			if ( $images ) :
				$total_images	=	count( $images );
				$image			=	array_shift( $images );
				?>

				<figure class="gallery-thumb row">
					
					<figcaption class="span4">
						<?php the_excerpt(); ?>
				
						<p class="gallery-meta">
							<em>
							<?php
							printf(
								_n( 'This gallery contains <strong>%1$s photo</strong>.', 'This gallery contains <strong>%1$s photos</strong>.', $total_images, 'the-bootstrap' ),
								number_format_i18n( $total_images )
							); ?>
							</em>
						</p>
					</figcaption>
					<a class="span4 thumbnail" href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $image->ID, array( 370, 1024 ) ); ?></a>
				</figure><!-- .gallery-thumb -->
			<?php endif; /* if images */ ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php


/* End of file content-gallery.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-gallery.php */