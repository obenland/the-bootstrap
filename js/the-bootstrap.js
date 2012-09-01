jQuery(function($){
	$( 'table' ).addClass( 'table table-striped table-hover' );
	$( '#submit' ).addClass( 'btn btn-primary btn-large' );
	$( '#wp-calendar' ).addClass( 'table table-striped table-bordered' );
	
	// Bootstrap plugins
	$( '#content [rel="tooltip"]' ).tooltip();
	$( '#content [rel="popover"]' ).popover();
	$( '.alert' ).alert();
	$( '.carousel-inner figure:first-child' ).addClass( 'active' );
	$( '.carousel' ).carousel();
});