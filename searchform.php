<?php
/** searchform.php
 *
 * The template for displaying search forms
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */
?>
<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text hidden"><?php _e( 'Search', 'the-bootstrap' ); ?></label>
	<input type="search" class="search-query span2" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'the-bootstrap' ); ?>" />
	<input type="submit" class="submit btn btn-primary" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'the-bootstrap' ); ?>" />
</form>
<?php


/* End of file searchform.php */
/* Location: ./wp-content/themes/the-bootstrap/searchform.php */