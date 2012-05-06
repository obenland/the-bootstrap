jQuery(function($){
	wp.customize('the_bootstrap_theme_options[theme_layout]',function(value){
		value.bind(function(to){
			jQuery('body').removeClass('content-sidebar sidebar-content').addClass(to);
		});
	});
	wp.customize('the_bootstrap_theme_options[navbar_site_name]',function(value){
		value.bind(function(to){
			if (to)
				jQuery('<span>').addClass('brand').text(the_bootstrap_customize.sitename).insertBefore('.nav-collapse');
			else
				jQuery('span.brand').remove();
		});
	});
	wp.customize('the_bootstrap_theme_options[navbar_searchform]',function(value){
		value.bind(function(to){
			if (to)
				jQuery('.nav-collapse').append(the_bootstrap_customize.searchform);
			else
				jQuery('.navbar-search').remove();
		});
	});
});