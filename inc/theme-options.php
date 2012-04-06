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
	add_settings_field(
		'sample_checkbox',						// Unique identifier for the field for this section
		__( 'Sample Checkbox', 'the-bootstrap' ),	// Setting field label
		'the_bootstrap_settings_field_sample_checkbox',	// Function that renders the settings field
		'theme_options',						// Menu slug, used to uniquely identify the page; see the_bootstrap_theme_options_add_page()
		'general'								// Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'the-bootstrap' ), 'the_bootstrap_settings_field_sample_text_input', 'theme_options', 'general' );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'the-bootstrap' ), 'the_bootstrap_settings_field_sample_select_options', 'theme_options', 'general' );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'the-bootstrap' ), 'the_bootstrap_settings_field_sample_radio_buttons', 'theme_options', 'general' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'the-bootstrap' ), 'the_bootstrap_settings_field_sample_textarea', 'theme_options', 'general' );
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
 * Returns an array of sample select options registered for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'the-bootstrap' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'the-bootstrap' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'the-bootstrap' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'the-bootstrap' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'the-bootstrap' )
		),
		'5' => array(
			'value' => '3',
			'label' => __( 'Five', 'the-bootstrap' )
		)
	);

	return apply_filters( 'the_bootstrap_sample_select_options', $sample_select_options );
}


/**
 * Returns an array of sample radio options registered for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 * 
 * @return	void
 */
function the_bootstrap_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'the-bootstrap' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'the-bootstrap' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'the-bootstrap' )
		)
	);

	return apply_filters( 'the_bootstrap_sample_radio_buttons', $sample_radio_buttons );
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
	$default_theme_options = array(
		'sample_checkbox' => 'off',
		'sample_text_input' => '',
		'sample_select_options' => '',
		'sample_radio_buttons' => '',
		'sample_textarea' => '',
	);

	return apply_filters( 'the_bootstrap_default_theme_options', $default_theme_options );
} 


/**
 * Renders the sample checkbox setting field.
 */
function the_bootstrap_settings_field_sample_checkbox() {
	$options = the_bootstrap_get_theme_options();
	?>
	<label for"sample-checkbox">
		<input type="checkbox" name="the_bootstrap_theme_options[sample_checkbox]" id="sample-checkbox" <?php checked( 'on', $options['sample_checkbox'] ); ?> />
		<?php _e( 'A sample checkbox.', 'the-bootstrap' );  ?>
	</label>
	<?php
}


/**
 * Renders the sample text input setting field.
 */
function the_bootstrap_settings_field_sample_text_input() {
	$options = the_bootstrap_get_theme_options();
	?>
	<input type="text" name="the_bootstrap_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'the-bootstrap' ); ?></label>
	<?php
}


/**
 * Renders the radio options setting field.
 *
 * @since The Bootstrap 1.0
 */
function the_bootstrap_settings_field_sample_radio_buttons() {
	$options = the_bootstrap_get_theme_options();

	foreach ( the_bootstrap_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="the_bootstrap_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Renders the sample textarea setting field.
 */
function the_bootstrap_settings_field_sample_textarea() {
	$options = the_bootstrap_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="the_bootstrap_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'the-bootstrap' ); ?></label>
	<?php
}


/**
 * Returns the options array for The Bootstrap.
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

	// The sample checkbox should either be on or off
	if ( ! isset( $input['sample_checkbox'] ) )
		$input['sample_checkbox'] = 'off';
	$output['sample_checkbox'] = ( $input['sample_checkbox'] == 'on' ? 'on' : 'off' );

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( array_key_exists( $input['sample_select_options'], the_bootstrap_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], the_bootstrap_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses($input['sample_textarea'] );

	return apply_filters( 'the_bootstrap_theme_options_validate', $output, $input, $defaults );
}


/**
 * Displays style tag with setting page styles
 * 
 * @author	Konstantin Obenland
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_settings_page_styles() {
	?>
	<style type="text/css">
		#poststuff #post-body.columns-2 {
		    margin-right: 300px;
		}
		#post-body.columns-2 #postbox-container-1 {
		    float: right;
		    margin-right: -300px;
		    width: 280px;
		}
		#post-body-content {
			float: left;
			width: 100%;
		}
		.the-bootstrap div.inside li {
			list-style: square outside none;
			margin-left: 20px;
		}
		.the-bootstrap div.inside li.rss,
		.the-bootstrap div.inside li.twitter {
			background: none no-repeat scroll 0 0 transparent;
			list-style-type: none;
		    margin-left: 0;
		    padding-left: 20px;
		}
		.the-bootstrap div.inside li.rss {
			background-image: url("<?php echo esc_url( get_template_directory_uri() . '/images/rss.png' ); ?>");
		}
		.the-bootstrap div.inside li.twitter {
			background-image: url("<?php echo esc_url( get_template_directory_uri() . '/images/twitter.png' ); ?>");
		}
		@media (max-width: 939px) {
			#postbox-container-1 {
				float: none !important;
			}
		}
	</style>
	<?php
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'the_bootstrap_settings_page_styles' );


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


/* End of file theme-options.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/theme-options.php */
