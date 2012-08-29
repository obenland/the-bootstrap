<?php
/** author.php
 *
 * The template for displaying Author Archive pages.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

$author = get_queried_object();

get_header(); ?>

<section id="primary" class="span8">

	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top(); ?>

		<header class="page-header">
			<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'the-bootstrap' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author->ID ) ) . '" title="' . esc_attr( $author->display_name ) . '" rel="me">' . $author->display_name . '</a></span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php
		// If a user has filled out their description, show a bio on their entries.
		if ( ! empty( $author->description ) ) : ?>
		<div id="author-info" class="row">
			<h2 class="span8"><?php printf( __( 'About %s', 'the-bootstrap' ), $author->display_name ); ?></h2>
			<div id="author-avatar" class="span1">
				<?php echo get_avatar( $author->user_email, apply_filters( 'the-bootstrap_author_bio_avatar_size', 70 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description" class="span7">
				<?php echo $author->description; ?>
			</div><!-- #author-description	-->
		</div><!-- #author-info -->
		<?php endif;
		
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( '/partials/content', get_post_format() );
			}
			the_bootstrap_content_nav();
		} else {
			get_template_part( '/partials/content', 'not-found' );
		}
		
		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file author.php */
/* Location: ./wp-content/themes/the-bootstrap/author.php */