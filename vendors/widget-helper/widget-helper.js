var magazine_point_upload_frame_obj;

( function( $ ) {

	jQuery(document).ready(function($) {

		jQuery(document).on('click', 'input.wh-image-picker', function( event ){

			var $this = $(this);
			event.preventDefault();

			var MagazinePointImageObject = wp.media.controller.Library.extend({
				defaults : _.defaults({
					id: 'newsreader-state-insert',
					title: $this.data( 'uploader_title' ),
					allowLocalEdits: false,
					displaySettings: true,
					displayUserSettings: false,
					multiple: false,
					library: wp.media.query( { type: 'image' } )
				}, wp.media.controller.Library.prototype.defaults )
			});

			magazine_point_upload_frame_obj = wp.media.frames.magazine_point_upload_frame_obj = wp.media({
				button: {
					text: jQuery( this ).data( 'uploader_button_text' )
				},
				state : 'newsreader-state-insert',
				states : [
					new MagazinePointImageObject()
				],
				multiple: false
			});

			magazine_point_upload_frame_obj.on( 'select', function() {

				var state = magazine_point_upload_frame_obj.state('newsreader-state-insert');
				var selection = state.get('selection');
				var display = state.display( selection.first() ).toJSON();
				var object_attachment = selection.first().toJSON();
				display = wp.media.string.props( display, object_attachment );

				var image_field = $this.siblings('.image-field-hidden');
				var image_url = display.src;

				image_field.val( image_url );
				image_field.trigger('change');

				var image_preview_wrap = $this.siblings('.field-image-preview');
				var image_html = '<img src="' + image_url + '" />';
				image_preview_wrap.html( image_html );

				var btn_remove_image = $this.siblings('.btn-image-remove');
				btn_remove_image.css('display','inline-block');
			});

			magazine_point_upload_frame_obj.open();
		});

		// Callback for image remove.
		jQuery(document).on('click', 'input.btn-image-remove', function( e ) {
			e.preventDefault();
			var $this = $(this);
			var image_field = $this.siblings('.image-field-hidden');
			image_field.val('');
			var image_preview_wrap = $this.siblings('.field-image-preview');
			image_preview_wrap.html('');
			$this.css('display','none');
			image_field.trigger('change');
		});

		function initWHColorPicker( widget ) {
			widget.find( '.wh-color-picker' ).wpColorPicker( {
				change: _.throttle( function() {
					$(this).trigger( 'change' );
				}, 3000 )
			});
		}

		function onFormUpdate( event, widget ) {
			initWHColorPicker( widget );
		}

		$( document ).on( 'widget-added widget-updated', onFormUpdate );

		$( document ).ready( function() {
			$( '#widgets-right .widget:has(.wh-color-picker)' ).each( function () {
				initWHColorPicker( $( this ) );
			} );
		} );

	});

} )( jQuery );
