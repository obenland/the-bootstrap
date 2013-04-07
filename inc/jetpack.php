<?php
/**
 * Jetpack Compatibility File.
 * See: http://jetpack.me/
 *
 * @package The_Bootstrap
 * @since   2.1.0 - 07.04.2013
 */

/**
 * Add theme support for Infinite Scroll.
 * @see http://jetpack.me/support/infinite-scroll/
 *
 * @return void
 */
function the_bootstrap_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'render'    => 'the_bootstrap_infinite_scroll_render',
		'footer'    => 'colophon',
	) );
}
add_action( 'after_setup_theme', 'the_bootstrap_jetpack_setup' );

/**
 * Set the code to be rendered on for calling posts, hooked to template parts.
 * Note: Must define a loop.
 *
 * @return void
 */
function the_bootstrap_infinite_scroll_render() {
	while ( have_posts() ) :
		the_post();
		get_template_part( '/partials/content', get_post_format() );
	endwhile;
}


/* End of file jetpack.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/jetpack.php */