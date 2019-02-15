jQuery(function($) {
    	// Num Pad Input
	// ********************
	$('#txtPeso').keyboard({
		layout: 'num',
		restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
		preventPaste : true,  // prevent ctrl-v and right click
		autoAccept : true
	});

});