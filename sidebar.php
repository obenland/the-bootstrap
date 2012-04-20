<?php
/** sidebar.php
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0	- 05.02.2012
 */
?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php if ( ! dynamic_sidebar( 'main' ) ) {
		the_widget( 'WP_Widget_Archives', array(), array(
			'before_widget'	=>	'<aside id="archives" class="widget well widget_archives">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<h3 class="widget-title">',
			'after_title'	=>	'</h3>',
		) );
		the_widget( 'WP_Widget_Meta', array(), array(
			'before_widget'	=>	'<aside id="meta" class="widget well widget_meta">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<h3 class="widget-title">',
			'after_title'	=>	'</h3>',
		) );
	} // end sidebar widget area ?>
</section><!-- #secondary .widget-area -->
<?php


/* End of file sidebar.php */
/* Location: ./wp-content/themes/the-bootstrap/sidebar.php */