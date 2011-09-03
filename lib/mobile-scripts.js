/* Javascript for transitions, etc */

jQuery.ready( function($) {

	$('a[href*="'+siteData.siteUrl+'"]').click(function() {
		$.mobile.changePage( );
		return false;
		})

	$('div').live('swiperight', function() {
		history.back();
		});	
	
})