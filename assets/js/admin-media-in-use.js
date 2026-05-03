( function () {
	'use strict';

	var inUseIds = ( window.mciMediaInUse && Array.isArray( mciMediaInUse.ids ) )
		? mciMediaInUse.ids.map( Number )
		: [];

	if ( ! inUseIds.length ) {
		return;
	}

	var CSS_CLASS = 'mci-attachment-in-use';

	function stampTile( el ) {
		var id = parseInt( el.getAttribute( 'data-id' ), 10 );
		if ( id && inUseIds.indexOf( id ) !== -1 ) {
			el.classList.add( CSS_CLASS );
		}
	}

	function stampAll( root ) {
		var tiles = ( root || document ).querySelectorAll( '.attachment[data-id]' );
		for ( var i = 0; i < tiles.length; i++ ) {
			stampTile( tiles[ i ] );
		}
	}

	// Stamp any tiles already in the DOM (list view renders server-side).
	stampAll();

	// Watch for grid tiles injected dynamically by WP Media (Backbone rendering).
	if ( window.MutationObserver ) {
		var observer = new MutationObserver( function ( mutations ) {
			for ( var i = 0; i < mutations.length; i++ ) {
				var added = mutations[ i ].addedNodes;
				for ( var j = 0; j < added.length; j++ ) {
					var node = added[ j ];
					if ( node.nodeType !== 1 ) continue;

					if ( node.classList && node.classList.contains( 'attachment' ) && node.hasAttribute( 'data-id' ) ) {
						stampTile( node );
					} else {
						// Stamp any .attachment descendants inside the added subtree.
						var nested = node.querySelectorAll && node.querySelectorAll( '.attachment[data-id]' );
						if ( nested ) {
							for ( var k = 0; k < nested.length; k++ ) {
								stampTile( nested[ k ] );
							}
						}
					}
				}
			}
		} );

		observer.observe( document.body, { childList: true, subtree: true } );
	}
} )();
