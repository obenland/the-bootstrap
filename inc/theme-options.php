<?php
/** theme-options.php
 * 
 * The Bootstrap Theme Options
 *
 * @author		Automattic, Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.3.0 - 06.04.2012
 */


/**
 * Properly enqueue styles for theme options page.
 * 
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'the-bootstrap-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '1.3.0' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'the_bootstrap_admin_enqueue_scripts' );


/**
 * Register the form setting for our the_bootstrap_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, the_bootstrap_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_theme_options_init() {

	register_setting(
		'the_bootstrap_options',				// Options group, see settings_fields() call in the_bootstrap_theme_options_render_page()
		'the_bootstrap_theme_options',			// Database option, see the_bootstrap_get_theme_options()
		'the_bootstrap_theme_options_validate'	// The sanitization callback, see the_bootstrap_theme_options_validate()
	);

	// Register settings field group
	add_settings_section(
		'general',								// Unique identifier for the settings section
		'',										// Section title (we don't want one)
		'__return_false',						// Section callback (we don't want anything)
		'theme_options'							// Menu slug, used to uniquely identify the page; see the_bootstrap_theme_options_add_page()
	);

	// Register individual settings fields
	add_settings_field( 'layout', __( 'Default Layout', 'the-bootstrap' ), 'the_bootstrap_settings_field_layout', 'theme_options', 'general' );
}
add_action( 'admin_init', 'the_bootstrap_theme_options_init' );


/**
 * Change the capability required to save the 'the_bootstrap_options' options group.
 *
 * @see		the_bootstrap_theme_options_init()		First parameter to register_setting() is the name of the options group.
 * @see		the_bootstrap_theme_options_add_page()	The edit_theme_options capability is used for viewing the page.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @param	string	$capability	The capability used for the page, which is manage_options by default.
 * 
 * @return	string	The capability to actually use.
 */
function the_bootstrap_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_the_bootstrap_options', 'the_bootstrap_option_page_capability' );


/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'the-bootstrap' ),		// Name of page
		__( 'Theme Options', 'the-bootstrap' ),		// Label in menu
		'edit_theme_options',						// Capability required
		'theme_options',							// Menu slug, used to uniquely identify the page
		'the_bootstrap_theme_options_render_page'	// Function that renders the options page
	);
}
add_action( 'admin_menu', 'the_bootstrap_theme_options_add_page' );


