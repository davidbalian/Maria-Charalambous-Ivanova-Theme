( function ( $ ) {
	'use strict';

	/*
	 * Grid view + media modal: extend the Backbone Attachment view so every tile
	 * whose JS model has mciInUse === true gets the indicator class.
	 *
	 * wp_prepare_attachment_for_js (PHP) injects the mciInUse boolean into each
	 * attachment's data object, so no extra AJAX is needed.
	 */
	if ( window.wp && wp.media && wp.media.view && wp.media.view.Attachment ) {
		var OriginalAttachment = wp.media.view.Attachment;

		wp.media.view.Attachment = OriginalAttachment.extend( {
			render: function () {
				OriginalAttachment.prototype.render.apply( this, arguments );

				if ( this.model && this.model.get( 'mciInUse' ) ) {
					this.$el.addClass( 'mci-attachment-in-use' );
				} else {
					this.$el.removeClass( 'mci-attachment-in-use' );
				}

				return this;
			},
		} );
	}

	/*
	 * List view row highlighting is handled server-side via the custom column
	 * callback (render_column) which emits an inline <script> per row.
	 * Nothing additional needed here for the list view.
	 */
} )( jQuery );
