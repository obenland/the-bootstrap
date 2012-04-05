<?php
/** functions.php
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

if ( ! function_exists( 'the_bootstrap_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_setup() {

	if ( ! isset( $content_width ) ) {
		$content_width = 770;
	}
	
	load_theme_textdomain( 'the-bootstrap', get_template_directory() . '/lang' );
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-formats', array(
		'aside',
		'chat',
		'link',
		'gallery',
		'status',
		'quote',
		'image',
		'video'
	) );

	add_custom_background();
	
	register_nav_menu( 'primary', __( 'Main Navigation', 'the-bootstrap' ) );
	
} // the_bootstrap_setup
endif;
add_action( 'after_setup_theme', 'the_bootstrap_setup' );


/**
 * Register the sidebars.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_widgets_init() {

	register_sidebar( array(
		'name'			=>	__( 'Main Sidebar', 'the-bootstrap' ),
		'id'			=>	'main',
		'before_widget'	=>	'<aside id="%1$s" class="widget well %2$s">',
		'after_widget'	=>	"</aside>",
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=>	'</h2>',
	) );
	
	register_sidebar( array(
		'name'			=>	__( 'Image Sidebar', 'the-bootstrap' ),
		'id'			=>	'image',
		'before_widget'	=>	'<aside id="%1$s" class="widget well %2$s">',
		'after_widget'	=>	"</aside>",
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=>	'</h2>',
	) );

	include_once( 'inc/the-bootstrap-image-meta-widget.php' );
	register_widget( 'The_Bootstrap_Image_Meta_Widget' );
}
add_action( 'widgets_init', 'the_bootstrap_widgets_init' );


/**
 * Registration of theme scripts and styles
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_register_scripts_styles() {

	if ( ! is_admin() ) {
		$theme_data = get_theme_data( get_template_directory() . '/style.css' );
		$suffix = ( defined('SCRIPT_DEBUG') AND SCRIPT_DEBUG ) ? '' : '.min';
			
		/**
		 * Scripts
		 */
		wp_register_script(
			'tw-bootstrap',
			get_template_directory_uri() . "/js/bootstrap{$suffix}.js",
			array('jquery'),
			'2.0.2',
			true
		);
		
		wp_register_script(
			'the-bootstrap',
			get_template_directory_uri() . "/js/the-bootstrap{$suffix}.js",
			array('jquery'),
			$theme_data['Version'],
			true
		);
				
		/**
		 * Styles
		 */
		wp_register_style(
			'tw-bootstrap',
			get_template_directory_uri() . "/css/bootstrap{$suffix}.css",
			array(),
			'2.0.2'
		);
		
		wp_register_style(
			'the-bootstrap',
			get_template_directory_uri() . "/style{$suffix}.css",
			array('tw-bootstrap'),
			$theme_data['Version']
		);
	}
}
add_action( 'init', 'the_bootstrap_register_scripts_styles' );


/**
 * Properly enqueue frontend scripts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_print_scripts() {
	wp_enqueue_script( 'tw-bootstrap' );
	wp_enqueue_script( 'the-bootstrap' );

	if ( is_singular() AND comments_open() AND get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'the_bootstrap_print_scripts' );


/**
 * Properly enqueue frontend styles
 *
 * Since 'tw-bootstrap' was registered as a dependency, it'll get enqueued
 * automatically
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_print_styles() {
	wp_enqueue_style( 'the-bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'the_bootstrap_print_styles' );


/**
 * Display navigation to next/previous pages when applicable
 *
 * To be honest - I'm pretty proud of this function. Through a lot of trial and
 * error, I was able to user a core WordPress function (paginate_links()) and
 * adjust it in a way, that the end result is a legitimate pagination.
 * A pagination many developers buy (code) expensively with Plugins like
 * WP Pagenavi. No need! WordPress has it all!
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_content_nav() {
	global $wp_query;

	$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link	=	get_pagenum_link();
	$url_parts		=	parse_url( $pagenum_link );
	$format			=	( get_option('permalink_structure') ) ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
	
	if ( isset($url_parts['query']) ) {
		$pagenum_link	=	"{$url_parts['scheme']}://{$url_parts['host']}{$url_parts['path']}%_%?{$url_parts['query']}";
	} else {
		$pagenum_link	.=	'%_%';
	}
	
	$links	=	paginate_links( array(
		'base'		=>	$pagenum_link,
		'format'	=>	$format,
		'total'		=>	$wp_query->max_num_pages,
		'current'	=>	$paged,
		'mid_size'	=>	3,
		'type'		=>	'list'
	) );
	
	if ( $links ) {
		echo "<nav class=\"pagination pagination-centered\">{$links}</nav>";
	}
}

if ( ! function_exists( 'the_bootstrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
 * comment and edit link
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$args
 *
 * @return	void|string
 */
