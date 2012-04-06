jQuery(function($){
	$('table').addClass('table table-striped');
	$('#submit').addClass('btn btn-primary btn-large');
	$('#wp-calendar').addClass('table table-striped table-bordered');
	$('.current-menu-item, .current-page-item').addClass('active');
	$('.navbar .sub-menu').addClass('dropdown-menu');
	$('.navbar li').has('ul').addClass('dropdown').children('a').addClass('dropdown-toggle').attr('data-toggle', 'dropdown').append('<b class="caret"></b>');
	
	// Bootstrap plugins
	$('[rel="tooltip"]').tooltip();
	$('[rel="popover"]').popover();
	$('.alert').alert()
});