<?php
/** shortcodes.php
 *
 * Bootstrap Scaffolding and Components
 * See: http://twitter.github.com/bootstrap/scaffolding.html
 * See: http://twitter.github.com/bootstrap/components.html
 *
 * @author		Vino Rodrigues
 * @package		The Bootstrap
 * @since		1.8.0 - 07.10.2012
 */


/*
 * Helper functions
 */

function _thsc_fix_atts($atts, $defaults = NULL) {
	if (is_array($atts)) {
			foreach($atts as $name => $value ) {
				if (is_numeric($name)) {
					$atts[$value] = true;
					unset($atts[$name]);
					continue;
				}
			}
		if (!is_null($defaults))
			return shortcode_atts( $defaults, array_change_key_case($atts, CASE_LOWER) );
		else
			return array_change_key_case($atts, CASE_LOWER);
	} else
		return array($atts => true);  // empty array
}

function _thsc_getclass($atts, $class = '') {
	if (isset($atts['first']) && $atts['first']) $class .= ' first';
	if (isset($atts['last']) && $atts['last']) $class .= ' last';
	if (isset($atts['class'])) $class .= ' ' . $atts['class'];
	return ltrim($class, ' ');
}

function _thsc_do_div($class, $content) {
	if (is_null($content)) $content = '';
	return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}

function _thsc_do_span($class, $content) {
	if (is_null($content)) $content = '';
	return '<span class="' . $class . '">' . do_shortcode($content) . '</span>';
}


/*
 * Bootstrap fluid grid system
 */

function _thsc_first($atts) {
	if (isset($atts['first']) && $atts['first']) {
		return '<div class="row-fluid">';
	} else
		return '';
}

function _thsc_last($atts) {
	if (isset($atts['last']) && $atts['last']) {
		return '</div>';
	} else
		return '';
}

function thsc_one_half($atts, $content = null) {
	$atts = _thsc_fix_atts($atts);
	$class = _thsc_getclass($atts, 'span6');
	return _thsc_first($atts) . _thsc_do_div($class, $content) . _thsc_last($atts);
}

function thsc_one_third($atts, $content = null) {
	$atts = _thsc_fix_atts($atts);
	$class = _thsc_getclass($atts, 'span4');
	return _thsc_first($atts) . _thsc_do_div($class, $content) . _thsc_last($atts);
}

function thsc_two_thirds($atts, $content = null) {
	$atts = _thsc_fix_atts($atts);
	$class = _thsc_getclass($atts, 'span8');
	return _thsc_first($atts) . _thsc_do_div($class, $content) . _thsc_last($atts);
}

function thsc_one_fourth($atts, $content = null) {
	$atts = _thsc_fix_atts($atts);
	$class = _thsc_getclass($atts, 'span3');
	return _thsc_first($atts) . _thsc_do_div($class, $content) . _thsc_last($atts);
}

function thsc_three_fourths($atts, $content = null) {
	$atts = _thsc_fix_atts($atts);
	$class = _thsc_getclass($atts, 'span9');
	return _thsc_first($atts) . _thsc_do_div($class, $content) . _thsc_last($atts);
}

add_shortcode( 'one_half', 'thsc_one_half' );
add_shortcode( 'half', 'thsc_one_half' );  // lazy
add_shortcode( 'one_third', 'thsc_one_third' );
add_shortcode( 'third', 'thsc_one_third' );  // lazy
add_shortcode( 'two_thirds', 'thsc_two_thirds' );
add_shortcode( 'one_fourth', 'thsc_one_fourth' );
add_shortcode( 'fourth', 'thsc_one_fourth' );  // lazy
add_shortcode( 'three_fourths', 'thsc_three_fourths' );

/*
 * Bootstrap responsive utility classes
 */

function thsc_visible($atts, $content = null) {
	$atts = _thsc_fix_atts($atts, array(
		'on' => 'all',
		));
	switch (strtolower($atts['on'])) {
		case 'phone': $class = 'visible-phone'; break;
		case 'tablet': $class = 'visible-tablet'; break;
		case 'desktop': $class = 'visible-desktop'; break;
		case 'all': $class = ''; break;
		case 'none': $class = 'hidden'; break;
		default: $class = '';
	}
	$class = _thsc_getclass($atts, $class);
	return _thsc_first($atts) . _thsc_do_span($class, $content) . _thsc_last($atts);
}