function the_bootstrap_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'the-bootstrap' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'the-bootstrap' ), get_the_author() ) ),
		get_the_author()
	);
	if ( comments_open() AND ! post_password_required() ) { ?>
		<span class="sep"> | </span>
		<span class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'the-bootstrap' ) . '</span>', __( '<strong>1</strong> Reply', 'the-bootstrap' ), __( '<strong>%</strong> Replies', 'the-bootstrap' ) ); ?>
		</span>
		<?php
	}
	edit_post_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' );
}
endif;


if ( ! function_exists( 'the_bootstrap_link_pages' ) ) :
/**
 * Displays page links for paginated posts
 *
 * It's basically the wp_link_pages() function, altered to fit to the Bootstrap
 * markup needs for paginations (unordered list).
 * @see		wp_link_pages()
 *
 * @author	Konstantin Obenland
 * @since	1.1.0 - 09.03.2012
 *
 * @param	array	$args
 *
 * @return	void|string
 */
function the_bootstrap_link_pages( $args = array() ) {
	wp_link_pages( array( 'echo' => 0 ));
	$defaults = array(
		'next_or_number'	=> 'number',
		'nextpagelink'		=> __('Next page', 'the-bootstrap'),
		'previouspagelink'	=> __('Previous page', 'the-bootstrap'),
		'pagelink'			=> '%',
		'echo'				=> true
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'the_bootstrap_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= '<nav class="pagination clear"><ul><li><span class="dots">' . __('Pages:', 'the-bootstrap') . '</span></li>';
			for ( $i = 1; $i < ($numpages + 1); $i++ ) {
				$j = str_replace( '%', $i, $pagelink );
				if ( ($i != $page) || ((!$more) && ($page!=1)) ) {
					$output .= '<li>' . _wp_link_page($i) . $j . '</a></li>';
				}
				if ($i == $page) {
					$output .= '<li class="current"><span>' . $j . '</span></li>';
				}
				
			}
			$output .= '</ul></nav>';
		} else {
			if ( $more ) {
				$output .= '<nav class="pagination clear"><ul><li><span class="dots">' . __('Pages:', 'the-bootstrap') . '</span></li>';
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= '<li>' . _wp_link_page( $i ) . $previouspagelink. '</a></li>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= '<li>' . _wp_link_page( $i ) . $nextpagelink. '</a></li>';
				}
				$output .= '</ul></nav>';
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}
endif;


/**
 * Returns the blogname if no title was set.
 *
 * @author	Konstantin Obenland
 * @since	1.1.0 - 18.03.2012
 *
 * @param	string	$title
 *
 * @return	string
 */
function the_bootstrap_wp_title( $title, $sep ) {
	$title .= get_bloginfo( 'name' );
	
	if ( is_front_page() ) {
		$title .= " {$sep} " . get_bloginfo( 'description' );
	}

	return $title;
}
add_filter( 'wp_title', 'the_bootstrap_wp_title', 1, 2 );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$more
 *
 * @return	string
 */
function the_bootstrap_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and the_bootstrap_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$more
 *
 * @return	string
 */
function the_bootstrap_auto_excerpt_more( $more ) {
	return '&hellip;' . the_bootstrap_continue_reading_link();
}
add_filter( 'excerpt_more', 'the_bootstrap_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$output
 *
 * @return	string
 */
function the_bootstrap_custom_excerpt_more( $output ) {
	if ( has_excerpt() AND ! is_attachment() ) {
		$output .= the_bootstrap_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'the_bootstrap_custom_excerpt_more' );


/**
 * Get the wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$args
 *
 * @return	array
 */
function the_bootstrap_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'the_bootstrap_page_menu_args' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @author	Automattic
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$url
 * @param	int		$id
 *
 * @return	string
 */
function the_bootstrap_enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() AND ! wp_attachment_is_image( $id ) )
        return $url;
 
    $image = get_post( $id );
    if ( $image->post_parent AND $image->post_parent != $id )
        $url .= '#primary';
 
    return $url;
}
add_filter( 'attachment_link', 'the_bootstrap_enhanced_image_navigation', 10, 2 );


if ( ! function_exists( 'the_bootstrap_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own the_bootstrap_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	object	$comment	Comment data object.
 * @param	array	$args
 * @param	int		$depth		Depth of comment in reference to parents.
 *
 * @return	void
 */
function the_bootstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p class="row">
			<strong class="ping-label span1"><?php _e( 'Pingback:', 'the-bootstrap' ); ?></strong>
			<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
		</p>
	<?php
			break;
		default :
			$offset	=	$depth - 1;
			$span	=	7 - $offset;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment row">
			<div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div>
			<footer class="comment-meta span<?php echo $span; ?>">
				<div class="comment-author vcard">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <span class="says">said</span> on %2$s:', 'the-bootstrap' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'the-bootstrap' ), get_comment_date(), get_comment_time() )
							)
						);
						edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( ! $comment->comment_approved ) : ?>
				<div class="comment-awaiting-moderation alert alert-info"><em><?php _e( 'Your comment is awaiting moderation.', 'the-bootstrap' ); ?></em></div>
				<?php endif; ?>

			</footer>

			<div class="comment-content span<?php echo $span; ?>">
				<?php
				comment_text();
				comment_reply_link( array_merge( $args, array(
					'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
					'depth'			=>	$depth,
					'max_depth'		=>	$args['max_depth']
				) ) ); ?>
			</div>

		</article><!-- #comment-<?php comment_ID(); ?> -->
	<?php
			break;
	endswitch;
}
endif; // ends check for the_bootstrap_comment()


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_top() {
	echo '<div class="form-horizontal">';
}
add_action( 'comment_form_top', 'the_bootstrap_comment_form_top' );


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form() {
	echo '</div></div>';
}
add_action( 'comment_form', 'the_bootstrap_comment_form' );


