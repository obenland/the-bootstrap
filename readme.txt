=== The Bootstrap ===
Contributors:		kobenland
Tags:				black, blue, white, light, two-columns, left-sidebar, right-sidebar, flexible-width, custom-header, custom-background, threaded-comments, translation-ready, microformats, custom-menu, post-formats, sticky-posts
Donate link:		https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=542W6XT4PLT4L
Requires at least:	3.3.0
Tested up to:		3.5.0
Stable tag:			2.0.1

A WordPress Theme based on Bootstrap, from Twitter

== Description ==

The Theme is 100% responsive - you do not need a seperate mobile-Theme with this layout.
It has a seperate Sidebar just for image pages, to make it a special place to show your pictures!
The Bootstrap is fully compatible with WordPress SEO by Yoast!

Please note:

Due to design restrictions in Bootstrap, the navigation menu can "only" be three levels deep, while parent menu items only serves as a headline for the child menu items and can not be accessed over the navigation menu.
The Footer Menu is best suitable for short menues with just a few links. It replaces the credits section, once a menu has been assigned to the location.
To take advantage of all the possibilites Bootstrap has to offer, Bootstrap requires jQuery 1.7, which does not come with WordPress versions prior to 3.3.0. Consider adding a plugin that provides the lates version of jQuery, if you want to use this Theme with WordPress 3.2.1 or lower.

