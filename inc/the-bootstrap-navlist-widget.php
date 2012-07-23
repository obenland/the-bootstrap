<?php
/** navlists.php
 *
 * Bootstrap Nav Lists, great for sidebars
 * See: http://twitter.github.com/bootstrap/components.html
 * Based on WordPress code from ./wp-includes/efault-widgets.php
 *
 * @author		Vino Rodrigues
 * @package		The Bootstrap
 * @since		1.8.0 - 07.23.2012
 */


/**
 * Nav List widget class
 *
 * @since 1.8.0
 */
class The_Bootstrap_Navlist_Widget extends WP_Widget {


	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'the-bootstrap-navlist', __( 'The Bootstrap Nav List Widget', 'the-bootstrap' ), array(
			'classname'   => 'the-bootstrap-navlist',
			'description' => __( 'Displays a menu as a Bootstap Nav List', 'the-bootstrap' )
		) );

	}

	/**
	 * Displays the widget content
	 *
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		$title = ( !empty($instance['title']) ) ? trim($instance['title']) : '';

		wp_nav_menu( array(
			'container' => false,
			'fallback_cb' => '',
			'menu' => $nav_menu,
			'items_wrap' => '<ul id="%1$s" class="nav nav-list %2$s">' . (( !empty($title) ) ? '<li class="nav-header">' . $title . '</li>' : '') . '%3$s</ul>',
			'depth' => 1,
		) );

		echo $args['after_widget'];
	}

	/**
	 * Updates the widget settings
	 *
	 * @param	array	$new_instance
	 * @param	array	$old_instance
	 * @return	array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	/**
	 * Displays the widget's settings form
	 *
	 * @param	array	$instance
	 * @return	void
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}  // class The_Bootstrap_Navlist_Widget

/* End of file the-bootstrap-navlist-widget.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/the-bootstrap-navlist-widget.php */