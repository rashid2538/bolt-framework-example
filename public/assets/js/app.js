( function( $ ) {

	$( '#accordion' ).on( 'click', '[data-listitem]', function() {
		var item = $.trim( prompt( 'Enter the title of new item :' ) );
		if( item ) {
			$.ajax({
				url : $( 'meta[name="base"]' ).attr( 'content' ) + 'home/add-todo-item/',
				data : {
					title : item,
					todoListId : $( this ).data( 'listitem' )
				}, type : 'post',
				dataType : 'json'
			}).done( console.log.bind( console ) ).fail( console.error.bind( console ) );
		}
	});
})( jQuery );