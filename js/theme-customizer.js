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
	wp.customize( 'the_bootstrap_theme_options[bootswatch]', function( value ) { 
		value.bind( function( to ) { 
			$( '#' + the_bootstrap_customize.current_skin + '-css' ).remove();
			$( 'body' ).removeClass( the_bootstrap_customize.current_skin ).addClass( to );
			the_bootstrap_customize.current_skin = to;
			
			$( 'head' ).append( '<link rel="stylesheet" id="amelia-lobster-font-css" href="//fonts.googleapis.com/css?family=Lobster" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="amelia-cabin-font-css" href="//fonts.googleapis.com/css?family=Cabin:400,700" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="cerulean-telex-font-css" href="//fonts.googleapis.com/css?family=Telex" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="cyborg-droid-sans-font-css" href="//fonts.googleapis.com/css?family=Droid+Sans:400,700" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="journal-news-cycle-font-css" href="//fonts.googleapis.com/css?family=News+Cycle:400,700" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="simplex-josefin-sans-font-css" href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,700" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="spacelab-muli-font-css" href="//fonts.googleapis.com/css?family=Muli" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="spruce-josefin-slab-font-css" href="//fonts.googleapis.com/css?family=Josefin+Slab:400,700" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="superhero-oswald-font-css" href="//fonts.googleapis.com/css?family=Oswald" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="superhero-noticia-font-css" href="//fonts.googleapis.com/css?family=Noticia+Text" type="text/css" media="all" />' );
			$( 'head' ).append( '<link rel="stylesheet" id="united-ubuntu-font-css" href="//fonts.googleapis.com/css?family=Ubuntu" type="text/css" media="all" />' );			
			
			switch ( to ) {
				case 'twitter-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="twitter-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'bootstrap.css" type="text/css" media="all" />' );
					break;
					
				case 'amelia-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="amelia-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'amelia.css" type="text/css" media="all" />' );
					break;
					
				case 'cerulean-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="cerulean-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'cerulean.css" type="text/css" media="all" />' );
					break;
					
				case 'cyborg-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="cyborg-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'cyborg.css" type="text/css" media="all" />' );
					break;
					
				case 'journal-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="journal-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'journal.css" type="text/css" media="all" />' );
					break;
				
				case 'readable-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="readable-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'readable.css" type="text/css" media="all" />' );
					break;
					
				case 'simplex-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="simplex-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'simplex.css" type="text/css" media="all" />' );
					break;
					
				case 'slate-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="slate-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'slate.css" type="text/css" media="all" />' );
					break;
					
				case 'spacelab-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="spacelab-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'spacelab.css" type="text/css" media="all" />' );
					break;
					
				case 'spruce-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="spruce-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'spruce.css" type="text/css" media="all" />' );
					break;
					
				case 'superhero-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="superhero-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'superhero.css" type="text/css" media="all" />' );
					break;
				
				case 'united-bootstrap':
					$( 'head' ).append( '<link rel="stylesheet" id="united-bootstrap-css" href="' + the_bootstrap_customize.css_path + 'united.css" type="text/css" media="all" />' );
					break;
			} 
		} ); 
	} );
});