/**
 * Returns the options array for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_get_theme_options() {
	return get_option( 'the_bootstrap_theme_options', the_bootstrap_get_default_theme_options() );
}


/**
 * Returns the default options for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_get_default_theme_options() {
	$default_theme_options	=	array(
		'theme_layout'	=>	'content-sidebar',
	);

	return apply_filters( 'the_bootstrap_default_theme_options', $default_theme_options );
} 


/**
 * Returns an array of layout options registered for Twenty Eleven.
 *
 * @author	WordPress.org
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_layouts() {
	$layout_options	=	array(
		'content-sidebar'	=>	array(
			'label'		=>	__( 'Content on left', 'the-bootstrap' ),
			'thumbnail'	=>	get_template_directory_uri() . '/images/content-sidebar.png',
		),
		'sidebar-content'	=>	array(
			'label'		=>	__( 'Content on right', 'the-bootstrap' ),
			'thumbnail' =>	get_template_directory_uri() . '/images/sidebar-content.png',
		),
	);

	return apply_filters( 'the_bootstrap_layouts', $layout_options );
}
/**
 * Renders the Layout setting field.
 *
 * @author	WordPress.org
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_settings_field_layout() {
	$options	=	the_bootstrap_get_theme_options();
	foreach ( the_bootstrap_layouts() as $value => $layout ) {
		?>
		<label class="image-radio-option">
			<input type="radio" name="the_bootstrap_theme_options[theme_layout]" value="<?php echo esc_attr( $value ); ?>" <?php checked( $options['theme_layout'], $value ); ?> />
			<div class="image-radio-label">
				<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
				<span class="description"><?php echo $layout['label']; ?></span>
			</div>
		</label>
		<?php
	}
}


/**
 * Renders the Settings page for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php esc_html_e( 'The Bootstrap Theme Options', 'the-bootstrap' ); ?></h2>
		<?php settings_errors(); ?>

		<div id="poststuff">
			<div id="post-body" class="the-bootstrap columns-2">
				<div id="post-body-content">
					<form method="post" action="options.php">
						<?php
							settings_fields( 'the_bootstrap_options' );
							do_settings_sections( 'theme_options' );
							submit_button();
						?>
					</form>
				</div>
				<div id="postbox-container-1">
					<div id="side-info-column" class="inner-sidebar">
						<?php do_action( 'the_bootstrap_side_info_column' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}


/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see the_bootstrap_theme_options_init()
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_theme_options_validate( $input ) {
	$output = $defaults = the_bootstrap_get_default_theme_options();

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], the_bootstrap_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	return apply_filters( 'the_bootstrap_theme_options_validate', $output, $input, $defaults );
}


///////////////////////////////////////////////////////////////////////////////
// META BOXES
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays a box with a donate button and call to action links
 * 
 * Props Joost de Valk, as this is almost entirely from his awesome WordPress
 * SEO Plugin
 *
 * @author	Konstantin Obenland
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_donate_box() {
	?>
	<div id="formatdiv" class="postbox">
		<h3 class="hndle"><span><?php esc_html_e( 'Help spread the word!', 'the-bootstrap' ); ?></span></h3>
		<div class="inside">
			<p><strong><?php printf( _x( 'Want to help make this Theme even better? All donations are used to improve %1$s, so donate $20, $50 or $100 now!', 'Plugin Name', 'the-bootstrap' ), esc_html('The Bootstrap ') ); ?></strong></p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="542W6XT4PLT4L">
				<input type="image" src="https://www.paypalobjects.com/<?php echo get_locale(); ?>/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal">
				<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
			</form>
			<p><?php _e( 'Or you could:', 'the-bootstrap' ); ?></p>
			<ul>
				<li><a href="http://wordpress.org/extend/themes/the-bootstrap"><?php _e( 'Rate the Theme 5&#9733; on WordPress.org', 'the-bootstrap' ); ?></a></li>
				<li><a href="http://en.wp.obenland.it/the-bootstrap/"><?php _e( 'Blog about it &amp; link to the Theme page', 'the-bootstrap' ); ?></a></li>
			</ul>
		</div>
	</div>
	<?php
}
add_action( 'the_bootstrap_side_info_column', 'the_bootstrap_donate_box', 1 );


/**
 * Displays a box with feed items and social media links
 * 
 * Props Joost de Valk, as this is almost entirely from his awesome WordPress
 * SEO Plugin
 *
 * @author	Konstantin Obenland
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_feed_box() {
	$rss_items = _the_bootstrap_fetch_feed( 'http://en.wp.obenland.it/feed/' );
	?>
	<div id="formatdiv" class="postbox">
		<h3 class="hndle"><span><?php esc_html_e( 'News from Konstantin', 'the-bootstrap' ); ?></span></h3>
		<div class="inside">
			<ul>
			<?php if ( ! $rss_items ) : ?>
			<li><?php _e( 'No news items, feed might be broken...', 'the-bootstrap' ); ?></li>
			<?php else :
			foreach ( $rss_items as $item ) :
				$url = preg_replace( '/#.*/', '#utm_source=wordpress&utm_medium=sidebannerpostbox&utm_term=rssitem&utm_campaign=the-bootstrap',  $item->get_permalink() ); ?>
			<li><a class="rsswidget" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $item->get_title() ); ?></a></li>
			<?php endforeach; endif; ?>
				<li class="twitter"><a href="http://twitter.com/obenland"><?php _e( 'Follow Konstantin on Twitter', 'the-bootstrap' ); ?></a></li>
				<li class="rss"><a href="http://en.wp.obenland.it/feed/"><?php _e( 'Subscribe via RSS', 'the-bootstrap' ); ?></a></li>
			</ul>
		</div>
	</div>
	<?php
}
add_action( 'the_bootstrap_side_info_column', 'the_bootstrap_feed_box' );


/**
 * Callback function to get feed items
 * 
 * @author	Konstantin Obenland
 * @since	1.3.0 - 06.04.2012
 * @access	private
 * 
 * @param	string		$feed_url
 * 
 * @return	bool|array	Array with feed items on success
 */
function _the_bootstrap_fetch_feed( $feed_url ) {
	include_once( ABSPATH . WPINC . '/feed.php' );
	$rss = fetch_feed( $feed_url );
	
	// Bail if feed doesn't work
	if ( is_wp_error( $rss ) ) {
		return false;
	}
	
	$rss_items = $rss->get_items( 0, $rss->get_item_quantity( 5 ) );
	
	// If the feed was erroneously
	if ( ! $rss_items ) {
		$md5 = md5( $feed_url );
		delete_transient( 'feed_' . $md5 );
		delete_transient( 'feed_mod_' . $md5 );
		$rss = fetch_feed( $feed_url );
		$rss_items = $rss->get_items( 0, $rss->get_item_quantity( 5 ) );
	}
	return $rss_items;
}


///////////////////////////////////////////////////////////////////////////////
// FRONT END
///////////////////////////////////////////////////////////////////////////////

/**
 * Adds The Bootstrap layout classes to the array of body classes.
 *
 * @author	WordPress.org
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_layout_classes( $existing_classes ) {
	$options		=	the_bootstrap_get_theme_options();
	$current_layout	=	$options['theme_layout'];

	$classes = array( $current_layout );
	$classes = apply_filters( 'twentyeleven_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'the_bootstrap_layout_classes' );


/* End of file theme-options.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/theme-options.php */
