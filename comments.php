<?php
/** comments.php
 *
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to the_bootstrap_comment() which is
 * located in the functions.php file.
 *
 * @author		Konstantin Obenland
 * @package		WordPress
 * @subpackage	The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */


if ( post_password_required() ) : ?>
<div id="comments">
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'the-bootstrap' ); ?></p>
</div><!-- #comments -->
<?php
	return;
endif;


if ( have_comments() ) : ?>
<div id="comments">
	<h2 id="comments-title">
		<legend>
		<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'the-bootstrap' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</legend>
	</h2>

	<?php if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-above" class="well">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'the-bootstrap' ); ?></h1>
		<div class="nav-previous alignleft"><?php next_comments_link( __( '&larr; Newer Comments', 'the-bootstrap' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_comments_link( __( 'Older Comments &rarr;', 'the-bootstrap' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist unstyled">
		<?php wp_list_comments( array( 'callback' => 'the_bootstrap_comment' ) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" class="well">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'the-bootstrap' ); ?></h1>
		<div class="nav-previous alignleft"><?php next_comments_link( __( '&larr; Newer Comments', 'the-bootstrap' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_comments_link( __( 'Older Comments &rarr;', 'the-bootstrap' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

</div><!-- #comments -->
<?php endif;

if ( ! comments_open() AND ! is_page() AND post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'the-bootstrap' ); ?></p>
<?php endif;
comment_form( array(
	'comment_field'			=>	'<div class="comment-form-comment control-group"><label class="control-label" for="comment">' . _x( 'Comment', 'noun', 'the-bootstrap' ) . '</label><div class="controls"><textarea class="span7" id="comment" name="comment" rows="8" aria-required="true"></textarea></div></div>',
	'comment_notes_before'	=>	'',
	'comment_notes_after'	=>	'<div class="form-allowed-tags control-group"><label class="control-label">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'the-bootstrap' ), '</label><div class="controls"><pre>' . allowed_tags() . '</pre></div>' ) . '</div>
								 <div class="form-actions">',
	'title_reply'			=>	'<legend>' . __( 'Leave a reply', 'the-bootstrap' ) . '</legend>',
	'title_reply_to'		=>	'<legend>' . __( 'Leave a reply to %s', 'the-bootstrap' ). '</legend>',
	'must_log_in'			=>	'<div class="must-log-in control-group controls">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'the-bootstrap' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
	'logged_in_as'			=>	'<div class="logged-in-as control-group controls">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'the-bootstrap' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',

) );


/* End of file comments.php */
/* Location: ./wp-content/themes/the-bootstrap/comments.php */