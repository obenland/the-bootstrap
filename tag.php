<?php
/** tag.php
 *
 * The template used to display Tag Archive pages
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>

<section id="primary" class="span8">
	<div id="content" role="main">

	<?php if ( have_posts() ) { ?>

		<header class="page-header">
			<h1 class="page-title"><?php
				printf( __( 'Tag Archives: %s', 'the-bootstrap' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			?></h1>

			<?php if ( $tag_description = tag_description() ) ) {
				echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
			} ?>
		</header>

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', get_post_format() );
		}
		the_bootstrap_content_nav();
	}
	else {
		get_template_part( '/partials/content', 'not-found' );
	}
	?>
			
	</div><!-- #content -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/tag.php */