<?php
/** sidebar-image.php
 *
 * @author  Konstantin Obenland
 * @package The_Bootstrap
 * @since   1.0.0 - 05.02.2012
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php
	tha_sidebar_top();

	if ( ! dynamic_sidebar( 'image' ) ) {
		the_widget( 'The_Bootstrap_Image_Meta_Widget', array(), array(
			'before_widget' => '<aside id="the-bootstrap-image-meta" class="widget well the-bootstrap-image-meta">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	tha_sidebar_bottom(); ?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();


/* End of file sidebar-image.php */
/* Location: ./wp-content/themes/the-bootstrap/sidebar-image.php */