/**
 * Custom author form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_author( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-author control-group">
				<label for="author" class="control-label">' . __( 'Name', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="author" class="alignleft" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
					' . ( $req ? '<p class="help-block"><span class="required">' . __('required', 'the-bootstrap') . '</span></p>' : '' ) . '
				</div>
			</div>';
}
add_filter( 'comment_form_field_author', 'the_bootstrap_comment_form_field_author');


/**
 * Custom HTML5 email form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_email( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-email control-group">
				<label for="email" class="control-label">' . __( 'Email', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="email" class="alignleft" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
					<p class="help-block">' . ( $req ? '<span class="required">' . __('required', 'the-bootstrap') . '</span>, ' : '' ) . __( 'will not be published', 'the-bootstrap' ) . '</p>
				</div>
			</div>';
}
add_filter( 'comment_form_field_email', 'the_bootstrap_comment_form_field_email');


/**
 * Custom HTML5 url form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_url( $html ) {
	$commenter	=	wp_get_current_commenter();
	
	return	'<div class="comment-form-url control-group">
				<label for="url" class="control-label">' . __( 'Website', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' />
				</div>
			</div>';
}
add_filter( 'comment_form_field_url', 'the_bootstrap_comment_form_field_url');


/**
 * Adjusts an attechment link to hold the class of 'thumbnail' and make it look
 * pretty
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$link
 * @param	int		$id			Post ID.
 * @param	string	$size		Default is 'thumbnail'. Size of image, either array or string.
 * @param	bool	$permalink	Default is false. Whether to add permalink to image.
 * @param	bool	$icon		Default is false. Whether to include icon.
 * @param	string	$text		Default is false. If string, then will be link text.
 *
 * @return	string
 */
function the_bootstrap_get_attachment_link( $link, $id, $size, $permalink, $icon, $text) {
	if ( ! $text ) {
		$link	=	str_replace( '<a ', '<a class="thumbnail" ', $link );
	}
	return $link;
}
add_filter( 'wp_get_attachment_link', 'the_bootstrap_get_attachment_link', 10, 6 );


/**
 * Adds the 'hero-unit' class for extra big font on sticky posts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$classes
 *
 * @return	array
 */
function the_bootstrap_post_classes( $classes ) {

	if ( is_sticky() AND ! is_single() ) {
		$classes[] = 'hero-unit';
	}
	
	return $classes;
}
add_filter( 'post_class', 'the_bootstrap_post_classes' );


/**
 * Callback function to display galleries (in HTML5)
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$content
 * @param	array	$attr
 *
 * @return	string
 */
