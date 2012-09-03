jQuery(document).ready(function($) {
	'use strict';

	// Get the browser height and width
	var windowHeight, windowWidth;
	windowHeight = $(window).height();
    windowWidth = $(window).width();

	// Show the sidebar on click
	$('.show-deck').click(function () {
		$('body').addClass('sidebar-active');
		$('#sidebar').animate({
			marginLeft : '0px'
		}, 'fast');
		$('#main-container').animate({
			marginLeft : '280px'
		}, 'fast');
		$(this).hide();
		$('.hide-deck').show();
	});
	
	// Hide the sidebar on click
	$('.hide-deck').click(function () {
		$('body').removeClass('sidebar-active');
		$('#sidebar').animate({
			marginLeft : '-280px'
		}, 'fast');
		$('#main-container').animate({
			marginLeft : '0px'
		}, 'fast');
		$(this).hide();
		$('.show-deck').show();
	});

    //  Foundation Reveal modal
	$('#open-modal').click(function() {
		$('#search-modal').reveal({
			dismissModalClass: 'close-modal'
		});
	});

	/*
	 * If the browser is less than 767 wide (our tablet breaking point)
	 * then hide the sidebar and make it inactive
	 */
	if (windowWidth < 767) {
		$('body').removeClass('sidebar-active');
		$('#sidebar-primary').animate({
			marginLeft : '-280px'
		}, 'fast');
		$('#content').animate({
			marginLeft : '0px'
		}, 'fast');
		$('.hide-deck').hide();
		$('.show-deck').show();
	}

});

/*
 * We're detecting whenever the browser changes sizes
 * and adjusting page elements dynamically/on-the-fly
 */
jQuery(window).ready(function($) {
	'use strict';
    var windowHeight, windowWidth;
    windowHeight = $(window).height();
    windowWidth = $(window).width();
	$('#sidebar-primary').css('height', windowHeight);
	$('#sidebar-task').css('height', windowHeight);
});