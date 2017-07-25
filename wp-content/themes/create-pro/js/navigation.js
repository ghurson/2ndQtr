/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

( function() {

	/* For Primary Menu */
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};


	/* For Secondary Menu */
	var secondarycontainer, secondarybutton, secondarymenu;

	secondarycontainer = document.getElementById( 'secondary-site-navigation' );
	if ( ! secondarycontainer ) {
		return;
	}

	secondarybutton = secondarycontainer.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof secondarybutton ) {
		return;
	}

	secondarymenu = secondarycontainer.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof secondarymenu ) {
		secondarybutton.style.display = 'none';
		return;
	}

	secondarymenu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === secondarymenu.className.indexOf( 'nav-menu' ) ) {
		secondarymenu.className += ' nav-menu';
	}

	secondarybutton.onclick = function() {
		if ( -1 !== secondarycontainer.className.indexOf( 'toggled' ) ) {
			secondarycontainer.className = secondarycontainer.className.replace( ' toggled', '' );
			secondarybutton.setAttribute( 'aria-expanded', 'false' );
			secondarymenu.setAttribute( 'aria-expanded', 'false' );
		} else {
			secondarycontainer.className += ' toggled';
			secondarybutton.setAttribute( 'aria-expanded', 'true' );
			secondarymenu.setAttribute( 'aria-expanded', 'true' );
		}
	};
	
} )();