function the_bootstrap_post_gallery( $content, $attr ) {
	global $instance, $post;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'			=>	'ASC',
		'orderby'		=>	'menu_order ID',
		'id'			=>	$post->ID,
		'itemtag'		=>	'figure',
		'icontag'		=>	'div',
		'captiontag'	=>	'figcaption',
		'columns'		=>	3,
		'size'			=>	'thumbnail',
		'include'		=>	'',
		'exclude'		=>	''
	), $attr));


	$id = intval($id);
	if ( 'RAND' == $order )
	$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array(
		'include'			=>	$include,
		'post_status'		=>	'inherit',
		'post_type'			=>	'attachment',
		'post_mime_type'	=>	'image',
		'order'				=>	$order,
		'orderby'			=>	$orderby
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array(
		'post_parent'		=>	$id,
		'exclude'			=>	$exclude,
		'post_status'		=>	'inherit',
		'post_type'			=>	'attachment',
		'post_mime_type'	=>	'image',
		'order'				=>	$order,
		'orderby'			=>	$orderby
		) );
	} else {
		$attachments = get_children( array(
		'post_parent'		=>	$id,
		'post_status'		=>	'inherit',
		'post_type'			=>	'attachment',
		'post_mime_type'	=>	'image',
		'order'				=>	$order,
		'orderby'			=>	$orderby
		) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
		$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		return $output;
	}

	$itemtag	=	tag_escape( $itemtag );
	$captiontag	=	tag_escape( $captiontag );
	$columns	=	intval( $columns );
	$itemwidth	=	($columns > 0) ? floor( 100/$columns ) : 100;
	$float		=	(is_rtl())? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$size_class = sanitize_html_class( $size );
	$output = "<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} thumbnails'>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$comments = get_comments(array(
		'post_id'	=>	$id,
		'count'		=>	true,
		'type'		=>	'comment',
		'status'	=>	'approve'
		));
			
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size) : wp_get_attachment_link($id, $size, true);
		
		$clear_class = '';
		if (  $i % $columns == 0 ) {
			$clear_class = ' style="clear:both;"';
		}
		
		$output .= "<li class='span2'{$clear_class}><{$itemtag} class='gallery-item'>";
		$output .= "
		<{$icontag} class='gallery-icon'>
		$link
		</{$icontag}>\n";
			
		if ( $captiontag AND (0 < $comments OR trim($attachment->post_excerpt)) ) {
			$comments	=	( 0 < $comments ) ? sprintf( _n('%d comment', '%d comments', $comments, 'the-bootstrap'), $comments ) : '';
			$excerpt	=	wptexturize( $attachment->post_excerpt );
			$out		=	($comments AND $excerpt) ? " $excerpt <br /> $comments " : " $excerpt$comments ";
			$output .= "
			<{$captiontag} class='wp-caption-text gallery-caption'>
			{$out}
			</{$captiontag}>\n";
		}
		$output .= "</{$itemtag}></li>\n";
		$i++;
	}
	$output .= "</ul>\n";
	
	return $output;
}
add_filter( 'post_gallery', 'the_bootstrap_post_gallery', 10, 2 );


/**
 * HTML 5 caption for pictures
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$empty
 * @param	array	$attr
 * @param	string	$content
 *
 * @return	string
 */
function the_bootstrap_img_caption_shortcode( $empty, $attr, $content ) {

	extract( shortcode_atts( array(
		'id'		=>	'',
		'align'		=>	'alignnone',
		'width'		=>	'',
		'caption'	=>	''
	), $attr) );

	if ( 1 > (int) $width OR empty($caption) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption thumbnail ' . $align . '" style="width: '.$width.'px;">
				' . do_shortcode( $content ) . '
				<figcaption class="wp-caption-text">' . $caption . '</figcaption>
			</figure>';
}
add_filter( 'img_caption_shortcode', 'the_bootstrap_img_caption_shortcode', 10, 3 );


/**
 * Returns a password form which dispalys nicely with Bootstrap
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$form
 *
 * @return	string	The Bootstrap password form
 */
function the_bootstrap_the_password_form( $form ) {
	return '<form class="post-password-form form-horizontal" action="' . home_url( 'wp-pass.php' ) . '" method="post"><legend>'. __( 'This post is password protected. To view it please enter your password below:', 'the-bootstrap' ) . '</legend><div class="control-group"><label class="control-label" for="post-password-' . get_the_ID() . '">' . __( 'Password:', 'the-bootstrap' ) .'</label><div class="controls"><input name="post_password" id="post-password-' . get_the_ID() . '" type="password" size="20" /></div></div><div class="form-actions"><button type="submit" class="post-password-submit submit btn btn-primary">' . __( 'Submit', 'the-bootstrap' ) . '</button></div></form>';
}
add_filter( 'the_password_form', 'the_bootstrap_the_password_form' );


/* End of file functions.php */
/* Location: ./wp-content/themes/the-bootstrap/functions.php */