/**
 * Post Type Enhanced
 *
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 */
function Post_Type_Enhanced_Editor() {
	
	// Create a new media frame
  frame = wp.media({
      multiple: false,
     	library:{ type:'image' }
  });

  // Add a callback for when an item is selected
  frame.state( 'library' ).on( 'select', function(){
   
    var selection = this.get('selection');
    if ( ! selection ) return;
 
		selection.each(function(_attachment) {
			
			var attachment = _attachment.attributes;
			
				if ( 'image' === attachment.type ) {
			
					jQuery('input.pte-input-attachment_id').val(attachment.id);
					jQuery('div.pte-attachment-image img').remove();
					jQuery('div.pte-attachment-image').append(
						jQuery('<img>').attr({
							'src': attachment.sizes.thumbnail.url,
							'class': 'pte-attachment-thumb',
							'alt': attachment.title
						})
					);  // <==\ append

				} else {
				
					jQuery('div.pte-attachment-image img').remove();
					jQuery('div.pte-attachment-image').append(
						jQuery('<p>').html('Only images are allowed')
					);  // <==\ append

				} // <==\ 'image' === attachment.type

   	}); // <==\ selection.each

 	});  // <==\ frame.state
  
  // open the frame
  frame.open();

}

function Post_Type_Enhanced() {
	
	var buttonAdd = jQuery('button.pte-add-media');
	
	var buttonRemove = jQuery('button.pte-remove-media');

	buttonAdd.on('click', function(event) {
		event.preventDefault();
		Post_Type_Enhanced_Editor();
	});

	buttonRemove.on('click', function(event) {
		event.preventDefault();
		jQuery('input.pte-attachment-id').val(0);
		jQuery('div.pte-attachment-image img').remove();
		jQuery(this).fadeOut(250);
	});

	jQuery(document).on('click', 'div.pte-attachment-image img', function() {
		Post_Type_Enhanced_Editor();
	});

	if( jQuery('input.pte-attachment-id').val() == 0 ) buttonRemove.css('display', 'none');
}

jQuery(document).ready(function() {
	Post_Type_Enhanced();
});