function thsc_hidden($atts, $content = null) {
	$atts = _thsc_fix_atts($atts, array(
		'on' => 'none',
		));
	switch (strtolower($atts['on'])) {
		case 'phone': $class = 'hidden-phone'; break;
		case 'tablet': $class = 'hidden-tablet'; break;
		case 'desktop': $class = 'hidden-desktop'; break;
		case 'all': $class = 'hidden'; break;
		case 'none': $class = ''; break;
		default: $class = 'hidden';
	}
	$class = _thsc_getclass($atts, $class);
	return _thsc_first($atts) . _thsc_do_span($class, $content) . _thsc_last($atts);
}

add_shortcode( 'visible', 'thsc_visible');
add_shortcode( 'hidden', 'thsc_hidden' );


/*
 * Buttons
 */

function thsc_button_grp( $atts, $content = null ) {
	$class = _thsc_getclass(_thsc_fix_atts($atts), 'btn-group');
	return _thsc_do_div($class, $content);
}

function thsc_button( $atts, $content = null ) {
	$atts = _thsc_fix_atts($atts, array(
		'link' => '',  // creates a-link
		'size' => '',  // mini, small or large
		'type' => '',  // primary, danger, warning, success, info or inverse
   		'id' => '',
   		'title' => '',
		));
	$class = 'btn';
	switch (strtolower($atts['size'])) {
		case 'mini': $class .= ' btn-mini'; break;
		case 'small': $class .= ' btn-samll'; break;
		case 'large': $class .= ' btn-large'; break;
		default: ;
	}
	switch (strtolower($atts['type'])) {
		case 'primary': $class .= ' btn-primary'; break;
		case 'danger': $class .= ' btn-danger'; break;
		case 'warning': $class .= ' btn-warning'; break;
		case 'success': $class .= ' btn-success'; break;
		case 'info': $class .= ' btn-info'; break;
		case 'inverse': $class .= ' btn-inverse'; break;
		default: ;
	}

	$tag = ($atts['link'] != '') ? 'a' : 'div';
	$button = '<' . $tag;
	if ($atts['link'] != '') $button .= ' href="' . $atts['link'] . '"';
	if ($atts['id'] != '') $button .= ' id="' . $atts['id'] . '"';
	$button .= ' class="' . _thsc_getclass($atts, $class) . '"';
	if ($atts['title'] != '') $button .= ' title="' . $atts['title'] . '"';
	$button .= '>' . do_shortcode($content) . '</' . $tag . '>';
	return $button;
}

add_shortcode( 'button_group', 'thsc_button_grp' );
add_shortcode( 'button', 'thsc_button' );


/*
 * Tabbable nav
 *
 * Uses a few globals:
 *   thsc_tabs
 *   thsc_tabs_init
*/

// TODO : extend code to allow tabbable tabs-below, tabs-right & tabs-below
// TODO : extend code to allow custom id and append class

function thsc_print_tabs_script() {
	global $thsc_tabs_list;
	if (isset($thsc_tabs_list)) {
		echo '<script type="text/javascript">' . PHP_EOL . '/* <![CDATA[ */' . PHP_EOL;
		foreach ($thsc_tabs_list as $tgroup) {
			$src = '(function ($) {' . PHP_EOL;
			$src .= "$('#" . $tgroup . " a').click(function (e) { e.preventDefault(); $(this).tab('show'); })";
			$src .= PHP_EOL . '})(jQuery);';
			echo $src;
		}
		echo PHP_EOL . '/* ]]> */' . PHP_EOL . '</script>' . PHP_EOL;
	}
}