= License =
Unless otherwise specified, all the theme files, scripts and images are licensed under GNU General Public Licemse.
The exceptions to this license are as follows:
* Bootstrap by Twitter and the Glyphicon set are licensed under the GPL-compatible [http://www.apache.org/licenses/LICENSE-2.0 Apache License v2.0]
* html5shiv is licensed under MIT
* Respond.js: Copyright 2011: Scott Jehl, scottjehl.com. Dual licensed under the MIT or GPL Version 2 licenses.
* Twitter Icon: [https://twitter.com/about/resources/logos]

= Translations =
I will be more than happy to update the Theme with new locales, as soon as I receive them!
Currently available in:

* Armenian
* Dutch
* English
* French
* German
* Hungarian
* Japanese
* Russian


== Installation ==

1. Download The Bootstrap.
2. Unzip the folder into the `/wp-content/themes/` directory
3. Activate the Theme through the 'Appearance' menu in WordPress


== Versioning ==

For transparency and insight into my release cycle, and for striving to maintain backward compatibility, The Bootstrap - as all my WordPress APIs - will be maintained under the Semantic Versioning guidelines.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit [http://semver.org/].


== Changelog ==

= 2.0.1 =
* Updated Twitter Bootstrap to 2.2.2

= 2.0.0 =

THIS IS A MAJOR RELEASE, BREAKING BACKWARD COMPATIBILITY IN SOME PLACES

* Theme Options will only be available for outdated WordPress versions and will be removed in the future. Going Customizer all the way!
* Updated Twitter Bootstrap to 2.1
* Updated html5shiv to 3.6.1
* Updated Russian translation to fix a bug in the carousel navigation
* Added Armenian translation. Props Narine
* Navbar menue now supports a third level of menu items
* Nav-pill menues now also support a second and third level of menu items
* Improved support for all possible amounts of gallery columns, limiting at eight
* Improved pagination to handle query strings better
* Twitter status embeds are now responsive, too. Props @kovshenin
* Now only shows category and tags when there are any, pending core implementation
* Fixed undefined variable notice in image.php
* Order of words in image navigation can now be localized
* Various other small improvements

= 1.8.2 =
* Added missing classname change to style.min.css

= 1.8.1 =
* Fixed an alignment-bug in the footer for webkit-browsers
* Fixed a bug where gallery thumbnails were only 1px wide on mobile devices

= 1.8.0 =
* Adds support for the Theme Hook Alliance project. Props @zamoose
* Reintroduce Glyphicon Icon support. See https://github.com/twitter/bootstrap/issues/3942#issuecomment-6844728

= 1.7.1 =
* Fixed a bug where the not-found template would be called wrong in certain templates

= 1.7.0 =
* Added response.js for the use of media queries in InternetExplorer 6-8
* Changed site title and description transport method to postMessage in Theme Customizer
* Displays a message to administrators, when no menu has ben set for the main navigation
* Added Japanese translation. Props Yoichi Kikuchi
* Added Hungarian translation. Props Ochronus
* Fixed a layout bug for attachment pages on narrow screens
* Fixed a bug where the header image height was not adjusted on narrow screens

= 1.6.0 =
* Added a Gallery Widget for sidebars
* Updated Twitter Bootstrap to 2.0.4
* Added copyright and license info to Yoast's code
* Added French translation. Props Pistil

= 1.5.0 =
* Added missing Theme Option to Theme Customizer
* Add support (style) for Jetpack subscription checkboxes
* Introduced The_Bootstrap_Nav_Walker to avoid JavaScript handling of navbar markup
* Fixed a bug where images on attachment pages were not displayed in IE8
* Updated German language file

= 1.4.0 =
* Added Theme Options to Theme Customizer for WP 3.4
* Navbar can now optionally be fixed on top or bottom of the screen
* Now loads Child Theme stylesheet automatically, when a Child Theme is active
* Comment form on attachement pages now adhere to layout settings
* Added support for PATHINFO permalinks in pagination
* Comment-reply script now hooked to the commentform.

= 1.3.1 =
* Fixed a bug for IE9, misinterpreting a margin in the navbar

= 1.3.0 =
* Added Theme Options page
* Added support for Post Thumbnails. Displayed on posts with the standard post format.
* Added full width template
* Removed post title and added thumbnail look to the status post format
* Added Russian translation. Props serzhenko
* Updated Dutch translation. Props m038
* Updated German translation
* Updated Bootstrap Core to 2.0.3
* Changed default column count for galleries to 4
* Updated screenshot

= 1.2.6 =
* Added Dutch translation. Props m038
* Changed version determination implementation to cope with WP 3.3.2 security release. Thank you Chip Bennett for taking care of the ticket so quickly!
* Code cleanup and formatting

= 1.2.5 =
* Added Custom Image Header support for pre-3.4
* Added Custom Background support for post-3.3.1
* Improved responsive styling on mobile devices
* Improved comment form label layout
* Added padding on site footer
* Removed undefined variable from comment form url input
* Added license information
* Now shows nav toggle only when there actually is a nav menu set

= 1.2.4 =
* Capsuled version retreiving into its own function to handle WP 3.4 changes
* Moved template tags in their own file
* Updated script dependencies
* Fixed a bug in displaying the carousel. Props Griden

= 1.2.3 =
* Fixed credits output

= 1.2.2 =
* Added image carousel for the first ten images of a gallery post-format
* Added default support for Bootstrap jQuery plugins Tooltip, Popover, Alert and Carousel
* Added tow more menu locations, nav pills style (props Benfarhat)
* Define $content_width earlier, so embeds work how they are supposed to
* Removed a misplaced character in Title title-attributes
* Removed wp_page_menu callback since `wp_page_menu()` never gets called
* Added a short description for image sidebar
* Added some French localization
* Minor bugfix in header admin panel

= 1.2.1 =
* Lets keep custom backgrounds active and live with it for now

= 1.2.0 =
* Added support for custom headers with flexible height in WordPress 3.4
* Styled breadcrumb navigation for WordPress SEO by Yoast
* Adjusted container margin to reflect Bootstrap standard
* Temporarily removed custom background due to margin issues with content

= 1.1.4 =
* Quote Post Formats are displayed more consistently now
* Optimized post navigation and waived fallback
* Optimized layout for tablets
* Fixed a bug where attachement images were displayed to big
* Made it easier to override title filter
* Shortened search button text so it doesn't break on narrow screens
* Added attribute to attachement links for smooth navigation in galleries
* Added German translation

= 1.1.3 =
* Added posts navigation for blogs without permalinks
* Improved title behavior

= 1.1.2 =
* Fixed a bug, to load translations
* Fixed some minor textdomain issues
* Fixed a issue where "Comments are disabled" notice was not displayed when there were no comments yet.
* Updated readme.txt to reflect the correct GPL version

= 1.1.1 =
* Fixed an embarassing bug, where large images were overflowing the post content
* Added HTML5 support for IE browsers

= 1.1.0 =
* Added Image Meta Widget for Attachment pages
* Added next/previous post navigation
* Fixed a bug where the comment textarea was overflowing the content area
* Fixed a bug where the linked images wouldn't resize and overflow the content area
* Let the link to WordPress open in a new window/tab
* Added a pagination bar
* Styled page links for paginated posts
* Changed the location of the post edit link
* Updated Bootstrap to 2.0.2 and removed Glyphicon icon set as its license is CC BY 3.0.

= 1.0.1 =
* Removed campaign tracking from Author URI and Theme URI.
* Changed version number on js files to actual version
* Updated function calls with the current prefix
* Added template for Video Post Format

= 1.0.0 =
* Initial Submission to the WordPress Theme Repository
