<?php
/** the-bootstrap-gallery-widget.php
 *
 * @author	Konstantin Obenland
 * @package	The Bootstrap
 * @since	1.1.0 - 08.03.2012
 */


class The_Bootstrap_Gallery_Widget extends WP_Widget {


	///////////////////////////////////////////////////////////////////////////
	// METHODS, PUBLIC
	///////////////////////////////////////////////////////////////////////////
	
	/**
	 * Constructor
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @return	The_Bootstrap_Gallery_Widget
	 */
	public function __construct() {
		
		parent::__construct( 'the-bootstrap-gallery', __( 'The Bootstrap Gallery Widget', 'the-bootstrap' ), array(
			'classname'		=>	'the-bootstrap-gallery',
			'description'	=>	__( 'Displays gallery images of a specified post with the Gallery post format.', 'the-bootstrap' )
		) );
	}


	/**
	 * Displays the widget content
	 *
	 * @author	Konstantin Obeland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$args
	 * @param	array	$instance
	 *
	 * @return	void
	 */
	public function widget( $args, $instance ) {
		if ( ! has_post_format( 'gallery', $instance['post_id'] ) ) return;

		$attachments = get_children( array(
			'post_parent'		=>	$instance['post_id'],
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	'ASC',
			'orderby'			=>	'menu_order ID',
		) );
		if ( empty( $attachments ) ) return;
		
		extract( $args );
		
		echo   str_replace( 'well ', '', $before_widget );
		
		if ( $title = get_the_title( $instance['post_id'] ) )
			echo $before_title . '<a href="' . get_permalink( $instance['post_id'] ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), strip_tags( $title ) ) . '" rel="bookmark">' . $title . '</a>' . $after_title;
		?>
		<div id="sidebar-gallery-slider" class="carousel slide">

			<!-- Carousel items -->
			<div class="carousel-inner">
				<?php foreach ( $attachments as $attachment ) : ?>
				<figure class="item">
					<?php echo wp_get_attachment_image( $attachment->ID, array( 370, 278 ) ); 
					if ( has_excerpt( $attachment->ID ) ) : ?>
					<figcaption class="carousel-caption">
						<h4><?php echo get_the_title( $attachment->ID ); ?></h4>
						<p><?php echo apply_filters( 'get_the_excerpt', $attachment->post_excerpt ); ?></p>
					</figcaption>
					<?php endif; ?>
				</figure>
				<?php endforeach; ?>
			</div><!-- .carousel-inner -->
		
			<!-- Carousel nav -->
			<a class="carousel-control left" href="#sidebar-gallery-slider" data-slide="prev"><?php _ex( '&lsaquo;', 'carousel-control', 'the-bootstrap' ); ?></a>
			<a class="carousel-control right" href="#sidebar-gallery-slider" data-slide="next"><?php _ex( '&rsaquo;', 'carousel-control', 'the-bootstrap' ); ?></a>
		</div><!-- #sidebar-gallery-slider .carousel .slide -->
		<?php
		
		echo $after_widget;
	}

	
	/**
	 * Updates the widget settings
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$new_instance
	 * @param	array	$old_instance
	 *
	 * @return	array
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance				=	$old_instance;
		$instance['post_id']	=	absint( $new_instance['post_id'] );

		return $instance;
	}

	
	/**
	 * Displays the widget's settings form
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$instance
	 *
	 * @return	void
	 */
	public function form( $instance ) {
		$instance	=	wp_parse_args( (array) $instance, array(
			'post_id'	=>	0,
		) );
		$gallery_posts = get_posts( array(
			'numberposts'	=>	-1,
			'tax_query'		=>	array(
				array(
					'taxonomy'	=>	'post_format',
					'field'		=>	'slug',
					'terms'		=>	array( 'post-format-gallery' )
				)
			)
		) );
		
		if ( empty( $gallery_posts ) ) {
			echo '<p class="description">'. sprintf( __( 'No galleries have been created yet. <a href="%s">Create some</a>.', 'the-bootstrap' ), admin_url( 'post-new.php' ) ) . '</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Select Gallery:', 'the-bootstrap' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'post_id' ); ?>" id="<?php echo $this->get_field_id( 'post_id' ); ?>" class="widefat">
				<?php foreach ( $gallery_posts as $gallery_post ) {
					echo '<option value="' . $gallery_post->ID . '"' . selected( $instance['post_id'], $gallery_post->ID ) .'>' . $gallery_post->post_title . '</option>';
				} ?>
			</select>
		</p>
		<?php
	}
} // End of class The_Bootstrap_Gallery_Widget



/* End of file the-bootstrap-gallery-widget.php */
/* Location: ./wp-content/themes/the-bootstrap/the-bootstrap-gallery-widget.php */