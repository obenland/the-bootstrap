<?php
/** template-tags.php
 * 
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 * 
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.2.4 - 07.04.2012
 */


if ( ! function_exists( 'the_bootstrap_content_nav' ) ) :
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
		echo "<nav class=\"pagination pagination-centered clearfix\">{$links}</nav>";
	}
}
endif;


if ( ! function_exists( 'the_bootstrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
* comment and edit link
*
* @author	Konstantin Obenland
* @since	1.0.0 - 05.02.2012
*
* @return	void
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
 * @return	string
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


/* End of file template-tags.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/template-tags.php */