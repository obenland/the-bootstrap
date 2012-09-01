jQuery( function( $ ) {
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title span' ).html( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).html( to );
		});
	});
	wp.customize( 'the_bootstrap_theme_options[theme_layout]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'content-sidebar sidebar-content' ).addClass( to );
		});
	});
	wp.customize( 'the_bootstrap_theme_options[navbar_site_name]', function( value ) {
		value.bind( function( to ) {
			$( 'span.brand' ).remove();
			if ( to )
				$( '<span>' ).addClass( 'brand' ).text( the_bootstrap_customize.sitename ).insertBefore( '.nav-collapse' );
		});
	});
	wp.customize( 'the_bootstrap_theme_options[navbar_searchform]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-search').remove();
			if ( to )
				$( '.nav-collapse' ).append( the_bootstrap_customize.searchform );
		});
	});
	wp.customize( 'the_bootstrap_theme_options[navbar_inverse]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar').removeClass( 'navbar-inverse' );
			if ( to )
				$( '.navbar').addClass( 'navbar-inverse' );
		});
	});
	wp.customize( 'the_bootstrap_theme_options[navbar_position]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar' ).removeClass( 'navbar-fixed-top navbar-fixed-bottom' );
			$( 'body > .container' ).css( 'margin', '18px auto' );
			if ( 'static' != to ) {
				jQuery( '.navbar' ).addClass( to );
				var margin = ( 'navbar-fixed-top' == to ) ? 'margin-top' : 'margin-bottom';
				$( 'body > .container' ).css( margin, '58px' );
			}
		});
	});
});