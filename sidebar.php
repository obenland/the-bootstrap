<?php
/** sidebar.php
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0	- 05.02.2012
 */
?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php if ( ! dynamic_sidebar( 'main' ) ) : ?>

		<aside id="archives" class="widget well">
			<h2 class="widget-title"><?php _e( 'Archives', 'the-bootstrap' ); ?></h2>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget well">
			<h2 class="widget-title"><?php _e( 'Meta', 'the-bootstrap' ); ?></h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</section><!-- #secondary .widget-area -->
<?php


/* End of file sidebar.php */
/* Location: ./wp-content/themes/the-bootstrap/sidebar.php */