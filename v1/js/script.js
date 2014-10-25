if ( // Browser check
  'querySelector' in document &&
  'localStorage' in window &&
  'addEventListener' in window
) { // Modern browsers
	$(function() {
		$('head').append('<link rel="stylesheet" media="screen" href="css/modern.css"/>'); // Additional CSS for modern browsers
		// $.getScript("js/modern.js", function( data, textStatus, jqxhr ) { // Additional JS for modern browsers
		$.getScript("js/modern.min.js", function( data, textStatus, jqxhr ) { // Additional JS for modern browsers
		  setTimeout(function() {
		      $('body').addClass('js-ready');
		  },500);
		}); // Above function is only called after a short delay to prevent FOUC
		// $.getScript("js/jquery.review-1.0.0.min.js", function( data, textStatus, jqxhr ) { // Additional JS for modern browsers
		//   $('.resrc').review({
		//     callback: function() {
		//       resrc.resrc(this);
		//     }
		//   });
		// }); // Async load lazy images
	});
} else { // Ancient browsers
	var props = $('.overlay-search').find('input');
	var phtext = "Please enter a keyword";

	if (!Modernizr.input.placeholder) { // Fake playeholder-functionality
		props
			.val(phtext)
			.focus(function() {
				if ($(this).val() == phtext) $(this).val("");
			})
			.blur(function() {
				if ($(this).val() == '') $(this).val(phtext);
		});
	}
}

// All browsers