function _do_tab_grp($tabs, $atts = NULL, $tgroup = NULL) {
	if (is_null($tgroup)) {
		global $thsc_tabs_count;
		if (!isset($thsc_tabs_count)) $thsc_tabs_count = 0;
		$thsc_tabs_count++;
		$tgroup = 'tabs' . $thsc_tabs_count;
	}

	// find active tab
	$fndactive = false;
	foreach ($tabs as $tab) {
		if ($tab['active']) {
			$fndactive = true;
			break;
		}
	}
	if (!$fndactive) $tabs[0]['active'] = true;

	// render un-orderd list
	$out = '<ul class="nav nav-tabs" id="' . $tgroup . '">';
	foreach ($tabs as $tab) {
		$class = $tab['active'] ? 'active' : '';

		$out .= '<li' . (($class != '') ? ' class="' . $class . '"' : '') . '>';
		$out .= '<a href="#' . $tab['id'] . '" data-toggle="">';
		$out .= $tab['caption'];
		$out .= '</a>';
		$out .= '</li>';
	}
	$out .= '</ul>';

	// render tab content
	$out .= '<div class="tab-content">';
	foreach ($tabs as $tab) {
		$class = 'tab-pane';
		$class .= $tab['active'] ? ' active' : '';

		$out .= '<div class="' . $class . '" id="' . $tab['id'] . '">';
		$out .= do_shortcode($tab['content']);
		$out .= '</div>';
	}
	$out .= '</div>';

	// Enable via jQuery
	global $thsc_tabs_list;
	if (!isset($thsc_tabs_init)) {
		$thsc_tabs_init = array();
		add_action('wp_footer', 'thsc_print_tabs_script');
	}
	$thsc_tabs_list[] = $tgroup;

	return $out;
}

function thsc_tab_grp( $atts, $content ) {
	global $thsc_tabs;
	if (!isset($thsc_tabs)) $thsc_tabs = array();

	do_shortcode( $content );  // render inner tabs et. al.

	$out = _do_tab_grp($thsc_tabs);

	unset($thsc_tabs);  // kill the global
	return $out;
}

function thsc_tab( $atts, $content ) {
	global $thsc_tabs;

	if (isset($thsc_tabs)) {
		$thsc_tabs[] = array(
			'caption' => $atts['title'],
			'content' => $content,
			'id' => '_' . count($thsc_tabs),
			'active' => false,
			);
	}
	return '';
}

add_shortcode( 'tab_group', 'thsc_tab_grp' );
add_shortcode( 'tab', 'thsc_tab' );


/*
 * Breaks
 */

function thsc_break( $atts, $content = null ) {
	return '<div class="clear"><br /></div>';
}

add_shortcode('break', 'thsc_break');

/*
 * Hero unit & well
 */

function thsc_hero( $atts, $content = null ) {
	return _thsc_do_div(_thsc_getclass(_thsc_fix_atts($atts), 'hero-unit'), $content);
}

function thsc_well( $atts, $content = null ) {
	return _thsc_do_div(_thsc_getclass(_thsc_fix_atts($atts), 'well'), $content);
}

add_shortcode('hero', 'thsc_hero');
add_shortcode('well', 'thsc_well');


/*
 * Inline labels & Badges
 */

function thsc_label( $atts, $content = null ) {
	$atts = _thsc_fix_atts($atts, array(
		'type' => '',  // success, warning, info, important or inverse
		));
	$class = 'label';
	switch (strtolower($atts['type'])) {
		case 'success': $class .= ' label-success'; break;
		case 'warning': $class .= ' label-warning'; break;
		case 'info': $class .= ' label-info'; break;
		case 'important': $class .= ' label-important'; break;
		case 'inverse': $class .= ' label-inverse'; break;
		default: ;
	}

	return _thsc_do_div(_thsc_getclass($atts, $class), $content);
}

function thsc_badge( $atts, $content = null ) {
	$atts = _thsc_fix_atts($atts, array(
		'type' => '',  // success, warning, important, info or inverse
		));
	$class = 'badge';
	switch (strtolower($atts['type'])) {
		case 'success': $class .= ' badge-success'; break;
		case 'warning': $class .= ' badge-warning'; break;
		case 'important': $class .= ' badge-important'; break;
		case 'info': $class .= ' badge-info'; break;
		case 'inverse': $class .= ' badge-inverse'; break;
		default: ;
	}

	return _thsc_do_div(_thsc_getclass($atts, $class), $content);
}

add_shortcode('label', 'thsc_label');
add_shortcode('badge', 'thsc_badge');


/* End of file shortcodes.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/shortcodes.php */
