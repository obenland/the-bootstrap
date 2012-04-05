<?php
/** footer.php
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0	- 05.02.2012
 */
?>
				<footer id="colophon" role="contentinfo" class="span12">
					<div id="page-footer" class="well clearfix">
						<?php
						printf(
							__('&copy; %1$s <a href="%2$s">%3$s</a>, all rights reserved.', 'the-bootstrap'),
							date( 'Y' ),
							home_url( '/' ),
							get_bloginfo( 'name' )
						); ?>
						<div id="site-generator">
							<a	href="<?php echo esc_url( __( 'http://wordpress.org/', 'the-bootstrap' ) ); ?>"
								title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'the-bootstrap' ); ?>"
								target="_blank"
								rel="generator">
								<?php printf( _x( 'Proudly powered by %s', 'WordPress', 'the-bootstrap' ), 'WordPress' ); ?>
							</a>
						</div>
					</div>
				</footer><!-- #colophon -->
			</div><!-- #page -->
		</div><!-- .container -->
	<!-- <?php printf( __( '%d queries. %s seconds.', 'the-bootstrap' ), get_num_queries(), timer_stop(0, 3) ); ?> -->
	<?php wp_footer(); ?>
	</body>
</html>
<?php


/* End of file footer.php */
/* Location: ./wp-content/themes/the-bootstrap/footer.php */